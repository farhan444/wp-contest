<?php
/**
 * Shoptimizer template functions.
 *
 * @package Shoptimizer
 */

if ( ! function_exists( 'shoptimizer_display_comments' ) ) {
	/**
	 * Shoptimizer display comments
	 *
	 * @since  1.0.0
	 */
	function shoptimizer_display_comments() {
		if ( comments_open() || '0' !== get_comments_number() ) :
			comments_template();
		endif;
	}
}

if ( ! function_exists( 'shoptimizer_comment' ) ) {
	/**
	 * Shoptimizer comment template
	 *
	 * @param array $comment the comment array.
	 * @param array $args the comment args.
	 * @param int   $depth the comment depth.
	 * @since 1.0.0
	 */
	function shoptimizer_comment( $comment, $args, $depth ) {
		if ( 'div' === $args['style'] ) {
			$tag       = 'div';
			$add_below = 'comment';
		} else {
			$tag       = 'li';
			$add_below = 'div-comment';
		}
		?>
		<<?php echo esc_attr( $tag ); ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?> id="comment-<?php comment_ID(); ?>">
		<div class="comment-body">
		<div class="comment-meta commentmetadata">
			<div class="comment-author vcard">
			<?php echo get_avatar( $comment, 128 ); ?>			
			</div>
			<?php if ( '0' == $comment->comment_approved ) : ?>
				<em class="comment-awaiting-moderation"><?php esc_attr_e( 'Your comment is awaiting moderation.', 'shoptimizer' ); ?></em>
				<br />
			<?php endif; ?>
		
		</div>
		<?php if ( 'div' !== $args['style'] ) : ?>
		<div id="div-comment-<?php comment_ID(); ?>" class="comment-content">

		<?php endif; ?>
		<div class="comment_meta">
		<?php printf( wp_kses_post( '<cite class="fn">%s</cite>', 'shoptimizer' ), get_comment_author_link() ); ?>
		<a href="<?php echo esc_url( htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ); ?>" class="comment-date">
				<?php echo '<time datetime="' . get_comment_date( 'c' ) . '">' . get_comment_date() . '</time>'; ?>
		</a>
		</div>
		<div class="comment-text">

		<?php comment_text(); ?>
		</div>
		<div class="reply">
		<?php
		comment_reply_link(
			array_merge(
				$args, array(
					'add_below' => $add_below,
					'depth'     => $depth,
					'max_depth' => $args['max_depth'],
				)
			)
		);
		?>
		<?php edit_comment_link( __( 'Edit', 'shoptimizer' ), '  ', '' ); ?>
		</div>
		</div>
		<?php if ( 'div' !== $args['style'] ) : ?>
		</div>
		<?php endif; ?>
		<?php
	}
}


if ( ! function_exists( 'shoptimizer_sticky_header_display' ) ) :

	/**
	 * Enable Sticky Header
	 */
	function shoptimizer_sticky_header_display() {

		$shoptimizer_sticky_header = '';
		$shoptimizer_sticky_header = shoptimizer_get_option( 'shoptimizer_sticky_header' );

		$shoptimizer_header_layout = '';
		$shoptimizer_header_layout = shoptimizer_get_option( 'shoptimizer_header_layout' );

		if ( isset( $_GET['header'] ) ) {
			$shoptimizer_header_layout = $_GET['header'];
		}

		?>

		<?php
		if ( 'enable' === $shoptimizer_sticky_header ) {

			// Don't enable this if header-4 is chosen.
			if ( 'header-4' !== $shoptimizer_header_layout ) { 

			$shoptimizer_sticky_header_js  = '';
			$shoptimizer_sticky_header_js .= "
			
			var observer = new IntersectionObserver(function(entries) {
				if(entries[0].intersectionRatio === 0)
					document.querySelector('.col-full-nav').classList.add('is_stuck');
				else if(entries[0].intersectionRatio === 1)
					document.querySelector('.col-full-nav').classList.remove('is_stuck');
			}, { threshold: [0,1] });

			observer.observe(document.querySelector('.s-observer'));
		";

		wp_add_inline_script( 'shoptimizer-main', $shoptimizer_sticky_header_js );
			
		} 	

		?>
		<?php
		}
	}

endif;


if ( ! function_exists( 'shoptimizer_header_widget_region' ) ) {
	/**
	 * Display header widget region
	 *
	 * @since  1.0.0
	 */
	function shoptimizer_header_widget_region() {
		if ( is_active_sidebar( 'header-1' ) ) {
			?>
		<div class="header-widget-region" role="complementary">
			<div class="col-full">
				<?php dynamic_sidebar( 'header-1' ); ?>
			</div>
		</div>
			<?php
		}
	}
}

if ( ! function_exists( 'shoptimizer_mobile_overlay' ) ) {
	/**
	 * Display mobile overlay when active
	 *
	 * @since  1.0.0
	 */
	function shoptimizer_mobile_overlay() {
		
			?>
		<div class="mobile-overlay"></div>
			<?php
		
	}
}


if ( ! function_exists( 'shoptimizer_below_content' ) ) {
	/**
	 * Display before footer region
	 *
	 * @since  1.0.0
	 */
	function shoptimizer_below_content() {
		if ( is_active_sidebar( 'below-content' ) ) {

			$shoptimizer_below_content_display = '';
			$shoptimizer_below_content_display = shoptimizer_get_option( 'shoptimizer_below_content_display' );

			?>
			<?php if ( 'show' === $shoptimizer_below_content_display ) { ?>
		<div class="below-content">
			<div class="col-full">
				<?php dynamic_sidebar( 'below-content' ); ?>
			</div>
		</div>
		<?php } ?>	
			<?php
		}
	}
}

if ( ! function_exists( 'shoptimizer_footer_widgets' ) ) {
	/**
	 * Display footer widgets
	 *
	 * @since  1.0.0
	 */
	function shoptimizer_footer_widgets() {
		if ( is_active_sidebar( 'footer' ) ) {

			$shoptimizer_footer_display = '';
			$shoptimizer_footer_display = shoptimizer_get_option( 'shoptimizer_footer_display' );

			?>
			<?php if ( 'show' === $shoptimizer_footer_display ) { ?>
		<footer class="site-footer">
			<div class="col-full">
				<?php dynamic_sidebar( 'footer' ); ?>
			</div>
		</footer>
		<?php } ?>	
			<?php
		}
	}
}

if ( ! function_exists( 'shoptimizer_footer_copyright' ) ) {
	/**
	 * Display footer copyright
	 *
	 * @since  1.0.0
	 */
	function shoptimizer_footer_copyright() {
		if ( is_active_sidebar( 'copyright' ) ) {

			$shoptimizer_copyright_display = '';
			$shoptimizer_copyright_display = shoptimizer_get_option( 'shoptimizer_copyright_display' );

			?>
			<?php if ( 'show' === $shoptimizer_copyright_display ) { ?>
		<footer class="copyright">
			<div class="col-full">
				<?php dynamic_sidebar( 'copyright' ); ?>
			</div>
		</footer>
		<?php } ?>	
			<?php
		}
	}
}

if ( ! function_exists( 'shoptimizer_top_bar' ) ) {
	/**
	 * Top bar
	 *
	 * @since  1.0.0
	 * @return void
	 */
	function shoptimizer_top_bar() {
		$shoptimizer_layout_top_bar_display = '';
		$shoptimizer_layout_top_bar_display = shoptimizer_get_option( 'shoptimizer_layout_top_bar_display' );

		$shoptimizer_layout_top_bar_mobile = '';
		$shoptimizer_layout_top_bar_mobile = shoptimizer_get_option( 'shoptimizer_layout_top_bar_mobile' );

		?>

		<?php if ( 'enable' === $shoptimizer_layout_top_bar_display ) { ?>

		<?php if ( 'hide' === $shoptimizer_layout_top_bar_mobile ) { ?>
			<div class="col-full topbar-wrapper hide-on-mobile">
				<?php } else { ?>
			<div class="col-full topbar-wrapper">
		<?php } ?>

			<div class="top-bar">
				<div class="col-full">
					<?php dynamic_sidebar( 'top-bar-left' ); ?>
					<?php dynamic_sidebar( 'top-bar' ); ?>
					<?php dynamic_sidebar( 'top-bar-right' ); ?>
				</div>
			</div>
		</div>
		<?php } ?>	
		<?php
	}
}



if ( ! function_exists( 'shoptimizer_sticky_js_trigger' ) ) {
		/**
		 * This is only active if header-4 is NOT enabled. This div is required to allow the Interaction Observer know it has become stuck.
		 *
		 * @since  1.0.0
		 * @return void
		 */
		function shoptimizer_sticky_js_trigger() {
		$shoptimizer_header_layout = '';
		$shoptimizer_header_layout = shoptimizer_get_option( 'shoptimizer_header_layout' );

		if ( isset( $_GET['header'] ) ) {
			$shoptimizer_header_layout = $_GET['header'];
		}

		if ( 'header-4' !== $shoptimizer_header_layout ) { 
			?>
			<div class="s-observer"></div>
		<?php
		}
	}
}


if ( ! function_exists( 'shoptimizer_header_wrapper_open' ) ) {
		/**
		 * This is only active if header-4 is enabled.
		 *
		 * @since  1.0.0
		 * @return void
		 */
		function shoptimizer_header_wrapper_open() {
		$shoptimizer_header_layout = '';
		$shoptimizer_header_layout = shoptimizer_get_option( 'shoptimizer_header_layout' );

		if ( isset( $_GET['header'] ) ) {
			$shoptimizer_header_layout = $_GET['header'];
		}

		if ( 'header-4' === $shoptimizer_header_layout ) { 
			?>
			<div class="header-4-container">
				<div class="header-4-inner">
		<?php
		}
	}
}

if ( ! function_exists( 'shoptimizer_header_wrapper_close' ) ) {
		/**
		 * This is only active if header-4 is enabled.
		 *
		 * @since  1.0.0
		 * @return void
		 */
		function shoptimizer_header_wrapper_close() { 
		$shoptimizer_header_layout = '';
		$shoptimizer_header_layout = shoptimizer_get_option( 'shoptimizer_header_layout' );

		if ( isset( $_GET['header'] ) ) {
			$shoptimizer_header_layout = $_GET['header'];
		}

		if ( 'header-4' === $shoptimizer_header_layout ) { 
			?>
			</div>
			</div><!--/h4-->
		<?php
	}
	}
}

if ( ! function_exists( 'shoptimizer_site_branding' ) ) {
	/**
	 * Site branding wrapper and display
	 *
	 * @since  1.0.0
	 * @return void
	 */
	function shoptimizer_site_branding() {
		$shoptimizer_mobile_menu_text_display = '';
		$shoptimizer_mobile_menu_text_display = shoptimizer_get_option( 'shoptimizer_mobile_menu_text_display' );

		$shoptimizer_mobile_menu_text = shoptimizer_get_option( 'shoptimizer_mobile_menu_text' );
		?>
		<div class="site-branding">
			<button class="menu-toggle" aria-label="Menu" aria-controls="site-navigation" aria-expanded="false">
				<span class="bar"></span><span class="bar"></span><span class="bar"></span>
				<?php if ( 'yes' === $shoptimizer_mobile_menu_text_display ) { ?>
				<span class="bar-text"><?php echo shoptimizer_safe_html( $shoptimizer_mobile_menu_text ); ?></span>
				<?php } ?>	
			</button>
			<?php shoptimizer_site_title_or_logo(); ?>
		</div>
		<?php
	}
}

if ( ! function_exists( 'shoptimizer_mobile_myaccount' ) ) {
	/**
	 * Display a my account icon in the mobile header
	 *
	 * @since  1.0.0
	 * @return void
	 */
	function shoptimizer_mobile_myaccount() {

		$shoptimizer_mobile_myaccount = '';
		$shoptimizer_mobile_myaccount = shoptimizer_get_option( 'shoptimizer_mobile_myaccount' );

		if ( 'enable' === $shoptimizer_mobile_myaccount ) {
			?>
				<div class="mobile-myaccount">
					<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>">
					<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
					  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
					</svg>
					</a>
				</div>
			<?php

		}
	}
}

if ( ! function_exists( 'shoptimizer_mobile_search_toggle' ) ) {
	/**
	 * Mobile header search toggle
	 *
	 * @since  1.0.0
	 * @return void
	 */
	function shoptimizer_mobile_search_toggle() {

		$shoptimizer_search_mobile = '';
		$shoptimizer_search_mobile = shoptimizer_get_option( 'shoptimizer_search_mobile' );
		$shoptimizer_search_mobile_position = '';
		$shoptimizer_search_mobile_position = shoptimizer_get_option( 'shoptimizer_search_mobile_position' );
		$shoptimizer_mobile_myaccount = '';
		$shoptimizer_mobile_myaccount = shoptimizer_get_option( 'shoptimizer_mobile_myaccount' );

		if ( 'enable' === $shoptimizer_search_mobile ) {
			if ( 'toggle' === $shoptimizer_search_mobile_position ) {

			?>
				<?php if ( 'enable' === $shoptimizer_mobile_myaccount ) { ?>
					<div class="mobile-search-toggle with-myaccount-icon">
				<?php } else { ?>
					<div class="mobile-search-toggle">
				<?php } ?>
					<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
					  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
					</svg>
				</div>
			<?php
			}
		}
	}
}

if ( ! function_exists( 'shoptimizer_site_title_or_logo' ) ) {
	/**
	 * Display the site title or logo
	 *
	 * @since 1.0.0
	 * @param bool $echo Echo the string or return it.
	 * @return string
	 */
	function shoptimizer_site_title_or_logo( $echo = true ) {

	$shoptimizer_tagline_display = '';
	$shoptimizer_tagline_display = shoptimizer_get_option( 'shoptimizer_tagline_display' );

		if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
			$logo = get_custom_logo();
			$html = is_home() ? '<h1 class="logo">' . $logo . '</h1>' : $logo;
		} else {
			$tag = is_home() ? 'h1' : 'div';

			$html = '<' . esc_attr( $tag ) . ' class="beta site-title"><a href="' . esc_url( home_url( '/' ) ) . '" rel="home" class="custom-logo-link">' . esc_html( get_bloginfo( 'name' ) ) . '</a></' . esc_attr( $tag ) . '>';

		}

		if ( ! $echo ) {
			return $html;
		}

		echo shoptimizer_safe_html( $html );

		if ( true === $shoptimizer_tagline_display ) {
			$tagline = '';
			if ( '' !== get_bloginfo( 'description' ) ) {
				$tagline .= '<p class="site-description">' . esc_html( get_bloginfo( 'description', 'display' ) ) . '</p>';
			}
			echo shoptimizer_safe_html( $tagline );
		}
	}
}

if ( ! function_exists( 'shoptimizer_primary_navigation' ) ) {
	/**
	 * Display Primary Navigation
	 *
	 * @since  1.0.0
	 * @return void
	 */
	function shoptimizer_primary_navigation() {
		?>
		<nav id="site-navigation" class="main-navigation" aria-label="<?php esc_html_e( 'Primary Navigation', 'shoptimizer' ); ?>">

			<?php
			$shoptimizer_logo_mark_image = '';
			$shoptimizer_logo_mark_image = shoptimizer_get_option( 'shoptimizer_logo_mark_image' );

			$shoptimizer_header_layout = '';
			$shoptimizer_header_layout = shoptimizer_get_option( 'shoptimizer_header_layout' );

			if ( isset( $_GET['header'] ) ) {
				$shoptimizer_header_layout = $_GET['header'];
			}

			if ( $shoptimizer_logo_mark_image ) {
				?>
			<div class="primary-navigation with-logo">
			<?php } else { ?>

			<div class="primary-navigation">				
			<?php } ?>

			<?php if ( $shoptimizer_logo_mark_image ) { 
				if ( 'header-4' !== $shoptimizer_header_layout ) { ?>				
					<div class="logo-mark">
						<a href="#" rel="home">
							<img class="lazy" src="data:image/gif;base64,R0lGODdhAQABAPAAAMPDwwAAACwAAAAAAQABAAACAkQBADs=" data-src="<?php echo shoptimizer_safe_html( $shoptimizer_logo_mark_image ); ?>" data-srcset="<?php echo shoptimizer_safe_html( $shoptimizer_logo_mark_image ); ?>" alt="<?php bloginfo( 'name' ); ?>" />
						</a>    
					</div>

				<?php } 
			} ?>		
			<?php

			if ( has_nav_menu( 'primary' ) ) {
				?>
			<div class="menu-primary-menu-container">
				<?php
				wp_nav_menu(
					array(
						'container'      => '',
						'theme_location' => 'primary',
						'link_before'    => '<span>',
						'link_after'     => '</span>',
						'walker'         => new submenuwrap(),
					)
				);
				?>
			</div>
				<?php
			} else {
				?>
					
			<div class="menu-primary-menu-container">
				<ul id="menu-primary-menu" class="menu">
				<?php
					wp_list_pages(
						array(
							'container'   => '',
							'title_li'    => '',
							'link_before' => '<span>',
							'link_after'  => '</span>',
						)
					);
				?>
				</ul>
			</div>			
		<?php } ?>	

		</div>
		</nav><!-- #site-navigation -->
		<?php
	}
}

if ( ! function_exists( 'shoptimizer_secondary_navigation' ) ) {
	/**
	 * Display Secondary Navigation
	 *
	 * @since  1.0.0
	 * @return void
	 */
	function shoptimizer_secondary_navigation() {
		$shoptimizer_header_layout = '';
		$shoptimizer_header_layout = shoptimizer_get_option( 'shoptimizer_header_layout' );

		if ( isset( $_GET['header'] ) ) {
			$shoptimizer_header_layout = $_GET['header'];
		}

		if ( has_nav_menu( 'secondary' ) ) {

			// Don't enable this if header-4 is chosen.
			if ( 'header-4' !== $shoptimizer_header_layout ) { 
			?>
				<nav class="secondary-navigation" aria-label="<?php esc_html_e( 'Secondary Navigation', 'shoptimizer' ); ?>">
					<?php
						wp_nav_menu(
							array(
								'theme_location' => 'secondary',
								'fallback_cb'    => '',
							)
						);
					?>
				</nav><!-- #site-navigation -->
			<?php
			}
		}
	}
}

if ( ! function_exists( 'shoptimizer_skip_links' ) ) {
	/**
	 * Skip links
	 *
	 * @since  1.0.0
	 * @return void
	 */
	function shoptimizer_skip_links() {
		?>
		<a class="skip-link screen-reader-text" href="#site-navigation"><?php esc_attr_e( 'Skip to navigation', 'shoptimizer' ); ?></a>
		<a class="skip-link screen-reader-text" href="#content"><?php esc_attr_e( 'Skip to content', 'shoptimizer' ); ?></a>
		<?php
	}
}

if ( ! function_exists( 'shoptimizer_page_header' ) ) {
	/**
	 * Display the page header
	 *
	 * @since 1.0.0
	 */
	function shoptimizer_page_header() {
		?>
		<?php if (!is_page_template('template-fullwidth-no-heading.php') && ! is_page_template( 'template-blank-canvas.php' ) && !is_page_template('template-canvas.php')) { ?>
		<header class="entry-header">
			<?php
			the_title( '<h1 class="entry-title">', '</h1>' );
			?>
		</header><!-- .entry-header -->
		<?php } ?>
		<?php
		
	}
}

if ( ! function_exists( 'shoptimizer_page_content' ) ) {
	/**
	 * Display the post content
	 *
	 * @since 1.0.0
	 */
	function shoptimizer_page_content() {
		?>
		<div class="entry-content">
			<?php the_content(); ?>
			<?php
				wp_link_pages(
					array(
						'before' => '<div class="page-links">' . __( 'Pages:', 'shoptimizer' ),
						'after'  => '</div>',
					)
				);
			?>
		</div><!-- .entry-content -->
		<?php
	}
}

if ( ! function_exists( 'shoptimizer_post_header' ) ) {
	/**
	 * Display the post header with a link to the single post
	 *
	 * @since 1.0.0
	 */
	function shoptimizer_post_header() {
		?>
		<header class="entry-header">
		<?php
		if ( is_single() ) {
			the_title( '<h1 class="entry-title">', '</h1>' );
			shoptimizer_posted_on();
		} else {
			the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
			if ( 'post' === get_post_type() ) {
				shoptimizer_posted_on();
			}
		}
		?>
		</header><!-- .entry-header -->
		<?php
	}
}

if ( ! function_exists( 'shoptimizer_pages_sidebar' ) ) {
	/**
	 * Display the pages sidebar
	 *
	 * @since 1.0.0
	 */
	function shoptimizer_pages_sidebar() {
		?>
		<div id="secondary" class="widget-area" role="complementary">
			<?php dynamic_sidebar( 'sidebar-pages' ); ?>
		</div><!-- #secondary -->
		<?php
	}
}



if ( ! function_exists( 'shoptimizer_archive_post_content' ) ) {
	/**
	 * Display the post content with a link to the single post
	 *
	 * @since 1.0.0
	 */
	function shoptimizer_archive_post_content() {
		?>
		<div class="entry-content">
		<?php

		/**
		 * Functions hooked in to shoptimizer_post_content_before action.
		 *
		 * @hooked shoptimizer_post_thumbnail - 10
		 */

		the_excerpt();

		?>
		</div><!-- .entry-content -->
		<?php
	}
}

if ( ! function_exists( 'shoptimizer_post_content' ) ) {
	/**
	 * Display the post content with a link to the single post
	 *
	 * @since 1.0.0
	 */
	function shoptimizer_post_content() {
		?>
		<div class="entry-content">
		<?php

		/**
		 * Functions hooked in to shoptimizer_post_content_before action.
		 *
		 * @hooked shoptimizer_post_thumbnail - 10
		 */
		do_action( 'shoptimizer_post_content_before' );

		the_content(
			sprintf(
				__( 'Continue reading %s', 'shoptimizer' ),
				'<span class="screen-reader-text">' . get_the_title() . '</span>'
			)
		);

		do_action( 'shoptimizer_post_content_after' );

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'shoptimizer' ),
				'after'  => '</div>',
			)
		);
		?>
		</div><!-- .entry-content -->
		<?php
	}
}

if ( ! function_exists( 'shoptimizer_post_meta' ) ) {
	/**
	 * Display the post meta
	 *
	 * @since 1.0.0
	 */
	function shoptimizer_post_meta() {

	$shoptimizer_layout_blog_author = '';
	$shoptimizer_layout_blog_author = shoptimizer_get_option( 'shoptimizer_layout_blog_author' );

	$shoptimizer_layout_blog_meta = '';
	$shoptimizer_layout_blog_meta = shoptimizer_get_option( 'shoptimizer_layout_blog_meta' );

	$shoptimizer_layout_blog_prev_next = '';
	$shoptimizer_layout_blog_prev_next = shoptimizer_get_option( 'shoptimizer_layout_blog_prev_next' );


		?>
		<aside class="entry-meta">
			<?php
			if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search.

				?>
			<?php if ( true === $shoptimizer_layout_blog_author ) { ?>
			<div class="vcard author">
				
				<?php
					echo '<div class="avatar">';
					echo get_avatar( get_the_author_meta( 'ID' ), 256 );
					echo '</div>';
					echo '<div class="author-details">';
					echo sprintf(
						'<a href="%1$s" class="url fn" rel="author">%2$s</a>', esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
						get_the_author()
					);
					echo wp_kses_post( get_the_author_meta( 'description' ) );
					echo '</div>';
				?>
			</div>
			<?php } ?>

			<?php if ( true === $shoptimizer_layout_blog_meta ) { ?>
			<div class="post-meta">
				<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ', ', 'shoptimizer' ) );

				if ( $categories_list ) :
					?>
				<div class="cat-links">
						<?php
						echo '<div class="label">' . esc_attr( __( 'Posted in:', 'shoptimizer' ) ) . '</div>';
						echo wp_kses_post( $categories_list );
						?>
				</div>
				<?php endif; // End if categories. ?>

				<?php
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', __( ', ', 'shoptimizer' ) );

				if ( $tags_list ) :
					?>
				<div class="tags-links">
						<?php
						echo '<div class="label">' . esc_attr( __( 'Tagged:', 'shoptimizer' ) ) . '</div>';
						echo wp_kses_post( $tags_list );
						?>
				</div>
				<?php endif; // End if $tags_list. ?>

			</div>
			<?php } ?>

			<?php endif; // End if 'post' == get_post_type(). ?>

		</aside>

		<?php if ( true === $shoptimizer_layout_blog_prev_next ) { 
		if (is_singular('post')) {
		?>
		
		<div class="shoptimizer-posts-prev-next">

			<?php if ( get_previous_post() ) { ?>
		 	<div class="previous-post">
				<?php echo '<div class="title">' . esc_attr( __( 'Previous article', 'shoptimizer' ) ) . '</div>'; ?>
				<?php previous_post_link('%link'); ?>
			</div>

			<?php } if ( get_next_post() ) { ?>
			<div class="next-post">
				<?php echo '<div class="title">' . esc_attr( __( 'Next article', 'shoptimizer' ) ) . '</div>'; ?>
				<?php next_post_link('%link'); ?>
			</div>
	 
			<?php } ?> 

		</div>

		<?php 
			}
		} ?>

		<?php
	}
}

if ( ! function_exists( 'shoptimizer_paging_nav' ) ) {
	/**
	 * Display navigation to next/previous set of posts when applicable.
	 */
	function shoptimizer_paging_nav() {
		global $wp_query;

		$args = array(
			'type'      => 'list',
			'next_text' => _x( '', 'Next post', 'shoptimizer' ),
			'prev_text' => _x( '', 'Previous post', 'shoptimizer' ),
		);

		the_posts_pagination( $args );
	}
}

if ( ! function_exists( 'shoptimizer_post_nav' ) ) {
	/**
	 * Display navigation to next/previous post when applicable.
	 */
	function shoptimizer_post_nav() {
		$args = array(
			'next_text' => '%title',
			'prev_text' => '%title',
		);
		the_post_navigation( $args );
	}
}

if ( ! function_exists( 'shoptimizer_posted_on' ) ) {
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function shoptimizer_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time> <time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			_x( '%s', 'post date', 'shoptimizer' ),
			'' . $time_string . ''
		);

		echo wp_kses(
			apply_filters( 'shoptimizer_single_post_posted_on_html', '<span class="posted-on">' . $posted_on . '</span>', $posted_on ), array(
				'span' => array(
					'class' => array(),
				),
				'a'    => array(
					'href'  => array(),
					'title' => array(),
					'rel'   => array(),
				),
				'time' => array(
					'datetime' => array(),
					'class'    => array(),
				),
			)
		);
	}
}

if ( ! function_exists( 'shoptimizer_get_sidebar' ) ) {
	/**
	 * Display shoptimizer sidebar
	 *
	 * @uses get_sidebar()
	 * @since 1.0.0
	 */
	function shoptimizer_get_sidebar() {
		get_sidebar();
	}
}

if ( ! function_exists( 'shoptimizer_post_thumbnail' ) ) {
	/**
	 * Display post thumbnail with a link.
	 *
	 * @var $size thumbnail size. thumbnail|medium|large|full|$custom
	 * @uses has_post_thumbnail()
	 * @uses the_post_thumbnail
	 * @param string $size the post thumbnail size.
	 * @since 1.0.0
	 */
	function shoptimizer_post_thumbnail( $size = 'full' ) {
		if ( has_post_thumbnail() ) {
			echo '<a class="post-thumbnail" href="' . esc_url( get_permalink() ) . '">';
			the_post_thumbnail( $size );
			echo '</a>';
		}
	}
}

if ( ! function_exists( 'shoptimizer_post_thumbnail_no_link' ) ) {
	/**
	 * Display post thumbnail.
	 *
	 * @var $size thumbnail size. thumbnail|medium|large|full|$custom
	 * @uses has_post_thumbnail()
	 * @uses the_post_thumbnail
	 * @param string $size the post thumbnail size.
	 * @since 1.0.0
	 */
	function shoptimizer_post_thumbnail_no_link( $size = 'full' ) {

		$shoptimizer_post_featured_image = '';
		$shoptimizer_post_featured_image = shoptimizer_get_option( 'shoptimizer_post_featured_image' );

		if ( true === $shoptimizer_post_featured_image ) {
			if ( has_post_thumbnail() ) {
				the_post_thumbnail( $size );
			}
		}
	}
}

/**
 * Mobile Extra. Appears below the mobile navigation area.
 */
function shoptimizer_mobile_extra_field() {

	if ( is_active_sidebar( 'mobile-extra' ) ) :
		echo '<div class="mobile-extra">';
		dynamic_sidebar( 'mobile-extra' );
		echo '</div>';
	endif;

}

/**
 * Add a responsive container to embeds.
 *
 * @param text $html adds a wrapping div around videos for a better responsive display.
 */
function shoptimizer_embed_html( $html ) {
	return '<div class="video-container">' . $html . '</div>';
}

add_filter( 'embed_oembed_html', 'shoptimizer_embed_html', 10, 3 );
add_filter( 'video_embed_html', 'shoptimizer_embed_html' ); // Jetpack.

if ( ! function_exists( 'shoptimizer_primary_navigation_wrapper' ) ) {
	/**
	 * The primary navigation wrapper
	 */
	function shoptimizer_primary_navigation_wrapper() {

		if ( has_nav_menu( 'primary' ) ) {
			echo '<div class="shoptimizer-primary-navigation col-full">';
		} else {
			echo '<div class="shoptimizer-primary-navigation col-full simple-menu">';
		}
	}
}

if ( ! function_exists( 'shoptimizer_primary_navigation_wrapper_close' ) ) {
	/**
	 * The primary navigation wrapper close
	 */
	function shoptimizer_primary_navigation_wrapper_close() {
		echo '</div>';
	}
}


if ( ! function_exists( 'shoptimizer_mobile_menu_close' ) ) {
	/**
	 * The primary navigation wrapper close
	 */
	function shoptimizer_mobile_menu_close() {
		echo '<div class="mobile-menu close-drawer"></div>';
	}
}

/**
 * Allow HTML in Menu Descriptions.
 */
remove_filter( 'nav_menu_description', 'strip_tags' );

function shoptimizer_html_menu_descriptions( $menu_item ) {
    if ( isset( $menu_item->post_type ) ) {
        if ( 'nav_menu_item' == $menu_item->post_type ) {
            $menu_item->description = apply_filters( 'nav_menu_description', $menu_item->post_content );
        }
    }
    return $menu_item;
}

add_filter( 'wp_setup_nav_menu_item', 'shoptimizer_html_menu_descriptions' );

/**
 * Page template without title and breadcrumbs
 */
function shoptimizer_remove_title() {
	if ( is_page_template( 'template-fullwidth-no-heading.php' ) ) {
		remove_action( 'shoptimizer_content_top', 'woocommerce_breadcrumb', 10 );
	}
}

add_action( 'shoptimizer_loop_post', 'shoptimizer_loop_wrapper_start', 8 );
add_action( 'shoptimizer_loop_post', 'shoptimizer_loop_wrapper_end', 35 );

/**
 * Blog loop. Add wrapper class start.
 */
function shoptimizer_loop_wrapper_start() {
	echo '<div class="blog-loop-content-wrapper">';
}

/**
 * Blog loop. Add wrapper class end.
 */
function shoptimizer_loop_wrapper_end() {
	echo '</div>';
}

/**
 * Enable shortcodes within category description area.
 */
add_filter( 'term_description', 'do_shortcode' );


/**
 * Adds a body class if the breadcrumbs have been disabled.
 */
function shoptimizer_breadcrumbs_body_class( $classes ) {

	$shoptimizer_layout_woocommerce_display_breadcrumbs = '';
	$shoptimizer_layout_woocommerce_display_breadcrumbs = shoptimizer_get_option( 'shoptimizer_layout_woocommerce_display_breadcrumbs' );

	if ( 'disable' === $shoptimizer_layout_woocommerce_display_breadcrumbs ) {
		$classes[] = 'no-breadcrumbs';
	}
	return $classes;
}

add_filter( 'body_class', 'shoptimizer_breadcrumbs_body_class' );

/**
 * Sets body classes depending on which sidebars have been selected.
 */
function shoptimizer_sidebar_body_class( $classes ) {

	$shoptimizer_layout_archives_sidebar = '';
	$shoptimizer_layout_archives_sidebar = shoptimizer_get_option( 'shoptimizer_layout_archives_sidebar' );

	$classes[] = $shoptimizer_layout_archives_sidebar;
	return $classes;
}

add_filter( 'body_class', 'shoptimizer_sidebar_body_class' );

/**
 * Post sidebar body class.
 */
add_filter( 'body_class', 'shoptimizer_post_sidebar_body_class' );
function shoptimizer_post_sidebar_body_class( $classes ) {
	$shoptimizer_layout_post_sidebar = '';
	$shoptimizer_layout_post_sidebar = shoptimizer_get_option( 'shoptimizer_layout_post_sidebar' );

    if ( is_single() ) {
        $classes[] = $shoptimizer_layout_post_sidebar;
    }
    return $classes;
}

/**
 * Page sidebar body class.
 */
add_filter( 'body_class', 'shoptimizer_page_sidebar_body_class' );
function shoptimizer_page_sidebar_body_class( $classes ) {
	$shoptimizer_layout_page_sidebar = '';
	$shoptimizer_layout_page_sidebar = shoptimizer_get_option( 'shoptimizer_layout_page_sidebar' );

    if ( basename(get_page_template() ) == 'page.php' ) {
        $classes[] = $shoptimizer_layout_page_sidebar;
    }
    return $classes;
}


/**
 * Credit card image in footer shortcode.
 */
add_shortcode('shoptimizer_creditcards', function(){
    return "<img class='alignright' alt='Credit cards' src='" . get_template_directory_uri() . "/assets/images/credit-cards.png'>";
});

/**
 * 404 page.
 */
if ( ! function_exists( 'shoptimizer_entry_content_404_page_template' ) ) {

	/**
	 * content-404.php
	 *
	 * @since 2.3.6
	 */
	function shoptimizer_entry_content_404_page_template() {
		get_template_part( 'content', '404' );
	}
}

/**
 * 404 page template action.
 */
function shoptimizer_404_template() {
	do_action( 'shoptimizer_404_template' );
}

/**
 * Blank Canvas template.
 */
add_action('template_redirect', 'shoptimizer_blank_canvas_template', 10);

function shoptimizer_blank_canvas_template() {

    if (is_page_template('template-blank-canvas.php')) {
	    remove_action( 'shoptimizer_topbar', 'shoptimizer_top_bar', 10 );
		remove_action( 'shoptimizer_header', 'shoptimizer_site_branding', 20 );
		remove_action( 'shoptimizer_header', 'shoptimizer_product_search', 25 );
		remove_action( 'shoptimizer_header', 'shoptimizer_secondary_navigation', 30 );
		remove_action( 'shoptimizer_header', 'shoptimizer_header_cart', 50 );
		remove_action( 'shoptimizer_header', 'shoptimizer_sticky_js_trigger', 90 );

		remove_action( 'shoptimizer_navigation', 'shoptimizer_primary_navigation_wrapper', 42 );
		remove_action( 'shoptimizer_navigation', 'shoptimizer_primary_navigation', 50 );
		remove_action( 'shoptimizer_navigation', 'shoptimizer_header_cart', 60 );
		remove_action( 'shoptimizer_navigation', 'shoptimizer_primary_navigation_wrapper_close', 68 );
		remove_action( 'shoptimizer_navigation', 'shoptimizer_header_wrapper_close', 75 );

		remove_action( 'shoptimizer_before_content', 'shoptimizer_header_widget_region', 10 );

		remove_action( 'shoptimizer_before_footer', 'shoptimizer_below_content', 10 );
		remove_action( 'shoptimizer_footer', 'shoptimizer_footer_widgets', 20 );
		remove_action( 'shoptimizer_footer', 'shoptimizer_footer_copyright', 30 );
   }

}