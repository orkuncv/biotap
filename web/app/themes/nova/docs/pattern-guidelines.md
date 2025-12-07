# Nova Theme Pattern Guidelines

## Overview
This document provides guidelines and standards for creating WordPress block patterns for the Nova theme.

---

## Pattern File Structure

### File Header Template
```php
<?php
/**
 * Title: [Descriptive Pattern Name]
 * Slug: nova/[category]-[descriptive-slug]
 * Categories: [category]
 * Description: [One clear sentence describing the pattern]
 *
 * @author Nova Theme
 * @package Nova
 * @since 1.0.0
 */
?>
```

### Naming Conventions
- **File name**: Use kebab-case (e.g., `hero-feature-list.php`)
- **Slug**: Format `nova/[category]-[name]` (e.g., `nova/hero-feature-list`)
- **Title**: Descriptive, max 50 characters
- **Categories**: Must match registered categories (see below)

---

## Available Categories

| Slug | Label | Description |
|------|-------|-------------|
| `heros` | Heros | Hero sections and large banners |
| `features` | Features | Feature grids and showcases |
| `content` | Content | General content sections |
| `description` | Description | Text with media sections |
| `push` | Push | Call-to-action sections |
| `contact` | Contact | Contact forms and info |
| `social-proof` | Social Proof | Testimonials, stats, logos |
| `header` | Header | Header patterns |
| `footer` | Footer | Footer patterns |

---

## Theme Design Tokens

### Color Palette

**Use with**: `backgroundColor="[slug]"` or `textColor="[slug]"`

| Slug | Hex | Usage |
|------|-----|-------|
| `nova-100` | #414B5A | Primary dark gray, main text, buttons |
| `nova-75` | #7E8C9F | Medium gray, secondary text |
| `nova-50` | #CDDCDF | Light gray, borders |
| `nova-25` | #DCEAED | Very light gray, subtle backgrounds |
| `nova-10` | #EFF5F7 | Almost white, section backgrounds |
| `white` | #FFFFFF | White text/backgrounds |
| `background-primary` | #1C2025 | Dark primary background |
| `background-section` | #2E3339 | Dark section background |
| `wordpress-blue` | #117AC9 | Accent blue, hover states |
| `wordpress-blue-light` | #E8F5FF | Light blue accents |
| `success-green` | #BBFFB0 | Success states |

**Examples**:
```html
<!-- Dark background with white text -->
<div class="wp-block-group has-background-primary-background-color has-white-color">

<!-- Primary button -->
<div class="wp-block-button">
    <a class="wp-block-button__link has-white-color has-nova-100-background-color">
```

---

### Spacing Tokens

**Use with**: `var:preset|spacing|[slug]`

⚠️ **Important**: Avoid spacing tokens with numbers at the start (`3xl`, `4xl`, `5xl`, `6xl`, `7xl`) as they cause block validation errors. Use only: `none`, `xs`, `s`, `m`, `l`, `xl`, `xxl`.

| Slug | Size | Pixels | Use Case |
|------|------|--------|----------|
| `none` | 0 | 0px | No spacing |
| `xs` | 0.25rem | 4px | Tiny gaps (list items) |
| `s` | 0.5rem | 8px | Small gaps |
| `m` | 0.75rem | 12px | Medium gaps |
| `l` | 1rem | 16px | Default gaps |
| `xl` | 1.5rem | 24px | Large gaps |
| `xxl` | 2rem | 32px | Extra large gaps |

**Common spacing patterns**:
```json
// Section padding (top/bottom)
"style":{"spacing":{"padding":{"top":"var:preset|spacing|xxl","bottom":"var:preset|spacing|xxl"}}}

// Column gap
"style":{"spacing":{"blockGap":{"left":"var:preset|spacing|xl"}}}

// Margin between elements
"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|m"}}}
```

---

### Font Sizes

**Use with**: `fontSize="[slug]"`

#### Paragraph Sizes
| Slug | Size | Usage |
|------|------|-------|
| `label` | 0.75rem | Small labels, tags |
| `p-small` | 0.8125rem | Fine print, captions |
| `p-default` | 1rem | Body text (default) |
| `p-large` | 1.125rem | Large body text |
| `p-huge` | 1.5rem | Very large text |
| `p-giga` | 4rem (fluid) | Display text |
| `quote` | 1.75rem | Blockquotes |

#### Heading Sizes
| Slug | Size | Fluid Range | Usage |
|------|------|-------------|-------|
| `xs-heading` | 1rem | - | Small headings (h6) |
| `s-heading` | 1.3125rem | - | Small headings (h5) |
| `m-heading` | 1.75rem | 1.5-1.75rem | Medium headings (h4) |
| `l-heading` | 2.625rem | 1.75-2.625rem | Large headings (h3) |
| `xl-heading` | 3.5rem | 2.25-3.5rem | Extra large (h2) |
| `xxl-heading` | 4.5rem | 2.5-4.5rem | Hero headings (h1) |

**Examples**:
```html
<!-- Hero heading -->
<h1 class="has-xxl-heading-font-size">

<!-- Body text -->
<p class="has-p-default-font-size">

<!-- Small caption -->
<p class="has-p-small-font-size">
```

---

## Content Guidelines

### Translatable Text
All visible text **MUST** use `esc_html_x()` for translation:

```php
<?php echo esc_html_x( 'Text content here', 'Context description', 'nova' ); ?>
```

### Standard Placeholder Text

Use generic, reusable placeholder text:

| Element | Standard Text |
|---------|--------------|
| Over-title | `'A place for the over-title'` |
| Hero heading | `'This is the place for a page title'` |
| Description | `'This is a place for an excerpt. Lorem ipsum dolor sit amet consectetur...'` |
| Feature title | `'Feature name'` |
| Feature description | `'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'` |
| Primary button | `'Primary CTA'` |
| Secondary button | `'Secondary CTA'` |
| Additional info | `'Additional information or social proof'` |

**Example**:
```php
<!-- wp:heading {"level":1,"textAlign":"center","fontSize":"xxl-heading"} -->
<h1 class="wp-block-heading has-text-align-center has-xxl-heading-font-size">
    <?php echo esc_html_x( 'This is the place for a page title', 'Hero title', 'nova' ); ?>
</h1>
<!-- /wp:heading -->
```

---

## Common Block Patterns

### Full-Width Section with Padding

⚠️ **IMPORTANT**: Always add horizontal padding (left/right) to full-width and wide sections for proper mobile spacing!

```html
<!-- wp:group {"align":"full","backgroundColor":"background-primary","style":{"spacing":{"padding":{"top":"var:preset|spacing|xxl","bottom":"var:preset|spacing|xxl","left":"var:preset|spacing|xl","right":"var:preset|spacing|xl"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-background-primary-background-color has-background" style="padding-top:var(--wp--preset--spacing--xxl);padding-bottom:var(--wp--preset--spacing--xxl);padding-left:var(--wp--preset--spacing--xl);padding-right:var(--wp--preset--spacing--xl);">
    <!-- Content here -->
</div>
<!-- /wp:group -->
```

**Standard section padding:**
- **Top/Bottom**: `xxl` (32px) - Vertical spacing between sections
- **Left/Right**: `xl` (24px) - Horizontal spacing for mobile devices
- **Layout**: `{"type":"constrained"}` - Enables inner blocks to use content width

**Why horizontal padding is important:**
- Prevents content from touching screen edges on mobile
- Provides consistent spacing across all devices
- Improves readability and visual comfort

### Two-Column Layout
```html
<!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|xl"}}}} -->
<div class="wp-block-columns alignwide">
    <!-- wp:column -->
    <div class="wp-block-column">
        <!-- Left column content -->
    </div>
    <!-- /wp:column -->

    <!-- wp:column -->
    <div class="wp-block-column">
        <!-- Right column content -->
    </div>
    <!-- /wp:column -->
</div>
<!-- /wp:columns -->
```

### Primary Button
```html
<!-- wp:buttons -->
<div class="wp-block-buttons">
    <!-- wp:button {"backgroundColor":"nova-100","textColor":"white"} -->
    <div class="wp-block-button">
        <a class="wp-block-button__link has-white-color has-nova-100-background-color has-text-color has-background wp-element-button">
            <?php echo esc_html_x( 'Primary CTA', 'Button text', 'nova' ); ?>
        </a>
    </div>
    <!-- /wp:button -->
</div>
<!-- /wp:buttons -->
```

### Secondary Button (Outline)
```html
<!-- wp:button {"className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline">
    <a class="wp-block-button__link wp-element-button">
        <?php echo esc_html_x( 'Secondary CTA', 'Button text', 'nova' ); ?>
    </a>
</div>
<!-- /wp:button -->
```

### Centered Heading
```html
<!-- wp:heading {"level":2,"textAlign":"center","fontSize":"xl-heading"} -->
<h2 class="wp-block-heading has-text-align-center has-xl-heading-font-size">
    <?php echo esc_html_x( 'Section heading', 'Section title', 'nova' ); ?>
</h2>
<!-- /wp:heading -->
```

---

## Best Practices

### ✅ DO:
- Use theme color slugs (`nova-100`, `white`, etc.)
- Use theme spacing tokens (`xs`, `s`, `m`, `l`, `xl`, `xxl`)
- Use theme font size presets (`p-default`, `xl-heading`, etc.)
- Make all text translatable with `esc_html_x()`
- Use semantic HTML structure
- Keep placeholder text generic and reusable
- Match visual hierarchy from design

### ❌ DON'T:
- Hardcode hex colors (e.g., `#FF0000`)
- Hardcode pixel values (e.g., `fontSize:"16px"`)
- Use spacing tokens with numbers (`3xl`, `4xl`, `5xl`, `6xl`, `7xl`)
- Skip translation functions
- Use project-specific text in patterns
- Add unnecessary custom CSS classes

---

## Layout Widths

| Alignment | Width | Usage |
|-----------|-------|-------|
| Default (constrained) | 760px | Regular content |
| `align="wide"` | 1200px | Wide content |
| `align="full"` | 1440px | Full-width sections |

**Example**:
```html
<!-- Full-width hero -->
<!-- wp:group {"align":"full"} -->

<!-- Wide content section -->
<!-- wp:group {"align":"wide"} -->

<!-- Regular content (no align needed) -->
<!-- wp:group {"layout":{"type":"constrained"}} -->
```

---

## Button Variations

| Style | Class | Usage |
|-------|-------|-------|
| Default (filled) | - | Primary actions |
| Outline | `is-style-outline` | Secondary actions |
| Rounded | `is-style-rounded` | Alternative style |
| Rounded Outline | `is-style-rounded-outline` | Alternative outline |

---

## Quick Reference Checklist

When creating a new pattern:

- [ ] File header with Title, Slug, Categories, Description
- [ ] Use only theme color presets (no hex colors)
- [ ] Use only theme spacing tokens (avoid `3xl`, `4xl`, etc.)
- [ ] Use theme font size presets (no hardcoded sizes)
- [ ] All text uses `esc_html_x()` for translation
- [ ] Generic placeholder text (not project-specific)
- [ ] Proper semantic HTML structure
- [ ] **Add horizontal padding (`left` + `right`) to full-width/wide sections**
- [ ] Add `"layout":{"type":"constrained"}` to enable content width
- [ ] Pattern tested in Gutenberg editor
- [ ] No block validation errors

---

## Resources

- **Theme JSON**: `/theme.json` - All available design tokens
- **Pattern Categories**: `/inc/classes/theme/class-theme-setup.php` - Category registration
- **Example Patterns**: `/patterns/` - Reference existing patterns
- **Documentation**: `/docs/` - Additional theme documentation

---

**Last updated**: December 2024
**Version**: 1.0.0
