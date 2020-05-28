<?php function thb_selection() {
	$id = get_queried_object_id();
	ob_start();
?>
/* Options set in the admin page */

/* Typography */
body {
	<?php thb_typeoutput( ot_get_option( 'secondary_font' ), false, 'Open Sans' ); ?>
	color: <?php echo ot_get_option( 'text_color' ); ?>;
}
h1,h2,h3,h4,h5,h6 {
	<?php thb_typeoutput( ot_get_option( 'primary_font' ), false, 'Josefin Sans' ); ?>
}
<?php if ( $body_type = ot_get_option( 'body_type' ) ) { ?>
body p {
  <?php thb_typeoutput( $body_type); ?>
}
<?php } ?>
<?php if ( $h1_type = ot_get_option( 'h1_type' ) ) { ?>
h1,
.h1 {
	<?php thb_typeoutput( $h1_type); ?>
}
<?php } ?>
<?php if ( $h2_type = ot_get_option( 'h2_type' ) ) { ?>
h2 {
	<?php thb_typeoutput( $h2_type); ?>
}
<?php } ?>
<?php if ( $h3_type = ot_get_option( 'h3_type' ) ) { ?>
h3 {
	<?php thb_typeoutput( $h3_type); ?>
}
<?php } ?>
<?php if ( $h4_type = ot_get_option( 'h4_type' ) ) { ?>
h4 {
	<?php thb_typeoutput( $h4_type); ?>
}
<?php } ?>
<?php if ( $h5_type = ot_get_option( 'h5_type' ) ) { ?>
h5 {
	<?php thb_typeoutput( $h5_type); ?>
}
<?php } ?>
<?php if ( $h6_type = ot_get_option( 'h6_type' ) ) { ?>
h6 {
	<?php thb_typeoutput( $h6_type); ?>
}
<?php } ?>
/* Shop Typography */
<?php if ( $shop_product_title = ot_get_option( 'shop_product_title' ) ) { ?>
.products .product .post-title h5 {
	<?php thb_typeoutput( $shop_product_title); ?>
}
<?php } ?>
<?php if ( $shop_product_detail_title = ot_get_option( 'shop_product_detail_title' ) ) { ?>
.product-page .product-information h1.product_title {
	<?php thb_typeoutput( $shop_product_detail_title); ?>
}
<?php } ?>
<?php if ( $shop_product_detail_excerpt = ot_get_option( 'shop_product_detail_excerpt' ) ) { ?>
.product-page .product-information .woocommerce-product-details__short-description,
.product-page .product-information .woocommerce-product-details__short-description p {
	<?php thb_typeoutput( $shop_product_detail_excerpt); ?>
}
<?php } ?>

<?php if ( $menu_left = ot_get_option( 'menu_left_type' ) ) { ?>
.header .menu-holder ul > li > a {
	<?php thb_typeoutput( $menu_left); ?>
}
<?php } ?>
<?php if ( $submenu_left = ot_get_option( 'menu_left_submenu_type' ) ) { ?>
.header .menu-holder ul.sub-menu li a {
	<?php thb_typeoutput( $submenu_left); ?>
}
<?php } ?>
<?php if ( $menu_mobile = ot_get_option( 'menu_mobile_type' ) ) { ?>
.mobile-menu li a {
	<?php thb_typeoutput( $menu_mobile); ?>
}
<?php } ?>
<?php if ( $submenu_mobile = ot_get_option( 'menu_mobile_submenu_type' ) ) { ?>
.mobile-menu .sub-menu li a {
	<?php thb_typeoutput( $submenu_mobile); ?>
}
<?php } ?>

/* Header */
<?php if ( $header_padding = ot_get_option( 'header_padding' ) ) { ?>
@media screen and (min-width: 1025px) {
	.header:not(.fixed) {
		<?php thb_paddingoutput( $header_padding); ?>;
	}
}
<?php } ?>
<?php if ( $header_padding_mobile = ot_get_option( 'header_padding_mobile' ) ) { ?>
@media screen and (max-width: 1024px) {
	.header:not(.fixed) {
		<?php thb_paddingoutput( $header_padding_mobile); ?>;
	}
}
<?php } ?>
/* Sub Header */
.subheader {
	<?php thb_bgoutput( ot_get_option( 'subheader_bg' ) ); ?>
}
/* Header */
@media only screen and (min-width: 40.063em) {
	.header {
		<?php thb_paddingoutput( ot_get_option( 'header_spacing' ) ); ?>
	}
}
.header {
	<?php thb_bgoutput( ot_get_option( 'header_bg' ) ); ?>
}
.post-type-archive-product .header-container {
	<?php thb_bgoutput( ot_get_option( 'header_bg_shop' ) ); ?>
}
<?php if ( class_exists( 'WooCommerce' ) ) { ?>
.term-<?php echo esc_attr( $id); ?> .header-container {
	background-image: url(<?php echo thb_get_category_header( $id); ?>);
}
<?php } ?>
.woocommerce-account .header-container {
	<?php thb_bgoutput( ot_get_option( 'header_bg_myaccount' ) ); ?>
}
.woocommerce-cart .header-container {
	<?php thb_bgoutput( ot_get_option( 'header_bg_cart' ) ); ?>
}
.woocommerce-checkout .header-container {
	<?php thb_bgoutput( ot_get_option( 'header_bg_checkout' ) ); ?>
}
/* Header Item Colors */
<?php if ( $menu_color_dark = ot_get_option( 'menu_color_dark' ) ) { ?>
.header.header--dark .sf-menu > li > a {
	color: <?php echo esc_attr( $menu_color_dark); ?>;
}
@media only screen and (min-width: 40.063em) {
	.header.header--dark .quick_wishlist_icon path {
		stroke: <?php echo esc_attr( $menu_color_dark); ?>;
	}
	.header.header--dark .quick_search_icon,
	.header.header--dark .quick_cart_icon {
		fill: <?php echo esc_attr( $menu_color_dark); ?>;
	}
}
<?php } ?>
<?php if ( $menu_color_light = ot_get_option( 'menu_color_light' ) ) { ?>
.header.header--light .sf-menu > li > a {
	color: <?php echo esc_attr( $menu_color_light); ?>;
}
@media only screen and (min-width: 40.063em) {
	.header.header--light .quick_wishlist_icon path {
		stroke: <?php echo esc_attr( $menu_color_light); ?>;
	}
	.header.header--light .quick_search_icon,
	.header.header--light .quick_cart_icon {
		fill: <?php echo esc_attr( $menu_color_light); ?>;
	}
}
<?php } ?>
/* Logo Height */
.header .logo .logoimg,
#customer_login .logo .logoimg {
	max-height: <?php thb_measurementoutput( ot_get_option( 'logo_height' ), array('27', 'px' ) ); ?>;
}

/* Accent Color */
<?php if ( $accent_color = ot_get_option( 'accent_color' ) ) { ?>
a:not(.btn):hover, .subheader .subheader-menu ul > li a:hover, .header .menu-holder ul li.sfHover>a, .header.header--dark .sf-menu > li > a:hover, .header.header--light .sf-menu > li > a:hover, .post .post-meta a[rel="author"], .widget.widget_price_filter .price_slider_amount .button, .slick-nav:hover, .more-link,#side-cart .subtotal span, #comments h2 span, #comments ol.commentlist .comment .reply, #comments ol.commentlist .comment .reply a,.comment-respond .comment-reply-title small,.price.single-price > .amount,.price.single-price ins .amount,.shop_table tbody tr td.order-status.approved,.shop_table tbody tr td.product-quantity .wishlist-in-stock, .checkout-quick-login a, .checkout-quick-coupon a, .payment_methods li .about_paypal, #my-account .my-account-nav li.active a, #my-account .my-account-nav li:hover a, .terms label a, .thb_tabs .tabs dd.active a, .thb_tabs .tabs li.active a, .thb_tour .tabs dd.active a, .thb_tour .tabs li.active a, .toggle .title.wpb_toggle_title_active, .vc_tta-container .vc_tta-tabs.vc_general .vc_tta-panel.vc_active .vc_tta-panel-title, .vc_tta-container .vc_tta-tabs.vc_general .vc_tta-tab.vc_active > a, .product .product-information .sizing_guide:hover,.header.header--dark + #page-title .logout_link:hover, #page-title p .logout_link:hover, .header.header--dark.fixed .sf-menu > li > a:hover, #side-cart .subtotal span:not(.woocommerce-Price-currencySymbol) {
  color: <?php echo esc_attr( $accent_color); ?>;
}

.header .account-holder a:hover .span_count.float_count {
	background-color: <?php echo esc_attr(thb_adjustColorLightenDarken( $accent_color, 8 ) ); ?>;
}
#my-account .my-account-nav li.active path, #my-account .my-account-nav li:hover path,
.product .product-information .share-article:hover path, .product .product-information .share-article:hover polygon,
.product .product-information .sizing_guide:hover path, .product .product-information .sizing_guide:hover polygon, #page-title p .logout_link:hover svg {
	fill:  <?php echo esc_attr( $accent_color); ?>;
}
.widget.widget_price_filter .price_slider .ui-slider-handle, .slick.dark-pagination .slick-dots li.slick-active button, input[type="text"]:focus, input[type="password"]:focus, input[type="date"]:focus, input[type="datetime"]:focus, input[type="email"]:focus, input[type="number"]:focus, input[type="search"]:focus, input[type="tel"]:focus, input[type="time"]:focus, input[type="url"]:focus, textarea:focus, .custom_check + .custom_label:hover:before, [class^="tag-link"]:hover, .product .product-thumbnails figure.slick-center img, .btn.green, .button.green, input[type=submit].green, .notification-box.information, .btn.white:hover, .button.white:hover, input[type=submit].white:hover, .btn.black:hover, .shop_table.wishlist .btn:hover, .button.black:hover, .shop_table.wishlist .button:hover, input[type=submit].black:hover, .shop_table.wishlist input[type=submit]:hover, .product .product-thumbnails figure.slick-current img {
  border-color: <?php echo esc_attr( $accent_color); ?>;
}

.header .account-holder a .span_count.float_count, .widget.widget_price_filter .price_slider .ui-slider-range, .slick.dark-pagination .slick-dots li.slick-active button, .custom_check + .custom_label:after, [class^="tag-link"]:hover, .comment-respond:before, .products .product .product-image .add_to_cart:hover, .btn.green, .button.green, input[type=submit].green, .toggle .title.wpb_toggle_title_active:after, .btn.black:hover, .shop_table.wishlist .btn:hover, .button.black:hover, .shop_table.wishlist .button:hover, input[type=submit].black:hover, .shop_table.wishlist input[type=submit]:hover, .btn.white:hover, .button.white:hover, input[type=submit].white:hover {
	background: <?php echo esc_attr( $accent_color); ?>;
}
.btn.green:hover, .button.green:hover, input[type=submit].green:hover {
	background: <?php echo thb_adjustColorLightenDarken( $accent_color, 10); ?>;
	border-color: <?php echo thb_adjustColorLightenDarken( $accent_color, 10); ?>;
}
<?php } ?>

/* Link Colors */
<?php if ( $fullmenu_link_color_dark = ot_get_option( 'fullmenu_link_color_dark' ) ) { ?>
<?php thb_linkcoloroutput( $fullmenu_link_color_dark, '.header.header--light .menu-holder ul.sf-menu>li>' ); ?>
<?php } ?>
<?php if ( $fullmenu_link_color_light = ot_get_option( 'fullmenu_link_color_light' ) ) { ?>
<?php thb_linkcoloroutput( $fullmenu_link_color_light, '.header.header--dark .menu-holder ul.sf-menu>li>', true ); ?>
<?php } ?>
<?php if ( $submenu_link_color = ot_get_option( 'submenu_link_color' ) ) { ?>
<?php thb_linkcoloroutput( $submenu_link_color, '.header .menu-holder ul li .sub-menu li' ); ?>
<?php } ?>
<?php if ( $footer_link_color = ot_get_option( 'footer_link_color' ) ) { ?>
<?php thb_linkcoloroutput( $footer_link_color, '.footer .widget' ); ?>
<?php if ('dark' === ot_get_option( 'footer_color' ) ) { thb_linkcoloroutput( $footer_link_color, '.footer.dark .widget' ); }?>
<?php } ?>
<?php if ( $subfooter_link_color = ot_get_option( 'subfooter_link_color' ) ) { ?>
<?php thb_linkcoloroutput( $subfooter_link_color, '.subfooter' ); ?>
<?php thb_linkcoloroutput( $subfooter_link_color, '.subfooter .footer-menu li' ); ?>
<?php } ?>
/* Menu */
<?php if ( $menu_margin = ot_get_option( 'header_menu_margin' ) ) { ?>
.header .menu-holder ul > li {
	margin-right: <?php echo esc_attr( $menu_margin[0].$menu_margin[1]); ?>;
}
<?php } ?>

/* Menu Colors for dark/light backgrounds */
<?php if ( $menu_color_light = ot_get_option( 'menu_color_light' ) ) { ?>

<?php } ?>

<?php if ( $menu_color_dark = ot_get_option( 'menu_color_dark' ) ) { ?>

<?php } ?>

/* Page Specific */
.page-id-<?php echo esc_attr( $id); ?> #wrapper,
.postid-<?php echo esc_attr( $id); ?> #wrapper {
	<?php thb_bgoutput( get_post_meta( $id, 'page_bg', true)); ?>
}
/* Page Header */
.page-id-<?php echo esc_attr( $id); ?> .header-container {
	<?php thb_bgoutput( get_post_meta( $id, 'header_bg', true)); ?>
}

/* Newsletter */
<?php if ( $popup_bg = ot_get_option( 'popup_bg' ) ) { ?>
#popup {
	<?php thb_bgoutput( $popup_bg); ?>
}
<?php } ?>

/* Shop Badges */
<?php if ( $badge_sale = ot_get_option( 'badge_sale' ) ) { ?>
.badge.onsale {
	background: <?php echo esc_attr( $badge_sale); ?>;
}
<?php } ?>
<?php if ( $badge_outofstock = ot_get_option( 'badge_outofstock' ) ) { ?>
.badge.out-of-stock {
	background: <?php echo esc_attr( $badge_outofstock); ?>;
}
<?php } ?>
<?php if ( $badge_justarrived = ot_get_option( 'badge_justarrived' ) ) { ?>
.badge.new{
	background: <?php echo esc_attr( $badge_justarrived); ?>;
}
<?php } ?>

/* Footer */
.thb_subscribe {
	<?php thb_bgoutput( ot_get_option( 'subscribe_bg' ) ); ?>
}
.footer {
	<?php thb_bgoutput( ot_get_option( 'footer_bg' ) ); ?>
}
.subfooter {
	<?php thb_bgoutput( ot_get_option( 'subfooter_bg' ) ); ?>
}
/* Footer Measurements */
<?php if ( $footer_padding = ot_get_option( 'footer_padding' ) ) { ?>
.footer {
	<?php thb_paddingoutput( $footer_padding); ?>;
}
<?php } ?>
<?php if ( $subfooter_padding = ot_get_option( 'subfooter_padding' ) ) { ?>
.subfooter {
	<?php thb_paddingoutput( $subfooter_padding); ?>;
}
<?php } ?>
/* Extra CSS */
<?php
echo ot_get_option( 'extra_css' );
?>
<?php
	$out = ob_get_clean();
	// Remove comments
	$out = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $out );
	// Remove space after colons
	$out = str_replace( ': ', ':', $out );
	// Remove whitespace
	$out = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    ' ), '', $out);

	return $out;
}