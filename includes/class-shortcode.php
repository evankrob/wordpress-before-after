<?php
namespace WPBA;

defined( 'ABSPATH' ) || exit;

class Shortcode {

	const TAG = 'before_after';

	public static function register() {
		add_shortcode( self::TAG, [ __CLASS__, 'render' ] );
	}

	public static function render( $atts ) {
		$atts = shortcode_atts(
			[
				'before'       => '',
				'after'        => '',
				'before_url'   => '',
				'after_url'    => '',
				'before_label' => '',
				'after_label'  => '',
				'before_alt'   => '',
				'after_alt'    => '',
				'orientation'  => 'horizontal',
				'start'        => 50,
			],
			$atts,
			self::TAG
		);

		$before = self::resolve_image( $atts['before'], $atts['before_url'], $atts['before_alt'] );
		$after  = self::resolve_image( $atts['after'], $atts['after_url'], $atts['after_alt'] );

		return Plugin::render_slider(
			[
				'before_url'   => $before['url'],
				'after_url'    => $after['url'],
				'before_alt'   => $before['alt'],
				'after_alt'    => $after['alt'],
				'before_label' => $atts['before_label'],
				'after_label'  => $atts['after_label'],
				'orientation'  => $atts['orientation'],
				'start'        => (int) $atts['start'],
			]
		);
	}

	/**
	 * Prefer attachment ID (gives us srcset + real alt text), fall back to raw URL.
	 */
	private static function resolve_image( $id, $url, $alt_override ) {
		$id = (int) $id;
		if ( $id > 0 ) {
			$src = wp_get_attachment_image_url( $id, 'large' );
			if ( $src ) {
				$alt = $alt_override !== '' ? $alt_override : (string) get_post_meta( $id, '_wp_attachment_image_alt', true );
				return [ 'url' => $src, 'alt' => $alt ];
			}
		}
		return [ 'url' => esc_url_raw( $url ), 'alt' => $alt_override ];
	}
}
