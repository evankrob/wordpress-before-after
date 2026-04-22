<?php
/**
 * Shared slider renderer. Expects $args + $orientation + $start in scope.
 *
 * @var array  $args
 * @var string $orientation
 * @var int    $start
 */

defined( 'ABSPATH' ) || exit;

$instance_id = 'wpba-' . wp_generate_uuid4();
?>
<div class="wpba-slider-wrap" id="<?php echo esc_attr( $instance_id ); ?>" data-orientation="<?php echo esc_attr( $orientation ); ?>">
	<img-comparison-slider
		value="<?php echo esc_attr( $start ); ?>"
		direction="<?php echo esc_attr( $orientation ); ?>"
	>
		<svg slot="handle" class="wpba-handle-icon" xmlns="http://www.w3.org/2000/svg" viewBox="-20 -20 40 40" width="44" height="44" role="presentation" focusable="false" aria-hidden="true">
			<circle cx="0" cy="0" r="18" fill="white" fill-opacity="0.95"/>
			<path d="M -7 -4 L -11 0 L -7 4 M 7 -4 L 11 0 L 7 4" fill="none" stroke="#111111" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" vector-effect="non-scaling-stroke"/>
		</svg>
		<img
			slot="first"
			src="<?php echo esc_url( $args['before_url'] ); ?>"
			alt="<?php echo esc_attr( $args['before_alt'] ); ?>"
			loading="lazy"
			decoding="async"
		/>
		<img
			slot="second"
			src="<?php echo esc_url( $args['after_url'] ); ?>"
			alt="<?php echo esc_attr( $args['after_alt'] ); ?>"
			loading="lazy"
			decoding="async"
		/>
	</img-comparison-slider>
	<?php if ( '' !== $args['before_label'] ) : ?>
		<span class="wpba-label wpba-label--before"><?php echo esc_html( $args['before_label'] ); ?></span>
	<?php endif; ?>
	<?php if ( '' !== $args['after_label'] ) : ?>
		<span class="wpba-label wpba-label--after"><?php echo esc_html( $args['after_label'] ); ?></span>
	<?php endif; ?>
</div>
<?php
