<?php function thb_notification( $atts, $content = null ) {
  $atts = vc_map_get_attributes( 'thb_notification', $atts );
	extract( $atts );
	// Content
	$out = '<aside class="notification-box '.$type.' animation fade-in"><div class="content">'.$content.'</div></aside>';
  return $out;
}
thb_add_short('thb_notification', 'thb_notification');
