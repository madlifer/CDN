<?php
function thb_filter_radio_images( $array, $field_id ) {

  if ( $field_id == 'header_style' ) {
	  $array = array(
	    array(
	      'value'   => 'style1',
	      'label'   => esc_html__( 'Style 1', 'bronx' ),
	      'src'     => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/header/style1.png'
	    ),
	    array(
	      'value'   => 'style2',
	      'label'   => esc_html__( 'Style 2', 'bronx' ),
	      'src'     => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/header/style2.png'
	    )
	  );
	}
  if ( $field_id == 'shop_product_style' ) {
	  $array = array(
	    array(
	      'value'   => 'style1',
	      'label'   => esc_html__( 'Style 1', 'bronx' ),
	      'src'     => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/product_styles/style1.png'
	    ),
	    array(
	      'value'   => 'style2',
	      'label'   => esc_html__( 'Style 2', 'bronx' ),
	      'src'     => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/product_styles/style2.png'
	    )
	  );
	}
  if ( $field_id == 'footer_columns' ) {
    $array = array(
      array(
        'value'   => 'fourcolumns',
        'label'   => esc_html__( 'Four Columns', 'bronx' ),
        'src'     => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/columns/four-columns.png'
      ),
      array(
        'value'   => 'threecolumns',
        'label'   => esc_html__( 'Three Columns', 'bronx' ),
        'src'     => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/columns/three-columns.png'
      ),
      array(
        'value'   => 'twocolumns',
        'label'   => esc_html__( 'Two Columns', 'bronx' ),
        'src'     => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/columns/two-columns.png'
      ),
      array(
        'value'   => 'doubleleft',
        'label'   => esc_html__( 'Double Left Columns', 'bronx' ),
        'src'     => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/columns/doubleleft-columns.png'
      ),
      array(
        'value'   => 'doubleright',
        'label'   => esc_html__( 'Double Right Columns', 'bronx' ),
        'src'     => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/columns/doubleright-columns.png'
      ),
      array(
        'value'   => 'fivecolumns',
        'label'   => esc_html__( 'Five Columns', 'bronx' ),
        'src'     => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/columns/five-columns.png'
      ),
      array(
        'value'   => 'onecolumns',
        'label'   => esc_html__( 'Single Column', 'bronx' ),
        'src'     => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/columns/one-columns.png'
      )

    );
  }
  if ( in_array($field_id, array('header_color', 'header_color_shop', 'header_color_product_category', 'header_color_cart', 'header_color_myaccount', 'header_color_checkout')) ) {
	  $array = array(
	    array(
	      'value'   => 'header--light',
	      'label'   => esc_html__( 'Light', 'bronx' ),
	      'src'     => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/light_dark/light.png'
	    ),
	    array(
	      'value'   => 'header--dark',
	      'label'   => esc_html__( 'Dark', 'bronx' ),
	      'src'     => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/light_dark/dark.png'
	    )
	  );
	}
  if ( in_array($field_id, array('footer_color')) ) {
	  $array = array(
	    array(
	      'value'   => 'light',
	      'label'   => esc_html__( 'Light', 'bronx' ),
	      'src'     => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/light_dark/light.png'
	    ),
	    array(
	      'value'   => 'dark',
	      'label'   => esc_html__( 'Dark', 'bronx' ),
	      'src'     => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/light_dark/dark.png'
	    )
	  );
	}
  return $array;

}
add_filter( 'ot_radio_images', 'thb_filter_radio_images', 10, 2 );

function thb_filter_options_name() {
	return __('<a href="http://fuelthemes.net">Fuel Themes</a>', 'bronx' );
}
add_filter( 'ot_header_version_text', 'thb_filter_options_name', 10, 2 );


function thb_filter_upload_name() {
	return __('Send to Theme Options', 'bronx' );
}
add_filter( 'ot_upload_text', 'thb_filter_upload_name', 10, 2 );

function thb_header_list() {
	echo '<li class="theme_link"><a href="http://fuelthemes.ticksy.com/" target="_blank">Support Forum</a></li>';
	if (!Thb_Theme_Admin::$thb_envato_hosted) {
	echo '<li class="theme_link right"><a href="http://wpeng.in/fuelt/" target="_blank">Recommended Hosting</a></li>';
	}
	echo '<li class="theme_link right"><a href="https://wpml.org/?aid=85928&affiliate_key=PIP3XupfKQOZ" target="_blank">Purchase WPML</a></li>';
}
add_filter( 'ot_header_list', 'thb_header_list' );

function thb_filter_ot_recognized_font_families( $array, $field_id ) {
	$array['helveticaneue'] = "'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif";
	ot_fetch_google_fonts( true, false );
	$ot_google_fonts = wp_list_pluck( get_theme_mod( 'ot_google_fonts', array() ), 'family' );
  $array = array_merge($array,$ot_google_fonts);

  if (ot_get_option( 'typekit_id')) {
  	$typekit_fonts = trim(ot_get_option( 'typekit_fonts'), ' ');
  	$typekit_fonts = explode(',', $typekit_fonts);

  	$array = array_merge($array,$typekit_fonts);
  }
  $self_hosted_names = array();
  if (ot_get_option( 'self_hosted_fonts')) {
  	$self_hosted_fonts = ot_get_option( 'self_hosted_fonts');

  	foreach ($self_hosted_fonts as $font) {
  		$self_hosted_names[] = $font['font_name'];
  	}

  	$array = array_merge($array,$self_hosted_names);
  }

  foreach ($array as $font => $value) {
		$thb_font_array[$value] = $value;
  }
  return $thb_font_array;
}
add_filter( 'ot_recognized_font_families', 'thb_filter_ot_recognized_font_families', 10, 2 );


function thb_filter_typography_fields( $array, $field_id ) {

  if ( in_array($field_id, array("primary_font", "secondary_font") ) ) {
    $array = array( 'font-family' );
  } else if ( in_array($field_id, array('body_type', 'menu_left_type', 'menu_left_submenu_type', 'menu_mobile_type', 'menu_mobile_submenu_type', 'shop_product_title', 'shop_product_detail_title', 'shop_product_detail_excerpt') ) ) {
    $array = array( 'font-size', 'font-style', 'font-weight', 'text-transform', 'line-height', 'letter-spacing' );
  } else if ( in_array($field_id, array('h1_type','h2_type','h3_type','h4_type','h5_type','h6_type') ) ) {
    $array = array( 'font-size', 'font-style', 'font-weight', 'text-transform', 'line-height', 'letter-spacing' );
  }

  return $array;

}

add_filter( 'ot_recognized_typography_fields', 'thb_filter_typography_fields', 10, 2 );

function thb_filter_ot_recognized_link_color_fields( $array, $field_id ) {
	$array = array(
		'link'    => esc_html_x( 'Standard', 'color picker', 'bronx' ),
	  'hover'   => esc_html_x( 'Hover', 'color picker', 'bronx' )
	);
	return $array;
}
add_filter( 'ot_recognized_link_color_fields', 'thb_filter_ot_recognized_link_color_fields', 10, 2 );

function thb_filter_spacing_fields( $array, $field_id ) {

	if ( in_array($field_id, array("header_padding", "header_padding_mobile", "footer_padding", "subfooter_padding") ) ) {
		$array = array( 'top', 'bottom' );
	}
  return $array;

}

add_filter( 'ot_recognized_spacing_fields', 'thb_filter_spacing_fields', 10, 2 );