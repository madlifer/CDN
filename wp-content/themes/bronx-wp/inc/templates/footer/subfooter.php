<?php $copyright = ot_get_option( 'copyright','Copyright 2018 BRONX ONLINE SHOPPING THEME. All RIGHTS RESERVED.'); ?>
<!-- Start Sub-Footer -->
<footer class="subfooter">
	<div class="row align-center">
		<div class="small-12 medium-6 columns footer-menu-holder text-center">
			<?php if(has_nav_menu('footer-menu')) { ?>
			  <?php wp_nav_menu( array( 'theme_location' => 'footer-menu', 'depth' => 1, 'container' => false, 'menu_class' => 'footer-menu' ) ); ?>
			<?php } ?>
			<p><?php echo wp_kses_post($copyright); ?> </p>
			<div class="social-links">
				<?php if (ot_get_option( 'social-payment') == 'social') {?>
				<?php do_action( 'thb_social' ); ?>
				<?php } else if (ot_get_option( 'social-payment') == 'payment') { ?>
				<?php do_action( 'thb_payment' ); ?>
				<?php } ?>
			</div>
		</div>
	</div>
</footer>
<!-- End Sub-Footer -->