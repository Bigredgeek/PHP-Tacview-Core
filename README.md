# PHPTacview Core

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
[![PHP Version](https://img.shields.io/badge/PHP-8.0%2B-blue)](https://www.php.net/)

> **Web-based mission debriefing tool for Tacview XML files**

PHPTacview is a powerful, customizable web application that processes Tacview XML exports to create detailed mission analysis reports. Perfect for DCS World squadrons, flight simulation groups, and any gaming community using Tacview.

![PHPTacview Screenshot](https://via.placeholder.com/800x400?text=PHPTacview+Mission+Debrief) <!-- Add your screenshot -->

## ✨ Features

- 📊 **Detailed Statistics** - Comprehensive mission analysis and pilot performance metrics
- 🎯 **Kill Tracking** - Track air-to-air and air-to-ground kills with detailed breakdowns
- 🖼️ **Aircraft Recognition** - Visual identification with real aircraft photos
- 🌍 **Multi-Language** - Built-in support for EN, DE, ES, FR, IT, PT, RU, UK, and more
- 🎨 **Customizable Branding** - Easy configuration for your squadron logo, colors, and links
- ☁️ **Deploy Anywhere** - Works on Vercel, Netlify, traditional hosting, or localhost
- 🔄 **Modular Architecture** - Core engine separated from customization via Git submodules
- 📱 **Responsive Design** - Works on desktop, tablet, and mobile

## 🚀 Quick Start for New Groups

**Want to deploy your own?** See **[QUICKSTART.md](QUICKSTART.md)** for a complete guide!

**TL;DR:**
1. Fork the [template repository](https://github.com/Bigredgeek/PHP-Tacview-Analysis-For-Brownwater)
2. Edit `config.php` with your squadron details
3. Add your logo
4. Deploy to Vercel (free)
5. Upload your Tacview XML files

**That's it!** ⚡

## 📦 What's in This Repository?

This is the **core engine** that powers PHPTacview. It contains:

- `tacview.php` - Main processing engine
- `tacview.css` - Styling and layout
- `languages/` - Translation files for internationalization
- `categoryIcons/` - Icons for different object categories
- `objectIcons/` - Photos of 200+ aircraft and vehicles
- `data/` - Aircraft manifests and metadata
- `tools/` - Maintenance and icon management scripts

## 🏗️ Architecture

PHPTacview uses a **submodule architecture** that separates the core engine from group-specific customizations:

```
┌─────────────────────────────────────┐
│   Your Group's Repository           │
│  ┌────────────────────────────┐    │
│  │  config.php (your settings) │    │
│  │  your_logo.png              │    │
│  │  debriefings/ (your files)  │    │
│  └────────────────────────────┘    │
│            ↓ uses                   │
│  ┌────────────────────────────┐    │
│  │   core/ (this submodule)    │    │
│  │  - tacview.php              │    │
│  │  - tacview.css              │    │
│  │  - languages/               │    │
│  │  - icons/                   │    │
│  └────────────────────────────┘    │
└─────────────────────────────────────┘
```

**Benefits:**
- ✅ Get bug fixes and new features with one command
- ✅ Your customizations never get overwritten
- ✅ Contribute improvements back to the community
- ✅ Multiple groups can share the same core

## 🛠️ For Developers

### Using as a Submodule

Add this repository to your project:

```bash
git submodule add https://github.com/Bigredgeek/PHP-Tacview-Core.git core
```

Copy and customize the templates:

```bash
cp core/config.example.php config.php
cp core/debriefing-template.php debriefing.php
```

Update to the latest version:

```bash
git submodule update --remote core
git add core
git commit -m "Update core to latest version"
```

### File Structure

```
php-tacview-core/
├── tacview.php              # Main processing engine
├── tacview.css              # Styles and layout
├── config.example.php       # Configuration template
├── debriefing-template.php  # Page template
├── languages/               # Translation files
│   ├── tacview_en.php
│   ├── tacview_de.php
│   └── ...
├── categoryIcons/           # Category icons (aircraft, missiles, etc.)
├── objectIcons/             # Aircraft/vehicle photos (200+)
├── data/
│   └── aircraft_icons_manifest.json
├── tools/                   # Icon management scripts
│   ├── auto_curate_icons.php
│   ├── download_icons.php
│   └── normalize_icons.php
├── QUICKSTART.md           # Deployment guide for groups
└── README.md               # This file
```

## 🌐 Supported Languages

- 🇬🇧 English (EN)
- 🇩🇪 German (DE)
- 🇪🇸 Spanish (ES)
- 🇫🇮 Finnish (FI)
- 🇫🇷 French (FR)
- 🇭🇷 Croatian (HR)
- 🇮🇹 Italian (IT)
- 🇵🇹 Portuguese (PT)
- 🇷🇺 Russian (RU)
- 🇺🇦 Ukrainian (UK)

Want to add your language? Submit a PR with a new translation file!

## 🤝 Contributing

We welcome contributions from the community!

### Ways to Contribute:

- 🐛 **Report bugs** - Create an issue with details
- 💡 **Suggest features** - Open a discussion
- 📷 **Add aircraft icons** - Submit missing aircraft photos
- 🌍 **Translate** - Add or improve language files
- 💻 **Code** - Submit pull requests for fixes/features

### Development

1. Fork this repository
2. Create a feature branch: `git checkout -b feature/amazing-feature`
3. Make your changes
4. Test thoroughly
5. Commit: `git commit -m 'Add amazing feature'`
6. Push: `git push origin feature/amazing-feature`
7. Open a Pull Request

## 📋 Requirements

- **PHP 8.0+** (with strict types support)
- **Tacview** (for generating XML exports)
- **Git** (for version control)

## 🎯 Use Cases

- **DCS World Squadrons** - Analyze combat missions
- **Flight Simulation Groups** - Review training flights
- **Competitive Teams** - Study tactics and performance
- **Content Creators** - Create detailed mission breakdowns
- **Event Organizers** - Provide post-mission reports

## 📜 License

This project is licensed under the **MIT License** - see [LICENSE](LICENSE) file for details.

You are free to:
- ✅ Use commercially
- ✅ Modify
- ✅ Distribute
- ✅ Use privately

## 🙏 Credits

### Original Development
- **Julien "Ezor" Rozé** - Original PHPTacview (2006)

### Major Contributors
- **BuzyBee** - Bug fixes, aircraft photos, new stats (2021-2023)
- **Vyrtuoz** - XML support, optimizations (2015)
- **Khamsin** - XML updates (2015)
- **Aikanaro** - Italian localization, group support (2011)

### Modern Updates
- **Bigredgeek** - PHP 8.2+ modernization, submodule architecture, config system (2025)

### Community
Thanks to all the DCS and flight sim communities for testing and feedback!

## 🔗 Links

- **Core Repository**: https://github.com/Bigredgeek/PHP-Tacview-Core
- **Example Deployment**: [Add your demo URL]
- **Tacview Website**: https://www.tacview.net
- **DCS World**: https://www.digitalcombatsimulator.com

## 📞 Support

- **Issues**: [GitHub Issues](https://github.com/Bigredgeek/PHP-Tacview-Core/issues)
- **Discussions**: [GitHub Discussions](https://github.com/Bigredgeek/PHP-Tacview-Core/discussions)

## 🎖️ Live Deployments

Groups using PHPTacview:
- **Brownwater** - [Add URL]
- **Song of the Nibelungs** - [Add URL]
- *Your group here?* - Submit a PR to add your deployment!

---

**Ready to deploy your own?** Check out **[QUICKSTART.md](QUICKSTART.md)** to get started! 🚀
