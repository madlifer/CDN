<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
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
 * @version     3.4.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header('shop');

?>
<?php
	$sidebar_get = filter_input( INPUT_GET, 'sidebar', FILTER_SANITIZE_STRING );
	$sidebar_pos = isset($sidebar_get) ? $sidebar_get : ot_get_option( 'shop_sidebar', 'no');

	$product_categories = false;

	$term 				= get_queried_object();
	$parent_id 		= empty( $term->term_id ) ? 0 : $term->term_id;
	$categories 	= get_terms('product_cat', array('hide_empty' => 0, 'parent' => $parent_id));

	/* Shop Page */
  if ( is_shop() && (get_option('woocommerce_shop_page_display') == 'subcategories') ) $product_categories = 'only';
  if ( is_shop() && (get_option('woocommerce_shop_page_display') == 'both') ) $product_categories = 'both';

  /* Category Page */
  if ( is_product_category() && (get_option('woocommerce_category_archive_display') == 'subcategories') ) $product_categories = 'only';
  if ( is_product_category() && (get_option('woocommerce_category_archive_display') == 'both') ) $product_categories = 'both';

  if ( is_product_category() && (get_term_meta($parent_id, 'display_type', true) == 'subcategories' ) ) $product_categories = 'only';
  if ( is_product_category() && (get_term_meta($parent_id, 'display_type', true) == 'both') ) $product_categories = 'both';



?>
<?php
	if ($categories && ot_get_option( 'show_category_bar', 'on' ) === 'on' ) {
	 if ($categories) {
		echo '<ul class="shop_subcategories">';
			foreach($categories as $category) {
			  ?>
			     <li>
			         <a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>">
			             <?php echo esc_html($category->name); ?>
			         </a>
			     </li>
				<?php
			}
		echo '</ul>';
	 }
	}
?>
<div id="shop-page">
	<div class="row">
			<?php
				/**
				 * woocommerce_before_main_content hook
				 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
				 */
				do_action( 'woocommerce_before_main_content');

				$section_class[] = 'small-12';
				$section_class[] = $sidebar_pos !== 'no' ? 'large-9' :  false;
				$section_class[] = 'columns';
				$section_class[] = $sidebar_pos == 'left' ? 'large-order-2' : false;
			?>
			<section class="<?php echo esc_attr(implode(' ', $section_class)); ?>">


			<div class="shop_bar">
		    <div class="row">
	        <div class="small-12 medium-6 columns breadcrumbs">
	          <?php do_action( 'thb_woocommerce_product_breadcrumb'); ?>
	        </div>
	        <div class="small-12 medium-6 columns ordering">
	          <?php if ( have_posts() ) : ?>
	        		<?php do_action( 'thb_before_shop_loop_result_count' ); ?>
	            <?php do_action( 'thb_before_shop_loop_catalog_ordering' ); ?>
	          <?php endif; ?>
	        </div>
		    </div>
			</div>

			<?php if ( woocommerce_product_loop() ) {
				/**
				 * Hook: woocommerce_before_shop_loop.
				 *
				 * @hooked wc_print_notices - 10
				 * @hooked woocommerce_result_count - 20
				 * @hooked woocommerce_catalog_ordering - 30
				 */
				do_action( 'woocommerce_before_shop_loop' );
				woocommerce_product_loop_start();
				if ( wc_get_loop_prop( 'total' ) ) {
					while ( have_posts() ) {
						the_post();

						/**
						 * Hook: woocommerce_shop_loop.
						 *
						 * @hooked WC_Structured_Data::generate_product_data() - 10
						 */
						do_action( 'woocommerce_shop_loop' );
						wc_get_template_part( 'content', 'product' );
					}
				}
				woocommerce_product_loop_end();
				/**
				 * Hook: woocommerce_after_shop_loop.
				 *
				 * @hooked woocommerce_pagination - 10
				 */
				do_action( 'woocommerce_after_shop_loop' );
			} else {
				/**
				 * Hook: woocommerce_no_products_found.
				 *
				 * @hooked wc_no_products_found - 10
				 */
				do_action( 'woocommerce_no_products_found' );
			} ?>

			<?php
				/**
				 * woocommerce_after_main_content hook
				 *
				 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
				 */
				do_action( 'woocommerce_after_main_content');
			?>
			</section>
		  <?php get_sidebar('shop'); ?>
	</div>
</div><!-- end row -->

<?php get_footer('shop'); ?>