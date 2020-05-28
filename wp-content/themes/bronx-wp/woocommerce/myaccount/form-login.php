<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
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
 * @version 3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php do_action( 'woocommerce_before_customer_login_form' ); ?>

<div id="customer_login" class="full-height-content">
	<div class="row align-center">
			<div class="small-12 small-centered medium-6 large-4 xlarge-3 columns">
					<?php wc_print_notices();  ?>
					<div class="text-center logo">
						<?php
							$logo_dark = ot_get_option( 'logo_dark', Thb_Theme_Admin::$thb_theme_directory_uri.'assets/img/logo-dark.png');
						?>
						<a href="<?php echo esc_url(home_url( '/' )); ?>" class="logolink">
							<img src="<?php echo esc_url($logo_dark); ?>" class="logoimg logo--dark" alt="<?php bloginfo('name'); ?>"/>
						</a>
					</div>
					<div class="login-container">
						<p class="text-center"><?php esc_html_e( "I'm an existing customer and would like to login." ,'bronx' ); ?></p>
						<form method="post" class="woocommerce-form woocommerce-form-login login text-center">
								<input type="text" class="input-text full" name="username" id="username" placeholder="<?php esc_html_e( 'Username or email address', 'woocommerce' ); ?>" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( $_POST['username'] ) : ''; ?>" />
								<input class="input-text full" type="password" name="password" id="password" placeholder="<?php esc_html_e( 'Password', 'woocommerce' ); ?>"/>
							<div class="row">
								<div class="small-6 <?php if (is_rtl()) { ?>small-push-6 <?php } ?>columns">
									<div class="remember">
										<input name="rememberme" type="checkbox" id="rememberme" value="forever" class="custom_check"/> <label for="rememberme" class="checkbox custom_label"><?php esc_html_e( 'Remember me','bronx' ); ?></label>
									</div>
								</div>
								<div class="small-6 <?php if (is_rtl()) { ?>small-pull-6 <?php } ?>columns">
									<a class="lost_password" href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost Password?','bronx' ); ?></a>
								</div>
							</div>

							<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
							<button type="submit" class="woocommerce-Button button black small" name="login" value="<?php esc_attr_e( 'Login', 'woocommerce' ); ?>"><?php esc_html_e( 'Login', 'woocommerce' ); ?></button>
							<?php if($_SERVER['HTTP_HOST'] === 'bronx.fuelthemes.net') {?>
							<p style="margin:0;"><small>Try our demo account -  <strong>username:</strong> demo <strong>password</strong> demo</small></p>
							<?php } ?>
						</form>
						<?php if (get_option('woocommerce_enable_myaccount_registration')=='yes') : ?>
						<div class="text-center">
							<p><strong><?php esc_html_e( "I'm a new customer and would like to register." ,'bronx' ); ?></strong></p>
							<a href="#" class="btn small" id="create-account"><?php esc_html_e( 'Create a New Account','bronx' ); ?></a>
						</div>
						<?php endif; ?>
					</div>
					<?php if (get_option('woocommerce_enable_myaccount_registration')=='yes') : ?>
					<div class="register-container">
						<p class="text-center"><?php esc_html_e( "I'm a new customer and would like to register." ,'bronx' ); ?></p>
						<form method="post" class="woocommerce-form woocommerce-form-register register"  <?php do_action( 'woocommerce_register_form_tag' ); ?>>
							<?php do_action( 'woocommerce_register_form_start' ); ?>
							<?php if (get_option('woocommerce_registration_generate_username')=='no') : ?>
									<input type="text" class="input-text full" name="username" id="reg_username" value="<?php if (isset($_POST['username'])) echo esc_attr($_POST['username']); ?>" placeholder="<?php esc_html_e( 'Username', 'woocommerce' ); ?>" />

							<?php else : endif; ?>
								<input type="email" class="input-text full" name="email" id="reg_email" value="<?php if (isset($_POST['email'])) echo esc_attr($_POST['email']); ?>" placeholder="<?php esc_html_e( 'Email address', 'woocommerce' ); ?>" />
							<?php if (get_option('woocommerce_registration_generate_password')=='no') : ?>
								<input type="password" class="input-text full" name="password" id="reg_password" value="<?php if (isset($_POST['password'])) echo esc_attr($_POST['password']); ?>" placeholder="<?php esc_html_e( 'Password', 'woocommerce' ); ?>" />
							<?php endif; ?>

							<?php do_action( 'woocommerce_register_form' ); ?>

							<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
							<p class="text-center">
								<button type="submit" class="woocommerce-Button button black small" name="register" value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>"><?php esc_html_e( 'Register', 'woocommerce' ); ?></button>
							</p>

							<?php do_action( 'woocommerce_register_form_end' ); ?>
						</form>
						<div class="text-center">
							<p><strong><?php esc_html_e( "I'm an existing customer and would like to login." ,'bronx' ); ?></strong></p>
							<a href="#" class="btn small" id="login-account"><?php esc_html_e( 'Login to Existing Account','bronx' ); ?></a>
						</div>
					</div>
					<?php endif; ?>
				<?php do_action( 'woocommerce_after_customer_login_form'); ?>
			</div>
	</div>
	<div class="back_home">
		<a href="<?php echo esc_url(home_url( '/' )); ?>"><?php esc_html_e( 'Back to','bronx' ); ?> <?php bloginfo('name'); ?></a>
	</div>
</div>
