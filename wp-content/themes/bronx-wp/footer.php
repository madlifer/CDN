<?php
	$thb_id = get_queried_object_id();

	if ( get_post_meta( $thb_id, 'footer_override', true ) === 'on' ) {
		$footer_newsletter = get_post_meta( $thb_id, 'footer_newsletter', true );
		$footer            = get_post_meta( $thb_id, 'footer', true );
		$subfooter         = get_post_meta( $thb_id, 'subfooter', true );
	} else {
		$footer_newsletter = ot_get_option( 'footer_newsletter', 'on' );
		$footer            = ot_get_option( 'footer', 'on' );
		$subfooter         = ot_get_option( 'subfooter', 'on' );
	}
?>
		</div><!-- End role["main"] -->
		<?php if ( thb_accountpage_notloggedin() ) { ?>
			<?php if ( $footer_newsletter !== 'off' ) { get_template_part( 'inc/templates/footer/subscribe' ); } ?>
			<?php if ( $footer !== 'off' ) { get_template_part( 'inc/templates/footer/footer' ); } ?>
			<?php if ( $subfooter !== 'off' ) { get_template_part( 'inc/templates/footer/subfooter' ); } ?>
		<?php } ?>
	</section> <!-- End #content-container -->
</div> <!-- End #wrapper -->
<?php

	/*
	 * Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */
	 wp_footer();
?>
</body>
</html>