<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

$attachment_ids = $product->get_gallery_image_ids();
$catalog_get = filter_input( INPUT_GET, 'shop_catalog_mode', FILTER_SANITIZE_STRING );
$catalog_mode = isset($catalog_get) ? $catalog_get : ot_get_option( 'shop_catalog_mode', 'off');
$shop_columns_get = filter_input( INPUT_GET, 'shop_columns', FILTER_VALIDATE_INT );
$shop_columns = isset($shop_columns_get) ? $shop_columns_get : ot_get_option( 'shop_columns', '4');

switch($shop_columns) {
	case '2':
		$columns = 'small-6';
		break;
	case '3':
		$columns = 'small-6 medium-4 large-4';
		break;
	case '4':
		$columns = 'small-6 medium-4 large-3';
		break;
	case '5':
		$columns = 'small-6 medium-4 thb-5';
		break;
	case '6':
		$columns = 'small-6 medium-4 large-2';
		break;
}
$vars = $wp_query->query_vars;

$thb_columns = array_key_exists('thb_columns', $vars) ? $vars['thb_columns'] : $columns;
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
?>

<li <?php wc_product_class("post item ".$thb_columns." columns", $product); ?>>
	<?php
		$image_html = "";

		if ( has_post_thumbnail() ) {
			$image_html = wp_get_attachment_image( get_post_thumbnail_id(), 'shop_catalog' );
		} else if ( wc_placeholder_img_src() ) {
			$image_html = wc_placeholder_img( 'shop_catalog' );
		}
	?>
	<figure class="product-image">
		<?php do_action( 'thb_product_badge'); ?>
		<?php echo thb_wishlist_button(); ?>
		<?php
			if ($attachment_ids) {

					echo '<a href="'.get_the_permalink().'" title="'. the_title_attribute(array('echo' => 0)).'" class="fade">'.$image_html.'</a>';

					if ( ! get_post_meta( $attachment_ids[0], '_woocommerce_exclude_image', true ) ) {
						echo '<a href="'.get_the_permalink().'" title="'. the_title_attribute(array('echo' => 0)).'" class="fade">'.wp_get_attachment_image( $attachment_ids[0], 'shop_catalog' ).'</a>';
					}

			} else {
					echo '<a href="'.get_the_permalink().'" title="'. the_title_attribute(array('echo' => 0)).'">'.$image_html.'</a>';
			}
		?>
		<?php if ($catalog_mode != 'on' ) { woocommerce_template_loop_add_to_cart(); } ?>
	</figure>
	<header class="post-title<?php if ($catalog_mode === 'on' ) { echo ' catalog-mode'; } ?>">
		<?php if ( 'on' === ot_get_option( 'shop_product_listing_category', 'off' ) ) { ?>
			<div class="thb-product-category">
				<?php
					$product_cats = function_exists( 'wc_get_product_category_list' ) ? wc_get_product_category_list( get_the_ID(), '\n', '', '' ) : $product->get_categories( '\n', '', '' );
					$product_cats = strip_tags( $product_cats );

					if ( $product_cats ) {
						list( $first_part ) = explode( '\n', $product_cats );
						echo esc_html( $first_part );
					}
				?>
			</div>
		<?php } ?>
		<h5><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h5>
		<?php if ( 'on' === ot_get_option( 'shop_product_listing_rating', 'off' ) ) { ?>
			<div class="product-listing-rating"><?php wc_get_template( 'loop/rating.php' ); ?></div>
		<?php } ?>
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
	</header>
</li>