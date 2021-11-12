<?php
/**
 *
 * Module PDP Triggers
 *
 * @package CommerceKit
 * @subpackage Shoptimizer
 */

/**
 * Show best rating alert
 */
function commercekit_pdp_triggers_rating_alert() {
	global $product;
	if ( ! wc_review_ratings_enabled() ) {
		return;
	}
	$options    = get_option( 'commercekit', array() );
	$enable_pdp = isset( $options['pdp_triggers'] ) && 1 === (int) $options['pdp_triggers'] ? 1 : 0;
	if ( ! $enable_pdp ) {
		return;
	}
	$rating_count    = $product->get_rating_count();
	$pdp_min_reviews = isset( $options['pdp_min_reviews'] ) ? (int) $options['pdp_min_reviews'] : 0;
	if ( $pdp_min_reviews && $rating_count < $pdp_min_reviews ) {
		return;
	}
	$average         = $product->get_average_rating();
	$average_percent = (int) ( $average * 100 ) / 5;
	if ( $average_percent < 70 ) {
		return;
	}
	$average_percent = $average_percent . '%';
	/* translators: %s: stock counter. */
	$review_text = isset( $options['pdp_review_text'] ) && ! empty( $options['pdp_review_text'] ) ? commercekit_get_multilingual_string( $options['pdp_review_text'] ) : esc_html__( 'Good choice! %s of buyers were satisfied with this.', 'commercegurus-commercekit' );
	?>
<div class="commercekit-review-alert">
	<?php echo esc_html( sprintf( $review_text, $average_percent ) ); ?>
</div>
<style>
	.commercekit-review-alert {
	display: block; width: 100%; font-size: 14px; font-weight: bold; padding-top: 15px; padding-bottom: 3px; border-top: 1px solid #e2e2e2; line-height: 1.45;
	}
</style>
	<?php
}

/**
 * Show best rating alert template
 *
 * @param  string $template_name of template name.
 * @param  string $template_path of template path.
 * @param  string $located of located.
 * @param  string $args of args.
 */
function commercekit_pdp_triggers_rating_alert_template_part( $template_name = '', $template_path = '', $located = '', $args = array() ) {
	if ( 'single-product/rating.php' === $template_name ) {
		commercekit_pdp_triggers_rating_alert();
	}
}
add_action( 'woocommerce_before_template_part', 'commercekit_pdp_triggers_rating_alert_template_part', 98 );
