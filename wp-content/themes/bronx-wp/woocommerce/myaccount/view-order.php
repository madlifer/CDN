<?php
/**
 * View Order
 *
 * Shows the details of a particular order on the account page.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/view-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>

<?php wc_print_notices(); ?>
		<div class="your-order-header woocommerce-order-overview">
			<div>
				<div class="order-container woocommerce-order-overview__order order">
					<?php esc_html_e( 'Order','bronx' ); ?> <span><?php echo $order->get_order_number(); ?></span>
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
		<div class="order-status<?php if ( $order->has_status( 'failed' ) ) : ?> failed<?php endif; ?>">
			<h6><?php printf( __( 'Your order is currently <u>%s</u>.', 'woocommerce' ), wc_get_order_status_name( $order->get_status() ) ); ?></h6>
		</div>
		<?php if ( $notes = $order->get_customer_order_notes() ) : ?>
			<h2><?php _e( 'Order Updates', 'woocommerce' ); ?></h2>
			<ol class="woocommerce-OrderUpdates commentlist notes">
				<?php foreach ( $notes as $note ) : ?>
				<li class="woocommerce-OrderUpdate comment note">
					<div class="woocommerce-OrderUpdate-inner comment_container">
						<div class="woocommerce-OrderUpdate-text comment-text">
							<p class="woocommerce-OrderUpdate-meta meta"><?php echo date_i18n( __( 'l jS \o\f F Y, h:ia', 'woocommerce' ), strtotime( $note->comment_date ) ); ?></p>
							<div class="woocommerce-OrderUpdate-description description">
								<?php echo wpautop( wptexturize( $note->comment_content ) ); ?>
							</div>
			  				<div class="clear"></div>
			  			</div>
						<div class="clear"></div>
					</div>
				</li>
				<?php endforeach; ?>
			</ol>
		<?php endif; ?>
		<?php do_action( 'woocommerce_view_order', $order_id ); ?>
	</div>