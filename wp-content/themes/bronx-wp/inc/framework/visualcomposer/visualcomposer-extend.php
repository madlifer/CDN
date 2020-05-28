<?php
$thb_animation_array = array(
	"type" => "dropdown",
	"heading" => esc_html__("Animation", "bronx"),
	"param_name" => "animation",
	"value" => array(
		"None" => "",
		"Left" => "animation right-to-left",
		"Right" => "animation left-to-right",
		"Top" => "animation bottom-to-top",
		"Bottom" => "animation top-to-bottom",
		"Scale" => "animation scale",
		"Fade" => "animation fade-in"
	)
);
$thb_column_array = array(
	'2 Columns' => "medium-6",
	'3 Columns' => "medium-4",
	'4 Columns' => "medium-3",
	'5 Columns' => "thb-5",
	'6 Columns' => "medium-2"
);

/* Visual Composer Mappings */

// Adding animation to columns
vc_add_param("vc_column", $thb_animation_array);
vc_add_param("vc_column_inner", $thb_animation_array);

// Visual Composer Row Changes
vc_remove_param( "vc_row", "full_width" );
vc_remove_param( "vc_row", "gap" );
vc_remove_param( "vc_row", "equal_height" );
vc_remove_param( "vc_row", "css_animation" );
vc_remove_param( "vc_row", "video_bg" );
vc_remove_param( "vc_row", "video_bg_url" );
vc_remove_param( "vc_row", "video_bg_parallax" );
vc_remove_param( "vc_row", "parallax_speed_video" );

vc_add_param("vc_row", array(
	"type" => "checkbox",
	"heading" => esc_html__("Enable Full Width", "bronx"),
	"param_name" => "thb_full_width",
	"value" => array(
		"Yes" => "true"
	),
	'weight' => 1,
	"description" => esc_html__("If you enable this, this row will fill the screen", "bronx")
));
vc_add_param("vc_row", array(
	"type" => "checkbox",
	"heading" => esc_html__("Disable Column Padding", "bronx"),
	"param_name" => "column_padding",
	"value" => array(
		"Yes" => "false"
	),
	'weight' => 1,
	"description" => esc_html__("You can have columns without spaces using this option", "bronx")
));
vc_add_param("vc_row", array(
	"type" => "checkbox",
	"heading" => esc_html__("Remove Row Padding", "bronx"),
	"param_name" => "row_padding",
	"value" => array(
		"Yes" => "true"
	),
	'weight' => 1,
	"description" => esc_html__("If you enable this, this row won't leave padding on the sides", "bronx")
));

vc_add_param("vc_row", array(
	"type" => "checkbox",
	"heading" => esc_html__("Full Height Row", "bronx"),
	"param_name" => "full_height",
	"value" => array(
		"Yes" => "true"
	),
	'weight' => 1,
	"description" => esc_html__("If enabled, this will cause this row to always fill the height of the window.", "bronx")
));

vc_add_param("vc_row", array(
	"type" => "textfield",
	"heading" => esc_html__("Video Background", "bronx"),
	"param_name" => "thb_video_bg",
	'weight' => 1,
	"description" => esc_html__("You can specify a video background file here (mp4). Row Background Image will be used as Poster.", "bronx")
));
vc_add_param("vc_row", array(
	"type" => "colorpicker",
	"heading" => esc_html__("Video Overlay Color", "bronx"),
	"param_name" => "thb_video_overlay_color",
	'weight' => 1,
	"description" => esc_html__("If you want, you can select an overlay color.", "bronx")
));

// Inner Row
vc_remove_param( "vc_row_inner", "gap" );
vc_remove_param( "vc_row_inner", "equal_height" );
vc_remove_param( "vc_row_inner", "css_animation" );

vc_add_param("vc_row_inner", array(
	"type" => "checkbox",
	"heading" => esc_html__("Enable Max Width", "bronx"),
	"param_name" => "max_width",
	"value" => array(
		"Yes" => "true"
	),
	'weight' => 1,
	"description" => esc_html__("If you enable this, this row will not fill the container.", "bronx")
));
vc_add_param("vc_row_inner", array(
	"type" => "checkbox",
	"heading" => esc_html__("Disable Column Padding", "bronx"),
	"param_name" => "column_padding",
	"value" => array(
		"Yes" => "false"
	),
	'weight' => 1,
	"description" => esc_html__("You can have columns without spaces using this option", "bronx")
));
vc_add_param("vc_row_inner", array(
	"type" => "checkbox",
	"heading" => esc_html__("Remove Row Padding", "bronx"),
	"param_name" => "row_padding",
	"value" => array(
		"Yes" => "true"
	),
	'weight' => 1,
	"description" => esc_html__("If you enable this, this row won't leave padding on the sides", "bronx")
));

// Columns
vc_remove_param( "vc_column", "css_animation" );
vc_add_param("vc_column", $thb_animation_array);
vc_remove_param( "vc_column_inner", "css_animation" );
vc_add_param("vc_column_inner", $thb_animation_array);

// Text Area
vc_remove_param("vc_column_text", "css_animation");
vc_add_param("vc_column_text", $thb_animation_array);

// Remove parameters
vc_remove_param( "vc_tta_tabs", "style" );
vc_remove_param( "vc_tta_tabs", "shape" );
vc_remove_param( "vc_tta_tabs", "color" );
vc_remove_param( "vc_tta_tabs", "spacing" );
vc_remove_param( "vc_tta_tabs", "gap" );
vc_remove_param( "vc_tta_tabs", "alignment" );
vc_remove_param( "vc_tta_tabs", "pagination_color" );
vc_remove_param( "vc_tta_tabs", "pagination_style" );

vc_remove_param( "vc_tta_tour", "style" );
vc_remove_param( "vc_tta_tour", "shape" );
vc_remove_param( "vc_tta_tour", "color" );
vc_remove_param( "vc_tta_tour", "spacing" );
vc_remove_param( "vc_tta_tour", "gap" );
vc_remove_param( "vc_tta_tour", "pagination_style" );
vc_remove_param( "vc_tta_tour", "pagination_color" );

vc_remove_param( "vc_tta_accordion", "style" );
vc_remove_param( "vc_tta_accordion", "shape" );
vc_remove_param( "vc_tta_accordion", "color" );
vc_remove_param( "vc_tta_accordion", "spacing" );
vc_remove_param( "vc_tta_accordion", "gap" );
vc_remove_param( "vc_tta_accordion", "c_align" );
vc_remove_param( "vc_tta_accordion", "c_icon" );
vc_remove_param( "vc_tta_accordion", "c_position" );

// Add to Cart Button
vc_map(array(
   "name"			=> __("Add to Cart Button", 'bronx' ),
   "base" => "thb_add_to_cart",
   "icon" => "thb_vc_ico_add_to_cart",
   "class" => "thb_vc_sc_add_to_cart",
   "category" => esc_html__("by Fuel Themes", "bronx"),
   "params" 	=> array(
		array(
			"type"			=> "textfield",
			"admin_label" 	=> true,
			"heading"		=> esc_html__("Product ID", "bronx"),
			"param_name"	=> "id",
			"description" => esc_html__("Only enter 1 Product ID", "bronx")
		),
		array(
			"type" => "checkbox",
			"heading" => esc_html__("Display Product Title?", "bronx"),
			"param_name" => "title",
			"value" => array(
				"Yes" => "true"
			),
			"description" => esc_html__("If you want to show the product titl, enable this", "bronx")
		),
		array(
			"type" => "checkbox",
			"heading" => esc_html__("Display Product Price?", "bronx"),
			"param_name" => "price",
			"value" => array(
				"Yes" => "true"
			),
			"description" => esc_html__("If you want to show the price, enable this", "bronx")
		),
		array(
			"type" => "dropdown",
			"heading" => esc_html__("Button Size", "bronx"),
			"param_name" => "size",
			"value" => array(
				"Small button" => "small",
				"Medium button" => "medium",
				"Large button" => "large"
			)
		),
		array(
			"type" => "dropdown",
			"heading" => esc_html__("Button color", "bronx"),
			"param_name" => "color",
			"value" => array(
				"Accent Color" => "green",
				"Black" => "black",
				"White" => "white",
				"Yellow" => "yellow",
				"White Transparent" => "white-transparent",
				"Black Transparent" => "black-transparent"
			)
		),
		array(
			"type"				=> "dropdown",
			"class" 				=> "",
			"heading"			=> esc_html__("Alignment", "bronx"),
			"param_name"	=> "align",
			"value"				=> array(
				"Left"			=> "text-left",
				"Center"		=> "text-center",
				"Right"			=> "text-right",
			),
		),
   )
));

// Button shortcode
vc_map( array(
	"name" => __("Button", 'bronx' ),
	"base" => "thb_button",
	"icon" => "thb_vc_ico_button",
	"class" => "thb_vc_sc_button",
	"category" => esc_html__("by Fuel Themes", "bronx"),
	"params" => array(
		array(
		  "type" => "vc_link",
		  "heading" => esc_html__("Link", "bronx"),
		  "param_name" => "link",
		  "description" => esc_html__("Enter url for link", "bronx"),
		  "admin_label" => true,
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( "Icon", "bronx" ),
			'param_name' => 'icon',
			'value' => '', // default value to backend editor admin_label
			'settings' => array(
				'emptyIcon' => true, // default true, display an "EMPTY" icon?
				'iconsPerPage' => 4000, // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
			),
			'std' => '',
			'description' => esc_html__( "Select icon from library.", "bronx" ),
		),
		array(
			"type" => "dropdown",
			"heading" => esc_html__("Size", "bronx"),
			"param_name" => "size",
			"value" => array(
				"Small button" => "small",
				"Medium button" => "medium",
				"Large button" => "large"
			)
		),
		array(
			"type" => "dropdown",
			"heading" => esc_html__("Button color", "bronx"),
			"param_name" => "color",
			"value" => array(
				"Accent Color" => "accent",
				"Black" => "black",
				"White" => "white",
				"Yellow" => "yellow",
				"White Transparent" => "white-transparent",
				"Black Transparent" => "black-transparent"
			)
		),
		$thb_animation_array
	),
	"description" => esc_html__("Add an animated button", "bronx")
) );
// Google Map
vc_map( array(
	"name" => __("Contact Map", 'bronx' ),
	"base" => "thb_contactmap",
	"icon" => "thb_vc_ico_contactmap",
	"class" => "thb_vc_sc_contactmap",
	"category" => esc_html__("by Fuel Themes", "bronx"),
	"show_settings_on_create" => true,
	"params" => array(
		array(
			"type" => "checkbox",
			"heading" => esc_html__("Full Height Map", "bronx"),
			"param_name" => "full_height",
			"admin_label" => true,
			"value" => array(
				"Yes" => "true"
			),
			"description" => esc_html__("If enabled, this will cause this map to always fill the height of the window.", "bronx"),
		),
		array(
		  "type" => "textfield",
		  "heading" => esc_html__("Map Height", "bronx"),
		  "param_name" => "height",
		  "admin_label" => true,
		  "description" => esc_html__("Enter height of the map in px. The map will use settings inside Appearance -> Theme Options. If Full Height is selected, this height value is omitted.", "bronx")
		)
	),
	"description" => esc_html__("Insert your Contact Map", "bronx")
) );

// Content Carousel Shortcode
vc_map( array(
	"name" => __("Content Carousel", 'bronx' ),
	"base" => "thb_content_carousel",
	"icon" => "thb_vc_ico_content_carousel",
	"class" => "thb_vc_sc_content_carousel",
	"as_parent" => array('except' => 'thb_content_carousel'),
	"category" => esc_html__("by Fuel Themes", "bronx"),
	"show_settings_on_create" => true,
	"content_element" => true,
	"params" => array(
		array(
	    "type" => "dropdown",
	    "heading" => esc_html__("Columns", "bronx"),
	    "param_name" => "columns",
	    "value" => array(
	    	'Six Columns' => "6",
	    	'Five Columns' => "5",
	    	'Four Columns' => "4",
	    	'Three Columns' => "3",
	    	'Two Columns' => "2",
				'One Column' => "1"
	    ),
	    "description" => esc_html__("Select the layout.", "bronx")
		),
	),
	"js_view" => 'VcColumnView',
	"description" => esc_html__("Display your content in a carousel", "bronx")
) );

class WPBakeryShortCode_Thb_Content_Carousel extends WPBakeryShortCodesContainer { }

// Divider Shortcode
vc_map( array(
	"name" => __("Dividers", 'bronx' ),
	"base" => "thb_dividers",
	"icon" => "thb_vc_ico_dividers",
	"class" => "thb_vc_sc_dividers",
	"category" => esc_html__("by Fuel Themes", "bronx"),
	"show_settings_on_create" => true,
	"params" => array(
		array(
		    "type" => "dropdown",
		    "heading" => esc_html__("Style", "bronx"),
		    "param_name" => "style",
		    "admin_label" => true,
		    "value" => array(
		    	'Style 1' => "style1",
		    	'Style 2' => "style2",
		    	'Style 3' => "style3",
		    	'Style 4' => "style4",
		    	'Style 5' => "style5",
		    	'Style 6' => "style6",
		    	'Style 7' => "style7",
		    	'Style 8' => "style8"
		    ),
		    "description" => esc_html__("This changes the style of the dividers", "bronx")
		),
	),
	"description" => esc_html__("Divide your content with different divider styles.", "bronx")
) );

// Gap shortcode
vc_map( array(
	"name" => __("Gap", 'bronx' ),
	"base" => "thb_gap",
	"icon" => "thb_vc_ico_gap",
	"class" => "thb_vc_sc_gap",
	"category" => esc_html__("by Fuel Themes", "bronx"),
	"params" => array(
		array(
		  "type" => "textfield",
		  "heading" => esc_html__("Gap Height", "bronx"),
		  "param_name" => "height",
		  "admin_label" => true,
		  "description" => esc_html__("Enter height of the gap in px.", "bronx")
		)
	),
	"description" => esc_html__("Add a gap to seperate elements", "bronx")
) );

// Iconbox shortcode
vc_map( array(
	"name" => __("Iconbox", 'bronx' ),
	"base" => "thb_iconbox",
	"icon" => "thb_vc_ico_iconbox",
	"class" => "thb_vc_sc_iconbox",
	"category" => esc_html__("by Fuel Themes", "bronx"),
	"params" => array(
		array(
			"type" => "dropdown",
			"heading" => esc_html__("Type", "bronx"),
			"param_name" => "type",
			"value" => array(
				"Top Icon" => "top type1",
				"Left Icon" => "left type1",
				"Right Icon" => "right type1"
			)
		),
		array(
			'type' => 'iconpicker',
			'heading' => __( 'Icon', 'bronx' ),
			'param_name' => 'icon',
			'value' => 'fa fa-adjust', // default value to backend editor admin_label
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'iconsPerPage' => 4000, // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
			),
			'description' => __( 'Select icon from library.', 'bronx' ),
		),
		array(
		  "type"              => "colorpicker",
		  "holder"            => "div",
		  "heading"           => esc_html__("Icon Background Color", "bronx"),
		  "param_name"        => "icon_bgcolor",
		  "dependency" => Array('element' => "type", 'value' => array('top type2','left type2', 'right type2'))
		),
		array(
		  "type"              => "colorpicker",
		  "holder"            => "div",
		  "heading"           => esc_html__("Icon Color", "bronx"),
		  "param_name"        => "icon_color",
		),
		array(
			"type" => "attach_image", //attach_images
			"heading" => esc_html__("Image", "bronx"),
			"param_name" => "image",
			"description" => esc_html__("Use image instead of icon? Image uploaded should be 60*60 or 120*120 for retina.", "bronx")
		),
		array(
			"type" => "textfield",
			"heading" => esc_html__("Heading", "bronx"),
			"param_name" => "heading",
			"admin_label" => true
		),
		array(
			"type" => "colorpicker",
			"heading" => esc_html__("Heading Color", "bronx"),
			"param_name" => "heading_color",
			"description" => esc_html__("You can change the heading color from here", "bronx")
		),
		array(
			"type" => "textarea",
			"heading" => esc_html__("Content", "bronx"),
			"param_name" => "content",
			"dependency" => Array('element' => "type", 'value' => array('top type1','left type1', 'right type1','top type2','left type2', 'right type2'))
		),
		array(
		  "type"              => "colorpicker",
		  "holder"            => "div",
		  "heading"           => esc_html__("Content Color", "bronx"),
		  "param_name"        => "content_color",
		  "dependency" => Array('element' => "type", 'value' => array('top type1','left type1', 'right type1','top type2','left type2', 'right type2'))
		),
		$thb_animation_array
	),
	"description" => esc_html__("Iconboxes with different animations", "bronx")
) );

// Icon List shortcode
vc_map( array(
	"name" => __("Icon List", 'bronx' ),
	"base" => "thb_iconlist",
	"icon" => "thb_vc_ico_iconlist",
	"class" => "thb_vc_sc_iconlist",
	"category" => esc_html__("by Fuel Themes", "bronx"),
	"params" => array(
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'bronx' ),
			'param_name' => 'icon',
			'value' => 'fa fa-adjust', // default value to backend editor admin_label
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'iconsPerPage' => 4000, // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
			),
			'description' => esc_html__( 'Select icon from library.', 'bronx' ),
		),
		array(
			"type" => "colorpicker",
			"heading" => esc_html__("Icon color", "bronx"),
			"param_name" => "color",
		),
		$thb_animation_array,
		array(
			"type" => "exploded_textarea",
			"heading" => esc_html__("List Items", "bronx"),
			"admin_label" => true,
			"param_name" => "content",
			"description" => esc_html__("Every new line will be treated as a list item", "bronx")
		)
	),
	"description" => esc_html__("Add lists with icons", "bronx")
) );

// Image shortcode
vc_map( array(
	"name" => "Image",
	"base" => "thb_image",
	"icon" => "thb_vc_ico_image",
	"class" => "thb_vc_sc_image",
	"category" => esc_html__("by Fuel Themes", "bronx"),
	"params" => array(
		array(
			"type" => "attach_image", //attach_images
			"heading" => esc_html__("Select Image", "bronx"),
			"param_name" => "image"
		),
		array(
			"type" => "checkbox",
			"heading" => esc_html__("Full Width?", "bronx"),
			"param_name" => "full_width",
			"value" => array(
				"Yes" => "true"
			),
			"description" => esc_html__("If selected, the image will always fill its container", "bronx")
		),
		$thb_animation_array,
		array(
		  "type" => "textfield",
		  "heading" => esc_html__("Image size", "bronx"),
		  "param_name" => "img_size",
		  "description" => esc_html__("Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use 'thumbnail' size.", "bronx")
		),
		array(
		  "type" => "dropdown",
		  "heading" => esc_html__("Image alignment", "bronx"),
		  "param_name" => "alignment",
		  "value" => array("Align left" => "left", "Align right" => "right", "Align center" => "center"),
		  "description" => esc_html__("Select image alignment.", "bronx")
		),
		array(
			"type" => "checkbox",
			"heading" => esc_html__("Link to Full-Width Image?", "bronx"),
			"param_name" => "lightbox",
			"value" => array(
				"Yes" => "true"
			)
		),
		array(
		  "type" => "vc_link",
		  "heading" => esc_html__("Image link", "bronx"),
		  "param_name" => "img_link",
		  "description" => esc_html__("Enter url if you want this image to have link.", "bronx"),
		  "dependency" => Array('element' => "lightbox", 'is_empty' => true)
		)
	),
	"description" => esc_html__("Add an animated image", "bronx")
) );

// Instagram
vc_map( array(
	"name" => esc_html__("Instagram", "bronx"),
	"base" => "thb_instagram",
	"icon" => "thb_vc_ico_instagram",
	"class" => "thb_vc_sc_instagram",
	"category" => esc_html__("by Fuel Themes", "bronx"),
	"params"	=> array(
		array(
      "type" => "textfield",
      "heading" => esc_html__("Instagram Username", "bronx"),
      "param_name" => "username",
      "admin_label" => true,
      "description" => esc_html__("Instagram username to retrieve photos from.", "bronx")
	  ),
		array(
      "type" => "textfield",
      "heading" => esc_html__( "Instagram Access Token", 'bronx' ),
      "param_name" => "access_token",
      "description" => esc_html__( "Instagram Access Token.", 'bronx' ),
	  ),
	  array(
      "type" => "textfield",
      "heading" => esc_html__("Number of Photos", "bronx"),
      "param_name" => "number",
      "admin_label" => true,
      "description" => esc_html__("Number of Instagram Photos to retrieve", "bronx")
	  ),
		array(
			"type" => "dropdown",
			"heading" => esc_html__("Columns", "bronx"),
			"param_name" => "columns",
			"std" => "5",
			"value" => array(
				'Six Columns' => "6",
				'Five Columns' => "5",
				'Four Columns' => "4",
				'Three Columns' => "3",
				'Two Columns' => "2",
				'One Column' => "1"
			),
		),
		array(
			"type" => "dropdown",
			"heading" => esc_html__("Column Padding", "bronx"),
			"param_name" => "column_padding",
			"value" => array(
				'Normal' => "",
				'Low' => "low-padding",
				'No-Padding' => "no-padding"
			),
			"description" => esc_html__("You can have columns without spaces using this option"	, "bronx")
		),
		array(
	    "type" => "checkbox",
	    "heading" => esc_html__("Link Photos to Instagram?", "bronx"),
	    "param_name" => "link",
	    "value" => array(
				esc_html__("Yes", "bronx") =>"true"
			),
			"group"			 => 'Other',
	    "description" => esc_html__("Do you want to link the Instagram photos to instagram.com website?", "bronx")
		),
		array(
	    "type" => "checkbox",
	    "heading" => esc_html__("Display Username?", "bronx"),
	    "param_name" => "display_username",
	    "value" => array(
				esc_html__("Yes", "bronx") =>"true"
			),
			"group"			 => 'Other',
	    "description" => esc_html__("If you want to show the username above photos.", "bronx")
		),
		array(
			"type" => "dropdown",
			"heading" => esc_html__("Username Position", "bronx"),
			"param_name" => "display_username_alignment",
			"value" => array(
				'Left' => "text-left",
				'Center' => "text-center",
			),
			"std" =>  "text-left",
			"group"			 => 'Other',
			"description" => esc_html__("Alignment of the username."	, "bronx"),
			"dependency" => Array('element' => "display_username", 'value' => array('true'))
		),
	),
	"description" => esc_html__("Add Instagram Photos", "bronx")
) );

// Notification shortcode
vc_map( array(
	"name" => __("Notification", 'bronx' ),
	"base" => "thb_notification",
	"icon" => "thb_vc_ico_notification",
	"class" => "thb_vc_sc_notification",
	"category" => esc_html__("by Fuel Themes", "bronx"),
	"params" => array(
		array(
			"type" => "dropdown",
			"heading" => esc_html__("Type", "bronx"),
			"param_name" => "type",
			"value" => array(
				"Information" => "information",
				"Success" => "success",
				"Warning" => "warning",
				"Error" => "error"
			)
		),
		array(
			"type" => "textarea",
			"heading" => esc_html__("Content", "bronx"),
			"admin_label" => true,
			"param_name" => "content",
		)
	),
	"description" => esc_html__("Display Notifications", "bronx")
) );
// Posts
vc_map( array(
	"name" => __("Posts Grid", 'bronx' ),
	"base" => "thb_postgrid",
	"icon" => "thb_vc_ico_postgrid",
	"class" => "thb_vc_sc_postgrid",
	"category" => esc_html__("by Fuel Themes", "bronx"),
	"params"	=> array(
	  array(
	      "type" => "dropdown",
	      "heading" => esc_html__("Columns", "bronx"),
	      "param_name" => "columns",
	      "admin_label" => true,
	      "value" => array(
	      	'Four Columns' => "4",
	      	'Three Columns' => "3",
	      	'Two Columns' => "2"
	      ),
	      "description" => esc_html__("Select the layout of the posts.", "bronx")
	  ),
	  array(
	  	"type" => "dropdown",
	  	"heading" => esc_html__("Post Source", "bronx"),
	  	"param_name" => "source",
	  	"value" => array(
	  		'Most Recent' => "most-recent",
	  		'By Category' => "by-category",
	  		'By Post ID' => "by-id",
	  		'By Tag' => "by-tag",
	  		'By Author' => "by-author",
	  	),
	  	"std" => "most-recent",
	  	"admin_label" => true,
	  	"description" => esc_html__("Select the source of the posts you'd like to show.", "bronx")
	  ),
	  array(
	    "type" => "checkbox",
	    "heading" => esc_html__("Post Categories", "bronx"),
	    "param_name" => "cat",
	    "value" => thb_blogCategories(),
	    "description" => esc_html__("Which categories would you like to show?", "bronx"),
	    "dependency" => Array('element' => "source", 'value' => array('by-category'))
	  ),
	  array(
	    "type" => "textfield",
	    "heading" => esc_html__("Number of posts", "bronx"),
	    "param_name" => "item_count",
	    "value" => "4",
	    "description" => esc_html__("The number of posts to show.", "bronx"),
	    "dependency" => Array('element' => "source", 'value' => array('by-category', 'by-tag', 'by-share', 'by-author', 'most-recent'))
	  ),
	  array(
	    "type" => "textfield",
	    "heading" => esc_html__("Excluded Tag IDs", "bronx"),
	    "param_name" => "excluded_tag_ids",
	    "description" => esc_html__("Enter the tag ids you would like to exclude from the most recent posts separated by comma", "bronx"),
	    "dependency" => Array('element' => "source", 'value' => array('most-recent'))
	  ),
	  array(
	    "type" => "textfield",
	    "heading" => esc_html__("Excluded Category IDs", "bronx"),
	    "param_name" => "excluded_cat_ids",
	    "description" => esc_html__("Enter the category ids you would like to exclude from the most recent posts separated by comma", "bronx"),
	    "dependency" => Array('element' => "source", 'value' => array('most-recent'))
	  ),
	  array(
	    "type" => "textfield",
	    "heading" => esc_html__("Post IDs", "bronx"),
	    "param_name" => "post_ids",
	    "description" => esc_html__("Enter the post IDs you would like to display seperated by comma", "bronx"),
	    "dependency" => Array('element' => "source", 'value' => array('by-id'))
	  ),
	  array(
	    "type" => "textfield",
	    "heading" => esc_html__("Tag slugs", "bronx"),
	    "param_name" => "tag_slugs",
	    "description" => esc_html__("Enter the tag slugs you would like to display seperated by comma", "bronx"),
	    "dependency" => Array('element' => "source", 'value' => array('by-tag'))
	  ),
	  array(
	    "type" => "textfield",
	    "heading" => esc_html__("Author IDs", "bronx"),
	    "param_name" => "author_ids",
	    "description" => esc_html__("Enter the Author IDs you would like to display seperated by comma", "bronx"),
	    "dependency" => Array('element' => "source", 'value' => array('by-author'))
	  )
	),
	"description" => esc_html__("Display your posts in different grid layouts.", "bronx")
) );

// Single Product
vc_map( array(
	"name" => __("Single Product Page", 'bronx' ),
	"base" => "thb_product_singlepage",
	"icon" => "thb_vc_ico_product_singlepage",
	"class" => "thb_vc_sc_product_singlepage",
	"category" => esc_html__("by Fuel Themes", "bronx"),
	"params"	=> array(
	  array(
	      "type" => "textfield",
	      "heading" => esc_html__("Product ID", "bronx"),
	      "param_name" => "product_id",
	      "admin_label" => true,
	      "description" => esc_html__("Enter the product ID you would like to display", "bronx")
	  )
	),
	"description" => esc_html__("Add single product Page", "bronx")
) );

// Single Product
vc_map( array(
	"name" => __("Single Product", 'bronx' ),
	"base" => "thb_product_single",
	"icon" => "thb_vc_ico_product_single",
	"class" => "thb_vc_sc_product_single",
	"category" => esc_html__("by Fuel Themes", "bronx"),
	"params"	=> array(
	  array(
	      "type" => "textfield",
	      "heading" => esc_html__("Product ID", "bronx"),
	      "param_name" => "product_id",
	      "admin_label" => true,
	      "description" => esc_html__("Enter the products ID you would like to display", "bronx")
	  )
	),
	"description" => esc_html__("Add WooCommerce product", "bronx")
) );

// Products
vc_map( array(
	"name" => __("Products", 'bronx' ),
	"base" => "thb_product",
	"icon" => "thb_vc_ico_product",
	"class" => "thb_vc_sc_product",
	"category" => esc_html__("by Fuel Themes", "bronx"),
	"params"	=> array(
	  array(
	      "type" => "dropdown",
	      "heading" => esc_html__("Product Sort", "bronx"),
	      "param_name" => "product_sort",
	      "value" => array(
	      	'Best Sellers' => "best-sellers",
	      	'Latest Products' => "latest-products",
	      	'Top Rated' => "top-rated",
			'Featured Products' => "featured-products",
	      	'Sale Products' => "sale-products",
	      	'By Category' => "by-category",
	      	'By Product ID' => "by-id",
	      	),
	      "description" => esc_html__("Select the order of the products you'd like to show.", "bronx")
	  ),
	  array(
	      "type" => "checkbox",
	      "heading" => esc_html__("Product Category", "bronx"),
	      "param_name" => "cat",
	      "value" => thb_productCategories(),
	      "description" => esc_html__("Select the order of the products you'd like to show.", "bronx"),
	      "dependency" => Array('element' => "product_sort", 'value' => array('by-category'))
	  ),
	  array(
	      "type" => "textfield",
	      "heading" => esc_html__("Product IDs", "bronx"),
	      "param_name" => "product_ids",
	      "description" => esc_html__("Enter the products IDs you would like to display seperated by comma", "bronx"),
	      "dependency" => Array('element' => "product_sort", 'value' => array('by-id'))
	  ),
	  array(
	      "type" => "textfield",
	      "heading" => esc_html__("Number of Items", "bronx"),
	      "param_name" => "item_count",
	      "value" => "4",
	      "description" => esc_html__("The number of products to show.", "bronx"),
	      "dependency" => Array('element' => "product_sort", 'value' => array('by-category', 'sale-products', 'top-rated', 'latest-products', 'best-sellers', 'featured-products'))
	  ),
	  array(
	      "type" => "dropdown",
	      "heading" => esc_html__("Columns", "bronx"),
	      "param_name" => "columns",
	      "admin_label" => true,
	      "value" => array(
	      	'Three Columns' => "3",
	      	'Four Columns' => "4",
	      	'Five Columns' => "5",
	      	'Six Columns' => "6"
	      ),
	      "description" => esc_html__("Select the layout of the products.", "bronx")
	  ),
	),
	"description" => esc_html__("Add WooCommerce products", "bronx")
) );

// Product List
vc_map( array(
	"name" => __("Product List", 'bronx' ),
	"base" => "thb_product_list",
	"icon" => "thb_vc_ico_product_list",
	"class" => "thb_vc_sc_product_list",
	"category" => esc_html__("by Fuel Themes", "bronx"),
	"params"	=> array(
		array(
		    "type" => "textfield",
		    "class" => "",
		    "heading" => esc_html__("Title", "bronx"),
		    "param_name" => "title",
		    "value" => "",
		    "admin_label" => true,
		    "description" => esc_html__("Title of the widget", "bronx")
		),
	  array(
	      "type" => "dropdown",
	      "heading" => esc_html__("Product Sort", "bronx"),
	      "param_name" => "product_sort",
	      "value" => array(
	      	'Best Sellers' => "best-sellers",
	      	'Latest Products' => "latest-products",
	      	'Top Rated' => "top-rated",
	      	'Sale Products' => "sale-products",
	      	'By Product ID' => "by-id"
	      	),
	      "admin_label" => true,
	      "description" => esc_html__("Select the order of the products you'd like to show.", "bronx")
	  ),
	  array(
	      "type" => "textfield",
	      "heading" => esc_html__("Product IDs", "bronx"),
	      "param_name" => "product_ids",
	      "description" => esc_html__("Enter the products IDs you would like to display seperated by comma", "bronx"),
	      "dependency" => Array('element' => "product_sort", 'value' => array('by-id'))
	  ),
	  array(
	      "type" => "textfield",
	      "heading" => esc_html__("Number of Items", "bronx"),
	      "param_name" => "item_count",
	      "value" => "4",
	      "description" => esc_html__("The number of products to show.", "bronx"),
	      "dependency" => Array('element' => "product_sort", 'value' => array('by-category', 'sale-products', 'top-rated', 'latest-products', 'best-sellers'))
	  )
	),
	"description" => esc_html__("Add WooCommerce products in a list", "bronx")
) );

// Product Categories Grid
vc_map( array(
	"name" => __("Product Categories Grid", 'bronx' ),
	"base" => "thb_grid",
	"icon" => "thb_vc_ico_grid",
	"class" => "thb_vc_sc_grid",
	"category" => esc_html__("by Fuel Themes", "bronx"),
	"params"	=> array(
		array(
		  "type" => "checkbox",
		  "heading" => esc_html__("Product Category", "bronx"),
		  "param_name" => "cat",
		  "value" => thb_productCategories(),
		  "description" => esc_html__("Select the categories you would like to display", "bronx")
		),
		array(
		  "type" => "dropdown",
		  "heading" => esc_html__("Style", "bronx"),
		  "param_name" => "style",
		  "admin_label" => true,
		  "value" => array(
			'Style 1' => "style1",
			'Style 2' => "style2"
		  ),
		  "description" => esc_html__("This applies different grid structures", "bronx")
		)
	),
	"description" => esc_html__("Add WooCommerce Product Category Grids", "bronx")
) );