<?php
/**
 * The template for displaying all single posts.
 *
 * @package shoptimizer
 */

$shoptimizer_layout_post_sidebar	 				= '';
$shoptimizer_layout_post_sidebar	 				= shoptimizer_get_option( 'shoptimizer_layout_post_sidebar' );

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php while ( have_posts() ) : the_post();

			do_action( 'shoptimizer_single_post_before' );

			get_template_part( 'content', 'single' );

			do_action( 'shoptimizer_single_post_after' );

		endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php if ( 'no-post-sidebar' !== $shoptimizer_layout_post_sidebar ) { ?>
<div id="secondary" class="widget-area" role="complementary">
	<?php dynamic_sidebar( 'sidebar-posts' ); ?>
</div><!-- #secondary -->
<?php } ?>

<?php
get_footer();
