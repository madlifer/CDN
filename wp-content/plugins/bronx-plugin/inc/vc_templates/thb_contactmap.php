<?php function thb_contactmap( $atts, $content = null ) {
    $atts = vc_map_get_attributes( 'thb_contactmap', $atts );
    extract( $atts );
    $thb_api_key = ot_get_option( 'map_api_key');
    $locations = ot_get_option( 'map_locations');
    ob_start(); ?>

		<div class="contact_map<?php if ($full_height) {?> full-height-content<?php }?> <?php if ( $thb_api_key === '' ) { ?>disabled<?php } ?>" <?php if (!$full_height) {?>style="height:<?php echo esc_attr($height); ?>px"<?php }?> data-map-style="<?php echo ot_get_option( 'contact_map_style', 8); ?>" data-map-zoom="<?php echo ot_get_option( 'contact_zoom', 12); ?>" data-map-zoom="<?php echo ot_get_option( 'contact_zoom', 17); ?>" data-map-center-lat="<?php echo ot_get_option( 'map_center_lat', '59.93815'); ?>" data-map-center-long="<?php echo ot_get_option( 'map_center_long', '10.76537'); ?>" data-latlong='<?php echo esc_attr(json_encode($locations)); ?>' data-pin-image="<?php echo ot_get_option( 'map_pin_image', Thb_Theme_Admin::$thb_theme_directory_uri.'assets/img/pin.png'); ?>">
			<?php if ( $thb_api_key !== '' ) { ?>
				<?php echo wpb_js_remove_wpautop($content, false); ?>
			<?php } else { ?>
				<?php esc_html_e('Please fill out Google Maps Api key inside Theme Options', 'bronx' ); ?>
			<?php } ?>
		</div>
  	
  	<?php 
  	$out = ob_get_clean();
  return $out;
}
thb_add_short('thb_contactmap', 'thb_contactmap');
