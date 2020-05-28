<?php function thb_add_to_cart( $atts, $content = null ) {
	$atts = vc_map_get_attributes( 'thb_add_to_cart', $atts );
	extract( $atts );
	$out = '';
	global $post;
	if ( ! empty( $id ) ) {
		$product_data = get_post( $id );
	}
	$product = wc_setup_product_data( $product_data );
	
	if ( ! $product ) {
		return '';
	}
	ob_start();

	?>
	<div class="product_add_to_cart_shortcode <?php echo esc_attr($align); ?>">
	<?php if ( $title == 'true' ) { ?>
		<h5><a href="<?php echo esc_url($product->get_permalink()); ?>" title="<?php echo esc_attr($product->get_title()); ?>"><?php echo esc_attr($product->get_title()); ?></a></h5>
	<?php } ?>
	<?php if ( $price == 'true' ) { ?>
		<div class="price"><?php echo $product->get_price_html(); ?></div>
	<?php } ?>
	<?php
		echo apply_filters( 'woocommerce_loop_add_to_cart_link',
			sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="btn add_to_cart '.$size.' '.$color.' %s product_type_%s">%s</a>',
				esc_url( $product->add_to_cart_url() ),
				esc_attr( $product->get_id() ),
				esc_attr( $product->get_sku() ),
				$product->is_purchasable() ? 'add_to_cart_button' : '',
				esc_attr( $product->get_type() ),
				esc_html( $product->add_to_cart_text() )
			),
		$product );
	?>
	</div>
	<?php
	$out = ob_get_clean();
	wc_setup_product_data($post);
  return $out;
}
thb_add_short('thb_add_to_cart', 'thb_add_to_cart');
