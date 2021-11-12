<?php
/**
 * Template used to display post content on single pages.
 *
 * @package shoptimizer
 */

?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php
	do_action( 'shoptimizer_single_post_top' );

	/**
	 * Functions hooked into shoptimizer_single_post add_action
	 *
	 * @hooked shoptimizer_post_header          - 10
	 * @hooked shoptimizer_post_meta            - 20
	 * @hooked shoptimizer_post_content         - 30
	 */
	do_action( 'shoptimizer_single_post' );

	/**
	 * Functions hooked in to shoptimizer_single_post_bottom action
	 *
	 * @hooked shoptimizer_post_nav         - 10
	 * @hooked shoptimizer_display_comments - 20
	 */
	do_action( 'shoptimizer_single_post_bottom' );
	?>

</div><!-- #post-## -->
