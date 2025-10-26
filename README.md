# PHPTacview Core

This is the shared core library for PHPTacview debriefing tool.

## Usage

This repository is meant to be used as a Git submodule in your group-specific projects.

### Setup in your project:

1. **Add this repository as a submodule:**
   ```bash
   git submodule add <repository-url> core
   ```

2. **Copy the configuration template:**
   ```bash
   cp core/config.example.php config.php
   ```

3. **Edit `config.php` with your group-specific settings:**
   - Group name and logo
   - Website link
   - Paths

4. **Copy the debriefing template:**
   ```bash
   cp core/debriefing-template.php debriefing.php
   ```

5. **Create a `debriefings/` folder for your XML files**

### Updating the core:

When updates are available in the core:

```bash
git submodule update --remote core
git add core
git commit -m "Update core to latest version"
git push
```

### Project Structure:

Your project should look like this:
```
your-project/
├── core/                    # Submodule (this repository)
│   ├── tacview.php
│   ├── tacview.css
│   ├── languages/
│   ├── objectIcons/
│   └── ...
├── config.php              # Your group-specific config
├── debriefing.php          # Your customized debriefing page
├── your_logo.png           # Your group logo
├── debriefings/            # Your mission XML files
└── vercel.json             # Your deployment config
```

## Shared Files

- `tacview.php` - Core processing library
- `tacview.css` - Stylesheet
- `languages/` - Translation files
- `categoryIcons/` - Category icons
- `objectIcons/` - Object/aircraft icons
- `data/` - Aircraft manifest and data files
- `tools/` - Maintenance scripts

## Version History

See individual project repositories for version history.
