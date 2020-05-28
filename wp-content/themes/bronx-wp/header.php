<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php
	
		/*
		 * Always have wp_head() just before the closing </head>
		 * tag of your theme, or you will break many plugins, which
		 * generally use this hook to add elements to <head> such
		 * as styles, scripts, and meta tags.
		 */
		wp_head();
	?>
</head>
<body <?php body_class(); ?>>
<div id="wrapper" class="open">

	<!-- Start Mobile Menu -->
	<?php do_action( 'thb_mobile_menu' ); ?>
	<!-- End Mobile Menu -->

	<!-- Start Quick Cart -->
	<?php do_action( 'thb_side_cart' ); ?>
	<!-- End Quick Cart -->

	<!-- Start Content Container -->
	<section id="content-container">
		<!-- Start Content Click Capture -->
		<div class="click-capture"></div>
		<!-- End Content Click Capture -->
		<?php
			if ( thb_accountpage_notloggedin() ) {
				$thb_id       = get_queried_object_id();
				$header_style = ( get_post_meta( $thb_id, 'header_style', true ) ? get_post_meta( $thb_id, 'header_style', true ) : ot_get_option( 'header_style', 'style1' ) );
				get_template_part( 'inc/templates/header/subheader' );
				get_template_part( 'inc/templates/header/' . $header_style );
			}

			get_template_part( 'inc/templates/header/revslider' );
		?>
		<div role="main">
