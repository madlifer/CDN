<?php

/*
 * Here we have all the custom functions for the theme
 * Please be extremely cautious editing this file.
 * You have been warned!
 *
 */

// Option-Tree Theme Mode.
require get_theme_file_path( '/inc/admin/option-tree/init.php' );

// Theme Admin.
require get_theme_file_path( '/inc/admin/welcome/fuelthemes.php' );

// TGM Plugin Activation Class.
require get_theme_file_path( '/inc/admin/plugins/plugins.php' );

// Imports.
require get_theme_file_path( '/inc/admin/imports/import.php' );

// Script Calls.
require get_theme_file_path( '/inc/script-calls.php' );

// Ajax.
require get_theme_file_path( '/inc/ajax.php' );

// Add Menu Support.
require get_theme_file_path( '/inc/wp3menu.php' );

// Enable Sidebars.
require get_theme_file_path( '/inc/sidebar.php' );

// Misc.
require get_theme_file_path( '/inc/misc.php' );

// CSS Output of Theme Options.
require get_theme_file_path( '/inc/selection.php' );

// Twitter oAuth.
require get_theme_file_path( '/inc/framework/thb-twitter-helper.php' );

// Instagram.
require get_theme_file_path( '/inc/framework/thb-random-user-agent.php' );
require get_theme_file_path( '/inc/framework/thb-instagram.php' );

// WPML Support.
require get_theme_file_path( '/inc/wpml.php' );

// WooCommerce Settings specific for theme.
require get_theme_file_path( '/inc/woocommerce.php' );
require get_theme_file_path( '/inc/framework/woocommerce-category-image.php' );

// Visual Composer Integration.
require get_theme_file_path( '/inc/framework/visualcomposer/visualcomposer.php' );

add_filter( 'woocommerce_currencies', 'add_my_currency' );
 
function add_my_currency( $currencies ) {
     $currencies['CNY'] = __( '人民币', 'woocommerce' );
     return $currencies;
}
 
add_filter('woocommerce_currency_symbol', 'add_my_currency_symbol', 10, 2);
 
function add_my_currency_symbol( $currency_symbol, $currency ) {
     switch( $currency ) {
          case 'CNY': $currency_symbol = '￥'; break;
     }
     return $currency_symbol;
}