<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://www.redefiningtheweb.com
 * @since      1.0.0
 *
 * @package    Rtwwwap_Wp_Wc_Affiliate_Program
 * @subpackage Rtwwwap_Wp_Wc_Affiliate_Program/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Rtwwwap_Wp_Wc_Affiliate_Program
 * @subpackage Rtwwwap_Wp_Wc_Affiliate_Program/public
 * @author     RedefiningTheWeb <developer@redefiningtheweb.com>
 */
class Rtwwwap_Wp_Wc_Affiliate_Program_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $rtwwwap_plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $rtwwwap_version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $rtwwwap_plugin_name       The name of the plugin.
	 * @param      string    $rtwwwap_version    The version of this plugin.
	 */
	public function __construct( $rtwwwap_plugin_name, $rtwwwap_version ) {

		$rtwwwap_verification_done = get_option( 'rtwwwap_verification_done', array() );
		$rtwwwap_verification_done_status = isset($rtwwwap_verification_done['status']) ? $rtwwwap_verification_done['status'] : false;
		$rtwwwap_verification_done_purchase = isset($rtwwwap_verification_done['purchase_code']) ? $rtwwwap_verification_done['purchase_code'] : false;
		if( empty( $rtwwwap_verification_done ) || $rtwwwap_verification_done_status == false || empty($rtwwwap_verification_done_purchase) )
		{
			return;
		}
		$this->rtwwwap_plugin_name 	= $rtwwwap_plugin_name;
		$this->rtwwwap_version 		= $rtwwwap_version;

		add_shortcode( 'rtwwwap_affiliate_page', array( $this, 'rtwwwap_affiliate_page_callback') );

		add_shortcode( 'rtwwwap_aff_reg_page', array( $this, 'rtwwwap_aff_reg_page_callback') );

		add_shortcode( 'rtwwwap_aff_login_page', array( $this, 'rtwwwap_aff_login_page_callback') );

		add_shortcode( 'rtwwwap_aff_reset_password', array( $this, 'rtwwwap_aff_reset_password_page_callback') );

		
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function rtwwwap_enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Rtwwwap_Wp_Wc_Affiliate_Program_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Rtwwwap_Wp_Wc_Affiliate_Program_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->rtwwwap_plugin_name, plugin_dir_url( __FILE__ ) . 'css/rtwwwap-wp-wc-affiliate-program-public.css', array(), $this->rtwwwap_version, 'all' );
		wp_enqueue_style( "select2", RTWWWAP_URL. '/assets/Datatables/css/rtwwwap-wp-select2.min.css', array(), $this->rtwwwap_version, 'all' );
		$rtwwwap_verification_done = get_option( 'rtwwwap_verification_done', array() );
		$rtwwwap_verification_done_status = isset($rtwwwap_verification_done['status']) ? $rtwwwap_verification_done['status'] : false;
		$rtwwwap_verification_done_purchase = isset($rtwwwap_verification_done['purchase_code']) ? $rtwwwap_verification_done['purchase_code'] : false;
		if( empty( $rtwwwap_verification_done ) || $rtwwwap_verification_done_status == false || empty($rtwwwap_verification_done_purchase) )
		{
			return;
		}
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_style( $this->rtwwwap_plugin_name, plugin_dir_url( __FILE__ ) . 'css/jquery.modal.css', array(), $this->rtwwwap_version, 'all' );

		
		wp_enqueue_style( "datatable", RTWWWAP_URL. '/assets/Datatables/css/jquery.dataTables.min.css', array(), $this->rtwwwap_version, 'all' );
		wp_enqueue_style( "orgchart", RTWWWAP_URL. '/assets/orgChart/jquery.orgchart.css', array(), $this->rtwwwap_version, 'all' );
		wp_enqueue_style('font-awesome', 'https://pro.fontawesome.com/releases/v5.1.0/css/all.css');

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function rtwwwap_enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Rtwwwap_Wp_Wc_Affiliate_Program_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Rtwwwap_Wp_Wc_Affiliate_Program_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( "datatable", RTWWWAP_URL. '/assets/Datatables/js/jquery.dataTables.min.js', array( 'jquery' ), $this->rtwwwap_version, false );

		wp_enqueue_script( "select2", RTWWWAP_URL. '/assets/Datatables/js/rtwwwap-wp-select2.min.js', array( 'jquery' ), $this->rtwwwap_version, true );

		wp_enqueue_script( 'iris', admin_url( 'js/iris.min.js' ), array( 'jquery-ui-draggable', 'jquery-ui-slider', 'jquery-touch-punch' ), $this->rtwwwap_version, true );

		wp_enqueue_script( "blockUI", RTWWWAP_URL. '/assets/Datatables/js/rtwwwap-wp-blockui.js', array( 'jquery' ), $this->rtwwwap_version, false );

		wp_enqueue_script( 'wp-color-picker', admin_url( 'js/color-picker.min.js' ), array( 'iris' ), $this->rtwwwap_version, true );

		$rtwwwap_colorpicker_l10n = array(
	        'clear' 		=> esc_html__( 'Clear' ),
	        'defaultString' => esc_html__( 'Default' ),
	        'pick' 			=> esc_html__( 'Select Color' ),
	        'current' 		=> esc_html__( 'Current Color' )
	    );
		$rtwwwap_verification_done = get_option( 'rtwwwap_verification_done', array() );
		$rtwwwap_verification_done_status = isset($rtwwwap_verification_done['status']) ? $rtwwwap_verification_done['status'] : false;
		$rtwwwap_verification_done_purchase = isset($rtwwwap_verification_done['purchase_code']) ? $rtwwwap_verification_done['purchase_code'] : false;
		if( empty( $rtwwwap_verification_done ) || $rtwwwap_verification_done_status == false || empty($rtwwwap_verification_done_purchase) )
		{
			return;
		}
	  	wp_localize_script( 'wp-color-picker', 'wpColorPickerL10n', $rtwwwap_colorpicker_l10n );

		wp_enqueue_script( 'rtwwap-modal', plugin_dir_url( __FILE__ ) . 'js/jquery.modal.js', array('jquery', 'jquery-ui-accordion'), $this->rtwwwap_version, true );
		//for model		
		wp_register_script( $this->rtwwwap_plugin_name, plugin_dir_url( __FILE__ ) . 'js/rtwwwap-wp-wc-affiliate-program-public.js', array( 'jquery', 'jquery-ui-accordion' ), $this->rtwwwap_version, true );

		
		$rtwwwap_ajax_nonce 		= wp_create_nonce( "rtwwwap-ajax-security-string" );
		$rtwwwap_whatsapp_device 	= esc_url( 'https://web.whatsapp.com/send?text=' );
		if( wp_is_mobile() ){
			$rtwwwap_whatsapp_device= 'whatsapp://send?text=';
		}
		$rtwwwap_translation_array 	= array(
										'rtwwwap_ajaxurl' 		=> esc_url(admin_url( 'admin-ajax.php' )),
										'rtwwwap_nonce' 		=> $rtwwwap_ajax_nonce,
										'rtwwwap_copy_script' 	=> esc_html__( 'Copy Script', 'rtwwwap-wp-wc-affiliate-program' ),
										'rtwwwap_copy_html' 	=> esc_html__( 'Copy Html', 'rtwwwap-wp-wc-affiliate-program' ),
										'rtwwwap_buy_now' 		=> esc_html__( 'Buy Now', 'rtwwwap-wp-wc-affiliate-program' ),
										'rtwwwap_preview' 		=> esc_html__( 'Preview', 'rtwwwap-wp-wc-affiliate-program' ),
										'rtwwwap_list_price' 	=> esc_html__( 'List Price', 'rtwwwap-wp-wc-affiliate-program' ),
										'rtwwwap_our_price' 	=> esc_html__( 'Our Price', 'rtwwwap-wp-wc-affiliate-program' ),
										'rtwwwap_text_color' 	=> esc_html__( 'Text Color', 'rtwwwap-wp-wc-affiliate-program' ),
										'rtwwwap_link_color' 	=> esc_html__( 'Link Color', 'rtwwwap-wp-wc-affiliate-program' ),
										'rtwwwap_background_color' => esc_html__( 'Background Color', 'rtwwwap-wp-wc-affiliate-program' ),
										'rtwwwap_show_price' 	=> esc_html__( 'Show Price', 'rtwwwap-wp-wc-affiliate-program' ),
										'rtwwwap_border_color' 	=> esc_html__( 'Border Color', 'rtwwwap-wp-wc-affiliate-program' ),
										'rtwwwap_home_url' 		=> esc_url( home_url() ),
										'rtwwwap_enter_valid_url' => esc_html__( 'Enter valid Link', 'rtwwwap-wp-wc-affiliate-program' ),
										'rtwwwap_twitter_url' 	=> esc_url( 'https://twitter.com/intent/tweet?text=' ),
										'rtwwwap_mail_url' 		=> esc_url( 'mailto:enteryour@addresshere.com?subject=Click on this link &body=Check%20this%20out:' ),
										'rtwwwap_fb_url' 		=> esc_url( 'https://www.facebook.com/sharer/sharer.php?u=' ),
										'rtwwwap_whatsapp_url' 	=> $rtwwwap_whatsapp_device,
										'rtwwwap_valid_coupon_less_msg' => esc_html__( 'Coupon amount must be greater than', 'rtwwwap-wp-wc-affiliate-program' ),
										'rtwwwap_valid_coupon_more_msg' => esc_html__( 'Coupon amount must be less than', 'rtwwwap-wp-wc-affiliate-program' ),
										'rtwwwap_copied' 		=> esc_html__( 'Copied', 'rtwwwap-wp-wc-affiliate-program' ),
										'rtwwwap_mlm_user_activate' 	=> esc_html__( 'Activate', 'rtwwwap-wp-wc-affiliate-program' ),
										'rtwwwap_mlm_user_deactivate' 	=> esc_html__( 'Deactivate', 'rtwwwap-wp-wc-affiliate-program' ),
										'rtwwwap_disabled' 	=> esc_html__( 'Disabled', 'rtwwwap-wp-wc-affiliate-program' ),
										'rtwwwap_enabled' 	=> esc_html__( 'Enabled', 'rtwwwap-wp-wc-affiliate-program' ),
										'rtwwwap_parent' 	=> esc_html__( 'Parent', 'rtwwwap-wp-wc-affiliate-program' ),
										'rtwwwap_rqst_sure' => esc_html__( 'Are you sure to send the request?', 'rtwwwap-wp-wc-affiliate-program' ),
										'rtwwwap_add_rqst_msg' => esc_html__( 'Please write a message', 'rtwwwap-wp-wc-affiliate-program' )
									);
		wp_localize_script( $this->rtwwwap_plugin_name, 'rtwwwap_global_params', $rtwwwap_translation_array );
		wp_enqueue_script( $this->rtwwwap_plugin_name );

		wp_enqueue_script( "qrcode", RTWWWAP_URL. '/assets/QrCodeJs/qrcode.min.js', array( 'jquery' ), $this->rtwwwap_version, false );
		wp_enqueue_script( "orgchart", RTWWWAP_URL. '/assets/orgChart/jquery.orgchart.js', array( 'jquery' ), $this->rtwwwap_version, false );
		wp_register_script( 'FontAwesome', 'https://use.fontawesome.com/releases/v5.0.2/js/all.js', null, null, true );
	}


	/*
	* function to show under WooCommerce Account
	*/
	function rtwwwap_add_account_menu_item_endpoint(){
		$rtwwwap_verification_done = get_option( 'rtwwwap_verification_done', array() );
		$rtwwwap_verification_done_status = isset($rtwwwap_verification_done['status']) ? $rtwwwap_verification_done['status'] : false;
		$rtwwwap_verification_done_purchase = isset($rtwwwap_verification_done['purchase_code']) ? $rtwwwap_verification_done['purchase_code'] : false;
		if( empty( $rtwwwap_verification_done ) || $rtwwwap_verification_done_status == false || empty($rtwwwap_verification_done_purchase) )
		{
			return;
		}
		add_rewrite_endpoint( 'rtwwwap_affiliate_menu', EP_PAGES );
	}

	/*
	* function to show under WooCommerce Account
	*/
	function rtwwwap_add_account_menu_item( $rtwwwap_menu_links ){
		$rtwwwap_verification_done = get_option( 'rtwwwap_verification_done', array() );
		$rtwwwap_verification_done_status = isset($rtwwwap_verification_done['status']) ? $rtwwwap_verification_done['status'] : false;
		$rtwwwap_verification_done_purchase = isset($rtwwwap_verification_done['purchase_code']) ? $rtwwwap_verification_done['purchase_code'] : false;
		if( empty( $rtwwwap_verification_done ) || $rtwwwap_verification_done_status == false || empty($rtwwwap_verification_done_purchase) )
		{
			return;
		}
		$rtwwwap_new = array( 'rtwwwap_affiliate_menu' => esc_html__( 'Affiliate', 'rtwwwap-wp-wc-affiliate-program' ) );

		$rtwwwap_menu_links = array_slice( $rtwwwap_menu_links, 0, 1, true )
		+ $rtwwwap_new
		+ array_slice( $rtwwwap_menu_links, 1, NULL, true );

		return $rtwwwap_menu_links;
	}

	/*
	*
	*/
	function rtwwwap_add_account_menu_item_endpoint_content( $rtwwwap_url, $rtwwwap_endpoint ){
		$rtwwwap_verification_done = get_option( 'rtwwwap_verification_done', array() );
		$rtwwwap_verification_done_status = isset($rtwwwap_verification_done['status']) ? $rtwwwap_verification_done['status'] : false;
		$rtwwwap_verification_done_purchase = isset($rtwwwap_verification_done['purchase_code']) ? $rtwwwap_verification_done['purchase_code'] : false;
		if( empty( $rtwwwap_verification_done ) || $rtwwwap_verification_done_status == false || empty($rtwwwap_verification_done_purchase) )
		{
			return;
		}
		if( $rtwwwap_endpoint === 'rtwwwap_affiliate_menu' )
		{
			$rtwwwap_page_id = get_option( 'rtwwwap_affiliate_page_id' );

			if( $rtwwwap_page_id ){
				$rtwwwap_url = get_the_permalink( $rtwwwap_page_id );
				return esc_url( $rtwwwap_url.'?rtwwwap_tab=overview' );
			}
		}
		return $rtwwwap_url;
	}

	/**
	 * This function is for front end user to become affiliate
	 */
	function rtwwwap_become_affiliate_callback()
	{
		$rtwwwap_verification_done = get_option( 'rtwwwap_verification_done', array() );
		$rtwwwap_verification_done_status = isset($rtwwwap_verification_done['status']) ? $rtwwwap_verification_done['status'] : false;
		$rtwwwap_verification_done_purchase = isset($rtwwwap_verification_done['purchase_code']) ? $rtwwwap_verification_done['purchase_code'] : false;
		if( empty( $rtwwwap_verification_done ) || $rtwwwap_verification_done_status == false || empty($rtwwwap_verification_done_purchase) )
		{
			return;
		}
		$rtwwwap_check_ajax = check_ajax_referer( 'rtwwwap-ajax-security-string', 'rtwwwap_security_check' );

		if ( $rtwwwap_check_ajax ) {
			$rtwwwap_user_id 	= sanitize_text_field( $_POST[ 'rtwwwap_user_id' ] );
			$rtwwwap_updated 	= update_user_meta( $rtwwwap_user_id, 'rtwwwap_affiliate', 1 );
			$rtwwwap_extra_features = get_option( 'rtwwwap_extra_features_opt' );
			$rtwwwap_aff_approved 	= isset( $rtwwwap_extra_features[ 'aff_verify' ] ) ? $rtwwwap_extra_features[ 'aff_verify' ] : 0;

			if( $rtwwwap_aff_approved == 0 ){
				update_user_meta( $rtwwwap_user_id, 'rtwwwap_aff_approved', 1 );

				$rtwwwap_mlm = get_option( 'rtwwwap_mlm_opt' );
				if( isset( $rtwwwap_mlm[ 'activate' ] ) && $rtwwwap_mlm[ 'activate' ] == 1 )
				{
					global $wpdb;
					//check if already in MLM chain
					$rtwwwap_already_a_child = $wpdb->get_var( $wpdb->prepare( "SELECT `id` FROM ".$wpdb->prefix."rtwwwap_mlm WHERE `aff_id` = %d", $rtwwwap_user_id ) );

					if( is_null( $rtwwwap_already_a_child  ) ){
						$rtwwwap_allowed_childs = isset( $rtwwwap_mlm[ 'child' ] ) ? $rtwwwap_mlm[ 'child' ] : 1;

						$rtwwwap_parent_id = $wpdb->get_var( $wpdb->prepare( "SELECT `aff_id` FROM ".$wpdb->prefix."rtwwwap_referrals WHERE `signed_up_id` = %d", $rtwwwap_user_id ) );

						if( $rtwwwap_parent_id ){
							$rtwwwap_current_childs = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT( `id` ) FROM ".$wpdb->prefix."rtwwwap_mlm WHERE `parent_id` = %d", $rtwwwap_parent_id ) );

							if( $rtwwwap_allowed_childs > $rtwwwap_current_childs ){
								$rtwwwap_updated = 	$wpdb->insert(
											            $wpdb->prefix.'rtwwwap_mlm',
											            array(
											                'aff_id'    	=> $rtwwwap_user_id,
											                'parent_id'    	=> $rtwwwap_parent_id,
											                'status'    	=> 1,
											                'last_activity'	=> '0000-00-00 00:00:00',
											                'added_date'    => date( 'Y-m-d H:i:s' )
											            )
											        );
							}
							else{
								$rtwwwap_get_first_child = $wpdb->get_results( $wpdb->prepare( "SELECT `aff_id` FROM ".$wpdb->prefix."rtwwwap_mlm WHERE `parent_id` = %d ORDER BY `added_date` ASC", $rtwwwap_parent_id ), ARRAY_A );

								foreach( $rtwwwap_get_first_child as $rtwwwap_child_key => $rtwwwap_child_value )
								{
									$rtwwwap_childs_child = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT( `id` ) FROM ".$wpdb->prefix."rtwwwap_mlm WHERE `parent_id` = %d", $rtwwwap_child_value[ 'aff_id' ] ) );

									if( $rtwwwap_allowed_childs > $rtwwwap_childs_child )
									{
										$rtwwwap_child_to_get_child = $rtwwwap_child_value[ 'aff_id' ];
										break;
									}
								}

								$rtwwwap_updated = 	$wpdb->insert(
											            $wpdb->prefix.'rtwwwap_mlm',
											            array(
											                'aff_id'    	=> $rtwwwap_user_id,
											                'parent_id'    	=> $rtwwwap_child_to_get_child,
											                'status'    	=> 1,
											                'last_activity'	=> '0000-00-00 00:00:00',
											                'added_date'    => date( 'Y-m-d H:i:s' )
											            )
											        );
							}
						}
					}
				}
			}
			if( $rtwwwap_aff_approved == 1 ){
				update_user_meta( $rtwwwap_user_id, 'rtwwwap_aff_approved', 0 );
			}

			if( $rtwwwap_updated ){
				$rtwwwap_message = esc_html__( 'You are now an affiliate', 'rtwwwap-wp-wc-affiliate-program' );
			}
			else{
				$rtwwwap_message = esc_html__( 'Something went wrong', 'rtwwwap-wp-wc-affiliate-program' );
			}

			echo json_encode( array( 'rtwwwap_status' => $rtwwwap_updated, 'rtwwwap_message' => $rtwwwap_message ) );
			die;
		}
	}

	/*
	* To show affiliate page with shortcode
	*/
	function rtwwwap_affiliate_page_callback(){
		$rtwwwap_verification_done = get_option( 'rtwwwap_verification_done', array() );
		$rtwwwap_verification_done_status = isset($rtwwwap_verification_done['status']) ? $rtwwwap_verification_done['status'] : false;
		$rtwwwap_verification_done_purchase = isset($rtwwwap_verification_done['purchase_code']) ? $rtwwwap_verification_done['purchase_code'] : false;
		if( empty( $rtwwwap_verification_done ) || $rtwwwap_verification_done_status == false || empty($rtwwwap_verification_done_purchase) )
		{
			return;
		}
		$rtwwwap_html = include( RTWWWAP_DIR.'public/templates/rtwwwap_affiliate.php' );
		return $rtwwwap_html;
	}

	/*
	* Creates cookie when a affiliate URL is opened
	*/
	function rtwwwap_url_check(){
		$rtwwwap_verification_done = get_option( 'rtwwwap_verification_done', array() );
		$rtwwwap_verification_done_status = isset($rtwwwap_verification_done['status']) ? $rtwwwap_verification_done['status'] : false;
		$rtwwwap_verification_done_purchase = isset($rtwwwap_verification_done['purchase_code']) ? $rtwwwap_verification_done['purchase_code'] : false;
		if( empty( $rtwwwap_verification_done ) || $rtwwwap_verification_done_status == false || empty($rtwwwap_verification_done_purchase) )
		{
			return;
		}
		if( isset( $_GET[ 'rtwwwap_aff' ] ) ){
			$rtwwwap_aff 			= explode( '_', $_GET[ 'rtwwwap_aff' ] );
			$rtwwwap_affiliate_id 	= $rtwwwap_aff[1];
			$rtwwwap_aff_share 		= isset( $rtwwwap_aff[2] ) ? $rtwwwap_aff[2] : 0;

			if( get_user_meta( $rtwwwap_affiliate_id, 'rtwwwap_affiliate', true ) ){
				$rtwwwap_commission_settings 	= get_option( 'rtwwwap_commission_settings_opt' );
				$rtwwwap_commission_type 		= isset( $rtwwwap_commission_settings[ 'only_open_url' ] ) ? $rtwwwap_commission_settings[ 'only_open_url' ] : 0;

				//lifetime
				$rtwwwap_unlimit_comm = isset( $rtwwwap_commission_settings[ 'unlimit_comm' ] ) ? $rtwwwap_commission_settings[ 'unlimit_comm' ] : '0';

				if( $rtwwwap_unlimit_comm == '1' ){
					$rtwwwap_current_user_id = get_current_user_id();

					if( $rtwwwap_current_user_id ){
						$rtwwwap_override_unlimit_user_id = isset( $rtwwwap_commission_settings[ 'override_unlimit_comm' ] ) ? $rtwwwap_commission_settings[ 'override_unlimit_comm' ] : '0';

						if( $rtwwwap_override_unlimit_user_id == '1' ){
							update_user_meta( $rtwwwap_current_user_id, 'rtwwwap_lifetime_user_id', $rtwwwap_affiliate_id );
						}
						else{
							$rtwwwap_if_unlimit = get_user_meta( $rtwwwap_current_user_id, 'rtwwwap_lifetime_user_id', true );
							if( !$rtwwwap_if_unlimit ){
								update_user_meta( $rtwwwap_current_user_id, 'rtwwwap_lifetime_user_id', $rtwwwap_affiliate_id );
							}
						}
					}
				}

				$rtwwwap_prod_id 	= get_the_ID();
				$rtwwwap_cookie_arr = array( "rtwwwap_aff_id" => $rtwwwap_affiliate_id );

				$rtwwwap_extra_features = get_option( 'rtwwwap_extra_features_opt' );
				$rtwwwap_cookie_time 	= isset( $rtwwwap_extra_features[ 'cookie_time' ] ) ? $rtwwwap_extra_features[ 'cookie_time' ] : 0;

				if( $rtwwwap_cookie_time ){
					$rtwwwap_cookie_time = time()+( $rtwwwap_cookie_time * 24 * 60 * 60 );
				}

				if( $rtwwwap_commission_type == 1 ){
					if ( get_post_type( $rtwwwap_prod_id ) == 'product' ) {
						$rtwwwap_cookie_arr[ "rtwwwap_prod_id" ] = $rtwwwap_prod_id;
					}
				}

				if( $rtwwwap_aff_share ){
					$rtwwwap_cookie_arr[ 'share' ] = 'share';
				}

				if( isset( $_COOKIE[ 'rtwwwap_referral' ] ) ){
					unset( $_COOKIE[ 'rtwwwap_referral' ] );
				}

				$rtwwwap_cookie_value = implode( '#', $rtwwwap_cookie_arr );
				setcookie( 'rtwwwap_referral', $rtwwwap_cookie_value, $rtwwwap_cookie_time, '/' );
			}
		}
	}

	/*
	* Creates cookie when a affiliate URL is opened for easy digital downloads 
	*/

	function rtwwwap_url_check_edd(){
		
		$rtwwwap_verification_done = get_option( 'rtwwwap_verification_done', array() );
		$rtwwwap_verification_done_status = isset($rtwwwap_verification_done['status']) ? $rtwwwap_verification_done['status'] : false;
		$rtwwwap_verification_done_purchase = isset($rtwwwap_verification_done['purchase_code']) ? $rtwwwap_verification_done['purchase_code'] : false;
		if( empty( $rtwwwap_verification_done ) || $rtwwwap_verification_done_status == false || empty($rtwwwap_verification_done_purchase) )
		{
			return;
		}
		if( isset( $_GET[ 'rtwwwap_aff' ] ) ){
			$rtwwwap_aff 			= explode( '_', $_GET[ 'rtwwwap_aff' ] );
			$rtwwwap_affiliate_id 	= $rtwwwap_aff[1];
			$rtwwwap_aff_share 		= isset( $rtwwwap_aff[2] ) ? $rtwwwap_aff[2] : 0;

			if( get_user_meta( $rtwwwap_affiliate_id, 'rtwwwap_affiliate', true ) ){
				$rtwwwap_commission_settings 	= get_option( 'rtwwwap_commission_settings_opt' );
				$rtwwwap_commission_type 		= isset( $rtwwwap_commission_settings[ 'only_open_url' ] ) ? $rtwwwap_commission_settings[ 'only_open_url' ] : 0;
				
				//lifetime
				$rtwwwap_unlimit_comm = isset( $rtwwwap_commission_settings[ 'unlimit_comm' ] ) ? $rtwwwap_commission_settings[ 'unlimit_comm' ] : '0';

				if( $rtwwwap_unlimit_comm == '1' ){
					$rtwwwap_current_user_id = get_current_user_id();
					if( $rtwwwap_current_user_id ){

						$rtwwwap_override_unlimit_user_id = isset( $rtwwwap_commission_settings[ 'override_unlimit_comm' ] ) ? $rtwwwap_commission_settings[ 'override_unlimit_comm' ] : '0';

						if( $rtwwwap_override_unlimit_user_id == '1' ){
							update_user_meta( $rtwwwap_current_user_id, 'rtwwwap_lifetime_user_id' , $rtwwwap_affiliate_id );
						}
						else{
							$rtwwwap_if_unlimit = get_user_meta( $rtwwwap_current_user_id, 'rtwwwap_lifetime_user_id', true );
							if( !$rtwwwap_if_unlimit ){
								update_user_meta( $rtwwwap_current_user_id, 'rtwwwap_lifetime_user_id', $rtwwwap_affiliate_id );
							}
						}
					}
				}

				$rtwwwap_prod_id 	= get_the_ID();
				$rtwwwap_cookie_arr = array( "rtwwwap_aff_id" => $rtwwwap_affiliate_id );
					
				$rtwwwap_extra_features = get_option( 'rtwwwap_extra_features_opt' );
				$rtwwwap_cookie_time 	= isset( $rtwwwap_extra_features[ 'cookie_time' ] ) ? $rtwwwap_extra_features[ 'cookie_time' ] : 0 ;
				

			
				if( $rtwwwap_cookie_time ){
					$rtwwwap_cookie_time = time()+( $rtwwwap_cookie_time * 24 * 60 * 60 );
					
				}
				
				if( $rtwwwap_commission_type == 1 ){
					
					if ( get_post_type( $rtwwwap_prod_id ) == 'download' ) {

						$rtwwwap_cookie_arr[ "rtwwwap_prod_id" ] = $rtwwwap_prod_id;
						
					}
				}

				if( $rtwwwap_aff_share ){
					$rtwwwap_cookie_arr[ 'share' ] = 'share';
				}

				if( isset( $_COOKIE[ 'rtwwwap_referral' ] ) ){
					unset( $_COOKIE[ 'rtwwwap_referral' ] );
				}
				
				$rtwwwap_cookie_value = implode( '#', $rtwwwap_cookie_arr );
				setcookie( 'rtwwwap_referral', $rtwwwap_cookie_value, (int)$rtwwwap_cookie_time, '/' );
				
			}
		}
			
	}

	/*
	* To create successful referral
	*/
	function rtwwwap_referred_item_ordered( $rtwwwap_order_id ){ 
		$rtwwwap_verification_done = get_option( 'rtwwwap_verification_done', array() );
		$rtwwwap_verification_done_status = isset($rtwwwap_verification_done['status']) ? $rtwwwap_verification_done['status'] : false;
		$rtwwwap_verification_done_purchase = isset($rtwwwap_verification_done['purchase_code']) ? $rtwwwap_verification_done['purchase_code'] : false;
		if( empty( $rtwwwap_verification_done ) || $rtwwwap_verification_done_status == false || empty($rtwwwap_verification_done_purchase) )
		{
			return;
		}
		//referral code
		$rtwwwap_extra_features 	= get_option( 'rtwwwap_extra_features_opt' );
		$rtwwwap_signup_bonus_type 	= isset( $rtwwwap_extra_features[ 'signup_bonus_type' ] ) ? esc_html( $rtwwwap_extra_features[ 'signup_bonus_type' ] ) : 0;

		//mlm
		$rtwwwap_mlm 		= get_option( 'rtwwwap_mlm_opt' );
		$rtwwwap_mlm_active	= isset( $rtwwwap_mlm[ 'activate' ] ) ? $rtwwwap_mlm[ 'activate' ] : 0;

		//lifetime
		$rtwwwap_commission_settings = get_option( 'rtwwwap_commission_settings_opt' );
		$rtwwwap_unlimit_comm = isset( $rtwwwap_commission_settings[ 'unlimit_comm' ] ) ? $rtwwwap_commission_settings[ 'unlimit_comm' ] : '0';

		if( $rtwwwap_signup_bonus_type == 1 && $rtwwwap_mlm_active ){
			$this->rtwwwap_referral_code_comm( $rtwwwap_order_id );
		}
		elseif( isset( $_COOKIE[ 'rtwwwap_referral' ] ) || $rtwwwap_unlimit_comm == 1 )
		{
			global $wpdb;
			$rtwwwap_referrer_id = 0;
			if( $rtwwwap_unlimit_comm == '1' ){
				$rtwwwap_current_user_id = get_current_user_id();

				if( $rtwwwap_current_user_id ){
					$rtwwwap_referrer_id = get_user_meta( $rtwwwap_current_user_id, 'rtwwwap_lifetime_user_id', true );
					if( !$rtwwwap_referrer_id )
					{
						$rtwwwap_referral 	= explode( '#', $_COOKIE[ 'rtwwwap_referral' ] );
						$rtwwwap_affiliate_id 			= esc_html( $rtwwwap_referral[ 0 ] );
						update_user_meta( $rtwwwap_current_user_id, 'rtwwwap_lifetime_user_id', $rtwwwap_affiliate_id );
						$rtwwwap_referrer_id = $rtwwwap_affiliate_id;
					}
				}
			}

			if( $rtwwwap_referrer_id ){
				$this->rtwwwap_unlimited_reff_comm( $rtwwwap_order_id, $rtwwwap_referrer_id );
			}
			elseif( isset( $_COOKIE[ 'rtwwwap_referral' ] ) ){
				$rtwwwap_referral 	= explode( '#', $_COOKIE[ 'rtwwwap_referral' ] );
				$rtwwwap_order 		= wc_get_order( $rtwwwap_order_id );
				$rtwwwap_comm_base 	= isset( $rtwwwap_commission_settings[ 'comm_base' ] ) ? $rtwwwap_commission_settings[ 'comm_base' ] : '1';
				$rtwwwap_total_commission	= 0;
				$rtwwwap_aff_prod_details 	= array();
				$rtwwwap_user_id 			= esc_html( $rtwwwap_referral[ 0 ] );

				if( RTWWWAP_IS_WOO == 1 ){
					$rtwwwap_currency 		= get_woocommerce_currency();
					$rtwwwap_currency_sym 	= get_woocommerce_currency_symbol();
				}
				else{
					require_once( RTWWWAP_DIR.'includes/rtwaffiliatehelper.php' );

					$rtwwwap_extra_features = get_option( 'rtwwwap_extra_features_opt' );
					$rtwwwap_currency 		= isset( $rtwwwap_extra_features[ 'currency' ] ) ? $rtwwwap_extra_features[ 'currency' ] : 'USD';
					$rtwwwap_curr_obj 		= new RtwAffiliateHelper();
					$rtwwwap_currency_sym 	= $rtwwwap_curr_obj->rtwwwap_curr_symbol( $rtwwwap_currency );
				}

				$rtwwwap_commission_type 	= isset( $rtwwwap_commission_settings[ 'only_open_url' ] ) ? $rtwwwap_commission_settings[ 'only_open_url' ] : 0;
				$rtwwwap_shared 			= strpos( $_COOKIE[ 'rtwwwap_referral' ], 'share' );
				$rtwwwap_product_url 		= false;

				if( $rtwwwap_comm_base == 1 ){
					$rtwwwap_per_prod_mode 			= isset( $rtwwwap_commission_settings[ 'per_prod_mode' ] ) ? $rtwwwap_commission_settings[ 'per_prod_mode' ] : 0;
					$rtwwwap_all_commission 		= isset( $rtwwwap_commission_settings[ 'all_commission' ] ) ? $rtwwwap_commission_settings[ 'all_commission' ] : 0;
					$rtwwwap_all_commission_type 	= isset( $rtwwwap_commission_settings[ 'all_commission_type' ] ) ? $rtwwwap_commission_settings[ 'all_commission_type' ] : 'percentage';
					$rtwwwap_per_cat 				= isset( $rtwwwap_commission_settings[ 'per_cat' ] ) ? $rtwwwap_commission_settings[ 'per_cat' ] : array();

					foreach( $rtwwwap_order->get_items() as $rtwwwap_item_key => $rtwwwap_item_values )
					{
						$rtwwwap_prod_comm 		= '';
						$rtwwwap_product_id 	= $rtwwwap_item_values->get_product_id();
						$rtwwwap_product_price	= $rtwwwap_item_values->get_total();
						$rtwwwap_product_terms 	= get_the_terms( $rtwwwap_product_id, 'product_cat' );
						$rtwwwap_product_cat_id = $rtwwwap_product_terms[0]->term_id;

						if( $rtwwwap_commission_type == 1 && array_key_exists( 1, $rtwwwap_referral ) && ( $rtwwwap_product_id == $rtwwwap_referral[ 1 ] ) )
						{
							$rtwwwap_product_url = true;
							if( $rtwwwap_per_prod_mode == 1 ){
								$rtwwwap_prod_per_comm = get_post_meta( $rtwwwap_product_id, 'rtwwwap_percentage_commission_box', true );

								if( $rtwwwap_prod_per_comm > 0 ){
									$rtwwwap_prod_comm = ( $rtwwwap_product_price * $rtwwwap_prod_per_comm ) / 100;
									$rtwwwap_aff_prod_details[] = array(
							    					'product_id' 		=> $rtwwwap_product_id,
							    					'product_price' 	=> $rtwwwap_product_price,
							    					'commission_fix' 	=> '',
							    					'commission_perc' 	=> $rtwwwap_prod_per_comm,
							    					'prod_commission' 	=> $rtwwwap_prod_comm
							    				);

						    		$rtwwwap_total_commission += $rtwwwap_prod_comm;
								}
								elseif( $rtwwwap_prod_per_comm === '0' ){
									// no commission needs to be generated for this product
								}
								else{
									if( !empty( $rtwwwap_per_cat ) ){
										$rtwwwap_cat_per_comm = 0;
										$rtwwwap_cat_fix_comm = 0;
										$rtwwwap_flag = false;
										foreach( $rtwwwap_per_cat as $rtwwwap_key => $rtwwwap_value ){
											if( in_array( $rtwwwap_product_cat_id, $rtwwwap_value[ 'ids' ] ) ){
												$rtwwwap_cat_per_comm = $rtwwwap_value[ 'cat_percentage_commission' ];
												$rtwwwap_cat_fix_comm = $rtwwwap_value[ 'cat_fixed_commission' ];
												$rtwwwap_flag = true;

												break;
											}
										}
										if( $rtwwwap_flag ){
											if( $rtwwwap_cat_per_comm > 0 ){
												$rtwwwap_prod_comm += ( $rtwwwap_product_price * $rtwwwap_cat_per_comm ) / 100;
											}
											if( $rtwwwap_cat_fix_comm > 0 ){
												$rtwwwap_prod_comm += $rtwwwap_cat_fix_comm;
											}

											if( $rtwwwap_prod_comm != '' ){
												$rtwwwap_aff_prod_details[] = array(
									    					'product_id' 		=> $rtwwwap_product_id,
									    					'product_price' 	=> $rtwwwap_product_price,
									    					'commission_fix' 	=> $rtwwwap_cat_fix_comm,
									    					'commission_perc' 	=> $rtwwwap_cat_per_comm,
									    					'prod_commission' 	=> $rtwwwap_prod_comm
									    				);

								    			$rtwwwap_total_commission += $rtwwwap_prod_comm;
								    		}
										}
										else{
											if( $rtwwwap_all_commission ){
												if( $rtwwwap_all_commission_type == 'percentage' ){
													$rtwwwap_prod_comm += ( $rtwwwap_product_price * $rtwwwap_all_commission ) / 100;
												}
												elseif( $rtwwwap_all_commission_type == 'fixed' ){
													$rtwwwap_prod_comm += $rtwwwap_all_commission;
												}
												$rtwwwap_aff_prod_details[] = array(
									    					'product_id' 		=> $rtwwwap_product_id,
									    					'product_price' 	=> $rtwwwap_product_price,
									    					'commission_fix' 	=> '',
									    					'commission_perc' 	=> '',
									    					'prod_commission' 	=> $rtwwwap_prod_comm
									    				);

								    			$rtwwwap_total_commission += $rtwwwap_prod_comm;
								    		}
										}
									}
									else{
										if( $rtwwwap_all_commission ){
											if( $rtwwwap_all_commission_type == 'percentage' ){
												$rtwwwap_prod_comm += ( $rtwwwap_product_price * $rtwwwap_all_commission ) / 100;
											}
											elseif( $rtwwwap_all_commission_type == 'fixed' ){
												$rtwwwap_prod_comm += $rtwwwap_all_commission;
											}
											$rtwwwap_aff_prod_details[] = array(
								    					'product_id' 		=> $rtwwwap_product_id,
								    					'product_price' 	=> $rtwwwap_product_price,
								    					'commission_fix' 	=> '',
									    				'commission_perc' 	=> '',
								    					'prod_commission' 	=> $rtwwwap_prod_comm
								    				);

							    			$rtwwwap_total_commission += $rtwwwap_prod_comm;
							    		}
									}
								}
							}
							elseif( $rtwwwap_per_prod_mode == 2 ){
								$rtwwwap_prod_fix_comm = get_post_meta( $rtwwwap_product_id, 'rtwwwap_fixed_commission_box', true );

								if( $rtwwwap_prod_fix_comm > 0 ){
									$rtwwwap_prod_comm = $rtwwwap_prod_fix_comm;
									$rtwwwap_aff_prod_details[] = array(
							    					'product_id' 		=> $rtwwwap_product_id,
							    					'product_price' 	=> $rtwwwap_product_price,
							    					'commission_fix' 	=> $rtwwwap_prod_fix_comm,
							    					'commission_perc' 	=> '',
							    					'prod_commission' 	=> $rtwwwap_prod_comm
							    				);

						    		$rtwwwap_total_commission += $rtwwwap_prod_comm;
								}
								elseif( $rtwwwap_prod_fix_comm === '0' ){
									// no commission needs to be generated for this product
								}
								else{
									if( !empty( $rtwwwap_per_cat ) ){
										$rtwwwap_cat_per_comm = 0;
										$rtwwwap_cat_fix_comm = 0;
										$rtwwwap_flag = false;
										foreach( $rtwwwap_per_cat as $rtwwwap_key => $rtwwwap_value ){
											if( in_array( $rtwwwap_product_cat_id, $rtwwwap_value[ 'ids' ] ) ){
												$rtwwwap_cat_per_comm = $rtwwwap_value[ 'cat_percentage_commission' ];
												$rtwwwap_cat_fix_comm = $rtwwwap_value[ 'cat_fixed_commission' ];
												$rtwwwap_flag = true;

												break;
											}
										}
										if( $rtwwwap_flag ){
											if( $rtwwwap_cat_per_comm > 0 ){
												$rtwwwap_prod_comm += ( $rtwwwap_product_price * $rtwwwap_cat_per_comm ) / 100;
											}
											if( $rtwwwap_cat_fix_comm > 0 ){
												$rtwwwap_prod_comm += $rtwwwap_cat_fix_comm;
											}

											if( $rtwwwap_prod_comm != '' ){
												$rtwwwap_aff_prod_details[] = array(
									    					'product_id' 		=> $rtwwwap_product_id,
									    					'product_price' 	=> $rtwwwap_product_price,
									    					'commission_fix' 	=> $rtwwwap_cat_fix_comm,
									    					'commission_perc' 	=> $rtwwwap_cat_per_comm,
									    					'prod_commission' 	=> $rtwwwap_prod_comm
									    				);

								    			$rtwwwap_total_commission += $rtwwwap_prod_comm;
								    		}
										}
										else{
											if( $rtwwwap_all_commission ){
												if( $rtwwwap_all_commission_type == 'percentage' ){
													$rtwwwap_prod_comm += ( $rtwwwap_product_price * $rtwwwap_all_commission ) / 100;
												}
												elseif( $rtwwwap_all_commission_type == 'fixed' ){
													$rtwwwap_prod_comm += $rtwwwap_all_commission;
												}
												$rtwwwap_aff_prod_details[] = array(
									    					'product_id' 		=> $rtwwwap_product_id,
									    					'product_price' 	=> $rtwwwap_product_price,
									    					'commission_fix' 	=> '',
									    					'commission_perc' 	=> '',
									    					'prod_commission' 	=> $rtwwwap_prod_comm
									    				);

								    			$rtwwwap_total_commission += $rtwwwap_prod_comm;
								    		}
										}
									}
									else{
										if( $rtwwwap_all_commission ){
											if( $rtwwwap_all_commission_type == 'percentage' ){
												$rtwwwap_prod_comm += ( $rtwwwap_product_price * $rtwwwap_all_commission ) / 100;
											}
											elseif( $rtwwwap_all_commission_type == 'fixed' ){
												$rtwwwap_prod_comm += $rtwwwap_all_commission;
											}
											$rtwwwap_aff_prod_details[] = array(
								    					'product_id' 		=> $rtwwwap_product_id,
								    					'product_price' 	=> $rtwwwap_product_price,
								    					'commission_fix' 	=> '',
									    				'commission_perc' 	=> '',
								    					'prod_commission' 	=> $rtwwwap_prod_comm
								    				);

							    			$rtwwwap_total_commission += $rtwwwap_prod_comm;
							    		}
									}
								}
							}
							elseif( $rtwwwap_per_prod_mode == 3 ){
								$rtwwwap_prod_per_comm = get_post_meta( $rtwwwap_product_id, 'rtwwwap_percentage_commission_box', true );
								$rtwwwap_prod_fix_comm = get_post_meta( $rtwwwap_product_id, 'rtwwwap_fixed_commission_box', true );

								if( $rtwwwap_prod_per_comm > 0 ){
									$rtwwwap_prod_comm += ( $rtwwwap_product_price * $rtwwwap_prod_per_comm ) / 100;
								}

								if( $rtwwwap_prod_fix_comm > 0 ){
									$rtwwwap_prod_comm += $rtwwwap_prod_fix_comm;
								}

								if( $rtwwwap_prod_comm === '' ){
									if( $rtwwwap_prod_per_comm !== '0' && $rtwwwap_prod_fix_comm !== '0' ){
										if( !empty( $rtwwwap_per_cat ) ){
											$rtwwwap_cat_per_comm = 0;
											$rtwwwap_cat_fix_comm = 0;
											$rtwwwap_flag = false;
											foreach( $rtwwwap_per_cat as $rtwwwap_key => $rtwwwap_value ){
												if( in_array( $rtwwwap_product_cat_id, $rtwwwap_value[ 'ids' ] ) ){
													$rtwwwap_cat_per_comm = $rtwwwap_value[ 'cat_percentage_commission' ];
													$rtwwwap_cat_fix_comm = $rtwwwap_value[ 'cat_fixed_commission' ];
													$rtwwwap_flag = true;

													break;
												}
											}
											if( $rtwwwap_flag ){
												if( $rtwwwap_cat_per_comm > 0 ){
													$rtwwwap_prod_comm += ( $rtwwwap_product_price * $rtwwwap_cat_per_comm ) / 100;
												}
												if( $rtwwwap_cat_fix_comm > 0 ){
													$rtwwwap_prod_comm += $rtwwwap_cat_fix_comm;
												}

												if( $rtwwwap_prod_comm != '' ){
													$rtwwwap_aff_prod_details[] = array(
										    					'product_id' 		=> $rtwwwap_product_id,
										    					'product_price' 	=> $rtwwwap_product_price,
										    					'commission_fix' 	=> $rtwwwap_cat_fix_comm,
										    					'commission_perc' 	=> $rtwwwap_cat_per_comm,
										    					'prod_commission' 	=> $rtwwwap_prod_comm
										    				);

									    			$rtwwwap_total_commission += $rtwwwap_prod_comm;
									    		}
											}
											else{
												if( $rtwwwap_all_commission ){
													if( $rtwwwap_all_commission_type == 'percentage' ){
														$rtwwwap_prod_comm += ( $rtwwwap_product_price * $rtwwwap_all_commission ) / 100;
													}
													elseif( $rtwwwap_all_commission_type == 'fixed' ){
														$rtwwwap_prod_comm += $rtwwwap_all_commission;
													}
													$rtwwwap_aff_prod_details[] = array(
										    					'product_id' 		=> $rtwwwap_product_id,
										    					'product_price' 	=> $rtwwwap_product_price,
										    					'commission_fix' 	=> '',
										    					'commission_perc' 	=> '',
										    					'prod_commission' 	=> $rtwwwap_prod_comm
										    				);

									    			$rtwwwap_total_commission += $rtwwwap_prod_comm;
									    		}
											}
										}
										else{
											if( $rtwwwap_all_commission ){
												if( $rtwwwap_all_commission_type == 'percentage' ){
													$rtwwwap_prod_comm += ( $rtwwwap_product_price * $rtwwwap_all_commission ) / 100;
												}
												elseif( $rtwwwap_all_commission_type == 'fixed' ){
													$rtwwwap_prod_comm += $rtwwwap_all_commission;
												}
												$rtwwwap_aff_prod_details[] = array(
									    					'product_id' 		=> $rtwwwap_product_id,
									    					'product_price' 	=> $rtwwwap_product_price,
									    					'commission_fix' 	=> '',
										    				'commission_perc' 	=> '',
									    					'prod_commission' 	=> $rtwwwap_prod_comm
									    				);

								    			$rtwwwap_total_commission += $rtwwwap_prod_comm;
								    		}
										}
									}
								}
								else{
									$rtwwwap_aff_prod_details[] = array(
						    					'product_id' 		=> $rtwwwap_product_id,
						    					'product_price' 	=> $rtwwwap_product_price,
						    					'commission_fix' 	=> $rtwwwap_prod_fix_comm,
							    				'commission_perc' 	=> $rtwwwap_prod_per_comm,
						    					'prod_commission' 	=> $rtwwwap_prod_comm
						    				);

					    			$rtwwwap_total_commission += $rtwwwap_prod_comm;
								}
							}
							elseif( $rtwwwap_all_commission ){
								if( $rtwwwap_all_commission_type == 'percentage' ){
									$rtwwwap_prod_comm += ( $rtwwwap_product_price * $rtwwwap_all_commission ) / 100;
								}
								elseif( $rtwwwap_all_commission_type == 'fixed' ){
									$rtwwwap_prod_comm += $rtwwwap_all_commission;
								}
								$rtwwwap_aff_prod_details[] = array(
					    					'product_id' 		=> $rtwwwap_product_id,
					    					'product_price' 	=> $rtwwwap_product_price,
					    					'commission_fix' 	=> '',
						    				'commission_perc' 	=> '',
					    					'prod_commission' 	=> $rtwwwap_prod_comm
					    				);

				    			$rtwwwap_total_commission += $rtwwwap_prod_comm;
				    		}
						}
						elseif( $rtwwwap_commission_type == 0 )
						{
						    if( $rtwwwap_per_prod_mode == 1 ){
								$rtwwwap_prod_per_comm = get_post_meta( $rtwwwap_product_id, 'rtwwwap_percentage_commission_box', true );

								if( $rtwwwap_prod_per_comm > 0 ){
									$rtwwwap_prod_comm = ( $rtwwwap_product_price * $rtwwwap_prod_per_comm ) / 100;
									$rtwwwap_aff_prod_details[] = array(
							    					'product_id' 		=> $rtwwwap_product_id,
							    					'product_price' 	=> $rtwwwap_product_price,
							    					'commission_fix' 	=> '',
							    					'commission_perc' 	=> $rtwwwap_prod_per_comm,
							    					'prod_commission' 	=> $rtwwwap_prod_comm
							    				);

						    		$rtwwwap_total_commission += $rtwwwap_prod_comm;
								}
								elseif( $rtwwwap_prod_per_comm === '0' ){
									// no commission needs to be generated for this product
								}
								else{
									if( !empty( $rtwwwap_per_cat ) ){
										$rtwwwap_cat_per_comm = 0;
										$rtwwwap_cat_fix_comm = 0;
										$rtwwwap_flag = false;
										foreach( $rtwwwap_per_cat as $rtwwwap_key => $rtwwwap_value ){
											if( in_array( $rtwwwap_product_cat_id, $rtwwwap_value[ 'ids' ] ) ){
												$rtwwwap_cat_per_comm = $rtwwwap_value[ 'cat_percentage_commission' ];
												$rtwwwap_cat_fix_comm = $rtwwwap_value[ 'cat_fixed_commission' ];
												$rtwwwap_flag = true;

												break;
											}
										}
										if( $rtwwwap_flag ){
											if( $rtwwwap_cat_per_comm > 0 ){
												$rtwwwap_prod_comm = ( $rtwwwap_product_price * $rtwwwap_cat_per_comm ) / 100;
											}
											if( $rtwwwap_cat_fix_comm > 0 ){
												$rtwwwap_prod_comm += $rtwwwap_cat_fix_comm;
											}

											if( $rtwwwap_prod_comm != '' ){
												$rtwwwap_aff_prod_details[] = array(
									    					'product_id' 		=> $rtwwwap_product_id,
									    					'product_price' 	=> $rtwwwap_product_price,
									    					'commission_fix' 	=> $rtwwwap_cat_fix_comm,
									    					'commission_perc' 	=> $rtwwwap_cat_per_comm,
									    					'prod_commission' 	=> $rtwwwap_prod_comm
									    				);

								    			$rtwwwap_total_commission += $rtwwwap_prod_comm;
								    		}
										}
										else{
											if( $rtwwwap_all_commission ){
												if( $rtwwwap_all_commission_type == 'percentage' ){
													$rtwwwap_prod_comm += ( $rtwwwap_product_price * $rtwwwap_all_commission ) / 100;
												}
												elseif( $rtwwwap_all_commission_type == 'fixed' ){
													$rtwwwap_prod_comm += $rtwwwap_all_commission;
												}
												$rtwwwap_aff_prod_details[] = array(
									    					'product_id' 		=> $rtwwwap_product_id,
									    					'product_price' 	=> $rtwwwap_product_price,
									    					'commission_fix' 	=> '',
									    					'commission_perc' 	=> '',
									    					'prod_commission' 	=> $rtwwwap_prod_comm
									    				);

								    			$rtwwwap_total_commission += $rtwwwap_prod_comm;
								    		}
										}
									}
									else{
										if( $rtwwwap_all_commission ){
											if( $rtwwwap_all_commission_type == 'percentage' ){
												$rtwwwap_prod_comm += ( $rtwwwap_product_price * $rtwwwap_all_commission ) / 100;
											}
											elseif( $rtwwwap_all_commission_type == 'fixed' ){
												$rtwwwap_prod_comm += $rtwwwap_all_commission;
											}
											$rtwwwap_aff_prod_details[] = array(
								    					'product_id' 		=> $rtwwwap_product_id,
								    					'product_price' 	=> $rtwwwap_product_price,
								    					'commission_fix' 	=> '',
									    				'commission_perc' 	=> '',
								    					'prod_commission' 	=> $rtwwwap_prod_comm
								    				);

							    			$rtwwwap_total_commission += $rtwwwap_prod_comm;
							    		}
									}
								}
							}
							elseif( $rtwwwap_per_prod_mode == 2 ){
								$rtwwwap_prod_fix_comm = get_post_meta( $rtwwwap_product_id, 'rtwwwap_fixed_commission_box', true );

								if( $rtwwwap_prod_fix_comm > 0 ){
									$rtwwwap_prod_comm = $rtwwwap_prod_fix_comm;
									$rtwwwap_aff_prod_details[] = array(
							    					'product_id' 		=> $rtwwwap_product_id,
							    					'product_price' 	=> $rtwwwap_product_price,
							    					'commission_fix' 	=> $rtwwwap_prod_fix_comm,
							    					'commission_perc' 	=> '',
							    					'prod_commission' 	=> $rtwwwap_prod_comm
							    				);

						    		$rtwwwap_total_commission += $rtwwwap_prod_comm;
								}
								elseif( $rtwwwap_prod_fix_comm === '0' ){
									// no commission needs to be generated for this product
								}
								else{
									if( !empty( $rtwwwap_per_cat ) ){
										$rtwwwap_cat_per_comm = 0;
										$rtwwwap_cat_fix_comm = 0;
										$rtwwwap_flag = false;
										foreach( $rtwwwap_per_cat as $rtwwwap_key => $rtwwwap_value ){
											if( in_array( $rtwwwap_product_cat_id, $rtwwwap_value[ 'ids' ] ) ){
												$rtwwwap_cat_per_comm = $rtwwwap_value[ 'cat_percentage_commission' ];
												$rtwwwap_cat_fix_comm = $rtwwwap_value[ 'cat_fixed_commission' ];
												$rtwwwap_flag = true;

												break;
											}
										}
										if( $rtwwwap_flag ){
											if( $rtwwwap_cat_per_comm > 0 ){
												$rtwwwap_prod_comm = ( $rtwwwap_product_price * $rtwwwap_cat_per_comm ) / 100;
											}
											if( $rtwwwap_cat_fix_comm > 0 ){
												$rtwwwap_prod_comm += $rtwwwap_cat_fix_comm;
											}

											if( $rtwwwap_prod_comm != '' ){
												$rtwwwap_aff_prod_details[] = array(
									    					'product_id' 		=> $rtwwwap_product_id,
									    					'product_price' 	=> $rtwwwap_product_price,
									    					'commission_fix' 	=> $rtwwwap_cat_fix_comm,
									    					'commission_perc' 	=> $rtwwwap_cat_per_comm,
									    					'prod_commission' 	=> $rtwwwap_prod_comm
									    				);

								    			$rtwwwap_total_commission += $rtwwwap_prod_comm;
								    		}
										}
										else{
											if( $rtwwwap_all_commission ){
												if( $rtwwwap_all_commission_type == 'percentage' ){
													$rtwwwap_prod_comm += ( $rtwwwap_product_price * $rtwwwap_all_commission ) / 100;
												}
												elseif( $rtwwwap_all_commission_type == 'fixed' ){
													$rtwwwap_prod_comm += $rtwwwap_all_commission;
												}
												$rtwwwap_aff_prod_details[] = array(
									    					'product_id' 		=> $rtwwwap_product_id,
									    					'product_price' 	=> $rtwwwap_product_price,
									    					'commission_fix' 	=> '',
									    					'commission_perc' 	=> '',
									    					'prod_commission' 	=> $rtwwwap_prod_comm
									    				);

								    			$rtwwwap_total_commission += $rtwwwap_prod_comm;
								    		}
										}
									}
									else{
										if( $rtwwwap_all_commission ){
											if( $rtwwwap_all_commission_type == 'percentage' ){
												$rtwwwap_prod_comm += ( $rtwwwap_product_price * $rtwwwap_all_commission ) / 100;
											}
											elseif( $rtwwwap_all_commission_type == 'fixed' ){
												$rtwwwap_prod_comm += $rtwwwap_all_commission;
											}
											$rtwwwap_aff_prod_details[] = array(
								    					'product_id' 		=> $rtwwwap_product_id,
								    					'product_price' 	=> $rtwwwap_product_price,
								    					'commission_fix' 	=> '',
									    				'commission_perc' 	=> '',
								    					'prod_commission' 	=> $rtwwwap_prod_comm
								    				);

							    			$rtwwwap_total_commission += $rtwwwap_prod_comm;
							    		}
									}
								}
							}
							elseif( $rtwwwap_per_prod_mode == 3 ){
								$rtwwwap_prod_per_comm = get_post_meta( $rtwwwap_product_id, 'rtwwwap_percentage_commission_box', true );
								$rtwwwap_prod_fix_comm = get_post_meta( $rtwwwap_product_id, 'rtwwwap_fixed_commission_box', true );

								if( $rtwwwap_prod_per_comm > 0 ){
									$rtwwwap_prod_comm += ( $rtwwwap_product_price * $rtwwwap_prod_per_comm ) / 100;
								}

								if( $rtwwwap_prod_fix_comm > 0 ){
									$rtwwwap_prod_comm += $rtwwwap_prod_fix_comm;
								}

								if( $rtwwwap_prod_comm === '' ){
									if( $rtwwwap_prod_per_comm !== '0' && $rtwwwap_prod_fix_comm !== '0' ){
										if( !empty( $rtwwwap_per_cat ) ){
											$rtwwwap_cat_per_comm = 0;
											$rtwwwap_cat_fix_comm = 0;
											$rtwwwap_flag = false;
											foreach( $rtwwwap_per_cat as $rtwwwap_key => $rtwwwap_value ){
												if( in_array( $rtwwwap_product_cat_id, $rtwwwap_value[ 'ids' ] ) ){
													$rtwwwap_cat_per_comm = $rtwwwap_value[ 'cat_percentage_commission' ];
													$rtwwwap_cat_fix_comm = $rtwwwap_value[ 'cat_fixed_commission' ];
													$rtwwwap_flag = true;

													break;
												}
											}
											if( $rtwwwap_flag ){
												if( $rtwwwap_cat_per_comm > 0 ){
													$rtwwwap_prod_comm = ( $rtwwwap_product_price * $rtwwwap_cat_per_comm ) / 100;
												}
												if( $rtwwwap_cat_fix_comm > 0 ){
													$rtwwwap_prod_comm += $rtwwwap_cat_fix_comm;
												}

												if( $rtwwwap_prod_comm != '' ){
													$rtwwwap_aff_prod_details[] = array(
										    					'product_id' 		=> $rtwwwap_product_id,
										    					'product_price' 	=> $rtwwwap_product_price,
										    					'commission_fix' 	=> $rtwwwap_cat_fix_comm,
										    					'commission_perc' 	=> $rtwwwap_cat_per_comm,
										    					'prod_commission' 	=> $rtwwwap_prod_comm
										    				);

									    			$rtwwwap_total_commission += $rtwwwap_prod_comm;
									    		}
											}
											else{
												if( $rtwwwap_all_commission ){
													if( $rtwwwap_all_commission_type == 'percentage' ){
														$rtwwwap_prod_comm += ( $rtwwwap_product_price * $rtwwwap_all_commission ) / 100;
													}
													elseif( $rtwwwap_all_commission_type == 'fixed' ){
														$rtwwwap_prod_comm += $rtwwwap_all_commission;
													}
													$rtwwwap_aff_prod_details[] = array(
										    					'product_id' 		=> $rtwwwap_product_id,
										    					'product_price' 	=> $rtwwwap_product_price,
										    					'commission_fix' 	=> '',
										    					'commission_perc' 	=> '',
										    					'prod_commission' 	=> $rtwwwap_prod_comm
										    				);

									    			$rtwwwap_total_commission += $rtwwwap_prod_comm;
									    		}
											}
										}
										else{
											if( $rtwwwap_all_commission ){
												if( $rtwwwap_all_commission_type == 'percentage' ){
													$rtwwwap_prod_comm += ( $rtwwwap_product_price * $rtwwwap_all_commission ) / 100;
												}
												elseif( $rtwwwap_all_commission_type == 'fixed' ){
													$rtwwwap_prod_comm += $rtwwwap_all_commission;
												}
												$rtwwwap_aff_prod_details[] = array(
									    					'product_id' 		=> $rtwwwap_product_id,
									    					'product_price' 	=> $rtwwwap_product_price,
									    					'commission_fix' 	=> '',
										    				'commission_perc' 	=> '',
									    					'prod_commission' 	=> $rtwwwap_prod_comm
									    				);

								    			$rtwwwap_total_commission += $rtwwwap_prod_comm;
								    		}
										}
									}
								}
								else{
									$rtwwwap_aff_prod_details[] = array(
						    					'product_id' 		=> $rtwwwap_product_id,
						    					'product_price' 	=> $rtwwwap_product_price,
						    					'commission_fix' 	=> $rtwwwap_prod_fix_comm,
							    				'commission_perc' 	=> $rtwwwap_prod_per_comm,
						    					'prod_commission' 	=> $rtwwwap_prod_comm
						    				);

					    			$rtwwwap_total_commission += $rtwwwap_prod_comm;
								}
							}
							elseif( $rtwwwap_all_commission ){
								if( $rtwwwap_all_commission_type == 'percentage' ){
									$rtwwwap_prod_comm += ( $rtwwwap_product_price * $rtwwwap_all_commission ) / 100;
								}
								elseif( $rtwwwap_all_commission_type == 'fixed' ){
									$rtwwwap_prod_comm += $rtwwwap_all_commission;
								}
								$rtwwwap_aff_prod_details[] = array(
					    					'product_id' 		=> $rtwwwap_product_id,
					    					'product_price' 	=> $rtwwwap_product_price,
					    					'commission_fix' 	=> '',
						    				'commission_perc' 	=> '',
					    					'prod_commission' 	=> $rtwwwap_prod_comm
					    				);

				    			$rtwwwap_total_commission += $rtwwwap_prod_comm;
				    		}
						}
					}
				}
				else
				{
					$rtwwwap_levels_settings 	= get_option( 'rtwwwap_levels_settings_opt' );
					$rtwwwap_user_level 		= get_user_meta( $rtwwwap_user_id, 'rtwwwap_affiliate_level', true );
					$rtwwwap_user_level 		= ( $rtwwwap_user_level ) ? $rtwwwap_user_level : '0';

					$rtwwwap_user_level_details = isset( $rtwwwap_levels_settings[ $rtwwwap_user_level ] ) ? $rtwwwap_levels_settings[ $rtwwwap_user_level ] : '';

					if( !empty( $rtwwwap_user_level_details ) ){
						$rtwwwap_level_comm_type 		= $rtwwwap_user_level_details[ 'level_commission_type' ];
						$rtwwwap_level_comm_amount 		= $rtwwwap_user_level_details[ 'level_comm_amount' ];
						$rtwwwap_level_criteria_type 	= $rtwwwap_user_level_details[ 'level_criteria_type' ];
						$rtwwwap_level_criteria_val 	= $rtwwwap_user_level_details[ 'level_criteria_val' ];

						foreach( $rtwwwap_order->get_items() as $rtwwwap_item_key => $rtwwwap_item_values )
						{
							$rtwwwap_prod_comm 		= '';
							$rtwwwap_product_id 	= $rtwwwap_item_values->get_product_id();
							$rtwwwap_product_price	= $rtwwwap_item_values->get_total();

							if( $rtwwwap_commission_type == 1 && array_key_exists( 1, $rtwwwap_referral ) && ( $rtwwwap_product_id == $rtwwwap_referral[ 1 ] ) )
							{
								$rtwwwap_product_url = true;
								if( $rtwwwap_level_comm_type == 0 ){
									$rtwwwap_prod_comm = ( $rtwwwap_product_price * $rtwwwap_level_comm_amount ) / 100;
									$rtwwwap_aff_prod_details[] = array(
							    					'product_id' 		=> $rtwwwap_product_id,
							    					'product_price' 	=> $rtwwwap_product_price,
							    					'commission_fix' 	=> 'user',
							    					'commission_perc' 	=> $rtwwwap_level_comm_amount,
							    					'prod_commission' 	=> $rtwwwap_prod_comm
							    				);

						    		$rtwwwap_total_commission += $rtwwwap_prod_comm;
								}
								else{
									$rtwwwap_prod_comm = $rtwwwap_level_comm_amount;
									$rtwwwap_aff_prod_details[] = array(
							    					'product_id' 		=> $rtwwwap_product_id,
							    					'product_price' 	=> $rtwwwap_product_price,
							    					'commission_fix' 	=> $rtwwwap_level_comm_amount,
							    					'commission_perc' 	=> 'user',
							    					'prod_commission' 	=> $rtwwwap_prod_comm
							    				);

						    		$rtwwwap_total_commission += $rtwwwap_prod_comm;
								}
							}
							elseif( $rtwwwap_commission_type == 0 )
							{
								if( $rtwwwap_level_comm_type == 0 ){
									$rtwwwap_prod_comm = ( $rtwwwap_product_price * $rtwwwap_level_comm_amount ) / 100;
									$rtwwwap_aff_prod_details[] = array(
							    					'product_id' 		=> $rtwwwap_product_id,
							    					'product_price' 	=> $rtwwwap_product_price,
							    					'commission_fix' 	=> 'user',
							    					'commission_perc' 	=> $rtwwwap_level_comm_amount,
							    					'prod_commission' 	=> $rtwwwap_prod_comm
							    				);

						    		$rtwwwap_total_commission += $rtwwwap_prod_comm;
								}
								else{
									$rtwwwap_prod_comm = $rtwwwap_level_comm_amount;
									$rtwwwap_aff_prod_details[] = array(
							    					'product_id' 		=> $rtwwwap_product_id,
							    					'product_price' 	=> $rtwwwap_product_price,
							    					'commission_fix' 	=> 'user',
							    					'commission_perc' 	=> $rtwwwap_level_comm_amount,
							    					'prod_commission' 	=> $rtwwwap_prod_comm
							    				);

						    		$rtwwwap_total_commission += $rtwwwap_prod_comm;
								}
							}
						}
					}
				}

				if( isset( $rtwwwap_total_commission ) && $rtwwwap_total_commission !== '' && $rtwwwap_total_commission !== 0 ){
					$rtwwwap_capped 		= 0;
					$rtwwwap_current_year 	= date("Y");
					$rtwwwap_current_month 	= date("m");

					$rtwwwap_commission_settings	= get_option( 'rtwwwap_commission_settings_opt' );
					$rtwwwap_max_comm 				= isset( $rtwwwap_commission_settings[ 'max_commission' ] ) ? $rtwwwap_commission_settings[ 'max_commission' ] : '0';

					if( $rtwwwap_max_comm != 0 )
					{
						$rtwwwap_month_commission 	= $wpdb->get_var( $wpdb->prepare( "SELECT SUM(`amount`) FROM ".$wpdb->prefix."rtwwwap_referrals WHERE YEAR(date)=%d AND MONTH(date)=%d AND `aff_id`=%d", $rtwwwap_current_year, $rtwwwap_current_month, $rtwwwap_user_id ) );
						$rtwwwap_month_commission 	= isset( $rtwwwap_month_commission ) ? $rtwwwap_month_commission : 0;

						if( $rtwwwap_month_commission < $rtwwwap_max_comm ){
							$rtwwwap_this_month_left = $rtwwwap_max_comm - $rtwwwap_month_commission;
							if( $rtwwwap_this_month_left < $rtwwwap_total_commission ){
								$rtwwwap_total_commission = $rtwwwap_this_month_left;
							}
							else{
								$rtwwwap_total_commission = $rtwwwap_total_commission;
							}
						}
						else{
							$rtwwwap_capped = 1;
						}
					}

					// inserting into DB
					if( !empty( $rtwwwap_aff_prod_details ) ){
						if( get_user_meta( $rtwwwap_user_id, 'rtwwwap_referral_mail', true ) == 'on' ){
							$rtwwwap_decimal_places = $rtwwwap_extra_features['decimal_places'].'f';
							$rtwwwap_to 			= get_user_by( 'id', $rtwwwap_user_id );
							$rtwwwap_to 			= esc_html( $rtwwwap_to->user_email );
							$rtwwwap_subject 		= esc_html__( 'One new Referral', 'rtwwwap-wp-wc-affiliate-program' );
							$rtwwwap_message 		= sprintf( '%s %s%01.'.$rtwwwap_decimal_places, esc_html__( 'You got a new referral of amount', 'rtwwwap-wp-wc-affiliate-program' ), $rtwwwap_currency_sym, $rtwwwap_total_commission );
							$rtwwwap_from_name 		= esc_html( get_bloginfo( 'name' ) );
							$rtwwwap_from_email 	= esc_html( get_bloginfo( 'admin_email' ) );

							$rtwwwap_headers[] 		= sprintf( '%s: %s <%s>', esc_html__( 'From', 'rtwwwap-wp-wc-affiliate-program' ), $rtwwwap_from_name, $rtwwwap_from_email );

							// mail to affiliate
							wp_mail( $rtwwwap_to, $rtwwwap_subject, $rtwwwap_message, $rtwwwap_headers );

							if( isset( $rtwwwap_extra_features[ 'mail_to_admin' ] ) && $rtwwwap_extra_features[ 'mail_to_admin' ] == 1 ){
								// mail to admin
								$rtwwwap_message = sprintf( '%s %s%01.'.$rtwwwap_decimal_places, esc_html__( 'Generated a new referral of amount', 'rtwwwap-wp-wc-affiliate-program' ), $rtwwwap_currency_sym, $rtwwwap_total_commission );
								wp_mail( $rtwwwap_from_email, $rtwwwap_subject, $rtwwwap_message, $rtwwwap_headers );
							}
						}

						$rtwwwap_aff_prod_details = json_encode( $rtwwwap_aff_prod_details );
						$rtwwwap_device = ( wp_is_mobile() ) ? 'mobile' : 'desktop';

						$rtwwwap_locale = get_locale();
						setlocale( LC_NUMERIC, $rtwwwap_locale );

						$rtwwwap_updated = $wpdb->insert(
				            $wpdb->prefix.'rtwwwap_referrals',
				            array(
				                'aff_id'    			=> $rtwwwap_user_id,
				                'type'    				=> 0,
				                'order_id'    			=> esc_html( $rtwwwap_order_id ),
				                'date'    				=> date( 'Y-m-d H:i:s' ),
				                'status'    			=> 0,
				                'amount'    			=> $rtwwwap_total_commission,
				                'capped'    			=> esc_html( $rtwwwap_capped ),
				                'currency'    			=> $rtwwwap_currency,
				                'product_details'   	=> $rtwwwap_aff_prod_details,
				                'device'   				=> $rtwwwap_device
				            )
				        );
				        $rtwwwap_lastid = $wpdb->insert_id;

				        if( $rtwwwap_shared !== false ){
				        	$rtwwwap_share_commission = 0;
							$rtwwwap_sharing_bonus 	= isset( $rtwwwap_extra_features[ 'sharing_bonus' ] ) ? $rtwwwap_extra_features[ 'sharing_bonus' ] : 0;

							if( $rtwwwap_sharing_bonus ){
								$rtwwwap_sharing_bonus_time_limit = isset( $rtwwwap_extra_features[ 'sharing_bonus_time_limit' ] ) ? $rtwwwap_extra_features[ 'sharing_bonus_time_limit' ] : 0;

								$rtwwwap_sharing_bonus_amount_limit = isset( $rtwwwap_extra_features[ 'sharing_bonus_amount_limit' ] ) ? $rtwwwap_extra_features[ 'sharing_bonus_amount_limit' ] : 0;


								if( $rtwwwap_sharing_bonus_time_limit == 0 ){
									$rtwwwap_share_commission = $rtwwwap_sharing_bonus;
								}
								elseif( $rtwwwap_sharing_bonus_time_limit == 1 ){
									$rtwwwap_current_day = date( 'Y-m-d' );

									$rtwwwap_daily_old_bonus = $wpdb->get_var( $wpdb->prepare( "SELECT SUM(`amount`) FROM ".$wpdb->prefix."rtwwwap_referrals WHERE DATE(date)=%s AND `aff_id`=%d", $rtwwwap_current_day, $rtwwwap_user_id ) );

									if( $rtwwwap_daily_old_bonus < $rtwwwap_sharing_bonus_amount_limit )
									{
										$rtwwwap_left_amount = $rtwwwap_sharing_bonus_amount_limit - $rtwwwap_daily_old_bonus;

										if( $rtwwwap_left_amount < $rtwwwap_sharing_bonus ){
											$rtwwwap_share_commission = $rtwwwap_left_amount;
										}
										else{
											$rtwwwap_share_commission = $rtwwwap_sharing_bonus;
										}
									}
								}
								elseif( $rtwwwap_sharing_bonus_time_limit == 2 ){
									$rtwwwap_current_week = date('W');

									$rtwwwap_weekly_old_bonus = $wpdb->get_var( $wpdb->prepare( "SELECT SUM(`amount`) FROM ".$wpdb->prefix."rtwwwap_referrals WHERE WEEK(`date`,1)=%d AND `aff_id`=%d", $rtwwwap_current_week, $rtwwwap_user_id ) );

									if( $rtwwwap_weekly_old_bonus < $rtwwwap_sharing_bonus_amount_limit )
									{
										$rtwwwap_left_amount = $rtwwwap_sharing_bonus_amount_limit - $rtwwwap_weekly_old_bonus;

										if( $rtwwwap_left_amount < $rtwwwap_sharing_bonus ){
											$rtwwwap_share_commission = $rtwwwap_left_amount;
										}
										else{
											$rtwwwap_share_commission = $rtwwwap_sharing_bonus;
										}
									}
								}
								elseif( $rtwwwap_sharing_bonus_time_limit == 3 ){
									$rtwwwap_current_month = date('m');

									$rtwwwap_monthly_old_bonus = $wpdb->get_var( $wpdb->prepare( "SELECT SUM(`amount`) FROM ".$wpdb->prefix."rtwwwap_referrals WHERE MONTH(date)=%d AND `aff_id`=%d", $rtwwwap_current_month, $rtwwwap_user_id ) );

									if( $rtwwwap_monthly_old_bonus < $rtwwwap_sharing_bonus_amount_limit )
									{
										$rtwwwap_left_amount = $rtwwwap_sharing_bonus_amount_limit - $rtwwwap_monthly_old_bonus;

										if( $rtwwwap_left_amount < $rtwwwap_sharing_bonus ){
											$rtwwwap_share_commission = $rtwwwap_left_amount;
										}
										else{
											$rtwwwap_share_commission = $rtwwwap_sharing_bonus;
										}
									}
								}

								if( $rtwwwap_commission_type == 1 ){
									if( !$rtwwwap_product_url ){
										$rtwwwap_share_commission = 0;
									}
								}

								if( $rtwwwap_share_commission ){
									$rtwwwap_share_bonus = $wpdb->insert(
							            $wpdb->prefix.'rtwwwap_referrals',
							            array(
							                'aff_id'    			=> $rtwwwap_user_id,
							                'type'    				=> 5,
							                'order_id'    			=> esc_html( $rtwwwap_order_id ),
							                'date'    				=> date( 'Y-m-d H:i:s' ),
							                'status'    			=> 0,
							                'amount'    			=> $rtwwwap_share_commission,
							                'capped'    			=> esc_html( $rtwwwap_capped ),
							                'currency'    			=> $rtwwwap_currency,
							                'product_details'   	=> '',
							                'device'   				=> $rtwwwap_device
							            )
							        );
								}
							}
				        }

				        setlocale( LC_ALL, $rtwwwap_locale );

				        if( $rtwwwap_updated ){
				        	unset( $_COOKIE[ 'rtwwwap_referral' ] );
					        $rtwwwap_referral_noti = get_option( 'rtwwwap_referral_noti' )+1;
					        update_option( 'rtwwwap_referral_noti', $rtwwwap_referral_noti );
						}

						$rtwwwap_mlm = get_option( 'rtwwwap_mlm_opt' );
						if( isset( $rtwwwap_mlm[ 'activate' ] ) && $rtwwwap_mlm[ 'activate' ] == 1 )
						{
							$rtwwwap_child = isset( $rtwwwap_mlm[ 'child' ] ) ? $rtwwwap_mlm[ 'child' ] : 1;
							$rtwwwap_check_have_child = $this->rtwwwap_check_child_in_mlm( $rtwwwap_user_id, $rtwwwap_child );

							if( $rtwwwap_check_have_child ){
								$this->rtwwwap_give_mlm_comm( $rtwwwap_user_id, $rtwwwap_lastid, $rtwwwap_total_commission, $rtwwwap_currency, $rtwwwap_currency_sym, $rtwwwap_device, $rtwwwap_mlm[ 'mlm_levels' ], $rtwwwap_child, $rtwwwap_order_id );
							}
						}
					}
				}
			}
		}
	}

		/*
	* To create successful referral for easy digital downloads 
	*/
	function rtwwwap_referred_item_ordered_easy( $rtwwwap_order_id ){ 
		$rtwwwap_verification_done = get_option( 'rtwwwap_verification_done', array() );
		$rtwwwap_verification_done_status = isset($rtwwwap_verification_done['status']) ? $rtwwwap_verification_done['status'] : false;
		$rtwwwap_verification_done_purchase = isset($rtwwwap_verification_done['purchase_code']) ? $rtwwwap_verification_done['purchase_code'] : false;
		if( empty( $rtwwwap_verification_done ) || $rtwwwap_verification_done_status == false || empty($rtwwwap_verification_done_purchase) )
		{
			return;
		}
		//referral code
		$rtwwwap_extra_features 	= get_option( 'rtwwwap_extra_features_opt' );
		$rtwwwap_signup_bonus_type 	= isset( $rtwwwap_extra_features[ 'signup_bonus_type' ] ) ? esc_html( $rtwwwap_extra_features[ 'signup_bonus_type' ] ) : 0;

		//mlm
		$rtwwwap_mlm 		= get_option( 'rtwwwap_mlm_opt' );
		$rtwwwap_mlm_active	= isset( $rtwwwap_mlm[ 'activate' ] ) ? $rtwwwap_mlm[ 'activate' ] : 0;

		//lifetime
		$rtwwwap_commission_settings = get_option( 'rtwwwap_commission_settings_opt' );
		$rtwwwap_unlimit_comm = isset( $rtwwwap_commission_settings[ 'unlimit_comm' ] ) ? $rtwwwap_commission_settings[ 'unlimit_comm' ] : '0';

		if( $rtwwwap_signup_bonus_type == 1 && $rtwwwap_mlm_active ){
			$this->rtwwwap_referral_code_comm_easy( $rtwwwap_order_id );
		}
		elseif( isset( $_COOKIE[ 'rtwwwap_referral' ] ) || $rtwwwap_unlimit_comm == 1 )
		{
			global $wpdb;
			$rtwwwap_referrer_id = 0;
			if( $rtwwwap_unlimit_comm == '1' ){
				$rtwwwap_current_user_id = get_current_user_id();

				if( $rtwwwap_current_user_id ){
					$rtwwwap_referrer_id = get_user_meta( $rtwwwap_current_user_id, 'rtwwwap_lifetime_user_id', true );
					if( !$rtwwwap_referrer_id )
					{
						$rtwwwap_referral 	= explode( '#', $_COOKIE[ 'rtwwwap_referral' ] );
						$rtwwwap_affiliate_id 			= esc_html( $rtwwwap_referral[ 0 ] );
						update_user_meta( $rtwwwap_current_user_id, 'rtwwwap_lifetime_user_id', $rtwwwap_affiliate_id );
						$rtwwwap_referrer_id = $rtwwwap_affiliate_id;
					}
				}
			}

			if( $rtwwwap_referrer_id ){
				$this->rtwwwap_unlimited_reff_comm_easy( $rtwwwap_order_id, $rtwwwap_referrer_id );
			}
			elseif( isset( $_COOKIE[ 'rtwwwap_referral' ] ) ){
				$rtwwwap_referral 	= explode( '#', $_COOKIE[ 'rtwwwap_referral' ] );
				$rtwwwap_order 		= edd_get_payment( $rtwwwap_order_id );
				$rtwwwap_comm_base 	= isset( $rtwwwap_commission_settings[ 'comm_base' ] ) ? $rtwwwap_commission_settings[ 'comm_base' ] : '1';
				$rtwwwap_total_commission	= 0;
				$rtwwwap_aff_prod_details 	= array();
				$rtwwwap_user_id 			= esc_html( $rtwwwap_referral[ 0 ] );

				if( RTWWWAP_IS_WOO == 1 ){
					$rtwwwap_currency 		= get_woocommerce_currency();
					$rtwwwap_currency_sym 	= get_woocommerce_currency_symbol();
				}
				else{
					require_once( RTWWWAP_DIR.'includes/rtwaffiliatehelper.php' );

					$rtwwwap_extra_features = get_option( 'rtwwwap_extra_features_opt' );
					$rtwwwap_currency 		= isset( $rtwwwap_extra_features[ 'currency' ] ) ? $rtwwwap_extra_features[ 'currency' ] : 'USD';
					$rtwwwap_curr_obj 		= new RtwAffiliateHelper();
					$rtwwwap_currency_sym 	= $rtwwwap_curr_obj->rtwwwap_curr_symbol( $rtwwwap_currency );
				}

				$rtwwwap_commission_type 	= isset( $rtwwwap_commission_settings[ 'only_open_url' ] ) ? $rtwwwap_commission_settings[ 'only_open_url' ] : 0;
				$rtwwwap_shared 			= strpos( $_COOKIE[ 'rtwwwap_referral' ], 'share' );
				$rtwwwap_product_url 		= false;

				if( $rtwwwap_comm_base == 1 ){
					$rtwwwap_per_prod_mode 			= isset( $rtwwwap_commission_settings[ 'per_prod_mode' ] ) ? $rtwwwap_commission_settings[ 'per_prod_mode' ] : 0;
					$rtwwwap_all_commission 		= isset( $rtwwwap_commission_settings[ 'all_commission' ] ) ? $rtwwwap_commission_settings[ 'all_commission' ] : 0;
					$rtwwwap_all_commission_type 	= isset( $rtwwwap_commission_settings[ 'all_commission_type' ] ) ? $rtwwwap_commission_settings[ 'all_commission_type' ] : 'percentage';
					$rtwwwap_per_cat 				= isset( $rtwwwap_commission_settings[ 'per_cat' ] ) ? $rtwwwap_commission_settings[ 'per_cat' ] : array();

					foreach( $rtwwwap_order->cart_details as $rtwwwap_item_key => $rtwwwap_item_values )
					{
						$rtwwwap_prod_comm 		= '';
						$rtwwwap_product_id 	= $rtwwwap_item_values['id'];
						$rtwwwap_product_price	= $rtwwwap_item_values['price'];
						// $rtwwwp_product_category_taxonomy = 'download_category';
						$rtwwwap_product_terms 	= get_the_terms( $rtwwwap_product_id, 'download_category' );
						$rtwwwap_product_cat_id = $rtwwwap_product_terms[0]->term_id;

						if( $rtwwwap_commission_type == 1 && array_key_exists( 1, $rtwwwap_referral ) && ( $rtwwwap_product_id == $rtwwwap_referral[ 1 ] ) )
						{
							$rtwwwap_product_url = true;
							if( $rtwwwap_per_prod_mode == 1 ){
								$rtwwwap_prod_per_comm = get_post_meta( $rtwwwap_product_id, 'rtwwwap_percentage_commission_box', true );

								if( $rtwwwap_prod_per_comm > 0 ){
									$rtwwwap_prod_comm = ( $rtwwwap_product_price * $rtwwwap_prod_per_comm ) / 100;
									$rtwwwap_aff_prod_details[] = array(
							    					'product_id' 		=> $rtwwwap_product_id,
							    					'product_price' 	=> $rtwwwap_product_price,
							    					'commission_fix' 	=> '',
							    					'commission_perc' 	=> $rtwwwap_prod_per_comm,
							    					'prod_commission' 	=> $rtwwwap_prod_comm
							    				);

						    		$rtwwwap_total_commission += $rtwwwap_prod_comm;
								}
								elseif( $rtwwwap_prod_per_comm === '0' ){
									// no commission needs to be generated for this product
								}
								else{
									if( !empty( $rtwwwap_per_cat ) ){
										$rtwwwap_cat_per_comm = 0;
										$rtwwwap_cat_fix_comm = 0;
										$rtwwwap_flag = false;
										foreach( $rtwwwap_per_cat as $rtwwwap_key => $rtwwwap_value ){
											if( in_array( $rtwwwap_product_cat_id, $rtwwwap_value[ 'ids' ] ) ){
												$rtwwwap_cat_per_comm = $rtwwwap_value[ 'cat_percentage_commission' ];
												$rtwwwap_cat_fix_comm = $rtwwwap_value[ 'cat_fixed_commission' ];
												$rtwwwap_flag = true;

												break;
											}
										}
										if( $rtwwwap_flag ){
											if( $rtwwwap_cat_per_comm > 0 ){
												$rtwwwap_prod_comm += ( $rtwwwap_product_price * $rtwwwap_cat_per_comm ) / 100;
											}
											if( $rtwwwap_cat_fix_comm > 0 ){
												$rtwwwap_prod_comm += $rtwwwap_cat_fix_comm;
											}

											if( $rtwwwap_prod_comm != '' ){
												$rtwwwap_aff_prod_details[] = array(
									    					'product_id' 		=> $rtwwwap_product_id,
									    					'product_price' 	=> $rtwwwap_product_price,
									    					'commission_fix' 	=> $rtwwwap_cat_fix_comm,
									    					'commission_perc' 	=> $rtwwwap_cat_per_comm,
									    					'prod_commission' 	=> $rtwwwap_prod_comm
									    				);

								    			$rtwwwap_total_commission += $rtwwwap_prod_comm;
								    		}
										}
										else{
											if( $rtwwwap_all_commission ){
												if( $rtwwwap_all_commission_type == 'percentage' ){
													$rtwwwap_prod_comm += ( $rtwwwap_product_price * $rtwwwap_all_commission ) / 100;
												}
												elseif( $rtwwwap_all_commission_type == 'fixed' ){
													$rtwwwap_prod_comm += $rtwwwap_all_commission;
												}
												$rtwwwap_aff_prod_details[] = array(
									    					'product_id' 		=> $rtwwwap_product_id,
									    					'product_price' 	=> $rtwwwap_product_price,
									    					'commission_fix' 	=> '',
									    					'commission_perc' 	=> '',
									    					'prod_commission' 	=> $rtwwwap_prod_comm
									    				);

								    			$rtwwwap_total_commission += $rtwwwap_prod_comm;
								    		}
										}
									}
									else{
										if( $rtwwwap_all_commission ){
											if( $rtwwwap_all_commission_type == 'percentage' ){
												$rtwwwap_prod_comm += ( $rtwwwap_product_price * $rtwwwap_all_commission ) / 100;
											}
											elseif( $rtwwwap_all_commission_type == 'fixed' ){
												$rtwwwap_prod_comm += $rtwwwap_all_commission;
											}
											$rtwwwap_aff_prod_details[] = array(
								    					'product_id' 		=> $rtwwwap_product_id,
								    					'product_price' 	=> $rtwwwap_product_price,
								    					'commission_fix' 	=> '',
									    				'commission_perc' 	=> '',
								    					'prod_commission' 	=> $rtwwwap_prod_comm
								    				);

							    			$rtwwwap_total_commission += $rtwwwap_prod_comm;
							    		}
									}
								}
							}
							elseif( $rtwwwap_per_prod_mode == 2 ){
								$rtwwwap_prod_fix_comm = get_post_meta( $rtwwwap_product_id, 'rtwwwap_fixed_commission_box', true );

								if( $rtwwwap_prod_fix_comm > 0 ){
									$rtwwwap_prod_comm = $rtwwwap_prod_fix_comm;
									$rtwwwap_aff_prod_details[] = array(
							    					'product_id' 		=> $rtwwwap_product_id,
							    					'product_price' 	=> $rtwwwap_product_price,
							    					'commission_fix' 	=> $rtwwwap_prod_fix_comm,
							    					'commission_perc' 	=> '',
							    					'prod_commission' 	=> $rtwwwap_prod_comm
							    				);

						    		$rtwwwap_total_commission += $rtwwwap_prod_comm;
								}
								elseif( $rtwwwap_prod_fix_comm === '0' ){
									// no commission needs to be generated for this product
								}
								else{
									if( !empty( $rtwwwap_per_cat ) ){
										$rtwwwap_cat_per_comm = 0;
										$rtwwwap_cat_fix_comm = 0;
										$rtwwwap_flag = false;
										foreach( $rtwwwap_per_cat as $rtwwwap_key => $rtwwwap_value ){
											if( in_array( $rtwwwap_product_cat_id, $rtwwwap_value[ 'ids' ] ) ){
												$rtwwwap_cat_per_comm = $rtwwwap_value[ 'cat_percentage_commission' ];
												$rtwwwap_cat_fix_comm = $rtwwwap_value[ 'cat_fixed_commission' ];
												$rtwwwap_flag = true;

												break;
											}
										}
										if( $rtwwwap_flag ){
											if( $rtwwwap_cat_per_comm > 0 ){
												$rtwwwap_prod_comm += ( $rtwwwap_product_price * $rtwwwap_cat_per_comm ) / 100;
											}
											if( $rtwwwap_cat_fix_comm > 0 ){
												$rtwwwap_prod_comm += $rtwwwap_cat_fix_comm;
											}

											if( $rtwwwap_prod_comm != '' ){
												$rtwwwap_aff_prod_details[] = array(
									    					'product_id' 		=> $rtwwwap_product_id,
									    					'product_price' 	=> $rtwwwap_product_price,
									    					'commission_fix' 	=> $rtwwwap_cat_fix_comm,
									    					'commission_perc' 	=> $rtwwwap_cat_per_comm,
									    					'prod_commission' 	=> $rtwwwap_prod_comm
									    				);

								    			$rtwwwap_total_commission += $rtwwwap_prod_comm;
								    		}
										}
										else{
											if( $rtwwwap_all_commission ){
												if( $rtwwwap_all_commission_type == 'percentage' ){
													$rtwwwap_prod_comm += ( $rtwwwap_product_price * $rtwwwap_all_commission ) / 100;
												}
												elseif( $rtwwwap_all_commission_type == 'fixed' ){
													$rtwwwap_prod_comm += $rtwwwap_all_commission;
												}
												$rtwwwap_aff_prod_details[] = array(
									    					'product_id' 		=> $rtwwwap_product_id,
									    					'product_price' 	=> $rtwwwap_product_price,
									    					'commission_fix' 	=> '',
									    					'commission_perc' 	=> '',
									    					'prod_commission' 	=> $rtwwwap_prod_comm
									    				);

								    			$rtwwwap_total_commission += $rtwwwap_prod_comm;
								    		}
										}
									}
									else{
										if( $rtwwwap_all_commission ){
											if( $rtwwwap_all_commission_type == 'percentage' ){
												$rtwwwap_prod_comm += ( $rtwwwap_product_price * $rtwwwap_all_commission ) / 100;
											}
											elseif( $rtwwwap_all_commission_type == 'fixed' ){
												$rtwwwap_prod_comm += $rtwwwap_all_commission;
											}
											$rtwwwap_aff_prod_details[] = array(
								    					'product_id' 		=> $rtwwwap_product_id,
								    					'product_price' 	=> $rtwwwap_product_price,
								    					'commission_fix' 	=> '',
									    				'commission_perc' 	=> '',
								    					'prod_commission' 	=> $rtwwwap_prod_comm
								    				);

							    			$rtwwwap_total_commission += $rtwwwap_prod_comm;
							    		}
									}
								}
							}
							elseif( $rtwwwap_per_prod_mode == 3 ){
								$rtwwwap_prod_per_comm = get_post_meta( $rtwwwap_product_id, 'rtwwwap_percentage_commission_box', true );
								$rtwwwap_prod_fix_comm = get_post_meta( $rtwwwap_product_id, 'rtwwwap_fixed_commission_box', true );

								if( $rtwwwap_prod_per_comm > 0 ){
									$rtwwwap_prod_comm += ( $rtwwwap_product_price * $rtwwwap_prod_per_comm ) / 100;
								}

								if( $rtwwwap_prod_fix_comm > 0 ){
									$rtwwwap_prod_comm += $rtwwwap_prod_fix_comm;
								}

								if( $rtwwwap_prod_comm === '' ){
									if( $rtwwwap_prod_per_comm !== '0' && $rtwwwap_prod_fix_comm !== '0' ){
										if( !empty( $rtwwwap_per_cat ) ){
											$rtwwwap_cat_per_comm = 0;
											$rtwwwap_cat_fix_comm = 0;
											$rtwwwap_flag = false;
											foreach( $rtwwwap_per_cat as $rtwwwap_key => $rtwwwap_value ){
												if( in_array( $rtwwwap_product_cat_id, $rtwwwap_value[ 'ids' ] ) ){
													$rtwwwap_cat_per_comm = $rtwwwap_value[ 'cat_percentage_commission' ];
													$rtwwwap_cat_fix_comm = $rtwwwap_value[ 'cat_fixed_commission' ];
													$rtwwwap_flag = true;

													break;
												}
											}
											if( $rtwwwap_flag ){
												if( $rtwwwap_cat_per_comm > 0 ){
													$rtwwwap_prod_comm += ( $rtwwwap_product_price * $rtwwwap_cat_per_comm ) / 100;
												}
												if( $rtwwwap_cat_fix_comm > 0 ){
													$rtwwwap_prod_comm += $rtwwwap_cat_fix_comm;
												}

												if( $rtwwwap_prod_comm != '' ){
													$rtwwwap_aff_prod_details[] = array(
										    					'product_id' 		=> $rtwwwap_product_id,
										    					'product_price' 	=> $rtwwwap_product_price,
										    					'commission_fix' 	=> $rtwwwap_cat_fix_comm,
										    					'commission_perc' 	=> $rtwwwap_cat_per_comm,
										    					'prod_commission' 	=> $rtwwwap_prod_comm
										    				);

									    			$rtwwwap_total_commission += $rtwwwap_prod_comm;
									    		}
											}
											else{
												if( $rtwwwap_all_commission ){
													if( $rtwwwap_all_commission_type == 'percentage' ){
														$rtwwwap_prod_comm += ( $rtwwwap_product_price * $rtwwwap_all_commission ) / 100;
													}
													elseif( $rtwwwap_all_commission_type == 'fixed' ){
														$rtwwwap_prod_comm += $rtwwwap_all_commission;
													}
													$rtwwwap_aff_prod_details[] = array(
										    					'product_id' 		=> $rtwwwap_product_id,
										    					'product_price' 	=> $rtwwwap_product_price,
										    					'commission_fix' 	=> '',
										    					'commission_perc' 	=> '',
										    					'prod_commission' 	=> $rtwwwap_prod_comm
										    				);

									    			$rtwwwap_total_commission += $rtwwwap_prod_comm;
									    		}
											}
										}
										else{
											if( $rtwwwap_all_commission ){
												if( $rtwwwap_all_commission_type == 'percentage' ){
													$rtwwwap_prod_comm += ( $rtwwwap_product_price * $rtwwwap_all_commission ) / 100;
												}
												elseif( $rtwwwap_all_commission_type == 'fixed' ){
													$rtwwwap_prod_comm += $rtwwwap_all_commission;
												}
												$rtwwwap_aff_prod_details[] = array(
									    					'product_id' 		=> $rtwwwap_product_id,
									    					'product_price' 	=> $rtwwwap_product_price,
									    					'commission_fix' 	=> '',
										    				'commission_perc' 	=> '',
									    					'prod_commission' 	=> $rtwwwap_prod_comm
									    				);

								    			$rtwwwap_total_commission += $rtwwwap_prod_comm;
								    		}
										}
									}
								}
								else{
									$rtwwwap_aff_prod_details[] = array(
						    					'product_id' 		=> $rtwwwap_product_id,
						    					'product_price' 	=> $rtwwwap_product_price,
						    					'commission_fix' 	=> $rtwwwap_prod_fix_comm,
							    				'commission_perc' 	=> $rtwwwap_prod_per_comm,
						    					'prod_commission' 	=> $rtwwwap_prod_comm
						    				);

					    			$rtwwwap_total_commission += $rtwwwap_prod_comm;
								}
							}
							elseif( $rtwwwap_all_commission ){
								if( $rtwwwap_all_commission_type == 'percentage' ){
									$rtwwwap_prod_comm += ( $rtwwwap_product_price * $rtwwwap_all_commission ) / 100;
								}
								elseif( $rtwwwap_all_commission_type == 'fixed' ){
									$rtwwwap_prod_comm += $rtwwwap_all_commission;
								}
								$rtwwwap_aff_prod_details[] = array(
					    					'product_id' 		=> $rtwwwap_product_id,
					    					'product_price' 	=> $rtwwwap_product_price,
					    					'commission_fix' 	=> '',
						    				'commission_perc' 	=> '',
					    					'prod_commission' 	=> $rtwwwap_prod_comm
					    				);

				    			$rtwwwap_total_commission += $rtwwwap_prod_comm;
				    		}
						}
						elseif( $rtwwwap_commission_type == 0 )
						{
						    if( $rtwwwap_per_prod_mode == 1 ){
								$rtwwwap_prod_per_comm = get_post_meta( $rtwwwap_product_id, 'rtwwwap_percentage_commission_box', true );

								if( $rtwwwap_prod_per_comm > 0 ){
									$rtwwwap_prod_comm = ( $rtwwwap_product_price * $rtwwwap_prod_per_comm ) / 100;
									$rtwwwap_aff_prod_details[] = array(
							    					'product_id' 		=> $rtwwwap_product_id,
							    					'product_price' 	=> $rtwwwap_product_price,
							    					'commission_fix' 	=> '',
							    					'commission_perc' 	=> $rtwwwap_prod_per_comm,
							    					'prod_commission' 	=> $rtwwwap_prod_comm
							    				);

						    		$rtwwwap_total_commission += $rtwwwap_prod_comm;
								}
								elseif( $rtwwwap_prod_per_comm === '0' ){
									// no commission needs to be generated for this product
								}
								else{
									if( !empty( $rtwwwap_per_cat ) ){
										$rtwwwap_cat_per_comm = 0;
										$rtwwwap_cat_fix_comm = 0;
										$rtwwwap_flag = false;
										foreach( $rtwwwap_per_cat as $rtwwwap_key => $rtwwwap_value ){
											if( in_array( $rtwwwap_product_cat_id, $rtwwwap_value[ 'ids' ] ) ){
												$rtwwwap_cat_per_comm = $rtwwwap_value[ 'cat_percentage_commission' ];
												$rtwwwap_cat_fix_comm = $rtwwwap_value[ 'cat_fixed_commission' ];
												$rtwwwap_flag = true;

												break;
											}
										}
										if( $rtwwwap_flag ){
											if( $rtwwwap_cat_per_comm > 0 ){
												$rtwwwap_prod_comm = ( $rtwwwap_product_price * $rtwwwap_cat_per_comm ) / 100;
											}
											if( $rtwwwap_cat_fix_comm > 0 ){
												$rtwwwap_prod_comm += $rtwwwap_cat_fix_comm;
											}

											if( $rtwwwap_prod_comm != '' ){
												$rtwwwap_aff_prod_details[] = array(
									    					'product_id' 		=> $rtwwwap_product_id,
									    					'product_price' 	=> $rtwwwap_product_price,
									    					'commission_fix' 	=> $rtwwwap_cat_fix_comm,
									    					'commission_perc' 	=> $rtwwwap_cat_per_comm,
									    					'prod_commission' 	=> $rtwwwap_prod_comm
									    				);

								    			$rtwwwap_total_commission += $rtwwwap_prod_comm;
								    		}
										}
										else{
											if( $rtwwwap_all_commission ){
												if( $rtwwwap_all_commission_type == 'percentage' ){
													$rtwwwap_prod_comm += ( $rtwwwap_product_price * $rtwwwap_all_commission ) / 100;
												}
												elseif( $rtwwwap_all_commission_type == 'fixed' ){
													$rtwwwap_prod_comm += $rtwwwap_all_commission;
												}
												$rtwwwap_aff_prod_details[] = array(
									    					'product_id' 		=> $rtwwwap_product_id,
									    					'product_price' 	=> $rtwwwap_product_price,
									    					'commission_fix' 	=> '',
									    					'commission_perc' 	=> '',
									    					'prod_commission' 	=> $rtwwwap_prod_comm
									    				);

								    			$rtwwwap_total_commission += $rtwwwap_prod_comm;
								    		}
										}
									}
									else{
										if( $rtwwwap_all_commission ){
											if( $rtwwwap_all_commission_type == 'percentage' ){
												$rtwwwap_prod_comm += ( $rtwwwap_product_price * $rtwwwap_all_commission ) / 100;
											}
											elseif( $rtwwwap_all_commission_type == 'fixed' ){
												$rtwwwap_prod_comm += $rtwwwap_all_commission;
											}
											$rtwwwap_aff_prod_details[] = array(
								    					'product_id' 		=> $rtwwwap_product_id,
								    					'product_price' 	=> $rtwwwap_product_price,
								    					'commission_fix' 	=> '',
									    				'commission_perc' 	=> '',
								    					'prod_commission' 	=> $rtwwwap_prod_comm
								    				);

							    			$rtwwwap_total_commission += $rtwwwap_prod_comm;
							    		}
									}
								}
							}
							elseif( $rtwwwap_per_prod_mode == 2 ){
								$rtwwwap_prod_fix_comm = get_post_meta( $rtwwwap_product_id, 'rtwwwap_fixed_commission_box', true );

								if( $rtwwwap_prod_fix_comm > 0 ){
									$rtwwwap_prod_comm = $rtwwwap_prod_fix_comm;
									$rtwwwap_aff_prod_details[] = array(
							    					'product_id' 		=> $rtwwwap_product_id,
							    					'product_price' 	=> $rtwwwap_product_price,
							    					'commission_fix' 	=> $rtwwwap_prod_fix_comm,
							    					'commission_perc' 	=> '',
							    					'prod_commission' 	=> $rtwwwap_prod_comm
							    				);

						    		$rtwwwap_total_commission += $rtwwwap_prod_comm;
								}
								elseif( $rtwwwap_prod_fix_comm === '0' ){
									// no commission needs to be generated for this product
								}
								else{
									if( !empty( $rtwwwap_per_cat ) ){
										$rtwwwap_cat_per_comm = 0;
										$rtwwwap_cat_fix_comm = 0;
										$rtwwwap_flag = false;
										foreach( $rtwwwap_per_cat as $rtwwwap_key => $rtwwwap_value ){
											if( in_array( $rtwwwap_product_cat_id, $rtwwwap_value[ 'ids' ] ) ){
												$rtwwwap_cat_per_comm = $rtwwwap_value[ 'cat_percentage_commission' ];
												$rtwwwap_cat_fix_comm = $rtwwwap_value[ 'cat_fixed_commission' ];
												$rtwwwap_flag = true;

												break;
											}
										}
										if( $rtwwwap_flag ){
											if( $rtwwwap_cat_per_comm > 0 ){
												$rtwwwap_prod_comm = ( $rtwwwap_product_price * $rtwwwap_cat_per_comm ) / 100;
											}
											if( $rtwwwap_cat_fix_comm > 0 ){
												$rtwwwap_prod_comm += $rtwwwap_cat_fix_comm;
											}

											if( $rtwwwap_prod_comm != '' ){
												$rtwwwap_aff_prod_details[] = array(
									    					'product_id' 		=> $rtwwwap_product_id,
									    					'product_price' 	=> $rtwwwap_product_price,
									    					'commission_fix' 	=> $rtwwwap_cat_fix_comm,
									    					'commission_perc' 	=> $rtwwwap_cat_per_comm,
									    					'prod_commission' 	=> $rtwwwap_prod_comm
									    				);

								    			$rtwwwap_total_commission += $rtwwwap_prod_comm;
								    		}
										}
										else{
											if( $rtwwwap_all_commission ){
												if( $rtwwwap_all_commission_type == 'percentage' ){
													$rtwwwap_prod_comm += ( $rtwwwap_product_price * $rtwwwap_all_commission ) / 100;
												}
												elseif( $rtwwwap_all_commission_type == 'fixed' ){
													$rtwwwap_prod_comm += $rtwwwap_all_commission;
												}
												$rtwwwap_aff_prod_details[] = array(
									    					'product_id' 		=> $rtwwwap_product_id,
									    					'product_price' 	=> $rtwwwap_product_price,
									    					'commission_fix' 	=> '',
									    					'commission_perc' 	=> '',
									    					'prod_commission' 	=> $rtwwwap_prod_comm
									    				);

								    			$rtwwwap_total_commission += $rtwwwap_prod_comm;
								    		}
										}
									}
									else{
										if( $rtwwwap_all_commission ){
											if( $rtwwwap_all_commission_type == 'percentage' ){
												$rtwwwap_prod_comm += ( $rtwwwap_product_price * $rtwwwap_all_commission ) / 100;
											}
											elseif( $rtwwwap_all_commission_type == 'fixed' ){
												$rtwwwap_prod_comm += $rtwwwap_all_commission;
											}
											$rtwwwap_aff_prod_details[] = array(
								    					'product_id' 		=> $rtwwwap_product_id,
								    					'product_price' 	=> $rtwwwap_product_price,
								    					'commission_fix' 	=> '',
									    				'commission_perc' 	=> '',
								    					'prod_commission' 	=> $rtwwwap_prod_comm
								    				);

							    			$rtwwwap_total_commission += $rtwwwap_prod_comm;
							    		}
									}
								}
							}
							elseif( $rtwwwap_per_prod_mode == 3 ){
								$rtwwwap_prod_per_comm = get_post_meta( $rtwwwap_product_id, 'rtwwwap_percentage_commission_box', true );
								$rtwwwap_prod_fix_comm = get_post_meta( $rtwwwap_product_id, 'rtwwwap_fixed_commission_box', true );

								if( $rtwwwap_prod_per_comm > 0 ){
									$rtwwwap_prod_comm += ( $rtwwwap_product_price * $rtwwwap_prod_per_comm ) / 100;
								}

								if( $rtwwwap_prod_fix_comm > 0 ){
									$rtwwwap_prod_comm += $rtwwwap_prod_fix_comm;
								}

								if( $rtwwwap_prod_comm === '' ){
									if( $rtwwwap_prod_per_comm !== '0' && $rtwwwap_prod_fix_comm !== '0' ){
										if( !empty( $rtwwwap_per_cat ) ){
											$rtwwwap_cat_per_comm = 0;
											$rtwwwap_cat_fix_comm = 0;
											$rtwwwap_flag = false;
											foreach( $rtwwwap_per_cat as $rtwwwap_key => $rtwwwap_value ){
												if( in_array( $rtwwwap_product_cat_id, $rtwwwap_value[ 'ids' ] ) ){
													$rtwwwap_cat_per_comm = $rtwwwap_value[ 'cat_percentage_commission' ];
													$rtwwwap_cat_fix_comm = $rtwwwap_value[ 'cat_fixed_commission' ];
													$rtwwwap_flag = true;

													break;
												}
											}
											if( $rtwwwap_flag ){
												if( $rtwwwap_cat_per_comm > 0 ){
													$rtwwwap_prod_comm = ( $rtwwwap_product_price * $rtwwwap_cat_per_comm ) / 100;
												}
												if( $rtwwwap_cat_fix_comm > 0 ){
													$rtwwwap_prod_comm += $rtwwwap_cat_fix_comm;
												}

												if( $rtwwwap_prod_comm != '' ){
													$rtwwwap_aff_prod_details[] = array(
										    					'product_id' 		=> $rtwwwap_product_id,
										    					'product_price' 	=> $rtwwwap_product_price,
										    					'commission_fix' 	=> $rtwwwap_cat_fix_comm,
										    					'commission_perc' 	=> $rtwwwap_cat_per_comm,
										    					'prod_commission' 	=> $rtwwwap_prod_comm
										    				);

									    			$rtwwwap_total_commission += $rtwwwap_prod_comm;
									    		}
											}
											else{
												if( $rtwwwap_all_commission ){
													if( $rtwwwap_all_commission_type == 'percentage' ){
														$rtwwwap_prod_comm += ( $rtwwwap_product_price * $rtwwwap_all_commission ) / 100;
													}
													elseif( $rtwwwap_all_commission_type == 'fixed' ){
														$rtwwwap_prod_comm += $rtwwwap_all_commission;
													}
													$rtwwwap_aff_prod_details[] = array(
										    					'product_id' 		=> $rtwwwap_product_id,
										    					'product_price' 	=> $rtwwwap_product_price,
										    					'commission_fix' 	=> '',
										    					'commission_perc' 	=> '',
										    					'prod_commission' 	=> $rtwwwap_prod_comm
										    				);

									    			$rtwwwap_total_commission += $rtwwwap_prod_comm;
									    		}
											}
										}
										else{
											if( $rtwwwap_all_commission ){
												if( $rtwwwap_all_commission_type == 'percentage' ){
													$rtwwwap_prod_comm += ( $rtwwwap_product_price * $rtwwwap_all_commission ) / 100;
												}
												elseif( $rtwwwap_all_commission_type == 'fixed' ){
													$rtwwwap_prod_comm += $rtwwwap_all_commission;
												}
												$rtwwwap_aff_prod_details[] = array(
									    					'product_id' 		=> $rtwwwap_product_id,
									    					'product_price' 	=> $rtwwwap_product_price,
									    					'commission_fix' 	=> '',
										    				'commission_perc' 	=> '',
									    					'prod_commission' 	=> $rtwwwap_prod_comm
									    				);

								    			$rtwwwap_total_commission += $rtwwwap_prod_comm;
								    		}
										}
									}
								}
								else{
									$rtwwwap_aff_prod_details[] = array(
						    					'product_id' 		=> $rtwwwap_product_id,
						    					'product_price' 	=> $rtwwwap_product_price,
						    					'commission_fix' 	=> $rtwwwap_prod_fix_comm,
							    				'commission_perc' 	=> $rtwwwap_prod_per_comm,
						    					'prod_commission' 	=> $rtwwwap_prod_comm
						    				);

					    			$rtwwwap_total_commission += $rtwwwap_prod_comm;
								}
							}
							elseif( $rtwwwap_all_commission ){
								if( $rtwwwap_all_commission_type == 'percentage' ){
									$rtwwwap_prod_comm += ( $rtwwwap_product_price * $rtwwwap_all_commission ) / 100;
								}
								elseif( $rtwwwap_all_commission_type == 'fixed' ){
									$rtwwwap_prod_comm += $rtwwwap_all_commission;
								}
								$rtwwwap_aff_prod_details[] = array(
					    					'product_id' 		=> $rtwwwap_product_id,
					    					'product_price' 	=> $rtwwwap_product_price,
					    					'commission_fix' 	=> '',
						    				'commission_perc' 	=> '',
					    					'prod_commission' 	=> $rtwwwap_prod_comm
					    				);

				    			$rtwwwap_total_commission += $rtwwwap_prod_comm;
				    		}
						}
					}
				}
				else
				{
					$rtwwwap_levels_settings 	= get_option( 'rtwwwap_levels_settings_opt' );
					$rtwwwap_user_level 		= get_user_meta( $rtwwwap_user_id, 'rtwwwap_affiliate_level', true );
					$rtwwwap_user_level 		= ( $rtwwwap_user_level ) ? $rtwwwap_user_level : '0';

					$rtwwwap_user_level_details = isset( $rtwwwap_levels_settings[ $rtwwwap_user_level ] ) ? $rtwwwap_levels_settings[ $rtwwwap_user_level ] : '';

					if( !empty( $rtwwwap_user_level_details ) ){
						$rtwwwap_level_comm_type 		= $rtwwwap_user_level_details[ 'level_commission_type' ];
						$rtwwwap_level_comm_amount 		= $rtwwwap_user_level_details[ 'level_comm_amount' ];
						$rtwwwap_level_criteria_type 	= $rtwwwap_user_level_details[ 'level_criteria_type' ];
						$rtwwwap_level_criteria_val 	= $rtwwwap_user_level_details[ 'level_criteria_val' ];

						foreach( $rtwwwap_order->cart_details as $rtwwwap_item_key => $rtwwwap_item_values )
						{
							$rtwwwap_prod_comm 		= '';
							$rtwwwap_product_id 	= $rtwwwap_item_values['ID'];
							$rtwwwap_product_price	= $rtwwwap_item_values['price'];

							if( $rtwwwap_commission_type == 1 && array_key_exists( 1, $rtwwwap_referral ) && ( $rtwwwap_product_id == $rtwwwap_referral[ 1 ] ) )
							{
								$rtwwwap_product_url = true;
								if( $rtwwwap_level_comm_type == 0 ){
									$rtwwwap_prod_comm = ( $rtwwwap_product_price * $rtwwwap_level_comm_amount ) / 100;
									$rtwwwap_aff_prod_details[] = array(
							    					'product_id' 		=> $rtwwwap_product_id,
							    					'product_price' 	=> $rtwwwap_product_price,
							    					'commission_fix' 	=> 'user',
							    					'commission_perc' 	=> $rtwwwap_level_comm_amount,
							    					'prod_commission' 	=> $rtwwwap_prod_comm
							    				);

						    		$rtwwwap_total_commission += $rtwwwap_prod_comm;
								}
								else{
									$rtwwwap_prod_comm = $rtwwwap_level_comm_amount;
									$rtwwwap_aff_prod_details[] = array(
							    					'product_id' 		=> $rtwwwap_product_id,
							    					'product_price' 	=> $rtwwwap_product_price,
							    					'commission_fix' 	=> $rtwwwap_level_comm_amount,
							    					'commission_perc' 	=> 'user',
							    					'prod_commission' 	=> $rtwwwap_prod_comm
							    				);

						    		$rtwwwap_total_commission += $rtwwwap_prod_comm;
								}
							}
							elseif( $rtwwwap_commission_type == 0 )
							{
								if( $rtwwwap_level_comm_type == 0 ){
									$rtwwwap_prod_comm = ( $rtwwwap_product_price * $rtwwwap_level_comm_amount ) / 100;
									$rtwwwap_aff_prod_details[] = array(
							    					'product_id' 		=> $rtwwwap_product_id,
							    					'product_price' 	=> $rtwwwap_product_price,
							    					'commission_fix' 	=> 'user',
							    					'commission_perc' 	=> $rtwwwap_level_comm_amount,
							    					'prod_commission' 	=> $rtwwwap_prod_comm
							    				);

						    		$rtwwwap_total_commission += $rtwwwap_prod_comm;
								}
								else{
									$rtwwwap_prod_comm = $rtwwwap_level_comm_amount;
									$rtwwwap_aff_prod_details[] = array(
							    					'product_id' 		=> $rtwwwap_product_id,
							    					'product_price' 	=> $rtwwwap_product_price,
							    					'commission_fix' 	=> 'user',
							    					'commission_perc' 	=> $rtwwwap_level_comm_amount,
							    					'prod_commission' 	=> $rtwwwap_prod_comm
							    				);

						    		$rtwwwap_total_commission += $rtwwwap_prod_comm;
								}
							}
						}
					}
				}

				if( isset( $rtwwwap_total_commission ) && $rtwwwap_total_commission !== '' && $rtwwwap_total_commission !== 0 ){
					$rtwwwap_capped 		= 0;
					$rtwwwap_current_year 	= date("Y");
					$rtwwwap_current_month 	= date("m");

					$rtwwwap_commission_settings	= get_option( 'rtwwwap_commission_settings_opt' );
					$rtwwwap_max_comm 				= isset( $rtwwwap_commission_settings[ 'max_commission' ] ) ? $rtwwwap_commission_settings[ 'max_commission' ] : '0';

					if( $rtwwwap_max_comm != 0 )
					{
						$rtwwwap_month_commission 	= $wpdb->get_var( $wpdb->prepare( "SELECT SUM(`amount`) FROM ".$wpdb->prefix."rtwwwap_referrals WHERE YEAR(date)=%d AND MONTH(date)=%d AND `aff_id`=%d", $rtwwwap_current_year, $rtwwwap_current_month, $rtwwwap_user_id ) );
						$rtwwwap_month_commission 	= isset( $rtwwwap_month_commission ) ? $rtwwwap_month_commission : 0;

						if( $rtwwwap_month_commission < $rtwwwap_max_comm ){
							$rtwwwap_this_month_left = $rtwwwap_max_comm - $rtwwwap_month_commission;
							if( $rtwwwap_this_month_left < $rtwwwap_total_commission ){
								$rtwwwap_total_commission = $rtwwwap_this_month_left;
							}
							else{
								$rtwwwap_total_commission = $rtwwwap_total_commission;
							}
						}
						else{
							$rtwwwap_capped = 1;
						}
					}

					// inserting into DB
					if( !empty( $rtwwwap_aff_prod_details ) ){
						if( get_user_meta( $rtwwwap_user_id, 'rtwwwap_referral_mail', true ) == 'on' ){
							$rtwwwap_decimal_places = $rtwwwap_extra_features['decimal_places'].'f';
							$rtwwwap_to 			= get_user_by( 'id', $rtwwwap_user_id );
							$rtwwwap_to 			= esc_html( $rtwwwap_to->user_email );
							$rtwwwap_subject 		= esc_html__( 'One new Referral', 'rtwwwap-wp-wc-affiliate-program' );
							$rtwwwap_message 		= sprintf( '%s %s%01.'.$rtwwwap_decimal_places, esc_html__( 'You got a new referral of amount', 'rtwwwap-wp-wc-affiliate-program' ), $rtwwwap_currency_sym, $rtwwwap_total_commission );
							$rtwwwap_from_name 		= esc_html( get_bloginfo( 'name' ) );
							$rtwwwap_from_email 	= esc_html( get_bloginfo( 'admin_email' ) );

							$rtwwwap_headers[] 		= sprintf( '%s: %s <%s>', esc_html__( 'From', 'rtwwwap-wp-wc-affiliate-program' ), $rtwwwap_from_name, $rtwwwap_from_email );

							// mail to affiliate
							wp_mail( $rtwwwap_to, $rtwwwap_subject, $rtwwwap_message, $rtwwwap_headers );

							if( isset( $rtwwwap_extra_features[ 'mail_to_admin' ] ) && $rtwwwap_extra_features[ 'mail_to_admin' ] == 1 ){
								// mail to admin
								$rtwwwap_message = sprintf( '%s %s%01.'.$rtwwwap_decimal_places, esc_html__( 'Generated a new referral of amount', 'rtwwwap-wp-wc-affiliate-program' ), $rtwwwap_currency_sym, $rtwwwap_total_commission );
								wp_mail( $rtwwwap_from_email, $rtwwwap_subject, $rtwwwap_message, $rtwwwap_headers );
							}
						}

						$rtwwwap_aff_prod_details = json_encode( $rtwwwap_aff_prod_details );
						$rtwwwap_device = ( wp_is_mobile() ) ? 'mobile' : 'desktop';

						$rtwwwap_locale = get_locale();
						setlocale( LC_NUMERIC, $rtwwwap_locale );

						$rtwwwap_updated = $wpdb->insert(
				            $wpdb->prefix.'rtwwwap_referrals',
				            array(
				                'aff_id'    			=> $rtwwwap_user_id,
				                'type'    				=> 0,
				                'order_id'    			=> esc_html( $rtwwwap_order_id ),
				                'date'    				=> date( 'Y-m-d H:i:s' ),
				                'status'    			=> 0,
				                'amount'    			=> $rtwwwap_total_commission,
				                'capped'    			=> esc_html( $rtwwwap_capped ),
				                'currency'    			=> $rtwwwap_currency,
				                'product_details'   	=> $rtwwwap_aff_prod_details,
				                'device'   				=> $rtwwwap_device
				            )
				        );
				        $rtwwwap_lastid = $wpdb->insert_id;

				        if( $rtwwwap_shared !== false ){
				        	$rtwwwap_share_commission = 0;
							$rtwwwap_sharing_bonus 	= isset( $rtwwwap_extra_features[ 'sharing_bonus' ] ) ? $rtwwwap_extra_features[ 'sharing_bonus' ] : 0;

							if( $rtwwwap_sharing_bonus ){
								$rtwwwap_sharing_bonus_time_limit = isset( $rtwwwap_extra_features[ 'sharing_bonus_time_limit' ] ) ? $rtwwwap_extra_features[ 'sharing_bonus_time_limit' ] : 0;

								$rtwwwap_sharing_bonus_amount_limit = isset( $rtwwwap_extra_features[ 'sharing_bonus_amount_limit' ] ) ? $rtwwwap_extra_features[ 'sharing_bonus_amount_limit' ] : 0;


								if( $rtwwwap_sharing_bonus_time_limit == 0 ){
									$rtwwwap_share_commission = $rtwwwap_sharing_bonus;
								}
								elseif( $rtwwwap_sharing_bonus_time_limit == 1 ){
									$rtwwwap_current_day = date( 'Y-m-d' );

									$rtwwwap_daily_old_bonus = $wpdb->get_var( $wpdb->prepare( "SELECT SUM(`amount`) FROM ".$wpdb->prefix."rtwwwap_referrals WHERE DATE(date)=%s AND `aff_id`=%d", $rtwwwap_current_day, $rtwwwap_user_id ) );

									if( $rtwwwap_daily_old_bonus < $rtwwwap_sharing_bonus_amount_limit )
									{
										$rtwwwap_left_amount = $rtwwwap_sharing_bonus_amount_limit - $rtwwwap_daily_old_bonus;

										if( $rtwwwap_left_amount < $rtwwwap_sharing_bonus ){
											$rtwwwap_share_commission = $rtwwwap_left_amount;
										}
										else{
											$rtwwwap_share_commission = $rtwwwap_sharing_bonus;
										}
									}
								}
								elseif( $rtwwwap_sharing_bonus_time_limit == 2 ){
									$rtwwwap_current_week = date('W');

									$rtwwwap_weekly_old_bonus = $wpdb->get_var( $wpdb->prepare( "SELECT SUM(`amount`) FROM ".$wpdb->prefix."rtwwwap_referrals WHERE WEEK(`date`,1)=%d AND `aff_id`=%d", $rtwwwap_current_week, $rtwwwap_user_id ) );

									if( $rtwwwap_weekly_old_bonus < $rtwwwap_sharing_bonus_amount_limit )
									{
										$rtwwwap_left_amount = $rtwwwap_sharing_bonus_amount_limit - $rtwwwap_weekly_old_bonus;

										if( $rtwwwap_left_amount < $rtwwwap_sharing_bonus ){
											$rtwwwap_share_commission = $rtwwwap_left_amount;
										}
										else{
											$rtwwwap_share_commission = $rtwwwap_sharing_bonus;
										}
									}
								}
								elseif( $rtwwwap_sharing_bonus_time_limit == 3 ){
									$rtwwwap_current_month = date('m');

									$rtwwwap_monthly_old_bonus = $wpdb->get_var( $wpdb->prepare( "SELECT SUM(`amount`) FROM ".$wpdb->prefix."rtwwwap_referrals WHERE MONTH(date)=%d AND `aff_id`=%d", $rtwwwap_current_month, $rtwwwap_user_id ) );

									if( $rtwwwap_monthly_old_bonus < $rtwwwap_sharing_bonus_amount_limit )
									{
										$rtwwwap_left_amount = $rtwwwap_sharing_bonus_amount_limit - $rtwwwap_monthly_old_bonus;

										if( $rtwwwap_left_amount < $rtwwwap_sharing_bonus ){
											$rtwwwap_share_commission = $rtwwwap_left_amount;
										}
										else{
											$rtwwwap_share_commission = $rtwwwap_sharing_bonus;
										}
									}
								}

								if( $rtwwwap_commission_type == 1 ){
									if( !$rtwwwap_product_url ){
										$rtwwwap_share_commission = 0;
									}
								}

								if( $rtwwwap_share_commission ){
									$rtwwwap_share_bonus = $wpdb->insert(
							            $wpdb->prefix.'rtwwwap_referrals',
							            array(
							                'aff_id'    			=> $rtwwwap_user_id,
							                'type'    				=> 5,
							                'order_id'    			=> esc_html( $rtwwwap_order_id ),
							                'date'    				=> date( 'Y-m-d H:i:s' ),
							                'status'    			=> 0,
							                'amount'    			=> $rtwwwap_share_commission,
							                'capped'    			=> esc_html( $rtwwwap_capped ),
							                'currency'    			=> $rtwwwap_currency,
							                'product_details'   	=> '',
							                'device'   				=> $rtwwwap_device
							            )
							        );
								}
							}
				        }

				        setlocale( LC_ALL, $rtwwwap_locale );

				        if( $rtwwwap_updated ){
				        	unset( $_COOKIE[ 'rtwwwap_referral' ] );
					        $rtwwwap_referral_noti = get_option( 'rtwwwap_referral_noti' )+1;
					        update_option( 'rtwwwap_referral_noti', $rtwwwap_referral_noti );
						}

						$rtwwwap_mlm = get_option( 'rtwwwap_mlm_opt' );
						if( isset( $rtwwwap_mlm[ 'activate' ] ) && $rtwwwap_mlm[ 'activate' ] == 1 )
						{
							$rtwwwap_child = isset( $rtwwwap_mlm[ 'child' ] ) ? $rtwwwap_mlm[ 'child' ] : 1;
							$rtwwwap_check_have_child = $this->rtwwwap_check_child_in_mlm( $rtwwwap_user_id, $rtwwwap_child );

							if( $rtwwwap_check_have_child ){
								$this->rtwwwap_give_mlm_comm( $rtwwwap_user_id, $rtwwwap_lastid, $rtwwwap_total_commission, $rtwwwap_currency, $rtwwwap_currency_sym, $rtwwwap_device, $rtwwwap_mlm[ 'mlm_levels' ], $rtwwwap_child, $rtwwwap_order_id );
							}
						}
					}
				}
			}
		}
	}


	/*
	 * Feature to give comm. on referral code
	 */
	function rtwwwap_referral_code_comm( $rtwwwap_order_id ){
		global $wpdb;
		$rtwwwap_current_user_id = get_current_user_id();

		//get parent
		$rtwwwap_parent = $wpdb->get_var( $wpdb->prepare( "SELECT `parent_id` FROM ".$wpdb->prefix."rtwwwap_mlm WHERE `aff_id` = %d AND `status` = %d", $rtwwwap_current_user_id, 1 ) );

		if( $rtwwwap_parent ){
			$rtwwwap_user_id 	= $rtwwwap_parent;
			$rtwwwap_order 		= wc_get_order( $rtwwwap_order_id );
			$rtwwwap_commission_settings = get_option( 'rtwwwap_commission_settings_opt' );
			$rtwwwap_comm_base 	= isset( $rtwwwap_commission_settings[ 'comm_base' ] ) ? $rtwwwap_commission_settings[ 'comm_base' ] : '1';
			$rtwwwap_total_commission	= 0;
			$rtwwwap_aff_prod_details 	= array();
			$rtwwwap_extra_features = get_option( 'rtwwwap_extra_features_opt' );
			$rtwwwap_decimal_places = $rtwwwap_extra_features['decimal_places'].'f';
			if( RTWWWAP_IS_WOO == 1 ){
				$rtwwwap_currency 		= get_woocommerce_currency();
				$rtwwwap_currency_sym 	= get_woocommerce_currency_symbol();
			}
			else{
				require_once( RTWWWAP_DIR.'includes/rtwaffiliatehelper.php' );

				$rtwwwap_currency 		= isset( $rtwwwap_extra_features[ 'currency' ] ) ? $rtwwwap_extra_features[ 'currency' ] : 'USD';
				$rtwwwap_curr_obj 		= new RtwAffiliateHelper();
				$rtwwwap_currency_sym 	= $rtwwwap_curr_obj->rtwwwap_curr_symbol( $rtwwwap_currency );
			}

			$rtwwwap_commission_type 	= 0;

			if( $rtwwwap_comm_base == 1 ){
				$rtwwwap_per_prod_mode 			= isset( $rtwwwap_commission_settings[ 'per_prod_mode' ] ) ? $rtwwwap_commission_settings[ 'per_prod_mode' ] : 0;
				$rtwwwap_all_commission 		= isset( $rtwwwap_commission_settings[ 'all_commission' ] ) ? $rtwwwap_commission_settings[ 'all_commission' ] : 0;
				$rtwwwap_all_commission_type 	= isset( $rtwwwap_commission_settings[ 'all_commission_type' ] ) ? $rtwwwap_commission_settings[ 'all_commission_type' ] : 'percentage';
				$rtwwwap_per_cat 				= isset( $rtwwwap_commission_settings[ 'per_cat' ] ) ? $rtwwwap_commission_settings[ 'per_cat' ] : array();

				foreach( $rtwwwap_order->get_items() as $rtwwwap_item_key => $rtwwwap_item_values )
				{
					$rtwwwap_prod_comm 		= '';
					$rtwwwap_product_id 	= $rtwwwap_item_values->get_product_id();
					$rtwwwap_product_price	= $rtwwwap_item_values->get_total();
					$rtwwwap_product_terms 	= get_the_terms( $rtwwwap_product_id, 'product_cat' );
					$rtwwwap_product_cat_id = $rtwwwap_product_terms[0]->term_id;

					if( $rtwwwap_commission_type == 0 )
					{
					    if( $rtwwwap_per_prod_mode == 1 ){
							$rtwwwap_prod_per_comm = get_post_meta( $rtwwwap_product_id, 'rtwwwap_percentage_commission_box', true );

							if( $rtwwwap_prod_per_comm > 0 ){
								$rtwwwap_prod_comm = ( $rtwwwap_product_price * $rtwwwap_prod_per_comm ) / 100;
								$rtwwwap_aff_prod_details[] = array(
						    					'product_id' 		=> $rtwwwap_product_id,
						    					'product_price' 	=> $rtwwwap_product_price,
						    					'commission_fix' 	=> '',
						    					'commission_perc' 	=> $rtwwwap_prod_per_comm,
						    					'prod_commission' 	=> $rtwwwap_prod_comm
						    				);

					    		$rtwwwap_total_commission += $rtwwwap_prod_comm;
							}
							elseif( $rtwwwap_prod_per_comm === '0' ){
								// no commission needs to be generated for this product
							}
							else{
								if( !empty( $rtwwwap_per_cat ) ){
									$rtwwwap_cat_per_comm = 0;
									$rtwwwap_cat_fix_comm = 0;
									$rtwwwap_flag = false;
									foreach( $rtwwwap_per_cat as $rtwwwap_key => $rtwwwap_value ){
										if( in_array( $rtwwwap_product_cat_id, $rtwwwap_value[ 'ids' ] ) ){
											$rtwwwap_cat_per_comm = $rtwwwap_value[ 'cat_percentage_commission' ];
											$rtwwwap_cat_fix_comm = $rtwwwap_value[ 'cat_fixed_commission' ];
											$rtwwwap_flag = true;

											break;
										}
									}
									if( $rtwwwap_flag ){
										if( $rtwwwap_cat_per_comm > 0 ){
											$rtwwwap_prod_comm = ( $rtwwwap_product_price * $rtwwwap_cat_per_comm ) / 100;
										}
										if( $rtwwwap_cat_fix_comm > 0 ){
											$rtwwwap_prod_comm += $rtwwwap_cat_fix_comm;
										}

										if( $rtwwwap_prod_comm != '' ){
											$rtwwwap_aff_prod_details[] = array(
								    					'product_id' 		=> $rtwwwap_product_id,
								    					'product_price' 	=> $rtwwwap_product_price,
								    					'commission_fix' 	=> $rtwwwap_cat_fix_comm,
								    					'commission_perc' 	=> $rtwwwap_cat_per_comm,
								    					'prod_commission' 	=> $rtwwwap_prod_comm
								    				);

							    			$rtwwwap_total_commission += $rtwwwap_prod_comm;
							    		}
									}
									else{
										if( $rtwwwap_all_commission ){
											if( $rtwwwap_all_commission_type == 'percentage' ){
												$rtwwwap_prod_comm += ( $rtwwwap_product_price * $rtwwwap_all_commission ) / 100;
											}
											elseif( $rtwwwap_all_commission_type == 'fixed' ){
												$rtwwwap_prod_comm += $rtwwwap_all_commission;
											}
											$rtwwwap_aff_prod_details[] = array(
								    					'product_id' 		=> $rtwwwap_product_id,
								    					'product_price' 	=> $rtwwwap_product_price,
								    					'commission_fix' 	=> '',
								    					'commission_perc' 	=> '',
								    					'prod_commission' 	=> $rtwwwap_prod_comm
								    				);

							    			$rtwwwap_total_commission += $rtwwwap_prod_comm;
							    		}
									}
								}
								else{
									if( $rtwwwap_all_commission ){
										if( $rtwwwap_all_commission_type == 'percentage' ){
											$rtwwwap_prod_comm += ( $rtwwwap_product_price * $rtwwwap_all_commission ) / 100;
										}
										elseif( $rtwwwap_all_commission_type == 'fixed' ){
											$rtwwwap_prod_comm += $rtwwwap_all_commission;
										}
										$rtwwwap_aff_prod_details[] = array(
							    					'product_id' 		=> $rtwwwap_product_id,
							    					'product_price' 	=> $rtwwwap_product_price,
							    					'commission_fix' 	=> '',
								    				'commission_perc' 	=> '',
							    					'prod_commission' 	=> $rtwwwap_prod_comm
							    				);

						    			$rtwwwap_total_commission += $rtwwwap_prod_comm;
						    		}
								}
							}
						}
						elseif( $rtwwwap_per_prod_mode == 2 ){
							$rtwwwap_prod_fix_comm = get_post_meta( $rtwwwap_product_id, 'rtwwwap_fixed_commission_box', true );

							if( $rtwwwap_prod_fix_comm > 0 ){
								$rtwwwap_prod_comm = $rtwwwap_prod_fix_comm;
								$rtwwwap_aff_prod_details[] = array(
						    					'product_id' 		=> $rtwwwap_product_id,
						    					'product_price' 	=> $rtwwwap_product_price,
						    					'commission_fix' 	=> $rtwwwap_prod_fix_comm,
						    					'commission_perc' 	=> '',
						    					'prod_commission' 	=> $rtwwwap_prod_comm
						    				);

					    		$rtwwwap_total_commission += $rtwwwap_prod_comm;
							}
							elseif( $rtwwwap_prod_fix_comm === '0' ){
								// no commission needs to be generated for this product
							}
							else{
								if( !empty( $rtwwwap_per_cat ) ){
									$rtwwwap_cat_per_comm = 0;
									$rtwwwap_cat_fix_comm = 0;
									$rtwwwap_flag = false;
									foreach( $rtwwwap_per_cat as $rtwwwap_key => $rtwwwap_value ){
										if( in_array( $rtwwwap_product_cat_id, $rtwwwap_value[ 'ids' ] ) ){
											$rtwwwap_cat_per_comm = $rtwwwap_value[ 'cat_percentage_commission' ];
											$rtwwwap_cat_fix_comm = $rtwwwap_value[ 'cat_fixed_commission' ];
											$rtwwwap_flag = true;

											break;
										}
									}
									if( $rtwwwap_flag ){
										if( $rtwwwap_cat_per_comm > 0 ){
											$rtwwwap_prod_comm = ( $rtwwwap_product_price * $rtwwwap_cat_per_comm ) / 100;
										}
										if( $rtwwwap_cat_fix_comm > 0 ){
											$rtwwwap_prod_comm += $rtwwwap_cat_fix_comm;
										}

										if( $rtwwwap_prod_comm != '' ){
											$rtwwwap_aff_prod_details[] = array(
								    					'product_id' 		=> $rtwwwap_product_id,
								    					'product_price' 	=> $rtwwwap_product_price,
								    					'commission_fix' 	=> $rtwwwap_cat_fix_comm,
								    					'commission_perc' 	=> $rtwwwap_cat_per_comm,
								    					'prod_commission' 	=> $rtwwwap_prod_comm
								    				);

							    			$rtwwwap_total_commission += $rtwwwap_prod_comm;
							    		}
									}
									else{
										if( $rtwwwap_all_commission ){
											if( $rtwwwap_all_commission_type == 'percentage' ){
												$rtwwwap_prod_comm += ( $rtwwwap_product_price * $rtwwwap_all_commission ) / 100;
											}
											elseif( $rtwwwap_all_commission_type == 'fixed' ){
												$rtwwwap_prod_comm += $rtwwwap_all_commission;
											}
											$rtwwwap_aff_prod_details[] = array(
								    					'product_id' 		=> $rtwwwap_product_id,
								    					'product_price' 	=> $rtwwwap_product_price,
								    					'commission_fix' 	=> '',
								    					'commission_perc' 	=> '',
								    					'prod_commission' 	=> $rtwwwap_prod_comm
								    				);

							    			$rtwwwap_total_commission += $rtwwwap_prod_comm;
							    		}
									}
								}
								else{
									if( $rtwwwap_all_commission ){
										if( $rtwwwap_all_commission_type == 'percentage' ){
											$rtwwwap_prod_comm += ( $rtwwwap_product_price * $rtwwwap_all_commission ) / 100;
										}
										elseif( $rtwwwap_all_commission_type == 'fixed' ){
											$rtwwwap_prod_comm += $rtwwwap_all_commission;
										}
										$rtwwwap_aff_prod_details[] = array(
							    					'product_id' 		=> $rtwwwap_product_id,
							    					'product_price' 	=> $rtwwwap_product_price,
							    					'commission_fix' 	=> '',
								    				'commission_perc' 	=> '',
							    					'prod_commission' 	=> $rtwwwap_prod_comm
							    				);

						    			$rtwwwap_total_commission += $rtwwwap_prod_comm;
						    		}
								}
							}
						}
						elseif( $rtwwwap_per_prod_mode == 3 ){
							$rtwwwap_prod_per_comm = get_post_meta( $rtwwwap_product_id, 'rtwwwap_percentage_commission_box', true );
							$rtwwwap_prod_fix_comm = get_post_meta( $rtwwwap_product_id, 'rtwwwap_fixed_commission_box', true );

							if( $rtwwwap_prod_per_comm > 0 ){
								$rtwwwap_prod_comm += ( $rtwwwap_product_price * $rtwwwap_prod_per_comm ) / 100;
							}

							if( $rtwwwap_prod_fix_comm > 0 ){
								$rtwwwap_prod_comm += $rtwwwap_prod_fix_comm;
							}

							if( $rtwwwap_prod_comm === '' ){
								if( $rtwwwap_prod_per_comm !== '0' && $rtwwwap_prod_fix_comm !== '0' ){
									if( !empty( $rtwwwap_per_cat ) ){
										$rtwwwap_cat_per_comm = 0;
										$rtwwwap_cat_fix_comm = 0;
										$rtwwwap_flag = false;
										foreach( $rtwwwap_per_cat as $rtwwwap_key => $rtwwwap_value ){
											if( in_array( $rtwwwap_product_cat_id, $rtwwwap_value[ 'ids' ] ) ){
												$rtwwwap_cat_per_comm = $rtwwwap_value[ 'cat_percentage_commission' ];
												$rtwwwap_cat_fix_comm = $rtwwwap_value[ 'cat_fixed_commission' ];
												$rtwwwap_flag = true;

												break;
											}
										}
										if( $rtwwwap_flag ){
											if( $rtwwwap_cat_per_comm > 0 ){
												$rtwwwap_prod_comm = ( $rtwwwap_product_price * $rtwwwap_cat_per_comm ) / 100;
											}
											if( $rtwwwap_cat_fix_comm > 0 ){
												$rtwwwap_prod_comm += $rtwwwap_cat_fix_comm;
											}

											if( $rtwwwap_prod_comm != '' ){
												$rtwwwap_aff_prod_details[] = array(
									    					'product_id' 		=> $rtwwwap_product_id,
									    					'product_price' 	=> $rtwwwap_product_price,
									    					'commission_fix' 	=> $rtwwwap_cat_fix_comm,
									    					'commission_perc' 	=> $rtwwwap_cat_per_comm,
									    					'prod_commission' 	=> $rtwwwap_prod_comm
									    				);

								    			$rtwwwap_total_commission += $rtwwwap_prod_comm;
								    		}
										}
										else{
											if( $rtwwwap_all_commission ){
												if( $rtwwwap_all_commission_type == 'percentage' ){
													$rtwwwap_prod_comm += ( $rtwwwap_product_price * $rtwwwap_all_commission ) / 100;
												}
												elseif( $rtwwwap_all_commission_type == 'fixed' ){
													$rtwwwap_prod_comm += $rtwwwap_all_commission;
												}
												$rtwwwap_aff_prod_details[] = array(
									    					'product_id' 		=> $rtwwwap_product_id,
									    					'product_price' 	=> $rtwwwap_product_price,
									    					'commission_fix' 	=> '',
									    					'commission_perc' 	=> '',
									    					'prod_commission' 	=> $rtwwwap_prod_comm
									    				);

								    			$rtwwwap_total_commission += $rtwwwap_prod_comm;
								    		}
										}
									}
									else{
										if( $rtwwwap_all_commission ){
											if( $rtwwwap_all_commission_type == 'percentage' ){
												$rtwwwap_prod_comm += ( $rtwwwap_product_price * $rtwwwap_all_commission ) / 100;
											}
											elseif( $rtwwwap_all_commission_type == 'fixed' ){
												$rtwwwap_prod_comm += $rtwwwap_all_commission;
											}
											$rtwwwap_aff_prod_details[] = array(
								    					'product_id' 		=> $rtwwwap_product_id,
								    					'product_price' 	=> $rtwwwap_product_price,
								    					'commission_fix' 	=> '',
									    				'commission_perc' 	=> '',
								    					'prod_commission' 	=> $rtwwwap_prod_comm
								    				);

							    			$rtwwwap_total_commission += $rtwwwap_prod_comm;
							    		}
									}
								}
							}
							else{
								$rtwwwap_aff_prod_details[] = array(
					    					'product_id' 		=> $rtwwwap_product_id,
					    					'product_price' 	=> $rtwwwap_product_price,
					    					'commission_fix' 	=> $rtwwwap_prod_fix_comm,
						    				'commission_perc' 	=> $rtwwwap_prod_per_comm,
					    					'prod_commission' 	=> $rtwwwap_prod_comm
					    				);

				    			$rtwwwap_total_commission += $rtwwwap_prod_comm;
							}
						}
						elseif( $rtwwwap_all_commission ){
							if( $rtwwwap_all_commission_type == 'percentage' ){
								$rtwwwap_prod_comm += ( $rtwwwap_product_price * $rtwwwap_all_commission ) / 100;
							}
							elseif( $rtwwwap_all_commission_type == 'fixed' ){
								$rtwwwap_prod_comm += $rtwwwap_all_commission;
							}
							$rtwwwap_aff_prod_details[] = array(
				    					'product_id' 		=> $rtwwwap_product_id,
				    					'product_price' 	=> $rtwwwap_product_price,
				    					'commission_fix' 	=> '',
					    				'commission_perc' 	=> '',
				    					'prod_commission' 	=> $rtwwwap_prod_comm
				    				);

			    			$rtwwwap_total_commission += $rtwwwap_prod_comm;
			    		}
					}
				}
			}
			else
			{
				$rtwwwap_levels_settings 	= get_option( 'rtwwwap_levels_settings_opt' );
				$rtwwwap_user_level 		= get_user_meta( $rtwwwap_user_id, 'rtwwwap_affiliate_level', true );
				$rtwwwap_user_level 		= ( $rtwwwap_user_level ) ? $rtwwwap_user_level : '0';

				$rtwwwap_user_level_details = isset( $rtwwwap_levels_settings[ $rtwwwap_user_level ] ) ? $rtwwwap_levels_settings[ $rtwwwap_user_level ] : '';

				if( !empty( $rtwwwap_user_level_details ) ){
					$rtwwwap_level_comm_type 		= $rtwwwap_user_level_details[ 'level_commission_type' ];
					$rtwwwap_level_comm_amount 		= $rtwwwap_user_level_details[ 'level_comm_amount' ];
					$rtwwwap_level_criteria_type 	= $rtwwwap_user_level_details[ 'level_criteria_type' ];
					$rtwwwap_level_criteria_val 	= $rtwwwap_user_level_details[ 'level_criteria_val' ];

					foreach( $rtwwwap_order->get_items() as $rtwwwap_item_key => $rtwwwap_item_values )
					{
						$rtwwwap_prod_comm 		= '';
						$rtwwwap_product_id 	= $rtwwwap_item_values->get_product_id();
						$rtwwwap_product_price	= $rtwwwap_item_values->get_total();

						if( $rtwwwap_commission_type == 0 )
						{
							if( $rtwwwap_level_comm_type == 0 ){
								$rtwwwap_prod_comm = ( $rtwwwap_product_price * $rtwwwap_level_comm_amount ) / 100;
								$rtwwwap_aff_prod_details[] = array(
						    					'product_id' 		=> $rtwwwap_product_id,
						    					'product_price' 	=> $rtwwwap_product_price,
						    					'commission_fix' 	=> 'user',
						    					'commission_perc' 	=> $rtwwwap_level_comm_amount,
						    					'prod_commission' 	=> $rtwwwap_prod_comm
						    				);

					    		$rtwwwap_total_commission += $rtwwwap_prod_comm;
							}
							else{
								$rtwwwap_prod_comm = $rtwwwap_level_comm_amount;
								$rtwwwap_aff_prod_details[] = array(
						    					'product_id' 		=> $rtwwwap_product_id,
						    					'product_price' 	=> $rtwwwap_product_price,
						    					'commission_fix' 	=> 'user',
						    					'commission_perc' 	=> $rtwwwap_level_comm_amount,
						    					'prod_commission' 	=> $rtwwwap_prod_comm
						    				);

					    		$rtwwwap_total_commission += $rtwwwap_prod_comm;
							}
						}
					}
				}
			}

			if( isset( $rtwwwap_total_commission ) && $rtwwwap_total_commission !== '' && $rtwwwap_total_commission !== 0 ){
				$rtwwwap_capped 		= 0;
				$rtwwwap_current_year 	= date("Y");
				$rtwwwap_current_month 	= date("m");

				$rtwwwap_commission_settings	= get_option( 'rtwwwap_commission_settings_opt' );
				$rtwwwap_max_comm 				= isset( $rtwwwap_commission_settings[ 'max_commission' ] ) ? $rtwwwap_commission_settings[ 'max_commission' ] : '0';

				if( $rtwwwap_max_comm != 0 )
				{
					$rtwwwap_month_commission 	= $wpdb->get_var( $wpdb->prepare( "SELECT SUM(`amount`) FROM ".$wpdb->prefix."rtwwwap_referrals WHERE YEAR(date)=%d AND MONTH(date)=%d AND `aff_id`=%d", $rtwwwap_current_year, $rtwwwap_current_month, $rtwwwap_user_id ) );
					$rtwwwap_month_commission 	= isset( $rtwwwap_month_commission ) ? $rtwwwap_month_commission : 0;

					if( $rtwwwap_month_commission < $rtwwwap_max_comm ){
						$rtwwwap_this_month_left = $rtwwwap_max_comm - $rtwwwap_month_commission;
						if( $rtwwwap_this_month_left < $rtwwwap_total_commission ){
							$rtwwwap_total_commission = $rtwwwap_this_month_left;
						}
						else{
							$rtwwwap_total_commission = $rtwwwap_total_commission;
						}
					}
					else{
						$rtwwwap_capped = 1;
					}
				}

				// inserting into DB
				if( !empty( $rtwwwap_aff_prod_details ) ){
					if( get_user_meta( $rtwwwap_user_id, 'rtwwwap_referral_mail', true ) == 'on' ){
						$rtwwwap_to 			= get_user_by( 'id', $rtwwwap_user_id );
						$rtwwwap_to 			= esc_html( $rtwwwap_to->user_email );
						$rtwwwap_subject 		= esc_html__( 'One new Referral', 'rtwwwap-wp-wc-affiliate-program' );
						$rtwwwap_message 		= sprintf( '%s %s%01.'.$rtwwwap_decimal_places, esc_html__( 'You got a new referral of amount', 'rtwwwap-wp-wc-affiliate-program' ), $rtwwwap_currency_sym, $rtwwwap_total_commission );
						$rtwwwap_from_name 		= esc_html( get_bloginfo( 'name' ) );
						$rtwwwap_from_email 	= esc_html( get_bloginfo( 'admin_email' ) );

						$rtwwwap_headers[] 		= sprintf( '%s: %s <%s>', esc_html__( 'From', 'rtwwwap-wp-wc-affiliate-program' ), $rtwwwap_from_name, $rtwwwap_from_email );

						// mail to affiliate
						wp_mail( $rtwwwap_to, $rtwwwap_subject, $rtwwwap_message, $rtwwwap_headers );

						$rtwwwap_extra_features = get_option( 'rtwwwap_extra_features_opt' );
						if( isset( $rtwwwap_extra_features[ 'mail_to_admin' ] ) && $rtwwwap_extra_features[ 'mail_to_admin' ] == 1 ){
							// mail to admin
							$rtwwwap_message = sprintf( '%s %s%01.'.$rtwwwap_decimal_places, esc_html__( 'Generated a new referral of amount', 'rtwwwap-wp-wc-affiliate-program' ), $rtwwwap_currency_sym, $rtwwwap_total_commission );
							wp_mail( $rtwwwap_from_email, $rtwwwap_subject, $rtwwwap_message, $rtwwwap_headers );
						}
					}

					$rtwwwap_aff_prod_details = json_encode( $rtwwwap_aff_prod_details );
					$rtwwwap_device = ( wp_is_mobile() ) ? 'mobile' : 'desktop';

					$rtwwwap_locale = get_locale();
					setlocale( LC_NUMERIC, $rtwwwap_locale );

					$rtwwwap_updated = $wpdb->insert(
			            $wpdb->prefix.'rtwwwap_referrals',
			            array(
			                'aff_id'    			=> $rtwwwap_user_id,
			                'type'    				=> 0,
			                'order_id'    			=> esc_html( $rtwwwap_order_id ),
			                'date'    				=> date( 'Y-m-d H:i:s' ),
			                'status'    			=> 0,
			                'amount'    			=> $rtwwwap_total_commission,
			                'capped'    			=> esc_html( $rtwwwap_capped ),
			                'currency'    			=> $rtwwwap_currency,
			                'product_details'   	=> $rtwwwap_aff_prod_details,
			                'device'   				=> $rtwwwap_device
			            )
			        );
			        $rtwwwap_lastid = $wpdb->insert_id;
			        setlocale( LC_ALL, $rtwwwap_locale );

			        if( $rtwwwap_updated ){
				        $rtwwwap_referral_noti = get_option( 'rtwwwap_referral_noti' )+1;
				        update_option( 'rtwwwap_referral_noti', $rtwwwap_referral_noti );
					}

					$rtwwwap_mlm = get_option( 'rtwwwap_mlm_opt' );
					if( isset( $rtwwwap_mlm[ 'activate' ] ) && $rtwwwap_mlm[ 'activate' ] == 1 )
					{
						$rtwwwap_child = isset( $rtwwwap_mlm[ 'child' ] ) ? $rtwwwap_mlm[ 'child' ] : 1;
						$rtwwwap_check_have_child = $this->rtwwwap_check_child_in_mlm( $rtwwwap_user_id, $rtwwwap_child );

						if( $rtwwwap_check_have_child ){
							$this->rtwwwap_give_mlm_comm( $rtwwwap_user_id, $rtwwwap_lastid, $rtwwwap_total_commission, $rtwwwap_currency, $rtwwwap_currency_sym, $rtwwwap_device, $rtwwwap_mlm[ 'mlm_levels' ], $rtwwwap_child, $rtwwwap_order_id );
						}
					}
				}
			}
			elseif( $rtwwwap_total_commission == 0 ){
				$rtwwwap_total_commission = $rtwwwap_order->get_subtotal();
				$rtwwwap_capped 		= 0;
				$rtwwwap_current_year 	= date("Y");
				$rtwwwap_current_month 	= date("m");
				$rtwwwap_device 		= ( wp_is_mobile() ) ? 'mobile' : 'desktop';

				$rtwwwap_commission_settings	= get_option( 'rtwwwap_commission_settings_opt' );
				$rtwwwap_max_comm 				= isset( $rtwwwap_commission_settings[ 'max_commission' ] ) ? $rtwwwap_commission_settings[ 'max_commission' ] : '0';

				$rtwwwap_mlm = get_option( 'rtwwwap_mlm_opt' );
				if( isset( $rtwwwap_mlm[ 'activate' ] ) && $rtwwwap_mlm[ 'activate' ] == 1 )
				{
					$rtwwwap_child = isset( $rtwwwap_mlm[ 'child' ] ) ? $rtwwwap_mlm[ 'child' ] : 1;
					$rtwwwap_check_have_child = $this->rtwwwap_check_child_in_mlm( get_current_user_id(), $rtwwwap_child );

					if( $rtwwwap_check_have_child ){
						$this->rtwwwap_give_mlm_comm( get_current_user_id(), '', $rtwwwap_total_commission, $rtwwwap_currency, $rtwwwap_currency_sym, $rtwwwap_device, $rtwwwap_mlm[ 'mlm_levels' ], $rtwwwap_child, $rtwwwap_order_id );
					}
				}
			}
		}
	}

	//common code for easy digital downloads

	function rtwwwap_referral_code_comm_easy( $rtwwwap_order_id ){
		global $wpdb;
		$rtwwwap_current_user_id = get_current_user_id();

		//get parent
		$rtwwwap_parent = $wpdb->get_var( $wpdb->prepare( "SELECT `parent_id` FROM ".$wpdb->prefix."rtwwwap_mlm WHERE `aff_id` = %d AND `status` = %d", $rtwwwap_current_user_id, 1 ) );

		if( $rtwwwap_parent ){
			$rtwwwap_user_id 	= $rtwwwap_parent;
			$rtwwwap_order 		= edd_get_payment( $rtwwwap_order_id );
			$rtwwwap_commission_settings = get_option( 'rtwwwap_commission_settings_opt' );
			$rtwwwap_comm_base 	= isset( $rtwwwap_commission_settings[ 'comm_base' ] ) ? $rtwwwap_commission_settings[ 'comm_base' ] : '1';
			$rtwwwap_total_commission	= 0;
			$rtwwwap_aff_prod_details 	= array();
			$rtwwwap_extra_features = get_option( 'rtwwwap_extra_features_opt' );
			$rtwwwap_decimal_places = $rtwwwap_extra_features['decimal_places'].'f';
			if( RTWWWAP_IS_WOO == 1 ){
				$rtwwwap_currency 		= get_woocommerce_currency();
				$rtwwwap_currency_sym 	= get_woocommerce_currency_symbol();
			}
			else{
				require_once( RTWWWAP_DIR.'includes/rtwaffiliatehelper.php' );

				$rtwwwap_currency 		= isset( $rtwwwap_extra_features[ 'currency' ] ) ? $rtwwwap_extra_features[ 'currency' ] : 'USD';
				$rtwwwap_curr_obj 		= new RtwAffiliateHelper();
				$rtwwwap_currency_sym 	= $rtwwwap_curr_obj->rtwwwap_curr_symbol( $rtwwwap_currency );
			}

			$rtwwwap_commission_type 	= 0;

			if( $rtwwwap_comm_base == 1 ){
				$rtwwwap_per_prod_mode 			= isset( $rtwwwap_commission_settings[ 'per_prod_mode' ] ) ? $rtwwwap_commission_settings[ 'per_prod_mode' ] : 0;
				$rtwwwap_all_commission 		= isset( $rtwwwap_commission_settings[ 'all_commission' ] ) ? $rtwwwap_commission_settings[ 'all_commission' ] : 0;
				$rtwwwap_all_commission_type 	= isset( $rtwwwap_commission_settings[ 'all_commission_type' ] ) ? $rtwwwap_commission_settings[ 'all_commission_type' ] : 'percentage';
				$rtwwwap_per_cat 				= isset( $rtwwwap_commission_settings[ 'per_cat' ] ) ? $rtwwwap_commission_settings[ 'per_cat' ] : array();
				
	
					foreach( $rtwwwap_order->cart_details as $rtwwwap_item_key => $rtwwwap_item_values )
					{
						$rtwwwap_prod_comm 		= '';
						$rtwwwap_product_id 	= $rtwwwap_item_values['ID'];
						$rtwwwap_product_price	= $rtwwwap_item_values['price'];					
						$rtwwwp_product_category_taxonomy = 'download_category';
						$rtwwwap_product_terms 	= get_the_terms( $rtwwwap_product_id, 'download_category' );
						$rtwwwap_product_cat_id = $rtwwwap_product_terms[0]->term_id;

					if( $rtwwwap_commission_type == 0 )
					{
					    if( $rtwwwap_per_prod_mode == 1 ){
							$rtwwwap_prod_per_comm = get_post_meta( $rtwwwap_product_id, 'rtwwwap_percentage_commission_box', true );

							if( $rtwwwap_prod_per_comm > 0 ){
								$rtwwwap_prod_comm = ( $rtwwwap_product_price * $rtwwwap_prod_per_comm ) / 100;
								$rtwwwap_aff_prod_details[] = array(
						    					'product_id' 		=> $rtwwwap_product_id,
						    					'product_price' 	=> $rtwwwap_product_price,
						    					'commission_fix' 	=> '',
						    					'commission_perc' 	=> $rtwwwap_prod_per_comm,
						    					'prod_commission' 	=> $rtwwwap_prod_comm
						    				);

					    		$rtwwwap_total_commission += $rtwwwap_prod_comm;
							}
							elseif( $rtwwwap_prod_per_comm === '0' ){
								// no commission needs to be generated for this product
							}
							else{
								if( !empty( $rtwwwap_per_cat ) ){
									$rtwwwap_cat_per_comm = 0;
									$rtwwwap_cat_fix_comm = 0;
									$rtwwwap_flag = false;
									foreach( $rtwwwap_per_cat as $rtwwwap_key => $rtwwwap_value ){
										if( in_array( $rtwwwap_product_cat_id, $rtwwwap_value[ 'ids' ] ) ){
											$rtwwwap_cat_per_comm = $rtwwwap_value[ 'cat_percentage_commission' ];
											$rtwwwap_cat_fix_comm = $rtwwwap_value[ 'cat_fixed_commission' ];
											$rtwwwap_flag = true;

											break;
										}
									}
									if( $rtwwwap_flag ){
										if( $rtwwwap_cat_per_comm > 0 ){
											$rtwwwap_prod_comm = ( $rtwwwap_product_price * $rtwwwap_cat_per_comm ) / 100;
										}
										if( $rtwwwap_cat_fix_comm > 0 ){
											$rtwwwap_prod_comm += $rtwwwap_cat_fix_comm;
										}

										if( $rtwwwap_prod_comm != '' ){
											$rtwwwap_aff_prod_details[] = array(
								    					'product_id' 		=> $rtwwwap_product_id,
								    					'product_price' 	=> $rtwwwap_product_price,
								    					'commission_fix' 	=> $rtwwwap_cat_fix_comm,
								    					'commission_perc' 	=> $rtwwwap_cat_per_comm,
								    					'prod_commission' 	=> $rtwwwap_prod_comm
								    				);

							    			$rtwwwap_total_commission += $rtwwwap_prod_comm;
							    		}
									}
									else{
										if( $rtwwwap_all_commission ){
											if( $rtwwwap_all_commission_type == 'percentage' ){
												$rtwwwap_prod_comm += ( $rtwwwap_product_price * $rtwwwap_all_commission ) / 100;
											}
											elseif( $rtwwwap_all_commission_type == 'fixed' ){
												$rtwwwap_prod_comm += $rtwwwap_all_commission;
											}
											$rtwwwap_aff_prod_details[] = array(
								    					'product_id' 		=> $rtwwwap_product_id,
								    					'product_price' 	=> $rtwwwap_product_price,
								    					'commission_fix' 	=> '',
								    					'commission_perc' 	=> '',
								    					'prod_commission' 	=> $rtwwwap_prod_comm
								    				);

							    			$rtwwwap_total_commission += $rtwwwap_prod_comm;
							    		}
									}
								}
								else{
									if( $rtwwwap_all_commission ){
										if( $rtwwwap_all_commission_type == 'percentage' ){
											$rtwwwap_prod_comm += ( $rtwwwap_product_price * $rtwwwap_all_commission ) / 100;
										}
										elseif( $rtwwwap_all_commission_type == 'fixed' ){
											$rtwwwap_prod_comm += $rtwwwap_all_commission;
										}
										$rtwwwap_aff_prod_details[] = array(
							    					'product_id' 		=> $rtwwwap_product_id,
							    					'product_price' 	=> $rtwwwap_product_price,
							    					'commission_fix' 	=> '',
								    				'commission_perc' 	=> '',
							    					'prod_commission' 	=> $rtwwwap_prod_comm
							    				);

						    			$rtwwwap_total_commission += $rtwwwap_prod_comm;
						    		}
								}
							}
						}
						elseif( $rtwwwap_per_prod_mode == 2 ){
							$rtwwwap_prod_fix_comm = get_post_meta( $rtwwwap_product_id, 'rtwwwap_fixed_commission_box', true );

							if( $rtwwwap_prod_fix_comm > 0 ){
								$rtwwwap_prod_comm = $rtwwwap_prod_fix_comm;
								$rtwwwap_aff_prod_details[] = array(
						    					'product_id' 		=> $rtwwwap_product_id,
						    					'product_price' 	=> $rtwwwap_product_price,
						    					'commission_fix' 	=> $rtwwwap_prod_fix_comm,
						    					'commission_perc' 	=> '',
						    					'prod_commission' 	=> $rtwwwap_prod_comm
						    				);

					    		$rtwwwap_total_commission += $rtwwwap_prod_comm;
							}
							elseif( $rtwwwap_prod_fix_comm === '0' ){
								// no commission needs to be generated for this product
							}
							else{
								if( !empty( $rtwwwap_per_cat ) ){
									$rtwwwap_cat_per_comm = 0;
									$rtwwwap_cat_fix_comm = 0;
									$rtwwwap_flag = false;
									foreach( $rtwwwap_per_cat as $rtwwwap_key => $rtwwwap_value ){
										if( in_array( $rtwwwap_product_cat_id, $rtwwwap_value[ 'ids' ] ) ){
											$rtwwwap_cat_per_comm = $rtwwwap_value[ 'cat_percentage_commission' ];
											$rtwwwap_cat_fix_comm = $rtwwwap_value[ 'cat_fixed_commission' ];
											$rtwwwap_flag = true;

											break;
										}
									}
									if( $rtwwwap_flag ){
										if( $rtwwwap_cat_per_comm > 0 ){
											$rtwwwap_prod_comm = ( $rtwwwap_product_price * $rtwwwap_cat_per_comm ) / 100;
										}
										if( $rtwwwap_cat_fix_comm > 0 ){
											$rtwwwap_prod_comm += $rtwwwap_cat_fix_comm;
										}

										if( $rtwwwap_prod_comm != '' ){
											$rtwwwap_aff_prod_details[] = array(
								    					'product_id' 		=> $rtwwwap_product_id,
								    					'product_price' 	=> $rtwwwap_product_price,
								    					'commission_fix' 	=> $rtwwwap_cat_fix_comm,
								    					'commission_perc' 	=> $rtwwwap_cat_per_comm,
								    					'prod_commission' 	=> $rtwwwap_prod_comm
								    				);

							    			$rtwwwap_total_commission += $rtwwwap_prod_comm;
							    		}
									}
									else{
										if( $rtwwwap_all_commission ){
											if( $rtwwwap_all_commission_type == 'percentage' ){
												$rtwwwap_prod_comm += ( $rtwwwap_product_price * $rtwwwap_all_commission ) / 100;
											}
											elseif( $rtwwwap_all_commission_type == 'fixed' ){
												$rtwwwap_prod_comm += $rtwwwap_all_commission;
											}
											$rtwwwap_aff_prod_details[] = array(
								    					'product_id' 		=> $rtwwwap_product_id,
								    					'product_price' 	=> $rtwwwap_product_price,
								    					'commission_fix' 	=> '',
								    					'commission_perc' 	=> '',
								    					'prod_commission' 	=> $rtwwwap_prod_comm
								    				);

							    			$rtwwwap_total_commission += $rtwwwap_prod_comm;
							    		}
									}
								}
								else{
									if( $rtwwwap_all_commission ){
										if( $rtwwwap_all_commission_type == 'percentage' ){
											$rtwwwap_prod_comm += ( $rtwwwap_product_price * $rtwwwap_all_commission ) / 100;
										}
										elseif( $rtwwwap_all_commission_type == 'fixed' ){
											$rtwwwap_prod_comm += $rtwwwap_all_commission;
										}
										$rtwwwap_aff_prod_details[] = array(
							    					'product_id' 		=> $rtwwwap_product_id,
							    					'product_price' 	=> $rtwwwap_product_price,
							    					'commission_fix' 	=> '',
								    				'commission_perc' 	=> '',
							    					'prod_commission' 	=> $rtwwwap_prod_comm
							    				);

						    			$rtwwwap_total_commission += $rtwwwap_prod_comm;
						    		}
								}
							}
						}
						elseif( $rtwwwap_per_prod_mode == 3 ){
							$rtwwwap_prod_per_comm = get_post_meta( $rtwwwap_product_id, 'rtwwwap_percentage_commission_box', true );
							$rtwwwap_prod_fix_comm = get_post_meta( $rtwwwap_product_id, 'rtwwwap_fixed_commission_box', true );

							if( $rtwwwap_prod_per_comm > 0 ){
								$rtwwwap_prod_comm += ( $rtwwwap_product_price * $rtwwwap_prod_per_comm ) / 100;
							}

							if( $rtwwwap_prod_fix_comm > 0 ){
								$rtwwwap_prod_comm += $rtwwwap_prod_fix_comm;
							}

							if( $rtwwwap_prod_comm === '' ){
								if( $rtwwwap_prod_per_comm !== '0' && $rtwwwap_prod_fix_comm !== '0' ){
									if( !empty( $rtwwwap_per_cat ) ){
										$rtwwwap_cat_per_comm = 0;
										$rtwwwap_cat_fix_comm = 0;
										$rtwwwap_flag = false;
										foreach( $rtwwwap_per_cat as $rtwwwap_key => $rtwwwap_value ){
											if( in_array( $rtwwwap_product_cat_id, $rtwwwap_value[ 'ids' ] ) ){
												$rtwwwap_cat_per_comm = $rtwwwap_value[ 'cat_percentage_commission' ];
												$rtwwwap_cat_fix_comm = $rtwwwap_value[ 'cat_fixed_commission' ];
												$rtwwwap_flag = true;

												break;
											}
										}
										if( $rtwwwap_flag ){
											if( $rtwwwap_cat_per_comm > 0 ){
												$rtwwwap_prod_comm = ( $rtwwwap_product_price * $rtwwwap_cat_per_comm ) / 100;
											}
											if( $rtwwwap_cat_fix_comm > 0 ){
												$rtwwwap_prod_comm += $rtwwwap_cat_fix_comm;
											}

											if( $rtwwwap_prod_comm != '' ){
												$rtwwwap_aff_prod_details[] = array(
									    					'product_id' 		=> $rtwwwap_product_id,
									    					'product_price' 	=> $rtwwwap_product_price,
									    					'commission_fix' 	=> $rtwwwap_cat_fix_comm,
									    					'commission_perc' 	=> $rtwwwap_cat_per_comm,
									    					'prod_commission' 	=> $rtwwwap_prod_comm
									    				);

								    			$rtwwwap_total_commission += $rtwwwap_prod_comm;
								    		}
										}
										else{
											if( $rtwwwap_all_commission ){
												if( $rtwwwap_all_commission_type == 'percentage' ){
													$rtwwwap_prod_comm += ( $rtwwwap_product_price * $rtwwwap_all_commission ) / 100;
												}
												elseif( $rtwwwap_all_commission_type == 'fixed' ){
													$rtwwwap_prod_comm += $rtwwwap_all_commission;
												}
												$rtwwwap_aff_prod_details[] = array(
									    					'product_id' 		=> $rtwwwap_product_id,
									    					'product_price' 	=> $rtwwwap_product_price,
									    					'commission_fix' 	=> '',
									    					'commission_perc' 	=> '',
									    					'prod_commission' 	=> $rtwwwap_prod_comm
									    				);

								    			$rtwwwap_total_commission += $rtwwwap_prod_comm;
								    		}
										}
									}
									else{
										if( $rtwwwap_all_commission ){
											if( $rtwwwap_all_commission_type == 'percentage' ){
												$rtwwwap_prod_comm += ( $rtwwwap_product_price * $rtwwwap_all_commission ) / 100;
											}
											elseif( $rtwwwap_all_commission_type == 'fixed' ){
												$rtwwwap_prod_comm += $rtwwwap_all_commission;
											}
											$rtwwwap_aff_prod_details[] = array(
								    					'product_id' 		=> $rtwwwap_product_id,
								    					'product_price' 	=> $rtwwwap_product_price,
								    					'commission_fix' 	=> '',
									    				'commission_perc' 	=> '',
								    					'prod_commission' 	=> $rtwwwap_prod_comm
								    				);

							    			$rtwwwap_total_commission += $rtwwwap_prod_comm;
							    		}
									}
								}
							}
							else{
								$rtwwwap_aff_prod_details[] = array(
					    					'product_id' 		=> $rtwwwap_product_id,
					    					'product_price' 	=> $rtwwwap_product_price,
					    					'commission_fix' 	=> $rtwwwap_prod_fix_comm,
						    				'commission_perc' 	=> $rtwwwap_prod_per_comm,
					    					'prod_commission' 	=> $rtwwwap_prod_comm
					    				);

				    			$rtwwwap_total_commission += $rtwwwap_prod_comm;
							}
						}
						elseif( $rtwwwap_all_commission ){
							if( $rtwwwap_all_commission_type == 'percentage' ){
								$rtwwwap_prod_comm += ( $rtwwwap_product_price * $rtwwwap_all_commission ) / 100;
							}
							elseif( $rtwwwap_all_commission_type == 'fixed' ){
								$rtwwwap_prod_comm += $rtwwwap_all_commission;
							}
							$rtwwwap_aff_prod_details[] = array(
				    					'product_id' 		=> $rtwwwap_product_id,
				    					'product_price' 	=> $rtwwwap_product_price,
				    					'commission_fix' 	=> '',
					    				'commission_perc' 	=> '',
				    					'prod_commission' 	=> $rtwwwap_prod_comm
				    				);

			    			$rtwwwap_total_commission += $rtwwwap_prod_comm;
			    		}
					}
				}
			}
			else
			{
				$rtwwwap_levels_settings 	= get_option( 'rtwwwap_levels_settings_opt' );
				$rtwwwap_user_level 		= get_user_meta( $rtwwwap_user_id, 'rtwwwap_affiliate_level', true );
				$rtwwwap_user_level 		= ( $rtwwwap_user_level ) ? $rtwwwap_user_level : '0';

				$rtwwwap_user_level_details = isset( $rtwwwap_levels_settings[ $rtwwwap_user_level ] ) ? $rtwwwap_levels_settings[ $rtwwwap_user_level ] : '';

				if( !empty( $rtwwwap_user_level_details ) ){
					$rtwwwap_level_comm_type 		= $rtwwwap_user_level_details[ 'level_commission_type' ];
					$rtwwwap_level_comm_amount 		= $rtwwwap_user_level_details[ 'level_comm_amount' ];
					$rtwwwap_level_criteria_type 	= $rtwwwap_user_level_details[ 'level_criteria_type' ];
					$rtwwwap_level_criteria_val 	= $rtwwwap_user_level_details[ 'level_criteria_val' ];

					foreach( $rtwwwap_order->cart_details as $rtwwwap_item_key => $rtwwwap_item_values )
					{
						$rtwwwap_prod_comm 		= '';
						$rtwwwap_product_id 	= $rtwwwap_item_values['ID'];
						$rtwwwap_product_price	= $rtwwwap_item_values['price'];	

						if( $rtwwwap_commission_type == 0 )
						{
							if( $rtwwwap_level_comm_type == 0 ){
								$rtwwwap_prod_comm = ( $rtwwwap_product_price * $rtwwwap_level_comm_amount ) / 100;
								$rtwwwap_aff_prod_details[] = array(
						    					'product_id' 		=> $rtwwwap_product_id,
						    					'product_price' 	=> $rtwwwap_product_price,
						    					'commission_fix' 	=> 'user',
						    					'commission_perc' 	=> $rtwwwap_level_comm_amount,
						    					'prod_commission' 	=> $rtwwwap_prod_comm
						    				);

					    		$rtwwwap_total_commission += $rtwwwap_prod_comm;
							}
							else{
								$rtwwwap_prod_comm = $rtwwwap_level_comm_amount;
								$rtwwwap_aff_prod_details[] = array(
						    					'product_id' 		=> $rtwwwap_product_id,
						    					'product_price' 	=> $rtwwwap_product_price,
						    					'commission_fix' 	=> 'user',
						    					'commission_perc' 	=> $rtwwwap_level_comm_amount,
						    					'prod_commission' 	=> $rtwwwap_prod_comm
						    				);

					    		$rtwwwap_total_commission += $rtwwwap_prod_comm;
							}
						}
					}
				}
			}

			if( isset( $rtwwwap_total_commission ) && $rtwwwap_total_commission !== '' && $rtwwwap_total_commission !== 0 ){
				$rtwwwap_capped 		= 0;
				$rtwwwap_current_year 	= date("Y");
				$rtwwwap_current_month 	= date("m");

				$rtwwwap_commission_settings	= get_option( 'rtwwwap_commission_settings_opt' );
				$rtwwwap_max_comm 				= isset( $rtwwwap_commission_settings[ 'max_commission' ] ) ? $rtwwwap_commission_settings[ 'max_commission' ] : '0';

				if( $rtwwwap_max_comm != 0 )
				{
					$rtwwwap_month_commission 	= $wpdb->get_var( $wpdb->prepare( "SELECT SUM(`amount`) FROM ".$wpdb->prefix."rtwwwap_referrals WHERE YEAR(date)=%d AND MONTH(date)=%d AND `aff_id`=%d", $rtwwwap_current_year, $rtwwwap_current_month, $rtwwwap_user_id ) );
					$rtwwwap_month_commission 	= isset( $rtwwwap_month_commission ) ? $rtwwwap_month_commission : 0;

					if( $rtwwwap_month_commission < $rtwwwap_max_comm ){
						$rtwwwap_this_month_left = $rtwwwap_max_comm - $rtwwwap_month_commission;
						if( $rtwwwap_this_month_left < $rtwwwap_total_commission ){
							$rtwwwap_total_commission = $rtwwwap_this_month_left;
						}
						else{
							$rtwwwap_total_commission = $rtwwwap_total_commission;
						}
					}
					else{
						$rtwwwap_capped = 1;
					}
				}

				// inserting into DB
				if( !empty( $rtwwwap_aff_prod_details ) ){
					if( get_user_meta( $rtwwwap_user_id, 'rtwwwap_referral_mail', true ) == 'on' ){
						$rtwwwap_to 			= get_user_by( 'id', $rtwwwap_user_id );
						$rtwwwap_to 			= esc_html( $rtwwwap_to->user_email );
						$rtwwwap_subject 		= esc_html__( 'One new Referral', 'rtwwwap-wp-wc-affiliate-program' );
						$rtwwwap_message 		= sprintf( '%s %s%01.'.$rtwwwap_decimal_places, esc_html__( 'You got a new referral of amount', 'rtwwwap-wp-wc-affiliate-program' ), $rtwwwap_currency_sym, $rtwwwap_total_commission );
						$rtwwwap_from_name 		= esc_html( get_bloginfo( 'name' ) );
						$rtwwwap_from_email 	= esc_html( get_bloginfo( 'admin_email' ) );

						$rtwwwap_headers[] 		= sprintf( '%s: %s <%s>', esc_html__( 'From', 'rtwwwap-wp-wc-affiliate-program' ), $rtwwwap_from_name, $rtwwwap_from_email );

						// mail to affiliate
						wp_mail( $rtwwwap_to, $rtwwwap_subject, $rtwwwap_message, $rtwwwap_headers );

						$rtwwwap_extra_features = get_option( 'rtwwwap_extra_features_opt' );
						if( isset( $rtwwwap_extra_features[ 'mail_to_admin' ] ) && $rtwwwap_extra_features[ 'mail_to_admin' ] == 1 ){
							// mail to admin
							$rtwwwap_message = sprintf( '%s %s%01.'.$rtwwwap_decimal_places, esc_html__( 'Generated a new referral of amount', 'rtwwwap-wp-wc-affiliate-program' ), $rtwwwap_currency_sym, $rtwwwap_total_commission );
							wp_mail( $rtwwwap_from_email, $rtwwwap_subject, $rtwwwap_message, $rtwwwap_headers );
						}
					}

					$rtwwwap_aff_prod_details = json_encode( $rtwwwap_aff_prod_details );
					$rtwwwap_device = ( wp_is_mobile() ) ? 'mobile' : 'desktop';

					$rtwwwap_locale = get_locale();
					setlocale( LC_NUMERIC, $rtwwwap_locale );

					$rtwwwap_updated = $wpdb->insert(
			            $wpdb->prefix.'rtwwwap_referrals',
			            array(
			                'aff_id'    			=> $rtwwwap_user_id,
			                'type'    				=> 0,
			                'order_id'    			=> esc_html( $rtwwwap_order_id ),
			                'date'    				=> date( 'Y-m-d H:i:s' ),
			                'status'    			=> 0,
			                'amount'    			=> $rtwwwap_total_commission,
			                'capped'    			=> esc_html( $rtwwwap_capped ),
			                'currency'    			=> $rtwwwap_currency,
			                'product_details'   	=> $rtwwwap_aff_prod_details,
			                'device'   				=> $rtwwwap_device
			            )
			        );
			        $rtwwwap_lastid = $wpdb->insert_id;
			        setlocale( LC_ALL, $rtwwwap_locale );

			        if( $rtwwwap_updated ){
				        $rtwwwap_referral_noti = get_option( 'rtwwwap_referral_noti' )+1;
				        update_option( 'rtwwwap_referral_noti', $rtwwwap_referral_noti );
					}

					$rtwwwap_mlm = get_option( 'rtwwwap_mlm_opt' );
					if( isset( $rtwwwap_mlm[ 'activate' ] ) && $rtwwwap_mlm[ 'activate' ] == 1 )
					{
						$rtwwwap_child = isset( $rtwwwap_mlm[ 'child' ] ) ? $rtwwwap_mlm[ 'child' ] : 1;
						$rtwwwap_check_have_child = $this->rtwwwap_check_child_in_mlm( $rtwwwap_user_id, $rtwwwap_child );

						if( $rtwwwap_check_have_child ){
							$this->rtwwwap_give_mlm_comm( $rtwwwap_user_id, $rtwwwap_lastid, $rtwwwap_total_commission, $rtwwwap_currency, $rtwwwap_currency_sym, $rtwwwap_device, $rtwwwap_mlm[ 'mlm_levels' ], $rtwwwap_child, $rtwwwap_order_id );
						}
					}
				}
			}
			elseif( $rtwwwap_total_commission == 0 ){
				$rtwwwap_total_commission = $rtwwwap_order->get_subtotal();
				$rtwwwap_capped 		= 0;
				$rtwwwap_current_year 	= date("Y");
				$rtwwwap_current_month 	= date("m");
				$rtwwwap_device 		= ( wp_is_mobile() ) ? 'mobile' : 'desktop';

				$rtwwwap_commission_settings	= get_option( 'rtwwwap_commission_settings_opt' );
				$rtwwwap_max_comm 				= isset( $rtwwwap_commission_settings[ 'max_commission' ] ) ? $rtwwwap_commission_settings[ 'max_commission' ] : '0';

				$rtwwwap_mlm = get_option( 'rtwwwap_mlm_opt' );
				if( isset( $rtwwwap_mlm[ 'activate' ] ) && $rtwwwap_mlm[ 'activate' ] == 1 )
				{
					$rtwwwap_child = isset( $rtwwwap_mlm[ 'child' ] ) ? $rtwwwap_mlm[ 'child' ] : 1;
					$rtwwwap_check_have_child = $this->rtwwwap_check_child_in_mlm( get_current_user_id(), $rtwwwap_child );

					if( $rtwwwap_check_have_child ){
						$this->rtwwwap_give_mlm_comm( get_current_user_id(), '', $rtwwwap_total_commission, $rtwwwap_currency, $rtwwwap_currency_sym, $rtwwwap_device, $rtwwwap_mlm[ 'mlm_levels' ], $rtwwwap_child, $rtwwwap_order_id );
					}
				}
			}
		}
	}




	/*
	* To Search products for creating banner
	*/
	function rtwwwap_search_prod_callback(){
		$rtwwwap_check_ajax = check_ajax_referer( 'rtwwwap-ajax-security-string', 'rtwwwap_security_check' );

		if ( $rtwwwap_check_ajax ) {
			$rtwwwap_prod_name 	= sanitize_text_field( $_POST[ 'rtwwwap_prod_name' ] );
			$rtwwwap_cat_id 	= sanitize_text_field( $_POST[ 'rtwwwap_cat_id' ] );

			global $wpdb;
			$rtwwwap_wild = '%';
			$rtwwwap_like = $rtwwwap_wild . $wpdb->esc_like( $rtwwwap_prod_name ) . $rtwwwap_wild;
			if(RTWWWAP_IS_WOO)
			{
				$rtwwwap_post_type = 'product';
			}
			else
			{
				$rtwwwap_post_type = 'download';
			}
		
			$rtwwwap_query = $wpdb->prepare( "SELECT * FROM ".$wpdb->posts." JOIN ".$wpdb->term_relationships." ON ".$wpdb->posts.".`ID` = ".$wpdb->term_relationships.".`object_id` JOIN ".$wpdb->term_taxonomy." ON ".$wpdb->term_relationships.".`term_taxonomy_id` = ".$wpdb->term_taxonomy.".`term_taxonomy_id` WHERE ".$wpdb->posts.".`post_title` LIKE %s AND ".$wpdb->posts.".`post_type` LIKE '".$rtwwwap_post_type."' AND ".$wpdb->term_taxonomy.".`term_id` =%d", $rtwwwap_like, $rtwwwap_cat_id );
			$rtwwwap_prods = $wpdb->get_results( $rtwwwap_query, ARRAY_A );
			
			$rtwwwap_html = '';
			

			if( !empty( $rtwwwap_prods ) ){
				if( RTWWWAP_IS_WOO == 1 ){
					$rtwwwap_currency 		= get_woocommerce_currency();
					$rtwwwap_currency_sym 	= get_woocommerce_currency_symbol();
				}
				else{
					require_once( RTWWWAP_DIR.'includes/rtwaffiliatehelper.php' );
	
					$rtwwwap_currency 		= isset( $rtwwwap_extra_features[ 'currency' ] ) ? $rtwwwap_extra_features[ 'currency' ] : 'USD';
					$rtwwwap_curr_obj 		= new RtwAffiliateHelper();
					$rtwwwap_currency_sym 	= $rtwwwap_curr_obj->rtwwwap_curr_symbol( $rtwwwap_currency );
				}

				foreach( $rtwwwap_prods as $rtwwwap_key => $rtwwwap_value ){
					$rtwwwap_img_url 	= wp_get_attachment_image_src( get_post_thumbnail_id( $rtwwwap_value[ 'ID' ] ), 'full' );
					$rtwwwap_prod_url 	= get_permalink( $rtwwwap_value[ 'ID' ], false );
					
					if(RTWWWAP_IS_Easy == 1){

							$rtwwwap_prod_price = new EDD_Download( $rtwwwap_value[ 'ID' ] );
							
							$rtwwwap_html .= 	'<div class="rtwwwap_searched_prod">';
							$rtwwwap_html .= 		'<img src="'.esc_url( $rtwwwap_img_url[0] ).'" class="rtwwwap_prod_img" alt="">';
							$rtwwwap_html .= 		'<div class="rtwwwap_inner">';
							$rtwwwap_html .= 			'<div>';
							$rtwwwap_html .= 				'<p class="rtwwwap_prod_name">'.$rtwwwap_value[ 'post_title' ].'</p>';
							$rtwwwap_html .= 				'<p class="rtwwwap_prod_price">'.$rtwwwap_currency_sym.$rtwwwap_prod_price->price.'</p>';
							$rtwwwap_html .= 			'</div>';
							$rtwwwap_html .= 			'<p data-rtwwwap_id="'.esc_attr( $rtwwwap_value[ 'ID' ] ).'" data-rtwwwap_title="'.esc_attr( $rtwwwap_value[ 'post_title' ] ).'" data-rtwwwap_url="'.esc_attr( esc_url( $rtwwwap_prod_url ) ).'" data-rtwwwap_displayprice="'.esc_attr( $rtwwwap_prod_price->price ).'" data-rtwwwap_image="'.esc_attr( $rtwwwap_img_url[0] ).'" >';
							$rtwwwap_html .= 				'<input type="button" id="rtwwwap_create_link" value="'.esc_attr__( "Link", "rtwwwap-wp-wc-affiliate-program" ).'" />';
							$rtwwwap_html .= 				'<input type="button" id="rtwwwap_create_banner" value="'.esc_attr__( "Banner", "rtwwwap-wp-wc-affiliate-program" ).'" />';
							$rtwwwap_html .= 			'</p>';
							$rtwwwap_html .= 		'</div>';
							$rtwwwap_html .= 	'</div>';

					}
					if(RTWWWAP_IS_WOO == 1){

						$rtwwwap_prod_price = new WC_Product( $rtwwwap_value[ 'ID' ] );	
						$rtwwwap_html .= 	'<div class="rtwwwap_searched_prod">';
						$rtwwwap_html .= 		'<img src="'.esc_url( $rtwwwap_img_url[0] ).'" class="rtwwwap_prod_img" alt="">';
						$rtwwwap_html .= 		'<div class="rtwwwap_inner">';
						$rtwwwap_html .= 			'<div>';
						$rtwwwap_html .= 				'<p class="rtwwwap_prod_name">'.$rtwwwap_value[ 'post_title' ].'</p>';
						$rtwwwap_html .= 				'<p class="rtwwwap_prod_price">'.$rtwwwap_prod_price->get_price_html().'</p>';
						$rtwwwap_html .= 			'</div>';
						$rtwwwap_html .= 			'<p data-rtwwwap_id="'.esc_attr( $rtwwwap_value[ 'ID' ] ).'" data-rtwwwap_title="'.esc_attr( $rtwwwap_value[ 'post_title' ] ).'" data-rtwwwap_url="'.esc_attr( esc_url( $rtwwwap_prod_url ) ).'" data-rtwwwap_displayprice="'.esc_attr( $rtwwwap_prod_price->get_price_html() ).'" data-rtwwwap_image="'.esc_attr( $rtwwwap_img_url[0] ).'" >';
						$rtwwwap_html .= 				'<input type="button" id="rtwwwap_create_link" value="'.esc_attr__( "Link", "rtwwwap-wp-wc-affiliate-program" ).'" />';
						$rtwwwap_html .= 				'<input type="button" id="rtwwwap_create_banner" value="'.esc_attr__( "Banner", "rtwwwap-wp-wc-affiliate-program" ).'" />';
						$rtwwwap_html .= 			'</p>';
						$rtwwwap_html .= 		'</div>';
						$rtwwwap_html .= 	'</div>';
					}
					
				}
			}

			if( empty( $rtwwwap_prods ) ){
				$rtwwwap_message = esc_html__( 'No Result Found', 'rtwwwap-wp-wc-affiliate-program' );
			}

			echo json_encode( array( 'rtwwwap_products' => $rtwwwap_html, 'rtwwwap_message' => $rtwwwap_message ) );
			die;
		}
	}

	/*
	* To generate CSV of a category
	*/
	function rtwwwap_generate_csv_callback(){
		$rtwwwap_verification_done = get_option( 'rtwwwap_verification_done', array() );
		$rtwwwap_verification_done_status = isset($rtwwwap_verification_done['status']) ? $rtwwwap_verification_done['status'] : false;
		$rtwwwap_verification_done_purchase = isset($rtwwwap_verification_done['purchase_code']) ? $rtwwwap_verification_done['purchase_code'] : false;
		
	
		if(RTWWWAP_IS_WOO == 1 )
						{
							$rtwwwp_product_category_taxonomy = 'product_cat';
						}
		else if(RTWWWAP_IS_Easy == 1 )
						{
							$rtwwwp_product_category_taxonomy = 'download_category';
						}
		if( empty( $rtwwwap_verification_done ) || $rtwwwap_verification_done_status == false || empty($rtwwwap_verification_done_purchase) )
		{
			
			return ;
		}
		$rtwwwap_check_ajax = check_ajax_referer( 'rtwwwap-ajax-security-string', 'rtwwwap_security_check' );

		if ( $rtwwwap_check_ajax ){
			$rtwwwap_cat_id 	= sanitize_text_field( $_POST[ 'rtwwwap_cat_id' ] );
			
			$rtwwwap_term 		= get_term_by( 'id', $rtwwwap_cat_id, $rtwwwp_product_category_taxonomy );
			$rtwwwap_cat_name 	= esc_html( $rtwwwap_term->name );


			if(RTWWWAP_IS_WOO == 1)
			{
				$rtwwwap_post_type = 'product';
			}
			else
			{
				$rtwwwap_post_type = 'download';
			}	

			$rtwwwap_args = array(
			    'post_type'             => $rtwwwap_post_type,
			    'post_status'           => 'publish',
			    'ignore_sticky_posts'   => 1,
			    'posts_per_page'        => '12',
			    'tax_query'             => array(
			        array(
			            'taxonomy'      => $rtwwwp_product_category_taxonomy,
			            'field' 		=> 'term_id', //This is optional, as it defaults to 'term_id'
			            'terms'         => $rtwwwap_cat_id,
			            'operator'      => 'IN' // Possible values are 'IN', 'NOT IN', 'AND'.
			        )
			    )
			);
			
			
			$rtwwwap_products = new WP_Query( $rtwwwap_args );
		
			$rtwwwap_user_id 	= get_current_user_id();
			
			$rtwwwap_userdata 	= get_userdata( $rtwwwap_user_id );
		
			$rtwwwap_user_name 	= $rtwwwap_userdata->data->user_login;
		
			require_once RTWWWAP_DIR."third_party/PHPExcel.php";
			$rtwwwap_excel_obj = new PHPExcel();
			$rtwwwap_excel_obj->setActiveSheetIndex(0);
			$rtwwwap_excel_obj->getActiveSheet()->setTitle( esc_html__( 'Labels Export', 'rtwwwap-wp-wc-affiliate-program' ) );
			$rtwwwap_counter = 1;
			$rtwwwap_excel_obj->getActiveSheet()->setCellValue( 'A'.$rtwwwap_counter, esc_html__( 'S.no.', 'rtwwwap-wp-wc-affiliate-program' ) )->getStyle( 'A'.$rtwwwap_counter )->getFont()->setBold(true);
			$rtwwwap_excel_obj->getActiveSheet()->setCellValue( 'B'.$rtwwwap_counter, esc_html__( 'Product Name', 'rtwwwap-wp-wc-affiliate-program' ) )->getStyle( 'B'.$rtwwwap_counter )->getFont()->setBold(true);
			$rtwwwap_excel_obj->getActiveSheet()->setCellValue( 'C'.$rtwwwap_counter, esc_html__( 'URL', 'rtwwwap-wp-wc-affiliate-program' ) )->getStyle( 'C'.$rtwwwap_counter )->getFont()->setBold(true);
			$rtwwwap_excel_obj->getActiveSheet()->setCellValue( 'D'.$rtwwwap_counter, esc_html__( 'Category', 'rtwwwap-wp-wc-affiliate-program' ) )->getStyle( 'D'.$rtwwwap_counter )->getFont()->setBold(true);
			$rtwwwap_excel_obj->getActiveSheet()->setCellValue( 'E'.$rtwwwap_counter, esc_html__( 'Description', 'rtwwwap-wp-wc-affiliate-program' ) )->getStyle( 'E'.$rtwwwap_counter )->getFont()->setBold(true);
			$rtwwwap_excel_obj->getActiveSheet()->setCellValue( 'F'.$rtwwwap_counter, esc_html__( 'List Price', 'rtwwwap-wp-wc-affiliate-program' ) )->getStyle( 'F'.$rtwwwap_counter )->getFont()->setBold(true);
			$rtwwwap_excel_obj->getActiveSheet()->setCellValue( 'G'.$rtwwwap_counter, esc_html__( 'Sale Price', 'rtwwwap-wp-wc-affiliate-program' ) )->getStyle( 'G'.$rtwwwap_counter )->getFont()->setBold(true);

			foreach( $rtwwwap_products->posts as $rtwwwap_key => $rtwwwap_value ){
	
				$rtwwwap_reff_url 		= get_permalink( $rtwwwap_value->ID );
				
				$rtwwwap_generated_url 	= '';
				if( strpos( $rtwwwap_reff_url, '?' ) ){
					$rtwwwap_generated_url = $rtwwwap_reff_url.'&rtwwwap_aff='.$rtwwwap_user_name.'_'.$rtwwwap_user_id;
				}
				else{
    	    		$rtwwwap_generated_url = $rtwwwap_reff_url.'?rtwwwap_aff='.$rtwwwap_user_name.'_'.$rtwwwap_user_id;
    	    	}
				$rtwwwap_counter++;
				if(RTWWWAP_IS_WOO == 1)
				 {
					$rtwwwap_prod_price = new WC_Product( $rtwwwap_value->ID );
				 }
				elseif(RTWWWAP_IS_Easy == 1 )
				{
					$rtwwwap_prod_price = new EDD_Download( $rtwwwap_value->ID );
				}
				$rtwwwap_excel_obj->getActiveSheet()->setCellValue( 'A'.$rtwwwap_counter, esc_html( $rtwwwap_counter-1 ) );
				$rtwwwap_excel_obj->getActiveSheet()->setCellValue( 'B'.$rtwwwap_counter, esc_html( $rtwwwap_value->post_name ) );
				$rtwwwap_excel_obj->getActiveSheet()->setCellValue( 'C'.$rtwwwap_counter, esc_html( $rtwwwap_generated_url ) );
				$rtwwwap_excel_obj->getActiveSheet()->setCellValue( 'D'.$rtwwwap_counter, esc_html( $rtwwwap_cat_name ) );
				$rtwwwap_excel_obj->getActiveSheet()->setCellValue( 'E'.$rtwwwap_counter, esc_html( $rtwwwap_value->post_content ) );
				$rtwwwap_excel_obj->getActiveSheet()->setCellValue( 'F'.$rtwwwap_counter, esc_html( $rtwwwap_prod_price->price ) );
				$rtwwwap_excel_obj->getActiveSheet()->getStyle( 'F'.$rtwwwap_counter)->getAlignment()->setWrapText(true);
				$rtwwwap_excel_obj->getActiveSheet()->setCellValue( 'G'.$rtwwwap_counter, esc_html( $rtwwwap_prod_price->price  ) );
			}


			$rtwwwap_excel_obj->getActiveSheet()->getColumnDimension('A')->setWidth(20);
			$rtwwwap_excel_obj->getActiveSheet()->getColumnDimension('B')->setWidth(20);
			$rtwwwap_excel_obj->getActiveSheet()->getColumnDimension('C')->setWidth(80);
			$rtwwwap_excel_obj->getActiveSheet()->getColumnDimension('D')->setWidth(20);
			$rtwwwap_excel_obj->getActiveSheet()->getColumnDimension('E')->setWidth(120);
			$rtwwwap_excel_obj->getActiveSheet()->getColumnDimension('F')->setWidth(20);
			$rtwwwap_excel_obj->getActiveSheet()->getColumnDimension('G')->setWidth(20);

			$rtwwwap_datestamp 	= date( "d-m-Y" );
			$rtwwwap_filename 	= "export-labels--".time().".xlsx";
			$rtwwwap_path 		= RTWWWAP_DIR.'assets/csv/';

			header( 'Content-Type: application/vnd.ms-excel' );
			header( 'Content-Disposition: attachment;filename="'.$rtwwwap_filename.'"' );
			header( 'Cache-Control: max-age=0' );

			$rtwwwap_objWriter = PHPExcel_IOFactory::createWriter( $rtwwwap_excel_obj, 'Excel2007' );
			$rtwwwap_objWriter->save( $rtwwwap_path.$rtwwwap_filename, 'php://output' );
			echo esc_url( RTWWWAP_URL.'assets/csv/'.$rtwwwap_filename );
			die;
		}
	}

	function rtwwwap_create_coupon_callback(){
		$rtwwwap_check_ajax = check_ajax_referer( 'rtwwwap-ajax-security-string', 'rtwwwap_security_check' );

		if ( $rtwwwap_check_ajax ) {
			$rtwwwap_user_id 		= get_current_user_id();
			$rtwwwap_amount 		= sanitize_text_field( $_POST[ 'rtwwwap_amount' ] );
			$rtwwwap_total_comm 	= get_user_meta( $rtwwwap_user_id, 'rtw_user_wallet', true );

			if( $rtwwwap_amount > $rtwwwap_total_comm ){
				$rtwwwap_amount 	= $rtwwwap_total_comm;
			}

			$rtwwwap_coupon_code 	= substr( "abcdefghijklmnopqrstuvwxyz123456789", mt_rand(0, 50) , 1) .substr( md5( time() ), 1); // Code
			$rtwwwap_coupon_code 	= substr( $rtwwwap_coupon_code, 0, 10 ); // create 10 letters coupon
			$rtwwwap_discount_type = 'fixed_cart'; // Type: fixed_cart, percent, fixed_product, percent_product

			$rtwwwap_coupon = array(
				'post_title' 	=> $rtwwwap_coupon_code,
				'post_content' 	=> '',
				'post_status' 	=> 'publish',
				'post_author' 	=> 1,
				'post_type'		=> 'shop_coupon'
			);

			$rtwwwap_new_coupon_id 	= wp_insert_post( $rtwwwap_coupon );
			$rtwwwap_userdata 		= get_userdata( $rtwwwap_user_id );
			$rtwwwap_user_email 	= $rtwwwap_userdata->user_email;
			// Add meta
			update_post_meta( $rtwwwap_new_coupon_id, 'discount_type', $rtwwwap_discount_type );
			update_post_meta( $rtwwwap_new_coupon_id, 'coupon_amount', $rtwwwap_amount );
			update_post_meta( $rtwwwap_new_coupon_id, 'individual_use', 'no' );
			update_post_meta( $rtwwwap_new_coupon_id, 'product_ids', '' );
			update_post_meta( $rtwwwap_new_coupon_id, 'exclude_product_ids', '' );
			update_post_meta( $rtwwwap_new_coupon_id, 'usage_limit', '' );
			update_post_meta( $rtwwwap_new_coupon_id, 'expiry_date', '' );
			update_post_meta( $rtwwwap_new_coupon_id, 'apply_before_tax', 'yes' );
			update_post_meta( $rtwwwap_new_coupon_id, 'free_shipping', 'no' );
			update_post_meta( $rtwwwap_new_coupon_id, 'rtwwwap_coupon', 1 );
			update_post_meta( $rtwwwap_new_coupon_id, 'customer_email', array( $rtwwwap_user_email ) );

			// Update user meta
			$rtwwwap_coupons = get_user_meta( $rtwwwap_user_id, 'rtwwwap_coupons', true );

			if( empty( $rtwwwap_coupons ) ){
				$rtwwwap_coupons = array();
			}
			$rtwwwap_coupons[] = $rtwwwap_new_coupon_id;
			update_user_meta( $rtwwwap_user_id, 'rtwwwap_coupons', $rtwwwap_coupons );

			$rtwwwap_aff_overall_comm = get_user_meta( $rtwwwap_user_id, 'rtw_user_wallet', true );
			$rtwwwap_aff_overall_comm -= $rtwwwap_amount;
			update_user_meta( $rtwwwap_user_id, 'rtw_user_wallet', $rtwwwap_aff_overall_comm );
		}
	}

	function rtwwwap_woocommerce_order_add_coupon( $rtwwwap_order_id, $rtwwwap_item_id, $rtwwwap_coupon_code, $rtwwwap_discount_amount, $rtwwwap_discount_amount_tax )
	{
		$rtwwwap_the_coupon = new WC_Coupon( $rtwwwap_coupon_code );

		if( isset( $rtwwwap_the_coupon->id ) )
		{
			$rtwwwap_coupon_id 		= $rtwwwap_the_coupon->id;
			$rtwwwap_is_rtw_coupon 	= get_post_meta( $rtwwwap_coupon_id, 'rtwwwap_coupon', true );

			if( !empty( $rtwwwap_is_rtw_coupon ) )
			{
				$rtwwwap_amount 		= get_post_meta( $rtwwwap_coupon_id, 'coupon_amount', true );
				$rtwwwap_total_discount = $rtwwwap_discount_amount+$rtwwwap_discount_amount_tax;
				if( $rtwwwap_amount < $rtwwwap_total_discount )
				{
					$rtwwwap_remaining_amount = 0;
				}
				else
				{
					$rtwwwap_remaining_amount = $rtwwwap_amount - $rtwwwap_total_discount;
				}
				update_post_meta( $rtwwwap_coupon_id, 'coupon_amount', $rtwwwap_remaining_amount );
			}
		}
	}

	function rtwwwap_user_register_signup_bonus( $rtwwwap_user_id = 0 ){

		if(is_array($_POST) && !empty($_POST)){
			foreach ($_POST as $user_meta_key => $user_meta_value) {
				if($user_meta_key != "user_login" && $user_meta_key != "user_email")
				update_user_meta( $rtwwwap_user_id,  $user_meta_key, $user_meta_value );
			}
		}
		$rtwwwap_extra_features = get_option( 'rtwwwap_extra_features_opt' );
		$rtwwwap_signup_bonus 	= isset( $rtwwwap_extra_features[ 'signup_bonus' ] ) ? esc_html( $rtwwwap_extra_features[ 'signup_bonus' ] ) : 0;
		$rtwwwap_signup_bonus_type = isset( $rtwwwap_extra_features[ 'signup_bonus_type' ] ) ? esc_html( $rtwwwap_extra_features[ 'signup_bonus_type' ] ) : 0;

		if( $rtwwwap_signup_bonus_type == 1 ){
			$rtwwwap_referral_code = $_POST[ 'rtwwwap_referral_code_field' ];

			global $wpdb;
			$rtwwwap_referral 		= explode( '_', $rtwwwap_referral_code );
			$rtwwwap_reff_id 		= esc_html( $rtwwwap_referral[ 1 ] );
			$rtwwwap_device 		= ( wp_is_mobile() ) ? 'mobile' : 'desktop';

			if( RTWWWAP_IS_WOO == 1 ){
				$rtwwwap_currency = esc_html( get_woocommerce_currency() );
			}
			else{
				require_once( RTWWWAP_DIR.'includes/rtwaffiliatehelper.php' );

				$rtwwwap_extra_features = get_option( 'rtwwwap_extra_features_opt' );
				$rtwwwap_currency 		= isset( $rtwwwap_extra_features[ 'currency' ] ) ? $rtwwwap_extra_features[ 'currency' ] : 'USD';
			}

			$rtwwwap_current_year 	= date("Y");
			$rtwwwap_current_month 	= date("m");
			$rtwwwap_capped 		= 0;

			if( $rtwwwap_signup_bonus ){
				$rtwwwap_commission_settings 	= get_option( 'rtwwwap_commission_settings_opt' );
				$rtwwwap_max_comm 				= isset( $rtwwwap_commission_settings[ 'max_commission' ] ) ? $rtwwwap_commission_settings[ 'max_commission' ] : '0';

				if( $rtwwwap_max_comm != 0 ){
					$rtwwwap_month_commission 	= $wpdb->get_var( $wpdb->prepare( "SELECT SUM(`amount`) FROM ".$wpdb->prefix."rtwwwap_referrals WHERE YEAR(date)=%d AND MONTH(date)=%d AND `aff_id`=%d", $rtwwwap_current_year, $rtwwwap_current_month, $rtwwwap_reff_id ) );
					$rtwwwap_month_commission 	= isset( $rtwwwap_month_commission ) ? $rtwwwap_month_commission : 0;

					if( $rtwwwap_month_commission < $rtwwwap_max_comm ){
						$rtwwwap_this_month_left = $rtwwwap_max_comm - $rtwwwap_month_commission;
						if( $rtwwwap_this_month_left < $rtwwwap_signup_bonus ){
							$rtwwwap_signup_bonus = $rtwwwap_this_month_left;
						}
						else{
							$rtwwwap_signup_bonus = $rtwwwap_signup_bonus;
						}
					}
					else{
						$rtwwwap_capped = 1;
					}
				}

				$rtwwwap_locale = get_locale();
				setlocale( LC_NUMERIC, $rtwwwap_locale );

				$wpdb->insert(
		            $wpdb->prefix.'rtwwwap_referrals',
		            array(
		                'aff_id'    			=> $rtwwwap_reff_id,
		                'type'    				=> 1,
		                'order_id'    			=> 0,
		                'date'    				=> date( 'Y-m-d H:i:s' ),
		                'status'    			=> 0,
		                'amount'    			=> esc_html( $rtwwwap_signup_bonus ),
		                'capped'    			=> esc_html( $rtwwwap_capped ),
		                'currency'    			=> $rtwwwap_currency,
		                'product_details'   	=> '',
		                'device'   				=> $rtwwwap_device,
		                'signed_up_id' 			=> $rtwwwap_user_id
		            )
		        );

		        setlocale( LC_ALL, $rtwwwap_locale );
			}
			else{
				$rtwwwap_mlm = get_option( 'rtwwwap_mlm_opt' );
				if( isset( $rtwwwap_mlm[ 'activate' ] ) && $rtwwwap_mlm[ 'activate' ] == 1 )
				{
					$wpdb->insert(
			            $wpdb->prefix.'rtwwwap_referrals',
			            array(
			                'aff_id'    			=> $rtwwwap_reff_id,
			                'type'    				=> 3,
			                'order_id'    			=> 0,
			                'date'    				=> date( 'Y-m-d H:i:s' ),
			                'status'    			=> 0,
			                'amount'    			=> 0,
			                'capped'    			=> 0,
			                'currency'    			=> 0,
			                'product_details'   	=> '',
			                'device'   				=> $rtwwwap_device,
			                'signed_up_id' 			=> $rtwwwap_user_id
			            )
			        );
				}
			}
		}
		elseif( isset( $_COOKIE[ 'rtwwwap_referral' ] ) ){
			global $wpdb;
			$rtwwwap_referral 		= explode( '#', $_COOKIE[ 'rtwwwap_referral' ] );
			$rtwwwap_reff_id 		= esc_html( $rtwwwap_referral[ 0 ] );
			$rtwwwap_device 		= ( wp_is_mobile() ) ? 'mobile' : 'desktop';

			if( RTWWWAP_IS_WOO == 1 ){
				$rtwwwap_currency = esc_html( get_woocommerce_currency() );
			}
			else{
				require_once( RTWWWAP_DIR.'includes/rtwaffiliatehelper.php' );

				$rtwwwap_extra_features = get_option( 'rtwwwap_extra_features_opt' );
				$rtwwwap_currency 		= isset( $rtwwwap_extra_features[ 'currency' ] ) ? $rtwwwap_extra_features[ 'currency' ] : 'USD';
			}

			$rtwwwap_current_year 	= date("Y");
			$rtwwwap_current_month 	= date("m");
			$rtwwwap_capped 		= 0;

			if( $rtwwwap_signup_bonus ){
				$rtwwwap_commission_settings 	= get_option( 'rtwwwap_commission_settings_opt' );
				$rtwwwap_max_comm 				= isset( $rtwwwap_commission_settings[ 'max_commission' ] ) ? $rtwwwap_commission_settings[ 'max_commission' ] : '0';

				if( $rtwwwap_max_comm != 0 ){
					$rtwwwap_month_commission 	= $wpdb->get_var( $wpdb->prepare( "SELECT SUM(`amount`) FROM ".$wpdb->prefix."rtwwwap_referrals WHERE YEAR(date)=%d AND MONTH(date)=%d AND `aff_id`=%d", $rtwwwap_current_year, $rtwwwap_current_month, $rtwwwap_reff_id ) );
					$rtwwwap_month_commission 	= isset( $rtwwwap_month_commission ) ? $rtwwwap_month_commission : 0;

					if( $rtwwwap_month_commission < $rtwwwap_max_comm ){
						$rtwwwap_this_month_left = $rtwwwap_max_comm - $rtwwwap_month_commission;
						if( $rtwwwap_this_month_left < $rtwwwap_signup_bonus ){
							$rtwwwap_signup_bonus = $rtwwwap_this_month_left;
						}
						else{
							$rtwwwap_signup_bonus = $rtwwwap_signup_bonus;
						}
					}
					else{
						$rtwwwap_capped = 1;
					}
				}

				$rtwwwap_locale = get_locale();
				setlocale( LC_NUMERIC, $rtwwwap_locale );

				$wpdb->insert(
		            $wpdb->prefix.'rtwwwap_referrals',
		            array(
		                'aff_id'    			=> $rtwwwap_reff_id,
		                'type'    				=> 1,
		                'order_id'    			=> 0,
		                'date'    				=> date( 'Y-m-d H:i:s' ),
		                'status'    			=> 0,
		                'amount'    			=> esc_html( $rtwwwap_signup_bonus ),
		                'capped'    			=> esc_html( $rtwwwap_capped ),
		                'currency'    			=> $rtwwwap_currency,
		                'product_details'   	=> '',
		                'device'   				=> $rtwwwap_device,
		                'signed_up_id' 			=> $rtwwwap_user_id
		            )
		        );

		        setlocale( LC_ALL, $rtwwwap_locale );
			}
			else{
				$rtwwwap_mlm = get_option( 'rtwwwap_mlm_opt' );
				if( isset( $rtwwwap_mlm[ 'activate' ] ) && $rtwwwap_mlm[ 'activate' ] == 1 )
				{
					$wpdb->insert(
			            $wpdb->prefix.'rtwwwap_referrals',
			            array(
			                'aff_id'    			=> $rtwwwap_reff_id,
			                'type'    				=> 3,
			                'order_id'    			=> 0,
			                'date'    				=> date( 'Y-m-d H:i:s' ),
			                'status'    			=> 0,
			                'amount'    			=> 0,
			                'capped'    			=> 0,
			                'currency'    			=> 0,
			                'product_details'   	=> '',
			                'device'   				=> $rtwwwap_device,
			                'signed_up_id' 			=> $rtwwwap_user_id
			            )
			        );
				}
			}
		}
	}

	function rtwwwap_check_child_in_mlm( $rtwwwap_user_id, $rtwwwap_childs_to_start = 1 ){
		global $wpdb;
		$rtwwwap_parent = $wpdb->get_var( $wpdb->prepare( "SELECT `parent_id` FROM ".$wpdb->prefix."rtwwwap_mlm WHERE `aff_id` = %d AND `status` = %d", $rtwwwap_user_id, 1 ) );

		if( $rtwwwap_parent )
		{
			$rtwwwap_parent_childs = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(`id`) FROM ".$wpdb->prefix."rtwwwap_mlm WHERE `parent_id` = %d AND `status` = %d", $rtwwwap_parent, 1 ) );

			if( $rtwwwap_parent_childs == $rtwwwap_childs_to_start ){
				return $rtwwwap_parent;
			}
			else{
				return false;
			}
		}
		else{
			return false;
		}
	}

	function rtwwwap_give_mlm_comm( $rtwwwap_user_id, $rtwwwap_lastid, $rtwwwap_total_commission, $rtwwwap_currency, $rtwwwap_currency_sym, $rtwwwap_device, $rtwwwap_mlm_levels, $rtwwwap_childs_to_start, $rtwwwap_order_id )
	{
		if( !empty( $rtwwwap_mlm_levels ) )
		{
			foreach( $rtwwwap_mlm_levels as $rtwwwap_mlm_key => $rtwwwap_mlm_value ){
				$rtwwwap_parent_id = $this->rtwwwap_check_child_in_mlm( $rtwwwap_user_id, $rtwwwap_childs_to_start );

				if( $rtwwwap_parent_id ){
					$rtwwwap_user_id = $rtwwwap_parent_id;
					$rtwwwap_commission = 0;
					if( $rtwwwap_mlm_value[ 'mlm_level_comm_type' ] == 0 ){
						$rtwwwap_commission = ( $rtwwwap_total_commission*$rtwwwap_mlm_value[ 'mlm_level_comm_amount' ] )/100;
					}
					elseif( $rtwwwap_mlm_value[ 'mlm_level_comm_type' ] == 1 ){
						$rtwwwap_commission = $rtwwwap_mlm_value[ 'mlm_level_comm_amount' ];
					}

					if( get_user_meta( $rtwwwap_user_id, 'rtwwwap_referral_mail', true ) == 'on' ){
						$rtwwwap_extra_features = get_option( 'rtwwwap_extra_features_opt' );
						$rtwwwap_decimal_places = $rtwwwap_extra_features['decimal_places'].'f';
						$rtwwwap_to 			= get_user_by( 'id', $rtwwwap_user_id );
						$rtwwwap_to 			= esc_html( $rtwwwap_to->user_email );
						$rtwwwap_subject 		= esc_html__( 'New MLM commission', 'rtwwwap-wp-wc-affiliate-program' );
						$rtwwwap_message 		= sprintf( '%s %s%01.'.$rtwwwap_decimal_places, esc_html__( 'You got a new MLM commission of amount', 'rtwwwap-wp-wc-affiliate-program' ), $rtwwwap_currency_sym, $rtwwwap_commission );
						$rtwwwap_from_name 		= esc_html( get_bloginfo( 'name' ) );
						$rtwwwap_from_email 	= esc_html( get_bloginfo( 'admin_email' ) );

						$rtwwwap_headers[] 		= sprintf( '%s: %s <%s>', esc_html__( 'From', 'rtwwwap-wp-wc-affiliate-program' ), $rtwwwap_from_name, $rtwwwap_from_email );

						// mail to affiliate
						wp_mail( $rtwwwap_to, $rtwwwap_subject, $rtwwwap_message, $rtwwwap_headers );

						if( isset( $rtwwwap_extra_features[ 'mail_to_admin' ] ) && $rtwwwap_extra_features[ 'mail_to_admin' ] == 1 ){
							// mail to admin
							$rtwwwap_message = sprintf( '%s %s%01.'.$rtwwwap_decimal_places, esc_html__( 'Generated a new MLM commission of amount', 'rtwwwap-wp-wc-affiliate-program' ), $rtwwwap_currency_sym, $rtwwwap_commission );
							wp_mail( $rtwwwap_from_email, $rtwwwap_subject, $rtwwwap_message, $rtwwwap_headers );
						}
					}

					//insert mlm row for this level
					if( $rtwwwap_commission ){
						global $wpdb;
						$rtwwwap_prod_details = 'mlm_'.$rtwwwap_order_id;

						$rtwwwap_locale = get_locale();
						setlocale( LC_NUMERIC, $rtwwwap_locale );

						$rtwwwap_updated = $wpdb->insert(
				            $wpdb->prefix.'rtwwwap_referrals',
				            array(
				                'aff_id'    			=> $rtwwwap_user_id,
				                'type'    				=> 4,
				                'order_id'    			=> esc_html( $rtwwwap_order_id ),
				                'date'    				=> date( 'Y-m-d H:i:s' ),
				                'status'    			=> 0,
				                'amount'    			=> esc_html( $rtwwwap_commission ),
				                'capped'    			=> 0,
				                'currency'    			=> $rtwwwap_currency,
				                'product_details'   	=> $rtwwwap_prod_details,
				                'device'   				=> $rtwwwap_device
				            )
				        );

						setlocale( LC_ALL, $rtwwwap_locale );

						if( $rtwwwap_updated ){
					        $rtwwwap_referral_noti = get_option( 'rtwwwap_referral_noti' )+1;
					        update_option( 'rtwwwap_referral_noti', $rtwwwap_referral_noti );
						}
					}
				}
			}
		}
	}

	function rtwwwap_loop_each_parent( $rtwwwap_user_id, $rtwwwap_html, $rtwwwap_mlm_depth, $rtwwwap_count, $rtwwwap_active = 0, $rtwwwap_mlm_child ){
		$rtwwwap_verification_done = get_option( 'rtwwwap_verification_done', array() );
		$rtwwwap_verification_done_status = isset($rtwwwap_verification_done['status']) ? $rtwwwap_verification_done['status'] : false;
		$rtwwwap_verification_done_purchase = isset($rtwwwap_verification_done['purchase_code']) ? $rtwwwap_verification_done['purchase_code'] : false;
		if( empty( $rtwwwap_verification_done ) || $rtwwwap_verification_done_status == false || empty($rtwwwap_verification_done_purchase) )
		{
			return;
		}
		global $wpdb;
		$rtwwwap_count = $rtwwwap_count+1;

		if( $rtwwwap_active == 'false' ){
			$rtwwwap_mlm_chain = $wpdb->get_results( $wpdb->prepare( "SELECT `aff_id`, `status` FROM ".$wpdb->prefix."rtwwwap_mlm WHERE `parent_id`=%d AND `status`=1", $rtwwwap_user_id ), ARRAY_A );
		}
		else{
			$rtwwwap_mlm_chain = $wpdb->get_results( $wpdb->prepare( "SELECT `aff_id`, `status` FROM ".$wpdb->prefix."rtwwwap_mlm WHERE `parent_id`=%d", $rtwwwap_user_id ), ARRAY_A );
		}

		if( !empty( $rtwwwap_mlm_chain ) ){
			if( count( $rtwwwap_mlm_chain ) > $rtwwwap_mlm_child && $rtwwwap_active == 'false' ){
				global $rtwwwap_improper_chain;
				$rtwwwap_improper_chain = true;
			}
			$rtwwwap_mlm = get_option( 'rtwwwap_mlm_opt' );
			$rtwwwap_mlm_user_status_checked = 0;
			if( isset( $rtwwwap_mlm[ 'user_status' ] ) && $rtwwwap_mlm[ 'user_status' ] == 1 ){
				$rtwwwap_mlm_user_status_checked = 1;
			}

			$rtwwwap_html .= '<ul>';
			foreach( $rtwwwap_mlm_chain as $rtwwwap_key => $rtwwwap_value ){
				$rtwwwap_name = get_userdata( $rtwwwap_value[ 'aff_id' ] );
				$rtwwwap_name = $rtwwwap_name->data->display_name;

				if( $rtwwwap_mlm_user_status_checked ){
					if( $rtwwwap_value[ 'status' ] == 0 ){
						$rtwwwap_html .= 	'<li data-class="rtwwwap_disabled" data-id="'.$rtwwwap_value[ 'aff_id' ].'">';
					}
					else{
						$rtwwwap_html .= 	'<li data-class="rtwwwap_enabled" data-id="'.$rtwwwap_value[ 'aff_id' ].'">';
					}
				}
				else{
					if( $rtwwwap_value[ 'status' ] == 0 ){
						$rtwwwap_html .= 	'<li data-class="rtwwwap_noedit_disabled" data-id="'.$rtwwwap_value[ 'aff_id' ].'">';
					}
					else{
						$rtwwwap_html .= 	'<li data-class="rtwwwap_noedit" data-id="'.$rtwwwap_value[ 'aff_id' ].'">';
					}
				}

				$rtwwwap_html .= $rtwwwap_name;

				if( $rtwwwap_count <= $rtwwwap_mlm_depth ){
					$rtwwwap_get_return = $this->rtwwwap_loop_each_parent( $rtwwwap_value[ 'aff_id' ], $rtwwwap_html, $rtwwwap_mlm_depth, $rtwwwap_count, $rtwwwap_active, $rtwwwap_mlm_child );

					if( $rtwwwap_get_return ){
						$rtwwwap_html = $rtwwwap_get_return;
						$rtwwwap_html .= '</li>';
					}
				}
				else{
					$rtwwwap_html .= '</li>';
				}
			}
			$rtwwwap_html .= '</ul>';
		}

		return $rtwwwap_html;
	}

	function rtwwwap_public_get_mlm_chain_callback(){
		$rtwwwap_verification_done = get_option( 'rtwwwap_verification_done', array() );
		$rtwwwap_verification_done_status = isset($rtwwwap_verification_done['status']) ? $rtwwwap_verification_done['status'] : false;
		$rtwwwap_verification_done_purchase = isset($rtwwwap_verification_done['purchase_code']) ? $rtwwwap_verification_done['purchase_code'] : false;
		if( empty( $rtwwwap_verification_done ) || $rtwwwap_verification_done_status == false || empty($rtwwwap_verification_done_purchase) )
		{
			return;
		}
		global $rtwwwap_improper_chain;
		$rtwwwap_improper_chain = false;

		$rtwwwap_mlm 		= get_option( 'rtwwwap_mlm_opt' );
		$rtwwwap_mlm_depth 	= isset( $rtwwwap_mlm[ 'depth' ] ) ? $rtwwwap_mlm[ 'depth' ] : 0;
		$rtwwwap_mlm_child 	= isset( $rtwwwap_mlm[ 'child' ] ) ? $rtwwwap_mlm[ 'child' ] : 1;
		$rtwwwap_user_id 	= $_POST[ 'rtwwwap_user_id' ];
		$rtwwwap_active 	= $_POST[ 'rtwwwap_active' ];

		$rtwwwap_mlm_user_status_checked = 0;
		if( isset( $rtwwwap_mlm[ 'user_status' ] ) && $rtwwwap_mlm[ 'user_status' ] == 1 ){
			$rtwwwap_mlm_user_status_checked = 1;
		}

		$rtwwwap_name = get_userdata( $rtwwwap_user_id );
		$rtwwwap_name = $rtwwwap_name->data->display_name;
		$rtwwwap_html = '';
		$rtwwwap_html .= 	'<ul id="rtwwwap_mlm_data">';
		$rtwwwap_html .= 		'<li data-id="'.$rtwwwap_user_id.'">'.$rtwwwap_name;

		if( $rtwwwap_mlm_depth ){
			$rtwwwap_final_html = $this->rtwwwap_loop_each_parent( $rtwwwap_user_id, $rtwwwap_html, $rtwwwap_mlm_depth, 1, $rtwwwap_active, $rtwwwap_mlm_child );
			$rtwwwap_final_html .= '</li></ul>';
		}
		else{
			$rtwwwap_html .= '</li></ul>';
			$rtwwwap_final_html = $rtwwwap_html;
		}

		echo json_encode( array( 'rtwwwap_tree_html' => $rtwwwap_final_html, 'rtwwwap_improper_chain' => $rtwwwap_improper_chain, 'rtwwwap_mlm_user_status_checked' => $rtwwwap_mlm_user_status_checked ) ); die;
	}

	function rtwwwap_public_deactive_aff_callback(){
		$rtwwwap_verification_done = get_option( 'rtwwwap_verification_done', array() );
		$rtwwwap_verification_done_status = isset($rtwwwap_verification_done['status']) ? $rtwwwap_verification_done['status'] : false;
		$rtwwwap_verification_done_purchase = isset($rtwwwap_verification_done['purchase_code']) ? $rtwwwap_verification_done['purchase_code'] : false;
		if( empty( $rtwwwap_verification_done ) || $rtwwwap_verification_done_status == false || empty($rtwwwap_verification_done_purchase) )
		{
			return;
		}
		global $wpdb;
		$rtwwwap_aff_id 	= $_POST[ 'rtwwwap_aff_id' ];
		$rtwwwap_parent_id 	= $_POST[ 'rtwwwap_parent_id' ];

		$rtwwwap_updated = 	$wpdb->update(
								$wpdb->prefix.'rtwwwap_mlm',
								array( 'status' => 0 ),
								array( 'aff_id' => $rtwwwap_aff_id, 'parent_id' => $rtwwwap_parent_id ),
								array( '%d' ),
								array( '%d', '%d' )
							);

		if( $rtwwwap_updated ){
			echo json_encode( array( 'rtwwwap_status' => true, 'rtwwwap_message' => esc_html__( 'Deactivated', 'rtwwwap-wp-wc-affiliate-program' ) ) );
			die;
		}
		else{
			echo json_encode( array( 'rtwwwap_status' => false, 'rtwwwap_message' => esc_html__( 'Something Went Wrong', 'rtwwwap-wp-wc-affiliate-program' ) ) );
			die;
		}
	}

	function rtwwwap_public_active_aff_callback(){
		$rtwwwap_verification_done = get_option( 'rtwwwap_verification_done', array() );
		$rtwwwap_verification_done_status = isset($rtwwwap_verification_done['status']) ? $rtwwwap_verification_done['status'] : false;
		$rtwwwap_verification_done_purchase = isset($rtwwwap_verification_done['purchase_code']) ? $rtwwwap_verification_done['purchase_code'] : false;
		if( empty( $rtwwwap_verification_done ) || $rtwwwap_verification_done_status == false || empty($rtwwwap_verification_done_purchase) )
		{
			return;
		}
		global $wpdb;
		$rtwwwap_aff_id 	= $_POST[ 'rtwwwap_aff_id' ];
		$rtwwwap_parent_id 	= $_POST[ 'rtwwwap_parent_id' ];

		$rtwwwap_updated = 	$wpdb->update(
								$wpdb->prefix.'rtwwwap_mlm',
								array( 'status' => 1 ),
								array( 'aff_id' => $rtwwwap_aff_id, 'parent_id' => $rtwwwap_parent_id ),
								array( '%d' ),
								array( '%d', '%d' )
							);

		if( $rtwwwap_updated ){
			echo json_encode( array( 'rtwwwap_status' => true, 'rtwwwap_message' => esc_html__( 'Activated', 'rtwwwap-wp-wc-affiliate-program' ) ) );
			die;
		}
		else{
			echo json_encode( array( 'rtwwwap_status' => false, 'rtwwwap_message' => esc_html__( 'Something Went Wrong', 'rtwwwap-wp-wc-affiliate-program' ) ) );
			die;
		}
	}

	function rtwwwap_send_rqst_callback(){
		$rtwwwap_verification_done = get_option( 'rtwwwap_verification_done', array() );
		$rtwwwap_verification_done_status = isset($rtwwwap_verification_done['status']) ? $rtwwwap_verification_done['status'] : false;
		$rtwwwap_verification_done_purchase = isset($rtwwwap_verification_done['purchase_code']) ? $rtwwwap_verification_done['purchase_code'] : false;
		if( empty( $rtwwwap_verification_done ) || $rtwwwap_verification_done_status == false || empty($rtwwwap_verification_done_purchase) )
		{
			return;
		}
		$rtwwwap_msg_for_rqst 	= sanitize_post( $_POST[ 'rtwwwap_msg' ] );
		$rtwwwap_user_id 		= get_current_user_id();

		$rtwwwap_to 			= esc_html( get_bloginfo( 'admin_email' ) );
		$rtwwwap_subject 		= esc_html__( 'Request for commission withdraw', 'rtwwwap-wp-wc-affiliate-program' );
		$rtwwwap_message 		= $rtwwwap_msg_for_rqst;
		$rtwwwap_userdata 		= get_user_by( 'id', $rtwwwap_user_id );
		$rtwwwap_from_email 	= esc_html( $rtwwwap_userdata->data->user_email );
		$rtwwwap_from_name 		= esc_html( $rtwwwap_userdata->data->user_login );

		$rtwwwap_headers[] 		= sprintf( '%s: %s <%s>', esc_html__( 'From', 'rtwwwap-wp-wc-affiliate-program' ), $rtwwwap_from_name, $rtwwwap_from_email );
		$rtwwwap_success 		= wp_mail( $rtwwwap_to, $rtwwwap_subject, $rtwwwap_message, $rtwwwap_headers );

		if( $rtwwwap_success ){
			echo json_encode( array( 'rtwwwap_status' => true, 'rtwwwap_message' => '' ) );
			die;
		}
		else{
			echo json_encode( array( 'rtwwwap_status' => false, 'rtwwwap_message' => esc_html__( 'Something Went Wrong', 'rtwwwap-wp-wc-affiliate-program' ) ) );
			die;
		}
	}



	function rtwwwap_add_code_field(){
		$rtwwwap_verification_done = get_option( 'rtwwwap_verification_done', array() );
		$rtwwwap_verification_done_status = isset($rtwwwap_verification_done['status']) ? $rtwwwap_verification_done['status'] : false;
		$rtwwwap_verification_done_purchase = isset($rtwwwap_verification_done['purchase_code']) ? $rtwwwap_verification_done['purchase_code'] : false;
		if( empty( $rtwwwap_verification_done ) || $rtwwwap_verification_done_status == false || empty($rtwwwap_verification_done_purchase) )
		{
			return;
		}
		$rtwwwap_extra_features 	= get_option( 'rtwwwap_extra_features_opt' );
		$rtwwwap_signup_bonus_type 	= isset( $rtwwwap_extra_features[ 'signup_bonus_type' ] ) ? $rtwwwap_extra_features[ 'signup_bonus_type' ] : 0;

		if( $rtwwwap_signup_bonus_type == 1 ){
		?>
		    <p class="form-row">
		        <label for="rtwwwap_referral_code_field"><?php esc_html_e( 'Referral Code', 'rtwwwap-wp-wc-affiliate-program' ); ?>
		        </label>
		        <input type="text" class="input-text" name="rtwwwap_referral_code_field" id="rtwwwap_referral_code_field" value="" />
		    </p>
		    <div class="clear"></div>
	    <?php
		}
    }

    /*
	* To show affiliate registartion page with shortcode
	*/
	function rtwwwap_aff_reg_page_callback(){
		$rtwwwap_verification_done = get_option( 'rtwwwap_verification_done', array() );
		$rtwwwap_verification_done_status = isset($rtwwwap_verification_done['status']) ? $rtwwwap_verification_done['status'] : false;
		$rtwwwap_verification_done_purchase = isset($rtwwwap_verification_done['purchase_code']) ? $rtwwwap_verification_done['purchase_code'] : false;
		if( empty( $rtwwwap_verification_done ) || $rtwwwap_verification_done_status == false || empty($rtwwwap_verification_done_purchase) )
		{
			return;
		}

		$rtwwwap_html = include( RTWWWAP_DIR.'public/templates/rtwwwap_aff_reg_page.php' );
		return $rtwwwap_html;
	}

	/*
	 To show affiliate login page with shortcode
	*/
	function rtwwwap_aff_login_page_callback(){
		$rtwwwap_verification_done = get_option( 'rtwwwap_verification_done', array() );
		$rtwwwap_verification_done_status = isset($rtwwwap_verification_done['status']) ? $rtwwwap_verification_done['status'] : false;
		$rtwwwap_verification_done_purchase = isset($rtwwwap_verification_done['purchase_code']) ? $rtwwwap_verification_done['purchase_code'] : false;
		if( empty( $rtwwwap_verification_done ) || $rtwwwap_verification_done_status == false || empty($rtwwwap_verification_done_purchase) )
		{
			return;
		}

		$rtwwwap_html = include( RTWWWAP_DIR.'public/templates/rtwwwap_aff_login_page.php' );
		return $rtwwwap_html;
	}

	


	/*
	 To show affiliate reset password page with shortcode
	*/
	public function rtwwwap_aff_reset_password_page_callback(){
		$rtwwwap_verification_done = get_option( 'rtwwwap_verification_done', array() );
		$rtwwwap_verification_done_status = isset($rtwwwap_verification_done['status']) ? $rtwwwap_verification_done['status'] : false;
		$rtwwwap_verification_done_purchase = isset($rtwwwap_verification_done['purchase_code']) ? $rtwwwap_verification_done['purchase_code'] : false;
		if( empty( $rtwwwap_verification_done ) || $rtwwwap_verification_done_status == false || empty($rtwwwap_verification_done_purchase) )
		{
			return;
		}
		wp_enqueue_script( 'utils' );
		wp_enqueue_script( 'user-profile' );
			$rtwwwap_html = include( RTWWWAP_DIR.'public/templates/rtwwwap_aff_reset_password_page.php' );
			return $rtwwwap_html;
	}


	/*
	 * to provide unlimited or lifetime commission
	 */
	function rtwwwap_unlimited_reff_comm( $rtwwwap_order_id = 0, $rtwwwap_referrer_id = 0 )
	{
		$rtwwwap_verification_done = get_option( 'rtwwwap_verification_done', array() );
		$rtwwwap_verification_done_status = isset($rtwwwap_verification_done['status']) ? $rtwwwap_verification_done['status'] : false;
		$rtwwwap_verification_done_purchase = isset($rtwwwap_verification_done['purchase_code']) ? $rtwwwap_verification_done['purchase_code'] : false;
		if( empty( $rtwwwap_verification_done ) || $rtwwwap_verification_done_status == false || empty($rtwwwap_verification_done_purchase) )
		{
			return;
		}
		if( $rtwwwap_order_id && $rtwwwap_referrer_id ){
			global $wpdb;
			$rtwwwap_commission_settings = get_option( 'rtwwwap_commission_settings_opt' );
			$rtwwwap_referral 	= array( $rtwwwap_referrer_id );
			$rtwwwap_order 		= wc_get_order( $rtwwwap_order_id );
			$rtwwwap_comm_base 	= isset( $rtwwwap_commission_settings[ 'comm_base' ] ) ? $rtwwwap_commission_settings[ 'comm_base' ] : '1';
			$rtwwwap_total_commission	= 0;
			$rtwwwap_aff_prod_details 	= array();
			$rtwwwap_user_id 			= esc_html( $rtwwwap_referral[ 0 ] );

			if( RTWWWAP_IS_WOO == 1 ){
				$rtwwwap_currency 		= get_woocommerce_currency();
				$rtwwwap_currency_sym 	= get_woocommerce_currency_symbol();
			}
			else{
				require_once( RTWWWAP_DIR.'includes/rtwaffiliatehelper.php' );

				$rtwwwap_extra_features = get_option( 'rtwwwap_extra_features_opt' );
				$rtwwwap_currency 		= isset( $rtwwwap_extra_features[ 'currency' ] ) ? $rtwwwap_extra_features[ 'currency' ] : 'USD';
				$rtwwwap_curr_obj 		= new RtwAffiliateHelper();
				$rtwwwap_currency_sym 	= $rtwwwap_curr_obj->rtwwwap_curr_symbol( $rtwwwap_currency );
			}

			$rtwwwap_commission_type 	= 0;
			$rtwwwap_shared 			= false;
			$rtwwwap_product_url 		= false;

			if( $rtwwwap_comm_base == 1 ){
				$rtwwwap_per_prod_mode 			= isset( $rtwwwap_commission_settings[ 'per_prod_mode' ] ) ? $rtwwwap_commission_settings[ 'per_prod_mode' ] : 0;
				$rtwwwap_all_commission 		= isset( $rtwwwap_commission_settings[ 'all_commission' ] ) ? $rtwwwap_commission_settings[ 'all_commission' ] : 0;
				$rtwwwap_all_commission_type 	= isset( $rtwwwap_commission_settings[ 'all_commission_type' ] ) ? $rtwwwap_commission_settings[ 'all_commission_type' ] : 'percentage';
				$rtwwwap_per_cat 				= isset( $rtwwwap_commission_settings[ 'per_cat' ] ) ? $rtwwwap_commission_settings[ 'per_cat' ] : array();

				foreach( $rtwwwap_order->get_items() as $rtwwwap_item_key => $rtwwwap_item_values )
				{
					$rtwwwap_prod_comm 		= '';
					$rtwwwap_product_id 	= $rtwwwap_item_values->get_product_id();
					$rtwwwap_product_price	= $rtwwwap_item_values->get_total();
					$rtwwwap_product_terms 	= get_the_terms( $rtwwwap_product_id, 'product_cat' );
					$rtwwwap_product_cat_id = $rtwwwap_product_terms[0]->term_id;

					if( $rtwwwap_commission_type == 0 )
					{
					    if( $rtwwwap_per_prod_mode == 1 ){
							$rtwwwap_prod_per_comm = get_post_meta( $rtwwwap_product_id, 'rtwwwap_percentage_commission_box', true );

							if( $rtwwwap_prod_per_comm > 0 ){
								$rtwwwap_prod_comm = ( $rtwwwap_product_price * $rtwwwap_prod_per_comm ) / 100;
								$rtwwwap_aff_prod_details[] = array(
						    					'product_id' 		=> $rtwwwap_product_id,
						    					'product_price' 	=> $rtwwwap_product_price,
						    					'commission_fix' 	=> '',
						    					'commission_perc' 	=> $rtwwwap_prod_per_comm,
						    					'prod_commission' 	=> $rtwwwap_prod_comm
						    				);

					    		$rtwwwap_total_commission += $rtwwwap_prod_comm;
							}
							elseif( $rtwwwap_prod_per_comm === '0' ){
								// no commission needs to be generated for this product
							}
							else{
								if( !empty( $rtwwwap_per_cat ) ){
									$rtwwwap_cat_per_comm = 0;
									$rtwwwap_cat_fix_comm = 0;
									$rtwwwap_flag = false;
									foreach( $rtwwwap_per_cat as $rtwwwap_key => $rtwwwap_value ){
										if( in_array( $rtwwwap_product_cat_id, $rtwwwap_value[ 'ids' ] ) ){
											$rtwwwap_cat_per_comm = $rtwwwap_value[ 'cat_percentage_commission' ];
											$rtwwwap_cat_fix_comm = $rtwwwap_value[ 'cat_fixed_commission' ];
											$rtwwwap_flag = true;

											break;
										}
									}
									if( $rtwwwap_flag ){
										if( $rtwwwap_cat_per_comm > 0 ){
											$rtwwwap_prod_comm = ( $rtwwwap_product_price * $rtwwwap_cat_per_comm ) / 100;
										}
										if( $rtwwwap_cat_fix_comm > 0 ){
											$rtwwwap_prod_comm += $rtwwwap_cat_fix_comm;
										}

										if( $rtwwwap_prod_comm != '' ){
											$rtwwwap_aff_prod_details[] = array(
								    					'product_id' 		=> $rtwwwap_product_id,
								    					'product_price' 	=> $rtwwwap_product_price,
								    					'commission_fix' 	=> $rtwwwap_cat_fix_comm,
								    					'commission_perc' 	=> $rtwwwap_cat_per_comm,
								    					'prod_commission' 	=> $rtwwwap_prod_comm
								    				);

							    			$rtwwwap_total_commission += $rtwwwap_prod_comm;
							    		}
									}
									else{
										if( $rtwwwap_all_commission ){
											if( $rtwwwap_all_commission_type == 'percentage' ){
												$rtwwwap_prod_comm += ( $rtwwwap_product_price * $rtwwwap_all_commission ) / 100;
											}
											elseif( $rtwwwap_all_commission_type == 'fixed' ){
												$rtwwwap_prod_comm += $rtwwwap_all_commission;
											}
											$rtwwwap_aff_prod_details[] = array(
								    					'product_id' 		=> $rtwwwap_product_id,
								    					'product_price' 	=> $rtwwwap_product_price,
								    					'commission_fix' 	=> '',
								    					'commission_perc' 	=> '',
								    					'prod_commission' 	=> $rtwwwap_prod_comm
								    				);

							    			$rtwwwap_total_commission += $rtwwwap_prod_comm;
							    		}
									}
								}
								else{
									if( $rtwwwap_all_commission ){
										if( $rtwwwap_all_commission_type == 'percentage' ){
											$rtwwwap_prod_comm += ( $rtwwwap_product_price * $rtwwwap_all_commission ) / 100;
										}
										elseif( $rtwwwap_all_commission_type == 'fixed' ){
											$rtwwwap_prod_comm += $rtwwwap_all_commission;
										}
										$rtwwwap_aff_prod_details[] = array(
							    					'product_id' 		=> $rtwwwap_product_id,
							    					'product_price' 	=> $rtwwwap_product_price,
							    					'commission_fix' 	=> '',
								    				'commission_perc' 	=> '',
							    					'prod_commission' 	=> $rtwwwap_prod_comm
							    				);

						    			$rtwwwap_total_commission += $rtwwwap_prod_comm;
						    		}
								}
							}
						}
						elseif( $rtwwwap_per_prod_mode == 2 ){
							$rtwwwap_prod_fix_comm = get_post_meta( $rtwwwap_product_id, 'rtwwwap_fixed_commission_box', true );

							if( $rtwwwap_prod_fix_comm > 0 ){
								$rtwwwap_prod_comm = $rtwwwap_prod_fix_comm;
								$rtwwwap_aff_prod_details[] = array(
						    					'product_id' 		=> $rtwwwap_product_id,
						    					'product_price' 	=> $rtwwwap_product_price,
						    					'commission_fix' 	=> $rtwwwap_prod_fix_comm,
						    					'commission_perc' 	=> '',
						    					'prod_commission' 	=> $rtwwwap_prod_comm
						    				);

					    		$rtwwwap_total_commission += $rtwwwap_prod_comm;
							}
							elseif( $rtwwwap_prod_fix_comm === '0' ){
								// no commission needs to be generated for this product
							}
							else{
								if( !empty( $rtwwwap_per_cat ) ){
									$rtwwwap_cat_per_comm = 0;
									$rtwwwap_cat_fix_comm = 0;
									$rtwwwap_flag = false;
									foreach( $rtwwwap_per_cat as $rtwwwap_key => $rtwwwap_value ){
										if( in_array( $rtwwwap_product_cat_id, $rtwwwap_value[ 'ids' ] ) ){
											$rtwwwap_cat_per_comm = $rtwwwap_value[ 'cat_percentage_commission' ];
											$rtwwwap_cat_fix_comm = $rtwwwap_value[ 'cat_fixed_commission' ];
											$rtwwwap_flag = true;

											break;
										}
									}
									if( $rtwwwap_flag ){
										if( $rtwwwap_cat_per_comm > 0 ){
											$rtwwwap_prod_comm = ( $rtwwwap_product_price * $rtwwwap_cat_per_comm ) / 100;
										}
										if( $rtwwwap_cat_fix_comm > 0 ){
											$rtwwwap_prod_comm += $rtwwwap_cat_fix_comm;
										}

										if( $rtwwwap_prod_comm != '' ){
											$rtwwwap_aff_prod_details[] = array(
								    					'product_id' 		=> $rtwwwap_product_id,
								    					'product_price' 	=> $rtwwwap_product_price,
								    					'commission_fix' 	=> $rtwwwap_cat_fix_comm,
								    					'commission_perc' 	=> $rtwwwap_cat_per_comm,
								    					'prod_commission' 	=> $rtwwwap_prod_comm
								    				);

							    			$rtwwwap_total_commission += $rtwwwap_prod_comm;
							    		}
									}
									else{
										if( $rtwwwap_all_commission ){
											if( $rtwwwap_all_commission_type == 'percentage' ){
												$rtwwwap_prod_comm += ( $rtwwwap_product_price * $rtwwwap_all_commission ) / 100;
											}
											elseif( $rtwwwap_all_commission_type == 'fixed' ){
												$rtwwwap_prod_comm += $rtwwwap_all_commission;
											}
											$rtwwwap_aff_prod_details[] = array(
								    					'product_id' 		=> $rtwwwap_product_id,
								    					'product_price' 	=> $rtwwwap_product_price,
								    					'commission_fix' 	=> '',
								    					'commission_perc' 	=> '',
								    					'prod_commission' 	=> $rtwwwap_prod_comm
								    				);

							    			$rtwwwap_total_commission += $rtwwwap_prod_comm;
							    		}
									}
								}
								else{
									if( $rtwwwap_all_commission ){
										if( $rtwwwap_all_commission_type == 'percentage' ){
											$rtwwwap_prod_comm += ( $rtwwwap_product_price * $rtwwwap_all_commission ) / 100;
										}
										elseif( $rtwwwap_all_commission_type == 'fixed' ){
											$rtwwwap_prod_comm += $rtwwwap_all_commission;
										}
										$rtwwwap_aff_prod_details[] = array(
							    					'product_id' 		=> $rtwwwap_product_id,
							    					'product_price' 	=> $rtwwwap_product_price,
							    					'commission_fix' 	=> '',
								    				'commission_perc' 	=> '',
							    					'prod_commission' 	=> $rtwwwap_prod_comm
							    				);

						    			$rtwwwap_total_commission += $rtwwwap_prod_comm;
						    		}
								}
							}
						}
						elseif( $rtwwwap_per_prod_mode == 3 ){
							$rtwwwap_prod_per_comm = get_post_meta( $rtwwwap_product_id, 'rtwwwap_percentage_commission_box', true );
							$rtwwwap_prod_fix_comm = get_post_meta( $rtwwwap_product_id, 'rtwwwap_fixed_commission_box', true );

							if( $rtwwwap_prod_per_comm > 0 ){
								$rtwwwap_prod_comm += ( $rtwwwap_product_price * $rtwwwap_prod_per_comm ) / 100;
							}

							if( $rtwwwap_prod_fix_comm > 0 ){
								$rtwwwap_prod_comm += $rtwwwap_prod_fix_comm;
							}

							if( $rtwwwap_prod_comm === '' ){
								if( $rtwwwap_prod_per_comm !== '0' && $rtwwwap_prod_fix_comm !== '0' ){
									if( !empty( $rtwwwap_per_cat ) ){
										$rtwwwap_cat_per_comm = 0;
										$rtwwwap_cat_fix_comm = 0;
										$rtwwwap_flag = false;
										foreach( $rtwwwap_per_cat as $rtwwwap_key => $rtwwwap_value ){
											if( in_array( $rtwwwap_product_cat_id, $rtwwwap_value[ 'ids' ] ) ){
												$rtwwwap_cat_per_comm = $rtwwwap_value[ 'cat_percentage_commission' ];
												$rtwwwap_cat_fix_comm = $rtwwwap_value[ 'cat_fixed_commission' ];
												$rtwwwap_flag = true;

												break;
											}
										}
										if( $rtwwwap_flag ){
											if( $rtwwwap_cat_per_comm > 0 ){
												$rtwwwap_prod_comm = ( $rtwwwap_product_price * $rtwwwap_cat_per_comm ) / 100;
											}
											if( $rtwwwap_cat_fix_comm > 0 ){
												$rtwwwap_prod_comm += $rtwwwap_cat_fix_comm;
											}

											if( $rtwwwap_prod_comm != '' ){
												$rtwwwap_aff_prod_details[] = array(
									    					'product_id' 		=> $rtwwwap_product_id,
									    					'product_price' 	=> $rtwwwap_product_price,
									    					'commission_fix' 	=> $rtwwwap_cat_fix_comm,
									    					'commission_perc' 	=> $rtwwwap_cat_per_comm,
									    					'prod_commission' 	=> $rtwwwap_prod_comm
									    				);

								    			$rtwwwap_total_commission += $rtwwwap_prod_comm;
								    		}
										}
										else{
											if( $rtwwwap_all_commission ){
												if( $rtwwwap_all_commission_type == 'percentage' ){
													$rtwwwap_prod_comm += ( $rtwwwap_product_price * $rtwwwap_all_commission ) / 100;
												}
												elseif( $rtwwwap_all_commission_type == 'fixed' ){
													$rtwwwap_prod_comm += $rtwwwap_all_commission;
												}
												$rtwwwap_aff_prod_details[] = array(
									    					'product_id' 		=> $rtwwwap_product_id,
									    					'product_price' 	=> $rtwwwap_product_price,
									    					'commission_fix' 	=> '',
									    					'commission_perc' 	=> '',
									    					'prod_commission' 	=> $rtwwwap_prod_comm
									    				);

								    			$rtwwwap_total_commission += $rtwwwap_prod_comm;
								    		}
										}
									}
									else{
										if( $rtwwwap_all_commission ){
											if( $rtwwwap_all_commission_type == 'percentage' ){
												$rtwwwap_prod_comm += ( $rtwwwap_product_price * $rtwwwap_all_commission ) / 100;
											}
											elseif( $rtwwwap_all_commission_type == 'fixed' ){
												$rtwwwap_prod_comm += $rtwwwap_all_commission;
											}
											$rtwwwap_aff_prod_details[] = array(
								    					'product_id' 		=> $rtwwwap_product_id,
								    					'product_price' 	=> $rtwwwap_product_price,
								    					'commission_fix' 	=> '',
									    				'commission_perc' 	=> '',
								    					'prod_commission' 	=> $rtwwwap_prod_comm
								    				);

							    			$rtwwwap_total_commission += $rtwwwap_prod_comm;
							    		}
									}
								}
							}
							else{
								$rtwwwap_aff_prod_details[] = array(
					    					'product_id' 		=> $rtwwwap_product_id,
					    					'product_price' 	=> $rtwwwap_product_price,
					    					'commission_fix' 	=> $rtwwwap_prod_fix_comm,
						    				'commission_perc' 	=> $rtwwwap_prod_per_comm,
					    					'prod_commission' 	=> $rtwwwap_prod_comm
					    				);

				    			$rtwwwap_total_commission += $rtwwwap_prod_comm;
							}
						}
						elseif( $rtwwwap_all_commission ){
							if( $rtwwwap_all_commission_type == 'percentage' ){
								$rtwwwap_prod_comm += ( $rtwwwap_product_price * $rtwwwap_all_commission ) / 100;
							}
							elseif( $rtwwwap_all_commission_type == 'fixed' ){
								$rtwwwap_prod_comm += $rtwwwap_all_commission;
							}
							$rtwwwap_aff_prod_details[] = array(
				    					'product_id' 		=> $rtwwwap_product_id,
				    					'product_price' 	=> $rtwwwap_product_price,
				    					'commission_fix' 	=> '',
					    				'commission_perc' 	=> '',
				    					'prod_commission' 	=> $rtwwwap_prod_comm
				    				);

			    			$rtwwwap_total_commission += $rtwwwap_prod_comm;
			    		}
					}
				}
			}
			else
			{
				$rtwwwap_levels_settings 	= get_option( 'rtwwwap_levels_settings_opt' );
				$rtwwwap_user_level 		= get_user_meta( $rtwwwap_user_id, 'rtwwwap_affiliate_level', true );
				$rtwwwap_user_level 		= ( $rtwwwap_user_level ) ? $rtwwwap_user_level : '0';

				$rtwwwap_user_level_details = isset( $rtwwwap_levels_settings[ $rtwwwap_user_level ] ) ? $rtwwwap_levels_settings[ $rtwwwap_user_level ] : '';

				if( !empty( $rtwwwap_user_level_details ) ){
					$rtwwwap_level_comm_type 		= $rtwwwap_user_level_details[ 'level_commission_type' ];
					$rtwwwap_level_comm_amount 		= $rtwwwap_user_level_details[ 'level_comm_amount' ];
					$rtwwwap_level_criteria_type 	= $rtwwwap_user_level_details[ 'level_criteria_type' ];
					$rtwwwap_level_criteria_val 	= $rtwwwap_user_level_details[ 'level_criteria_val' ];

					foreach( $rtwwwap_order->get_items() as $rtwwwap_item_key => $rtwwwap_item_values )
					{
						$rtwwwap_prod_comm 		= '';
						$rtwwwap_product_id 	= $rtwwwap_item_values->get_product_id();
						$rtwwwap_product_price	= $rtwwwap_item_values->get_total();

						if( $rtwwwap_commission_type == 0 )
						{
							if( $rtwwwap_level_comm_type == 0 ){
								$rtwwwap_prod_comm = ( $rtwwwap_product_price * $rtwwwap_level_comm_amount ) / 100;
								$rtwwwap_aff_prod_details[] = array(
						    					'product_id' 		=> $rtwwwap_product_id,
						    					'product_price' 	=> $rtwwwap_product_price,
						    					'commission_fix' 	=> 'user',
						    					'commission_perc' 	=> $rtwwwap_level_comm_amount,
						    					'prod_commission' 	=> $rtwwwap_prod_comm
						    				);

					    		$rtwwwap_total_commission += $rtwwwap_prod_comm;
							}
							else{
								$rtwwwap_prod_comm = $rtwwwap_level_comm_amount;
								$rtwwwap_aff_prod_details[] = array(
						    					'product_id' 		=> $rtwwwap_product_id,
						    					'product_price' 	=> $rtwwwap_product_price,
						    					'commission_fix' 	=> 'user',
						    					'commission_perc' 	=> $rtwwwap_level_comm_amount,
						    					'prod_commission' 	=> $rtwwwap_prod_comm
						    				);

					    		$rtwwwap_total_commission += $rtwwwap_prod_comm;
							}
						}
					}
				}
			}

			if( isset( $rtwwwap_total_commission ) && $rtwwwap_total_commission !== '' && $rtwwwap_total_commission !== 0 ){
				$rtwwwap_capped 		= 0;
				$rtwwwap_current_year 	= date("Y");
				$rtwwwap_current_month 	= date("m");

				$rtwwwap_commission_settings	= get_option( 'rtwwwap_commission_settings_opt' );
				$rtwwwap_max_comm 				= isset( $rtwwwap_commission_settings[ 'max_commission' ] ) ? $rtwwwap_commission_settings[ 'max_commission' ] : '0';

				if( $rtwwwap_max_comm != 0 )
				{
					$rtwwwap_month_commission 	= $wpdb->get_var( $wpdb->prepare( "SELECT SUM(`amount`) FROM ".$wpdb->prefix."rtwwwap_referrals WHERE YEAR(date)=%d AND MONTH(date)=%d AND `aff_id`=%d", $rtwwwap_current_year, $rtwwwap_current_month, $rtwwwap_user_id ) );
					$rtwwwap_month_commission 	= isset( $rtwwwap_month_commission ) ? $rtwwwap_month_commission : 0;

					if( $rtwwwap_month_commission < $rtwwwap_max_comm ){
						$rtwwwap_this_month_left = $rtwwwap_max_comm - $rtwwwap_month_commission;
						if( $rtwwwap_this_month_left < $rtwwwap_total_commission ){
							$rtwwwap_total_commission = $rtwwwap_this_month_left;
						}
						else{
							$rtwwwap_total_commission = $rtwwwap_total_commission;
						}
					}
					else{
						$rtwwwap_capped = 1;
					}
				}

				// inserting into DB
				if( !empty( $rtwwwap_aff_prod_details ) ){
					if( get_user_meta( $rtwwwap_user_id, 'rtwwwap_referral_mail', true ) == 'on' ){
						$rtwwwap_decimal_places = $rtwwwap_extra_features['decimal_places'].'f';
						$rtwwwap_to 			= get_user_by( 'id', $rtwwwap_user_id );
						$rtwwwap_to 			= esc_html( $rtwwwap_to->user_email );
						$rtwwwap_subject 		= esc_html__( 'One new Referral', 'rtwwwap-wp-wc-affiliate-program' );
						$rtwwwap_message 		= sprintf( '%s %s%01.'.$rtwwwap_decimal_places, esc_html__( 'You got a new referral of amount', 'rtwwwap-wp-wc-affiliate-program' ), $rtwwwap_currency_sym, $rtwwwap_total_commission );
						$rtwwwap_from_name 		= esc_html( get_bloginfo( 'name' ) );
						$rtwwwap_from_email 	= esc_html( get_bloginfo( 'admin_email' ) );

						$rtwwwap_headers[] 		= sprintf( '%s: %s <%s>', esc_html__( 'From', 'rtwwwap-wp-wc-affiliate-program' ), $rtwwwap_from_name, $rtwwwap_from_email );

						// mail to affiliate
						wp_mail( $rtwwwap_to, $rtwwwap_subject, $rtwwwap_message, $rtwwwap_headers );

						if( isset( $rtwwwap_extra_features[ 'mail_to_admin' ] ) && $rtwwwap_extra_features[ 'mail_to_admin' ] == 1 ){
							// mail to admin
							$rtwwwap_message = sprintf( '%s %s%01.'.$rtwwwap_decimal_places, esc_html__( 'Generated a new referral of amount', 'rtwwwap-wp-wc-affiliate-program' ), $rtwwwap_currency_sym, $rtwwwap_total_commission );
							wp_mail( $rtwwwap_from_email, $rtwwwap_subject, $rtwwwap_message, $rtwwwap_headers );
						}
					}

					$rtwwwap_aff_prod_details = json_encode( $rtwwwap_aff_prod_details );
					$rtwwwap_device = ( wp_is_mobile() ) ? 'mobile' : 'desktop';

					$rtwwwap_locale = get_locale();
					setlocale( LC_NUMERIC, $rtwwwap_locale );

					$rtwwwap_updated = $wpdb->insert(
			            $wpdb->prefix.'rtwwwap_referrals',
			            array(
			                'aff_id'    			=> $rtwwwap_user_id,
			                'type'    				=> 0,
			                'order_id'    			=> esc_html( $rtwwwap_order_id ),
			                'date'    				=> date( 'Y-m-d H:i:s' ),
			                'status'    			=> 0,
			                'amount'    			=> $rtwwwap_total_commission,
			                'capped'    			=> esc_html( $rtwwwap_capped ),
			                'currency'    			=> $rtwwwap_currency,
			                'product_details'   	=> $rtwwwap_aff_prod_details,
			                'device'   				=> $rtwwwap_device
			            )
			        );
			        $rtwwwap_lastid = $wpdb->insert_id;

			        setlocale( LC_ALL, $rtwwwap_locale );

			        if( $rtwwwap_updated ){
			        	unset( $_COOKIE[ 'rtwwwap_referral' ] );
				        $rtwwwap_referral_noti = get_option( 'rtwwwap_referral_noti' )+1;
				        update_option( 'rtwwwap_referral_noti', $rtwwwap_referral_noti );
					}

					$rtwwwap_mlm = get_option( 'rtwwwap_mlm_opt' );
					if( isset( $rtwwwap_mlm[ 'activate' ] ) && $rtwwwap_mlm[ 'activate' ] == 1 )
					{
						$rtwwwap_child = isset( $rtwwwap_mlm[ 'child' ] ) ? $rtwwwap_mlm[ 'child' ] : 1;
						$rtwwwap_check_have_child = $this->rtwwwap_check_child_in_mlm( $rtwwwap_user_id, $rtwwwap_child );

						if( $rtwwwap_check_have_child ){
							$this->rtwwwap_give_mlm_comm( $rtwwwap_user_id, $rtwwwap_lastid, $rtwwwap_total_commission, $rtwwwap_currency, $rtwwwap_currency_sym, $rtwwwap_device, $rtwwwap_mlm[ 'mlm_levels' ], $rtwwwap_child, $rtwwwap_order_id );
						}
					}
				}
			}
		}
	}

	//unlimited comm for easy digital downloads

	function rtwwwap_unlimited_reff_comm_easy( $rtwwwap_order_id = 0, $rtwwwap_referrer_id = 0 )
	{
		$rtwwwap_verification_done = get_option( 'rtwwwap_verification_done', array() );
		$rtwwwap_verification_done_status = isset($rtwwwap_verification_done['status']) ? $rtwwwap_verification_done['status'] : false;
		$rtwwwap_verification_done_purchase = isset($rtwwwap_verification_done['purchase_code']) ? $rtwwwap_verification_done['purchase_code'] : false;
		if( empty( $rtwwwap_verification_done ) || $rtwwwap_verification_done_status == false || empty($rtwwwap_verification_done_purchase) )
		{
			return;
		}
		if( $rtwwwap_order_id && $rtwwwap_referrer_id ){
			global $wpdb;
			$rtwwwap_commission_settings = get_option( 'rtwwwap_commission_settings_opt' );
			$rtwwwap_referral 	= array( $rtwwwap_referrer_id );
			$rtwwwap_order 		= edd_get_payment( $rtwwwap_order_id );
			$rtwwwap_comm_base 	= isset( $rtwwwap_commission_settings[ 'comm_base' ] ) ? $rtwwwap_commission_settings[ 'comm_base' ] : '1';
			$rtwwwap_total_commission	= 0;
			$rtwwwap_aff_prod_details 	= array();
			$rtwwwap_user_id 			= esc_html( $rtwwwap_referral[ 0 ] );

			if( RTWWWAP_IS_WOO == 1 ){
				$rtwwwap_currency 		= get_woocommerce_currency();
				$rtwwwap_currency_sym 	= get_woocommerce_currency_symbol();
			}
			else{
				require_once( RTWWWAP_DIR.'includes/rtwaffiliatehelper.php' );

				$rtwwwap_extra_features = get_option( 'rtwwwap_extra_features_opt' );
				$rtwwwap_currency 		= isset( $rtwwwap_extra_features[ 'currency' ] ) ? $rtwwwap_extra_features[ 'currency' ] : 'USD';
				$rtwwwap_curr_obj 		= new RtwAffiliateHelper();
				$rtwwwap_currency_sym 	= $rtwwwap_curr_obj->rtwwwap_curr_symbol( $rtwwwap_currency );
			}

			$rtwwwap_commission_type 	= 0;
			$rtwwwap_shared 			= false;
			$rtwwwap_product_url 		= false;

			if( $rtwwwap_comm_base == 1 ){
				$rtwwwap_per_prod_mode 			= isset( $rtwwwap_commission_settings[ 'per_prod_mode' ] ) ? $rtwwwap_commission_settings[ 'per_prod_mode' ] : 0;
				$rtwwwap_all_commission 		= isset( $rtwwwap_commission_settings[ 'all_commission' ] ) ? $rtwwwap_commission_settings[ 'all_commission' ] : 0;
				$rtwwwap_all_commission_type 	= isset( $rtwwwap_commission_settings[ 'all_commission_type' ] ) ? $rtwwwap_commission_settings[ 'all_commission_type' ] : 'percentage';
				$rtwwwap_per_cat 				= isset( $rtwwwap_commission_settings[ 'per_cat' ] ) ? $rtwwwap_commission_settings[ 'per_cat' ] : array();

				
				foreach( $rtwwwap_order->cart_details as $rtwwwap_item_key => $rtwwwap_item_values )
					{
						$rtwwwap_prod_comm 		= '';
						$rtwwwap_product_id 	= $rtwwwap_item_values['ID'];
						$rtwwwap_product_price	= $rtwwwap_item_values['price'];					
						$rtwwwp_product_category_taxonomy = 'download_category';
					
					$rtwwwap_product_terms 	= get_the_terms( $rtwwwap_product_id, $rtwwwp_product_category_taxonomy  );
					$rtwwwap_product_cat_id = $rtwwwap_product_terms[0]->term_id;

					if( $rtwwwap_commission_type == 0 )
					{
					    if( $rtwwwap_per_prod_mode == 1 ){
							$rtwwwap_prod_per_comm = get_post_meta( $rtwwwap_product_id, 'rtwwwap_percentage_commission_box', true );

							if( $rtwwwap_prod_per_comm > 0 ){
								$rtwwwap_prod_comm = ( $rtwwwap_product_price * $rtwwwap_prod_per_comm ) / 100;
								$rtwwwap_aff_prod_details[] = array(
						    					'product_id' 		=> $rtwwwap_product_id,
						    					'product_price' 	=> $rtwwwap_product_price,
						    					'commission_fix' 	=> '',
						    					'commission_perc' 	=> $rtwwwap_prod_per_comm,
						    					'prod_commission' 	=> $rtwwwap_prod_comm
						    				);

					    		$rtwwwap_total_commission += $rtwwwap_prod_comm;
							}
							elseif( $rtwwwap_prod_per_comm === '0' ){
								// no commission needs to be generated for this product
							}
							else{
								if( !empty( $rtwwwap_per_cat ) ){
									$rtwwwap_cat_per_comm = 0;
									$rtwwwap_cat_fix_comm = 0;
									$rtwwwap_flag = false;
									foreach( $rtwwwap_per_cat as $rtwwwap_key => $rtwwwap_value ){
										if( in_array( $rtwwwap_product_cat_id, $rtwwwap_value[ 'ids' ] ) ){
											$rtwwwap_cat_per_comm = $rtwwwap_value[ 'cat_percentage_commission' ];
											$rtwwwap_cat_fix_comm = $rtwwwap_value[ 'cat_fixed_commission' ];
											$rtwwwap_flag = true;

											break;
										}
									}
									if( $rtwwwap_flag ){
										if( $rtwwwap_cat_per_comm > 0 ){
											$rtwwwap_prod_comm = ( $rtwwwap_product_price * $rtwwwap_cat_per_comm ) / 100;
										}
										if( $rtwwwap_cat_fix_comm > 0 ){
											$rtwwwap_prod_comm += $rtwwwap_cat_fix_comm;
										}

										if( $rtwwwap_prod_comm != '' ){
											$rtwwwap_aff_prod_details[] = array(
								    					'product_id' 		=> $rtwwwap_product_id,
								    					'product_price' 	=> $rtwwwap_product_price,
								    					'commission_fix' 	=> $rtwwwap_cat_fix_comm,
								    					'commission_perc' 	=> $rtwwwap_cat_per_comm,
								    					'prod_commission' 	=> $rtwwwap_prod_comm
								    				);

							    			$rtwwwap_total_commission += $rtwwwap_prod_comm;
							    		}
									}
									else{
										if( $rtwwwap_all_commission ){
											if( $rtwwwap_all_commission_type == 'percentage' ){
												$rtwwwap_prod_comm += ( $rtwwwap_product_price * $rtwwwap_all_commission ) / 100;
											}
											elseif( $rtwwwap_all_commission_type == 'fixed' ){
												$rtwwwap_prod_comm += $rtwwwap_all_commission;
											}
											$rtwwwap_aff_prod_details[] = array(
								    					'product_id' 		=> $rtwwwap_product_id,
								    					'product_price' 	=> $rtwwwap_product_price,
								    					'commission_fix' 	=> '',
								    					'commission_perc' 	=> '',
								    					'prod_commission' 	=> $rtwwwap_prod_comm
								    				);

							    			$rtwwwap_total_commission += $rtwwwap_prod_comm;
							    		}
									}
								}
								else{
									if( $rtwwwap_all_commission ){
										if( $rtwwwap_all_commission_type == 'percentage' ){
											$rtwwwap_prod_comm += ( $rtwwwap_product_price * $rtwwwap_all_commission ) / 100;
										}
										elseif( $rtwwwap_all_commission_type == 'fixed' ){
											$rtwwwap_prod_comm += $rtwwwap_all_commission;
										}
										$rtwwwap_aff_prod_details[] = array(
							    					'product_id' 		=> $rtwwwap_product_id,
							    					'product_price' 	=> $rtwwwap_product_price,
							    					'commission_fix' 	=> '',
								    				'commission_perc' 	=> '',
							    					'prod_commission' 	=> $rtwwwap_prod_comm
							    				);

						    			$rtwwwap_total_commission += $rtwwwap_prod_comm;
						    		}
								}
							}
						}
						elseif( $rtwwwap_per_prod_mode == 2 ){
							$rtwwwap_prod_fix_comm = get_post_meta( $rtwwwap_product_id, 'rtwwwap_fixed_commission_box', true );

							if( $rtwwwap_prod_fix_comm > 0 ){
								$rtwwwap_prod_comm = $rtwwwap_prod_fix_comm;
								$rtwwwap_aff_prod_details[] = array(
						    					'product_id' 		=> $rtwwwap_product_id,
						    					'product_price' 	=> $rtwwwap_product_price,
						    					'commission_fix' 	=> $rtwwwap_prod_fix_comm,
						    					'commission_perc' 	=> '',
						    					'prod_commission' 	=> $rtwwwap_prod_comm
						    				);

					    		$rtwwwap_total_commission += $rtwwwap_prod_comm;
							}
							elseif( $rtwwwap_prod_fix_comm === '0' ){
								// no commission needs to be generated for this product
							}
							else{
								if( !empty( $rtwwwap_per_cat ) ){
									$rtwwwap_cat_per_comm = 0;
									$rtwwwap_cat_fix_comm = 0;
									$rtwwwap_flag = false;
									foreach( $rtwwwap_per_cat as $rtwwwap_key => $rtwwwap_value ){
										if( in_array( $rtwwwap_product_cat_id, $rtwwwap_value[ 'ids' ] ) ){
											$rtwwwap_cat_per_comm = $rtwwwap_value[ 'cat_percentage_commission' ];
											$rtwwwap_cat_fix_comm = $rtwwwap_value[ 'cat_fixed_commission' ];
											$rtwwwap_flag = true;

											break;
										}
									}
									if( $rtwwwap_flag ){
										if( $rtwwwap_cat_per_comm > 0 ){
											$rtwwwap_prod_comm = ( $rtwwwap_product_price * $rtwwwap_cat_per_comm ) / 100;
										}
										if( $rtwwwap_cat_fix_comm > 0 ){
											$rtwwwap_prod_comm += $rtwwwap_cat_fix_comm;
										}

										if( $rtwwwap_prod_comm != '' ){
											$rtwwwap_aff_prod_details[] = array(
								    					'product_id' 		=> $rtwwwap_product_id,
								    					'product_price' 	=> $rtwwwap_product_price,
								    					'commission_fix' 	=> $rtwwwap_cat_fix_comm,
								    					'commission_perc' 	=> $rtwwwap_cat_per_comm,
								    					'prod_commission' 	=> $rtwwwap_prod_comm
								    				);

							    			$rtwwwap_total_commission += $rtwwwap_prod_comm;
							    		}
									}
									else{
										if( $rtwwwap_all_commission ){
											if( $rtwwwap_all_commission_type == 'percentage' ){
												$rtwwwap_prod_comm += ( $rtwwwap_product_price * $rtwwwap_all_commission ) / 100;
											}
											elseif( $rtwwwap_all_commission_type == 'fixed' ){
												$rtwwwap_prod_comm += $rtwwwap_all_commission;
											}
											$rtwwwap_aff_prod_details[] = array(
								    					'product_id' 		=> $rtwwwap_product_id,
								    					'product_price' 	=> $rtwwwap_product_price,
								    					'commission_fix' 	=> '',
								    					'commission_perc' 	=> '',
								    					'prod_commission' 	=> $rtwwwap_prod_comm
								    				);

							    			$rtwwwap_total_commission += $rtwwwap_prod_comm;
							    		}
									}
								}
								else{
									if( $rtwwwap_all_commission ){
										if( $rtwwwap_all_commission_type == 'percentage' ){
											$rtwwwap_prod_comm += ( $rtwwwap_product_price * $rtwwwap_all_commission ) / 100;
										}
										elseif( $rtwwwap_all_commission_type == 'fixed' ){
											$rtwwwap_prod_comm += $rtwwwap_all_commission;
										}
										$rtwwwap_aff_prod_details[] = array(
							    					'product_id' 		=> $rtwwwap_product_id,
							    					'product_price' 	=> $rtwwwap_product_price,
							    					'commission_fix' 	=> '',
								    				'commission_perc' 	=> '',
							    					'prod_commission' 	=> $rtwwwap_prod_comm
							    				);

						    			$rtwwwap_total_commission += $rtwwwap_prod_comm;
						    		}
								}
							}
						}
						elseif( $rtwwwap_per_prod_mode == 3 ){
							$rtwwwap_prod_per_comm = get_post_meta( $rtwwwap_product_id, 'rtwwwap_percentage_commission_box', true );
							$rtwwwap_prod_fix_comm = get_post_meta( $rtwwwap_product_id, 'rtwwwap_fixed_commission_box', true );

							if( $rtwwwap_prod_per_comm > 0 ){
								$rtwwwap_prod_comm += ( $rtwwwap_product_price * $rtwwwap_prod_per_comm ) / 100;
							}

							if( $rtwwwap_prod_fix_comm > 0 ){
								$rtwwwap_prod_comm += $rtwwwap_prod_fix_comm;
							}

							if( $rtwwwap_prod_comm === '' ){
								if( $rtwwwap_prod_per_comm !== '0' && $rtwwwap_prod_fix_comm !== '0' ){
									if( !empty( $rtwwwap_per_cat ) ){
										$rtwwwap_cat_per_comm = 0;
										$rtwwwap_cat_fix_comm = 0;
										$rtwwwap_flag = false;
										foreach( $rtwwwap_per_cat as $rtwwwap_key => $rtwwwap_value ){
											if( in_array( $rtwwwap_product_cat_id, $rtwwwap_value[ 'ids' ] ) ){
												$rtwwwap_cat_per_comm = $rtwwwap_value[ 'cat_percentage_commission' ];
												$rtwwwap_cat_fix_comm = $rtwwwap_value[ 'cat_fixed_commission' ];
												$rtwwwap_flag = true;

												break;
											}
										}
										if( $rtwwwap_flag ){
											if( $rtwwwap_cat_per_comm > 0 ){
												$rtwwwap_prod_comm = ( $rtwwwap_product_price * $rtwwwap_cat_per_comm ) / 100;
											}
											if( $rtwwwap_cat_fix_comm > 0 ){
												$rtwwwap_prod_comm += $rtwwwap_cat_fix_comm;
											}

											if( $rtwwwap_prod_comm != '' ){
												$rtwwwap_aff_prod_details[] = array(
									    					'product_id' 		=> $rtwwwap_product_id,
									    					'product_price' 	=> $rtwwwap_product_price,
									    					'commission_fix' 	=> $rtwwwap_cat_fix_comm,
									    					'commission_perc' 	=> $rtwwwap_cat_per_comm,
									    					'prod_commission' 	=> $rtwwwap_prod_comm
									    				);

								    			$rtwwwap_total_commission += $rtwwwap_prod_comm;
								    		}
										}
										else{
											if( $rtwwwap_all_commission ){
												if( $rtwwwap_all_commission_type == 'percentage' ){
													$rtwwwap_prod_comm += ( $rtwwwap_product_price * $rtwwwap_all_commission ) / 100;
												}
												elseif( $rtwwwap_all_commission_type == 'fixed' ){
													$rtwwwap_prod_comm += $rtwwwap_all_commission;
												}
												$rtwwwap_aff_prod_details[] = array(
									    					'product_id' 		=> $rtwwwap_product_id,
									    					'product_price' 	=> $rtwwwap_product_price,
									    					'commission_fix' 	=> '',
									    					'commission_perc' 	=> '',
									    					'prod_commission' 	=> $rtwwwap_prod_comm
									    				);

								    			$rtwwwap_total_commission += $rtwwwap_prod_comm;
								    		}
										}
									}
									else{
										if( $rtwwwap_all_commission ){
											if( $rtwwwap_all_commission_type == 'percentage' ){
												$rtwwwap_prod_comm += ( $rtwwwap_product_price * $rtwwwap_all_commission ) / 100;
											}
											elseif( $rtwwwap_all_commission_type == 'fixed' ){
												$rtwwwap_prod_comm += $rtwwwap_all_commission;
											}
											$rtwwwap_aff_prod_details[] = array(
								    					'product_id' 		=> $rtwwwap_product_id,
								    					'product_price' 	=> $rtwwwap_product_price,
								    					'commission_fix' 	=> '',
									    				'commission_perc' 	=> '',
								    					'prod_commission' 	=> $rtwwwap_prod_comm
								    				);

							    			$rtwwwap_total_commission += $rtwwwap_prod_comm;
							    		}
									}
								}
							}
							else{
								$rtwwwap_aff_prod_details[] = array(
					    					'product_id' 		=> $rtwwwap_product_id,
					    					'product_price' 	=> $rtwwwap_product_price,
					    					'commission_fix' 	=> $rtwwwap_prod_fix_comm,
						    				'commission_perc' 	=> $rtwwwap_prod_per_comm,
					    					'prod_commission' 	=> $rtwwwap_prod_comm
					    				);

				    			$rtwwwap_total_commission += $rtwwwap_prod_comm;
							}
						}
						elseif( $rtwwwap_all_commission ){
							if( $rtwwwap_all_commission_type == 'percentage' ){
								$rtwwwap_prod_comm += ( $rtwwwap_product_price * $rtwwwap_all_commission ) / 100;
							}
							elseif( $rtwwwap_all_commission_type == 'fixed' ){
								$rtwwwap_prod_comm += $rtwwwap_all_commission;
							}
							$rtwwwap_aff_prod_details[] = array(
				    					'product_id' 		=> $rtwwwap_product_id,
				    					'product_price' 	=> $rtwwwap_product_price,
				    					'commission_fix' 	=> '',
					    				'commission_perc' 	=> '',
				    					'prod_commission' 	=> $rtwwwap_prod_comm
				    				);

			    			$rtwwwap_total_commission += $rtwwwap_prod_comm;
			    		}
					}
				}
			}
			else
			{
				$rtwwwap_levels_settings 	= get_option( 'rtwwwap_levels_settings_opt' );
				$rtwwwap_user_level 		= get_user_meta( $rtwwwap_user_id, 'rtwwwap_affiliate_level', true );
				$rtwwwap_user_level 		= ( $rtwwwap_user_level ) ? $rtwwwap_user_level : '0';

				$rtwwwap_user_level_details = isset( $rtwwwap_levels_settings[ $rtwwwap_user_level ] ) ? $rtwwwap_levels_settings[ $rtwwwap_user_level ] : '';

				if( !empty( $rtwwwap_user_level_details ) ){
					$rtwwwap_level_comm_type 		= $rtwwwap_user_level_details[ 'level_commission_type' ];
					$rtwwwap_level_comm_amount 		= $rtwwwap_user_level_details[ 'level_comm_amount' ];
					$rtwwwap_level_criteria_type 	= $rtwwwap_user_level_details[ 'level_criteria_type' ];
					$rtwwwap_level_criteria_val 	= $rtwwwap_user_level_details[ 'level_criteria_val' ];

					
					foreach( $rtwwwap_order->cart_details as $rtwwwap_item_key => $rtwwwap_item_values )
					{
						$rtwwwap_prod_comm 		= '';
						$rtwwwap_product_id 	= $rtwwwap_item_values['ID'];
						$rtwwwap_product_price	= $rtwwwap_item_values['price'];					
						$rtwwwp_product_category_taxonomy = 'download_category';
						if( $rtwwwap_commission_type == 0 )
						{
							if( $rtwwwap_level_comm_type == 0 ){
								$rtwwwap_prod_comm = ( $rtwwwap_product_price * $rtwwwap_level_comm_amount ) / 100;
								$rtwwwap_aff_prod_details[] = array(
						    					'product_id' 		=> $rtwwwap_product_id,
						    					'product_price' 	=> $rtwwwap_product_price,
						    					'commission_fix' 	=> 'user',
						    					'commission_perc' 	=> $rtwwwap_level_comm_amount,
						    					'prod_commission' 	=> $rtwwwap_prod_comm
						    				);

					    		$rtwwwap_total_commission += $rtwwwap_prod_comm;
							}
							else{
								$rtwwwap_prod_comm = $rtwwwap_level_comm_amount;
								$rtwwwap_aff_prod_details[] = array(
						    					'product_id' 		=> $rtwwwap_product_id,
						    					'product_price' 	=> $rtwwwap_product_price,
						    					'commission_fix' 	=> 'user',
						    					'commission_perc' 	=> $rtwwwap_level_comm_amount,
						    					'prod_commission' 	=> $rtwwwap_prod_comm
						    				);

					    		$rtwwwap_total_commission += $rtwwwap_prod_comm;
							}
						}
					}
				}
			}

			if( isset( $rtwwwap_total_commission ) && $rtwwwap_total_commission !== '' && $rtwwwap_total_commission !== 0 ){
				$rtwwwap_capped 		= 0;
				$rtwwwap_current_year 	= date("Y");
				$rtwwwap_current_month 	= date("m");

				$rtwwwap_commission_settings	= get_option( 'rtwwwap_commission_settings_opt' );
				$rtwwwap_max_comm 				= isset( $rtwwwap_commission_settings[ 'max_commission' ] ) ? $rtwwwap_commission_settings[ 'max_commission' ] : '0';

				if( $rtwwwap_max_comm != 0 )
				{
					$rtwwwap_month_commission 	= $wpdb->get_var( $wpdb->prepare( "SELECT SUM(`amount`) FROM ".$wpdb->prefix."rtwwwap_referrals WHERE YEAR(date)=%d AND MONTH(date)=%d AND `aff_id`=%d", $rtwwwap_current_year, $rtwwwap_current_month, $rtwwwap_user_id ) );
					$rtwwwap_month_commission 	= isset( $rtwwwap_month_commission ) ? $rtwwwap_month_commission : 0;

					if( $rtwwwap_month_commission < $rtwwwap_max_comm ){
						$rtwwwap_this_month_left = $rtwwwap_max_comm - $rtwwwap_month_commission;
						if( $rtwwwap_this_month_left < $rtwwwap_total_commission ){
							$rtwwwap_total_commission = $rtwwwap_this_month_left;
						}
						else{
							$rtwwwap_total_commission = $rtwwwap_total_commission;
						}
					}
					else{
						$rtwwwap_capped = 1;
					}
				}

				// inserting into DB
				if( !empty( $rtwwwap_aff_prod_details ) ){
					if( get_user_meta( $rtwwwap_user_id, 'rtwwwap_referral_mail', true ) == 'on' ){
						$rtwwwap_decimal_places = $rtwwwap_extra_features['decimal_places'].'f';
						$rtwwwap_to 			= get_user_by( 'id', $rtwwwap_user_id );
						$rtwwwap_to 			= esc_html( $rtwwwap_to->user_email );
						$rtwwwap_subject 		= esc_html__( 'One new Referral', 'rtwwwap-wp-wc-affiliate-program' );
						$rtwwwap_message 		= sprintf( '%s %s%01.'.$rtwwwap_decimal_places, esc_html__( 'You got a new referral of amount', 'rtwwwap-wp-wc-affiliate-program' ), $rtwwwap_currency_sym, $rtwwwap_total_commission );
						$rtwwwap_from_name 		= esc_html( get_bloginfo( 'name' ) );
						$rtwwwap_from_email 	= esc_html( get_bloginfo( 'admin_email' ) );

						$rtwwwap_headers[] 		= sprintf( '%s: %s <%s>', esc_html__( 'From', 'rtwwwap-wp-wc-affiliate-program' ), $rtwwwap_from_name, $rtwwwap_from_email );

						// mail to affiliate
						wp_mail( $rtwwwap_to, $rtwwwap_subject, $rtwwwap_message, $rtwwwap_headers );

						if( isset( $rtwwwap_extra_features[ 'mail_to_admin' ] ) && $rtwwwap_extra_features[ 'mail_to_admin' ] == 1 ){
							// mail to admin
							$rtwwwap_message = sprintf( '%s %s%01.'.$rtwwwap_decimal_places, esc_html__( 'Generated a new referral of amount', 'rtwwwap-wp-wc-affiliate-program' ), $rtwwwap_currency_sym, $rtwwwap_total_commission );
							wp_mail( $rtwwwap_from_email, $rtwwwap_subject, $rtwwwap_message, $rtwwwap_headers );
						}
					}

					$rtwwwap_aff_prod_details = json_encode( $rtwwwap_aff_prod_details );
					$rtwwwap_device = ( wp_is_mobile() ) ? 'mobile' : 'desktop';

					$rtwwwap_locale = get_locale();
					setlocale( LC_NUMERIC, $rtwwwap_locale );

					$rtwwwap_updated = $wpdb->insert(
			            $wpdb->prefix.'rtwwwap_referrals',
			            array(
			                'aff_id'    			=> $rtwwwap_user_id,
			                'type'    				=> 0,
			                'order_id'    			=> esc_html( $rtwwwap_order_id ),
			                'date'    				=> date( 'Y-m-d H:i:s' ),
			                'status'    			=> 0,
			                'amount'    			=> $rtwwwap_total_commission,
			                'capped'    			=> esc_html( $rtwwwap_capped ),
			                'currency'    			=> $rtwwwap_currency,
			                'product_details'   	=> $rtwwwap_aff_prod_details,
			                'device'   				=> $rtwwwap_device
			            )
			        );
			        $rtwwwap_lastid = $wpdb->insert_id;

			        setlocale( LC_ALL, $rtwwwap_locale );

			        if( $rtwwwap_updated ){
			        	unset( $_COOKIE[ 'rtwwwap_referral' ] );
				        $rtwwwap_referral_noti = get_option( 'rtwwwap_referral_noti' )+1;
				        update_option( 'rtwwwap_referral_noti', $rtwwwap_referral_noti );
					}

					$rtwwwap_mlm = get_option( 'rtwwwap_mlm_opt' );
					if( isset( $rtwwwap_mlm[ 'activate' ] ) && $rtwwwap_mlm[ 'activate' ] == 1 )
					{
						$rtwwwap_child = isset( $rtwwwap_mlm[ 'child' ] ) ? $rtwwwap_mlm[ 'child' ] : 1;
						$rtwwwap_check_have_child = $this->rtwwwap_check_child_in_mlm( $rtwwwap_user_id, $rtwwwap_child );

						if( $rtwwwap_check_have_child ){
							$this->rtwwwap_give_mlm_comm( $rtwwwap_user_id, $rtwwwap_lastid, $rtwwwap_total_commission, $rtwwwap_currency, $rtwwwap_currency_sym, $rtwwwap_device, $rtwwwap_mlm[ 'mlm_levels' ], $rtwwwap_child, $rtwwwap_order_id );
						}
					}
				}
			}
		}
	}

	function rtwwwap_cart_loaded_from_session($cart)
	{
		$rtwwwap_commission_settings 	= get_option( 'rtwwwap_commission_settings_opt' );
		//lifetime
		$rtwwwap_unlimit_comm = isset( $rtwwwap_commission_settings[ 'unlimit_comm' ] ) ? $rtwwwap_commission_settings[ 'unlimit_comm' ] : '0';
		if( isset( $_COOKIE[ 'rtwwwap_referral' ] ) || $rtwwwap_unlimit_comm == 1 )
		{
			global $wpdb;
			$rtwwwap_referrer_id = 0;
			$rtwwwap_current_user_id = get_current_user_id();

			if( $rtwwwap_current_user_id ){
				$rtwwwap_referrer_id = get_user_meta( $rtwwwap_current_user_id, 'rtwwwap_lifetime_user_id', true );
			}
			if( $rtwwwap_referrer_id || isset( $_COOKIE[ 'rtwwwap_referral' ] ) )
			{
				global $woocommerce;
				global $wpdb;
				$rtwwwap_sorted_cart = array();
				if ( sizeof( $cart->cart_contents ) > 0 ) {
					foreach ( $cart->cart_contents as $cart_item_key => &$values ) {
						if ( $values === null ) {
							continue;
						}

						if ( isset( $cart->cart_contents[ $cart_item_key ]['discounts'] ) ) {
							unset( $cart->cart_contents[ $cart_item_key ]['discounts'] );
						}
						$rtwwwap_sorted_cart[ $cart_item_key ] = &$values;
					}
				}

				if ( empty( $rtwwwap_sorted_cart ) ) {
					return;
				}
				$rtwwwap_verification_done = get_option( 'rtwwwap_verification_done', array() );
				$rtwwwap_verification_done_status = isset($rtwwwap_verification_done['status']) ? $rtwwwap_verification_done['status'] : false;
				$rtwwwap_verification_done_purchase = isset($rtwwwap_verification_done['purchase_code']) ? $rtwwwap_verification_done['purchase_code'] : false;
				if( empty( $rtwwwap_verification_done ) || $rtwwwap_verification_done_status == false || empty($rtwwwap_verification_done_purchase) )
				{
					return;
				}
				$rtwwwap_temp_cart = $rtwwwap_sorted_cart;
				global $woocommerce;
				$rtwwwap_cart_prod_count = $woocommerce->cart->cart_contents;
				$rtwwwap_prod_count = 0;
				if( is_array($rtwwwap_cart_prod_count) && !empty($rtwwwap_cart_prod_count) )
				{
					foreach ($rtwwwap_cart_prod_count as $key => $value) {
						$rtwwwap_prod_count += $value['quantity'];
					}
				}

				foreach ( $rtwwwap_temp_cart as $rtwwwap_cart => $rtwwwap_value ) {
					$rtwwwap_temp_cart[ $rtwwwap_cart ]                       = $rtwwwap_value;
					$rtwwwap_temp_cart[ $rtwwwap_cart ]['available_quantity'] = $rtwwwap_value['quantity'];
				}
				$set_id = 0;
				foreach ( $rtwwwap_temp_cart as $cart_item_key => $cart_item )
				{
					if ( ! $this->rtwwdpd_is_cumulative( $cart_item, $cart_item_key ) )
					{
						if ( $this->rtwwdpd_is_item_discounted( $cart_item, $cart_item_key ) ) {
							continue;
						}
					}

					$rtwwdpd_discounted = isset( WC()->cart->cart_contents[ $cart_item_key ]['discounts'] );

					if ($rtwwdpd_discounted){
						$rtwwdpd_d = WC()->cart->cart_contents[ $cart_item_key ]['discounts'];
						if (in_array('rtwwwap_referral_discount', $rtwwdpd_d['by'])) {
							continue;
						}
					}
					$rtwwdpd_original_price = $this->rtw_get_price_to_discount( $cart_item, $cart_item_key, true );

					if ( $rtwwdpd_original_price )
					{
						
							$comm_type = get_post_meta($cart_item['product_id'], '_rtwwwap_cust_comm_type', true);
							$comm_value = get_post_meta($cart_item['product_id'], '_rtwwwap_cust_comm_value', true);
							if($comm_type == 'percentage')
							{
								$rtwwdpd_amount = $comm_value / 100;
								$rtwwdpd_dscnted_val = ( floatval( $rtwwdpd_amount ) * $rtwwdpd_original_price );
								$rtwwdpd_price_adjusted = ( floatval( $rtwwdpd_original_price ) - $rtwwdpd_dscnted_val );
								if ( $rtwwdpd_price_adjusted !== false && floatval( $rtwwdpd_original_price ) != floatval( $rtwwdpd_price_adjusted ) ) {
									$this->rtw_apply_cart_item_adjustment( $cart_item_key, $rtwwdpd_original_price, $rtwwdpd_price_adjusted, 'rtwwwap_referral_discount', $set_id );
									$set_id++;
									break;
								}
							}
							else if($comm_type == 'fixed')
							{
								$rtwwdpd_amount = ( $comm_value / $rtwwwap_prod_count );
								$rtwwdpd_price_adjusted = ( $rtwwdpd_original_price - $rtwwdpd_amount );
								if ( $rtwwdpd_price_adjusted !== false && floatval( $rtwwdpd_original_price ) != floatval( $rtwwdpd_price_adjusted ) ) {
									$this->rtw_apply_cart_item_adjustment( $cart_item_key, $rtwwdpd_original_price, $rtwwdpd_price_adjusted, 'rtwwwap_referral_discount', $set_id );
									$set_id++;
									break;
								}
							}
						
					}
				}
			}
		}
	}


	/**
	 * Function to get product price on which discount is applied.
	 *
	 * @since    1.0.0
	 */
	function rtw_get_price_to_discount( $rtwwdpd_cart_item, $rtwwdpd_cart_item_key, $rtw_stack_rules = false ) {
		global $woocommerce;
		$rtwwdpd_setting_pri = get_option('rtwwdpd_setting_priority');
		$rtwwdpd_result = false;
		do_action( 'rtwwdpd_memberships_discounts_disable_price_adjustments' );

		$rtwwdpd_filter_cart_item = $rtwwdpd_cart_item;
		if ( isset( WC()->cart->cart_contents[ $rtwwdpd_cart_item_key ] ) ) {
			$rtwwdpd_filter_cart_item = WC()->cart->cart_contents[ $rtwwdpd_cart_item_key ];

			if ( isset( WC()->cart->cart_contents[ $rtwwdpd_cart_item_key ]['discounts'] ) ) {
				if ( $this->rtwwdpd_is_cumulative( $rtwwdpd_cart_item, $rtwwdpd_cart_item_key ) || $rtw_stack_rules ) {
					$rtwwdpd_result = WC()->cart->cart_contents[ $rtwwdpd_cart_item_key ]['discounts']['price_adjusted'];
				} else {
					$rtwwdpd_result = WC()->cart->cart_contents[ $rtwwdpd_cart_item_key ]['discounts']['price_base'];
				}
			} else {
				if( isset( $rtwwdpd_setting_pri['rtw_dscnt_on'] ) && $rtwwdpd_setting_pri['rtw_dscnt_on'] == 'rtw_sale_price')
				{
					if ( apply_filters( 'rtwwdpd_dynamic_pricing_get_use_sale_price', true, $rtwwdpd_filter_cart_item['data'] ) ) {
						$rtwwdpd_result = WC()->cart->cart_contents[ $rtwwdpd_cart_item_key ]['data']->get_price('edit');
					}
					else {
						$rtwwdpd_result = WC()->cart->cart_contents[ $rtwwdpd_cart_item_key ]['data']->get_regular_price('edit');
					}
				}
				else{
					$rtwwdpd_result = WC()->cart->cart_contents[ $rtwwdpd_cart_item_key ]['data']->get_regular_price('edit');
				}
			}
		}

		return $rtwwdpd_result;
	}

	/**
	 * Function to check if a product is discounted.
	 *
	 * @since    1.0.0
	 */
	function rtwwdpd_is_item_discounted( $rtwwdpd_cart_item, $rtwwdpd_cart_item_key ) {
		global $woocommerce;

		return isset( WC()->cart->cart_contents[ $rtwwdpd_cart_item_key ]['discounts'] );
	}

	/**
	 * Function to check if a product is already discounted by the same rule.
	 *
	 * @since    1.0.0
	 */
	function rtwwdpd_is_cumulative( $rtwwdpd_cart_item, $rtwwdpd_cart_item_key, $rtwwdpd_default = true ) {
		//Check to make sure the item has not already been discounted by this module.  This could happen if update_totals is called more than once in the cart.
		$rtwwdpd_cart = WC()->cart->get_cart();

		if ( isset( $rtwwdpd_cart ) && is_array( $rtwwdpd_cart ) && isset( $rtwwdpd_cart[ $rtwwdpd_cart_item_key ]['discounts'] ) && in_array( 'rtwwwap_referral_discount', WC()->cart->cart_contents[ $rtwwdpd_cart_item_key ]['discounts']['by'] ) ) {

			return false;
		} else {
			return apply_filters( 'rtwwdpd_is_cumulative', $rtwwdpd_default, 'rtwwwap_referral_discount', $rtwwdpd_cart_item, $rtwwdpd_cart_item_key );
		}
	}

	/**
	 * Function to reset cart items.
	 *
	 * @since    1.0.0
	 */
	function rtw_reset_cart_item( &$rtwwdpd_cart_item, $rtwwdpd_cart_item_key ) {

		if ( isset( WC()->cart->cart_contents[ $rtwwdpd_cart_item_key ]['discounts'] ) && in_array( 'rtwwwap_referral_discount', WC()->cart->cart_contents[ $rtwwdpd_cart_item_key ]['discounts']['by'] ) ) {
			foreach ( WC()->cart->cart_contents[ $rtwwdpd_cart_item_key ]['discounts'] as $module ) {

			}
		}
	}



	function rtw_apply_cart_item_adjustment( $cart_item_key, $rtwwdpd_original_price, $rtwwdpd_adjusted_price, $module, $set_id ) {
		
		//Allow extensions to stop processing of applying the discount.  Added for subscriptions signup fee compatibility
		if ( $rtwwdpd_adjusted_price === false ) {
			return;
		}

		if ( isset( WC()->cart->cart_contents[ $cart_item_key ] ) && ! empty( WC()->cart->cart_contents[ $cart_item_key ] ) ) {


			$_product = WC()->cart->cart_contents[ $cart_item_key ]['data'];

			if ( apply_filters( 'rtwwdpd_dynamic_pricing_get_use_sale_price', true, $_product ) ) {
				$rtwwdpd_display_price = get_option( 'woocommerce_tax_display_cart' ) == 'excl' ? wc_get_price_excluding_tax( $_product ) : wc_get_price_including_tax( $_product );
			} else {
				$rtwwdpd_display_price = get_option( 'woocommerce_tax_display_cart' ) == 'excl' ? wc_get_price_excluding_tax( $_product, array( 'price' => $rtwwdpd_original_price ) ) : wc_get_price_including_tax( $_product, array( 'price' => $rtwwdpd_original_price ) );
			}
			if( isset( $rtwwdpd_setting_pri['rtw_dscnt_on'] ) && $rtwwdpd_setting_pri['rtw_dscnt_on'] == 'rtw_sale_price')
			{
				$rtwwdpd_display_price = $_product->get_price();
			}
			else{
				$rtwwdpd_display_price = $_product->get_regular_price();
			}

			WC()->cart->cart_contents[ $cart_item_key ]['data']->set_price( $rtwwdpd_adjusted_price );
			
			if ( $_product->get_type() == 'composite' ) {
				WC()->cart->cart_contents[ $cart_item_key ]['data']->base_price = $rtwwdpd_adjusted_price;
			}

			if ( ! isset( WC()->cart->cart_contents[ $cart_item_key ]['discounts'] ) ) {

				$rtwwdpd_discount_data                                           = array(
					'by'                => array( $module ),
					'set_id'            => $set_id,
					'price_base'        => $rtwwdpd_original_price,
					'display_price'     => $rtwwdpd_display_price,
					'price_adjusted'    => $rtwwdpd_adjusted_price,
					'applied_discounts' => array(
						array(
							'by'             => $module,
							'set_id'         => $set_id,
							'price_base'     => $rtwwdpd_original_price,
							'price_adjusted' => $rtwwdpd_adjusted_price
						)
					)
				);
				WC()->cart->cart_contents[ $cart_item_key ]['discounts'] = $rtwwdpd_discount_data;
			} else {

				$rtwwdpd_existing = WC()->cart->cart_contents[ $cart_item_key ]['discounts'];

				$rtwwdpd_discount_data = array(
					'by'             => $rtwwdpd_existing['by'],
					'set_id'         => $set_id,
					'price_base'     => $rtwwdpd_original_price,
					'display_price'  => $rtwwdpd_existing['display_price'],
					'price_adjusted' => $rtwwdpd_adjusted_price
				);

				WC()->cart->cart_contents[ $cart_item_key ]['discounts'] = $rtwwdpd_discount_data;

				$history = array(
					'by'             => $rtwwdpd_existing['by'],
					'set_id'         => $rtwwdpd_existing['set_id'],
					'price_base'     => $rtwwdpd_existing['price_base'],
					'price_adjusted' => $rtwwdpd_existing['price_adjusted']
				);
				array_push( WC()->cart->cart_contents[ $cart_item_key ]['discounts']['by'], $module );
				WC()->cart->cart_contents[ $cart_item_key ]['discounts']['applied_discounts'][] = $history;
			}
		}
		
	}


	// Change sale price html
	function rtwwwap_on_display_cart_item_price_html($rtwwdpd_html, $rtwwdpd_cart_item, $rtwwdpd_cart_item_key)
	{
		if ( $this->rtwwdpd_is_item_discounted( $rtwwdpd_cart_item, $rtwwdpd_cart_item_key ) ) {
			$_product = $rtwwdpd_cart_item['data'];

			if ( function_exists( 'get_product' ) ) {
				if (isset($rtwwdpd_cart_item['is_deposit']) && $rtwwdpd_cart_item['is_deposit']) {
					$rtwwdpd_price_to_calculate = isset( $rtwwdpd_cart_item['discounts'] ) ? $rtwwdpd_cart_item['discounts']['price_adjusted'] : $rtwwdpd_cart_item['data']->get_price();
				} else {
					$rtwwdpd_price_to_calculate = $rtwwdpd_cart_item['data']->get_price();
				}

				$rtwwdpd_price_adjusted = get_option( 'woocommerce_tax_display_cart' ) == 'excl' ? wc_get_price_excluding_tax($_product, array('price' => $rtwwdpd_price_to_calculate, 'qty' => 1)) : wc_get_price_including_tax($_product, array('price' => $rtwwdpd_price_to_calculate, 'qty' => 1));
				$rtwwdpd_price_base = $rtwwdpd_cart_item['discounts']['display_price'];

			} else {
				if ( get_option( 'rtwwdpd_display_cart_prices_excluding_tax' ) == 'yes' ) :
					$rtwwdpd_price_adjusted = wc_get_price_excluding_tax($rtwwdpd_cart_item['data']);
					$rtwwdpd_price_base = $rtwwdpd_cart_item['discounts']['display_price'];
				else :
					$rtwwdpd_price_adjusted = $rtwwdpd_cart_item['data']->get_price();
					$rtwwdpd_price_base = $rtwwdpd_cart_item['discounts']['display_price'];
				endif;
			}

			if($rtwwdpd_price_adjusted != $rtwwdpd_price_base){

				if ( !empty( $rtwwdpd_price_adjusted ) || $rtwwdpd_price_adjusted === 0 || $rtwwdpd_price_adjusted === 0.00 ) {
					if ( apply_filters( 'rtwwdpd_use_discount_format', true ) ) {
						$rtwwdpd_html = '<del>' . wc_price( $rtwwdpd_price_base ) . '</del><ins> ' . wc_price( $rtwwdpd_price_adjusted ) . '</ins>';
					} else {
						$rtwwdpd_html = '<span class="amount">' . wc_price( $rtwwdpd_price_adjusted ) . '</span>';
					}
				}
			}
		}
		return $rtwwdpd_html;
	}

// Change sale price html for easy digital downloads 

	function rtwwwap_on_display_cart_item_price_html_edd($rtwwwap_price, $rtwwwap_prod_id)
	{
	
		$rtwwwap_commission_settings 	= get_option( 'rtwwwap_commission_settings_opt' );
		//lifetime
		$rtwwwap_unlimit_comm = isset( $rtwwwap_commission_settings[ 'unlimit_comm' ] ) ? $rtwwwap_commission_settings[ 'unlimit_comm' ] : '0';
	

		if( isset( $_COOKIE[ 'rtwwwap_referral' ] ) || $rtwwwap_unlimit_comm == 1 )
		{
			global $wpdb;
			$rtwwwap_referrer_id = 0;
			$rtwwwap_current_user_id = get_current_user_id();

			if( $rtwwwap_current_user_id ){
				$rtwwwap_referrer_id = get_user_meta( $rtwwwap_current_user_id, 'rtwwwap_lifetime_user_id', true );
			}
			if( $rtwwwap_referrer_id || isset( $_COOKIE[ 'rtwwwap_referral' ] ) )
			{
			
				$rtwwwap_verification_done = get_option( 'rtwwwap_verification_done', array() );
				$rtwwwap_verification_done_status = isset($rtwwwap_verification_done['status']) ? $rtwwwap_verification_done['status'] : false;
				$rtwwwap_verification_done_purchase = isset($rtwwwap_verification_done['purchase_code']) ? $rtwwwap_verification_done['purchase_code'] : false;
				if( empty( $rtwwwap_verification_done ) || $rtwwwap_verification_done_status == false || empty($rtwwwap_verification_done_purchase) )
				{
					return $rtwwwap_price;
				}

						$cart = EDD()->session->get( 'edd_cart' );

				if(!empty($cart))
				{
					$rtwwwap_prod_index = false;
					foreach($cart as $key => $value)
					{
						if($value['id'] == $rtwwwap_prod_id)
						{
							$rtwwwap_prod_index = $key;
						break;
						}
					}
					if($rtwwwap_prod_index === false || (isset($cart[$rtwwwap_prod_index]['rtwwwap_is_twoway']) && $cart[$rtwwwap_prod_index]['rtwwwap_is_twoway'] == true))
					{
						return $rtwwwap_price;
					}					
					$comm_type = get_post_meta($value['id'], '_rtwwwap_cust_comm_type', true);
					$comm_value = get_post_meta($value['id'], '_rtwwwap_cust_comm_value', true);
					
					if($comm_type == 'percentage')
					{
						$rtwwdpd_amount = $comm_value / 100;
						$rtwwwap_dscnted_val = ( floatval( $rtwwdpd_amount ) * $rtwwwap_price);
						$rtwwwap_price = ( floatval( $rtwwwap_price ) - $rtwwwap_dscnted_val );
						 $cart[$rtwwwap_prod_index]['rtwwwap_is_twoway'] = true ; 
					}
					else if($comm_type == 'fixed')
					{
						$rtwwwap_price = ( $rtwwwap_price - $comm_value );
						$cart[$rtwwwap_prod_index]['rtwwwap_is_twoway'] = true ; 
					}		
					return $rtwwwap_price;
				}
				
			}
		}
		
		return $rtwwwap_price;
	}

	function rtwwwap_login_fail_redirect($redirect_to, $requested_redirect_to, $user)
	{
		
		$rtwwwap_login_page_id = get_option('rtwwwap_login_page_id');
		$rtwwwap_affiliate_page_id = get_option('rtwwwap_affiliate_page_id');
		$referrer = (isset($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : $_SERVER['PHP_SELF'];
		if( !empty($rtwwwap_login_page_id) )
		{
			$redirect_url = get_permalink($rtwwwap_login_page_id);
			if (is_wp_error($user) && !empty($referrer) && (strstr($referrer, get_permalink($rtwwwap_login_page_id)) ||   strstr($referrer, get_permalink($rtwwwap_affiliate_page_id)) ))
			{
				$redirect_url = add_query_arg('login_errors', urlencode(wp_kses($user->get_error_message(), array('strong' => array(0)))), $redirect_url);
				wp_redirect($redirect_url);
			}
		}
		else if( !empty($rtwwwap_affiliate_page_id) )
		{
			$redirect_url = get_permalink($rtwwwap_affiliate_page_id);
			if (is_wp_error($user) && !empty($referrer) && (strstr($referrer, get_permalink($rtwwwap_login_page_id)) ||   strstr($referrer, get_permalink($rtwwwap_affiliate_page_id))  ))
			{
				$redirect_url = add_query_arg('login_errors', urlencode(wp_kses($user->get_error_message(), array('strong' => array(0)))), $redirect_url);
				wp_redirect($redirect_url);
			}
		}
		return $redirect_to;
	}

	function rtwwwap_register_fail_redirect($user)
	{
		$rtwwwap_register_page_id = get_option('rtwwwap_register_page_id');
		$rtwwwap_affiliate_page_id = get_option('rtwwwap_affiliate_page_id');
		$referrer = (isset($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : $_SERVER['PHP_SELF'];
		
		if( !empty($rtwwwap_register_page_id) )
		{	
			$redirect_url = get_permalink($rtwwwap_register_page_id);
			if (is_wp_error($user) && !empty($referrer) && (strstr($referrer, get_permalink($rtwwwap_register_page_id)) ||   strstr($referrer, get_permalink($rtwwwap_affiliate_page_id))  ))
			{
				$redirect_url = add_query_arg('failed', urlencode(wp_kses($user->get_error_message(), array('strong' => array(0)))), $redirect_url);
				wp_redirect($redirect_url);
			}
		}
		else if( !empty($rtwwwap_affiliate_page_id) )
		{
			$redirect_url = get_permalink($rtwwwap_affiliate_page_id);
			if (is_wp_error($user) && !empty($referrer) && (strstr($referrer, get_permalink($rtwwwap_register_page_id)) ||   strstr($referrer, get_permalink($rtwwwap_affiliate_page_id))  ))
			{				
				$redirect_url = add_query_arg('failed', urlencode(wp_kses($user->get_error_message(), array('strong' => array(0)))), $redirect_url);
				wp_redirect($redirect_url);
			}
		}
		return $user;
	}


	function rtwwwap_override_reset_password_form_redirect() {
		$action = isset( $_GET['action'] ) ? $_GET['action'] : '';
		$rp_key = isset( $_GET['key'] ) ? $_GET['key'] : '';
		$rp_login = isset( $_GET['login'] ) ? $_GET['login'] : '';
		$rtwwwap_affiliate_page_id = get_option('rtwwwap_affiliate_page_id');
		$redirect_url = get_permalink($rtwwwap_affiliate_page_id);

		if ( $_SERVER['REQUEST_METHOD'] != 'POST' )
		{
			if ( 'wp-login.php' === $GLOBALS['pagenow'] && ( 'rp' == $action  || 'resetpass' == $action ) )
			{
				$redirect_url = add_query_arg( 'rp_login', esc_attr( $_GET['login'] ), $redirect_url );
				$redirect_url = add_query_arg( 'rp_key', esc_attr( $_GET['key'] ), $redirect_url );
				$redirect_url = add_query_arg( 'action', esc_attr( $_GET['action'] ), $redirect_url );
				wp_redirect( $redirect_url );
				exit;
			}
		}
	}


	function rtwwwap_do_password_reset()
	{
		if ( 'POST' == $_SERVER['REQUEST_METHOD'] )
		 {
			$key = $_POST['rp_key'];
			$login = $_POST['rp_login'];
			$rtwwwap_affiliate_page_id = get_option('rtwwwap_affiliate_page_id');
			$rtwwwap_redirect_url = get_permalink($rtwwwap_affiliate_page_id);
			$user = check_password_reset_key( $key, $login );

				if(isset($_POST['pass1']) && !empty($_POST['pass1']))
				{
					reset_password( $user, $_POST['pass1'] );
					wp_redirect( $rtwwwap_redirect_url );
					exit;
				}
		}
	 
			
			
	}
	
	


	
}
