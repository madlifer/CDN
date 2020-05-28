<?php
/**
 * The template for displaying product category thumbnails within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product_cat.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$shop_columns = isset($_GET['shop_columns']) ? htmlspecialchars($_GET['shop_columns']) : ot_get_option( 'shop_columns', 4);

switch($shop_columns) {
	case '2':
		$columns = 'small-6';
		break;
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
$product_categories = false;

?>
<li class="item <?php echo esc_attr($columns); ?> columns">
	<div <?php wc_product_cat_class( '', $category ); ?>>

		<span><?php echo esc_html( $category->name ); ?></span>

		<div class="title">
			<h2><a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>" title="<?php echo esc_attr($category->name); ?>"><?php echo esc_html( $category->name ); ?></a></h2>
		</div>

			<?php
			/**
			 * woocommerce_before_subcategory hook.
			 *
			 * @hooked woocommerce_template_loop_category_link_open - 10
			 */
			do_action( 'woocommerce_before_subcategory', $category );

			?>
			<figure>
			<?php /**
				 * woocommerce_before_subcategory_title hook.
				 *
				 * @hooked woocommerce_subcategory_thumbnail - 10
				 */
				do_action( 'woocommerce_before_subcategory_title', $category );
			?>
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
</li>