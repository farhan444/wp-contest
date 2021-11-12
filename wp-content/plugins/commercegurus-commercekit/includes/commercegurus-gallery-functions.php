<?php
/**
 * Main functions for rendering gallery html and tweaks to PDP's for compatibility with other plugins
 *
 * @author   CommerceGurus
 * @package  CommerceGurus_Gallery
 * @since    1.0.0
 */

/**
 * Get html for the main PDP gallery.
 *
 * Hooks: woocommerce_gallery_thumbnail_size, woocommerce_gallery_image_size and woocommerce_gallery_full_size accept name based image sizes, or an array of width/height values.
 *
 * @since 1.0.0
 * @param int  $attachment_id Attachment ID.
 * @param bool $main_image Is this the main image or a thumbnail?.
 * @return string
 */
function commercegurus_get_main_gallery_image_html( $attachment_id, $main_image = false ) {
	$gallery_thumbnail = wc_get_image_size( 'gallery_thumbnail' );
	$thumbnail_size    = apply_filters( 'woocommerce_gallery_thumbnail_size', array( $gallery_thumbnail['width'], $gallery_thumbnail['height'] ) );
	$image_size        = 'woocommerce_single';
	$full_size         = apply_filters( 'woocommerce_gallery_full_size', apply_filters( 'woocommerce_product_thumbnails_large_size', 'full' ) );
	$thumbnail_src     = wp_get_attachment_image_src( $attachment_id, $thumbnail_size );
	$full_src          = wp_get_attachment_image_src( $attachment_id, $full_size );
	$full_srcset       = wp_get_attachment_image_srcset( $attachment_id, $full_size );
	$alt_text          = trim( wp_strip_all_tags( get_post_meta( $attachment_id, '_wp_attachment_image_alt', true ) ) );
	$image             = wp_get_attachment_image(
		$attachment_id,
		$image_size,
		false,
		apply_filters(
			'woocommerce_gallery_image_html_attachment_image_params',
			array(
				'title'        => _wp_specialchars( get_post_field( 'post_title', $attachment_id ), ENT_QUOTES, 'UTF-8', true ),
				'data-caption' => _wp_specialchars( get_post_field( 'post_excerpt', $attachment_id ), ENT_QUOTES, 'UTF-8', true ),
				'class'        => '',
			),
			$attachment_id,
			$image_size,
			$main_image
		)
	);
	return '<li class="swiper-slide" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
	  <a class="swiper-slide-imglink" title="click to zoom-in" href="' . esc_url( $full_src[0] ) . '" itemprop="contentUrl" data-size="' . esc_attr( $full_src[1] ) . 'x' . esc_attr( $full_src[2] ) . '">
		' . $image . '
	  </a>
	</li>';
}

/**
 * Get lazy html for the main PDP gallery. Used for all images after the first one.
 *
 * Hooks: woocommerce_gallery_thumbnail_size, woocommerce_gallery_image_size and woocommerce_gallery_full_size accept name based image sizes, or an array of width/height values.
 *
 * @since 1.0.0
 * @param int  $attachment_id Attachment ID.
 * @param bool $main_image Is this the main image or a thumbnail?.
 * @return string
 */
function commercegurus_get_main_gallery_image_lazy_html( $attachment_id, $main_image = false ) {
	$gallery_thumbnail = wc_get_image_size( 'gallery_thumbnail' );
	$thumbnail_size    = apply_filters( 'woocommerce_gallery_thumbnail_size', array( $gallery_thumbnail['width'], $gallery_thumbnail['height'] ) );
	$image_size        = 'woocommerce_single';
	$full_size         = apply_filters( 'woocommerce_gallery_full_size', apply_filters( 'woocommerce_product_thumbnails_large_size', 'full' ) );
	$thumbnail_src     = wp_get_attachment_image_src( $attachment_id, $thumbnail_size );
	$full_src          = wp_get_attachment_image_src( $attachment_id, $full_size );
	$full_srcset       = wp_get_attachment_image_srcset( $attachment_id, $full_size );
	$alt_text          = trim( wp_strip_all_tags( get_post_meta( $attachment_id, '_wp_attachment_image_alt', true ) ) );

	$placeholder = CKIT_URI . 'assets/images/spacer.png';

	$image = wp_get_attachment_image(
		$attachment_id,
		$image_size,
		false,
		apply_filters(
			'woocommerce_gallery_image_html_attachment_image_params',
			array(
				'title'        => _wp_specialchars( get_post_field( 'post_title', $attachment_id ), ENT_QUOTES, 'UTF-8', true ),
				'data-caption' => _wp_specialchars( get_post_field( 'post_excerpt', $attachment_id ), ENT_QUOTES, 'UTF-8', true ),
				'class'        => '',
			),
			$attachment_id,
			$image_size,
			$main_image
		)
	);
	return '<li class="swiper-slide" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
	  <a class="swiper-slide-imglink" title="click to zoom-in" href="' . esc_url( $full_src[0] ) . '" itemprop="contentUrl" data-size="' . esc_attr( $full_src[1] ) . 'x' . esc_attr( $full_src[2] ) . '">
		<img width="' . esc_attr( $full_src[1] ) . '" height="' . esc_attr( $full_src[2] ) . '" src="' . $placeholder . '" data-src="' . esc_url( $full_src[0] ) . '" data-srcset="' . $full_srcset . '" sizes="(max-width: 360px) 330px, (max-width: 800px) 100vw, 800px" alt="' . $alt_text . '" itemprop="thumbnail" class="pdp-img swiper-lazy" />
		<div class="cg-swiper-preloader"></div>
	  </a>
	</li>';
}

/**
 * Get html for the small thumbnail gallery under the main PDP gallery.
 *
 * Hooks: woocommerce_gallery_thumbnail_size, woocommerce_gallery_image_size and woocommerce_gallery_full_size accept name based image sizes, or an array of width/height values.
 *
 * @since 1.0.0
 * @param int  $attachment_id Attachment ID.
 * @param bool $main_image Is this the main image or a thumbnail?.
 * @return string
 */
function commercegurus_get_thumbnail_gallery_image_html( $attachment_id, $main_image = false ) {
	$gallery_thumbnail = wc_get_image_size( 'gallery_thumbnail' );
	$thumbnail_size    = apply_filters( 'woocommerce_gallery_thumbnail_size', array( $gallery_thumbnail['width'], $gallery_thumbnail['height'] ) );
	$image_size        = 'woocommerce_gallery_thumbnail';
	$full_size         = apply_filters( 'woocommerce_gallery_full_size', apply_filters( 'woocommerce_product_thumbnails_large_size', 'full' ) );
	$thumbnail_src     = wp_get_attachment_image_src( $attachment_id, $thumbnail_size );
	$full_src          = wp_get_attachment_image_src( $attachment_id, $full_size );
	$alt_text          = trim( wp_strip_all_tags( get_post_meta( $attachment_id, '_wp_attachment_image_alt', true ) ) );
	$image             = wp_get_attachment_image(
		$attachment_id,
		$image_size,
		false,
		apply_filters(
			'woocommerce_gallery_image_html_attachment_image_params',
			array(
				'title'        => _wp_specialchars( get_post_field( 'post_title', $attachment_id ), ENT_QUOTES, 'UTF-8', true ),
				'data-caption' => _wp_specialchars( get_post_field( 'post_excerpt', $attachment_id ), ENT_QUOTES, 'UTF-8', true ),
				'class'        => '',
			),
			$attachment_id,
			$image_size,
			$main_image
		)
	);

	return '	<div class="swiper-slide" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
		' . $image . '
	</div>
';
}

/**
 * Remove elementors swiper instance.
 */
function remove_elementor_scripts() {
	if ( function_exists( 'is_product' ) && is_product() && in_array( 'elementor/elementor.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ), true ) ) {
		wp_dequeue_script( 'swiper' );
		wp_deregister_script( 'swiper' );
	}
}
// TODO - add condition to check if elementor is installed and remove their swiperjs if so.
add_action( 'wp_enqueue_scripts', 'remove_elementor_scripts' );
