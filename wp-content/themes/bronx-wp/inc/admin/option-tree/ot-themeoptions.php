<?php
/**
 * Initialize the options before anything else.
 */
add_action( 'admin_init', 'thb_custom_theme_options', 1 );

/**
 * Theme Mode demo code of all the available option types.
 *
 * @return    void
 *
 * @access    private
 * @since     2.0
 */
function thb_custom_theme_options() {

  /**
   * Get a copy of the saved settings array.
   */
  $saved_settings = get_option( 'option_tree_settings', array() );

  /**
   * Create a custom settings array that we pass to
   * the OptionTree Settings API Class.
   */
  $custom_settings = array(
    'sections'        => array(
      array(
        'title'       => esc_html__( 'General', 'bronx' ),
        'id'          => 'general'
      ),
      array(
        'title'       => esc_html__( 'Shop Settings', 'bronx' ),
        'id'          => 'shop'
      ),
      array(
        'title'       => esc_html__( 'Header Settings', 'bronx' ),
        'id'          => 'header'
      ),
      array(
        'title'       => esc_html__( 'Typography', 'bronx' ),
        'id'          => 'typography'
      ),
      array(
        'title'       => esc_html__( 'Header Backgrounds', 'bronx' ),
        'id'          => 'header_bg'
      ),
      array(
        'title'       => esc_html__( 'Other Customization', 'bronx' ),
        'id'          => 'customization'
      ),
      array(
        'title'       => esc_html__( 'Footer Settings', 'bronx' ),
        'id'          => 'footer'
      ),
      array(
        'title'       => esc_html__( 'Google Map Settings', 'bronx' ),
        'id'          => 'contact'
      ),
      array(
        'title'       => esc_html__( 'Misc', 'bronx' ),
        'id'          => 'misc'
      )
    ),
    'settings'        => array(
    	array(
    	  'id'          => 'general_tab0',
    	  'label'       => esc_html__( 'General', 'bronx' ),
    	  'type'        => 'tab',
    	  'section'     => 'general'
    	),
    	array(
    	  'id'          => 'subscribe_text',
    	  'label'       => esc_html__( 'Download Subscription Emails', 'bronx' ),
    	  'desc'        => __('You can download the subscribed emails throught the subscription element/widget here: <br><br> <a href="?thb_download_emails=true" class="button button-primary">Download Emails</a>', 'bronx' ),
    	  'type'        => 'textblock',
    	  'section'     => 'general'
    	),
    	array(
    		'label'       => esc_html__( 'Blog Style', 'bronx' ),
    		'id'          => 'blog_style',
    		'type'        => 'radio',
    		'desc'        => esc_html__( 'Which blog style would you like to use?', 'bronx' ),
    		'choices'     => array(
    		  array(
    			'label'       => esc_html__( 'Standard', 'bronx' ),
    			'value'       => 'style1'
    		  ),
    		  array(
    			'label'       => esc_html__( 'Masonry', 'bronx' ),
    			'value'       => 'style2'
    		  )
    		),
    		'std'         => 'style1',
    		'section'     => 'general'
    	),
    	array(
    		'label'       => esc_html__( 'Search Results', 'bronx' ),
    		'id'          => 'search_results',
    		'type'        => 'radio',
    		'desc'        => esc_html__( 'What type of results would you like to display in search?', 'bronx' ),
    		'choices'     => array(
    		  array(
    			'label'       => esc_html__( 'Products', 'bronx' ),
    			'value'       => 'products'
    		  ),
    		  array(
    			'label'       => esc_html__( 'Blog Posts', 'bronx' ),
    			'value'       => 'posts'
    		  )
    		),
    		'std'         => 'posts',
    		'section'     => 'general'
    	  ),
    	array(
    	  'id'          => 'general_tab1',
    	  'label'       => esc_html__( 'Popup', 'bronx' ),
    	  'type'        => 'tab',
    	  'section'     => 'general'
    	),
    	array(
    	  'label'       => esc_html__( 'Display Popup?', 'bronx' ),
    	  'id'          => 'popup',
    	  'type'        => 'on_off',
    	  'desc'        => esc_html__( 'Would you like to display the Popup?', 'bronx' ),
    	  'std'         => 'on',
    	  'section'     => 'general'
    	),
    	array(
    	  'label'       => esc_html__( 'Popup refresh interval', 'bronx' ),
    	  'id'          => 'popup-interval',
    	  'type'        => 'radio',
    	  'desc'        => esc_html__( 'When the user closes the popup, the popup will not be visible on the next page. After the below period, its going to be visible again unless he closes it again', 'bronx' ),
    	  'choices'     => array(
    	    array(
    	      'label'       => esc_html__( 'Never - the popup will be shown every page', 'bronx' ),
    	      'value'       => '0'
    	    ),
    	    array(
    	      'label'       => esc_html__( '1 Day', 'bronx' ),
    	      'value'       => '1'
    	    ),
    	    array(
    	      'label'       => esc_html__( '2 Days', 'bronx' ),
    	      'value'       => '2'
    	    ),
    	    array(
    	      'label'       => esc_html__( '3 Days', 'bronx' ),
    	      'value'       => '3'
    	    ),
    	    array(
    	      'label'       => esc_html__( '1 Week', 'bronx' ),
    	      'value'       => '7'
    	    ),
    	    array(
    	      'label'       => esc_html__( '2 Weeks', 'bronx' ),
    	      'value'       => '14'
    	    ),
    	    array(
    	      'label'       => esc_html__( '3 Weeks', 'bronx' ),
    	      'value'       => '21'
    	    ),
    	    array(
    	      'label'       => esc_html__( '1 Month', 'bronx' ),
    	      'value'       => '30'
    	    )

    	  ),
    	  'std'         => '1',
    	  'section'     => 'general',
    	  'condition'   => 'popup:is(on)'
    	),

	  array(
    	  'id'          => 'general_tab3',
    	  'label'       => esc_html__( 'Popup Customization', 'bronx' ),
    	  'type'        => 'tab',
    	  'section'     => 'general'
      ),
	  array(
        'label'       => esc_html__( 'Popup Content', 'bronx' ),
        'id'          => 'popup_content',
        'type'        => 'textarea',
        'desc'        => esc_html__( 'Enter your own content inside the popup', 'bronx' ),
        'rows'        => '4',
        'section'     => 'general'
      ),
	  array(
        'label'       => esc_html__( 'Popup Background', 'bronx' ),
        'id'          => 'popup_bg',
        'type'        => 'background',
        'desc'        => esc_html__( 'You can change the background of the popup from here.', 'bronx' ),
        'section'     => 'general'
      ),
      array(
        'id'          => 'general_tab2',
        'label'       => esc_html__( 'Social Sharing', 'bronx' ),
        'type'        => 'tab',
        'section'     => 'general'
      ),
      array(
        'label'       => esc_html__( 'Sharing buttons', 'bronx' ),
        'id'          => 'sharing_buttons',
        'type'        => 'checkbox',
        'desc'        => esc_html__( 'You can choose which social networks to display', 'bronx' ),
        'choices'     => array(
          array(
            'label'       => esc_html__( 'Facebook', 'bronx' ),
            'value'       => 'facebook'
          ),
          array(
            'label'       => esc_html__( 'Twitter', 'bronx' ),
            'value'       => 'twitter'
          ),
          array(
            'label'       => esc_html__( 'Pinterest', 'bronx' ),
            'value'       => 'pinterest'
          ),
          array(
            'label'       => esc_html__( 'VK', 'bronx' ),
            'value'       => 'vk'
          )
        ),
        'section'     => 'general'
      ),
      array(
        'id'          => 'general_tab4',
        'label'       => esc_html__( 'Mobile Menu', 'bronx' ),
        'type'        => 'tab',
        'section'     => 'general'
      ),
      array(
        'label'       => esc_html__( 'Menu Footer', 'bronx' ),
        'id'          => 'menu_footer',
        'type'        => 'textarea',
        'desc'        => esc_html__( 'This content appears at the bottom of the mobile menu. You can use your shortcodes here.', 'bronx' ),
        'rows'        => '4',
        'section'     => 'general'
      ),
      array(
        'label'       => esc_html__( 'Facebook Link', 'bronx' ),
        'id'          => 'fb_link_header',
        'type'        => 'text',
        'desc'        => esc_html__( 'Facebook profile/page link', 'bronx' ),
        'section'     => 'general'
      ),
      array(
        'label'       => esc_html__( 'Pinterest Link', 'bronx' ),
        'id'          => 'pinterest_link_header',
        'type'        => 'text',
        'desc'        => esc_html__( 'Pinterest profile/page link', 'bronx' ),
        'section'     => 'general'
      ),
      array(
        'label'       => esc_html__( 'Twitter Link', 'bronx' ),
        'id'          => 'twitter_link_header',
        'type'        => 'text',
        'desc'        => esc_html__( 'Twitter profile/page link', 'bronx' ),
        'section'     => 'general'
      ),
      array(
        'label'       => esc_html__( 'Google Plus Link', 'bronx' ),
        'id'          => 'googleplus_link_header',
        'type'        => 'text',
        'desc'        => esc_html__( 'Google Plus profile/page link', 'bronx' ),
        'section'     => 'general'
      ),
      array(
        'label'       => esc_html__( 'Linkedin Link', 'bronx' ),
        'id'          => 'linkedin_link_header',
        'type'        => 'text',
        'desc'        => esc_html__( 'Linkedin profile/page link', 'bronx' ),
        'section'     => 'general'
      ),
      array(
        'label'       => esc_html__( 'Instagram Link', 'bronx' ),
        'id'          => 'instragram_link_header',
        'type'        => 'text',
        'desc'        => esc_html__( 'Instagram profile/page link', 'bronx' ),
        'section'     => 'general'
      ),
      array(
        'label'       => esc_html__( 'Xing Link', 'bronx' ),
        'id'          => 'xing_link_header',
        'type'        => 'text',
        'desc'        => esc_html__( 'Xing profile/page link', 'bronx' ),
        'section'     => 'general'
      ),
      array(
        'label'       => esc_html__( 'Tumblr Link', 'bronx' ),
        'id'          => 'tumblr_link_header',
        'type'        => 'text',
        'desc'        => esc_html__( 'Tumblr profile/page link', 'bronx' ),
        'section'     => 'general'
      ),
      array(
        'label'       => esc_html__( 'Vkontakte Link', 'bronx' ),
        'id'          => 'vk_link_header',
        'type'        => 'text',
        'desc'        => esc_html__( 'Vkontakte profile/page link', 'bronx' ),
        'section'     => 'general'
      ),
      array(
        'label'       => esc_html__( 'SoundCloud Link', 'bronx' ),
        'id'          => 'soundcloud_link_header',
        'type'        => 'text',
        'desc'        => esc_html__( 'SoundCloud profile/page link', 'bronx' ),
        'section'     => 'general'
      ),
      array(
        'label'       => esc_html__( 'Dribbble Link', 'bronx' ),
        'id'          => 'dribbble_link_header',
        'type'        => 'text',
        'desc'        => esc_html__( 'Dribbbble profile/page link', 'bronx' ),
        'section'     => 'general'
      ),
      array(
        'label'       => esc_html__( 'YouTube Link', 'bronx' ),
        'id'          => 'youtube_link_header',
        'type'        => 'text',
        'desc'        => esc_html__( 'Youtube profile/page link', 'bronx' ),
        'section'     => 'general'
      ),
      array(
        'label'       => esc_html__( 'Spotify Link', 'bronx' ),
        'id'          => 'spotify_link_header',
        'type'        => 'text',
        'desc'        => esc_html__( 'Spotify profile/page link', 'bronx' ),
        'section'     => 'general'
      ),
      array(
        'label'       => esc_html__( 'Behance Link', 'bronx' ),
        'id'          => 'behance_link_header',
        'type'        => 'text',
        'desc'        => esc_html__( 'Behance profile/page link', 'bronx' ),
        'section'     => 'general'
      ),
      array(
        'label'       => esc_html__( 'DeviantArt Link', 'bronx' ),
        'id'          => 'deviantart_link_header',
        'type'        => 'text',
        'desc'        => esc_html__( 'DeviantArt profile/page link', 'bronx' ),
        'section'     => 'general'
      ),
      array(
        'id'          => 'header_tab1',
        'label'       => esc_html__( 'Header Settings', 'bronx' ),
        'type'        => 'tab',
        'section'     => 'header'
      ),
      array(
        'label'       => esc_html__( 'Header Style', 'bronx' ),
        'id'          => 'header_style',
        'type'        => 'radio-image',
        'desc'        => esc_html__( 'You can choose different header styles here', 'bronx' ),
        'std'         => 'style1',
        'section'     => 'header'
      ),
      array(
        'label'       => esc_html__( 'Header Full Width', 'bronx' ),
        'id'          => 'thb_header_full_width',
        'type'        => 'on_off',
        'desc'        => esc_html__( 'By default, the header on Bronx is full-width. You can limit it to the grid here.', 'bronx' ),
        'std'         => 'on',
        'section'     => 'header'
      ),
      array(
        'label'       => esc_html__( 'Fixed Header', 'bronx' ),
        'id'          => 'header_fixed',
        'type'        => 'on_off',
        'desc'        => esc_html__( 'You can enable/disable the fixed header functionality here.', 'bronx' ),
        'std'         => 'on',
        'section'     => 'header'
      ),
      array(
        'id'          => 'header_menu_margin',
        'label'       => esc_html__( 'Top Level Menu Item spacing', 'bronx' ),
        'desc'        => esc_html__( 'If you want to fit more menu items to the given space, you can decrease the margin between them here. The default margin is 20px', 'bronx' ),
        'std'         => '',
        'type'        => 'measurement',
        'section'     => 'header'
      ),
      array(
        'label'       => esc_html__( 'Light Header - Item colors', 'bronx' ),
        'id'          => 'menu_color_light',
        'type'        => 'colorpicker',
        'desc'        => esc_html__( 'This changes the header menu color for light backgrounds', 'bronx' ),
        'section'     => 'header'
      ),
      array(
        'label'       => esc_html__( 'Dark Header - Item colors', 'bronx' ),
        'id'          => 'menu_color_dark',
        'type'        => 'colorpicker',
        'desc'        => esc_html__( 'This changes the header menu color for dark backgrounds', 'bronx' ),
        'section'     => 'header'
      ),
      array(
        'id'          => 'header_tab2',
        'label'       => esc_html__( 'Sub-Header Settings', 'bronx' ),
        'type'        => 'tab',
        'section'     => 'header'
      ),
      array(
        'label'       => esc_html__( 'Display Sub-Header', 'bronx' ),
        'id'          => 'subheader',
        'type'        => 'on_off',
        'desc'        => esc_html__( 'Would you like to display the Sub-Header?', 'bronx' ),
        'std'         => 'on',
        'section'     => 'header',
      ),
      array(
        'label'       => esc_html__( 'Language Switcher', 'bronx' ),
        'id'          => 'subheader_ls',
        'type'        => 'on_off',
        'desc'        => __('Would you like to display the language switcher in the sub-header? <small>Requires that you have WPML installed. <a href="https://wpml.org/?aid=85928&affiliate_key=PIP3XupfKQOZ">You can purchase WPML here.</a></small>', 'bronx' ),
        'section'     => 'header',
        'std'         => 'off',
        'condition'   => 'subheader:is(on)'
      ),
      array(
        'label'       => esc_html__( 'Currency Switcher', 'bronx' ),
        'id'          => 'subheader_cs',
        'type'        => 'on_off',
        'desc'        => __('Would you like to display the curreny switcher in the footer? <small>Requires that you have WPML + Woocommerce Multilanguage installed. <a href="https://wpml.org/?aid=85928&affiliate_key=PIP3XupfKQOZ">You can purchase WPML + Woocommerce Multilanguage here.</a></small>', 'bronx' ),
        'section'     => 'header',
        'std'         => 'off',
        'condition'   => 'subheader:is(on)'
      ),
      array(
        'label'       => esc_html__( 'Subheader Text', 'bronx' ),
        'id'          => 'subheader_text',
        'type'        => 'text',
        'desc'        => esc_html__( 'Sub-header Text at the top left', 'bronx' ),
        'section'     => 'header',
        'condition'   => 'subheader:is(on)'
      ),
      array(
        'id'          => 'header_tab3',
        'label'       => esc_html__( 'Logo Settings', 'bronx' ),
        'type'        => 'tab',
        'section'     => 'header'
      ),
      array(
        'label'       => esc_html__( 'Logo Height', 'bronx' ),
        'id'          => 'logo_height',
        'type'        => 'measurement',
        'desc'        => esc_html__( 'You can modify the logo height from here. This is maximum height, so your logo may get smaller depending on spacing inside header', 'bronx' ),
        'section'     => 'header'
      ),
      array(
        'label'       => esc_html__( 'Logo Upload for Light Backgrounds', 'bronx' ),
        'id'          => 'logo',
        'type'        => 'upload',
        'desc'        => esc_html__( 'You can upload your own logo here. Since this theme is retina-ready, <strong>please upload a double size image.</strong> The image should be maximum 100 pixels in height.', 'bronx' ),
        'section'     => 'header'
      ),
      array(
        'label'       => esc_html__( 'Logo Upload for Dark Backgrounds', 'bronx' ),
        'id'          => 'logo_dark',
        'type'        => 'upload',
        'desc'        => esc_html__( 'You can upload your own logo here. Since this theme is retina-ready, <strong>please upload a double size image.</strong> The image should be maximum 100 pixels in height.', 'bronx' ),
        'section'     => 'header'
      ),
      array(
        'id'          => 'header_tab4',
        'label'       => esc_html__( 'Header Icons', 'bronx' ),
        'type'        => 'tab',
        'section'     => 'header'
      ),
      array(
        'label'       => esc_html__( 'Header Search', 'bronx' ),
        'id'          => 'header_search',
        'type'        => 'on_off',
        'desc'        => esc_html__( 'Would you like to display the search icon in the header?', 'bronx' ),
        'section'     => 'header',
        'std'         => 'on'
      ),
      array(
        'label'       => esc_html__( 'Header Wishlist', 'bronx' ),
        'id'          => 'header_wishlist',
        'type'        => 'on_off',
        'desc'        => esc_html__( 'Would you like to display the wishlist icon in the header?', 'bronx' ),
        'section'     => 'header',
        'std'         => 'on'
      ),
      array(
        'label'       => esc_html__( 'Header Shopping Cart', 'bronx' ),
        'id'          => 'header_cart',
        'type'        => 'on_off',
        'desc'        => esc_html__( 'Would you like to display the shopping cart icon in the header', 'bronx' ),
        'section'     => 'header',
        'std'         => 'on'
      ),
      array(
        'id'          => 'header_tab6',
        'label'       => esc_html__( 'Header Spacing', 'bronx' ),
        'type'        => 'tab',
        'section'     => 'header'
      ),
      array(
        'label'       => esc_html__( 'Header Padding', 'bronx' ),
        'id'          => 'header_padding',
        'type'        => 'spacing',
        'desc'        => esc_html__( 'This affects header on large screens. The values are in px.', 'bronx' ),
        'section'     => 'header'
      ),
      array(
        'label'       => esc_html__( 'Mobile Header Padding', 'bronx' ),
        'id'          => 'header_padding_mobile',
        'type'        => 'spacing',
        'desc'        => esc_html__( 'This affects header on mobile screens for both regular and fixed versions. The values are in px.', 'bronx' ),
        'section'     => 'header'
      ),
      array(
        'id'          => 'typography_tab0',
        'label'       => esc_html__( 'Font families', 'bronx' ),
        'type'        => 'tab',
        'section'     => 'typography'
      ),
      array(
        'label'       => esc_html__( 'Primary Font', 'bronx' ),
        'id'          => 'primary_font',
        'type'        => 'typography',
        'desc'        => esc_html__( 'Font Family Setting for the primary font. Affects all headings.', 'bronx' ),
        'section'     => 'typography'
      ),
      array(
        'label'       => esc_html__( 'Secondary Font', 'bronx' ),
        'id'          => 'secondary_font',
        'type'        => 'typography',
        'desc'        => esc_html__( 'Font Family Setting for the secondary font', 'bronx' ),
        'section'     => 'typography'
      ),
      array(
        'id'          => 'typography_tab1',
        'label'       => esc_html__( 'Typography', 'bronx' ),
        'type'        => 'tab',
        'section'     => 'typography'
      ),
      array(
        'label'       => esc_html__( 'Body Text Typography', 'bronx' ),
        'id'          => 'body_type',
        'type'        => 'typography',
        'desc'        => esc_html__( 'Font Settings for general body font', 'bronx' ),
        'section'     => 'typography'
      ),
      array(
        'label'       => esc_html__( 'Main Menu Typography', 'bronx' ),
        'id'          => 'menu_left_type',
        'type'        => 'typography',
        'desc'        => esc_html__( 'Font Settings for the main menu', 'bronx' ),
        'section'     => 'typography'
      ),
      array(
        'label'       => esc_html__( 'Main Menu Submenu Typography', 'bronx' ),
        'id'          => 'menu_left_submenu_type',
        'type'        => 'typography',
        'desc'        => esc_html__( 'Font Settings for the submenu elements of the main menu', 'bronx' ),
        'section'     => 'typography'
      ),
      array(
        'label'       => esc_html__( 'Mobile Menu Typography', 'bronx' ),
        'id'          => 'menu_mobile_type',
        'type'        => 'typography',
        'desc'        => esc_html__( 'Font Settings for the mobile menu', 'bronx' ),
        'section'     => 'typography'
      ),
      array(
        'label'       => esc_html__( 'Mobile Menu Submenu Typography', 'bronx' ),
        'id'          => 'menu_mobile_submenu_type',
        'type'        => 'typography',
        'desc'        => esc_html__( 'Font Settings for the submenu elements of the mobile menu', 'bronx' ),
        'section'     => 'typography'
      ),
      array(
        'id'          => 'typography_tab3',
        'label'       => esc_html__( 'Heading Typography', 'bronx' ),
        'type'        => 'tab',
        'section'     => 'typography'
      ),
      array(
        'id'          => 'heading_text',
        'label'       => esc_html__( 'About Heading Typography', 'bronx' ),
        'desc'        => esc_html__( 'These affect all h* tags inside the theme, so use wisely. Some particular headings may need additional css to target.', 'bronx' ),
        'type'        => 'textblock',
        'section'     => 'typography'
      ),
      array(
        'label'       => esc_html__( 'Heading 1', 'bronx' ),
        'id'          => 'h1_type',
        'type'        => 'typography',
        'desc'        => esc_html__( 'Font Settings for the H1 tag', 'bronx' ),
        'section'     => 'typography'
      ),
      array(
        'label'       => esc_html__( 'Heading 2', 'bronx' ),
        'id'          => 'h2_type',
        'type'        => 'typography',
        'desc'        => esc_html__( 'Font Settings for the H2 tag', 'bronx' ),
        'section'     => 'typography'
      ),
      array(
        'label'       => esc_html__( 'Heading 3', 'bronx' ),
        'id'          => 'h3_type',
        'type'        => 'typography',
        'desc'        => esc_html__( 'Font Settings for the H3 tag', 'bronx' ),
        'section'     => 'typography'
      ),
      array(
        'label'       => esc_html__( 'Heading 4', 'bronx' ),
        'id'          => 'h4_type',
        'type'        => 'typography',
        'desc'        => esc_html__( 'Font Settings for the H4 tag', 'bronx' ),
        'section'     => 'typography'
      ),
      array(
        'label'       => esc_html__( 'Heading 5', 'bronx' ),
        'id'          => 'h5_type',
        'type'        => 'typography',
        'desc'        => esc_html__( 'Font Settings for the H5 tag', 'bronx' ),
        'section'     => 'typography'
      ),
      array(
        'label'       => esc_html__( 'Heading 6', 'bronx' ),
        'id'          => 'h6_type',
        'type'        => 'typography',
        'desc'        => esc_html__( 'Font Settings for the H6 tag', 'bronx' ),
        'section'     => 'typography'
      ),
      array(
        'id'          => 'typography_tab4',
        'label'       => esc_html__( 'Shop Typography', 'bronx' ),
        'type'        => 'tab',
        'section'     => 'typography'
      ),
      array(
        'label'       => esc_html__( 'Product Title on Shop Pages', 'bronx' ),
        'id'          => 'shop_product_title',
        'type'        => 'typography',
        'desc'        => esc_html__( 'Typography Setting for the product titles on shop pages.', 'bronx' ),
        'section'     => 'typography'
      ),
      array(
        'label'       => esc_html__( 'Product Title on Product Page', 'bronx' ),
        'id'          => 'shop_product_detail_title',
        'type'        => 'typography',
        'desc'        => esc_html__( 'Typography Setting for the product titles on product pages.', 'bronx' ),
        'section'     => 'typography'
      ),
      array(
        'label'       => esc_html__( 'Product Excerpt Text', 'bronx' ),
        'id'          => 'shop_product_detail_excerpt',
        'type'        => 'typography',
        'desc'        => esc_html__( 'Typography Setting for the product excerpt on product pages.', 'bronx' ),
        'section'     => 'typography'
      ),
      array(
        'id'          => 'typography_tab5',
        'label'       => esc_html__( 'Font Support', 'bronx' ),
        'type'        => 'tab',
        'section'     => 'typography'
      ),
      array(
        'label'       => esc_html__( 'Font Subsets', 'bronx' ),
        'id'          => 'font_subsets',
        'type'        => 'radio',
        'desc'        => esc_html__( 'You can add additional character subset specific to your language.', 'bronx' ),
        'choices'     => array(
        	array(
        	  'label'       => esc_html__( 'No Subset', 'bronx' ),
        	  'value'       => 'no-subset'
        	),
        	array(
        	  'label'       => esc_html__( 'Latin Extended', 'bronx' ),
        	  'value'       => 'latin-ext'
        	),
          array(
            'label'       => esc_html__( 'Greek', 'bronx' ),
            'value'       => 'greek'
          ),
          array(
            'label'       => esc_html__( 'Cyrillic', 'bronx' ),
            'value'       => 'cyrillic'
          ),
          array(
            'label'       => esc_html__( 'Vietnamese', 'bronx' ),
            'value'       => 'vietnamese'
          )
        ),
        'std'         => 'no-subset',
        'section'     => 'typography'
      ),
      array(
        'id'          => 'typekit_text',
        'label'       => esc_html__( 'About Typekit Support', 'bronx' ),
        'desc'        => esc_html__( 'Please make sure that you enter your Typekit ID or the fonts wont work. After adding Typekit Font Names, these names will appear on the font selection dropdown on the Typography tab.', 'bronx' ),
        'type'        => 'textblock',
        'section'     => 'typography'
      ),
      array(
        'label'       => esc_html__( 'Typekit Kit ID', 'bronx' ),
        'id'          => 'typekit_id',
        'type'        => 'text',
        'desc'        => esc_html__( 'Paste the provided Typekit Kit ID. <small>Usually 6-7 random letters</small>', 'bronx' ),
        'section'     => 'typography',
      ),
      array(
        'label'       => esc_html__( 'Typekit Font Names', 'bronx' ),
        'id'          => 'typekit_fonts',
        'type'        => 'text',
        'desc'        => esc_html__( 'Enter your Typekit Font Name, seperated by comma. For example: futura-pt,aktiv-grotesk <strong>Do not leave spaces between commas</strong>', 'bronx' ),
        'section'     => 'typography',
      ),
      array(
        'label'       => esc_html__( 'Self Hosted Fonts', 'bronx' ),
        'id'          => 'self_hosted_fonts',
        'type'        => 'list-item',
        'settings'    => array(
        	array(
        	  'label'       => esc_html__( 'Font Stylesheet URL', 'bronx' ),
        	  'id'          => 'font_url',
        	  'type'        => 'text',
        	  'desc'        => esc_html__( 'URL of the font stylesheet (.css file) you want to use.', 'bronx' ),
        	  'section'     => 'typography',
        	),
        	array(
        	  'label'       => esc_html__( 'Font Family Names', 'bronx' ),
        	  'id'          => 'font_name',
        	  'type'        => 'text',
        	  'desc'        => esc_html__( 'Enter your Font Family Name, use the name that will be used in css. For example: futura-pt, aktiv-grotesk. After saving, you will be able to use this name in the typography settings.', 'bronx' ),
        	  'section'     => 'typography',
        	),
        ),
        'section'     => 'typography'
      ),
      array(
        'id'          => 'h_bg_tab1',
        'label'       => esc_html__( 'General', 'bronx' ),
        'type'        => 'tab',
        'section'     => 'header_bg'
      ),
      array(
        'label'       => esc_html__( 'Header Background', 'bronx' ),
        'id'          => 'header_bg',
        'type'        => 'background',
        'desc'        => esc_html__( 'Background settings for the general header', 'bronx' ),
        'section'     => 'header_bg'
      ),
      array(
        'label'       => esc_html__( 'Header Item Colors', 'bronx' ),
        'id'          => 'header_color',
        'type'        => 'radio-image',
        'desc'        => esc_html__( 'Which Header color would you like to use for the general header?', 'bronx' ),
        'std'         => 'header--light',
        'section'     => 'header_bg'
      ),
      array(
        'id'          => 'h_bg_tab2',
        'label'       => esc_html__( 'Shop', 'bronx' ),
        'type'        => 'tab',
        'section'     => 'header_bg'
      ),
      array(
        'label'       => esc_html__( 'Shop Header Background', 'bronx' ),
        'id'          => 'header_bg_shop',
        'type'        => 'background',
        'desc'        => esc_html__( 'Background settings for the shop header', 'bronx' ),
        'section'     => 'header_bg'
      ),
      array(
        'label'       => esc_html__( 'Shop Header Item Colors', 'bronx' ),
        'id'          => 'header_color_shop',
        'type'        => 'radio-image',
        'desc'        => esc_html__( 'Which Header color would you like to use for the shop header?', 'bronx' ),
        'std'         => 'header--dark',
        'section'     => 'header_bg'
      ),
      array(
        'id'          => 'h_bg_tab3',
        'label'       => esc_html__( 'Product Categories', 'bronx' ),
        'type'        => 'tab',
        'section'     => 'header_bg'
      ),
      array(
        'label'       => esc_html__( 'Product Category Header Item Colors', 'bronx' ),
        'id'          => 'header_color_product_category',
        'type'        => 'radio-image',
        'desc'        => esc_html__( 'Which Header color would you like to use for the product categories?', 'bronx' ),
        'std'         => 'header--dark',
        'section'     => 'header_bg'
      ),
      array(
        'id'          => 'h_bg_tab4',
        'label'       => esc_html__( 'My Account', 'bronx' ),
        'type'        => 'tab',
        'section'     => 'header_bg'
      ),
      array(
        'label'       => esc_html__( 'My Account Header Background', 'bronx' ),
        'id'          => 'header_bg_myaccount',
        'type'        => 'background',
        'desc'        => esc_html__( 'Background settings for the my account header', 'bronx' ),
        'section'     => 'header_bg'
      ),
      array(
        'label'       => esc_html__( 'My Account Header Item Colors', 'bronx' ),
        'id'          => 'header_color_myaccount',
        'type'        => 'radio-image',
        'desc'        => esc_html__( 'Which Header color would you like to use for the my account pages?', 'bronx' ),
        'std'         => 'header--dark',
        'section'     => 'header_bg'
      ),
      array(
        'id'          => 'h_bg_tab5',
        'label'       => esc_html__( 'Cart', 'bronx' ),
        'type'        => 'tab',
        'section'     => 'header_bg'
      ),
      array(
        'label'       => esc_html__( 'Cart Header Background', 'bronx' ),
        'id'          => 'header_bg_cart',
        'type'        => 'background',
        'desc'        => esc_html__( 'Background settings for the cart header', 'bronx' ),
        'section'     => 'header_bg'
      ),
      array(
        'label'       => esc_html__( 'Cart Header Item Colors', 'bronx' ),
        'id'          => 'header_color_cart',
        'type'        => 'radio-image',
        'desc'        => esc_html__( 'Which Header color would you like to use for the cart pages?', 'bronx' ),
        'std'         => 'header--dark',
        'section'     => 'header_bg'
      ),
      array(
        'id'          => 'h_bg_tab6',
        'label'       => esc_html__( 'Checkout', 'bronx' ),
        'type'        => 'tab',
        'section'     => 'header_bg'
      ),
      array(
        'label'       => esc_html__( 'Checkout Header Background', 'bronx' ),
        'id'          => 'header_bg_checkout',
        'type'        => 'background',
        'desc'        => esc_html__( 'Background settings for the checkout header', 'bronx' ),
        'section'     => 'header_bg'
      ),
      array(
        'label'       => esc_html__( 'Checkout Header Item Colors', 'bronx' ),
        'id'          => 'header_color_checkout',
        'type'        => 'radio-image',
        'desc'        => esc_html__( 'Which Header color would you like to use for the checkout pages?', 'bronx' ),
        'std'         => 'header--dark',
        'section'     => 'header_bg'
      ),
      array(
        'id'          => 'shop_tab1',
        'label'       => esc_html__( 'General', 'bronx' ),
        'type'        => 'tab',
        'section'     => 'shop'
      ),
      array(
        'label'       => esc_html__( 'Display Grid Switcher on the right?', 'bronx' ),
        'id'          => 'shop_grid_switcher',
        'type'        => 'on_off',
        'desc'        => esc_html__( 'Would you like to display the Grid Switcher?', 'bronx' ),
        'std'         => 'on',
        'section'     => 'shop'
      ),
      array(
        'label'       => esc_html__( 'Display Category Bar?', 'bronx' ),
        'id'          => 'show_category_bar',
        'type'        => 'on_off',
        'desc'        => esc_html__( 'This displays the categories under the shop header.', 'bronx' ),
        'std'         => 'on',
        'section'     => 'shop'
      ),
      array(
        'label'       => esc_html__( 'Catalog Mode', 'bronx' ),
        'id'          => 'shop_catalog_mode',
        'type'        => 'on_off',
        'desc'        => esc_html__( 'If enabled, this will hide add to cart buttons and prices along the site.', 'bronx' ),
        'section'     => 'shop',
        'std'         => 'off'
      ),
      array(
        'label'       => esc_html__( 'Display Product Category?', 'bronx' ),
        'id'          => 'shop_product_listing_category',
        'type'        => 'on_off',
        'desc'        => esc_html__( 'If enabled, this will display product category on listing pages.', 'bronx' ),
        'section'     => 'shop',
        'std'         => 'off'
      ),
      array(
        'label'       => esc_html__( 'Display Product Rating?', 'bronx' ),
        'id'          => 'shop_product_listing_rating',
        'type'        => 'on_off',
        'desc'        => esc_html__( 'If enabled, this will display product rating on listing pages.', 'bronx' ),
        'section'     => 'shop',
        'std'         => 'off'
      ),
      array(
      'label'       => esc_html__( 'Product Pagination Style', 'bronx' ),
        'id'          => 'shop_product_listing_pagination',
        'type'        => 'radio',
        'desc'        => esc_html__( 'Which pagination syle would you like to use on shop page?', 'bronx' ),
        'choices'     => array(
          array(
            'label'       => esc_html__( 'Regular Pagination', 'bronx' ),
            'value'       => 'style1'
          ),
          array(
            'label'       => esc_html__( 'Load More Button', 'bronx' ),
            'value'       => 'style2'
          ),
          array(
            'label'       => esc_html__( 'Infinite Load', 'bronx' ),
            'value'       => 'style3'
          )
        ),
        'std'         => 'style1',
        'section'     => 'shop'
      ),
      array(
        'label'       => esc_html__( 'Shop Sidebar', 'bronx' ),
        'id'          => 'shop_sidebar',
        'type'        => 'radio',
        'desc'        => esc_html__( 'Would you like to display sidebar on shop main and category pages?', 'bronx' ),
        'choices'     => array(
          array(
            'label'       => esc_html__( 'No Sidebar', 'bronx' ),
            'value'       => 'no'
          ),
          array(
            'label'       => esc_html__( 'Right Sidebar', 'bronx' ),
            'value'       => 'right'
          ),
          array(
            'label'       => esc_html__( 'Left Sidebar', 'bronx' ),
            'value'       => 'left'
          )
        ),
        'std'         => 'no',
        'section'     => 'shop'
      ),
      array(
        'label'       => esc_html__( 'Number of products per row', 'bronx' ),
        'id'          => 'shop_columns',
        'type'        => 'radio',
        'desc'        => esc_html__( 'How many products to show per row', 'bronx' ),
        'choices'     => array(
        	array(
        	  'label'       => esc_html__( '2 Products', 'bronx' ),
        	  'value'       => '2'
        	),
          array(
            'label'       => esc_html__( '3 Products', 'bronx' ),
            'value'       => '3'
          ),
          array(
            'label'       => esc_html__( '4 Products', 'bronx' ),
            'value'       => '4'
          ),
          array(
            'label'       => esc_html__( '5 Products', 'bronx' ),
            'value'       => '5'
          ),
          array(
            'label'       => esc_html__( '6 Products', 'bronx' ),
            'value'       => '6'
          )
        ),
        'std'         => '4',
        'section'     => 'shop'
      ),
      array(
      	'label'       => esc_html__( 'Products per Page', 'bronx' ),
        'id'          => 'shop_product_count',
        'desc'        => esc_html__( 'Number of products to show on shop pages.', 'bronx' ),
        'std'         => '12',
        'type'        => 'numeric-slider',
        'section'     => 'shop',
        'min_max_step'=> '1,48,1'
      ),
      array(
        'id'          => 'shop_tab2',
        'label'       => esc_html__( 'Product Page', 'bronx' ),
        'type'        => 'tab',
        'section'     => 'shop'
      ),
      array(
        'label'       => esc_html__( 'Product Layout', 'bronx' ),
        'id'          => 'shop_product_style',
        'type'        => 'radio-image',
        'desc'        => esc_html__( 'You can change your product layout from here.', 'bronx' ),
        'std'         => 'style1',
        'section'     => 'shop'
      ),
      array(
        'label'       => esc_html__( 'Product Zoom', 'bronx' ),
        'id'          => 'shop_product_zoom',
        'type'        => 'on_off',
        'desc'        => esc_html__( 'You can enable product zoom here. Make sure you upload large images for this feature to work.', 'bronx' ),
        'section'     => 'shop',
        'std'         => 'off'
      ),
      array(
        'label'       => esc_html__( 'Reviews Tab', 'bronx' ),
        'id'          => 'shop_reviews_tab',
        'type'        => 'on_off',
        'desc'        => esc_html__( 'You can disable the reviews tab from here', 'bronx' ),
        'section'     => 'shop',
        'std'         => 'on'
      ),
      array(
        'label'       => esc_html__( 'Use Ajax Add To Cart?', 'bronx' ),
        'id'          => 'shop_product_ajax_addtocart',
        'type'        => 'on_off',
        'desc'        => esc_html__( 'Would you like to use Ajax Add to Cart on product pages?', 'bronx' ),
        'std'         => 'on',
        'section'     => 'shop'
      ),
      array(
        'id'          => 'shop_tab3',
        'label'       => esc_html__( 'Misc', 'bronx' ),
        'type'        => 'tab',
        'section'     => 'shop'
      ),
      array(
        'label'       => esc_html__( 'Product Sale Badge style', 'bronx' ),
        'id'          => 'shop_sale_badge',
        'type'        => 'radio',
        'desc'        => esc_html__( 'Which sale badge style would you like to us?', 'bronx' ),
        'choices'     => array(
          array(
            'label'       => esc_html__( 'Discount Percentage', 'bronx' ),
            'value'       => 'discount'
          ),
          array(
            'label'       => esc_html__( 'Sale Text', 'bronx' ),
            'value'       => 'text'
          )
        ),
        'std'         => 'text',
        'section'     => 'shop'
      ),
      array(
        'label'       => esc_html__( 'Product "Just Arrived" Badge time', 'bronx' ),
        'id'          => 'shop_newness',
        'type'        => 'radio',
        'desc'        => esc_html__( 'Products that are added before the below time will display the new product page', 'bronx' ),
        'choices'     => array(
          array(
            'label'       => esc_html__( 'Never - "Just Arrived" Badge will never be shown', 'bronx' ),
            'value'       => '0'
          ),
          array(
            'label'       => esc_html__( '1 Day', 'bronx' ),
            'value'       => '1'
          ),
          array(
            'label'       => esc_html__( '2 Days', 'bronx' ),
            'value'       => '2'
          ),
          array(
            'label'       => esc_html__( '3 Days', 'bronx' ),
            'value'       => '3'
          ),
          array(
            'label'       => esc_html__( '1 Week', 'bronx' ),
            'value'       => '7'
          ),
          array(
            'label'       => esc_html__( '2 Weeks', 'bronx' ),
            'value'       => '14'
          ),
          array(
            'label'       => esc_html__( '3 Weeks', 'bronx' ),
            'value'       => '21'
          ),
          array(
            'label'       => esc_html__( '1 Month', 'bronx' ),
            'value'       => '30'
          )

        ),
        'std'         => '7',
        'section'     => 'shop'
      ),
      array(
        'id'          => 'misc_tab1',
        'label'       => esc_html__( 'General', 'bronx' ),
        'type'        => 'tab',
        'section'     => 'misc'
      ),
      array(
        'label'       => esc_html__( 'Use Combined JavaScript Library?', 'bronx' ),
        'id'          => 'thb_combined_libraries',
        'type'        => 'on_off',
        'desc'        => esc_html__( 'When disabled, each javascript library will be loaded on its own. It will allow for greater control using plugins, but may hinder site speed as multiple files will be loaded instead of one.', 'bronx' ),
        'std'         => 'on',
        'section'     => 'misc'
      ),
      array(
        'label'       => esc_html__( 'Extra CSS', 'bronx' ),
        'id'          => 'extra_css',
        'type'        => 'css',
        'desc'        => esc_html__( 'Any CSS that you would like to add to the theme.', 'bronx' ),
        'section'     => 'misc'
      ),
	  	array(
        'id'          => 'misc_tab2',
        'label'       => esc_html__( '404 Page', 'bronx' ),
        'type'        => 'tab',
        'section'     => 'misc'
      ),
	  	array(
        'label'       => esc_html__( '404 Page Image', 'bronx' ),
        'id'          => '404-image',
        'type'        => 'upload',
        'desc'        => esc_html__( 'This will change the actual 404 image in the middle.', 'bronx' ),
        'section'     => 'misc'
      ),
      array(
        'id'          => 'misc_tab4',
        'label'       => esc_html__( 'Twitter API', 'bronx' ),
        'type'        => 'tab',
        'section'     => 'misc'
      ),
      array(
        'id'          => 'twitter_text',
        'label'       => esc_html__( 'About the Twitter Settings', 'bronx' ),
        'desc'        => esc_html__( 'You should fill out these settings if you want to use the Twitter Widget inside Apperance -> Widgets', 'bronx' ),
        'std'         => '',
        'type'        => 'textblock',
        'section'     => 'misc'
      ),
      array(
        'label'       => esc_html__( 'Twitter Username', 'bronx' ),
        'id'          => 'twitter_bar_username',
        'type'        => 'text',
        'desc'        => esc_html__( 'Username to pull tweets for', 'bronx' ),
        'section'     => 'misc'
      ),
      array(
        'label'       => esc_html__( 'Consumer Key', 'bronx' ),
        'id'          => 'twitter_bar_consumerkey',
        'type'        => 'text',
        'desc'        => esc_html__( 'Visit <a href="https://dev.twitter.com/apps">this link</a> in a new tab, sign in with your account, click on Create a new application and create your own keys in case you dont have already', 'bronx' ),
        'section'     => 'misc'
      ),
      array(
        'label'       => esc_html__( 'Consumer Secret', 'bronx' ),
        'id'          => 'twitter_bar_consumersecret',
        'type'        => 'text',
        'desc'        => esc_html__( 'Visit <a href="https://dev.twitter.com/apps">this link</a> in a new tab, sign in with your account, click on Create a new application and create your own keys in case you dont have already', 'bronx' ),
        'section'     => 'misc'
      ),
      array(
        'label'       => esc_html__( 'Access Token', 'bronx' ),
        'id'          => 'twitter_bar_accesstoken',
        'type'        => 'text',
        'desc'        => esc_html__( 'Visit <a href="https://dev.twitter.com/apps">this link</a> in a new tab, sign in with your account, click on Create a new application and create your own keys in case you dont have already', 'bronx' ),
        'section'     => 'misc'
      ),
      array(
        'label'       => esc_html__( 'Access Token Secret', 'bronx' ),
        'id'          => 'twitter_bar_accesstokensecret',
        'type'        => 'text',
        'desc'        => esc_html__( 'Visit <a href="https://dev.twitter.com/apps">this link</a> in a new tab, sign in with your account, click on Create a new application and create your own keys in case you dont have already', 'bronx' ),
        'section'     => 'misc'
      ),
      array(
        'id'          => 'misc_tab5',
        'label'       => esc_html__( 'Create Additional Sidebars', 'bronx' ),
        'type'        => 'tab',
        'section'     => 'misc'
      ),
      array(
        'id'          => 'sidebars_text',
        'label'       => esc_html__( 'About the sidebars', 'bronx' ),
        'desc'        => esc_html__( 'All sidebars that you create here will appear both in the Widgets Page(Appearance > Widgets), from where you will have to configure them, and in the pages, where you will be able to choose a sidebar for each page', 'bronx' ),
        'std'         => '',
        'type'        => 'textblock',
        'section'     => 'misc'
      ),
      array(
        'label'       => esc_html__( 'Create Sidebars', 'bronx' ),
        'id'          => 'sidebars',
        'type'        => 'list-item',
        'desc'        => esc_html__( 'Please choose a unique title for each sidebar!', 'bronx' ),
        'section'     => 'misc',
        'settings'    => array(
          array(
            'label'       => esc_html__( 'ID', 'bronx' ),
            'id'          => 'id',
            'type'        => 'text',
            'desc'        => esc_html__( 'Please write a lowercase id, with <strong>no spaces</strong>', 'bronx' )
          )
        )
      ),
      array(
        'id'          => 'customization_tab1',
        'label'       => esc_html__( 'Colors', 'bronx' ),
        'type'        => 'tab',
        'section'     => 'customization'
      ),
      array(
        'label'       => esc_html__( 'Accent Color', 'bronx' ),
        'id'          => 'accent_color',
        'type'        => 'colorpicker',
        'desc'        => esc_html__( 'Change the accent color used throughout the theme', 'bronx' ),
        'section'     => 'customization',
      ),
      array(
        'label'       => esc_html__( 'Body Text Color', 'bronx' ),
        'id'          => 'text_color',
        'type'        => 'colorpicker',
        'desc'        => esc_html__( 'Changes the default text color', 'bronx' ),
        'section'     => 'customization',
      ),
      array(
        'id'          => 'customization_tab2',
        'label'       => esc_html__( 'Link Colors', 'bronx' ),
        'type'        => 'tab',
        'section'     => 'customization'
      ),
      array(
        'label'       => esc_html__( 'Full Menu Link Color', 'bronx' ),
        'id'          => 'fullmenu_link_color_dark',
        'type'        => 'link_color',
        'class'				=> 'ot-colorpicker-opacity',
        'desc'        => esc_html__( 'You can modify the link color of the full menu.', 'bronx' ),
        'section'     => 'customization'
      ),
      array(
        'label'       => esc_html__( 'Full Menu Light Link Color', 'bronx' ),
        'id'          => 'fullmenu_link_color_light',
        'type'        => 'link_color',
        'class'				=> 'ot-colorpicker-opacity',
        'desc'        => esc_html__( 'This will change the colors only when the light header is used (default links are white)', 'bronx' ),
        'section'     => 'customization'
      ),
      array(
        'label'       => esc_html__( 'Sub-Menu Link Color', 'bronx' ),
        'id'          => 'submenu_link_color',
        'type'        => 'link_color',
        'class'				=> 'ot-colorpicker-opacity',
        'desc'        => esc_html__( 'You can modify the link colors inside the sub-menus of the full menu.', 'bronx' ),
        'section'     => 'customization'
      ),
      array(
        'label'       => esc_html__( 'Footer Link Color', 'bronx' ),
        'id'          => 'footer_link_color',
        'type'        => 'link_color',
        'class'				=> 'ot-colorpicker-opacity',
        'desc'        => esc_html__( 'You can modify the footer link color here', 'bronx' ),
        'section'     => 'customization'
      ),
      array(
        'label'       => esc_html__( 'Sub-Footer Link Color', 'bronx' ),
        'id'          => 'subfooter_link_color',
        'type'        => 'link_color',
        'class'				=> 'ot-colorpicker-opacity',
        'desc'        => esc_html__( 'You can modify the sub-footer link color here', 'bronx' ),
        'section'     => 'customization'
      ),
	  	array(
        'id'          => 'customization_tab4',
        'label'       => esc_html__( 'Badge Colors', 'bronx' ),
        'type'        => 'tab',
        'section'     => 'customization'
      ),
      array(
        'label'       => esc_html__( 'Just Arrived Badge Color', 'bronx' ),
        'id'          => 'badge_justarrived',
        'type'        => 'colorpicker',
        'desc'        => esc_html__( 'You can change the just arrived badge color from here', 'bronx' ),
        'section'     => 'customization',
        'std'		  => ''
      ),
	  	array(
        'label'       => esc_html__( 'On Sale Badge Color', 'bronx' ),
        'id'          => 'badge_sale',
        'type'        => 'colorpicker',
        'desc'        => esc_html__( 'You can change the on sale badge color from here', 'bronx' ),
        'section'     => 'customization',
        'std'		  => ''
      ),
	  	array(
        'label'       => esc_html__( 'Out of Stock Badge Color', 'bronx' ),
        'id'          => 'badge_outofstock',
        'type'        => 'colorpicker',
        'desc'        => esc_html__( 'You can change the out of stock badge color from here', 'bronx' ),
        'section'     => 'customization',
        'std'		  => ''
      ),
      array(
        'id'          => 'customization_tab5',
        'label'       => esc_html__( 'Backgrounds', 'bronx' ),
        'type'        => 'tab',
        'section'     => 'customization'
      ),
      array(
        'label'       => esc_html__( 'Sub-Header Background', 'bronx' ),
        'id'          => 'subheader_bg',
        'type'        => 'background',
        'desc'        => esc_html__( 'Background settings for the sub-header', 'bronx' ),
        'section'     => 'customization'
      ),
      array(
        'label'       => esc_html__( 'Subscribe Background', 'bronx' ),
        'id'          => 'subscribe_bg',
        'type'        => 'background',
        'desc'        => esc_html__( 'Background settings for the subscribe area', 'bronx' ),
        'section'     => 'customization'
      ),
      array(
        'label'       => esc_html__( 'Footer Background', 'bronx' ),
        'id'          => 'footer_bg',
        'type'        => 'background',
        'desc'        => esc_html__( 'Background settings for the footer.', 'bronx' ),
        'section'     => 'customization'
      ),
      array(
        'label'       => esc_html__( 'Sub-Footer Background', 'bronx' ),
        'id'          => 'subfooter_bg',
        'type'        => 'background',
        'desc'        => esc_html__( 'Background settings for the sub-footer.', 'bronx' ),
        'section'     => 'customization'
      ),
      array(
        'id'          => 'customization_tab6',
        'label'       => esc_html__( 'Other', 'bronx' ),
        'type'        => 'tab',
        'section'     => 'customization'
      ),
      array(
        'label'       => esc_html__( 'Custom 404 Page', 'bronx' ),
        'id'          => '404_page_content',
        'type'        => 'page-select',
        'desc'        => esc_html__( 'This allows you to override default 404 page and show a custom page.', 'bronx' ),
        'section'     => 'customization'
      ),
      array(
        'id'          => 'footer_tab0',
        'label'       => esc_html__( 'Footer Settings', 'bronx' ),
        'type'        => 'tab',
        'section'     => 'footer'
      ),
      array(
        'label'       => esc_html__( 'Display Newsletter Subscription Area?', 'bronx' ),
        'id'          => 'footer_newsletter',
        'type'        => 'on_off',
        'desc'        => __('Would you like to display the Newsletter form? <br/><br/><a href="?thb_download_emails=true" class="button button-primary">Download Emails</a>', 'bronx' ),
        'std'         => 'on',
        'section'     => 'footer'
      ),
      array(
        'label'       => esc_html__( 'Display Footer', 'bronx' ),
        'id'          => 'footer',
        'type'        => 'on_off',
        'desc'        => esc_html__( 'Would you like to display the Footer?', 'bronx' ),
        'std'         => 'on',
        'section'     => 'footer'
      ),
      array(
        'label'       => esc_html__( 'Footer Columns', 'bronx' ),
        'id'          => 'footer_columns',
        'type'        => 'radio-image',
        'desc'        => esc_html__( 'You can change the layout of footer columns here', 'bronx' ),
        'std'         => 'fourcolumns',
        'section'     => 'footer'
      ),
      array(
        'label'       => esc_html__( 'Footer Color', 'bronx' ),
        'id'          => 'footer_color',
        'type'        => 'radio-image',
        'desc'        => esc_html__( 'You can choose your footer color here. You can also change your footer background from "Customization"', 'bronx' ),
        'std'         => 'light',
        'section'     => 'footer'
      ),
      array(
        'id'          => 'footer_tab1',
        'label'       => esc_html__( 'Sub-Footer', 'bronx' ),
        'type'        => 'tab',
        'section'     => 'footer'
      ),
	  	array(
	  	  'label'       => esc_html__( 'Display Sub-Footer', 'bronx' ),
	  	  'id'          => 'subfooter',
	  	  'type'        => 'on_off',
	  	  'desc'        => esc_html__( 'Would you like to display the Sub-Footer?', 'bronx' ),
	  	  'std'         => 'on',
	  	  'section'     => 'footer'
	  	),
	  	array(
    	  'label'       => esc_html__( 'Display Social Icons or Payment Methods?', 'bronx' ),
    	  'id'          => 'social-payment',
    	  'type'        => 'radio',
    	  'desc'        => esc_html__( 'Would you like to display social or payment methods on the right side of the footer?', 'bronx' ),
    	  'choices'     => array(
    	    array(
    	      'label'       => esc_html__( 'Social Icons', 'bronx' ),
    	      'value'       => 'social'
    	    ),
    	    array(
    	      'label'       => esc_html__( 'Payment Icons', 'bronx' ),
    	      'value'       => 'payment'
    	    )
    	  ),
    	  'std'         => 'payment',
    	  'section'     => 'footer'
    	),
      array(
        'label'       => esc_html__( 'Copyright Text', 'bronx' ),
        'id'          => 'copyright',
        'type'        => 'text',
        'desc'        => esc_html__( 'Copyright Text at the bottom left', 'bronx' ),
        'section'     => 'footer'
      ),
      array(
        'id'          => 'footer_tab2',
        'label'       => esc_html__( 'Sub-Footer Social Icons', 'bronx' ),
        'type'        => 'tab',
        'section'     => 'footer'
      ),
      array(
        'label'       => esc_html__( 'Facebook Link', 'bronx' ),
        'id'          => 'fb_link',
        'type'        => 'text',
        'desc'        => esc_html__( 'Facebook profile/page link', 'bronx' ),
        'section'     => 'footer'
      ),
      array(
        'label'       => esc_html__( 'Pinterest Link', 'bronx' ),
        'id'          => 'pinterest_link',
        'type'        => 'text',
        'desc'        => esc_html__( 'Pinterest profile/page link', 'bronx' ),
        'section'     => 'footer'
      ),
      array(
        'label'       => esc_html__( 'Twitter Link', 'bronx' ),
        'id'          => 'twitter_link',
        'type'        => 'text',
        'desc'        => esc_html__( 'Twitter profile/page link', 'bronx' ),
        'section'     => 'footer'
      ),
      array(
        'label'       => esc_html__( 'Google Plus Link', 'bronx' ),
        'id'          => 'googleplus_link',
        'type'        => 'text',
        'desc'        => esc_html__( 'Google Plus profile/page link', 'bronx' ),
        'section'     => 'footer'
      ),
      array(
        'label'       => esc_html__( 'Linkedin Link', 'bronx' ),
        'id'          => 'linkedin_link',
        'type'        => 'text',
        'desc'        => esc_html__( 'Linkedin profile/page link', 'bronx' ),
        'section'     => 'footer'
      ),
      array(
        'label'       => esc_html__( 'Instagram Link', 'bronx' ),
        'id'          => 'instragram_link',
        'type'        => 'text',
        'desc'        => esc_html__( 'Instagram profile/page link', 'bronx' ),
        'section'     => 'footer'
      ),
      array(
        'label'       => esc_html__( 'Xing Link', 'bronx' ),
        'id'          => 'xing_link',
        'type'        => 'text',
        'desc'        => esc_html__( 'Xing profile/page link', 'bronx' ),
        'section'     => 'footer'
      ),
      array(
        'label'       => esc_html__( 'Tumblr Link', 'bronx' ),
        'id'          => 'tumblr_link',
        'type'        => 'text',
        'desc'        => esc_html__( 'Tumblr profile/page link', 'bronx' ),
        'section'     => 'footer'
      ),
      array(
        'label'       => esc_html__( 'Vkontakte Link', 'bronx' ),
        'id'          => 'vk_link',
        'type'        => 'text',
        'desc'        => esc_html__( 'Vkontakte profile/page link', 'bronx' ),
        'section'     => 'footer'
      ),
      array(
        'label'       => esc_html__( 'SoundCloud Link', 'bronx' ),
        'id'          => 'soundcloud_link',
        'type'        => 'text',
        'desc'        => esc_html__( 'SoundCloud profile/page link', 'bronx' ),
        'section'     => 'footer'
      ),
      array(
        'label'       => esc_html__( 'Dribbble Link', 'bronx' ),
        'id'          => 'dribbble_link',
        'type'        => 'text',
        'desc'        => esc_html__( 'Dribbbble profile/page link', 'bronx' ),
        'section'     => 'footer'
      ),
      array(
        'label'       => esc_html__( 'YouTube Link', 'bronx' ),
        'id'          => 'youtube_link',
        'type'        => 'text',
        'desc'        => esc_html__( 'Youtube profile/page link', 'bronx' ),
        'section'     => 'footer'
      ),
      array(
        'label'       => esc_html__( 'Spotify Link', 'bronx' ),
        'id'          => 'spotify_link',
        'type'        => 'text',
        'desc'        => esc_html__( 'Spotify profile/page link', 'bronx' ),
        'section'     => 'footer'
      ),
      array(
        'label'       => esc_html__( 'Behance Link', 'bronx' ),
        'id'          => 'behance_link',
        'type'        => 'text',
        'desc'        => esc_html__( 'Behance profile/page link', 'bronx' ),
        'section'     => 'footer'
      ),
      array(
        'label'       => esc_html__( 'DeviantArt Link', 'bronx' ),
        'id'          => 'deviantart_link',
        'type'        => 'text',
        'desc'        => esc_html__( 'DeviantArt profile/page link', 'bronx' ),
        'section'     => 'footer'
      ),
      array(
        'id'          => 'footer_tab3',
        'label'       => esc_html__( 'Sub-Footer Payment Icons', 'bronx' ),
        'type'        => 'tab',
        'section'     => 'footer'
      ),
      array(
        'label'       => esc_html__( 'Visa', 'bronx' ),
        'id'          => 'payment_visa',
        'type'        => 'on_off',
        'desc'        => esc_html__( 'Would you like to display Visa logo?', 'bronx' ),
        'section'     => 'footer',
        'std'         => 'on'
      ),
      array(
        'label'       => esc_html__( 'MasterCard', 'bronx' ),
        'id'          => 'payment_mc',
        'type'        => 'on_off',
        'desc'        => esc_html__( 'Would you like to display MasterCard logo?', 'bronx' ),
        'section'     => 'footer',
        'std'         => 'on'
      ),
      array(
        'label'       => esc_html__( 'PayPal', 'bronx' ),
        'id'          => 'payment_pp',
        'type'        => 'on_off',
        'desc'        => esc_html__( 'Would you like to display PayPal logo?', 'bronx' ),
        'section'     => 'footer',
        'std'         => 'on'
      ),
      array(
        'label'       => esc_html__( 'Discover', 'bronx' ),
        'id'          => 'payment_discover',
        'type'        => 'on_off',
        'desc'        => esc_html__( 'Would you like to display Discover logo?', 'bronx' ),
        'section'     => 'footer',
        'std'         => 'on'
      ),
      array(
        'label'       => esc_html__( 'Amazon Payments', 'bronx' ),
        'id'          => 'payment_amazon',
        'type'        => 'on_off',
        'desc'        => esc_html__( 'Would you like to display Amazon Payments logo?', 'bronx' ),
        'section'     => 'footer',
        'std'         => 'on'
      ),
      array(
        'label'       => esc_html__( 'Stripe', 'bronx' ),
        'id'          => 'payment_stripe',
        'type'        => 'on_off',
        'desc'        => esc_html__( 'Would you like to display Stripe logo?', 'bronx' ),
        'section'     => 'footer',
        'std'         => 'on'
      ),
      array(
        'label'       => esc_html__( 'American Express', 'bronx' ),
        'id'          => 'payment_amex',
        'type'        => 'on_off',
        'desc'        => esc_html__( 'Would you like to display American Express logo?', 'bronx' ),
        'section'     => 'footer',
        'std'         => 'on'
      ),
      array(
        'label'       => esc_html__( 'Diners Club', 'bronx' ),
        'id'          => 'payment_diners',
        'type'        => 'on_off',
        'desc'        => esc_html__( 'Would you like to display Diners Club logo?', 'bronx' ),
        'section'     => 'footer',
        'std'         => 'on'
      ),
      array(
        'label'       => esc_html__( 'Google Wallet', 'bronx' ),
        'id'          => 'payment_wallet',
        'type'        => 'on_off',
        'desc'        => esc_html__( 'Would you like to display Google Wallet logo?', 'bronx' ),
        'section'     => 'footer',
        'std'         => 'on'
      ),
      array(
        'label'       => esc_html__( 'Apple Pay', 'bronx' ),
        'id'          => 'payment_applepay',
        'type'        => 'on_off',
        'desc'        => esc_html__( 'Would you like to display Apple Pay logo?', 'bronx' ),
        'section'     => 'footer',
        'std'         => 'on'
      ),
      array(
        'id'          => 'footer_tab5',
        'label'       => esc_html__( 'Measurements', 'bronx' ),
        'type'        => 'tab',
        'section'     => 'footer'
      ),
      array(
        'label'       => esc_html__( 'Footer Padding', 'bronx' ),
        'id'          => 'footer_padding',
        'type'        => 'spacing',
        'desc'        => esc_html__( 'You can modify the footer padding here', 'bronx' ),
        'section'     => 'footer'
      ),
      array(
        'label'       => esc_html__( 'Sub-Footer Padding', 'bronx' ),
        'id'          => 'subfooter_padding',
        'type'        => 'spacing',
        'desc'        => esc_html__( 'You can modify the subfooter padding here', 'bronx' ),
        'section'     => 'footer'
      ),
      array(
        'id'          => 'contact_text',
        'label'       => esc_html__( 'About Google Map Settings', 'bronx' ),
        'desc'        => esc_html__( 'These settings will be used for the map added by the Google Map Visual Composer element.', 'bronx' ),
        'std'         => '',
        'type'        => 'textblock',
        'section'     => 'contact'
      ),
      array(
        'label'       => esc_html__( 'Google Maps API Key', 'bronx' ),
        'id'          => 'map_api_key',
        'type'        => 'text',
        'desc'        => esc_html__( 'Please enter the Google Maps Api Key. <small>You need to create a browser API key. For more information, please visit: <a href="https://developers.google.com/maps/documentation/javascript/get-api-key">https://developers.google.com/maps/documentation/javascript/get-api-key</a></small>', 'bronx' ),
        'section'     => 'contact'
      ),
      array(
        'label'       => esc_html__( 'Map Style', 'bronx' ),
        'id'          => 'contact_map_style',
        'type'        => 'radio',
        'desc'        => esc_html__( 'You can select different color settings for the map here', 'bronx' ),
        'choices'     => array(
          array(
            'label'       => esc_html__( 'No Style', 'bronx' ),
            'value'       => '0'
          ),
          array(
            'label'       => esc_html__( 'Paper', 'bronx' ),
            'value'       => '1'
          ),
          array(
            'label'       => esc_html__( 'Light Monochrome', 'bronx' ),
            'value'       => '2'
          ),
          array(
            'label'       => esc_html__( 'Subtle', 'bronx' ),
            'value'       => '3'
          ),
          array(
            'label'       => esc_html__( 'Cool Grey', 'bronx' ),
            'value'       => '4'
          ),
          array(
            'label'       => esc_html__( 'Bentley', 'bronx' ),
            'value'       => '5'
          ),
          array(
            'label'       => esc_html__( 'Icy Blue', 'bronx' ),
            'value'       => '6'
          ),
          array(
            'label'       => esc_html__( 'Turquoise Water', 'bronx' ),
            'value'       => '7'
          ),
          array(
            'label'       => esc_html__( 'Blue', 'bronx' ),
            'value'       => '8'
          ),
        	array(
            'label'       => esc_html__( 'Shades of Grey', 'bronx' ),
            'value'       => '9'
          ),
        	array(
            'label'       => esc_html__( 'Girly', 'bronx' ),
            'value'       => '10'
          ),
          array(
            'label'       => esc_html__( 'Green and blue (Default)', 'bronx' ),
            'value'       => '11'
          ),

        ),
        'std'         => '11',
        'section'     => 'contact'
      ),
      array(
      	'label'       => esc_html__( 'Map Zoom Amount', 'bronx' ),
        'id'          => 'contact_zoom',
        'desc'        => esc_html__( 'Value should be between 1-18, 1 being the entire earth and 18 being right at street level.', 'bronx' ),
        'std'         => '17',
        'type'        => 'numeric-slider',
        'section'     => 'contact',
        'min_max_step'=> '1,18,1'
      ),
      array(
        'label'       => esc_html__( 'Map Pin Image', 'bronx' ),
        'id'          => 'map_pin_image',
        'type'        => 'upload',
        'desc'        => esc_html__( 'If you would like to use your own pin, you can upload it here', 'bronx' ),
        'section'     => 'contact'
      ),
      array(
        'label'       => esc_html__( 'Map Center Latitude', 'bronx' ),
        'id'          => 'map_center_lat',
        'type'        => 'text',
        'desc'        => esc_html__( 'Please enter the latitude for the maps center point. <small>You can get lat-long coordinates using <a href="http://www.latlong.net/convert-address-to-lat-long.html" target="_blank">Latlong.net</a></small>', 'bronx' ),
        'section'     => 'contact'
      ),
      array(
        'label'       => esc_html__( 'Map Center Longtitude', 'bronx' ),
        'id'          => 'map_center_long',
        'type'        => 'text',
        'desc'        => esc_html__( 'Please enter the longitude for the maps center point.', 'bronx' ),
        'section'     => 'contact'
      ),
      array(
        'label'       => esc_html__( 'Google Map Pin Locations', 'bronx' ),
        'id'          => 'map_locations',
        'type'        => 'list-item',
        'desc'        => esc_html__( 'Coordinates to shop on the map', 'bronx' ),
        'settings'    => array(
          array(
            'label'       => esc_html__( 'Coordinates', 'bronx' ),
            'id'          => 'lat_long',
            'type'        => 'text',
            'desc'        => esc_html__( 'Coordinates of this location separated by comma. <small>You can get lat-long coordinates using <a href="http://www.latlong.net/convert-address-to-lat-long.html" target="_blank">Latlong.net</a></small>', 'bronx' ),
            'rows'        => '1'
          ),
          array(
            'label'       => esc_html__( 'Location Image', 'bronx' ),
            'id'          => 'image',
            'type'        => 'upload',
            'desc'        => esc_html__( 'You can upload your own location image here. Suggested image size is 110x115', 'bronx' )
          ),
          array(
            'label'       => esc_html__( 'Information', 'bronx' ),
            'id'          => 'information',
            'type'        => 'textarea',
            'desc'        => esc_html__( 'This content appears below the title of the tooltip', 'bronx' ),
            'rows'        => '2',
          ),
        ),
        'section'     => 'contact'
      )
    )
  );

  /* settings are not the same update the DB */
  if ( $saved_settings !== $custom_settings ) {
    update_option( 'option_tree_settings', $custom_settings );
  }
}
// Add bronx Slider select option
function add_revslider_select_type( $array ) {
  $array['revslider-select'] = 'Bronx Slider Select';
  return $array;
}
add_filter( 'ot_option_types_array', 'add_revslider_select_type' );

// Show bronxSlider select option
function ot_type_revslider_select( $args = array() ) {
  extract( $args );
  $has_desc = $field_desc ? true : false;
  echo '<div class="format-setting type-revslider-select ' . ( $has_desc ? 'has-desc' : 'no-desc' ) . '">';
  if ( $has_desc ) { echo '<div class="description">' . wp_kses_post( wp_specialchars_decode( $field_desc ) ) . '</div>'; }
    echo '<div class="format-setting-inner">';
    // Add This only if RevSlider is Activated
    if ( class_exists( 'RevSliderAdmin' ) ) {
      echo '<select name="' . esc_attr( $field_name ) . '" id="' . esc_attr( $field_id ) . '" class="option-tree-ui-select ' . $field_class . '">';

      /* get bronx array */
      $slider = new RevSlider();
      $arrSliders = $slider->getArrSlidersShort();

      /* has slides */
      if ( ! empty( $arrSliders ) ) {
        echo '<option value="">-- ' . esc_html__( 'Choose One', 'bronx' ) . ' --</option>';
        foreach ( $arrSliders as $rev_id => $rev_slider ) {
          echo '<option value="' . esc_attr( $rev_id ) . '"' . selected( $field_value, $rev_id, false ) . '>' . esc_attr( $rev_slider ) . '</option>';
        }
      } else {
        echo '<option value="">' . esc_html__( 'No Sliders Found', 'bronx' ) . '</option>';
      }
      echo '</select>';
    } else {
        echo '<span style="color: red;">' . esc_html__( 'Sorry! bronx Slider is not Installed or Activated', 'bronx' ). '</span>';
    }
    echo '</div>';
  echo '</div>';
}
/**
 * Product Category Checkbox option type.
 *
 * See @ot_display_by_type to see the full list of available arguments.
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     2.0
 */
if ( ! function_exists( 'ot_type_product_category_checkbox' ) ) {

  function ot_type_product_category_checkbox( $args = array() ) {

    /* turns arguments array into variables */
    extract( $args );

    /* verify a description */
    $has_desc = $field_desc ? true : false;

    /* format setting outer wrapper */
    echo '<div class="format-setting type-category-checkbox type-checkbox ' . ( $has_desc ? 'has-desc' : 'no-desc' ) . '">';

      /* description */
      if ( $has_desc ) { echo '<div class="description">' . wp_kses_post( wp_specialchars_decode( $field_desc ) ) . '</div>'; }

      /* format setting inner wrapper */
      echo '<div class="format-setting-inner">';

        /* get category array */

		$args = array(
			'orderby'    => 'name',
			'order'      => 'ASC',
			'hide_empty' => '0'
		);

		$categories = get_terms( apply_filters( 'ot_type_category_checkbox_query', 'product_cat', $args, $field_id ) );

        /* build categories */
        if ( ! empty( $categories ) ) {
          foreach ( $categories as $category ) {
            echo '<p>';
              echo '<input type="checkbox" name="' . esc_attr( $field_name ) . '[' . esc_attr( $category->term_id ) . ']" id="' . esc_attr( $field_id ) . '-' . esc_attr( $category->term_id ) . '" value="' . esc_attr( $category->term_id ) . '" ' . ( isset( $field_value[$category->term_id] ) ? checked( $field_value[$category->term_id], $category->term_id, false ) : '' ) . ' class="option-tree-ui-checkbox ' . esc_attr( $field_class ) . '" />';
              echo '<label for="' . esc_attr( $field_id ) . '-' . esc_attr( $category->term_id ) . '">' . esc_attr( $category->name ) . '</label>';
            echo '</p>';
          }
        } else {
          echo '<p>' . esc_html__( 'No Product Categories Found', 'bronx' ) . '</p>';
        }

      echo '</div>';

    echo '</div>';

  }

}
/**
 * Menu Select option type.
 *
 * See @ot_display_by_type to see the full list of available arguments.
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     2.0
 */
if ( ! function_exists( 'ot_type_menu_select' ) ) {

  function ot_type_menu_select( $args = array() ) {

    /* turns arguments array into variables */
    extract( $args );

    /* verify a description */
    $has_desc = $field_desc ? true : false;

    /* format setting outer wrapper */
    echo '<div class="format-setting type-category-select ' . ( $has_desc ? 'has-desc' : 'no-desc' ) . '">';

      /* description */
      if ( $has_desc ) { echo '<div class="description">' . wp_kses_post( wp_specialchars_decode( $field_desc ) ) . '</div>'; }

      /* format setting inner wrapper */
      echo '<div class="format-setting-inner">';

        /* build category */
        echo '<select name="' . esc_attr( $field_name ) . '" id="' . esc_attr( $field_id ) . '" class="option-tree-ui-select ' . $field_class . '">';

        /* get category array */
        $menus = get_terms( 'nav_menu');

        /* has cats */
        if ( ! empty( $menus ) ) {
          echo '<option value="">-- ' . esc_html__( 'Choose One', 'bronx' ) . ' --</option>';
          foreach ( $menus as $menu ) {
            echo '<option value="' . esc_attr( $menu->slug ) . '"' . selected( $field_value, $menu->slug, false ) . '>' . esc_attr( $menu->name ) . '</option>';
          }
        } else {
          echo '<option value="">' . esc_html__( 'No Menus Found', 'bronx' ) . '</option>';
        }

        echo '</select>';

      echo '</div>';

    echo '</div>';

  }

}