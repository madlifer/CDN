<?php function thb_grid( $atts, $content = null ) {
	if ( ! thb_wc_supported() ) {
		return;
	}
	$atts = vc_map_get_attributes( 'thb_grid', $atts );
	extract( $atts );

	$args = $product_categories = $category_ids = array();
	$cats = explode(",", $cat);


	foreach ($cats as $cat) {
		$c = get_term_by('slug',$cat,'product_cat');

		if($c) {
			array_push($category_ids, $c->term_id);
		}
	}

	$args = array(
		'orderby'    => 'name',
		'order'      => 'ASC',
		'hide_empty' => '0',
		'include'	=> $category_ids
	);

	$product_categories = get_terms( 'product_cat', $args );
 	ob_start();
 	$i = 1;
	?>
	<?php
		if ( $product_categories ) { ?>
				<div class="row masonry category-<?php echo esc_attr($style); ?> category-grid">
			<?php foreach ( $product_categories as $category ) {
				if ($style == "style1") {
					switch($i) {
						case 1:
						case 8:
						case 11:
							$articlesize = 'small-12 medium-12 large-6 padding-1';
							break;
						case 2:
						case 3:
						case 4:
						case 5:
						case 6:
						case 7:
						case 9:
						case 10:
						default:
							$articlesize = 'small-6 large-3 padding-1 padding-1-small';
							break;
					}
				} else if($style == "style2") {

					$articlesize = 'small-12 medium-12 large-6';
				}
				?>
				<div class="<?php echo esc_attr($articlesize); ?> columns">
					<div <?php wc_product_cat_class( '', $category ); ?>>

						<span><?php echo esc_html($category->name); ?></span>

						<div class="title">
							<h2><a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>" title="<?php echo esc_attr($category->name); ?>"><?php echo $category->name; ?></a></h2>
						</div>

							<?php
							/**
							 * woocommerce_before_subcategory hook.
							 *
							 * @hooked woocommerce_template_loop_category_link_open - 10
							 */
							do_action( 'woocommerce_before_subcategory', $category );

							?>
							<?php

								$thumbnail_id = get_term_meta( $category->term_id, 'thumbnail_id', true  );
								$aspect = '';
								if ( $thumbnail_id ) {
								  $image = wp_get_attachment_image_src( $thumbnail_id, 'full' );
								  $aspect = (($image[2] / $image[1]) * 100). "%";
								  $image = $image[0];
								} else {
							  	$image = wc_placeholder_img_src();
							  	$aspect = "100%";
							  }
							 	$attribute = 'background-image:url('.$image.');';
							 	$attribute .= $style === 'style2' ? "padding-bottom:".$aspect : "";

							?>
							<figure style="<?php echo esc_attr($attribute); ?>">

							</figure>
							<?php
								/**
								 * woocommerce_after_subcategory hook.
								 *
								 * @hooked woocommerce_template_loop_category_link_close - 10
								 */
								do_action( 'woocommerce_after_subcategory', $category );
							?>
							<?php
								/**
								 * woocommerce_after_subcategory_title hook
								 */
								do_action( 'woocommerce_after_subcategory_title', $category );
							?>
					</div>
				</div>
				<?php
				$i++;
			} ?>
			</div>
		<?php }
		woocommerce_reset_loop();
	?>

	<?php

   $out = ob_get_clean();
   wp_reset_postdata();

  return $out;
}
thb_add_short('thb_grid', 'thb_grid');
