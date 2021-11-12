<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package shoptimizer
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}

$shoptimizer_layout_woocommerce_sidebar	 				= '';
$shoptimizer_layout_woocommerce_sidebar	 				= shoptimizer_get_option( 'shoptimizer_layout_woocommerce_sidebar' );
?>

<?php if ( 'no-woocommerce-sidebar' !== $shoptimizer_layout_woocommerce_sidebar ) { ?>
<div class="secondary-wrapper">
<div id="secondary" class="widget-area" role="complementary">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</div><!-- #secondary -->
<div class="filters close-drawer"></div>
</div>
<?php } ?>
