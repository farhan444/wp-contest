<?php
/**
 * Main CommerceGurus Gallery template
 *
 * @author   CommerceGurus
 * @package  CommerceGurus_Gallery
 * @since    1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $product;
$post_thumbnail_id = $product->get_image_id();
$wrapper_classes   = apply_filters(
	'woocommerce_single_product_image_gallery_classes',
	array(
		'images',
	)
);

$options        = get_option( 'commercekit', array() );
$pdp_lightbox   = ( ( isset( $options['pdp_lightbox'] ) && 1 === (int) $options['pdp_lightbox'] ) || ! isset( $options['pdp_lightbox'] ) ) ? true : false;
$pdp_thumbnails = isset( $options['pdp_thumbnails'] ) && ! empty( $options['pdp_thumbnails'] ) ? (int) $options['pdp_thumbnails'] : 4;
$pdp_thub_count = 0;
?>
<style>
	.swiper-container {
		width: 100%;
		height: 100%;
	}
	ul.swiper-wrapper {
		padding: 0;
		margin: 0;
	}
	.swiper-slide {
		text-align: center;
		font-size: 18px;
		background: #fff;
		/* Center slide text vertically */
		display: -webkit-box;
		display: -ms-flexbox;
		display: -webkit-flex;
		display: flex;
		-webkit-box-pack: center;
		-ms-flex-pack: center;
		-webkit-justify-content: center;
		justify-content: center;
		-webkit-box-align: center;
		-ms-flex-align: center;
		-webkit-align-items: center;
		align-items: center;
		height: auto;
	}
	.swiper-slide-imglink {
		height: auto;
		width: 100%;
	}
	.swiper-container {
		width: 100%;
		margin-left: auto;
		margin-right: auto;
	}
	.cg-main-swiper {
		height: auto;
		width: 100%;
	}
	.cg-thumb-swiper {
		height: 20%;
		box-sizing: border-box;
		padding: 10px 0;
	}
	.cg-thumb-swiper .swiper-slide {
		height: 100%;
		opacity: 0.4;
	}
	.cg-thumb-swiper .swiper-slide-thumb-active {
		opacity: 1;
	}
	.swiper-slide img {
		display: block;
		width: 100%;
		height: auto;
	}
	.swiper-button-next, .swiper-button-prev {
		background-image: none;
	}
	.gallery-hide {
		display: none;
	}
	.gallery-show {
		display: block;
	}
	.cg-swiper-preloader {
		width: 42px;
		height: 42px;
		position: absolute;
		left: 50%;
		top: 50%;
		margin-left: -21px;
		margin-top: -21px;
		z-index: 10;
		transform-origin: 50%;
		animation: swiper-preloader-spin 1s infinite linear;
		box-sizing: border-box;
		border: 4px solid var(--swiper-preloader-color,var(--swiper-theme-color));
		border-radius: 50%;
		border-top-color: transparent;
	}
	.elementor-invisible {
		visibility: visible;
	}
	.swiper-button-next.swiper-button-disabled,
	.swiper-button-prev.swiper-button-disabled {
		visibility: hidden;
	}
	.cg-thumbs-3.cg-thumb-swiper .swiper-slide { width: 33.3333%; }
	.cg-thumbs-4.cg-thumb-swiper .swiper-slide { width: 25%; }
	.cg-thumbs-5.cg-thumb-swiper .swiper-slide { width: 20%; }
	.cg-thumbs-6.cg-thumb-swiper .swiper-slide { width: 16.6666%; }
	.cg-thumbs-7.cg-thumb-swiper .swiper-slide { width: 14.2857%; }
	.cg-thumbs-8.cg-thumb-swiper .swiper-slide { width: 12.5%; }

	.pswp button.pswp__button {
		background-color: transparent;
	}

	/* Hide prev arrow if swiper not initialized */
	.swiper-container:not(.swiper-container-initialized) .swiper-button-prev {
		visibility: hidden;
	}

	/* If 2 or 3 gallery thumbnails present - center the thumbnails row initially to prevent CLS */
	.cg-thumbs-count-2:not(.swiper-container-initialized) .swiper-wrapper, 
	.cg-thumbs-count-3:not(.swiper-container-initialized) .swiper-wrapper {
		justify-content: center;
	}

	/* Fix for gallery thumbnails readjusting position as they load */
	#commercegurus-pdp-gallery {
		margin-left: -5px;
		margin-right: -5px;
	}
	.cg-main-swiper.swiper-container  {
		margin: 0 5px;
	}
	.cg-thumb-swiper.swiper-container {
		width: calc(100% + 10px);
	}
	.cg-thumb-swiper .swiper-slide {
		padding-left: 5px;
		padding-right: 5px;
		background-color: transparent;
	}
	.site-content ul li.swiper-slide {
		margin: 0;
	}

	<?php if ( ! $pdp_lightbox ) { ?>
	.swiper-slide-imglink {
		cursor: default;
	}
	<?php } ?>
</style>
<div id="commercegurus-pdp-gallery" class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?>">
	<div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff" class="swiper-container cg-main-swiper">
		<ul class="swiper-wrapper cg-psp-gallery" itemscope itemtype="http://schema.org/ImageGallery">
			<?php
			if ( $post_thumbnail_id ) {
				$html = commercegurus_get_main_gallery_image_html( $post_thumbnail_id, true );
				$pdp_thub_count++;
			} else {
				$html  = '<div class="woocommerce-product-gallery__image--placeholder">';
				$html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src( 'woocommerce_single' ) ), esc_html__( 'Awaiting product image', 'woocommerce' ) );
				$html .= '</div>';
			}
			echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $post_thumbnail_id ); // phpcs:disable WordPress.XSS.EscapeOutput.OutputNotEscaped
			$attachment_ids = $product->get_gallery_image_ids();
			if ( $attachment_ids && $product->get_image_id() ) {
				$pdp_thub_count += count( $attachment_ids );
				foreach ( $attachment_ids as $attachment_id ) {
					echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', commercegurus_get_main_gallery_image_lazy_html( $attachment_id ), $attachment_id ); // phpcs:disable WordPress.XSS.EscapeOutput.OutputNotEscaped
				}
			}
			?>
		</ul>
		<div class="swiper-button-next"></div>
		<div class="swiper-button-prev"></div>
	</div>
	<div thumbsSlider="" class="swiper-container cg-thumb-swiper cg-thumbs-<?php echo esc_attr( $pdp_thumbnails ); ?> cg-thumbs-count-<?php echo esc_attr( $pdp_thub_count ); ?>">
		<div class="swiper-wrapper">
			<?php
			$html = '';
			if ( $post_thumbnail_id ) {
				$html = commercegurus_get_thumbnail_gallery_image_html( $post_thumbnail_id, true );
			}
			$attachment_ids = $product->get_gallery_image_ids();
			if ( $attachment_ids && $product->get_image_id() ) {
				foreach ( $attachment_ids as $attachment_id ) {
					$html .= commercegurus_get_thumbnail_gallery_image_html( $attachment_id, $attachment_id );
				}
			}
			if ( count( $attachment_ids ) ) {
				echo $html; // phpcs:disable WordPress.XSS.EscapeOutput.OutputNotEscaped
			}
			?>
		</div>
	</div>
</div>
<?php if ( $pdp_lightbox ) { ?>
<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="pswp__bg"></div>
	<div class="pswp__scroll-wrap">
		<div class="pswp__container">
			<div class="pswp__item"></div>
			<div class="pswp__item"></div>
			<div class="pswp__item"></div>
		</div>
		<div class="pswp__ui pswp__ui--hidden">
			<div class="pswp__top-bar">
				<div class="pswp__counter"></div>
				<button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
				<button class="pswp__button pswp__button--share" title="Share"></button>
				<button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
				<button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
				<div class="pswp__preloader">
					<div class="pswp__preloader__icn">
						<div class="pswp__preloader__cut">
							<div class="pswp__preloader__donut"></div>
						</div>
					</div>
				</div>
			</div>
		<div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
			<div class="pswp__share-tooltip"></div>
		</div>
		<button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)"></button>
		<button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
		</button>
		<div class="pswp__caption">
			<div class="pswp__caption__center"></div>
		</div>
		</div>
	</div>
</div>
<?php } ?>
