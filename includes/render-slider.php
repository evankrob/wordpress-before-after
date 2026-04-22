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
