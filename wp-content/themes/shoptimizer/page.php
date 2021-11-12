<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
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

<?php do_action( 'shoptimizer_page_sidebar' ); ?>


<?php
get_footer();

