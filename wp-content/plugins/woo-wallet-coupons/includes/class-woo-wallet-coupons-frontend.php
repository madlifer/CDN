<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Woo_Wallet_Coupons_Frontend {

    public function __construct() {
        add_filter('woo_wallet_nav_menu_items', array($this, 'woo_wallet_nav_menu_items'), 10, 2);
        add_action('woo_wallet_menu_content', array($this, 'woo_wallet_menu_content'));
        add_action('woo_wallet_menu_items', array($this, 'woo_wallet_menu_items'));
        add_action('wp_loaded', array($this, 'apply_woo_wallet_coupon'), 25);
        add_filter('woo_wallet_endpoint_actions', array($this, 'woo_wallet_endpoint_actions_callback'));
    }
    
    public function woo_wallet_endpoint_actions_callback($endpoint_actions){
        return array_merge($endpoint_actions, array('redeem'));
    }

    public function woo_wallet_nav_menu_items($menu_items, $is_rendred_from_myaccount) {
        $menu_items['redeem'] = array(
            'title' => apply_filters('woo_wallet_account_topup_menu_title', __( 'Wallet topup', 'woo-wallet' ) ),
            'url' => $is_rendred_from_myaccount ? esc_url(wc_get_endpoint_url(get_option('woocommerce_woo_wallet_endpoint', 'woo-wallet'), 'redeem', wc_get_page_permalink('myaccount'))) : add_query_arg('wallet_action', 'redeem', get_permalink()),
            'icon' => 'dashicons dashicons-plus-alt'
        );
        return $menu_items;
    }
    
    public function woo_wallet_menu_items(){
        if (version_compare(WOO_WALLET_PLUGIN_VERSION, '1.3.2', '>')) {
            return;
        }
        $is_rendred_from_myaccount = wc_post_content_has_shortcode( 'woo-wallet' ) ? false : is_account_page();
        ?>
        <li class="card"><a href="<?php echo $is_rendred_from_myaccount ? esc_url(wc_get_endpoint_url(get_option('woocommerce_woo_wallet_endpoint', 'woo-wallet'), 'redeem', wc_get_page_permalink('myaccount'))) : add_query_arg('wallet_action', 'redeem', get_permalink()); ?>"><span class="dashicons dashicons-tickets-alt"></span><p><?php echo apply_filters('woo_wallet_account_redeem_menu_title', __('Coupon', 'woo-wallet-coupons')); ?></p></a></li>
        <?php
    }

    public function woo_wallet_menu_content() {
        global $wp;
        if (( isset($wp->query_vars['woo-wallet']) && 'redeem' === $wp->query_vars['woo-wallet'] ) || ( isset($_GET['wallet_action']) && 'redeem' === $_GET['wallet_action'] )) {
            ?>
            <form method="post" action="">
                <div class="woo-wallet-coupon"> 
                    <input type="text" required="" name="coupon_code" class="input-text woo-wallet-coupon-code" id="coupon_code" value="" placeholder="<?php _e('请输入您的充值卡密进行充值', 'woo-wallet-coupons'); ?>"> 
                    <?php wp_nonce_field('woo_wallet_apply_coupon', 'woo_wallet_apply_coupon'); ?>
                    <button type="button" class="button" onclick="window.open('https://baidu.com')" name="woo_coupon_shop" value="buy"><?php _e('购买充值卡', 'woo-wallet-coupons') ?></button>
                    <button type="submit" class="button" name="woo_apply_coupon" value="Redeem coupon"><?php _e('提交充值', 'woo-wallet-coupons') ?></button>

                </div>
            </form>
            <?php
        }
    }

    public function apply_woo_wallet_coupon() {
        /**
         * Process wallet redeem.
         */
        if (isset($_POST['woo_wallet_apply_coupon']) && !empty($_POST['woo_wallet_apply_coupon'])) {
            if(wp_verify_nonce($_POST['woo_wallet_apply_coupon'], 'woo_wallet_apply_coupon')){
                $coupon_code = $_POST['coupon_code'];
                $coupon = new Woo_Coupon($coupon_code);
                $is_valid_coupon = $coupon->is_valid_coupon();
                if(!is_wp_error($is_valid_coupon)){
                    $transaction_id = woo_wallet()->wallet->credit(get_current_user_id(), $coupon->get_amount(), sprintf(__('Credit via coupon "%s"', 'woo-wallet-coupons'), $coupon->get_code()));
                    if($transaction_id){
                        $coupon->update_usage_details();
                        update_wallet_transaction_meta($transaction_id, '_coupon_id', $coupon->get_id(), get_current_user_id());
                    }
                    wc_add_notice(__('Coupon applied successfully!', 'woo-wallet-coupons'), 'success');
                } else{
                    wc_add_notice($is_valid_coupon->get_error_message(), 'error');
                }
            }
        }
    }

}

new Woo_Wallet_Coupons_Frontend();
