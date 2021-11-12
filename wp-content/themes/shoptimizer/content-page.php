<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package shoptimizer
 */

?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	/**
	 * Functions hooked in to shoptimizer_page add_action
	 *
	 * @hooked shoptimizer_page_header          - 10
	 * @hooked shoptimizer_page_content         - 20
	 */
	do_action( 'shoptimizer_page' );
	?>
</div><!-- #post-## -->
