<?php
/**
 * Plugin Name:       Before / After Image Slider
 * Plugin URI:        https://github.com/evankroberts/wordpress-before-after
 * Description:       Responsive before/after image comparison slider with a draggable arrow handle. Ships a Gutenberg block and a [before_after] shortcode.
 * Version:           0.1.0
 * Requires at least: 6.4
 * Requires PHP:      7.4
 * Author:            Evan Roberts
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       wpba
 */

defined( 'ABSPATH' ) || exit;

define( 'WPBA_VERSION', '0.1.0' );
define( 'WPBA_PLUGIN_FILE', __FILE__ );
define( 'WPBA_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'WPBA_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

require_once WPBA_PLUGIN_DIR . 'includes/class-plugin.php';

add_action( 'plugins_loaded', [ 'WPBA\\Plugin', 'boot' ] );
