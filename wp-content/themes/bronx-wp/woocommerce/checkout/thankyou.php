<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
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
 * @version     3.7.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div class="woocommerce-order">
	<?php do_action( 'woocommerce_before_thankyou', $order->get_id() ); ?>
	<div class="row align-center">
		<div class="small-12 medium-10 xlarge-8 columns">
			<?php if ( ! $order->has_status( 'failed' ) ) : ?>
			<div class="your-order-header woocommerce-order-overview">
				<div>
					<div class="order-container woocommerce-order-overview__order order">
						<?php esc_html_e( 'Order','bronx' ); ?> <span><?php echo esc_html( $order->get_order_number() ); ?></span>
					</div>
					<div class="row">
						<div class="small-12 medium-4 columns woocommerce-order-overview__date order-details">
							<label><?php esc_html_e( 'Date','bronx' ); ?></label>
							<?php echo wc_format_datetime( $order->get_date_created() ); ?>
						</div>
						<div class="small-12 medium-4 columns woocommerce-order-overview__total order-details">
							<label><?php esc_html_e( 'Total','bronx' ); ?></label>
							<?php echo $order->get_formatted_order_total(); ?>
						</div>
						<?php if ( $order->get_payment_method_title() ) : ?>
						<div class="small-12 medium-4 columns woocommerce-order-overview__payment-method order-details">
							<label><?php esc_html_e( 'Payment method','bronx' ); ?></label>
							<?php echo wp_kses_post( $order->get_payment_method_title() ); ?>
						</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
			<?php endif; ?>
			<div class="order-status<?php if ( $order->has_status( 'failed' ) ) : ?> failed<?php endif; ?>">
				<h6><?php printf( __( 'Your order is currently <u>%s</u>.', 'woocommerce' ), wc_get_order_status_name( $order->get_status() ) ); ?></h6>
			</div>
			<div class="your-order-container">
				<?php if ( $order->has_status( 'failed' ) ) : ?>
					<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed"><?php esc_html_e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce' ); ?></p>

					<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
						<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php _e( 'Pay', 'woocommerce' ) ?></a>
						<?php if ( is_user_logged_in() ) : ?>
							<a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="button pay"><?php _e( 'My account', 'woocommerce' ); ?></a>
						<?php endif; ?>
					</p>
				<?php endif; ?>
				<?php do_action( 'woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id() ); ?>
				<?php do_action( 'woocommerce_thankyou', $order->get_id() ); ?>
			</div>
		</div>
	</div>
</div>