<?php

/**
 * Coupon plugin main class
 *
 * @author subrata
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
/**
 * 
 */
final class WOO_WALLET_COUPONS {

    /**
     * The single instance of the class.
     *
     * @var WOO_WALLET_COUPONS
     * @since 1.0.0
     */
    protected static $_instance = null;
    /**
     * Plugin license API class.
     * @var Woo_Wallet_License
     */
    public $licence = null;

    /**
     * Main instance
     * @return class object
     */
    public static function instance() {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * Class constructor
     */
    public function __construct() {
        if (Woo_Wallet_Dependencies::is_woo_wallet_active()) {
            $this->define_constants();
            $this->includes();
            $this->init_hooks();
            do_action('woo_wallet_coupons_loaded');
        } else {
            add_action('admin_notices', array($this, 'admin_notices'), 15);
        }
    }

    /**
     * Constants define
     */
    private function define_constants() {
        $this->define('WOO_WALLET_COUPONS_ABSPATH', dirname(WOO_WALLET_COUPONS_PLUGIN_FILE) . '/');
        $this->define('WOO_WALLET_COUPONS_PLUGIN_NAME', 'WooWallet Coupon');
        $this->define('WOO_WALLET_COUPONS_PLUGIN_SERVER_URL', 'https://woowallet.in/');
        $this->define('WOO_WALLET_COUPONS_PLUGIN_TOKEN', 'woo-wallet-coupons');
        $this->define('WOO_WALLET_COUPONS_VERSION', '1.0.3');
    }

    /**
     * 
     * @param string $name
     * @param mixed $value
     */
    private function define($name, $value) {
        if (!defined($name)) {
            define($name, $value);
        }
    }

    /**
     * Check request
     * @param string $type
     * @return bool
     */
    private function is_request($type) {
        switch ($type) {
            case 'admin' :
                return is_admin();
            case 'ajax' :
                return defined('DOING_AJAX');
            case 'cron' :
                return defined('DOING_CRON');
            case 'frontend' :
                return (!is_admin() || defined('DOING_AJAX') ) && !defined('DOING_CRON');
        }
    }

    /**
     * load plugin files
     */
    public function includes() {
        include_once(WOO_WALLET_COUPONS_ABSPATH . 'includes/class-woo-wallet-coupons-post-type.php');

        if ($this->is_request('admin')) {
            include_once(WOO_WALLET_COUPONS_ABSPATH . 'includes/class-woo-wallet-coupons-admin.php');
            include_once(WOO_WALLET_COUPONS_ABSPATH . 'includes/class-woo-wallet-license.php');
        }
        if ($this->is_request('frontend')) {
            include_once(WOO_WALLET_COUPONS_ABSPATH . 'includes/class-woo-wallet-coupons-frontend.php');
        }
    }

    /**
     * Plugin init
     */
    private function init_hooks() {
        // Set up localisation.
        $this->load_plugin_textdomain();
        
        add_action('admin_init', array($this, 'admin_init'));
        add_action('woocommerce_loaded', array($this, 'woocommerce_loaded'));
    }
    
    public function admin_init(){
        $plugin = array(
            'plugin_server_url' => WOO_WALLET_COUPONS_PLUGIN_SERVER_URL,
            'plugin_token' => WOO_WALLET_COUPONS_PLUGIN_TOKEN,
            'version' => WOO_WALLET_COUPONS_VERSION
        );
        $this->licence = new Woo_Wallet_License($plugin);
    }

    /**
     * Load Localisation files.
     *
     * Note: the first-loaded translation file overrides any following ones if the same translation is present.
     *
     */
    public function load_plugin_textdomain() {
        $locale = is_admin() && function_exists('get_user_locale') ? get_user_locale() : get_locale();
        $locale = apply_filters('plugin_locale', $locale, 'woo-wallet-coupons');

        unload_textdomain('woo-wallet-coupons');
        load_textdomain('woo-wallet-coupons', WP_LANG_DIR . '/woo-wallet-coupons/woo-wallet-coupons-' . $locale . '.mo');
        load_plugin_textdomain('woo-wallet-coupons', false, plugin_basename(dirname(WOO_WALLET_COUPONS_PLUGIN_FILE)) . '/languages');
    }

    public function woocommerce_loaded() {
        include_once(WOO_WALLET_COUPONS_ABSPATH . 'includes/class-woo-wallet-coupon.php');
    }

    public function woo_wallet_coupons_logger($message) {
        if (defined('WP_DEBUG') && WP_DEBUG) {
            $this->logger = wc_get_logger();
            $this->logger->debug($message, array('source' => 'woo-wallet-coupons'));
        }
    }

    /**
     * Load template
     * @param string $template_name
     * @param array $args
     * @param string $template_path
     * @param string $default_path
     */
    public function get_template($template_name, $args = array(), $template_path = '', $default_path = '') {
        if ($args && is_array($args)) {
            extract($args);
        }
        $located = $this->locate_template($template_name, $template_path, $default_path);
        include ($located);
    }

    /**
     * Locate template file
     * @param string $template_name
     * @param string $template_path
     * @param string $default_path
     * @return string
     */
    public function locate_template($template_name, $template_path = '', $default_path = '') {
        $default_path = apply_filters('woo_wallet_coupons_template_path', $default_path);
        if (!$template_path) {
            $template_path = 'woo-wallet-coupons';
        }
        if (!$default_path) {
            $default_path = WOO_WALLET_COUPONS_ABSPATH . 'templates/';
        }
        // Look within passed path within the theme - this is priority
        $template = locate_template(array(trailingslashit($template_path) . $template_name, $template_name));
        // Add support of third perty plugin
        $template = apply_filters('woo_wallet_coupons_locate_template', $template, $template_name, $template_path, $default_path);
        // Get default template
        if (!$template) {
            $template = $default_path . $template_name;
        }
        return $template;
    }

    /**
     * Plugin url
     * @return string path
     */
    public function plugin_url() {
        return untrailingslashit(plugins_url('/', WOO_WALLET_COUPONS_PLUGIN_FILE));
    }
    
    public function deactivation_hook() {
        woo_wallet_coupons()->licence->uninstall();
    }

    /**
     * Display admin notice
     */
    public function admin_notices() {
        echo '<div class="error"><p>';
        _e('WooCommerce Wallet Coupon plugin requires <a href="http://wordpress.org/extend/plugins/woo-wallet/">WooCommerce Wallet</a> plugins to be active!', 'woo-wallet-coupons');
        echo '</p></div>';
    }

}
