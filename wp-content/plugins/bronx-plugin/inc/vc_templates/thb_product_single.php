<?php function thb_product_single( $atts, $content = null ) {
  $atts = vc_map_get_attributes( 'thb_product_single', $atts );
	extract( $atts );
	
	if ( ! thb_wc_supported() ) {
		return;
	}
	
	$args = array(
		'post_type' => 'product',
		'post_status' => 'publish',
		'ignore_sticky_posts'   => 1,
		'p'		=> $product_id
	);
	$products = new WP_Query( $args );
 	
 	ob_start();
 	
 	$catalog_mode = ot_get_option( 'shop_catalog_mode', 'off');
 	$shop_product_listing = ot_get_option( 'shop_product_listing', 'style1');
 	
	if ( $products->have_posts() ) { while ( $products->have_posts() ) : $products->the_post(); ?>
		<?php $product = wc_get_product( $products->post->ID ); ?>
		<div class="products">
		<article itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" <?php post_class("post small-12 columns ". $shop_product_listing); ?>>
		
		<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
		
			<?php
				$image_html = "";
		
				if ( has_post_thumbnail() ) {
					$image_html = wp_get_attachment_image( get_post_thumbnail_id(), 'shop_catalog' );					
				}
			?>
			<?php if ($shop_product_listing == 'style1') { ?>
				<figure class="fresco">
					<?php do_action( 'thb_product_badge'); ?>
					<?php echo $image_html; ?>			
					<div class="overlay"></div>
					<div class="buttons">
						<?php echo thb_wishlist_button(); ?>
						<div class="post-title<?php if ($catalog_mode === 'on' ) { echo ' catalog-mode'; } ?>">
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</div>
						<?php if ($catalog_mode != 'on' ) { ?>
							<?php
								/**
								 * woocommerce_after_shop_loop_item_title hook
								 *
								 * @hooked woocommerce_template_loop_price - 10
								 */
								do_action( 'woocommerce_after_shop_loop_item_title' );
							?>
							<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
						<?php } ?>
					</div>
				</figure>
			<?php } else if ($shop_product_listing == 'style2') { ?>
				<figure class="fresco">
					<?php do_action( 'thb_product_badge'); ?>
					<a href="<?php the_permalink(); ?>"><?php echo $image_html; ?></a>
				</figure>
				<div class="post-title<?php if ($catalog_mode === 'on' ) { echo ' catalog-mode'; } ?>">
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</div>
				<?php if ($catalog_mode != 'on' ) { ?>
					<?php
						/**
						 * woocommerce_after_shop_loop_item_title hook
						 *
						 * @hooked woocommerce_template_loop_price - 10
						 */
						do_action( 'woocommerce_after_shop_loop_item_title' );
					?>
					<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
				<?php } ?>
			<?php } ?>
		</article><!-- end product -->
		</div>
	<?php endwhile;  }
	     
   $out = ob_get_clean();
   
   wp_reset_postdata();
	   
  return $out;
}
thb_add_short('thb_product_single', 'thb_product_single');
