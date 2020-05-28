<?php
/**
 * Login form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/form-login.php.
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

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( is_user_logged_in() )
	return;
?>

<form method="post" class="login" <?php if ( $hidden ) echo 'style="display:none;"'; ?>>
	<div class="row align-center">
		<div class="small-12 medium-4 large-3 columns">
	<?php do_action( 'woocommerce_login_form_start' ); ?>

	<?php if ( $message ) echo wpautop( wptexturize( $message ) ); ?>

			<label for="username"><?php esc_html_e( 'Username or email', 'woocommerce' ); ?> <span class="required">*</span></label>
			<input type="text" class="input-text full" name="username" id="username" />

			<label for="password"><?php esc_html_e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label>
			<input class="input-text full" type="password" name="password" id="password" />

			<?php do_action( 'woocommerce_login_form' ); ?>

			<?php wp_nonce_field( 'woocommerce-login' ); ?>
			<div class="row">
				<div class="columns">
			<input name="rememberme" type="checkbox" id="rememberme" value="forever" class="custom_check"/><label for="rememberme" class="custom_label"><?php esc_html_e( 'Remember me', 'woocommerce' ); ?></label>
			<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>" class="lost_password"><?php esc_html_e( 'Lost your password?', 'woocommerce' ); ?></a>
				</div>
			</div>
			<p>
			<input type="submit" class="button outline login_button" name="login" value="<?php esc_html_e( 'Login', 'woocommerce' ); ?>" />
			</p>
			<input type="hidden" name="redirect" value="<?php echo esc_url( $redirect ) ?>" />

			<?php do_action( 'woocommerce_login_form_end' ); ?>
		</div>
	</div>
</form>
