<?php
/**
 * Empty cart page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version   3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>
<div class="text-center thb-cart-empty">
	<section>
		<figure></figure>
		<?php do_action( 'woocommerce_cart_is_empty' ); ?>

		<p class="return-to-shop"><a class="button black" href="<?php echo apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ); ?>"><?php esc_html_e( 'Return To Shop', 'bronx' ) ?></a></p>
	</section>
</div>
