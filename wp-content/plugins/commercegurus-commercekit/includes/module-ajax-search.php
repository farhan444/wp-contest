<?php
/**
 *
 * Ajax Search module
 *
 * @package CommerceKit
 * @subpackage Shoptimizer
 */

/**
 * Ajax search options
 *
 * @return string
 */
function commercekit_ajs_options() {
	$commercekit_options                 = get_option( 'commercekit', array() );
	$commercekit_ajs                     = array();
	$commercekit_ajs['ajax_url']         = admin_url( 'admin-ajax.php' );
	$commercekit_ajs['ajax_search']      = isset( $commercekit_options['ajax_search'] ) && 1 === (int) $commercekit_options['ajax_search'] ? 1 : 0;
	$commercekit_ajs['char_count']       = 3;
	$commercekit_ajs['action']           = 'commercekit_ajax_search';
	$commercekit_ajs['loader_icon']      = CKIT_URI . 'assets/images/loader2.gif';
	$commercekit_ajs['no_results_text']  = isset( $commercekit_options['ajs_no_text'] ) && ! empty( $commercekit_options['ajs_no_text'] ) ? commercekit_get_multilingual_string( stripslashes_deep( $commercekit_options['ajs_no_text'] ) ) : esc_html__( 'No results', 'commercegurus-commercekit' );
	$commercekit_ajs['placeholder_text'] = isset( $commercekit_options['ajs_placeholder'] ) && ! empty( $commercekit_options['ajs_placeholder'] ) ? commercekit_get_multilingual_string( stripslashes_deep( $commercekit_options['ajs_placeholder'] ) ) : esc_html__( 'Search products...', 'commercegurus-commercekit' );
	$commercekit_ajs['layout']           = ( isset( $commercekit_options['ajs_display'] ) && 'all' === $commercekit_options['ajs_display'] ) || ! isset( $commercekit_options['ajs_display'] ) ? 'all' : 'product';

	return $commercekit_ajs;
}

/**
 * Ajax do search
 */
function commercekit_ajax_do_search() {
	global $cgkit_ajax_search, $wp_query;
	$commercekit_options = get_option( 'commercekit', array() );
	$enable_ajax_search  = isset( $commercekit_options['ajax_search'] ) && 1 === (int) $commercekit_options['ajax_search'] ? 1 : 0;
	$search_type         = ( isset( $commercekit_options['ajs_display'] ) && 'all' === $commercekit_options['ajs_display'] ) || ! isset( $commercekit_options['ajs_display'] ) ? 'all' : 'product';
	$other_result_text   = isset( $commercekit_options['ajs_other_text'] ) && ! empty( $commercekit_options['ajs_other_text'] ) ? commercekit_get_multilingual_string( stripslashes_deep( $commercekit_options['ajs_other_text'] ) ) : esc_html__( 'Other results', 'commercegurus-commercekit' );
	$view_all_text       = isset( $commercekit_options['ajs_all_text'] ) && ! empty( $commercekit_options['ajs_all_text'] ) ? commercekit_get_multilingual_string( stripslashes_deep( $commercekit_options['ajs_all_text'] ) ) : esc_html__( 'View all results', 'commercegurus-commercekit' );
	$outofstock          = ( isset( $commercekit_options['ajs_outofstock'] ) && 0 === (int) $commercekit_options['ajs_outofstock'] ) || ! isset( $commercekit_options['ajs_outofstock'] ) ? false : true;
	$commercekit_nonce   = isset( $_GET['commercekit_nonce'] ) ? sanitize_text_field( wp_unslash( $_GET['commercekit_nonce'] ) ) : '';
	$verify_nonce        = wp_verify_nonce( $commercekit_nonce, 'commercekit_settings' );
	$search_text         = isset( $_GET['query'] ) ? trim( sanitize_text_field( wp_unslash( $_GET['query'] ) ) ) : '';
	$suggestions         = array();
	$view_all_link       = home_url( '/' ) . '?s=' . urlencode( $search_text ) . ( 'product' === $search_type ? '&post_type=product' : '' ); // phpcs:ignore
	$ajs_excludes        = isset( $commercekit_options['ajs_excludes'] ) ? explode( ',', $commercekit_options['ajs_excludes'] ) : array();
	$ajs_hidevar         = isset( $commercekit_options['ajs_hidevar'] ) && 1 === (int) $commercekit_options['ajs_hidevar'] ? true : false;
	$outofstock_query    = 'meta-query';
	$result_total        = 0;
	$outofstock_query    = str_replace( '-', '_', $outofstock_query );
	$cgkit_ajax_search   = false;
	$search_post_types   = array( 'product', 'product_variation' );
	if ( $ajs_hidevar ) {
		$search_post_types = array( 'product' );
	}

	if ( $enable_ajax_search && $search_text ) {
		$args = array(
			's'              => $search_text,
			'post_status'    => 'publish',
			'posts_per_page' => 3,
			'post_type'      => $search_post_types,
			'post__not_in'   => $ajs_excludes,
		);
		if ( $outofstock ) {
			$args[ $outofstock_query ] = array(
				array(
					'key'     => '_stock_status',
					'value'   => 'outofstock',
					'compare' => 'NOT LIKE',
				),
			);
		}
		$cgkit_ajax_search   = true;
		$wp_query->is_search = true;
		if ( $outofstock ) {
			$args['meta_query'] = WC()->query->get_meta_query( $args['meta_query'] ); // phpcs:ignore
		} else {
			$args['meta_query'] = WC()->query->get_meta_query(); // phpcs:ignore
		}
		$args['tax_query'] = WC()->query->get_tax_query( array(), true ); // phpcs:ignore

		$product_search = new WP_Query( $args );
		$result_count   = 0;
		$result_total   = $product_search->found_posts;

		if ( $product_search->have_posts() ) {
			while ( $product_search->have_posts() ) {
				$product_search->the_post();
				$post_title = esc_html( wp_strip_all_tags( $product_search->post->post_title ) );
				if ( preg_match( '/' . $search_text . '/i', $post_title, $matches ) ) {
					$post_title = preg_replace( '/' . $search_text . '/i', '<span class="match-text">' . $matches[0] . '</span>', $post_title );
				}
				$post_id = $product_search->post->ID;
				$product = wc_get_product( $post_id );
				$image   = '';
				if ( has_post_thumbnail( $product_search->post ) ) {
					$image = get_the_post_thumbnail( $product_search->post, 'thumbnail' );
					$image = str_ireplace( '<img ', '<img onload="ckAdjustSuggestionsHeight(this);" ', $image );
				} elseif ( 'product_variation' === $product_search->post->post_type && $product_search->post->post_parent ) {
					$image = get_the_post_thumbnail( $product_search->post->post_parent, 'thumbnail' );
					$image = str_ireplace( '<img ', '<img onload="ckAdjustSuggestionsHeight(this);" ', $image );
				}
				$output = '<a href="' . esc_url( add_query_arg( 'cgkit_search_word', $search_text, get_permalink( $post_id ) ) ) . '" class="commercekit-ajs-product">';
				if ( $image ) {
					$output .= '<div class="commercekit-ajs-product-image">' . $image . '</div>';
				}
				$output .= '<div class="commercekit-ajs-product-desc">';
				$output .= '<div class="commercekit-ajs-product-title">' . $post_title . '</div>';
				$output .= '<div class="commercekit-ajs-product-price">' . $product->get_price_html() . '</div>';
				$output .= '</div>';
				$output .= '</div>';
				$output .= '</a>';

				$suggestions[] = array(
					'value' => esc_js( $post_title ),
					'data'  => $output,
					'url'   => esc_url( get_permalink( $post_id ) ),
				);
				$result_count++;
			}
		}

		$terms = get_terms(
			array(
				'product_cat',
				'product_tag',
			),
			array(
				'name__like' => $search_text,
				'hide_empty' => true,
				'number'     => 2,
			)
		);
		if ( is_array( $terms ) && count( $terms ) > 0 ) {
			foreach ( $terms as $term ) {
				$term_name = wp_strip_all_tags( $term->name );
				if ( preg_match( '/' . $search_text . '/i', $term_name, $matches ) ) {
					$term_name = preg_replace( '/' . $search_text . '/i', '<span class="match-text">' . $matches[0] . '</span>', $term_name );
				}
				$term_type = $term->taxonomy;
				if ( 'product_cat' === $term_type ) {
					$term_type = esc_html__( 'Product Category', 'commercegurus-commercekit' );
				}
				if ( 'product_tag' === $term_type ) {
					$term_type = esc_html__( 'Product Tag', 'commercegurus-commercekit' );
				}
				$output  = '<a href="' . esc_url( add_query_arg( 'cgkit_search_word', $search_text, get_term_link( $term ) ) ) . '" class="commercekit-ajs-post">';
				$output .= '<div class="commercekit-ajs-post-title">' . $term_name . '<span class="post-type">' . $term_type . '</span></div>';
				$output .= '</div>';
				$output .= '</a>';

				$suggestions[] = array(
					'value' => esc_js( $term->name ),
					'data'  => $output,
					'url'   => esc_url( get_term_link( $term ) ),
				);
				$result_count++;
			}
		}

		if ( 'all' === $search_type ) {
			$all_post_types = get_post_types( array( 'exclude_from_search' => false ) );
			if ( is_array( $all_post_types ) && in_array( 'product', $all_post_types, true ) ) {
				unset( $all_post_types['product'] );
				unset( $all_post_types['product_variation'] );
			}
			$posts_search  = new WP_Query(
				array(
					's'              => $search_text,
					'post_status'    => 'publish',
					'posts_per_page' => ( 7 - $result_count ),
					'post_type'      => $all_post_types,
					'post__not_in'   => $ajs_excludes,
				)
			);
			$result_total += $posts_search->found_posts;

			if ( $posts_search->have_posts() ) {

				$suggestions[] = array(
					'value' => esc_js( $other_result_text ),
					'data'  => '<div class="commercekit-ajs-other-result">' . $other_result_text . '</div>',
					'url'   => '#ajax-search;',
				);

				while ( $posts_search->have_posts() ) {
					$posts_search->the_post();
					$post_title = esc_html( wp_strip_all_tags( $posts_search->post->post_title ) );
					if ( preg_match( '/' . $search_text . '/i', $post_title, $matches ) ) {
						$post_title = preg_replace( '/' . $search_text . '/i', '<span class="match-text">' . $matches[0] . '</span>', $post_title );
					}
					$post_id   = $posts_search->post->ID;
					$post_type = $posts_search->post->post_type;
					if ( 'post' === $post_type ) {
						$post_type = esc_html__( 'Post', 'commercegurus-commercekit' );
					}
					if ( 'page' === $post_type ) {
						$post_type = esc_html__( 'Page', 'commercegurus-commercekit' );
					}
					$output  = '<a href="' . esc_url( add_query_arg( 'cgkit_search_word', $search_text, get_permalink( $post_id ) ) ) . '" class="commercekit-ajs-post">';
					$output .= '<div class="commercekit-ajs-post-title">' . $post_title . '<span class="post-type">' . $post_type . '</span></div>';
					$output .= '</div>';
					$output .= '</a>';

					$suggestions[] = array(
						'value' => esc_js( $post_title ),
						'data'  => $output,
						'url'   => esc_url( get_permalink( $post_id ) ),
					);
				}
			}
		}
	}

	$view_all_html = '<a class="commercekit-ajs-view-all" href="' . $view_all_link . '">' . $view_all_text . ' (' . $result_total . ')</a>';
	echo wp_json_encode(
		array(
			'suggestions'   => $suggestions,
			'view_all_link' => $view_all_html,
		)
	);
	exit();
}

add_action( 'wp_ajax_commercekit_ajax_search', 'commercekit_ajax_do_search' );
add_action( 'wp_ajax_nopriv_commercekit_ajax_search', 'commercekit_ajax_do_search' );

/**
 * Ajax search form html
 *
 * @param  string $html of form.
 */
function commercekit_ajax_search_form( $html ) {
	$commercekit_options = get_option( 'commercekit', array() );
	$placeholder_text    = isset( $commercekit_options['ajs_placeholder'] ) && ! empty( $commercekit_options['ajs_placeholder'] ) ? commercekit_get_multilingual_string( stripslashes_deep( $commercekit_options['ajs_placeholder'] ) ) : esc_html__( 'Search products...', 'commercegurus-commercekit' );

	$html = preg_replace( '/placeholder=\"([^"]*)\"/i', 'placeholder="' . $placeholder_text . '"', $html );

	return $html;
}
add_filter( 'get_search_form', 'commercekit_ajax_search_form', 99 );
add_filter( 'get_product_search_form', 'commercekit_ajax_search_form', 99 );

/**
 * Custom search template
 *
 * @param  string $template of search.
 */
function commercekit_custom_search_template( $template ) {
	global $wp_query, $cgkit_ajs_tabbed;
	$options     = get_option( 'commercekit', array() );
	$ajs_tabbed  = isset( $options['ajs_tabbed'] ) && 1 === (int) $options['ajs_tabbed'] ? true : false;
	$ajs_display = ( isset( $options['ajs_display'] ) && 'all' === $options['ajs_display'] ) || ! isset( $options['ajs_display'] ) ? true : false;

	$cgkit_ajs_tabbed = false;
	if ( $wp_query->is_search && $ajs_tabbed && $ajs_display ) {
		$cgkit_ajs_tabbed = true;
		return dirname( __FILE__ ) . '/templates/search.php';
	} else {
		return $template;
	}
}
add_filter( 'template_include', 'commercekit_custom_search_template' );

/**
 * Custom search query
 *
 * @param  string $query of search.
 */
function commercekit_custom_search_query( $query ) {
	if ( is_admin() || ! $query->is_main_query() ) {
		return;
	}

	$nonce         = wp_verify_nonce( 'commercekit_nonce', 'commercekit_settings' );
	$get_post_type = isset( $_GET['post_type'] ) ? sanitize_text_field( wp_unslash( $_GET['post_type'] ) ) : '';

	if ( 'product' === $get_post_type ) {
		return;
	}

	if ( $query->is_search() ) {
		$options     = get_option( 'commercekit', array() );
		$ajs_tabbed  = isset( $options['ajs_tabbed'] ) && 1 === (int) $options['ajs_tabbed'] ? true : false;
		$ajs_display = ( isset( $options['ajs_display'] ) && 'all' === $options['ajs_display'] ) || ! isset( $options['ajs_display'] ) ? true : false;

		if ( $ajs_tabbed && $ajs_display ) {
			$get_post_types = get_post_types( array( 'exclude_from_search' => false ) );
			if ( is_array( $get_post_types ) && in_array( 'product', $get_post_types, true ) ) {
				unset( $get_post_types['product'] );
				unset( $get_post_types['product_variation'] );
				$query->set( 'post_type', $get_post_types );
			}
		}
		$ajs_excludes = isset( $options['ajs_excludes'] ) ? explode( ',', $options['ajs_excludes'] ) : array();
		if ( count( $ajs_excludes ) ) {
			$query->set( 'post__not_in', $ajs_excludes );
		}
	}
}
add_action( 'pre_get_posts', 'commercekit_custom_search_query', 999, 1 );

/**
 * Custom SKU search query
 *
 * @param  string $query of search.
 */
function commercekit_ajs_sku_pre_get_posts( $query ) {
	global $cgkit_ajax_search, $cgkit_ajs_tabbed;
	if ( $cgkit_ajax_search || $cgkit_ajs_tabbed || ( ! is_admin() && $query->is_main_query() && $query->is_search() ) ) {
		add_filter( 'posts_join', 'commercekit_ajs_sku_search_join', 99, 1 );
		add_filter( 'posts_where', 'commercekit_ajs_sku_search_where', 99, 1 );
		add_filter( 'posts_groupby', 'commercekit_ajs_sku_search_groupby', 99, 1 );
	}
}
add_action( 'pre_get_posts', 'commercekit_ajs_sku_pre_get_posts', 99, 1 );

/**
 * Custom SKU search join
 *
 * @param  string $join of join.
 */
function commercekit_ajs_sku_search_join( $join ) {
	global $wpdb;
	$join .= " LEFT JOIN $wpdb->postmeta sku_meta ON ( " . $wpdb->posts . ".ID = sku_meta.post_id AND sku_meta.meta_key='_sku' ) LEFT JOIN {$wpdb->posts} parents ON ( " . $wpdb->posts . '.post_parent = parents.ID AND ' . $wpdb->posts . ".post_parent != '0' )";

	return $join;
}

/**
 * Custom SKU search where
 *
 * @param  string $where of where.
 */
function commercekit_ajs_sku_search_where( $where ) {
	global $wpdb;
	$where = preg_replace(
		"/\(\s*{$wpdb->posts}.post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
		"({$wpdb->posts}.post_title LIKE $1) OR (sku_meta.meta_value LIKE $1)",
		$where
	);

	return $where . ' AND ( ' . $wpdb->posts . ".post_parent = '0' OR parents.post_status = 'publish' ) ";
}

/**
 * Custom SKU search groupby
 *
 * @param  string $groupby of groupby.
 */
function commercekit_ajs_sku_search_groupby( $groupby ) {
	global $wpdb;
	$mygroupby = "{$wpdb->posts}.ID";
	if ( preg_match( "/$mygroupby/", $groupby ) ) {
		return $groupby;
	}
	if ( ! strlen( trim( $groupby ) ) ) {
		return $mygroupby;
	}

	return $groupby . ', ' . $mygroupby;
}

/**
 * Ajax search counts.
 */
function commercekit_ajax_search_counts() {
	global $wpdb;
	$ajax            = array();
	$ajax['status']  = 1;
	$ajax['message'] = '';

	$nonce     = wp_verify_nonce( 'commercekit_nonce', 'commercekit_settings' );
	$query     = isset( $_GET['query'] ) ? sanitize_text_field( wp_unslash( $_GET['query'] ) ) : '';
	$no_result = isset( $_GET['no_result'] ) ? (int) sanitize_text_field( wp_unslash( $_GET['no_result'] ) ) : 0;
	$table     = $wpdb->prefix . 'commercekit_searches';
	if ( $query ) {
		$search_ids = isset( $_COOKIE['commercekit_search_ids'] ) && ! empty( $_COOKIE['commercekit_search_ids'] ) ? explode( ',', sanitize_text_field( wp_unslash( $_COOKIE['commercekit_search_ids'] ) ) ) : array();
		$search_ids = array_map( 'intval', $search_ids );
		$sql        = 'SELECT * FROM ' . $table . ' WHERE search_term = \'' . $query . '\'';
		$row        = $wpdb->get_row( $sql ); // phpcs:ignore
		$search_id  = 0;
		if ( $row ) {
			if ( ! in_array( (int) $row->id, $search_ids, true ) ) {
				$data   = array(
					'search_count'    => $row->search_count + 1,
					'no_result_count' => 1 === $no_result ? $row->no_result_count + 1 : $row->no_result_count,
				);
				$where  = array(
					'id' => $row->id,
				);
				$format = array( '%d', '%d' );
				$wpdb->update( $table, $data, $where, $format ); // db call ok; no-cache ok.
			}
			$search_id = $row->id;
		} else {
			$data   = array(
				'search_term'     => $query,
				'search_count'    => 1,
				'no_result_count' => 1 === $no_result ? 1 : 0,
			);
			$format = array( '%s', '%d', '%d' );
			$wpdb->insert( $table, $data, $format ); // db call ok; no-cache ok.
			$search_id = $wpdb->insert_id;
		}
		$search_ids[] = $search_id;
		setcookie( 'commercekit_search_ids', implode( ',', array_unique( $search_ids ) ), time() + ( 48 * 3600 ), '/' );
	}

	echo wp_json_encode( $ajax );
	exit();
}

add_action( 'wp_ajax_commercekit_search_counts', 'commercekit_ajax_search_counts' );
add_action( 'wp_ajax_nopriv_commercekit_search_counts', 'commercekit_ajax_search_counts' );

/**
 * Add wishlist endpoint.
 */
function commercekit_add_search_click_count() {
	global $wpdb;
	$nonce             = wp_verify_nonce( 'commercekit_nonce', 'commercekit_settings' );
	$cgkit_search_word = isset( $_GET['cgkit_search_word'] ) ? sanitize_text_field( wp_unslash( $_GET['cgkit_search_word'] ) ) : '';
	if ( $cgkit_search_word ) {
		$table = $wpdb->prefix . 'commercekit_searches';
		$sql   = 'SELECT * FROM ' . $table . ' WHERE search_term = \'' . $cgkit_search_word . '\'';
		$row   = $wpdb->get_row( $sql ); // phpcs:ignore
		if ( $row ) {
			$search_ids = isset( $_COOKIE['commercekit_search_ids'] ) && ! empty( $_COOKIE['commercekit_search_ids'] ) ? explode( ',', sanitize_text_field( wp_unslash( $_COOKIE['commercekit_search_ids'] ) ) ) : array();
			$search_ids = array_map( 'intval', $search_ids );
			if ( ! in_array( (int) $row->id, $search_ids, true ) ) {
				$data   = array(
					'click_count' => $row->click_count + 1,
				);
				$where  = array(
					'id' => $row->id,
				);
				$format = array( '%d' );
				$wpdb->update( $table, $data, $where, $format ); // db call ok; no-cache ok.

				$search_ids[] = $row->id;
				setcookie( 'commercekit_search_ids', implode( ',', array_unique( $search_ids ) ), time() + ( 48 * 3600 ), '/' );
			}
		}
	}
}

add_action( 'init', 'commercekit_add_search_click_count' );
