<?php
/* De-register Contact Form 7 styles */
add_filter( 'wpcf7_load_js', '__return_false' );
add_filter( 'wpcf7_load_css', '__return_false' );

// Main Styles
function thb_main_styles() {
	global $post;
	$i                       = 0;
	$self_hosted_fonts       = ot_get_option( 'self_hosted_fonts' );
	$thb_theme_directory_uri = Thb_Theme_Admin::$thb_theme_directory_uri;
	$thb_theme_version       = Thb_Theme_Admin::$thb_theme_version;

	// Enqueue
	wp_enqueue_style( 'thb-fa', esc_url( $thb_theme_directory_uri ) . 'assets/css/font-awesome.min.css', null, '4.7.0' );
	wp_enqueue_style( 'thb-app', esc_url( $thb_theme_directory_uri ) . 'assets/css/app.css', null, esc_attr( $thb_theme_version ) );

	if ( ! defined( 'THB_DEMO_SITE' ) ) {
		wp_enqueue_style( 'thb-style', get_stylesheet_uri(), null, esc_attr( $thb_theme_version ) );
	}

	wp_enqueue_style( 'thb-google-fonts', thb_google_webfont(), null, esc_attr( $thb_theme_version ) );
	wp_add_inline_style( 'thb-app', thb_selection() );

	$thb_custom_css = '
	 .hesperiden.tparrows.tp-leftarrow,
	 .slick-nav.slick-prev {
	   cursor: url("' . esc_url( $thb_theme_directory_uri ) . 'assets/img/arrow-left.svg"),
	   				url("' . esc_url( $thb_theme_directory_uri ) . 'assets/img/arrow-left.cur"), w-resize;
	 }
	 .arrows-light  .hesperiden.tparrows.tp-leftarrow,
	 .arrows-light .slick-nav.slick-prev {
	   cursor: url("' . esc_url( $thb_theme_directory_uri ) . 'assets/img/arrow-left-light.svg"),
	   				url("' . esc_url( $thb_theme_directory_uri ) . 'assets/img/arrow-left-light.cur"), w-resize;
	 }
	 .hesperiden.tparrows.tp-rightarrow,
	 .slick-nav.slick-next {
	   cursor: url("' . esc_url( $thb_theme_directory_uri ) . 'assets/img/arrow-right.svg"),
	   				url("' . esc_url( $thb_theme_directory_uri ) . 'assets/img/arrow-right.cur"), e-resize;
	 }
	 .arrows-light .hesperiden.tparrows.tp-rightarrow,
	 .arrows-light .slick-nav.slick-next {
	   cursor: url("' . esc_url( $thb_theme_directory_uri ) . 'assets/img/arrow-right-light.svg"),
	   				url("' . esc_url( $thb_theme_directory_uri ) . 'assets/img/arrow-right-light.cur"), e-resize;
	 }
	';
	wp_add_inline_style( 'thb-app', $thb_custom_css );

	if ( $self_hosted_fonts ) {
		foreach ( $self_hosted_fonts as $font ) {
			$i++;
			wp_enqueue_style( 'thb-self-hosted-' . $i, $font['font_url'], null, esc_attr( $thb_theme_version ) );
		}
	}

	if ( $post ) {
		if ( has_shortcode( $post->post_content, 'contact-form-7' ) && function_exists( 'wpcf7_enqueue_styles' ) ) {
			wpcf7_enqueue_styles();
		}
	}
}

add_action( 'wp_enqueue_scripts', 'thb_main_styles' );


// Main Scripts.
function thb_register_js() {
	if ( ! is_admin() ) {
		global $post;
		$thb_combined_libraries  = ot_get_option( 'thb_combined_libraries', 'on' );
		$thb_api_key             = ot_get_option( 'map_api_key' );
		$thb_dependency          = array( 'jquery', 'underscore' );
		$thb_theme_directory_uri = Thb_Theme_Admin::$thb_theme_directory_uri;
		$thb_theme_version       = Thb_Theme_Admin::$thb_theme_version;

		// Register.
		wp_register_script( 'thb-gmapdep', 'https://maps.google.com/maps/api/js?key='.esc_attr( $thb_api_key ), false, esc_attr( $thb_theme_version ), false );
		if ( 'on' === $thb_combined_libraries ) {
			wp_register_script( 'thb-vendor', esc_url( $thb_theme_directory_uri ) . 'assets/js/vendor.min.js', array( 'jquery' ), esc_attr( $thb_theme_version ), true );
			$thb_dependency[] = 'thb-vendor';
		} else {
			$thb_js_libraries = array(
				'TweenMax'                  => '_0TweenMax.min.js',
				'TweenMax-ScrollToPlugin'   => '_2ScrollToPlugin.min.js',
				'fresco'                    => 'fresco.js',
				'jquery-foundation-plugins' => 'jquery.foundation.plugins.js',
				'isotope'                   => 'isotope.pkgd.min.js',
				'magnific-popup'            => 'jquery.magnific-popup.min.js',
				'jquery-mousewheel'         => 'jquery.mousewheel.js',
				'jquery-nav'                => 'jquery.nav.js',
				'jquery-stellar'            => 'jquery.stellar.js',
				'vide'                      => 'jquery.vide.js',
				'onepage-scroll'            => 'onepage-scroll.js',
				'isotope-packery-mode'      => 'packery-mode.pkgd.min.js',
				'perfect-scrollbar'         => 'perfect-scrollbar.jquery.min.js',
				'slick'                     => 'slick.js',
			);
			foreach ( $thb_js_libraries as $handle => $value ) {
				wp_enqueue_script( $handle, esc_url( $thb_theme_directory_uri ) . 'assets/js/vendor/' . esc_attr( $value ), array( 'jquery' ), esc_attr( $thb_theme_version ), true );
			}
		}
		wp_register_script( 'thb-app', esc_url( $thb_theme_directory_uri ) . 'assets/js/app.min.js', $thb_dependency, esc_attr(Thb_Theme_Admin::$thb_theme_version), true );

		// Typekit
		if ( $typekit_id = ot_get_option( 'typekit_id' ) ) {
			wp_enqueue_script( 'thb-typekit', 'https://use.typekit.net/'.$typekit_id.'.js', array(), null, false );
			wp_add_inline_script( 'thb-typekit', 'try{Typekit.load({ async: true });}catch(e){}' );
		}

		// Google Map
		if ( $post ) {
			if ( is_page() && has_shortcode( $post->post_content, 'thb_contactmap' ) ) {
				wp_enqueue_script( 'thb-gmapdep' );
			}
			if ( has_shortcode( $post->post_content, 'contact-form-7' ) && function_exists( 'wpcf7_enqueue_scripts' ) ) {
				wpcf7_enqueue_scripts();
			}
		}
		// YITH Ajax Product Search
		if ( class_exists( 'YITH_WCAS' ) ) {
			wp_enqueue_script( 'yith_wcas_frontend' );
		}
		// Enqueue
		if ( is_singular() && comments_open() && ( get_option( 'thread_comments' ) == 1) ) {
			wp_enqueue_script( 'comment-reply' );
		}
		wp_enqueue_script( 'underscore' );
		wp_enqueue_script( 'thb-vendor' );
		wp_enqueue_script( 'thb-app' );
		wp_localize_script( 'thb-app', 'themeajax',
			array (
				'themeurl' => get_template_directory_uri(),
				'url'      => admin_url( 'admin-ajax.php' ),
				'l10n'     => array(
					'loadmore'        => esc_html__( 'Load More', 'bronx' ),
					'loading'         => esc_html__( 'Loading ...', 'bronx' ),
					'nomore'          => esc_html__( 'All Posts Loaded', 'bronx' ),
					'nomore_products' => esc_html__( 'All Products Loaded', 'bronx' ),
					'adding_to_cart'  => esc_html__( 'Adding to Cart', 'bronx' ),
				),
				'settings' => array (
					'shop_product_listing_pagination' => ot_get_option( 'shop_product_listing_pagination', 'style1' ),
				),
			)
		);
	}
}
add_action( 'wp_enqueue_scripts', 'thb_register_js' );

/* WooCommerce */
add_filter( 'woocommerce_enqueue_styles', '__return_false' );