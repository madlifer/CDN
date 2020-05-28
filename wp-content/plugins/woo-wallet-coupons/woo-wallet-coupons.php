<?php

/*
 * Plugin Name: WooCommerce Wallet Coupons
 * Plugin URI: http://woowallet.in/
 * Description: Create coupons that can be redeemed to the user wallet.
 * Author: Subrata Mal
 * Author URI: https://profiles.wordpress.org/subratamal
 * Version: 1.0.3
 * Requires at least: 4.4
 * Tested up to: 5.3
 * WC requires at least: 3.0
 * WC tested up to: 3.8
 * 
 * Text Domain: woo-wallet-coupons
 * Domain Path: /languages/
 */

if (!defined('ABSPATH')) {
    exit;
}

// Define WOO_WALLET_COUPONS_PLUGIN_FILE.
if (!defined('WOO_WALLET_COUPONS_PLUGIN_FILE')) {
    define('WOO_WALLET_COUPONS_PLUGIN_FILE', __FILE__);
}

// include dependencies file
if(!class_exists('Woo_Wallet_Dependencies')){
    include_once dirname(__FILE__) . '/includes/class-woo-wallet-dependencies.php';
}

// Include the main class.
if (!class_exists('WOO_WALLET_COUPONS')) {
    include_once dirname(__FILE__) . '/includes/class-woo-wallet-coupons.php';
}

function woo_wallet_coupons(){
    return WOO_WALLET_COUPONS::instance();
}

if (Woo_Wallet_Dependencies::is_woo_wallet_active()) {
    register_deactivation_hook(__FILE__, array(woo_wallet_coupons(), 'deactivation_hook'));
}
$GLOBALS['woo_wallet_coupons'] = woo_wallet_coupons();