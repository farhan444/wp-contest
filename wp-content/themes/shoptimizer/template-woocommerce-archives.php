<?php
/**
 * To use with a shortcode and need the mobile filters toggle to appear. Standard WP filter widgets will NOT appear with a shortcode on the page. Requires FacetWP or another plugin solution.
 *
 * Template Name: WooCommerce Archives
 *
 * @package shoptimizer
 */


get_header();

do_action( 'shoptimizer_page_start' );

?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<?php while ( have_posts() ) : the_post();

				do_action( 'shoptimizer_page_before' );

				get_template_part( 'content', 'page' );

				/**
				 * Functions hooked in to shoptimizer_page_after action
				 *
				 * @hooked shoptimizer_display_comments - 10
				 */
				do_action( 'shoptimizer_page_after' );

			endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->


<div class="secondary-wrapper">
<div id="secondary" class="widget-area" role="complementary">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</div><!-- #secondary -->
<div class="filters close-drawer"></div>
</div>

<?php
get_footer();

