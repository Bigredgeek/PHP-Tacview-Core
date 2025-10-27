# Contributing to PHPTacview

First off, thank you for considering contributing to PHPTacview! It's people like you that make this tool better for the entire flight simulation community.

## 🌟 Ways to Contribute

### 1. Report Bugs 🐛
Found a bug? Please create an issue with:
- Clear description of the problem
- Steps to reproduce
- Expected vs actual behavior
- PHP version and environment details
- Sample XML file (if relevant)

### 2. Suggest Features 💡
Have an idea? Open a discussion or issue with:
- Clear description of the feature
- Use case and benefits
- Any implementation ideas

### 3. Add Aircraft Icons 📷
Missing aircraft? We'd love to add it!

**Process:**
1. Find a high-quality top/side-view photo (preferably 800x600+)
2. Name it: `Aircraft_Name.jpg` (match Tacview naming)
3. Add to `objectIcons/` folder
4. Update `data/aircraft_icons_manifest.json` if needed
5. Submit a PR

**Icon Guidelines:**
- Side profile view preferred
- Clear identification features visible
- Reasonable file size (< 200KB)
- No watermarks
- Public domain or properly licensed

### 4. Add Translations 🌍
Want to add a new language or improve an existing one?

1. Copy `languages/tacview_en.php` to `languages/tacview_XX.php` (XX = your language code)
2. Translate all strings
3. Test thoroughly
4. Submit a PR

**Translation Guidelines:**
- Keep formatting placeholders intact
- Test with real debriefing data
- Maintain consistency in terminology
- Add language credit in header

### 5. Code Contributions 💻

## Development Setup

### Prerequisites
- PHP 8.0 or higher
- Git
- Code editor (VS Code recommended)
- Tacview for testing XML exports

### Local Setup

```bash
# Fork the repository on GitHub first

# Clone your fork
git clone https://github.com/YOUR_USERNAME/PHP-Tacview-Core.git
cd PHP-Tacview-Core

# Create a test project
cd ..
mkdir test-project
cd test-project

# Add core as submodule
git init
git submodule add ../PHP-Tacview-Core core

# Copy templates
cp core/config.example.php config.php
cp core/debriefing-template.php debriefing.php

# Create debriefings folder
mkdir debriefings

# Start PHP dev server
php -S localhost:8000
```

Visit http://localhost:8000/debriefing.php to test!

## Code Style Guidelines

### PHP Standards
- **Strict types**: Always use `declare(strict_types=1);`
- **Type hints**: Use parameter and return type hints
- **PSR-12**: Follow PSR-12 coding standards
- **PHP 8+**: Use modern PHP features
- **Comments**: Document complex logic

### Example:
```php
<?php

declare(strict_types=1);

/**
 * Process mission statistics
 * 
 * @param string $xmlFile Path to XML file
 * @param string $missionName Name of mission
 * @return array Statistics array
 */
public function proceedStats(string $xmlFile, string $missionName): array
{
    // Implementation
}
```

### CSS Standards
- Use meaningful class names
- Maintain dark theme consistency
- Mobile-responsive design
- Comment complex layouts

### Commit Messages
Use clear, descriptive commit messages:

```bash
# Good ✅
git commit -m "Add F-15EX icon and manifest entry"
git commit -m "Fix: Correct kill count calculation for multi-crew aircraft"
git commit -m "Feat: Add Spanish translation"

# Not ideal ❌
git commit -m "updates"
git commit -m "fixed bug"
```

## Pull Request Process

### Before Submitting

1. **Test your changes thoroughly**
   - Test with multiple XML files
   - Check different languages
   - Verify no PHP errors

2. **Update documentation**
   - Update README if adding features
   - Add comments to complex code
   - Update CHANGELOG

3. **Check for conflicts**
   - Pull latest from main branch
   - Resolve any conflicts

### Submitting

1. **Create a feature branch**
   ```bash
   git checkout -b feature/your-feature-name
   # or
   git checkout -b fix/bug-description
   ```

2. **Make your changes**
   ```bash
   git add .
   git commit -m "Clear description of changes"
   ```

3. **Push to your fork**
   ```bash
   git push origin feature/your-feature-name
   ```

4. **Open a Pull Request**
   - Go to the main repository
   - Click "New Pull Request"
   - Select your branch
   - Fill out the PR template

### PR Template

```markdown
## Description
Brief description of changes

## Type of Change
- [ ] Bug fix
- [ ] New feature
- [ ] Translation
- [ ] Icon addition
- [ ] Documentation
- [ ] Performance improvement

## Testing
How was this tested?

## Screenshots (if applicable)
Add screenshots for visual changes

## Checklist
- [ ] Code follows project style guidelines
- [ ] Self-reviewed code
- [ ] Commented complex areas
- [ ] Updated documentation
- [ ] No new warnings/errors
- [ ] Tested with sample XML files
```

## Specific Contribution Types

### Adding Aircraft Icons

**File locations:**
- Icons: `objectIcons/Aircraft_Name.jpg`
- Manifest: `data/aircraft_icons_manifest.json`

**Example manifest entry:**
```json
{
  "F-15E_Strike_Eagle": {
    "file": "F-15E_Strike_Eagle.jpg",
    "aliases": ["F-15E", "Strike Eagle"],
    "category": "Aircraft"
  }
}
```

### Improving Translations

**File location:** `languages/tacview_XX.php`

**Key arrays to translate:**
- `$Traduction` - Main UI strings
- `$EventType` - Event descriptions
- `$AllianceType` - Alliance labels

**Test checklist:**
- [ ] All strings translated
- [ ] No encoding issues
- [ ] Tested with real mission data
- [ ] Special characters display correctly

### Performance Improvements

When optimizing code:
1. Document the issue
2. Benchmark before/after
3. Ensure functionality unchanged
4. Test with large XML files

### Bug Fixes

Include in your PR:
1. Description of the bug
2. How to reproduce
3. Root cause
4. Your fix
5. Test cases

## Community Guidelines

### Be Respectful
- Treat everyone with respect
- Be constructive in feedback

### Be Patient
- Maintainers are volunteers
- PRs may take time to review
- Not all suggestions will be accepted

### Be Collaborative
- Discuss major changes first
- Consider alternative approaches
- Learn from feedback

## Questions?

- **General Questions**: Open a discussion
- **Bug Reports**: Create an issue
- **Feature Ideas**: Start a discussion
- **Quick Help**: Check existing issues/discussions

## Recognition

Contributors are recognized in:
- README.md credits section
- CHANGELOG for significant contributions
- GitHub contributors page

Thank you for making PHPTacview better! 🚀

---

