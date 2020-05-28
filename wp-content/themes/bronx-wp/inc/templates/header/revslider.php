<?php
	$thb_id = get_the_ID();
	$rev_slider_alias = get_post_meta( $thb_id, 'rev_slider_alias', true);
	if (is_page() && $rev_slider_alias) {
		$rev_slider_white = get_post_meta( $thb_id, 'rev_slider_white', true);
		?>
	<div id="home-slider" class="<?php echo esc_attr($rev_slider_white); ?>">
		<?php if (function_exists('putRevSlider')) { putRevSlider($rev_slider_alias); } else { esc_html_e('Please Install & Activate Revolution Slider', 'bronx' ); }?>
	</div>
<?php
	}