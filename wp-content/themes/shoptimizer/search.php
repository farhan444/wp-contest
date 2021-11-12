<?php
/**
 * The template for displaying search results pages.
 *
 * @package shoptimizer
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( esc_attr__( 'Search Results for: %s', 'shoptimizer' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header><!-- .page-header -->

			<?php
			get_template_part( 'content', 'search' );

		else :

			get_template_part( 'content', 'none' );

		endif;
		?>

		<div class="search-pagination"><?php posts_nav_link(); ?></div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
do_action( 'shoptimizer_sidebar' );
get_footer();
