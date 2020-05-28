<?php
require Thb_Theme_Admin::$thb_theme_directory . 'inc/admin/plugins/class-tgm-plugin-activation.php';

function thb_register_required_plugins() {
	$data = thb_Theme_Admin()->thb_check_for_update_plugins();

	if (isset($data->plugins)) {
		foreach ($data->plugins as $plugin) {
			switch ($plugin->plugin_name) {
				case 'WPBakery Visual Composer':
				case 'WPBakery Page Builder':
					$slug = 'js_composer';
					break;
				case 'Slider Revolution':
					$slug = 'revslider';
					break;
				case 'WooCommerce Product Filter':
					$slug = 'product_filter';
					break;
				case 'WooCommerce PDF Invoice':
					$slug = 'pdf_invoice';
					break;
				case 'WooCommerce Table Rate Shipping':
					$slug = 'table_rate';
					break;
				case 'WooCommerce Dynamic Pricing & Discounts':
					$slug = 'dynamic_pricing';
					break;
			}
			$plugins[] = array(
				'name'               => $plugin->plugin_name,
				'slug'               => $slug,
				'source'             => $plugin->download_url,
				'force_activation'   => false,
				'force_deactivation' => false,
				'version'            => $plugin->version,
				'required'           => true,
				'external_url'       => '',
				'image_url'          => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/plugins/' . esc_attr( $slug ) . '.png',
			);
		}
	} else {
		$plugins[] = array(
			'name'      => 'WPBakery Visual Composer',
			'slug'      => 'js_composer',
			'source'    => get_stylesheet_directory(). '/inc/admin/plugins/plugins/codecanyon-242431-visual-composer-page-builder-for-wordpress-wordpress-plugin.zip',
			'version'  	=> '6.0.2',
			'required'  => true,
			'image_url' => Thb_Theme_Admin::$thb_theme_directory_uri .'assets/img/admin/plugins/js_composer.png'
		);
		$plugins[] = array(
			'name'      => 'Slider Revolution',
			'slug'      => 'revslider',
			'source'    => get_stylesheet_directory() . '/inc/admin/plugins/plugins/codecanyon-2751380-slider-revolution-responsive-wordpress-plugin-wordpress-plugin.zip',
			'version'   => '5.4.8.3',
			'required'  => true,
			'image_url' => Thb_Theme_Admin::$thb_theme_directory_uri .'assets/img/admin/plugins/revslider.png',
		);
	}
	$plugins[] = array(
		'name'               => esc_html__( 'WooCommerce', 'bronx' ),
		'slug'               => 'woocommerce',
		'required'           => true,
		'force_activation'   => false,
		'force_deactivation' => false,
		'image_url'          => Thb_Theme_Admin::$thb_theme_directory_uri .'assets/img/admin/plugins/woo.png',
	);
	$plugins[] = array(
		'name'               => esc_html__( 'Bronx - Required Plugin', 'bronx' ),
		'slug'               => 'bronx-plugin',
		'source'             => get_stylesheet_directory() . '/inc/plugins/bronx-plugin.zip',
		'version'            => '1.1.3.3',
		'required'			     => true,
		'force_activation'   => false,
		'force_deactivation' => false,
		'image_url'          => Thb_Theme_Admin::$thb_theme_directory_uri .'assets/img/admin/plugins/bronx.png',
	);
	$plugins[] = array(
		'name'               => esc_html__( 'Contact Form 7', 'bronx' ),
		'slug'               => 'contact-form-7',
		'required'           => false,
		'force_activation'   => false,
		'force_deactivation' => false,
	);
	$config = array(
		'id'           => 'thb',
		'domain'       => 'bronx',
		'default_path' => '',
		'parent_slug'  => 'themes.php',
		'menu'         => 'install-required-plugins',
		'has_notices'  => true,
		'is_automatic' => false,
		'message'      => '',
		'strings'      => array(
			'return' => esc_html__( 'Return to Theme Plugins', 'bronx' ),
		)
	);
	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'thb_register_required_plugins' );