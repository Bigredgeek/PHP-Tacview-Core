<?php

declare(strict_types=1);

/**
 * PHPTacview Configuration Template
 * 
 * Copy this file to your project root as config.php and customize for your group
 */

return [
    // Group branding
    'group_name' => 'Your Group Name',
    'logo_path' => 'your_logo.png',
    'logo_alt' => 'Your Group Logo',
    'group_link' => 'https://your-group-website.com',
    
    // Page settings
    'page_title' => 'PHP Tacview Debriefing',
    'default_language' => 'en',
    
    // Paths (relative to project root)
    'debriefings_path' => 'debriefings/*.xml',
    'core_path' => 'core',  // Path to the submodule
];
