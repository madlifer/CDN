<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Woo_Wallet_Coupons_Admin {

    public function __construct() {
        add_action('admin_menu', array($this, 'admin_menu'), 55);
        add_action('admin_enqueue_scripts', array($this, 'admin_scripts'), 10);
        add_filter('woo_wallet_extensions_settings_sections', array($this, 'woo_wallet_extensions_settings_sections'));
        add_filter('woo_wallet_extensions_settings_filds', array($this, 'woo_wallet_extensions_settings_filds'));
        add_action('update_option__wallet_settings_extensions_woo_wallet_coupons_license', array($this, 'extensions_coupons_license_check'), 10, 3);
        if (get_option('woo_wallet_coupons_license_activated') != 'Activated') {
            add_action('admin_notices', array($this, 'license_inactive_notice'));
        }
    }

    public function admin_menu() {
        add_submenu_page('woo-wallet', __('Coupons', 'woo-wallet-coupons'), __('Coupons', 'woo-wallet-coupons'), 'manage_woocommerce', 'edit.php?post_type=woo-wallet-coupons');
        $woo_wallet_coupon_generator = add_submenu_page('', __('Coupon Generator', 'woo-wallet-coupons'), __('Coupon Generator', 'woo-wallet-coupons'), 'manage_woocommerce', 'woo-wallet-coupon-generator', array($this, 'woo_wallet_coupon_generator'));
        add_action("load-$woo_wallet_coupon_generator", array($this, 'generate_bulk_coupon'));
    }

    public function woo_wallet_coupon_generator() {
        ?>
        <div class="wrap">
            <h2><?php _e('Coupon Generator', 'woo-wallet-coupons'); ?></h2>
            <form method="post">
                <table class="form-table">
                    <tbody>
                        <tr>
                            <th scope="row">
                                <label for="coupon_amount"><?php _e('Coupon amount', 'woo-wallet-coupons') ?></label>
                            </th>
                            <td>
                                <input type="number" name="coupon_amount" id="coupon_amount" class="regular-text" />
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="expiry_date"><?php _e('Coupon expiry date', 'woo-wallet-coupons') ?></label>
                            </th>
                            <td>
                                <input type="text" name="expiry_date" placeholder="YYYY-MM-DD" id="expiry_date" class="regular-text date-picker" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])" />
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="customer_email"><?php _e('Allowed emails', 'woo-wallet-coupons') ?></label>
                            </th>
                            <td>
                                <input type="email" name="customer_email" id="customer_email" class="regular-text" />
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="usage_limit"><?php _e('Usage limit per coupon', 'woo-wallet-coupons') ?></label>
                            </th>
                            <td>
                                <input type="number" name="usage_limit" id="usage_limit" class="regular-text" />
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="usage_limit_per_user"><?php _e('Usage limit per user', 'woo-wallet-coupons') ?></label>
                            </th>
                            <td>
                                <input type="number" name="usage_limit_per_user" id="usage_limit_per_user" class="regular-text" />
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="number_of_coupons"><?php _e('Number of coupons', 'woo-wallet-coupons') ?></label>
                            </th>
                            <td>
                                <input type="number" name="number_of_coupons" id="number_of_coupons" value="1" min="1" max="100" class="regular-text" />
                            </td>
                        </tr>
                    </tbody>
                </table>
                <script type="text/javascript">
                    jQuery(function ($) {
                        $('#expiry_date').datepicker({dateFormat: "yy-mm-dd"});
                    });
                </script>
                <?php
                wp_nonce_field('woo-wallet-coupon-generator', 'woo-wallet-coupon-generator');
                submit_button(__('Generate Coupons', 'woo-wallet-coupons'));
                ?>
            </form>
        </div>
        <?php
    }

    public function generate_bulk_coupon() {
        if (isset($_POST['woo-wallet-coupon-generator']) && wp_verify_nonce($_POST['woo-wallet-coupon-generator'], 'woo-wallet-coupon-generator')) {
            $coupon_amount = wc_format_decimal($_POST['coupon_amount']);
            $expiry_date = wc_clean($_POST['expiry_date']);
            $customer_email = wc_clean($_POST['customer_email']);
            $usage_limit = absint($_POST['usage_limit']);
            $usage_limit_per_user = absint($_POST['usage_limit_per_user']);
            $number_of_coupons = absint($_POST['number_of_coupons']);
            for ($i = 0; $i <= $number_of_coupons; $i++) {
                $coupon_code = $this->get_random_coupon_code();
                $postarr = array(
                    'post_type' => Woo_Wallet_Coupons_Post_Type::$post_type,
                    'post_title' => $coupon_code,
                    'post_content' => '',
                    'post_status' => 'publish',
                    'post_author' => get_current_user_id()
                );

                // Insert the post into the database
                $coupon_id = wp_insert_post($postarr, true);
                if (!is_wp_error($coupon_id)) {
                    $data = array(
                        'code' => $coupon_code,
                        'amount' => $coupon_amount,
                        'date_expires' => $expiry_date,
                        'usage_limit' => $usage_limit,
                        'usage_limit_per_user' => $usage_limit_per_user,
                        'email_restrictions' => array_filter(array_map('trim', explode(',', $customer_email))),
                    );

                    foreach ($data as $meta_key => $value) {
                        update_post_meta($coupon_id, $meta_key, $value);
                    }
                    do_action('woo_wallet_after_save_coupon_data', $coupon_id);
                }
            }

            wp_safe_redirect(admin_url('edit.php?post_type=woo-wallet-coupons'));
            exit;
        }
    }

    private function get_random_coupon_code() {

        // Generate unique coupon code
        $length = 12;
        $charset = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $count = strlen($charset);
        $random_coupon = '';
        while ($length--) {
            $random_coupon .= $charset[mt_rand(0, $count - 1)];
        }

        $random_coupon = implode('-', str_split(strtoupper($random_coupon), 4));

        // Ensure coupon code is correctly formatted
        $coupon_code = apply_filters('woo_wallet_coupon_code', $random_coupon);

        return $coupon_code;
    }

    public function admin_scripts() {
        $screen = get_current_screen();
        $screen_id = $screen ? $screen->id : '';
        wp_register_style('jquery-ui-css', '//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css');
        wp_register_script('woo-wallet-coupon-admin-js', woo_wallet_coupons()->plugin_url() . '/assets/js/admin.js', array('jquery'), WOO_WALLET_COUPONS_VERSION);
        wp_localize_script('woo-wallet-coupon-admin-js', 'woo_wallet_coupon_admin_param', array('bulk_coupon_url' => admin_url('admin.php?page=woo-wallet-coupon-generator'), 'bulk_coupon_title' => __('Coupon Generator', 'woo-wallet-coupons')));
        if (in_array($screen_id, array('woo-wallet-coupons', 'admin_page_woo-wallet-coupon-generator'))) {
            wp_enqueue_style('jquery-ui-css');
            wp_enqueue_script('jquery-ui-tabs');
            wp_enqueue_script('jquery-ui-datepicker');
        }
        wp_enqueue_script('woo-wallet-coupon-admin-js');
    }

    public function woo_wallet_extensions_settings_sections($sections) {
        $sections[] = array(
            'id' => '_wallet_settings_extensions_woo_wallet_coupons_license',
            'title' => __('Coupon License', 'woo-wallet-coupons'),
            'icon' => 'dashicons-tickets-alt'
        );
        return $sections;
    }

    public function woo_wallet_extensions_settings_filds($settings_fields) {
        $settings_fields['_wallet_settings_extensions_woo_wallet_coupons_license'] = array(
            array(
                'name' => 'licence_key',
                'label' => __('API License Key', 'woo-wallet-coupons'),
                'desc' => __('Enter License Key', 'woo-wallet-coupons'),
                'type' => 'text',
                'default' => ''
            ),
            array(
                'name' => 'license_product_id',
                'label' => __('API Product ID', 'woo-wallet-withdrawal'),
                'desc' => __('Enter License product ID', 'woo-wallet-withdrawal'),
                'type' => 'text',
                'default' => ''
            ),
            array(
                'name' => 'is_activate',
                'label' => __('Deactivate API License Key', 'woo-wallet-coupons'),
                'desc' => __('Deactivates an API License Key so it can be used on another blog.', 'woo-wallet-coupons'),
                'type' => 'checkbox',
            ),
            array(
                'name' => 'nonce_rand',
                'type' => 'rand'
            )
        );
        return $settings_fields;
    }

    public function extensions_coupons_license_check($old_value, $value, $option) {
        if (!empty($value)) {
            $args = array(
                'product_id' => $value['license_product_id'],
                'api_key' => $value['licence_key'],
                'activation_status' => $value['is_activate'] ? $value['is_activate'] : 'off'
            );
            if (!is_null(woo_wallet_coupons()->licence)) {
                woo_wallet_coupons()->licence->manage_api_license($args);
            }
        }
    }

    public function license_inactive_notice() {
        if (!current_user_can('manage_options')) {
            return;
        }
        if (isset($_GET['page']) && 'woo-wallet-extensions' == $_GET['page']) {
            return;
        }
        ?>
        <?php
    }

}

new Woo_Wallet_Coupons_Admin();
