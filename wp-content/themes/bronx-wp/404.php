<?php
get_header();
$fourofour_page_content = ot_get_option( '404_page_content' );
	if ( $fourofour_page_content ) {
		do_action( 'thb_page_content', $fourofour_page_content );
	} else {
		$image = ot_get_option( '404-image', Thb_Theme_Admin::$thb_theme_directory_uri.'assets/img/404.png' );
		?>
			<section class="content404 table full-height-content">
				<div>
				<div class="row align-center">
					<div class="small-12 medium-10 xlarge-8 columns text-center">
						<img src="<?php echo esc_url( $image ); ?>" alt="<?php esc_attr_e( 'Error 404', 'bronx' ); ?>" class="animation fade-in"/>
						<h2 class="animation fade-in"><?php esc_html_e( 'Page Not Found', 'bronx' ); ?></h2>
						<p>
							<?php esc_html_e( 'We are sorry, but the page you are looking for cannot be found.', 'bronx' ); ?>
							 <br>
							 <?php esc_html_e( 'You might try searching our site.', 'bronx' ); ?>
						</p>
						<?php get_search_form(); ?>
					</div>
			  </div>
			  </div>
			</section>
		<?php
	}
get_footer();
