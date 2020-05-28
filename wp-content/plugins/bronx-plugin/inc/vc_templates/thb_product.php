<?php function thb_product( $atts, $content = null ) {
  $atts = vc_map_get_attributes( 'thb_product', $atts );
  extract( $atts );

	if ( ! thb_wc_supported() ) {
		return;
	}

	$args = array();

	if ($product_sort == "latest-products") {
    $args = array(
			'post_type' => 'product',
			'post_status' => 'publish',
			'ignore_sticky_posts'   => 1,
			'posts_per_page' => $item_count
		);
	} else if ($product_sort == "featured-products") {
    $args = array(
	    'post_type' => 'product',
	    'post_status' => 'publish',
			'ignore_sticky_posts'   => 1,
	    'tax_query'      => array(
	    		array(
	    			'taxonomy' => 'product_visibility',
	    			'field'    => 'name',
	    			'terms'    => 'featured',
	    			'operator' => 'IN',
	    		)
			 ),
	    'posts_per_page' => $item_count
		);
	} else if ($product_sort == "top-rated") {
    $ordering_args = WC()->query->get_catalog_ordering_args( 'rating', 'asc' );
    $args = array(
	    'post_type' => 'product',
	    'post_status' => 'publish',
			'ignore_sticky_posts'   => 1,
	    'posts_per_page' => $item_count,
	    'meta_key' 				=> $ordering_args['meta_key'],
	    'orderby' 				=> $ordering_args['orderby'],
			'order' 				=> $ordering_args['order'],
		);

	} else if ($product_sort == "sale-products") {
		$args = array(
		  'post_type' => 'product',
			'post_status' => 'publish',
			'ignore_sticky_posts'   => 1,
			'posts_per_page' => $item_count,
			'meta_query'     => array(
		    'relation' => 'OR',
		    array( // Simple products type
		        'key'           => '_sale_price',
		        'value'         => 0,
		        'compare'       => '>',
		        'type'          => 'numeric'
		    ),
		    array( // Variable products type
		        'key'           => '_min_variation_sale_price',
		        'value'         => 0,
		        'compare'       => '>',
		        'type'          => 'numeric'
		    )
			)
		);
	} else if ($product_sort == "by-category"){
		$args = array(
			'post_type' => 'product',
			'post_status' => 'publish',
			'ignore_sticky_posts'   => 1,
			'product_cat' => $cat,
			'posts_per_page' => $item_count,
			'no_found_rows' => true,
		);
	} else if ($product_sort == "by-id"){
		$product_id_array = explode(',', $product_ids);
		$args = array(
			'post_type' => 'product',
			'post_status' => 'publish',
			'ignore_sticky_posts'   => 1,
			'post__in'		=> $product_id_array,
			'posts_per_page' => 99,
			'no_found_rows' => true,
			'orderby'		=> 'post__in'
		);
	} else {
		$args = array(
			'post_type' => 'product',
			'post_status' => 'publish',
			'ignore_sticky_posts'   => 1,
			'posts_per_page' => $item_count,
			'meta_key' 		=> 'total_sales',
			'orderby' 		=> 'meta_value'
		);
	}
  $args['meta_query'] = WC()->query->get_meta_query();
	$products = new WP_Query( $args );

 	ob_start();

 	switch($columns) {
 		case '3':
 			$columns = 'small-6 medium-4 large-4';
 			break;
 		case '4':
 			$columns = 'small-6 medium-6 large-3';
 			break;
 		case '5':
 			$columns = 'small-6 medium-4 thb-5';
 			break;
 		case '6':
 			$columns = 'small-6 medium-4 large-2';
 			break;
 	}
 	$catalog_mode = ot_get_option( 'shop_catalog_mode', 'off');
 	remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
	if ( $products->have_posts() ) { ?>

		<ul class="products shortcode row">

			<?php
				while ( $products->have_posts() ) : $products->the_post();
					set_query_var( 'thb_columns', $columns);
					wc_get_template_part( 'content', 'product' );

				endwhile; // end of the loop. ?>

		</ul>

	<?php }

  $out = ob_get_clean();

  wp_reset_postdata();

  return $out;
}
thb_add_short('thb_product', 'thb_product');
