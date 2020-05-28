<?php
/**
 * Initialize the meta boxes.
 */
add_action( 'admin_init', 'thb_custom_meta_boxes' );

/**
 * Meta Boxes demo code.
 *
 * You can find all the available option types
 * in demo-theme-options.php.
 *
 * @return    void
 *
 * @access    private
 * @since     2.0
 */


function thb_custom_meta_boxes() {

  /**
   * Create a custom meta boxes array that we pass to
   * the OptionTree Meta Box API Class.
   */


	$product_metabox = array(
	  'id'          => 'product_settings',
	  'title'       => esc_html__( 'Product Page Settings', 'bronx' ),
	  'pages'       => array( 'product' ),
	  'context'     => 'normal',
	  'priority'    => 'high',
	  'fields'      => array(
	  	array(
	  	  'id'          => 'tab0',
	  	  'label'       => esc_html__( 'Sizing Guide', 'bronx' ),
	  	  'type'        => 'tab'
	  	),
		  array(
		    'label'       => esc_html__( 'Enable Sizing Guide', 'bronx' ),
		    'id'          => 'sizing_guide',
		    'type'        => 'on_off',
		    'desc'        => esc_html__( 'Enabling the sizing guide will add a link to the product page that will open the below content in a lightbox.', 'bronx' ),
		    'std'         => 'off'
		  ),
		  array(
		  	'label'       => esc_html__( 'Sizing Guide Text', 'bronx' ),
		  	'id'          => 'sizing_guide_text',
		  	'type'        => 'text',
		  	'desc'        => esc_html__( 'You can override the sizing guide text here', 'bronx' ),
		  	'rows'        => '1',
		  	'condition'   => 'sizing_guide:is(on)'
		  ),
		  array(
				'label'       => esc_html__( 'Sizing Guide Content', 'bronx' ),
				'id'          => 'sizing_guide_content',
				'type'        => 'textarea',
				'desc'        => esc_html__( 'You can insert your sizin guide content here. Preferablly an image.', 'bronx' ),
				'rows'        => '5',
    	  	'condition'   => 'sizing_guide:is(on)'
		  )
		)
	);
  $page_metabox = array(
    'id'          => 'post_metaboxes_combined',
    'title'       => esc_html__( 'Page Settings', 'bronx' ),
    'pages'       => array( 'page' ),
    'context'     => 'normal',
    'priority'    => 'high',
    'fields'      => array(
    	array(
    	  'id'          => 'tab0',
    	  'label'       => esc_html__( 'Header Settings', 'bronx' ),
    	  'type'        => 'tab'
    	),
    	array(
    	  'label'       => esc_html__( 'Display Page Title?', 'bronx' ),
    	  'id'          => 'page_title',
    	  'type'        => 'on_off',
    	  'desc'        => esc_html__( 'The page title will display in different sections depending on your header style.', 'bronx' ),
    	  'std'         => 'off'
    	),
    	array(
    	  'label'       => esc_html__( 'Override Global Header?', 'bronx' ),
    	  'id'          => 'header_override',
    	  'type'        => 'on_off',
    	  'desc'        => esc_html__( 'You can override global header styles here', 'bronx' ),
    	  'std'         => 'off'
    	),
    	array(
    	  'label'       => esc_html__( 'Display Sub-Header', 'bronx' ),
    	  'id'          => 'subheader',
    	  'type'        => 'on_off',
    	  'desc'        => esc_html__( 'Would you like to display the Sub-Header?', 'bronx' ),
    	  'std'         => 'on',
    	  'condition'   => 'header_override:is(on)'
    	),
    	array(
    	  'label'       => esc_html__( 'Display Header', 'bronx' ),
    	  'id'          => 'header',
    	  'type'        => 'on_off',
    	  'desc'        => esc_html__( 'Would you like to display the Header?', 'bronx' ),
    	  'std'         => 'on',
    	  'condition'   => 'header_override:is(on)'
    	),
    	array(
    	  'label'       => esc_html__( 'Header Style', 'bronx' ),
    	  'id'          => 'header_style',
    	  'type'        => 'radio-image',
    	  'desc'        => esc_html__( 'You can choose different header styles here', 'bronx' ),
    	  'std'         => 'style1'
    	),
			array(
			  'label'       => esc_html__( 'Header Items Color', 'bronx' ),
			  'id'          => 'header_color',
			  'type'        => 'radio-image',
			  'desc'        => esc_html__( 'Which Header item color would you like to use?', 'bronx' ),
			  'std'         => 'header--light',
			  'condition'   => 'header:is(on),header_override:is(on)'
			),
			array(
			  'label'       => esc_html__( 'Header Transparency', 'bronx' ),
			  'id'          => 'header_transparent',
			  'type'        => 'on_off',
			  'desc'        => esc_html__( 'Would you like to enable Header Transparency? This will place the header above the content.', 'bronx' ),
			  'std'         => 'off',
			  'condition'   => 'header:is(on),header_override:is(on)'
			),
			array(
			  'label'       => esc_html__( 'Use header background?', 'bronx' ),
			  'id'          => 'header_container',
			  'type'        => 'on_off',
			  'desc'        => esc_html__( 'Would you like to display the header background image?', 'bronx' ),
			  'std'         => 'on',
			  'condition'   => 'header:is(on),header_override:is(on)'
			),
			array(
			  'label'       => esc_html__( 'Header Background', 'bronx' ),
			  'id'          => 'header_bg',
			  'type'        => 'background',
			  'desc'        => esc_html__( 'Background settings for the header', 'bronx' ),
			  'condition'   => 'header:is(on),header_override:is(on),header_container:is(on)'
			),
    	array(
    	  'id'          => 'tab1',
    	  'label'       => esc_html__( 'Footer Override', 'bronx' ),
    	  'type'        => 'tab'
    	),
    	array(
    	  'label'       => esc_html__( 'Override Global Footer?', 'bronx' ),
    	  'id'          => 'footer_override',
    	  'type'        => 'on_off',
    	  'desc'        => esc_html__( 'You can override global footer settings here', 'bronx' ),
    	  'std'         => 'off'
    	),
    	array(
    	  'label'       => esc_html__( 'Display Newsletter Subscription Area?', 'bronx' ),
    	  'id'          => 'footer_newsletter',
    	  'type'        => 'on_off',
    	  'desc'        => esc_html__( 'Would you like to display the Newsletter form?', 'bronx' ),
    	  'std'         => 'on',
    	  'condition'   => 'footer_override:is(on)'
    	),
    	array(
    	  'label'       => esc_html__( 'Display Footer', 'bronx' ),
    	  'id'          => 'footer',
    	  'type'        => 'on_off',
    	  'desc'        => esc_html__( 'Would you like to display the Footer?', 'bronx' ),
    	  'std'         => 'on',
    	  'condition'   => 'footer_override:is(on)'
    	),
      array(
        'id'          => 'tab4',
        'label'       => esc_html__( 'Revolution Slider', 'bronx' ),
        'type'        => 'tab'
      ),
      array(
        'label'       => esc_html__( 'Revolution Slider Alias', 'bronx' ),
        'id'          => 'rev_slider_alias',
        'type'        => 'revslider-select',
        'desc'        => esc_html__( 'If you would like to display Revolution Slider on top of this page, please enter the slider alias', 'bronx' ),
        'rows'        => '1'
      ),
      array(
        'label'       => esc_html__( 'Use Dark or Light Arrows and Bullets?', 'bronx' ),
        'id'          => 'rev_slider_white',
        'type'        => 'radio',
        'desc'        => esc_html__( 'You can choose to use either dark or light arrows here', 'bronx' ),
        'choices'     => array(
          array(
            'label'       => esc_html__( 'Light Arrows', 'bronx' ),
            'value'       => 'arrows-light'
          ),
          array(
            'label'       => esc_html__( 'Dark Arrows', 'bronx' ),
            'value'       => 'arrows-dark'
          )
        ),
        'std'         => 'arrows-dark',
        'condition'   => 'rev_slider_alias:not()'
      ),
      array(
        'id'          => 'tab5',
        'label'       => esc_html__( 'Navigation', 'bronx' ),
        'type'        => 'tab'
      ),
      array(
        'label'       => esc_html__( 'Select Page Primary Menu', 'bronx' ),
        'id'          => 'page_menu',
        'type'        => 'menu_select',
        'desc'        => esc_html__( 'If you select a menu here, it will override the main navigation menu.', 'bronx' )
      ),
      array(
        'id'          => 'tab6',
        'label'       => esc_html__( 'Snap To Scroll', 'bronx' ),
        'type'        => 'tab'
      ),
      array(
        'label'       => esc_html__( 'Enable Snap To Scroll Effect?', 'bronx' ),
        'id'          => 'snap_scroll',
        'desc'        => esc_html__( 'This enables the one page snap to scroll feature. When you scroll, the screen will snap to sections', 'bronx' ),
        'std'         => 'off',
        'type'        => 'on_off',

      )
    )
  );

  /**
   * Register our meta boxes using the
   * ot_register_meta_box() function.
   */


	ot_register_meta_box( $page_metabox );
  ot_register_meta_box( $product_metabox );
}