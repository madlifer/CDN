/* global woo_wallet_coupon_admin_param */

jQuery(function ($) {
    var $wallet_screen = $('.post-type-woo-wallet-coupons'),
            $title_action = $wallet_screen.find('.wp-header-end');
    $title_action.before('<a href="' + woo_wallet_coupon_admin_param.bulk_coupon_url + '" class="page-title-action">' + woo_wallet_coupon_admin_param.bulk_coupon_title + '</a>');
});