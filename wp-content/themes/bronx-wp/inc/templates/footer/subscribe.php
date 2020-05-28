<div class="thb_subscribe">
	<div class="row align-center">
		<div class="small-12 medium-6 large-6 columns footer-menu-holder text-center">
		 	<p><?php esc_html_e("Subscribe to our newsletter",'bronx'); ?></p>
			<form class="newsletter-form" action="#" method="post" data-security="<?php echo esc_attr( wp_create_nonce( 'thb_subscription' ) ); ?>">
				<input placeholder="<?php esc_attr_e("Your E-Mail",'bronx'); ?>" type="text" name="widget_subscribe" class="widget_subscribe">
				<button type="submit" name="submit"><?php esc_html_e("&rarr;",'bronx'); ?></button>
			</form>
			<div class="result"></div>
		</div>
	</div>
</div>