<?php
declare(strict_types=1);

// Normalize aircraft thumbnails: center-crop to 16:9 and resize to target width
// Usage:
//   php tools/normalize_icons.php [--dir=objectIcons] [--width=640] [--quality=82] [--dry-run] [--files=path1,path2]
// Notes:
//   - JPG preferred output; PNG preserved if input is PNG (keeps alpha)
//   - Skips tiny placeholder files (< 2KB) and images smaller than 128x128

// Prefer GD; fall back to ImageMagick CLI (magick) if GD is unavailable
$HAS_GD = extension_loaded('gd');
function findMagick(): ?string {
    $isWin = strtoupper(substr(PHP_OS, 0, 3)) === 'WIN';
    $candidates = $isWin ? ['magick'] : ['magick', 'convert'];
    foreach ($candidates as $cmd) {
        $which = $isWin ? "where $cmd" : "command -v $cmd";
        @exec($which, $out, $code);
        if ($code === 0 && !empty($out)) {
            return $cmd; // use as-is; on Windows 'magick' is preferred
        }
        $out = [];
    }
    // On Windows, check common install paths if not on PATH
    if ($isWin) {
        $roots = [
            getenv('ProgramFiles') ?: 'C:\\Program Files',
            getenv('ProgramFiles(x86)') ?: 'C:\\Program Files (x86)'
        ];
        foreach ($roots as $root) {
            $pattern = rtrim($root, '\\/') . '\\ImageMagick*';
            foreach (glob($pattern, GLOB_ONLYDIR) as $dir) {
                $exe = $dir . '\\magick.exe';
                if (is_file($exe)) {
                    return escapeshellarg($exe);
                }
            }
        }
    }
    return null;
}
$MAGICK = $HAS_GD ? null : findMagick();
if (!$HAS_GD && !$MAGICK) {
    fwrite(STDERR, "Neither GD nor ImageMagick CLI found. Enable GD in php.ini or install ImageMagick ('magick').\n");
    exit(2);
}

function parseArgs(array $argv): array {
    $args = [
        'dir' => __DIR__ . '/../objectIcons',
        'width' => 640,
        'quality' => 82,
        'dry' => false,
        'files' => []
    ];
    foreach ($argv as $arg) {
        if (str_starts_with($arg, '--dir=')) $args['dir'] = substr($arg, 6);
        if (str_starts_with($arg, '--width=')) $args['width'] = max(64, (int)substr($arg, 8));
        if (str_starts_with($arg, '--quality=')) $args['quality'] = max(10, min(95, (int)substr($arg, 10)));
        if ($arg === '--dry-run' || $arg === '--dry') $args['dry'] = true;
        if (str_starts_with($arg, '--files=')) {
            $list = substr($arg, 8);
            $args['files'] = array_values(array_filter(array_map('trim', explode(',', $list))));
        }
    }
    return $args;
}

function loadImage(string $path) {
    $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
    if ($ext === 'jpg' || $ext === 'jpeg') return @imagecreatefromjpeg($path);
    if ($ext === 'png') return @imagecreatefrompng($path);
    return false;
}

function saveImage($img, string $path, int $quality): bool {
    $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
    if ($ext === 'jpg' || $ext === 'jpeg') return imagejpeg($img, $path, $quality);
    if ($ext === 'png') {
        // Map JPEG quality (0-100) to PNG compression (0-9)
        $level = (int)round((100 - $quality) / 100 * 9);
        imagealphablending($img, false);
        imagesavealpha($img, true);
        return imagepng($img, $path, $level);
    }
    return false;
}

function normalizeOneGD(string $srcPath, int $targetW, int $quality, bool $dry): ?string {
    if (!file_exists($srcPath)) return 'missing';
    $size = filesize($srcPath);
    if ($size !== false && $size < 2048) return 'skip-small-file';
    [$w, $h, $type] = @getimagesize($srcPath) ?: [0, 0, null];
    if ($w < 128 || $h < 128) return 'skip-small-dimension';

    $src = loadImage($srcPath);
    if (!$src) return 'load-failed';

    $targetAspect = 16 / 9;
    $srcAspect = $w / $h;

    // Determine crop rectangle (center crop to target aspect)
    if ($srcAspect > $targetAspect) {
        // too wide: crop width
        $newW = (int)round($h * $targetAspect);
        $newH = $h;
        $srcX = (int)round(($w - $newW) / 2);
        $srcY = 0;
    } else {
        // too tall: crop height
        $newW = $w;
        $newH = (int)round($w / $targetAspect);
        $srcX = 0;
        $srcY = (int)round(($h - $newH) / 2);
    }

    $targetH = (int)round($targetW / $targetAspect);
    $dst = imagecreatetruecolor($targetW, $targetH);

    $ext = strtolower(pathinfo($srcPath, PATHINFO_EXTENSION));
    if ($ext === 'png') {
        imagealphablending($dst, false);
        imagesavealpha($dst, true);
        $transparent = imagecolorallocatealpha($dst, 0, 0, 0, 127);
        imagefilledrectangle($dst, 0, 0, $targetW, $targetH, $transparent);
    }

    imagecopyresampled($dst, $src, 0, 0, $srcX, $srcY, $targetW, $targetH, $newW, $newH);

    if ($dry) {
        imagedestroy($src);
        imagedestroy($dst);
        return 'dry-run';
    }

    $ok = saveImage($dst, $srcPath, $quality);
    imagedestroy($src);
    imagedestroy($dst);
    return $ok ? 'ok' : 'save-failed';
}

function normalizeOneMagick(string $srcPath, int $targetW, int $quality, bool $dry, string $magickCmd): ?string {
    if (!file_exists($srcPath)) return 'missing';
    $size = filesize($srcPath);
    if ($size !== false && $size < 2048) return 'skip-small-file';
    [$w, $h] = @getimagesize($srcPath) ?: [0, 0];
    if ($w < 128 || $h < 128) return 'skip-small-dimension';
    $targetH = (int)round($targetW / (16/9));
    $ext = strtolower(pathinfo($srcPath, PATHINFO_EXTENSION));
    $quality = max(10, min(95, $quality));
    $common = "-auto-orient -resize {$targetW}x{$targetH}^ -gravity center -extent {$targetW}x{$targetH} -strip";
    if ($dry) return 'dry-run';
    if ($ext === 'png') {
        $cmd = sprintf('%s "%s" %s -define png:compression-level=%d "%s"', $magickCmd, $srcPath, $common, (int)round((100 - $quality) / 100 * 9), $srcPath);
    } else {
        $cmd = sprintf('%s "%s" %s -quality %d "%s"', $magickCmd, $srcPath, $common, $quality, $srcPath);
    }
    @exec($cmd, $out, $code);
    return $code === 0 ? 'ok' : 'save-failed';
}

$args = parseArgs($argv);
$files = $args['files'];
if (!$files) {
    if (!is_dir($args['dir'])) {
        fwrite(STDERR, "Directory not found: {$args['dir']}\n");
        exit(1);
    }
    $rii = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($args['dir'], FilesystemIterator::SKIP_DOTS));
    foreach ($rii as $f) {
        $ext = strtolower($f->getExtension());
        if (in_array($ext, ['jpg','jpeg','png'], true)) {
            $files[] = $f->getPathname();
        }
    }
}

$results = [];
foreach ($files as $path) {
    // allow relative paths from repo root
    if (!is_file($path)) {
        $alt = __DIR__ . '/../' . ltrim($path, '/');
        if (is_file($alt)) $path = realpath($alt) ?: $alt;
    }
    global $HAS_GD, $MAGICK;
    if ($HAS_GD) {
        $status = normalizeOneGD($path, (int)$args['width'], (int)$args['quality'], (bool)$args['dry']);
    } else {
        $status = normalizeOneMagick($path, (int)$args['width'], (int)$args['quality'], (bool)$args['dry'], $MAGICK);
    }
    $results[] = [$path, $status];
}

$summary = array_reduce($results, function($acc, $row) { $acc[$row[1]] = ($acc[$row[1]] ?? 0) + 1; return $acc; }, []);
foreach ($results as [$p, $s]) echo $s . "\t" . $p . "\n";

echo "\nSummary:" . PHP_EOL;
foreach ($summary as $k => $v) echo "  $k: $v\n";
