<?php
/**
 * Single Product Thumbnails
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-thumbnails.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.1.0
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

$attachment_ids = $product->get_gallery_image_ids();

if ( $attachment_ids && has_post_thumbnail() ) {
	?>
	<div id="product-thumbnails" class="carousel slick product-thumbnails" data-navigation="false" data-autoplay="false" data-columns="5" data-asnavfor="#product-images" data-disablepadding="true" data-infinite="false" data-vertical="true">
		<?php
			if ( has_post_thumbnail() ) :
			  echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', wc_get_gallery_image_html( $product->get_image_id()  ), $product->get_image_id() );
			endif;
			foreach ( $attachment_ids as $attachment_id ) {
				echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', wc_get_gallery_image_html( $attachment_id  ), $attachment_id );
			}
		?>
	</div>
	<?php
}