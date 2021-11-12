<?php
/**
 * The template for displaying search results pages.
 *
 * @package shoptimizer
 */

get_header();
global $wp_query;
?>
	<div id="primary" class="content-full">
		<main id="main" class="site-main">
			<header class="page-header tabbed-search-results">
				<h1 class="page-title">
				<?php
				/* translators: %s: search text. */
				printf( esc_attr__( 'Search Results for: %s', 'commercegurus-commercekit' ), '<span>' . get_search_query() . '</span>' );
				?>
				</h1>
			<div class="ajs-tabs-wrap">
				<ul>
					<li><a data-id="ajs-products" id="ajs-products-total" class="ajs-tabs active"><?php esc_html_e( 'Products', 'commercegurus-commercekit' ); ?> (0)</a></li>
					<li><a data-id="ajs-contents" class="ajs-tabs"><?php esc_html_e( 'Contents', 'commercegurus-commercekit' ); ?> (<?php echo esc_attr( $wp_query->found_posts ); ?>)</a></li>
				</ul>
			</div>
			</header><!-- .page-header -->
			<div class="ajs-tabs-content-wrap">
				<div class="ajs-tabs-content" id="ajs-contents">
					<?php if ( have_posts() ) : ?>
						<?php
						get_template_part( 'content', 'search' );
					else :
						get_template_part( 'content', 'none' );
					endif;
					?>
					<div class="search-pagination"><?php posts_nav_link(); ?></div>
				</div>
				<div class="ajs-tabs-content active" id="ajs-products">
					<?php
					$attributes = array(
						'limit'          => '-1',      // Results limit.
						'columns'        => '',        // Number of columns.
						'rows'           => '',        // Number of rows. If defined, limit will be ignored.
						'orderby'        => 'title',   // menu_order, title, date, rand, price, popularity, rating, or id.
						'order'          => 'ASC',     // ASC or DESC.
						'ids'            => '',        // Comma separated IDs.
						'skus'           => '',        // Comma separated SKUs.
						'category'       => '',        // Comma separated category slugs or ids.
						'cat_operator'   => 'IN',      // Operator to compare categories. Possible values are 'IN', 'NOT IN', 'AND'.
						'attribute'      => '',        // Single attribute slug.
						'terms'          => '',        // Comma separated term slugs or ids.
						'terms_operator' => 'IN',      // Operator to compare terms. Possible values are 'IN', 'NOT IN', 'AND'.
						'tag'            => '',        // Comma separated tag slugs.
						'tag_operator'   => 'IN',      // Operator to compare tags. Possible values are 'IN', 'NOT IN', 'AND'.
						'visibility'     => 'visible', // Product visibility setting. Possible values are 'visible', 'catalog', 'search', 'hidden'.
						'class'          => '',        // HTML class.
						'page'           => 1,         // Page for pagination.
						'paginate'       => true,      // Should results be paginated.
						'cache'          => true,      // Should shortcode output be.
					);
					if ( ! absint( $attributes['columns'] ) ) {
						$attributes['columns'] = wc_get_default_products_per_row();
					}
					if ( ! absint( $attributes['rows'] ) ) {
						$attributes['rows'] = wc_get_default_product_rows_per_page();
					}

					$nonce        = wp_verify_nonce( 'commercekit_nonce', 'commercekit_settings' );
					$options      = get_option( 'commercekit', array() );
					$outofstock   = isset( $options['ajs_outofstock'] ) && 1 === (int) $options['ajs_outofstock'] ? true : false;
					$stock_query  = 'meta_query';
					$search_text  = get_search_query( false );
					$ajs_pre_tab  = isset( $options['ajs_pre_tab'] ) && 1 === (int) $options['ajs_pre_tab'] ? true : false;
					$ajs_hidevar  = isset( $options['ajs_hidevar'] ) && 1 === (int) $options['ajs_hidevar'] ? true : false;
					$ajs_excludes = isset( $options['ajs_excludes'] ) ? explode( ',', $options['ajs_excludes'] ) : array();

					$attributes['limit'] = apply_filters( 'loop_shop_per_page', $attributes['columns'] * $attributes['rows'] );
					$attributes['page']  = absint( empty( $_GET['product-page'] ) ? 1 : $_GET['product-page'] ); // phpcs:ignore
					$result_total        = 0;
					$search_post_types   = array( 'product', 'product_variation' );
					if ( $ajs_hidevar ) {
						$search_post_types = array( 'product' );
					}

					$args = array(
						's'              => $search_text,
						'post_status'    => 'publish',
						'posts_per_page' => -1,
						'post_type'      => $search_post_types,
						'fields'         => 'ids',
						'orderby'        => empty( $_GET['orderby'] ) ? 'title' : sanitize_text_field( wp_unslash( $_GET['orderby'] ) ),
						'order'          => 'ASC',
					);
					if ( count( $ajs_excludes ) ) {
						$args['post__not_in'] = $ajs_excludes;
					}
					if ( $outofstock ) {
						$args[ $stock_query ] = array(
							array(
								'key'     => '_stock_status',
								'value'   => 'outofstock',
								'compare' => 'NOT LIKE',
							),
						);
					}

					$orderby_value   = explode( '-', $args['orderby'] );
					$order_by        = esc_attr( $orderby_value[0] );
					$order_asc       = ! empty( $orderby_value[1] ) ? $orderby_value[1] : strtoupper( 'ASC' );
					$args['orderby'] = $order_by;
					$args['order']   = $order_asc;

					$ordering_args   = WC()->query->get_catalog_ordering_args( $args['orderby'], $args['order'] );
					$args['orderby'] = $ordering_args['orderby'];
					$args['order']   = $ordering_args['order'];
					if ( $ordering_args['meta_key'] ) {
						$args['meta_key'] = $ordering_args['meta_key']; // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key
					}
					$args['posts_per_page'] = intval( $attributes['limit'] );
					if ( 1 < $attributes['page'] ) {
						$args['paged'] = absint( $attributes['page'] );
					}
					$wp_query->is_search = true;
					if ( $outofstock ) {
						$args['meta_query'] = WC()->query->get_meta_query( $args['meta_query'] ); // phpcs:ignore
					} else {
						$args['meta_query'] = WC()->query->get_meta_query(); // phpcs:ignore
					}
					$args['tax_query'] = WC()->query->get_tax_query( array(), true ); // phpcs:ignore

					$product_search = new WP_Query( $args );

					$paginated = ! $product_search->get( 'no_found_rows' );

					$products = (object) array(
						'ids'          => wp_parse_id_list( $product_search->posts ),
						'total'        => $paginated ? (int) $product_search->found_posts : count( $product_search->posts ),
						'total_pages'  => $paginated ? (int) $product_search->max_num_pages : 1,
						'per_page'     => (int) $product_search->get( 'posts_per_page' ),
						'current_page' => $paginated ? (int) max( 1, $attributes['page'] ) : 1,
					);

					if ( $products && $products->ids ) {
						$result_total = $products->total;
						echo '<div class="content-area">';
						// Setup the loop.
						wc_setup_loop(
							array(
								'columns'      => absint( $attributes['columns'] ),
								'name'         => 'products',
								'is_shortcode' => true,
								'is_search'    => false,
								'is_paginated' => true,
								'total'        => $products->total,
								'total_pages'  => $products->total_pages,
								'per_page'     => $products->per_page,
								'current_page' => $products->current_page,
							)
						);

						$original_post = $GLOBALS['post'];

						do_action( 'woocommerce_shortcode_before_products_loop', $attributes );
						do_action( 'woocommerce_before_shop_loop' );
						woocommerce_product_loop_start();

						if ( wc_get_loop_prop( 'total' ) ) {
							foreach ( $products->ids as $product_id ) {
								$GLOBALS['post'] = get_post( $product_id ); // phpcs:ignore
								setup_postdata( $GLOBALS['post'] );
								wc_get_template_part( 'content', 'product' );
							}
						}

						$GLOBALS['post'] = $original_post; // phpcs:ignore
						woocommerce_product_loop_end();
						do_action( 'woocommerce_after_shop_loop' );
						do_action( 'woocommerce_shortcode_after_products_loop', $attributes );

						wp_reset_postdata();
						wc_reset_loop();
						echo '</div>';
						get_sidebar();
					} else {
						get_template_part( 'content', 'none' );
					}
					?>
				</div>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->
<style>
.tabbed-search-results { display: flex; justify-content: space-between; align-items: center; margin: 0px 0 20px 0; }
.tabbed-search-results h1 { margin: 0; font-size: 34px; }
.ajs-tabs-wrap { flex-shrink: 0; }
.ajs-tabs-wrap ul { padding: 0px; margin: 0px; font-size: 15px; }
.ajs-tabs-wrap ul li { list-style: none; display: inline-block; margin: 0; }
.ajs-tabs-wrap ul li a { padding: 3px 0px; font-weight: bold; color: #111; cursor: pointer; outline: 0px; margin: 0 10px; display: inline-block; }
.ajs-tabs-wrap ul li a.active { border-bottom: 2px solid #111; }
.ajs-tabs-content-wrap { margin-top: 25px; clear: both; }
.ajs-tabs-content-wrap .ajs-tabs-content { display: none; width: 100%; }
.ajs-tabs-content-wrap .ajs-tabs-content.active { display: block;}
.ajs-tabs-content .content-area { float: right !important; }
.ajs-tabs-content #secondary { float: left !important; }
@media (max-width: 992px) {
	.tabbed-search-results { display: block; }
	.ajs-tabs-wrap { margin-top: 15px; }
	.ajs-tabs-wrap ul li:first-child a { margin-left: 0; }
}
</style>
<script>
document.addEventListener('click', function(event){
	var $this = event.target;
	var $thisp = $this.closest('.ajs-tabs');
	if( $thisp ){
		$this = $thisp;
	}
	if( $this.classList.contains('ajs-tabs') && !$this.classList.contains('active') ){
		event.preventDefault();
		document.querySelectorAll('.ajs-tabs-content, .ajs-tabs').forEach(function(tabs){
			tabs.classList.remove('active');
		});
		$this.classList.add('active');
		var c_id = $this.getAttribute('data-id');
		if( c_id ) {
			document.querySelector('#'+c_id).classList.add('active');
			setAJSCookie('cg-ajs-tabs', c_id, 0);
		}
	}
});
<?php if ( $ajs_pre_tab ) { ?>
var c_id = getAJSCookie('cg-ajs-tabs');
if( c_id ) {
	document.querySelector('a[data-id="'+c_id+'"]').click();
}
<?php } ?>
document.querySelector('#ajs-products-total').innerHTML = '<?php esc_html_e( 'Products', 'commercegurus-commercekit' ); ?> (<?php echo esc_attr( $result_total ); ?>)';
var forms = document.querySelectorAll('form.woocommerce-ordering');
forms.forEach(function(form){
	var paged = form.querySelector('input[name="paged"]');
	if( paged ){
		paged.parentNode.removeChild(paged);
	}
	form.insertAdjacentHTML('beforeend', '<input type="hidden" name="product-page" value="1" />');
});
function setAJSCookie(cname, cvalue, exdays){
	var d = new Date();
	d.setTime( d.getTime() + ( exdays * 24 * 60 * 60 * 1000 ) );
	var expires = "expires=" + d.toGMTString() + "; ";
	if( ! exdays ) expires = "";
	document.cookie = cname + "=" + cvalue + "; " + expires + "path=/";
} 
function getAJSCookie(cname){
	var name = cname + "=";
	var ca = document.cookie.split(';');
	for(var i=0; i<ca.length; i++) {
		var c = ca[i].trim();
		if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
	}
	return "";
}
</script>
<?php
get_footer();
