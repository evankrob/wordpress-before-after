# Before / After Image Slider

A lightweight WordPress plugin for responsive before/after image comparison sliders with a draggable arrow handle. Works out of the box with KadenceWP (and any other block theme).

Ships two ways to embed a slider:

- **Gutenberg block** — media-library pickers, live editor preview, block sidebar controls
- **`[before_after]` shortcode** — for classic editor, widgets, or page builders

## Features

- Horizontal or vertical orientation (per instance)
- Optional "Before" / "After" corner labels
- Per-image alt text for accessibility
- Adjustable starting handle position (0–100%)
- Touch, mouse, and keyboard controls (arrow keys when focused)
- Fully responsive — scales to any container
- Multiple sliders per page, no collisions
- Assets only enqueue on pages that render a slider
- Themeable via CSS custom properties (`--wpba-handle-color`, `--wpba-label-bg`, etc.)

Slider UI is powered by the MIT-licensed [img-comparison-slider](https://img-comparison-slider.sneas.io/) web component, vendored locally — no CDN dependency.

## Installation

### From a release (recommended for users)

1. Download the plugin zip from the [releases page](../../releases).
2. In WordPress: **Plugins → Add New → Upload Plugin**, pick the zip, activate.

### From source (for developers)

```bash
git clone https://github.com/evankrob/wordpress-before-after.git
cd wordpress-before-after
npm install
npm run build
```

Then symlink or copy the folder into `wp-content/plugins/` and activate.

## Usage

### Block

Insert **Before / After Slider** from the block inserter (under *Media*). In the sidebar, pick a Before image and an After image, set optional labels, orientation, and starting position.

### Shortcode

```
[before_after before="123" after="456"]
```

Full attributes:

| Attribute      | Type     | Default       | Description |
|----------------|----------|---------------|-------------|
| `before`       | int      | —             | Attachment ID (preferred — gives responsive `srcset` + alt) |
| `after`        | int      | —             | Attachment ID |
| `before_url`   | url      | —             | Fallback URL if no attachment ID |
| `after_url`    | url      | —             | Fallback URL |
| `before_label` | string   | `""`          | Optional corner label text |
| `after_label`  | string   | `""`          | Optional corner label text |
| `before_alt`   | string   | attachment alt| Alt-text override |
| `after_alt`    | string   | attachment alt| Alt-text override |
| `orientation`  | string   | `horizontal`  | `horizontal` or `vertical` |
| `start`        | int      | `50`          | Starting handle position, 0–100 |

## Theming

Override the CSS custom properties on `.wpba-slider-wrap` (or globally):

```css
.wpba-slider-wrap {
  --wpba-handle-color: #ff5a00;
  --wpba-divider-width: 3px;
  --wpba-label-bg: rgba(20, 20, 20, 0.8);
  --wpba-label-color: #fff;
}
```

## Project structure

```
wordpress-before-after.php    Plugin header + bootstrap
includes/
  class-plugin.php            Block registration, asset loading, shared renderer
  class-shortcode.php         [before_after] handler
  render-slider.php           Shared HTML template (block + shortcode)
src/block/                    Block source — compiled by @wordpress/scripts
build/block/                  Compiled block output (committed so zip installs work)
assets/
  img-comparison-slider.js    Vendored web component (v8.0.6, MIT)
  frontend.css                Frontend styles
```

## Development

```bash
npm run start    # watch mode for src/block
npm run build    # production build
```

## Requirements

- WordPress 6.4+
- PHP 7.4+

## Contributing

Issues and PRs welcome. For larger changes, please open an issue first to discuss.

## License

[GPL-2.0-or-later](LICENSE) — matches WordPress core.

Slider web component: [img-comparison-slider](https://github.com/sneas/img-comparison-slider) (MIT).

---

Developed by [RaleighDigital.com](https://raleighdigital.com).
