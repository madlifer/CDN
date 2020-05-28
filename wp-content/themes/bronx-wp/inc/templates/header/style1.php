<?php
	$thb_id = get_queried_object_id();
	$header_transparent = $header_container = '';
	$header = ot_get_option( 'header', 'on' );
	$fixed_header = ot_get_option( 'header_fixed', 'on' ) === 'on' ? 'tofixed' : '';
	$header_color = ot_get_option( 'header_color','header--light');
	$page_menu = (get_post_meta( $thb_id, 'page_menu', true) !== '' ? get_post_meta( $thb_id, 'page_menu', true) : false);
	if(thb_wc_supported()) {
		if (is_shop()) {
			$header_transparent = 'transparent';
			$header_color = ot_get_option( 'header_color_shop') ? ot_get_option( 'header_color_shop') : 'header--dark';
		}
		if (is_product_category()) {
			$header_transparent = 'transparent';
			$header_color = ot_get_option( 'header_color_product_category') ? ot_get_option( 'header_color_product_category') : 'header--dark';
		}
		if (is_account_page()) {
			$header_transparent = 'transparent';
			$header_color = ot_get_option( 'header_color_myaccount') ? ot_get_option( 'header_color_myaccount') : 'header--dark';
		}
		if (is_cart()) {
			$header_transparent = 'transparent';
			$header_color = ot_get_option( 'header_color_cart') ? ot_get_option( 'header_color_cart') : 'header--dark';
		}
		if (is_checkout()) {
			$header_transparent = 'transparent';
			$header_color = ot_get_option( 'header_color_checkout') ? ot_get_option( 'header_color_checkout') : 'header--dark';
		}
	}
	if (get_post_meta( $thb_id, 'header_override', true) === 'on' ) {
		$header = get_post_meta( $thb_id, 'header', true);
		$header_container = get_post_meta( $thb_id, 'header_container', true);
		$header_transparent = get_post_meta( $thb_id, 'header_transparent', true) === 'on' ? 'transparent' : '';
		$header_color = get_post_meta( $thb_id, 'header_color', true) ? get_post_meta( $thb_id, 'header_color', true) : 'header--dark';
	}
?>
<?php if ($header !== 'off') { ?>

	<?php if (thb_header_container($header_container)) {
		echo '<div class="header-container">';
	} ?>
	<!-- Start Header -->
	<header class="header style1 <?php echo esc_attr($header_transparent.' '.$header_color.' '.$fixed_header);?>" data-offset="400" data-stick-class="header--slide" data-unstick-class="header--unslide">
		<div class="row">
			<div class="small-6 medium-6 large-3 columns logo">
				<?php
					$logo = ot_get_option( 'logo', Thb_Theme_Admin::$thb_theme_directory_uri.'assets/img/logo-light.png');
					$logo_dark = ot_get_option( 'logo_dark', Thb_Theme_Admin::$thb_theme_directory_uri.'assets/img/logo-dark.png');
				?>
				<a href="<?php echo home_url(); ?>" class="logolink">
					<img src="<?php echo esc_url($logo); ?>" class="logoimg logo--light" alt="<?php bloginfo('name'); ?>"/>
					<img src="<?php echo esc_url($logo_dark); ?>" class="logoimg logo--dark" alt="<?php bloginfo('name'); ?>"/>
				</a>
			</div>
			<div class="small-12 large-6 columns menu-holder">
					<nav>
						<?php if ($page_menu) { ?>
							<?php wp_nav_menu( array( 'menu' => $page_menu, 'depth' => 3, 'container' => false, 'menu_class' => 'sf-menu', 'walker' => new thb_MegaMenu ) ); ?>
						<?php } else if (has_nav_menu('nav-menu')) { ?>
						  <?php wp_nav_menu( array( 'theme_location' => 'nav-menu', 'depth' => 3, 'container' => false, 'menu_class' => 'sf-menu', 'walker' => new thb_MegaMenu  ) ); ?>
						<?php } ?>
					</nav>
			</div>

			<div class="small-6 medium-6 large-3 columns account-holder">
				<?php do_action( 'thb_secondary_area'); ?>
			</div>
		</div>
	</header>


	<?php if (thb_header_container($header_container)) { ?>
			<div id="page-title" class="table">
				<div>
					<h1 class="page-title">
						<?php
							if ( thb_wc_supported() && function_exists('is_woocommerce') ) {
								woocommerce_page_title();
							} else {
								echo get_the_title($thb_id);
							}
						?>
					</h1>

					<?php if(is_user_logged_in() && is_account_page()) {
						$current_user = wp_get_current_user();
					?>
						<p>
							<?php esc_html_e('Logged in as: ', 'bronx' ); echo '<span>'.esc_html($current_user->display_name).'</span>'; ?>
						</p>
					<?php } ?>

				</div>
			</div>
		</div>
	<?php } ?>
	<!-- End Header -->
<?php }