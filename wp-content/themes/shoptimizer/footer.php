<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Shoptimizer
 */

?>

		</div><!-- .col-full -->
	</div><!-- #content -->

</div>

	<?php do_action( 'shoptimizer_before_footer' ); ?>

	<?php
	/**
	 * Functions hooked in to shoptimizer_footer action
	 */
	do_action( 'shoptimizer_footer' );
	?>

	<?php do_action( 'shoptimizer_after_footer' ); ?>


</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>