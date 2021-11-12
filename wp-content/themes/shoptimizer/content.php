<?php
/**
 * Template used to display post content.
 *
 * @package shoptimizer
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php
	/**
	 * Functions hooked in to shoptimizer_loop_post action.
	 *
	 * @hooked shoptimizer_post_header          - 10
	 * @hooked shoptimizer_post_meta            - 20
	 * @hooked shoptimizer_post_content         - 30
	 */
	do_action( 'shoptimizer_loop_post' );
	?>

</article><!-- #post-## -->
