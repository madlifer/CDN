<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Woo_Coupon {

    /**
     * ID for this object.
     *
     * @since 1.0.0
     * @var int
     */
    protected $id = 0;

    /**
     * Code for this object.
     *
     * @since 1.0.0
     * @var string
     */
    protected $code = '';

    /**
     * Coupon amount
     * @var decimal 
     */
    protected $amount = 0;

    /**
     * Coupon expire date.
     * @var string 
     */
    protected $date_expires = null;

    /**
     * Coupon usage limit.
     * @var int 
     */
    protected $usage_limit = 0;

    /**
     * Coupon limit.
     * @var int 
     */
    protected $usage_limit_per_user = 0;

    /**
     * Email restiction
     * @var array 
     */
    protected $email_restrictions = array();

    /**
     * Coupon constructor. Loads coupon data.
     *
     * @param mixed $data Coupon data, object, ID or code.
     */
    public function __construct($data = '') {
        // If we already have a coupon object, read it again.
        if ($data instanceof Woo_Coupon) {
            $this->set_id(absint($data->get_id()));
            $this->read_data_from_database();
            return;
        }

        // Try to load coupon using ID or code.
        if (is_int($data) && 'woo-wallet-coupons' === get_post_type($data)) {
            $this->set_id($data);
        } elseif (!empty($data)) {
            $id = $this->get_coupon_id_by_code($data);
            // Need to support numeric strings for backwards compatibility.
            if ($id && 'woo-wallet-coupons' === get_post_type($id)) {
                $this->set_id($id);
                $this->set_code($data);
            }
        }
        $this->read_data_from_database();
    }

    public function get_coupon_id_by_code($code) {
        global $wpdb;
        $search_query = "SELECT ID FROM {$wpdb->prefix}posts WHERE post_type = 'woo-wallet-coupons' AND post_title = %s ORDER BY ID DESC";
        $results = $wpdb->get_results($wpdb->prepare($search_query, $code));
        $ids = wp_list_pluck($results, 'ID');
        if ($ids) {
            return current($ids);
        }
        return false;
    }

    public function set_id($id) {
        $this->id = absint($id);
    }

    public function set_code($code) {
        $this->code = $code;
    }

    public function set_amount($amount) {
        $amount = wc_format_decimal($amount) ? wc_format_decimal($amount) : 0;
        $this->amount = $amount;
    }

    public function set_date_expires($date) {
        if ($date) {
            $this->date_expires = $date;
        }
    }

    public function set_usage_limit($usage_limit = 0) {
        if ($usage_limit) {
            $this->usage_limit = $usage_limit;
        }
    }

    public function set_usage_limit_per_user($usage_limit_per_user = 0) {
        if ($usage_limit_per_user) {
            $this->usage_limit_per_user = $usage_limit_per_user;
        }
    }

    public function set_email_restrictions($email_restrictions = array()) {
        if ($email_restrictions) {
            $this->email_restrictions = $email_restrictions;
        }
    }

    public function get_id() {
        return $this->id;
    }

    public function get_code() {
        return $this->code;
    }

    public function get_amount() {
        return $this->amount;
    }

    public function get_date_expires() {
        return $this->date_expires ? wc_string_to_datetime($this->date_expires) : null;
    }

    public function get_usage_limit() {
        return $this->usage_limit;
    }

    public function get_usage_limit_per_user() {
        return $this->usage_limit_per_user;
    }

    public function get_email_restrictions() {
        return $this->email_restrictions;
    }

    public function get_usage_count() {
        $usage_count = get_post_meta($this->id, '_usage_count', true);
        if ($usage_count) {
            return absint($usage_count);
        }
        return 0;
    }

    public function get_usage_detais() {
        $usage_details = get_post_meta($this->id, '_usage_details', true);
        if ($usage_details) {
            return $usage_details;
        }
        return array();
    }

    protected function read_data_from_database() {
        if ($this->get_code()) {
            $this->set_code(get_post_meta($this->id, 'code', true));
        }
        $this->set_amount(get_post_meta($this->id, 'amount', true));
        $this->set_date_expires(get_post_meta($this->id, 'date_expires', true));
        $this->set_usage_limit(get_post_meta($this->id, 'usage_limit', true));
        $this->set_usage_limit_per_user(get_post_meta($this->id, 'usage_limit_per_user', true));
        $this->set_email_restrictions(get_post_meta($this->id, 'email_restrictions', true));
    }

    public function is_valid_coupon() {
        try {
            $this->validate_coupon_exists();
            $this->validate_coupon_usage_limit();
            $this->validate_coupon_user_usage_limit();
            $this->validate_coupon_expiry_date();
            $this->validate_coupon_user();
        } catch (Exception $e) {
            return new WP_Error(
                    'invalid_coupon', $e->getMessage(), array(
                'status' => 400,
                    )
            );
        }
        return true;
    }

    protected function validate_coupon_exists() {
        if (!$this->get_id()) {
            throw new Exception(sprintf(__('Coupon "%s" does not exist!', 'woo-wallet-coupons'), $this->get_code()), 105);
        }
        if (!$this->get_amount()) {
            throw new Exception(sprintf(__('Coupon "%s" has no amount!', 'woo-wallet-coupons'), $this->get_code()), 105);
        }
        return true;
    }

    protected function validate_coupon_usage_limit() {
        if ($this->get_usage_limit() > 0 && $this->get_usage_count() >= $this->get_usage_limit()) {
            throw new Exception(__('Coupon usage limit has been reached.', 'woo-wallet-coupons'), 106);
        }
        return true;
    }

    protected function validate_coupon_user_usage_limit($user_id = 0) {
        if (!$user_id) {
            $user_id = get_current_user_id();
        }
        if ($this->get_usage_limit_per_user() > 0) {
            $usage_details = $this->get_usage_detais();
            if ($usage_details) {
                if (isset($usage_details[$user_id])) {
                    $usage_count = $usage_details[$user_id];
                    if ($usage_count >= $this->get_usage_limit_per_user()) {
                        throw new Exception(__('Coupon usage limit has been reached.', 'woo-wallet-coupons'), 106);
                    }
                }
            }
        }
        return true;
    }

    protected function validate_coupon_expiry_date() {
        if ($this->get_date_expires() && current_time('timestamp', true) > $this->get_date_expires()->getTimestamp()) {
            throw new Exception(__('This coupon has expired.', 'woo-wallet-coupons'), 107);
        }

        return true;
    }

    protected function validate_coupon_user() {
        $user_id = get_current_user_id();
        $user = get_userdata($user_id);
        if (is_array($this->get_email_restrictions()) && 0 < count($this->get_email_restrictions()) && !$this->is_coupon_emails_allowed(array($user->user_email), $this->get_email_restrictions())) {
            throw new Exception(__('This coupon not yours.', 'woo-wallet-coupons'), 108);
        }
        return true;
    }

    protected function is_coupon_emails_allowed($check_emails, $restrictions) {
        foreach ($check_emails as $check_email) {
            // With a direct match we return true.
            if (in_array($check_email, $restrictions, true)) {
                return true;
            }

            // Go through the allowed emails and return true if the email matches a wildcard.
            foreach ($restrictions as $restriction) {
                // Convert to PHP-regex syntax.
                $regex = '/^' . str_replace('*', '(.+)?', $restriction) . '$/';
                preg_match($regex, $check_email, $match);
                if (!empty($match)) {
                    return true;
                }
            }
        }
        return false;
    }

    public function update_usage_details($user_id = 0) {
        if (!$user_id) {
            $user_id = get_current_user_id();
        }
        $_usage_count = $this->get_usage_count() + 1;
        update_post_meta($this->get_id(), '_usage_count', $_usage_count);
        $usage_details = $this->get_usage_detais();
        if ($usage_details) {
            if (isset($usage_details[$user_id])) {
                $usage_count = absint($usage_details[$user_id]) + 1;
                $usage_details[$user_id] = $usage_count;
            } else {
                $usage_details[$user_id] = 1;
            }
        } else {
            $usage_details = array($user_id => 1);
        }
        update_post_meta($this->get_id(), '_usage_details', $usage_details);
    }

}
