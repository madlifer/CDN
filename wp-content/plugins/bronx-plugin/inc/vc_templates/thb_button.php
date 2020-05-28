<?php function thb_button( $atts, $content = null ) {
  $atts = vc_map_get_attributes( 'thb_button', $atts );
  extract( $atts );

	$link = ( $link == '||' ) ? '' : $link;
	$link = vc_build_link( $link  );

	$link_to = $link['url'];
	$a_title = $link['title'];
	$a_target = $link['target'] ? $link['target'] : '_self';

	$class[] = 'btn';
	$class[] = $size;
	$class[] = $color;
	$class[] = $animation;

  $out = '';

  ob_start();
  ?>
  <a class="<?php echo esc_attr(implode(' ', $class)); ?>" href="<?php echo esc_attr($link_to); ?>" target="<?php echo esc_attr( $a_target ); ?>" role="button" title="<?php echo esc_attr( $a_title ); ?>"><?php if ($icon) { ?><span class="icon"><i class="<?php echo esc_attr($icon); ?>"></i></span> <?php } ?> <?php echo esc_attr($a_title); ?></a>

  <?php
  $out = ob_get_clean();

  return $out;
}
thb_add_short('thb_button', 'thb_button');
