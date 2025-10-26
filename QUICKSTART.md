# PHPTacview - Quick Start Guide for New Groups

## What is PHPTacview?

PHPTacview is a web-based debriefing tool that processes Tacview XML files to create detailed mission analysis reports. It's perfect for DCS World squadrons, flight groups, and gaming communities that want to review their missions.

## Features

- 📊 Detailed mission statistics and analysis
- 🎯 Kill tracking and pilot performance metrics
- 🖼️ Aircraft identification with photos
- 🌍 Multi-language support (EN, DE, ES, FR, IT, PT, RU, UK, etc.)
- 🎨 Customizable branding (logo, colors, links)
- ☁️ Easy deployment to Vercel (free hosting)

## Quick Start - Deploy Your Own

### Option 1: Fork and Deploy (Easiest - 10 minutes)

**Step 1: Fork the Template**
1. Go to: https://github.com/Bigredgeek/PHP-Tacview-Analysis-For-SOTN
2. Click **"Fork"** button (top right)
3. Name it: `your-group-name-tacview`

**Step 2: Customize Your Configuration**
1. In your forked repo, edit `config.php`:
```php
return [
    'group_name' => 'Your Squadron Name',
    'logo_path' => 'your_logo.png',           // Your logo filename
    'logo_alt' => 'Your Squadron Logo',
    'group_link' => 'https://your-website.com',
    'page_title' => 'Your Squadron Debriefing',
    'default_language' => 'en',
    'debriefings_path' => 'debriefings/*.xml',
    'core_path' => 'core',
];
```

**Step 3: Add Your Logo**
1. Upload your squadron logo as a PNG file to the root of your repo
2. Make sure the filename matches what you put in `logo_path` above

**Step 4: Deploy to Vercel (Free)**
1. Go to https://vercel.com and sign up (free)
2. Click **"New Project"**
3. Import your forked GitHub repository
4. Click **"Deploy"**
5. Done! You now have a live URL like `your-group-tacview.vercel.app`

**Step 5: Upload Mission Files**
1. Export your Tacview files as XML format
2. Add them to the `debriefings/` folder in your repository
3. Commit and push - Vercel auto-deploys!

### Option 2: Manual Setup (Advanced)

<details>
<summary>Click to expand manual setup instructions</summary>

**Step 1: Clone the Repositories**
```bash
# Clone the template (or fork first)
git clone --recursive https://github.com/Bigredgeek/PHP-Tacview-Analysis-For-Brownwater.git my-tacview

cd my-tacview

# The --recursive flag automatically clones the core submodule
```

**Step 2: Customize Configuration**
```bash
# Edit config.php with your group details
# Add your logo file
# Commit your changes
git add config.php your_logo.png
git commit -m "Customize for our group"
```

**Step 3: Create Your Own GitHub Repo**
```bash
# Create a new repository on GitHub, then:
git remote remove origin
git remote add origin https://github.com/YOUR_USERNAME/your-tacview.git
git push -u origin main
```

**Step 4: Deploy**
- Follow Vercel deployment steps from Option 1, Step 4

</details>

## Project Structure

```
your-tacview/
├── core/                    # Submodule - shared code (auto-updated)
│   ├── tacview.php          # Core processing engine
│   ├── tacview.css          # Styles
│   ├── languages/           # Translations
│   ├── objectIcons/         # Aircraft photos
│   └── categoryIcons/       # Category icons
├── config.php              # YOUR GROUP'S SETTINGS ← Edit this!
├── debriefing.php          # Main page (loads from config)
├── your_logo.png           # YOUR LOGO ← Add this!
├── debriefings/            # YOUR MISSIONS ← Add XML files here!
│   └── mission1.xml
└── vercel.json             # Deployment config
```

## Configuration Options

Edit `config.php` to customize:

| Setting | Description | Example |
|---------|-------------|---------|
| `group_name` | Your squadron/group name | `"335th Fighter Squadron"` |
| `logo_path` | Path to your logo file | `"335th_logo.png"` |
| `logo_alt` | Alt text for logo | `"335th Logo"` |
| `group_link` | Link when clicking logo | `"https://335th.com"` |
| `page_title` | Browser tab title | `"335th Mission Debriefs"` |
| `default_language` | Language code | `"en"`, `"de"`, `"fr"`, etc. |
| `debriefings_path` | Where to find XML files | `"debriefings/*.xml"` |

## Adding Mission Files

**Step 1: Export from Tacview**
1. Open your mission in Tacview
2. Go to: File → Export → XML
3. Save as `.xml` file

**Step 2: Upload to Your Repository**
```bash
# Copy XML files to debriefings folder
cp mission1.xml debriefings/

# Commit and push
git add debriefings/mission1.xml
git commit -m "Add mission debriefing"
git push
```

Vercel automatically redeploys with your new mission!

## Getting Updates from Core

The beauty of the submodule system is you get bug fixes and new features automatically!

```bash
# Update to latest core version
git submodule update --remote core
git add core
git commit -m "Update to latest core version"
git push
```

Core updates might include:
- New aircraft icons
- Bug fixes
- Performance improvements
- New language translations

## Customizing Further

### Change Colors/Styling
1. Fork the core repository: https://github.com/Bigredgeek/PHP-Tacview-Core
2. Edit `tacview.css` in your fork
3. Update your project's submodule to point to your fork:
```bash
# Edit .gitmodules to point to your forked core
git submodule set-url core https://github.com/YOUR_USERNAME/PHP-Tacview-Core.git
git submodule update --remote
```

### Add Custom Features
- Edit `debriefing.php` in your project (not in core/)
- Add custom HTML, PHP logic, or styling
- Your changes won't be overwritten by core updates

## Support & Community

- **Original Project**: https://github.com/Bigredgeek/PHP-Tacview-Core
- **Report Issues**: Create an issue on GitHub
- **Contribute**: Submit pull requests to improve the core!

## Requirements

- PHP 8.0+ (automatically provided by Vercel)
- Tacview XML export files
- Git & GitHub account (free)
- Vercel account for hosting (free tier available)

## Cost

**$0** - Everything can be done for free:
- GitHub hosting (free for public repos)
- Vercel hosting (generous free tier)
- All code is open source

## License

This project is licensed under the MIT License - feel free to use, modify, and share!

## Credits

- Original PHPTacview by Julien "Ezor" Rozé
- Updated by BuzyBee, Vyrtuoz, Khamsin, Aikanaro
- Modernized for PHP 8.2+ by Bigredgeek
- Submodule architecture and configuration system by Bigredgeek

## Examples

See it in action:
- Brownwater: [Your deployed URL here]
- Song of the Nibelungs: [Your deployed URL here]

---

## Quick Command Reference

```bash
# Clone with submodules
git clone --recursive [your-repo-url]

# Update core
git submodule update --remote core

# Add mission
git add debriefings/mission.xml && git commit -m "Add mission" && git push

# Change config
git add config.php && git commit -m "Update settings" && git push
```

## Troubleshooting

**Q: Submodule folder is empty after cloning**
```bash
git submodule init
git submodule update
```

**Q: Icons/images not showing**
- Make sure you cloned with `--recursive` flag
- Check that `core/` folder exists and has files

**Q: Can't see my XML files**
- Verify files are in `debriefings/` folder
- Check that `debriefings_path` in config.php is correct
- Ensure files have `.xml` extension

**Q: Want to customize colors/styling**
- Fork the core repository
- Edit CSS in your fork
- Point your submodule to your fork

---

**Ready to deploy? Start with Option 1 above!** 🚀
