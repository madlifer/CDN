<?php
if ( ! thb_wc_supported() ) {
	return;
}
function thb_wc_setup() {
	if ( ! class_exists( 'woocommerce' ) ) {
		 function is_account_page() {
		 	return false;
		 }
		 function is_shop() {
		 	return false;
		 }
		 function is_product_category(){
		 	return false;
		 }
		 function is_cart(){
		 	return false;
		 }
		 function is_checkout(){
		 	return false;
		 }
		 function is_woocommerce(){
		 	return false;
		 }
	}
}
add_action( 'plugins_loaded', 'thb_wc_setup' );

/* Account Page & not logged in */
function thb_accountpage_notloggedin() {
	$cond = true;
	if ( ! thb_wc_supported() ) {
		return $cond;
	}
	if (is_account_page()) {
		if (is_user_logged_in()) {
			$cond = true;
		} else {
			$cond = false;
		}
	} else {
		$cond = true;
	}
	return $cond;
}

/* Reviews Tab */
function thb_reviews_setup() {
	if ( ot_get_option( 'shop_reviews_tab') === 'off' ) {
		add_filter( 'woocommerce_product_tabs', 'thb_remove_reviews_tab', 98 );
		function thb_remove_reviews_tab($tabs) {
			unset($tabs['reviews']);
			return $tabs;
		}
	}
}
add_action( 'after_setup_theme', 'thb_reviews_setup' );

/* Out of Stock Check */
function thb_out_of_stock() {
  global $post;
  $id = $post->ID;
  $status = get_post_meta( $id, '_stock_status', true );

  if ($status == 'outofstock') {
  	return true;
  } else {
  	return false;
  }
}

/* WishList Button */
function thb_wishlist_button() {
	if ( class_exists( 'YITH_WCWL_UI' ) )  {
		global $product;
		$url = YITH_WCWL()->get_wishlist_url();
		$product_type = $product->get_type();
		$default_wishlists = is_user_logged_in() ? YITH_WCWL()->get_wishlists( array( 'is_default' => true ) ) : false;

		if( ! empty( $default_wishlists ) ){
			$default_wishlist = $default_wishlists[0]['ID'];
		}
		else{
			$default_wishlist = false;
		}

		$exists = YITH_WCWL()->is_product_in_wishlist( $product->get_id(), $default_wishlist );


		$classes = get_option( 'yith_wcwl_use_button' ) == 'yes' ? 'add_to_wishlist single_add_to_wishlist button alt' : 'add_to_wishlist';
		?>
		<div class="yith-wcwl-add-to-wishlist add-to-wishlist-<?php echo esc_attr($product->get_id()); ?>">
	    <div class="yith-wcwl-add-button" style="display: <?php echo esc_attr( $exists ? 'none' : 'block' ); ?>">
				<a href="<?php echo esc_url( add_query_arg( 'add_to_wishlist', $product->get_id() ) ); ?>"
					data-product-id="<?php echo esc_attr($product->get_id()); ?>"
					data-product-type="<?php echo esc_attr($product_type); ?>"
					class="<?php echo esc_attr($classes); ?>">
					<span class="text"><?php echo esc_html__( "Add To Wishlist", 'bronx' ); ?></span><?php get_template_part( 'assets/img/svg/wishlist.svg'); ?>
				</a>
	    </div>
			<div class="yith-wcwl-wishlistaddedbrowse hide" style="display:none;">
				<a href="<?php echo esc_url(esc_url($url)); ?>">
					<span class="text"><?php echo esc_html__( "Added to Wishlist", 'bronx' ); ?></span><?php get_template_part( 'assets/img/svg/wishlist.svg'); ?>
				</a>
			</div>
			<div class="yith-wcwl-wishlistexistsbrowse" style="display: <?php echo esc_attr( $exists ? 'block' : 'none' ); ?>">
				<a href="<?php echo esc_url($url); ?>">
					<span class="text"><?php echo esc_html__( "View Wishlist", 'bronx' ); ?></span><?php get_template_part( 'assets/img/svg/wishlist.svg'); ?>
				</a>
			</div>
		</div>
		<?php
	}

}

/* WishList Button*/
function thb_wishlist_button_productpage() {

	global $product;

	if ( class_exists( 'YITH_WCWL_UI' ) )  {
		$url = YITH_WCWL()->get_wishlist_url();
		$product_type = $product->get_type();
		$default_wishlists = is_user_logged_in() ? YITH_WCWL()->get_wishlists( array( 'is_default' => true ) ) : false;

		if( ! empty( $default_wishlists ) ){
			$default_wishlist = $default_wishlists[0]['ID'];
		}
		else{
			$default_wishlist = false;
		}

		$exists = YITH_WCWL()->is_product_in_wishlist( $product->get_id(), $default_wishlist );


		$classes = get_option( 'yith_wcwl_use_button' ) == 'yes' ? 'class="add_to_wishlist single_add_to_wishlist button grey"' : 'class="add_to_wishlist single_add_to_wishlist button grey"';

		$html  = '<div class="yith-wcwl-add-to-wishlist add-to-wishlist-'.$product->get_id().'">';
    $html .= '<div class="yith-wcwl-add-button';  // the class attribute is closed in the next row

    $html .= $exists ? ' hide" style="display:none;"' : ' show"';

    $html .= '><a href="' . esc_url( add_query_arg( 'add_to_wishlist', $product->get_id() ) ) . '" data-product-id="' . $product->get_id() . '" data-product-type="' . $product_type . '" ' . $classes . ' ><span class="text">'.__( "Add To Wishlist", 'bronx' ).'</span></a>';
    $html .= '</div>';

		$html .= '<div class="yith-wcwl-wishlistaddedbrowse hide" style="display:none;"><a href="' . esc_url($url) . '" class="add_to_wishlist button grey"><span class="text">'.__( "Added to Wishlist", 'bronx' ).'</span></a></div>';

		$html .= '<div class="yith-wcwl-wishlistexistsbrowse ' . ( $exists ? 'show' : 'hide' ) . '" style="display:' . ( $exists ? 'block' : 'none' ) . '"><a href="' . esc_url($url) . '" class="add_to_wishlist button grey"><span class="text">'.__( "View Wishlist", 'bronx' ).'</span></a></div>';

		$html .= '</div>';

		echo $html;

	}

}
add_action( 'woocommerce_after_add_to_cart_button', 'thb_wishlist_button_productpage');

/* Product Nav */
function thb_product_nav() {
	global $wp_query, $post;

	if ( is_single() ) {
		$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
		$next = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous )
			return;
	}

	if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) )
		return;

	$arrow_prev = is_rtl() ? '<i class="fa fa-caret-right"></i>' : '<i class="fa fa-caret-left"></i>';
	$arrow_next = is_rtl() ? '<i class="fa fa-caret-left"></i>' : '<i class="fa fa-caret-right"></i>';
	?>
	<nav class="post_nav">
     <?php previous_post_link( '%link', $arrow_prev . __( 'PREV', 'bronx' ) ); ?>
     <?php next_post_link( '%link', __( 'NEXT', 'bronx' ).$arrow_next ); ?>
	</nav>
	<?php
}

/* Side Cart */
function thb_side_cart() {
 	echo '<nav id="side-cart"></nav>';
}
add_action( 'thb_side_cart', 'thb_side_cart',3 );

/* Side Cart Update */
function thb_woocomerce_side_cart_update($fragments) {
	ob_start();
	?>
	<nav id="side-cart">
		<div id="cart-container" class="cart-container <?php if (WC()->cart->cart_contents_count < 1) { ?>empty<?php }?>">
		 	<header class="item">
		 		<h6><?php esc_html_e('SHOPPING BAG','bronx'); ?></h6>
		 	</header>
			<?php if ( WC()->cart->is_empty() ) { ?>
				<div class="custom_scroll cart-empty-container" id="cart-scroll">
					<div>
						<?php wc_get_template( 'cart/cart-empty.php' ); ?>
					</div>
				</div>
			<?php } else {?>
				<div class="custom_scroll" id="cart-scroll">
					<div>
						<ul>
						<?php foreach (WC()->cart->cart_contents as $cart_item_key => $cart_item) :
						    $_product = $cart_item['data'];
						    if ($_product->exists() && $cart_item['quantity']>0) :?>
								<li class="item cf">
									<figure>
										<?php
											$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
											if ( ! $_product->is_visible() )
												echo $thumbnail;
											else
												printf( '<a href="%s">%s</a>', $_product->get_permalink( $cart_item ), $thumbnail );
										?>
									</figure>

									<?php echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="remove" title="%s">×</a>', esc_url( WC()->cart->get_remove_url( $cart_item_key ) ), esc_attr__('Remove this item','bronx') ), $cart_item_key ); ?>

									<div class="list_content">
										<?php
                      $product_title = $_product->get_title();
                      echo '<h5><a href="'.esc_url( $_product->get_permalink() ).'">' . apply_filters('woocommerce_cart_widget_product_title', $product_title, $_product) . '</a></h5>';
                      echo '<span class="quantity">'.$cart_item['quantity'].'</span><span class="cross">×</span>';
                      echo '<span class="price">'.$_product->get_price_html().'</span>';

                      echo WC()->cart->get_item_data( $cart_item );
										?>
									</div>
								</li>
						<?php endif; endforeach; ?>
						</ul>
						<div class="subtotal item">
							<?php esc_html_e('Subtotal', 'bronx' ); ?><?php echo WC()->cart->get_cart_subtotal(); ?>
						</div>
					</div>
				</div>
				<div class="buttons item">
					<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="btn grey large full"><?php esc_html_e('Continue', 'bronx' ); ?></a>
					<a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="btn green large full"><?php esc_html_e('Checkout', 'bronx' ); ?></a>
				</div>
			<?php } ?>
			</div>
	</nav>
	<?php
	$fragments['#side-cart'] = ob_get_clean();
	return $fragments;

}
add_filter( 'woocommerce_add_to_cart_fragments', 'thb_woocomerce_side_cart_update');

/* Header Cart */
function thb_quick_cart() {
 ?>
	<a class="quick_cart" data-target="open-cart" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart','bronx'); ?>">
		<?php get_template_part( 'assets/img/svg/cart.svg'); ?>
		<span class="span_count float_count"><?php echo esc_html(WC()->cart->cart_contents_count); ?></span>
	</a>
<?php
}
add_action( 'thb_quick_cart', 'thb_quick_cart',3 );

/* Header Wishlist */
function thb_quick_wishlist() {
 ?>
	<?php if (class_exists('YITH_WCWL')) { ?>
		<a href="<?php echo esc_url( YITH_WCWL()->get_wishlist_url() ); ?>" title="<?php esc_attr_e( 'Wishlist', 'bronx' ); ?>" class="quick_wishlist">
			<?php get_template_part( 'assets/img/svg/wishlist.svg'); ?>
			<span class="span_count wishlist_count" id="wishlist_count"><?php echo yith_wcwl_count_products(); ?></span>
		</a>
	<?php } ?>
<?php
}
add_action( 'thb_quick_wishlist', 'thb_quick_wishlist',3 );

/* Product Badges */
function thb_product_badge() {
 global $post, $product;
 	if (thb_out_of_stock()) {
		echo '<span class="badge out-of-stock">' . esc_html__( 'Out of Stock', 'bronx' ) . '</span>';
	} elseif ( $product->is_on_sale() ) {
		if (ot_get_option( 'shop_sale_badge', 'text') == 'discount') {
			if ($product->get_type() == 'variable') {
				$available_variations = $product->get_available_variations();
				$maximumper = 0;
				for ($i = 0; $i < count($available_variations); ++$i) {
					$variation_id=$available_variations[$i]['variation_id'];
					$variable_product1= new WC_Product_Variation( $variation_id );
					$regular_price = $variable_product1->get_regular_price();
					$sales_price = $variable_product1->get_sale_price();
					$percentage = $sales_price ? round( ( ( $regular_price - $sales_price ) / $regular_price ) * 100) : 0;
					if ($percentage > $maximumper) {
						$maximumper = $percentage;
					}
				}
				echo apply_filters('woocommerce_sale_flash', '<span class="badge onsale perc">&darr; '.$maximumper.'%</span>', $post, $product);
			} elseif ($product->get_type() == 'simple'){
				$percentage = round( ( ( $product->get_regular_price() - $product->get_sale_price() ) / $product->get_regular_price() ) * 100 );
				echo apply_filters('woocommerce_sale_flash', '<span class="badge onsale perc">&darr; '.$percentage.'%</span>', $post, $product);
			} elseif ($product->get_type() == 'external'){
				$percentage = round( ( ( $product->get_regular_price() - $product->get_sale_price() ) / $product->get_regular_price() ) * 100 );
				echo apply_filters('woocommerce_sale_flash', '<span class="badge onsale perc">&darr; '.$percentage.'%</span>', $post, $product);
			}
		} else {
			echo apply_filters('woocommerce_sale_flash', '<span class="badge onsale">'.esc_html__( 'Sale','bronx' ).'</span>', $post, $product);
		}
	} else {
		$postdate 		= get_the_time( 'Y-m-d' );			// Post date
		$postdatestamp 	= strtotime( $postdate );			// Timestamped post date
		$newness = ot_get_option( 'shop_newness', 7);
		if ( ( time() - ( 60 * 60 * 24 * $newness ) ) < $postdatestamp) { // If the product was published within the newness time frame display the new badge
			echo '<span class="badge new">' . esc_html__( 'Just Arrived', 'bronx' ) . '</span>';
		}

	}
}
add_action( 'thb_product_badge', 'thb_product_badge',3 );

/* WOOCOMMERCE CART LINK */
function thb_woocomerce_ajax_cart_update($fragments) {
	ob_start();
	?>
		<span class="span_count float_count"><?php echo esc_html(WC()->cart->cart_contents_count); ?></span>
	<?php
	$fragments['.float_count'] = ob_get_clean();
	return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'thb_woocomerce_ajax_cart_update');

//woocommerce_after_shop_loop_item_title
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

/* Shop Page - Remove orderby & breadcrumb */
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
add_action( 'thb_before_shop_loop_result_count', 'woocommerce_result_count', 20 );
add_action( 'thb_before_shop_loop_catalog_ordering', 'woocommerce_catalog_ordering', 30 );

/* Shop Page - Grid Sizer */
function thb_grid_switcher() {
  $shop_columns  = isset($_GET['shop_columns']) ? $_GET['shop_columns'] : ot_get_option( 'shop_columns', '4');
  $sidebar_pos   = isset($_GET['sidebar']) ? $_GET['sidebar'] : ot_get_option( 'shop_sidebar', 'no');
  $grid_switcher = ot_get_option( 'shop_grid_switcher', 'on' );

  if ($grid_switcher === 'on' && (is_shop() || is_product_category())) { ?>
  <aside class="grid_switcher <?php if($sidebar_pos == 'right') { echo 'left-align'; } ?>">
  	<span><?php esc_html_e('GRID', 'bronx' ); ?></span>
  	<a href="<?php echo add_query_arg(array ('shop_columns' => '6')); ?>" class="sgrid <?php if ($shop_columns == '6') { echo 'active'; } ?>">6</a>
  	<a href="<?php echo add_query_arg(array ('shop_columns' => '5')); ?>" class="sgrid <?php if ($shop_columns == '5') { echo 'active'; } ?>">5</a>
  	<a href="<?php echo add_query_arg(array ('shop_columns' => '4')); ?>" class="sgrid <?php if ($shop_columns == '4') { echo 'active'; } ?>">4</a>
  	<a href="<?php echo add_query_arg(array ('shop_columns' => '3')); ?>" class="sgrid <?php if ($shop_columns == '3') { echo 'active'; } ?>">3</a>
  </aside>
  <?php }
}
add_action( 'woocommerce_before_shop_loop', 'thb_grid_switcher', 0 );

/* Product Page - Move tabs */
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
add_action( 'woocommerce_after_single_product', 'woocommerce_output_product_data_tabs', 10 );

/* Product Page - Move breadcrumbs */
remove_action( 'woocommerce_before_main_content','woocommerce_breadcrumb', 20, 0);
add_action( 'thb_woocommerce_product_breadcrumb', 'woocommerce_breadcrumb', 20, 0 );

/* Product Page - Remove Sale Flash */
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash' , 10);

/* Product Page - Remove Related Products */
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

/* Product Page - Move Upsells */
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
add_action( 'woocommerce_after_single_product', 'woocommerce_upsell_display', 70 );

/* Product Page - Move Sharing to top */
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 35 );

/* Product Page - Move Rating to top */
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 0 );

/* Product Page - Add Sizing Guide */
add_action( 'woocommerce_after_add_to_cart_button', 'thb_social_product', 29 );
add_action( 'woocommerce_after_add_to_cart_button', 'thb_sizing_guide', 30 );

/* Cart Page - Move Cross Sells */
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
add_action( 'woocommerce_after_cart_table', 'woocommerce_cross_sell_display' );


/* Sizing Guide */
function thb_sizing_guide() {
	$sizing_guide = get_post_meta(get_the_ID(), 'sizing_guide', true);
	$sizing_guide_content = get_post_meta(get_the_ID(), 'sizing_guide_content', true);
	$sizing_guide_text = get_post_meta(get_the_ID(), 'sizing_guide_text', true);

	$text = $sizing_guide_text ? $sizing_guide_text : esc_html__("VIEW SIZING GUIDE", 'bronx' );

	if ($sizing_guide === 'on' ) {
		echo '<a href="#sizing-popup" rel="inline" class="sizing_guide">'.thb_load_template_part('assets/img/svg/sizing_guide.svg'). $text.'</a>';

		?>
		<aside id="sizing-popup" class="mfp-hide theme-popup text-left">
				<?php echo do_shortcode($sizing_guide_content); ?>
		</aside>
		<?php
	}
}

/* Product Page - Catalog Mode */
function thb_catalog_setup() {
	$catalog_mode = ot_get_option( 'shop_catalog_mode', 'off');
	if ($catalog_mode === 'on' ) {
		remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
	}
}
add_action( 'after_setup_theme', 'thb_catalog_setup' );

/* Wishlist */
add_action( 'yith_wcwl_before_wishlist_form', function() {
	?>
	<div class="page-padding">
		<div class="row">
			<div class="small-12 columns">
				<div class="post-content no-vc">
	<?php
}, 0 );
add_action( 'yith_wcwl_after_wishlist_form', function() {
	?>
				</div>
			</div>
		</div>
	</div>
	<?php
}, 0 );

/* Change breadcrumb delimiter */
add_filter( 'woocommerce_breadcrumb_defaults', 'thb_change_breadcrumb_delimiter' );
function thb_change_breadcrumb_delimiter( $defaults ) {
  $defaults['delimiter'] = ' <span>/</span> ';
  return $defaults;
}

/* Redirect to Homepage when customer log out */
add_filter( 'logout_url', 'thb_new_logout_url', 10, 2);
function thb_new_logout_url($logouturl, $redir) {
	$redirect = get_option('siteurl');
	return $logouturl . '&amp;redirect_to=' . urlencode($redirect);
}

/* Plugin Page Ajax Add to Cart */
function thb_woocommerce_single_product() {
	if (ot_get_option( 'shop_product_ajax_addtocart', 'on' ) === 'off') {
		return;
	}

	function thb_ajax_add_to_cart_redirect_template() {
		$thb_ajax = filter_input( INPUT_GET, 'thb-ajax-add-to-cart', FILTER_VALIDATE_BOOLEAN );

		if ( $thb_ajax ) {
			wc_get_template( 'ajax/add-to-cart-fragments.php' );
			exit;
		}
	}
	add_action( 'wp', 'thb_ajax_add_to_cart_redirect_template', 1000 );
	function thb_woocommerce_after_add_to_cart_button() {
		global $product;
		?>
			<input type="hidden" name="action" value="wc_prod_ajax_to_cart" />
		<?php
		// Make sure we have the add-to-cart avaiable as button name doesn't submit via ajax.
		if( $product->is_type( 'simple' ) ) {
			?>
			<input type="hidden" name="add-to-cart" value="<?php echo esc_attr($product->get_id()); ?>"/>
			<?php
		}
	}
	add_action( 'woocommerce_after_add_to_cart_button', 'thb_woocommerce_after_add_to_cart_button');
	function thb_woocommerce_display_site_notice() {
		?>
		<div class="thb_prod_ajax_to_cart_notices"></div>
		<?php
	}
	add_action( 'woocommerce_before_main_content', 'thb_woocommerce_display_site_notice', 10 );
}
add_action('before_woocommerce_init', 'thb_woocommerce_single_product' );