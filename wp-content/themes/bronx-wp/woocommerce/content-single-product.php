<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
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
 * @version     3.6.0
 */

	if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
	}

	global $product;

	/**
	 * woocommerce_before_single_product hook.
	 *
	 * @hooked wc_print_notices - 10
	 */
	 remove_action( 'woocommerce_before_single_product', 'wc_print_notices', 10);
	 do_action( 'woocommerce_before_single_product' );

	 if ( post_password_required() ) {
	 	echo get_the_password_form();
	 	return;
	 }

	$shop_product_style = isset($_GET['shop_product_style']) ? htmlspecialchars($_GET['shop_product_style']) : ot_get_option( 'shop_product_style', 'style1');
?>
<div class="single_product_bar">
	<div class="row">
		<div class="medium-10 columns text-left">
			<?php do_action( 'thb_woocommerce_product_breadcrumb'); ?>
		</div>
		<div class="medium-2 columns text-right hide-for-small">
			<?php echo thb_product_nav(); ?>
		</div>
	</div>
</div>
<div class="row">
	<div class="small-12 columns">
<div id="product-<?php the_ID(); ?>" <?php wc_product_class('post product-page '.$shop_product_style, $product); ?>>
	<div class="row">
			<div class="small-12 <?php echo esc_attr($shop_product_style === 'style1' ? 'large-6' : 'large-7'); ?> columns product-gallery carousel-container">
		    <?php
		        /**
		         * woocommerce_show_product_images hook
		         *
		         * @hooked woocommerce_show_product_sale_flash - 10
		         * @hooked woocommerce_show_product_images - 20
		         *
		         */
		        do_action( 'woocommerce_before_single_product_summary' );
		    ?>
		 	</div>
		  <div class="small-12 <?php echo esc_attr($shop_product_style === 'style1' ? 'large-6' : 'large-5 table'); ?> columns product-information">
		  	<?php if ($shop_product_style == 'style2') { ?><div><?php } ?>

		    <?php
		    	echo wc_print_notices();
	        /**
	        	 * woocommerce_single_product_summary hook
	        	 *
	        	 * @hooked woocommerce_template_single_title - 5
	        	 * @hooked woocommerce_template_single_rating - 10
	        	 * @hooked woocommerce_template_single_price - 10
	        	 * @hooked woocommerce_template_single_excerpt - 20
	        	 * @hooked woocommerce_template_single_add_to_cart - 30
	        	 * @hooked woocommerce_template_single_meta - 40
	        	 * @hooked woocommerce_template_single_sharing - 50
	        	 */

	        do_action( 'woocommerce_single_product_summary' );
		    ?>
	  		<?php
	  		    /**
	  		     * woocommerce_after_single_product_summary hook
	  		     *
	  		     * @hooked woocommerce_output_related_products - 20
	  		     */
	  		    do_action( 'woocommerce_after_single_product_summary' );
	  		?>
		    <?php if ($shop_product_style == 'style2') { ?></div><?php } ?>
		  </div>
	</div>
</div><!-- #product-<?php the_ID(); ?> -->
	</div>
</div>
<?php do_action( 'woocommerce_after_single_product' ); ?>