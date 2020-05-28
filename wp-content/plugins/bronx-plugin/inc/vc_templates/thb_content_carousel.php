<?php function thb_content_carousel( $atts, $content = null ) {
  $atts = vc_map_get_attributes( 'thb_content_carousel', $atts );
  extract( $atts );
	$output = $out ='';
	$output .= '<div class="slick carousel content-carousel" data-columns="'.$columns.'" data-navigation="false" data-pagination="true">';
	$output .= do_shortcode($content);
	$output .= '</div>';
	
	return $output;
}
thb_add_short('thb_content_carousel', 'thb_content_carousel');
