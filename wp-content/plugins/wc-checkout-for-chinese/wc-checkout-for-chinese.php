<?php

/**
 * @Author: suifengtec
 * @Date:   2018-01-21 18:42:54
 * @Last Modified by:   suifengtec
 * @Last Modified time: 2018-01-22 07:00:31
 **/
/**
 * Plugin Name: WC Checkout For Chinese
 * Plugin URI: http://bbs.coolwp.org/topic/566-wc-checkout-for-chinese/
 * Description: WooCommerce 结算页面中国本地化.
 * Author: suifengtec
 * Author URI: https://coolwp.com
 * Version:1.0.0
 * Text Domain: wcc4c
 * Domain Path: /languages/
 *
 */

if ( ! defined( 'ABSPATH' ) ){
    exit;
}

if ( ! class_exists( 'WC_C4C' ) ) :

final class WC_C4C {


    /*current version*/
    public static $ver = '1.0.0';
    /*is development mode*/
    public static $isDev = false;
    /*
    dev: WC_C4C::$onlyShippToChina
     */
    public static $onlyShippToChina = true;
    private static $instance;
    public function __wakeup() {}
    public function __clone() {}
    public static function instance() {

        if ( ! isset( self::$instance ) && ! ( self::$instance instanceof WC_C4C ) ) {
            self::$instance = new self();
            self::$instance->setup_constants();
            self::$instance->hooks();
        }

        return self::$instance;

    }

    public function hooks(){

        spl_autoload_register( array( __CLASS__, '_autoload' ));

        add_action( 'wp_enqueue_scripts', array(__CLASS__, 'wp_enqueue_scripts') );
/*        add_action( 'admin_enqueue_scripts', array(__CLASS__, 'admin_enqueue_scripts') );*/
        add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), array( __CLASS__, 'plugin_action_links' ) );

        new WC_C4C_Module_Checkout;

    }



    public static function plugin_action_links(  $links ){

        /*$links[] = '<a href="' . admin_url( 'admin.php?page=xxx' ) . '">Settings</a>';*/
        $links[] = '<a href="http://bbs.coolwp.org/topic/566-wc-checkout-for-chinese/" target="_blank">文档/支持</a>';
        return $links;

    }

    public static function admin_enqueue_scripts($hook){


        $min = self::$isDev?'':'.min';
        wp_register_script( 'wcc4c-frontend-js', WCC4C_PLUGIN_URL . 'assets/js/wcc4c-f'.$min.'.js', array('jquery'),self::$isDev? time():self::$ver, true );
        wp_localize_script(  'wcc4c-frontend-js', 'wcc4c', array(
            'ajaxurl'       => admin_url( 'admin-ajax.php' ),
            'nonce'         => wp_create_nonce( 'wcc4c_nonce' ),
        ) );
        wp_enqueue_script( 'wcc4c-frontend-js');


    }

    public static function wp_enqueue_scripts(){

        $min = self::$isDev?'':'.min';
        wp_register_script( 'wcc4c-frontend-js', WCC4C_PLUGIN_URL . 'assets/js/wcc4c-f'.$min.'.js', array('jquery'),self::$isDev? time():self::$ver, true );
        wp_localize_script(  'wcc4c-frontend-js', 'wcc4c', array(
            'ajaxurl'       => admin_url( 'admin-ajax.php' ),
            'nonce'         => wp_create_nonce( 'wcc4c_nonce' ),
        ) );
        wp_enqueue_script( 'wcc4c-frontend-js');

    }

    public static function _autoload( $class ) {

        if ( stripos( $class, 'WC_C4C_' ) !== false ) {

            $module = ( stripos( $class, '_Module_' ) !== false ) ? true : false;

            if($module){
                    $class_name = str_replace( array('WC_C4C_Module_', '_'), array('', '-'), $class );
                     $filename = dirname( __FILE__ ) . '/modules/' . strtolower( $class_name ) . '.php';
            }

            if ( file_exists( $filename ) ) {
                require_once $filename;
            }
        }
    }

    private function setup_constants() {

        if ( ! defined( 'WCC4C_PLUGIN_DIR' ) ) {
            define( 'WCC4C_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
        }
        if ( ! defined( 'WCC4C_PLUGIN_URL' ) ) {
            define( 'WCC4C_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
        }
        if ( ! defined( 'WCC4C_PLUGIN_FILE' ) ) {
            define( 'WCC4C_PLUGIN_FILE', __FILE__ );
        }
    }
}
global $wcc4c;
$wcc4c = WC_C4C::instance();
endif;
