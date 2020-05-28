<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Woo_Wallet_Coupons_Post_Type {
    /**
     * Coupon post type.
     * @var string 
     */
    public static $post_type = 'woo-wallet-coupons';

    public function __construct() {
        add_action('init', array(__CLASS__, 'register_post_types'), 5);
        add_filter('enter_title_here', array($this, 'enter_title_here'), 10, 2);
        add_action('add_meta_boxes', array($this, 'adding_custom_meta_boxes'), 10, 2);
        add_action('woo_wallet_coupons_general_content', array($this, 'woo_wallet_coupons_general_content'));
        add_action('woo_wallet_coupons_usage_restriction_content', array($this, 'woo_wallet_coupons_usage_restriction_content'));
        add_action('woo_wallet_coupons_usage_limits_content', array($this, 'woo_wallet_coupons_usage_limits_content'));
        add_filter('woocommerce_screen_ids', array($this, 'woocommerce_screen_ids_callback'));
        add_action('save_post_' . self::$post_type, array($this, 'save_post'), 10, 2);

        add_filter('months_dropdown_results', array($this, 'months_dropdown_results'), 10, 2);
        add_filter('manage_edit-' . self::$post_type . '_columns', array($this, 'woo_wallet_coupons_columns'));
        add_action('manage_' . self::$post_type . '_posts_custom_column', array($this, 'manage_woo_wallet_coupons_columns'), 10, 2);
    }

    public function woocommerce_screen_ids_callback($screen_ids) {
        $screen_ids[] = 'woo-wallet-coupons';
        return $screen_ids;
    }

    public function enter_title_here($title, $post) {
        if ($post->post_type == self::$post_type) {
            $title = __('Coupon code', 'woo-wallet-coupons');
        }
        return $title;
    }

    public function adding_custom_meta_boxes($post_type, $post) {
        if (self::$post_type === $post_type) {
            add_meta_box(
                    'woo-wallet-coupon-data', __('Coupon data'), array($this, 'render_coupon_meta_box'), self::$post_type, 'normal', 'default'
            );
        }
    }

    public function render_coupon_meta_box() {
        $tabs = apply_filters('woo_wallet_coupons_data_tabs', array('general' => __('General', ''), 'usage_restriction' => __('Usage restriction', ''), 'usage_limits' => __('Usage limits', '')));
        ?>
        <div id="tabs-custom">
            <ul>
                <?php foreach ($tabs as $tab_id => $tab_title) : ?>
                    <li><a href="#<?php echo $tab_id; ?>"><?php echo $tab_title; ?></a></li>
                <?php endforeach; ?>
            </ul>
            <?php foreach ($tabs as $tab_id => $tab_title) : ?>
                <div id="<?php echo $tab_id; ?>">
                    <?php do_action("woo_wallet_coupons_{$tab_id}_content"); ?>
                </div>
            <?php endforeach; ?>
        </div>
        <script type="text/javascript">
            jQuery(function ($) {
                $("#tabs-custom").tabs();
                $('#expiry_date').datepicker({dateFormat: "yy-mm-dd"});
            });
        </script>
        <?php
    }

    public static function register_post_types() {
        if (!is_blog_installed() || post_type_exists(self::$post_type)) {
            return;
        }
        register_post_type(self::$post_type, apply_filters('woo_wallet_register_post_type_wallet_coupons', array(
            'labels' => array(
                'name' => __('Coupons', 'woo-wallet-coupons'),
                'singular_name' => __('Coupons', 'woo-wallet-coupons'),
                'all_items' => __('All Coupon', 'woo-wallet-coupons'),
                'menu_name' => _x('Coupon', 'Admin menu name', 'woo-wallet-coupons'),
                'search_items' => __('Search', 'woo-wallet-coupons'),
                'not_found' => __('No coupons found', 'woo-wallet-coupons'),
                'not_found_in_trash' => __('No coupons found in trash', 'woo-wallet-coupons'),
                'add_new_item' => __('Add new coupon', 'woo-wallet-coupons')
            ),
            'public' => false,
            'show_ui' => true,
            'show_in_menu' => false,
            'capability_type' => 'post',
            'map_meta_cap' => true,
            'hierarchical' => false,
            'supports' => false,
            'rewrite' => false,
            'supports' => array('title')
                        )
                )
        );
    }

    public function woo_wallet_coupons_general_content() {
        global $post;
        // Amount.
        woocommerce_wp_text_input(
                array(
                    'id' => 'coupon_amount',
                    'label' => __('Coupon amount', 'woo-wallet-coupons'),
                    'placeholder' => wc_format_localized_price(0),
                    'description' => __('Value of the coupon.', 'woo-wallet-coupons'),
                    'data_type' => 'price',
                    'desc_tip' => true,
                    'value' => get_post_meta($post->ID, 'amount', true)
                )
        );
        $expiry_date = get_post_meta($post->ID, 'date_expires', true) ? get_post_meta($post->ID, 'date_expires', true) : '';
        woocommerce_wp_text_input(
                array(
                    'id' => 'expiry_date',
                    'value' => esc_attr($expiry_date),
                    'label' => __('Coupon expiry date', 'woo-wallet-coupons'),
                    'placeholder' => 'YYYY-MM-DD',
                    'description' => '',
                    'class' => 'date-picker',
                    'custom_attributes' => array(
                        'pattern' => apply_filters('woocommerce_date_input_html_pattern', '[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])'),
                    ),
                )
        );
    }

    public function woo_wallet_coupons_usage_restriction_content() {
        global $post;
        $customer_email = get_post_meta($post->ID, 'email_restrictions', true) ? get_post_meta($post->ID, 'email_restrictions', true) : array();
        woocommerce_wp_text_input(
                array(
                    'id' => 'customer_email',
                    'label' => __('Allowed emails', 'woo-wallet-coupons'),
                    'placeholder' => __('No restrictions', 'woo-wallet-coupons'),
                    'description' => __('Whitelist of customer emails to check against when a coupon applied. Separate email addresses with commas. You can also use an asterisk (*) to match parts of an email. For example "*@gmail.com" would match all gmail addresses.', 'woo-wallet-coupons'),
                    'value' => implode(', ', $customer_email),
                    'desc_tip' => true,
                    'type' => 'email',
                    'class' => '',
                    'custom_attributes' => array(
                        'multiple' => 'multiple',
                    ),
                )
        );
    }

    public function woo_wallet_coupons_usage_limits_content() {
        global $post;
        $usage_limit = get_post_meta($post->ID, 'usage_limit', true) ? get_post_meta($post->ID, 'usage_limit', true) : '';
        // Usage limit per coupons.
        woocommerce_wp_text_input(
                array(
                    'id' => 'usage_limit',
                    'label' => __('Usage limit per coupon', 'woo-wallet-coupons'),
                    'placeholder' => esc_attr__('Unlimited usage', 'woo-wallet-coupons'),
                    'description' => __('How many times this coupon can be used before it is void.', 'woo-wallet-coupons'),
                    'type' => 'number',
                    'desc_tip' => true,
                    'class' => 'short',
                    'custom_attributes' => array(
                        'step' => 1,
                        'min' => 0,
                    ),
                    'value' => $usage_limit,
                )
        );
        $usage_limit_per_user = get_post_meta($post->ID, 'usage_limit_per_user', true) ? get_post_meta($post->ID, 'usage_limit_per_user', true) : '';
        // Usage limit per users.
        woocommerce_wp_text_input(
                array(
                    'id' => 'usage_limit_per_user',
                    'label' => __('Usage limit per user', 'woo-wallet-coupons'),
                    'placeholder' => esc_attr__('Unlimited usage', 'woo-wallet-coupons'),
                    'description' => __('How many times this coupon can be used by an individual user. Uses billing email for guests, and user ID for logged in users.', 'woo-wallet-coupons'),
                    'desc_tip' => true,
                    'class' => 'short',
                    'type' => 'number',
                    'custom_attributes' => array(
                        'step' => 1,
                        'min' => 0,
                    ),
                    'value' => $usage_limit_per_user,
                )
        );
    }

    public function save_post($post_id, $post) {
        if(!isset($_POST['post_title'])){
            return;
        }
        $data = array(
            'code' => $post->post_title,
            'amount' => wc_format_decimal($_POST['coupon_amount']),
            'date_expires' => wc_clean($_POST['expiry_date']),
            'usage_limit' => absint($_POST['usage_limit']),
            'usage_limit_per_user' => absint($_POST['usage_limit_per_user']),
            'email_restrictions' => array_filter(array_map('trim', explode(',', wc_clean($_POST['customer_email'])))),
        );

        foreach ($data as $meta_key => $value) {
            update_post_meta($post_id, $meta_key, $value);
        }
        do_action('woo_wallet_after_save_coupon_data', $post_id);
    }

    public function woo_wallet_coupons_columns($columns) {
        $columns = array(
            'cb' => '&lt;input type="checkbox" />',
            'title' => __('Code'),
            'amount' => __('Coupon amount'),
            'limit' => __('Usage / Limit'),
            'expiry_date' => __('Expiry date')
        );
        return $columns;
    }

    public function manage_woo_wallet_coupons_columns($column, $post_id) {
        $coupon = new Woo_Coupon($post_id);
        switch ($column) {
            case 'amount':
                echo wc_price($coupon->get_amount());
                break;
            case 'limit':
                $usage_limit = $coupon->get_usage_limit() ? $coupon->get_usage_limit() : '∞';
                echo $coupon->get_usage_count() . ' / ' . $usage_limit;
                break;
            case 'expiry_date':
                echo $coupon->get_date_expires() ? $coupon->get_date_expires()->date_i18n( wc_date_format() ) : '-';
                break;
        }
    }
    
    public function months_dropdown_results($months, $post_type){
        if(self::$post_type === $post_type){
            $months = array();
        }
        return $months;
    }

}

new Woo_Wallet_Coupons_Post_Type();
