=== Before / After Image Slider ===
Contributors: evankroberts
Tags: before after, image comparison, slider, gutenberg block, kadence
Requires at least: 6.4
Tested up to: 6.7
Requires PHP: 7.4
Stable tag: 0.1.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Responsive before/after image comparison slider with a draggable arrow handle. Ships a Gutenberg block (compatible with KadenceWP) and a [before_after] shortcode.

== Description ==

Upload two images — a "before" and an "after" — and let visitors drag a handle to reveal one over the other. Works in the block editor (including Kadence themes/blocks) and as a shortcode for classic editor, widgets, or page builders.

Features:

* Gutenberg block with media-library pickers and live editor preview
* `[before_after]` shortcode with attachment-ID or URL inputs
* Horizontal or vertical orientation, per instance
* Optional "Before" / "After" text labels
* Per-image alt text for accessibility
* Adjustable starting handle position
* Responsive, touch-friendly, keyboard-accessible (arrow keys)
* Multiple sliders per page with no collisions
* Assets only load on pages that actually use the slider

== Installation ==

1. Upload the plugin folder to `/wp-content/plugins/`.
2. Run `npm install && npm run build` in the plugin folder to compile the block (one-time, only needed if editing the block UI).
3. Activate the plugin through the Plugins screen in WordPress.
4. Insert the **Before / After Slider** block, or use the `[before_after]` shortcode.

== Shortcode usage ==

`[before_after before="123" after="456" before_label="Before" after_label="After" orientation="horizontal" start="50"]`

Attributes:

* `before`, `after` — media attachment IDs (preferred)
* `before_url`, `after_url` — fallback raw image URLs
* `before_label`, `after_label` — optional corner labels
* `before_alt`, `after_alt` — alt text overrides
* `orientation` — `horizontal` (default) or `vertical`
* `start` — 0–100 initial handle position (default 50)

== Credits ==

Slider UI powered by [img-comparison-slider](https://img-comparison-slider.sneas.io/) (MIT).

== Changelog ==

= 0.1.0 =
* Initial release.
