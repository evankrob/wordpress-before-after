<?php
namespace WPBA;

defined( 'ABSPATH' ) || exit;

require_once WPBA_PLUGIN_DIR . 'includes/class-shortcode.php';

class Plugin {

	const BLOCK_NAME = 'wpba/before-after';
	const HANDLE_JS  = 'wpba-slider';
	const HANDLE_CSS = 'wpba-slider';

	public static function boot() {
		add_action( 'init', [ __CLASS__, 'register_assets' ] );
		add_action( 'init', [ __CLASS__, 'register_block' ] );

		Shortcode::register();
	}

	public static function register_block() {
		$block_dir = WPBA_PLUGIN_DIR . 'build/block';
		if ( ! file_exists( $block_dir . '/block.json' ) ) {
			return;
		}

		register_block_type(
			$block_dir,
			[
				'render_callback' => [ __CLASS__, 'render_block' ],
			]
		);
	}

	public static function render_block( $attributes ) {
		$before = $attributes['beforeImage'] ?? [];
		$after  = $attributes['afterImage'] ?? [];

		$args = [
			'before_url'    => $before['url'] ?? '',
			'after_url'     => $after['url'] ?? '',
			'before_alt'    => $before['alt'] ?? '',
			'after_alt'     => $after['alt'] ?? '',
			'before_label'  => $attributes['beforeLabel'] ?? '',
			'after_label'   => $attributes['afterLabel'] ?? '',
			'orientation'   => $attributes['orientation'] ?? 'horizontal',
			'start'         => isset( $attributes['startPosition'] ) ? (int) $attributes['startPosition'] : 50,
		];

		return self::render_slider( $args );
	}

	/**
	 * Shared renderer for both block and shortcode.
	 */
	public static function render_slider( array $args ) {
		$defaults = [
			'before_url'   => '',
			'after_url'    => '',
			'before_alt'   => '',
			'after_alt'    => '',
			'before_label' => '',
			'after_label'  => '',
			'orientation'  => 'horizontal',
			'start'        => 50,
		];
		$args = array_merge( $defaults, $args );

		if ( empty( $args['before_url'] ) || empty( $args['after_url'] ) ) {
			return '';
		}

		$orientation = in_array( $args['orientation'], [ 'horizontal', 'vertical' ], true )
			? $args['orientation']
			: 'horizontal';

		$start = max( 0, min( 100, (int) $args['start'] ) );

		self::enqueue_assets();

		ob_start();
		include WPBA_PLUGIN_DIR . 'includes/render-slider.php';
		return ob_get_clean();
	}

	public static function register_assets() {
		wp_register_script(
			self::HANDLE_JS,
			WPBA_PLUGIN_URL . 'assets/img-comparison-slider.js',
			[],
			WPBA_VERSION,
			true
		);

		wp_register_style(
			self::HANDLE_CSS,
			WPBA_PLUGIN_URL . 'assets/frontend.css',
			[],
			WPBA_VERSION
		);
	}

	public static function enqueue_assets() {
		wp_enqueue_script( self::HANDLE_JS );
		wp_enqueue_style( self::HANDLE_CSS );
	}
}
