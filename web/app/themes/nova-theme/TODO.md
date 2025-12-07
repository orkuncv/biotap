# Nova Theme Development TODO

## Core Theme Files

### Basic Structure
- [x] theme.json - Theme configuration with Nova branding
- [x] style.css - Theme header and base styles
- [x] functions.php - Main theme bootstrap
- [x] screenshot.png - Theme screenshot (1200x900px)
- [x] README.md - Theme documentation

### Configuration
- [x] inc/constants.php - Define theme constants (paths, version, text domain)
- [x] inc/autoloader.php - PSR-4 autoloader for classes
- [x] inc/bootstrap.php - Initialize theme services

### Theme Setup
- [x] inc/classes/Nova.php - Main theme class (container/service provider)
- [x] inc/classes/theme/Theme_Setup.php - Register theme support, menus, etc.
- [x] inc/classes/theme/class-container.php - DI container
- [x] inc/functions/helper-functions.php - Global helper functions (nova() accessor)

## Templates & Parts

### Template Parts
- [x] parts/header.html - Site header
- [x] parts/footer.html - Site footer

### Templates
- [x] templates/index.html - Default template
- [x] templates/home.html - Homepage template
- [x] templates/page.html - Single page template
- [x] templates/single.html - Single post template
- [x] templates/archive.html - Archive template
- [x] templates/404.html - 404 error page
- [x] templates/search.html - Search results template

## Assets

### Fonts
- [x] assets/fonts/lexend/ - Copy Lexend font

### CSS
- [x] assets/css/imports.css - Main CSS import file
- [x] assets/css/utilities.css - Utility classes

### Images
- [x] assets/images/favicon.png - Site favicon
- [x] assets/images/placeholder.jpg - Placeholder image

## Custom Blocks

### Essential Blocks Only
- [x] inc/classes/blocks/class-blocks-header-logo.php - Custom header logo block
- [x] inc/classes/blocks/class-blocks-footer-logo.php - Custom footer logo block
- [x] inc/classes/contracts/class-contracts-gutenberg-block.php - Block interface
- [x] inc/classes/support/class-support-gutenberg-blocks.php - Block registration

## Block Patterns

### Header Patterns
- [x] patterns/headers/header-stacked-search.php - Header with stacked layout and search

### Footer Patterns
- [x] patterns/footers/footer-stacked.php - Stacked footer with menus and social links

## Helper Functions
- [x] inc/functions/helper-functions.php - Global helper functions (nova() container accessor, nova_get_post_by_title())

## WP-CLI Commands

### Child Theme Command
- [x] inc/classes/console/class-console-create-child-theme.php - WP-CLI command: wp nova create child-theme
- [x] inc/stubs/nova-child/ - Child theme template files
  - [x] style.css - Child theme header
  - [x] functions.php - Child theme bootstrap
  - [x] readme.txt - Documentation
  - [x] screenshot.png - Theme screenshot
  - [x] imports.css - CSS imports
  - [x] variables.css - Custom CSS variables
  - [x] bootstrap.php - Child theme initialization
  - [x] class-child-theme-setup.php - Child theme setup class
  - [x] nova-child.json - Child theme style variation

## Exclude from Nova (Too Complex)

### Not Implementing
- Admin panel customizations
- AI/Agent functionality
- Performance optimizations (Redis, cache, etc.)
- Custom post type builder
- Translation system
- Basic auth
- CMS importer
- SEO tools
- User activity logs
- Cron jobs
- Advanced custom blocks

## Implementation Priority

### Phase 1: Minimal Viable Theme
1. Core files (style.css, functions.php, constants, autoloader, bootstrap)
2. Main Nova class and Theme_Setup
3. Basic templates (index, page, single)
4. Template parts (header, footer)
5. Copy fonts
6. Basic CSS imports

### Phase 2: Enhanced Features
1. All templates (archive, 404, search, home)
2. Custom logo blocks
3. Helper functions
4. Additional CSS utilities

### Phase 3: Optional Additions
1. WP-CLI child theme command
2. Basic block patterns
3. Additional custom blocks

## Notes

### Naming Conventions
- Text domain: nova
- Function prefix: nova_
- Class namespace: Nova\
- Constants prefix: NOVA_
- CSS variables: --nova-*
- Option names: nova_*

### File Organization
- Classes use PSR-4 autoloading
- Class files: class-{name}.php (lowercase, hyphens)
- Class names: CamelCase
- Namespaces follow directory structure

### Keep It Simple
- No admin panels
- No complex features
- Focus on clean, maintainable code
- Use WordPress defaults where possible
- FSE-first approach (Full Site Editing)
