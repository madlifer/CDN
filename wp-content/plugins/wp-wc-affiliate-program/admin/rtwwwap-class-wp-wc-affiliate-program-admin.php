<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://www.redefiningtheweb.com
 * @since      1.0.0
 *
 * @package    Rtwwwap_Wp_Wc_Affiliate_Program
 * @subpackage Rtwwwap_Wp_Wc_Affiliate_Program/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Rtwwwap_Wp_Wc_Affiliate_Program
 * @subpackage Rtwwwap_Wp_Wc_Affiliate_Program/admin
 * @author     RedefiningTheWeb <developer@redefiningtheweb.com>
 */
class Rtwwwap_Wp_Wc_Affiliate_Program_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $rtwwwap_plugin_name    The ID of this plugin.
	 */
	private $rtwwwap_plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $rtwwwap_version    The current version of this plugin.
	 */
	private $rtwwwap_version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $rtwwwap_plugin_name       The name of this plugin.
	 * @param      string    $rtwwwap_version    The version of this plugin.
	 */
	public function __construct( $rtwwwap_plugin_name, $rtwwwap_version ) {

		$this->rtwwwap_plugin_name = $rtwwwap_plugin_name;
		$this->rtwwwap_version = $rtwwwap_version;

	}

	/**
	 * Register the stylesheets for the admin area.
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

		$rtwwwap_css_allowed_pages = array(
										'edit-product',
										'toplevel_page_rtwwwap',
										'product',
										'user-edit',
										'users',
										'user',
										'profile',
										'download'
									);

		$rtwwwap_screen 	= function_exists( 'get_current_screen' ) ? get_current_screen() : '';
		$rtwwwap_screen_id 	= ( isset( $rtwwwap_screen->id ) ) ? $rtwwwap_screen->id : '';

		if( in_array( $rtwwwap_screen_id, $rtwwwap_css_allowed_pages ) ){
			wp_enqueue_style( $this->rtwwwap_plugin_name, plugin_dir_url( __FILE__ ) . 'css/rtwwwap-wp-wc-affiliate-program-admin.css', array(), $this->rtwwwap_version, 'all' );
			//wp_enqueue_style( "select2", plugins_url( 'woocommerce/assets/css/select2.css' ), array(), $this->rtwwwap_version, 'all' );
			wp_enqueue_style( "select2", RTWWWAP_URL. '/assets/Datatables/css/rtwwwap-wp-select2.min.css', array(), $this->rtwwwap_version, 'all' );

			wp_enqueue_style( "datatable", RTWWWAP_URL. '/assets/Datatables/css/jquery.dataTables.min.css', array(), $this->rtwwwap_version, 'all' );
			wp_enqueue_style( "rowReorder", RTWWWAP_URL. '/assets/Datatables/css/rowReorder.dataTables.min.css', array( 'datatable' ), $this->rtwwwap_version, 'all' );
			wp_enqueue_style( "jquery-ui", "https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" );
			wp_enqueue_style( "orgchart", RTWWWAP_URL. '/assets/orgChart/jquery.orgchart.css', array(), $this->rtwwwap_version, 'all' );
			wp_enqueue_style('font-awesome', 'https://pro.fontawesome.com/releases/v5.1.0/css/all.css');
			wp_enqueue_style( 'wp-color-picker' );
			
		}

	}

	/**
	 * Register the JavaScript for the admin area.
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
		$rtwwwap_js_allowed_pages = array(
										'product',
										'edit-product',
										'toplevel_page_rtwwwap',
										'users',
										'user-edit',
										'user',
										'profile',
										'edit-download'
									);

		$rtwwwap_screen 	= function_exists( 'get_current_screen' ) ? get_current_screen() : '';
		$rtwwwap_screen_id 	= ( isset( $rtwwwap_screen->id ) ) ? $rtwwwap_screen->id : '';

		if( in_array( $rtwwwap_screen_id, $rtwwwap_js_allowed_pages ) ){
			
			wp_enqueue_script( "datatable", RTWWWAP_URL. '/assets/Datatables/js/jquery.dataTables.min.js', array( 'jquery' ), $this->rtwwwap_version, false );
			wp_enqueue_script( "rowReorder", RTWWWAP_URL. '/assets/Datatables/js/dataTables.rowReorder.min.js', array( 'jquery', 'datatable' ), $this->rtwwwap_version, false );
			//wp_enqueue_script( "select2", plugins_url( 'woocommerce/assets/js/select2/select2.full.min.js' ), array( 'jquery' ), $this->rtwwwap_version, false );
			wp_enqueue_script( "select2", RTWWWAP_URL. '/assets/Datatables/js/rtwwwap-wp-select2.min.js', array( 'jquery' ), $this->rtwwwap_version, false );

			wp_enqueue_script( 'jquery-ui-dialog', '', array( 'jquery' ), $this->rtwwwap_version, false );
			//wp_enqueue_script( "blockUI", plugins_url( 'woocommerce/assets/js/jquery-blockui/jquery.blockUI.min.js' ), array( 'jquery' ), $this->rtwwwap_version, false );
			wp_enqueue_script( "blockUI", RTWWWAP_URL. '/assets/Datatables/js/rtwwwap-wp-blockui.js', array( 'jquery' ), $this->rtwwwap_version, false );

			wp_register_script( $this->rtwwwap_plugin_name, plugin_dir_url( __FILE__ ) . 'js/rtwwwap-wp-wc-affiliate-program-admin.js', array( 'jquery', 'select2', 'datatable', 'rowReorder' ), $this->rtwwwap_version, false );
			
			

			wp_enqueue_script( "orgchart", RTWWWAP_URL. '/assets/orgChart/jquery.orgchart.js', array( 'jquery' ), $this->rtwwwap_version, false );
			wp_register_script( 'FontAwesome', 'https://use.fontawesome.com/releases/v5.0.2/js/all.js', null, null, true );

			wp_enqueue_script( 'wp-color-picker', admin_url( 'js/color-picker.min.js' ), array( 'iris' ), $this->rtwwwap_version, true );
			$rtwwwap_colorpicker_l10n = array(
		        'clear' 		=> esc_html__( 'Clear' ),
		        'defaultString' => esc_html__( 'Default' ),
		        'pick' 			=> esc_html__( 'Select Color' ),
		        'current' 		=> esc_html__( 'Current Color' )
		    );
		    wp_localize_script( 'wp-color-picker', 'wpColorPickerL10n', $rtwwwap_colorpicker_l10n );

			$rtwwwap_ajax_nonce 		= wp_create_nonce( "rtwwwap-ajax-security-string" );
			$rtwwwap_translation_array 	= array(
												'rtwwwap_ajaxurl' 	=> esc_url( admin_url( 'admin-ajax.php' ) ),
												'rtwwwap_nonce' 	=> $rtwwwap_ajax_nonce,
												'rtwwwap_digit' 	=> esc_html__( 'Digits Only', 'rtwwwap-wp-wc-affiliate-program' ),
												'rtwwwap_bank_det' 	=> esc_html__( 'Details not filled', 'rtwwwap-wp-wc-affiliate-program' ),
												'rtwwwap_bank_sent' => esc_html__( 'Are you sure that you have completed this bank transfer?', 'rtwwwap-wp-wc-affiliate-program' ),
												'rtwwwap_nothing_marked' => esc_html__( 'Nothing Marked', 'rtwwwap-wp-wc-affiliate-program' ),
												'rtwwwap_approval_sure' => esc_html__( 'Are you sure to approve this Referral? It can\'t be reverted back once approved', 'rtwwwap-wp-wc-affiliate-program' ),
												'rtwwwap_approval_sure_all' => esc_html__( 'Are you sure to approve all the Referrals? It can\'t be reverted back once approved', 'rtwwwap-wp-wc-affiliate-program' ),
												'rtwwwap_reject_sure' 		=> esc_html__( 'Are you sure to reject this Referral? It can\'t be reverted back once rejected', 'rtwwwap-wp-wc-affiliate-program' ),
												'rtwwwap_reject_message_blank' 		=> esc_html__( 'Please input some text in message box', 'rtwwwap-wp-wc-affiliate-program' ),
												'rtwwwap_reject_sure_all' 	=> esc_html__( 'Are you sure to reject all the Referrals? It can\'t be reverted back once rejected', 'rtwwwap-wp-wc-affiliate-program' ),
												'rtwwwap_mlm_user_activate' 	=> esc_html__( 'Activate', 'rtwwwap-wp-wc-affiliate-program' ),
												'rtwwwap_mlm_user_deactivate' 	=> esc_html__( 'Deactivate', 'rtwwwap-wp-wc-affiliate-program' )
											
											);
			wp_localize_script( $this->rtwwwap_plugin_name, 'rtwwwap_global_params', $rtwwwap_translation_array );
			wp_enqueue_script( $this->rtwwwap_plugin_name );
			wp_enqueue_script( 'jquery.validate', plugin_dir_url( __FILE__ ) . 'js/jquery.validate/jquery.validate.js', array( 'jquery' ), $this->rtwwwap_version, false );

		}

	}


	/*
	* Function to check purchase
	*/
	function rtwwwap_verify_purchase_code_callback()
	{

		if (!check_ajax_referer( 'rtwwwap-ajax-security-string', 'rtwwwap_security_check' ))
		{
			return;
		}
		$rtwwwap_purchase_code = sanitize_text_field( $_POST['purchase_code'] );

		$rtwwwap_site_url 		= get_site_url();
		$rtwwwap_admin_email 	= get_option('admin_email');
		$wp_get_current_user 	= get_user_meta( get_current_user_id() );

		if( is_array($wp_get_current_user) && !empty( $wp_get_current_user ) )
		{
			if( isset( $wp_get_current_user['first_name'][0]))
			{
				$rtwwwap_admin_name = $wp_get_current_user['first_name'][0] . ' '. $wp_get_current_user['last_name'][0];
			}
		}
		else{
			$wp_get_current_user 	= wp_get_current_user();
			$rtwwwap_admin_name 	= $wp_get_current_user->data->user_nicename;
		}
		$rtwwwap_plugin_name 	= 'WordPress & WooCommerce Affiliate Program';
		$plugin_text_domain 	= 'rtwwwap-wp-wc-affiliate-program';
		$rtwwwap_site_domain 	= preg_replace( "(^https?://)", "", $rtwwwap_site_url );


		$rtwwwap_post_array = array(
								'site_domain' => $rtwwwap_site_domain,
								'admin_email' => $rtwwwap_admin_email,
								'admin_name' => $rtwwwap_admin_name,
								'plugin_name' => $rtwwwap_plugin_name,
								'text_domain' => $plugin_text_domain,
								'purchase_code' => $rtwwwap_purchase_code,
								'plugin_id' => 23580333
							);

		$args = array(
						'method' => 'POST',
						'headers'  => array(
								'Content-type: application/x-www-form-urlencoded'
						),
						'sslverify' => false,
						'body' => $rtwwwap_post_array
				);

		$response = wp_remote_post( 'https://demo.redefiningtheweb.com/license-verification/license-verification.php', $args );


		$response_body = json_decode( $response['body'] );
		$response_status = $response_body->result;
		$response_message = $response_body->message;

		if( $response_status ){
			$rtwwwap_update_array = array( 'purchase_code' => $rtwwwap_purchase_code,
			'status' => true );

			update_option( 'rtwwwap_verification_done', $rtwwwap_update_array );

			$rtwwwap_result = array( 'status' => true,
								'message' => $response_message );

			echo json_encode( $rtwwwap_result );
			die;
		}else{
			$rtwwwap_result = array( 'status' => false,
								'message' => $response_message );

			echo json_encode( $rtwwwap_result );
			die;
		}
	}

	/*
	* Function to remove purchase code
	*/

	function rtwwwap_delete_purchase_code()
	{
		$rtwwwap_site_url 		= get_site_url();
		$rtwwwap_admin_email 	= get_option('admin_email');
		$wp_get_current_user 	= get_user_meta( get_current_user_id() );

		if( is_array($wp_get_current_user) && !empty( $wp_get_current_user ) )
		{
			if( isset( $wp_get_current_user['first_name'][0]))
			{
				$rtwwwap_admin_name = $wp_get_current_user['first_name'][0] . ' '. $wp_get_current_user['last_name'][0];
			}
		}
		else{
			$wp_get_current_user 	= wp_get_current_user();
			$rtwwwap_admin_name 	= $wp_get_current_user->data->user_nicename;
		}
		$rtwwwap_plugin_name 	= 'WordPress & WooCommerce Affiliate Program';
		$plugin_text_domain 	= 'rtwwwap-wp-wc-affiliate-program';
		$rtwwwap_site_domain 	= preg_replace( "(^https?://)", "", $rtwwwap_site_url );
		$rtwwwap_purchase_code = get_option( 'rtwwwap_verification_done', array() );

		$rtwwwap_post_array = array(
								'site_domain' => $rtwwwap_site_domain,
								'admin_email' => $rtwwwap_admin_email,
								'admin_name' => $rtwwwap_admin_name,
								'plugin_name' => $rtwwwap_plugin_name,
								'text_domain' => $plugin_text_domain,
								'purchase_code' => $rtwwwap_purchase_code['purchase_code'],
								'plugin_id' => 23580333
							);

		$args = array(
						'method' => 'POST',
						'headers'  => array(
								'Content-type: application/x-www-form-urlencoded'
						),
						'sslverify' => false,
						'body' => $rtwwwap_post_array
				);

		$response = wp_remote_post( 'https://demo.redefiningtheweb.com/license-verification/license-remove.php', $args );
		delete_option('rtwwwap_verification_done');
		wp_redirect( esc_url( admin_url( 'admin.php?page=rtwwwap&rtwwwap_tab=rtwwwap_dashboard' ) ) );
		exit;
	}


	/*
	* Function to show settings link
	*/
	function rtwwwap_add_setting_links( $rtwwwap_links ){
		$rtwwwap_links[] = '<a href="' . admin_url( 'admin.php?page=rtwwwap' ) . '">'.esc_html__( 'Settings', 'rtwwwap-wp-wc-affiliate-program' ).'</a>';
		return $rtwwwap_links;
	}

	/*
	* Function to add submenu in WooCommerce menu tab
	*/
	function rtwwwap_add_submenu()
	{
		$rtwwwap_menu_position = '80';
		add_menu_page( esc_html__( 'WordPress & WooCommerce Affiliate Program', 'rtwwwap-wp-wc-affiliate-program' ), esc_html__( 'WP & WC Affiliate Program', 'rtwwwap-wp-wc-affiliate-program' ), 'manage_options', 'rtwwwap', array( $this, 'rtwwwap_admin_setting' ), RTWWWAP_URL.'assets/images/affiliate-menu-icon.png', $rtwwwap_menu_position );
	}

	/*
	* Function for display settings page
	*/
	function rtwwwap_admin_setting()
	{
		$rtwwwap_verification_done = get_option( 'rtwwwap_verification_done', array() );
		if( !empty( $rtwwwap_verification_done ) && $rtwwwap_verification_done['status'] == true && !empty($rtwwwap_verification_done['purchase_code']) )
		{
			include_once( RTWWWAP_DIR.'admin/partials/rtwwwap-wp-wc-affiliate-program-admin-display.php');
		}
		else
		{
			include_once( RTWWWAP_DIR.'admin/partials/rtwwwap_tabs/rtwwwap-wp-wc-affiliate-program-admin.php');
		}
	}

	/*
	* Function to register settings
	*/
	function rtwwwap_settings_init()
	{
		register_setting( 'rtwwwap_commission_settings', 'rtwwwap_commission_settings_opt', array( $this, 'rtwwwap_save_comm' ) );
		register_setting( 'rtwwwap_extra_features', 'rtwwwap_extra_features_opt', array( $this, 'rtwwwap_save_extra' ) );
		register_setting( 'rtwwwap_levels_settings', 'rtwwwap_levels_settings_opt', array( $this, 'rtwwwap_save_level' ) );
		register_setting( 'rtwwwap_mlm', 'rtwwwap_mlm_opt', array( $this, 'rtwwwap_save_mlm' ) );
		register_setting( 'rtwwwap_reg_temp', 'rtwwwap_reg_temp_opt' );
	}

	/*
	* Function to save commission settings
	*/
	function rtwwwap_save_comm( $rtwwwap_option )
	{
		$rtwwwap_option[ 'per_cat' ] = array();
		$i = 0;

		while( isset( $rtwwwap_option[ "per_cat_$i" ] ) )
		{
			$rtwwwap_perc_comm 	= $rtwwwap_option[ "per_cat_$i" ][ 'cat_percentage_commission' ];
			$rtwwwap_fix_comm 	= $rtwwwap_option[ "per_cat_$i" ][ 'cat_fixed_commission' ];

			unset( $rtwwwap_option[ "per_cat_$i" ][ 'cat_percentage_commission' ] );
			unset( $rtwwwap_option[ "per_cat_$i" ][ 'cat_fixed_commission' ] );

			$rtwwwap_ids = $rtwwwap_option[ "per_cat_$i" ];
			unset( $rtwwwap_option[ "per_cat_$i" ] );

			$rtwwwap_option[ "per_cat" ][ $i ] = array(
													'ids' 						=> $rtwwwap_ids,
													'cat_percentage_commission' => $rtwwwap_perc_comm,
													'cat_fixed_commission' 		=> $rtwwwap_fix_comm,
												);

			$i++;
		}

		return $rtwwwap_option;
	}

	/*
	* Function to update mlm settings
	*/
	function rtwwwap_save_mlm( $rtwwwap_option )
	{
		unset( $rtwwwap_option[ 'mlm_levels' ][ 'mlm_level_comm_type' ] );
		unset( $rtwwwap_option[ 'mlm_levels' ][ 'mlm_level_comm_amount' ] );

		return $rtwwwap_option;
	}

	/*
	* Function to save extra settings
	*/
	function rtwwwap_save_extra( $rtwwwap_option )
	{
		// to add affiliate page id in options table
		$rtwwwap_aff_page_id = $rtwwwap_option['page'];
		$rtwwwap_login_page_id = $rtwwwap_option['login_page_id'];
		$rtwwwap_register_page_id = $rtwwwap_option['register_page_id'];

		if( $rtwwwap_aff_page_id ){
			update_option( 'rtwwwap_affiliate_page_id', $rtwwwap_aff_page_id );
		}
			update_option( 'rtwwwap_login_page_id', $rtwwwap_login_page_id );
			update_option( 'rtwwwap_register_page_id', $rtwwwap_register_page_id );
		

		unset( $rtwwwap_option['page'] );
		unset( $rtwwwap_option['rtwwwap_login_page_id']);
		unset( $rtwwwap_option['rtwwwap_register_page_id'] );


		unset( $rtwwwap_option['performance_bonus'][0] );
		$rtwwwap_perf_arr = array();
		if( !empty( $rtwwwap_option['performance_bonus'] ) ){
			$rtwwwap_option['performance_bonus'] = array_values( $rtwwwap_option['performance_bonus'] );
			foreach( $rtwwwap_option['performance_bonus'] as $rtwwwap_key => $rtwwwap_value ){
				if( !array_key_exists( $rtwwwap_value['sale_amount'], $rtwwwap_perf_arr ) ){
					$rtwwwap_perf_arr[ $rtwwwap_value['sale_amount'] ] = $rtwwwap_value['incentive'];
				}
				else{
					if( $rtwwwap_perf_arr[ $rtwwwap_value['sale_amount'] ] < $rtwwwap_value[ 'incentive' ] ){
						$rtwwwap_perf_arr[ $rtwwwap_value['sale_amount'] ] = $rtwwwap_value['incentive'];
					}
				}
			}
			ksort( $rtwwwap_perf_arr );
		}
		$rtwwwap_option['performance_bonus'] = $rtwwwap_perf_arr;
		if(sanitize_text_field($_POST['rtwwwap_prev_decimal_place']) != $rtwwwap_option['decimal_places'])
		{
			global $wpdb;
			$rtwwwap_decimal = (int)$rtwwwap_option['decimal_places'];
			$table_name_referral = $wpdb->prefix . 'rtwwwap_referrals';
			$rtwwwap_sql = "ALTER TABLE $table_name_referral MODIFY amount decimal(12, $rtwwwap_decimal)";
			$wpdb->query($rtwwwap_sql);
		}
		return $rtwwwap_option;
	}

	/*
	* Function to update level settings
	*/
	function rtwwwap_save_level( $rtwwwap_option )
	{
		$rtwwwap_level_arr = array();
		if( !empty( $rtwwwap_option ) ){
			$rtwwwap_levels_settings = get_option( 'rtwwwap_levels_settings_opt' );
			$rtwwwap_type = $rtwwwap_option['rtwwwap_level'];

			if( $rtwwwap_type ){
				$rtwwwap_level_id = $rtwwwap_option['level_id'];
				unset( $rtwwwap_option['rtwwwap_level'] );
				unset( $rtwwwap_option['level_id'] );

				if( !isset( $rtwwwap_option[ 'level_criteria_val' ] ) ){
					$rtwwwap_option[ 'level_criteria_val' ] = 0;
				}
				if( $rtwwwap_type == 'add' )
				{
					if( !empty( $rtwwwap_levels_settings ) )
					{
						$rtwwwap_levels_settings[] = $rtwwwap_option;
						$rtwwwap_level_arr = $rtwwwap_levels_settings;
					}
					else
					{
						$rtwwwap_level_arr[] = $rtwwwap_option;
					}
				}
				elseif( $rtwwwap_type == 'edit' )
				{
					$rtwwwap_levels_settings[$rtwwwap_level_id] = $rtwwwap_option;
					$rtwwwap_level_arr = $rtwwwap_levels_settings;
				}
			}
			else{
				$rtwwwap_level_arr = $rtwwwap_option;
			}
		}

		return $rtwwwap_level_arr;
	}

	/*
	* Function to update thead of users table
	*/
	function rtwwwap_add_affiliate_column( $rtwwwap_columns )
	{
		if( current_user_can( 'manage_options' ) ){
			$rtwwwap_columns[ 'rtwwwap_affiliate' ] = esc_attr__( 'Affiliate', 'rtwwwap-wp-wc-affiliate-program' );
			$rtwwwap_commission_settings 	= get_option( 'rtwwwap_commission_settings_opt' );
			$rtwwwap_comm_base 				= isset( $rtwwwap_commission_settings[ 'comm_base' ] ) ? $rtwwwap_commission_settings[ 'comm_base' ] : '1';

			if( $rtwwwap_comm_base == 2 ){
				$rtwwwap_levels_settings = get_option( 'rtwwwap_levels_settings_opt' );
				if( !empty( $rtwwwap_levels_settings ) ){
					$rtwwwap_columns[ 'rtwwwap_affiliate_level' ] = esc_attr__( 'Affiliate Level', 'rtwwwap-wp-wc-affiliate-program' );
				}
			}
		}
		return $rtwwwap_columns;
	}

	/*
	* Function to update tbody of users table
	*/
	function rtwwwap_manage_affiliate_column( $rtwwwap_empty = '', $rtwwwap_column, $rtwwwap_user_id )
	{

		$rtwwwap_user_aff = get_user_meta( $rtwwwap_user_id, 'rtwwwap_affiliate', true );
		
		if( $rtwwwap_column == 'rtwwwap_affiliate' ){

			if (RTWWWAP_IS_WOO == 1)
			{
				$rtwwwap_check_col = woocommerce_form_field('rtwwwap_affiliate', array(
						'type'          	=> 'checkbox',
						'input_class'       => array( 'rtwwwap_affiliate_checkbox'),
						'custom_attributes' => array( 'data-rtwwwap-num' => $rtwwwap_user_id ),
						'required' 			=> false,
						'return' 			=> true
					),get_user_meta( $rtwwwap_user_id, 'rtwwwap_affiliate', true ));
			}	
			if (RTWWWAP_IS_Easy == 1)
			{
				$rtwwwap_check_col='';
				$rtwwwap_check_col .= "<p class='form-row' data-priority=''>";
				$rtwwwap_check_col .= "<span>";
				$rtwwwap_check_col .= "<label class='checkbox' data-rtwwwap-num='$rtwwwap_user_id'>";
				if($rtwwwap_user_aff == 1)
				{
				$rtwwwap_check_col .= "<input type='checkbox' class='input-checkbox rtwwwap_affiliate_checkbox' name='rtwwwap_affiliate' id='rtwwwap_affiliate' value='.$rtwwwap_user_aff.' checked >";
				}else
				{
					$rtwwwap_check_col .= "<input type='checkbox' class='input-checkbox rtwwwap_affiliate_checkbox' name='rtwwwap_affiliate' id='rtwwwap_affiliate' value='.$rtwwwap_user_aff.' unchecked >";	
				}
				
				$rtwwwap_check_col .= "<span class='optional'>(optional)</span>";
				$rtwwwap_check_col .= "</label>";
				$rtwwwap_check_col .= "</span>";
				$rtwwwap_check_col .= "</p>";
			}	
		
			return $rtwwwap_check_col;
			
		}

		if( $rtwwwap_column == 'rtwwwap_affiliate_level' ){
			$rtwwwap_levels_settings = get_option( 'rtwwwap_levels_settings_opt' );
			$rtwwwap_aff_levels = ( !empty( $rtwwwap_levels_settings ) ) ? array_combine( array_keys( $rtwwwap_levels_settings ), array_column( $rtwwwap_levels_settings, 'level_name' ) ): array();

			$rtwwwap_input_class = array( 'rtwwwap_affiliate_level_select' );

			if( !$rtwwwap_user_aff ){
				$rtwwwap_input_class[] = 'rtwwwap_aff_level_hidden';
			}
			if (RTWWWAP_IS_WOO == 1)
			{
			$rtwwwap_level_col = woocommerce_form_field( 'rtwwwap_affiliate_level', array(
					'type'          	=> 'select',
					'input_class'       => $rtwwwap_input_class,
					'custom_attributes' => array( 'data-rtwwwap-num' => $rtwwwap_user_id ),
					'required' 			=> false,
					'return' 			=> true,
					'options' 			=> $rtwwwap_aff_levels
				), get_user_meta( $rtwwwap_user_id, 'rtwwwap_affiliate_level', true ) );
			}
			if (RTWWWAP_IS_Easy == 1)
			{
				$rtwwap_user_aff_level = get_user_meta( $rtwwwap_user_id, 'rtwwwap_affiliate_level', true );
				$rtwwwap_level_col = '';
				$rtwwwap_level_col .= "<p class='form-row'  data-priority=''>";
				$rtwwwap_level_col .= "<span >";
				$rtwwwap_level_col .= "<select name='rtwwwap_affiliate_level' id='rtwwwap_affiliate_level' class='select rtwwwap_affiliate_level_select' data-rtwwwap-num='$rtwwwap_user_id' data-placeholder=''> ";
				foreach($rtwwwap_aff_levels as $key=>$value)
				{
			     	if($key == $rtwwap_user_aff_level)
					{
						$rtwwwap_level_col .= '<option value="'.$key.'" selected="selected">'.$value.'</option>'; 
					}
					else{
						$rtwwwap_level_col .= '<option value="'.$key.'">'.$value.'</option>'; 
					}

				}
				$rtwwwap_level_col .= "</select>";
				$rtwwwap_level_col .= "</span>";
				$rtwwwap_level_col .= "</p>";
				
			
				
			}





			return $rtwwwap_level_col;
		}

		return $rtwwwap_empty;
	}

	/**
	 * This function is for changing the user to affiliate and vice-versa
	 */
	function rtwwwap_change_affiliate_callback()
	{
		$rtwwwap_check_ajax = check_ajax_referer( 'rtwwwap-ajax-security-string', 'rtwwwap_security_check' );

		if ( $rtwwwap_check_ajax ) {
			if( current_user_can( 'manage_options' ) )
			{
				$rtwwwap_user_id 	= sanitize_text_field( $_POST[ 'rtwwwap_user_id' ] );
				$rtwwwap_value 		= sanitize_text_field( $_POST[ 'rtwwwap_value' ] );
				$rtwwwap_updated 	= update_user_meta( $rtwwwap_user_id, 'rtwwwap_affiliate', $rtwwwap_value );
				update_user_meta( $rtwwwap_user_id, 'rtwwwap_aff_approved', $rtwwwap_value );

				if( $rtwwwap_updated && $rtwwwap_value ){
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

					$rtwwwap_message = esc_html__( 'This user is an affiliate now', 'rtwwwap-wp-wc-affiliate-program' );
				}
				if( $rtwwwap_updated && !$rtwwwap_value ){
					$rtwwwap_message = esc_html__( 'This user is not an affiliate now', 'rtwwwap-wp-wc-affiliate-program' );
				}

				echo json_encode( array( 'rtwwwap_status' => $rtwwwap_updated, 'rtwwwap_message' => $rtwwwap_message ) );
				die;
			}
		}
	}


	/**
	 * This function is for changing the user to affiliate and vice-versa
	 */
	function rtwwwap_add_manual_referral()
	{
		$rtwwwap_check_ajax = check_ajax_referer( 'rtwwwap-ajax-security-string', 'rtwwwap_security_check' );

		if ( $rtwwwap_check_ajax ) {
			if( current_user_can( 'manage_options' ) )
			{
				$rtwwwap_aff_id 	= sanitize_text_field( $_POST[ 'rtwwwap_aff_id' ] );
				if(empty($rtwwwap_aff_id))
				{
					echo json_encode(array('rtwwwap_status' => false, 'rtwwwap_message' => esc_html__('Please Select Affiliate', 'rtwwwap-wp-wc-affiliate-program')));
					wp_die();
				}
				$rtwwwap_aff_manual_ref 		= sanitize_text_field( $_POST[ 'rtwwwap_aff_manual_ref' ] );
				if(empty($rtwwwap_aff_manual_ref))
				{
					echo json_encode(array('rtwwwap_status' => false, 'rtwwwap_message' => esc_html__('Please Select Reference', 'rtwwwap-wp-wc-affiliate-program')));
					wp_die();
				}
				$rtwwwap_aff_manual_amnt 		= sanitize_text_field( $_POST[ 'rtwwwap_aff_manual_amnt' ] );
				if(empty($rtwwwap_aff_manual_amnt))
				{
					echo json_encode(array('rtwwwap_status' => false, 'rtwwwap_message' => esc_html__('Please Enter Referral Amount', 'rtwwwap-wp-wc-affiliate-program')));
					wp_die();
				}
				$rtwwwap_manual_aff_status 		= sanitize_text_field( $_POST[ 'rtwwwap_manual_aff_status' ] );
				if(empty($rtwwwap_manual_aff_status) && $rtwwwap_manual_aff_status != 0)
				{
					echo json_encode(array('rtwwwap_status' => false, 'rtwwwap_message' => esc_html__('Please Select Status', 'rtwwwap-wp-wc-affiliate-program')));
					wp_die();
				}
				if( RTWWWAP_IS_WOO == 1 ){
					$rtwwwap_currency_sym = get_woocommerce_currency();
				}
				else{
					require_once( RTWWWAP_DIR.'includes/rtwaffiliatehelper.php' );

					$rtwwwap_extra_features = get_option( 'rtwwwap_extra_features_opt' );
					$rtwwwap_currency 		= isset( $rtwwwap_extra_features[ 'currency' ] ) ? $rtwwwap_extra_features[ 'currency' ] : 'USD';
				}
				$rtwwwap_currency_sym 	= esc_html( $rtwwwap_currency );
				global $wpdb;
				$rtwwwap_updated = $wpdb->insert(
						$wpdb->prefix.'rtwwwap_referrals',
						array(
								'aff_id'    		=> $rtwwwap_aff_id,
								'type'    			=> 6,
								'order_id'    		=> 0,
								'date'    			=> date( 'Y-m-d H:i:s' ),
								'status'    		=> $rtwwwap_manual_aff_status,
								'amount'    		=> esc_html( $rtwwwap_aff_manual_amnt ),
								'capped'    		=> 0,
								'currency'    		=> $rtwwwap_currency_sym,
								'product_details'   => '',
								'device'   			=> ''
						)
				);

				if( $rtwwwap_updated ){
					echo json_encode( array( 'rtwwwap_status' => true, 'rtwwwap_message' =>  esc_html__('Manual Referral Added Successfully', 'rtwwwap-wp-wc-affiliate-program')) );
					wp_die();
				}
				else
				{
					echo json_encode( array( 'rtwwwap_status' => false, 'rtwwwap_message' =>  esc_html__('Something Went Wrong', 'rtwwwap-wp-wc-affiliate-program')) );
					wp_die();
				}
			}
		}
	}


	/**
	 * This function is for changing the user to affiliate level
	 */
	function rtwwwap_change_affiliate_level_callback()
	{
		$rtwwwap_check_ajax = check_ajax_referer( 'rtwwwap-ajax-security-string', 'rtwwwap_security_check' );

		if ( $rtwwwap_check_ajax ) {
			if( current_user_can( 'manage_options' ) )
			{
				$rtwwwap_user_id 	= sanitize_text_field( $_POST[ 'rtwwwap_user_id' ] );
				$rtwwwap_value 		= sanitize_text_field( $_POST[ 'rtwwwap_value' ] );
				$rtwwwap_updated 	= update_user_meta( $rtwwwap_user_id, 'rtwwwap_affiliate_level', $rtwwwap_value );

				if( $rtwwwap_updated ){
					$rtwwwap_message = esc_html__( 'Affiliate level changed', 'rtwwwap-wp-wc-affiliate-program' );
				}
				else{
					$rtwwwap_message = esc_html__( 'Something went wrong', 'rtwwwap-wp-wc-affiliate-program' );
				}

				echo json_encode( array( 'rtwwwap_status' => $rtwwwap_updated, 'rtwwwap_message' => $rtwwwap_message ) );
				die;
			}
		}
	}

	/*
	* Function to add make affiliate field while adding new user
	*/
	function rtwwwap_custom_user_profile_fields_add(){ ?>
		<h3><?php esc_html_e( "WordPress & WooCommerce Affiliate Program", 'rtwwwap-wp-wc-affiliate-program' ); ?></h3>
	    <table class="form-table">
	        <tr>
	            <th><label for="rtwwwap_affiliate"><?php esc_html_e( "Become Affiliate", 'rtwwwap-wp-wc-affiliate-program' ); ?></label></th>
	            <td>
	                <input type="checkbox" class="rtwwwap_add_user_affiliate" name="rtwwwap_add_affiliate_checkbox" id="rtwwwap_add_user_affiliate" />
	                <span class="description"><?php esc_html_e( "This will make this user also as an Affiliate", 'rtwwwap-wp-wc-affiliate-program' ); ?></span>
	            </td>
	        </tr>
	        <?php
		        $rtwwwap_commission_settings = get_option( 'rtwwwap_commission_settings_opt' );
				$rtwwwap_comm_base = isset( $rtwwwap_commission_settings[ 'comm_base' ] ) ? $rtwwwap_commission_settings[ 'comm_base' ] : '1';
				if( $rtwwwap_comm_base == 2 ){
					$rtwwwap_levels_settings = get_option( 'rtwwwap_levels_settings_opt' );
					if( !empty( $rtwwwap_levels_settings ) ){
			?>
				        <tr class="rtwwwap_new_user_level">
				            <th><label for="rtwwwap_affiliate"><?php esc_html_e( "Affiliate Level", 'rtwwwap-wp-wc-affiliate-program' ); ?></label></th>
				            <td>
				                <select class="rtwwwap_select2_user_level" id="" name="rtwwwap_affiliate_level" >
				                	<?php
				                		foreach( $rtwwwap_levels_settings as $rtwwwap_key => $rtwwwap_value ){
				                	?>
										<option value="<?php echo esc_attr($rtwwwap_key); ?>" >
											<?php echo esc_html( $rtwwwap_value[ 'level_name' ] ); ?>
										</option>
									<?php
				                		}
				                	?>
								</select>
				            </td>
				        </tr>
			<?php
					}
				}
			?>
	    </table>
	<?php
	}

	/*
	* Function to save make affiliate field while adding new user
	*/
	function rtwwwap_save_custom_user_profile_fields_add( $rtwwwap_user_id ){

		if( !current_user_can( 'manage_options' ) ){
	        return false;
		}
		$rtwwwap_value = ( sanitize_text_field( $_POST[ 'rtwwwap_add_affiliate_checkbox' ] ) == 'on' ) ? 1 : 0;
	    update_user_meta( $rtwwwap_user_id, 'rtwwwap_affiliate', $rtwwwap_value );
	    update_user_meta( $rtwwwap_user_id, 'rtwwwap_aff_approved', $rtwwwap_value );

	    if( $rtwwwap_value == 1 && isset( $_POST[ 'rtwwwap_affiliate_level' ] ) ){
		    $rtwwwap_aff_level = $_POST[ 'rtwwwap_affiliate_level' ];
		    update_user_meta( $rtwwwap_user_id, 'rtwwwap_affiliate_level', $rtwwwap_aff_level );
		}
	}

	/**
	 * Function to add make affiliate field while editing user
	 */
	function rtwwwap_custom_user_profile_fields_edit( $rtwwwap_profileuser ) {
		if( current_user_can( 'manage_options' ) ){
			$rtwwwap_user_meta_affiliate 	= get_user_meta( $rtwwwap_profileuser->ID, 'rtwwwap_affiliate', true );
	?>
			<h3><?php esc_html_e( "WordPress & WooCommerce Affiliate Program", 'rtwwwap-wp-wc-affiliate-program' ); ?></h3>
		    <table class="form-table">
		        <tr>
		            <th><label for="rtwwwap_affiliate"><?php esc_html_e( "Become Affiliate", 'rtwwwap-wp-wc-affiliate-program' ); ?></label></th>
		            <td>
		                <input type="checkbox" class="rtwwwap_edit_user_affiliate" name="rtwwwap_add_affiliate_checkbox" <?php checked( $rtwwwap_user_meta_affiliate, 1 ); ?> id="rtwwwap_edit_user_affiliate" />
		                <span class="description"><?php esc_html_e( "This will make this user also as an Affiliate", 'rtwwwap-wp-wc-affiliate-program' ); ?></span>
		            </td>
		        </tr>
		        <?php
			        $rtwwwap_commission_settings = get_option( 'rtwwwap_commission_settings_opt' );
					$rtwwwap_comm_base = isset( $rtwwwap_commission_settings[ 'comm_base' ] ) ? $rtwwwap_commission_settings[ 'comm_base' ] : '1';
					if( $rtwwwap_comm_base == 2 ){
						$rtwwwap_levels_settings = get_option( 'rtwwwap_levels_settings_opt' );
						if( !empty( $rtwwwap_levels_settings ) ){
							$rtwwwap_user_affiliate_level = get_user_meta( $rtwwwap_profileuser->ID, 'rtwwwap_affiliate_level', true );
		        ?>
					        <tr class="<?php echo ( $rtwwwap_user_meta_affiliate ) ? 'rtwwwap_edit_user_show' : ''; ?> rtwwwap_edit_user_level">
					            <th><label for="rtwwwap_affiliate"><?php esc_html_e( "Affiliate Level", 'rtwwwap-wp-wc-affiliate-program' ); ?></label></th>
					            <td>
					                <select class="rtwwwap_select2_user_level" id="" name="rtwwwap_affiliate_level" >
					                	<?php
					                		foreach( $rtwwwap_levels_settings as $rtwwwap_key => $rtwwwap_value ){
					                	?>
											<option value="<?php echo esc_attr($rtwwwap_key); ?>" <?php selected( $rtwwwap_key, $rtwwwap_user_affiliate_level ); ?> >
												<?php echo esc_html( $rtwwwap_value[ 'level_name' ] ); ?>
											</option>
										<?php
					                		}
					                	?>
									</select>
					            </td>
					        </tr>
			    <?php
			    		}
					}
			    ?>

			    <?php
			    	if( $rtwwwap_user_meta_affiliate ){
				    	$rtwwwap_mlm = get_option( 'rtwwwap_mlm_opt' );
				    	$rtwwwap_mlm_activated = isset( $rtwwwap_mlm[ 'activate' ] ) ? $rtwwwap_mlm[ 'activate' ] : 0;

				    	if( $rtwwwap_mlm_activated ){
				    		$rtwwwap_mlm_type_selected = isset( $rtwwwap_mlm[ 'mlm_type' ] ) ? $rtwwwap_mlm[ 'mlm_type' ] : 0;
			    ?>
				    		<tr class="">
					            <th><label for="rtwwwap_affiliate"><?php esc_html_e( "MLM Chain", 'rtwwwap-wp-wc-affiliate-program' ); ?></label></th>
					            <td>
					            	<span id="rtwwwap_show_mlm_chain" data-user_id="<?php echo $rtwwwap_profileuser->ID; ?>">
								    	<?php
								    		esc_html_e( "Show MLM chain", 'rtwwwap-wp-wc-affiliate-program' );
								    		echo ' ( ';
									    	if( $rtwwwap_mlm_type_selected == 0 ){
									    		esc_html_e( 'Binary Plan', 'rtwwwap-wp-wc-affiliate-program' );
									    	}
									    	elseif( $rtwwwap_mlm_type_selected == 1 ){
									    		esc_html_e( 'Forced Matrix Plan', 'rtwwwap-wp-wc-affiliate-program' );
									    	}
									    	elseif( $rtwwwap_mlm_type_selected == 2 ){
									    		esc_html_e( 'Unilevel Plan', 'rtwwwap-wp-wc-affiliate-program' );
									    	}
									    	echo ' )';
									    ?>
								    </span>
								    <input type="checkbox" id="rtwwwap_show_active_only" disabled="disabled" />
					    			<label for="rtwwwap_checkbox_active_mlm">
					    				<?php esc_html_e( "Show In-Active members also", 'rtwwwap-wp-wc-affiliate-program' ); ?>

					    			</label>
					    			<p class="rtwwwap_mlm_chain_not">
					    				<?php
					    					esc_html_e( "MLM chain is not proper, activate/ deactivate the members to make the chain according to your MLM plan. Once done reload the page to see the updated MLM chain.", 'rtwwwap-wp-wc-affiliate-program' );
					    				?>
					    			</p>
					            </td>
					        </tr>
				<?php
						}
			    	}
			    ?>
		    </table>
			<div id="rtwwwap_mlm_chain_struct"></div>
			<div id="rtwwwap_mlm_show"></div>
	<?php
		}
	}

	/*
	* Function to save custom field of edit user page
	*/
	function rtwwwap_save_custom_user_profile_fields_edit( $rtwwwap_user_id ) {
		if ( !current_user_can( 'manage_options' ) ){
			return FALSE;
		}

		$rtwwwap_value = ( $_POST[ 'rtwwwap_add_affiliate_checkbox' ] == 'on' ) ? 1 : 0;
	    update_user_meta( $rtwwwap_user_id, 'rtwwwap_affiliate', $rtwwwap_value );
	    update_user_meta( $rtwwwap_user_id, 'rtwwwap_aff_approved', $rtwwwap_value );

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

	    if( isset( $_POST[ 'rtwwwap_affiliate_level' ] ) ){
		    $rtwwwap_aff_level = $_POST[ 'rtwwwap_affiliate_level' ];
		    update_user_meta( $rtwwwap_user_id, 'rtwwwap_affiliate_level', $rtwwwap_aff_level );
		}
	}

	/*
	* Function to update thead of products table
	*/
	function rtwwwap_add_commission_column( $rtwwwap_columns)
	{


		if( current_user_can( 'manage_options' ) ){
			$rtwwwap_commission_settings 	= get_option( 'rtwwwap_commission_settings_opt' );
			$rtwwwap_comm_base 				= isset( $rtwwwap_commission_settings[ 'comm_base' ] ) ? $rtwwwap_commission_settings
			[ 'comm_base' ] : '1';
			
			if( $rtwwwap_comm_base == 1 ){
				$rtwwwap_commission_settings = isset( $rtwwwap_commission_settings[ 'per_prod_mode' ] ) ? $rtwwwap_commission_settings[ 'per_prod_mode' ] : 0;

				if( $rtwwwap_commission_settings == 1 ){
					$rtwwwap_columns = array_merge( $rtwwwap_columns, array( 'rtwwwap_prod_perc_commission' => esc_html__( 'Percentage Commission', 'rtwwwap-wp-wc-affiliate-program' ) ) );
					
				}
				elseif( $rtwwwap_commission_settings == 2 ){
					$rtwwwap_columns = array_merge( $rtwwwap_columns, array( 'rtwwwap_prod_fix_commission' => esc_html__( 'Fixed Commission', 'rtwwwap-wp-wc-affiliate-program' ) ) );
				}
				elseif( $rtwwwap_commission_settings == 3 ){
					$rtwwwap_columns = array_merge( $rtwwwap_columns, array( 'rtwwwap_prod_perc_commission' => esc_html__( 'Percentage Commission', 'rtwwwap-wp-wc-affiliate-program' ) ) );
					$rtwwwap_columns = array_merge( $rtwwwap_columns, array( 'rtwwwap_prod_fix_commission' => esc_html__( 'Fixed Commission', 'rtwwwap-wp-wc-affiliate-program' ) ) );;
				}
			}
		}

		return $rtwwwap_columns;
	}

	/*
	* Function to update tbody of products table
	*/
	function rtwwwap_manage_commission_column( $rtwwwap_column, $rtwwwap_post_id )
	{	
	 	$rtwwwap_post_type = get_post_type( $rtwwwap_post_id);
	
		$rtwwwap_perc_col = '' ;
		$rtwwwap_fix_col = '' ;
		if( $rtwwwap_column == 'rtwwwap_prod_perc_commission' && current_user_can( 'edit_posts' ) && ($rtwwwap_post_type == 'download' || 'product')){


				$rtwwwap_post_meta = get_post_meta( $rtwwwap_post_id, 'rtwwwap_percentage_commission_box', true );
				
				$rtwwwap_perc_col .= "<p class='form-row ' id='rtwwwap_prod_perc_commission_field' data-priority=''>";
				$rtwwwap_perc_col .=  "<span >";
				$rtwwwap_perc_col .=  "<input type='text' class='input-text rtwwwap_perc_commission_box commission_field_width' name='rtwwwap_prod_perc_commission' id='rtwwwap_prod_perc_commission' placeholder='Percentage ' value='$rtwwwap_post_meta' data-rtwwwap-num='$rtwwwap_post_id' max='99' style='
				width: 105px;'>" ;
				$rtwwwap_perc_col .= "</span>";
				$rtwwwap_perc_col .= "</p>";

			}
			echo  $rtwwwap_perc_col;
			
	
		if( $rtwwwap_column == 'rtwwwap_prod_fix_commission' && current_user_can( 'edit_posts' ) && ($rtwwwap_post_type == 'download' || 'product') ){
			
				$rtwwwap_post_meta = get_post_meta( $rtwwwap_post_id, 'rtwwwap_fixed_commission_box', true );
			
	
				$rtwwwap_fix_col .= "<p class='form-row ' id='rtwwwap_prod_fix_commission_field' data-priority=''>";
				$rtwwwap_fix_col .=  "<span >";
				$rtwwwap_fix_col .=  "<input type='number' class='input-text rtwwwap_fix_commission_box ' name='rtwwwap_prod_fix_commission' id='rtwwwap_fixed_commission_box' placeholder='Fixed ' value='$rtwwwap_post_meta' data-rtwwwap-num='$rtwwwap_post_id'max='99' style='
				width: 80px;'>" ;
				$rtwwwap_fix_col .= "</span>";
				$rtwwwap_fix_col .= "</p>";
			
				
			}
			
			echo $rtwwwap_fix_col;
		
	
	


		return $rtwwwap_column;
	}

	/**
	 * This function is for changing the product commission
	 */
	function rtwwwap_change_prod_commission_callback()
	{
		$rtwwwap_check_ajax = check_ajax_referer( 'rtwwwap-ajax-security-string', 'rtwwwap_security_check' );

		if ( $rtwwwap_check_ajax ) {
			if( current_user_can( 'edit_posts' ) )
			{
				
				$rtwwwap_post_id 	= sanitize_text_field( $_POST[ 'rtwwwap_post_id' ] );
				$rtwwwap_value 		= sanitize_text_field( $_POST[ 'rtwwwap_value' ] );
				
				if( sanitize_text_field( $_POST[ 'rtwwwap_type' ] ) == 'perc_comm' ){
					$rtwwwap_updated = update_post_meta( $rtwwwap_post_id, 'rtwwwap_percentage_commission_box', $rtwwwap_value );
				}
				elseif( sanitize_text_field( $_POST[ 'rtwwwap_type' ] ) == 'fix_comm' ){
					$rtwwwap_updated = update_post_meta( $rtwwwap_post_id, 'rtwwwap_fixed_commission_box', $rtwwwap_value );
				}

				if( $rtwwwap_updated ){
					$rtwwwap_message = esc_html__( 'Commission for this product is updated', 'rtwwwap-wp-wc-affiliate-program' );
				}
				else{
					$rtwwwap_message = esc_html__( 'Something went wrong', 'rtwwwap-wp-wc-affiliate-program' );
				}

				echo json_encode( array( 'rtwwwap_status' => $rtwwwap_updated, 'rtwwwap_message' => $rtwwwap_message ) );
				die;
			}
		}
	}

	/*
	* This function is for creating a commission meta box in single product page
	*/
	
	function rtwwwap_add_custom_meta_box(){
		if( current_user_can( 'manage_options' ) ){
			$rtwwwap_commission_settings 	= get_option( 'rtwwwap_commission_settings_opt' );
			$rtwwwap_comm_base 				= isset( $rtwwwap_commission_settings[ 'comm_base' ] ) ? $rtwwwap_commission_settings[ 'comm_base' ] : '1';
			if(RTWWWAP_IS_WOO == 1)
			{
				$rtwwwap_Easy_OR_Woo = 'product';	
			}
			if(RTWWWAP_IS_Easy == 1)
			{
				$rtwwwap_Easy_OR_Woo = 'download';	
			}
			if( $rtwwwap_comm_base == 1 ){
				add_meta_box( 'rtwwwap_product_custom_meta_box', esc_html__( 'Add Commission', 'rtwwwap-wp-wc-affiliate-program' ), array( $this, 'rtwwwap_product_custom_meta_box_show' ), $rtwwwap_Easy_OR_Woo );
			}
		}
	}


	/*
	* This function is for displaying the meta box
	*/
	function rtwwwap_product_custom_meta_box_show( $rtwwwap_post ){
		$rtwwwap_perc_comm = get_post_meta( $rtwwwap_post->ID, 'rtwwwap_percentage_commission_box', true );
		$rtwwwap_fix_comm 	= get_post_meta( $rtwwwap_post->ID, 'rtwwwap_fixed_commission_box', true );

		$rtwwwap_commission_settings = get_option( 'rtwwwap_commission_settings_opt' );
		$rtwwwap_commission_settings = isset( $rtwwwap_commission_settings[ 'per_prod_mode' ] ) ? $rtwwwap_commission_settings[ 'per_prod_mode' ] : 0;

	    // We'll use this nonce field later on when saving.
	    wp_nonce_field( 'rtwwwap_commission_nonce', 'rtwwwap_meta_box_nonce' );
	    if( $rtwwwap_commission_settings == 1 || $rtwwwap_commission_settings == 3 ){
	   	?>
	    <p>
	        <label for="rtwwwap_percentage_commission_box"><?php esc_html_e( 'Percentage Commission', 'rtwwwap-wp-wc-affiliate-program' ); ?></label>
	        <input type="number" min="0" max="100" name="rtwwwap_percentage_commission_box" id="rtwwwap_percentage_commission_box" value="<?php echo esc_attr( $rtwwwap_perc_comm ); ?>" />
	    </p>
	    <?php
	    }
	    if( $rtwwwap_commission_settings == 2 || $rtwwwap_commission_settings == 3 ){
	    ?>
	    <p>
	        <label for="rtwwwap_fixed_commission_box"><?php esc_html_e( 'Fixed Commission', 'rtwwwap-wp-wc-affiliate-program' ); ?></label>
	        <input type="number" min="0" name="rtwwwap_fixed_commission_box" id="rtwwwap_fixed_commission_box" value="<?php echo esc_attr( $rtwwwap_fix_comm ); ?>" />
	    </p>
	    <?php
		}
	}


	


	/*
	* Function to save meta box
	*/
	function rtwwwap_save_custom_meta_box( $rtwwwap_post_id, $rtwwwap_post, $rtwwwap_update ) {
	    if( !isset( $_POST[ 'rtwwwap_meta_box_nonce' ] ) || !wp_verify_nonce( sanitize_text_field( $_POST[ 'rtwwwap_meta_box_nonce' ] ), 'rtwwwap_commission_nonce' ) )
	    {
	    	return;
	    }

	    if( !current_user_can( 'edit_post' ) ){
	    	return;
	    }

	    if( isset( $_POST[ 'rtwwwap_percentage_commission_box' ] ) ){
        	update_post_meta( $rtwwwap_post_id, 'rtwwwap_percentage_commission_box', sanitize_text_field( $_POST[ 'rtwwwap_percentage_commission_box' ] ) );
	    }

	    if( isset( $_POST[ 'rtwwwap_fixed_commission_box' ] ) ){
        	update_post_meta( $rtwwwap_post_id, 'rtwwwap_fixed_commission_box', sanitize_text_field( $_POST[ 'rtwwwap_fixed_commission_box' ] ) );
	    }
	}

	function rtwwwap_approve_callback()
	{
		$rtwwwap_check_ajax = check_ajax_referer( 'rtwwwap-ajax-security-string', 'rtwwwap_security_check' );

		if ( $rtwwwap_check_ajax ) {
			global $wpdb;
			$rtwwwap_reff_ids 		= $_POST[ 'rtwwwap_referral_ids' ];
			$rtwwwap_approved_ids 	= array();
			if( RTWWWAP_IS_WOO == 1 ){
				$rtwwwap_currency_sym = get_woocommerce_currency();
			}
			else{
				require_once( RTWWWAP_DIR.'includes/rtwaffiliatehelper.php' );

				$rtwwwap_extra_features = get_option( 'rtwwwap_extra_features_opt' );
				$rtwwwap_currency 		= isset( $rtwwwap_extra_features[ 'currency' ] ) ? $rtwwwap_extra_features[ 'currency' ] : 'USD';
			}
			$rtwwwap_currency_sym 	= esc_html( $rtwwwap_currency );

			foreach( $rtwwwap_reff_ids as $rtwwwap_key => $rtwwwap_value ){
				$rtwwwap_updated = $wpdb->update(
										$wpdb->prefix.'rtwwwap_referrals',
										array( 'status' => 1 ),
										array( 'id' => $rtwwwap_value ),
										array( '%d' ),
										array( '%d' )
									);

				if( $rtwwwap_updated ){
					$rtwwwap_referral_amount 	= $wpdb->get_var( $wpdb->prepare( "SELECT `amount` FROM ".$wpdb->prefix."rtwwwap_referrals WHERE `id`=%d AND `type` != %d", $rtwwwap_value, 3 ) );
					$rtwwwap_referral_user_id 	= $wpdb->get_var( $wpdb->prepare( "SELECT `aff_id` FROM ".$wpdb->prefix."rtwwwap_referrals WHERE `id`=%d", $rtwwwap_value ) );

					$rtwwwap_aff_overall_comm 	= get_user_meta( $rtwwwap_referral_user_id, 'rtw_user_wallet', true );
					$rtwwwap_aff_overall_comm += $rtwwwap_referral_amount;

					update_user_meta( $rtwwwap_referral_user_id, 'rtw_user_wallet', esc_html( $rtwwwap_aff_overall_comm ) );

					//performance bonus start
					$rtwwwap_last_incentive_given = get_user_meta( $rtwwwap_referral_user_id, 'rtwwwap_perf_bonus', true );

					$rtwwwap_total_amount_referred = $wpdb->get_results( $wpdb->prepare( "SELECT `product_details` FROM ".$wpdb->prefix."rtwwwap_referrals WHERE `aff_id`=%d AND ( `status`=%d OR `status`=%d ) AND `type`=%d", $rtwwwap_referral_user_id, 1, 2, 0 ), ARRAY_A );

					$rtwwwap_total_referred_amt = 0;
					if( !empty( $rtwwwap_total_amount_referred ) ){
						foreach( $rtwwwap_total_amount_referred as $rtwwwap_key => $rtwwwap_value ){
							$rtwwwap_prod_details = json_decode( $rtwwwap_value[ 'product_details' ], true );
							$rtwwwap_total_referred_amt += array_sum( array_column( $rtwwwap_prod_details, 'product_price' ) );
						}
					}

					$rtwwwap_extra_features 	= get_option( 'rtwwwap_extra_features_opt' );
					$rtwwwap_performance_bonus 	= isset( $rtwwwap_extra_features[ 'performance_bonus' ] ) ? $rtwwwap_extra_features[ 'performance_bonus' ] : array();

					if( !empty( $rtwwwap_performance_bonus ) )
					{
						$rtwwwap_locale = get_locale();
						setlocale( LC_NUMERIC, $rtwwwap_locale );

						foreach( $rtwwwap_performance_bonus as $rtwwwap_perf_key => $rtwwwap_perf_value )
						{
							if( $rtwwwap_perf_value != 0 && $rtwwwap_perf_key < $rtwwwap_total_referred_amt )
							{
								if( $rtwwwap_last_incentive_given < $rtwwwap_perf_key )
								{
									$rtwwwap_updated = $wpdb->insert(
							            $wpdb->prefix.'rtwwwap_referrals',
							            array(
							                'aff_id'    		=> $rtwwwap_referral_user_id,
							                'type'    			=> 2,
							                'order_id'    		=> 0,
							                'date'    			=> date( 'Y-m-d H:i:s' ),
							                'status'    		=> 0,
							                'amount'    		=> esc_html( $rtwwwap_perf_value ),
							                'capped'    		=> 0,
							                'currency'    		=> $rtwwwap_currency_sym,
							                'product_details'   => '',
							                'device'   			=> ''
							            )
							        );

							        if( $rtwwwap_updated ){
							        	update_user_meta( $rtwwwap_referral_user_id, 'rtwwwap_perf_bonus', $rtwwwap_perf_key );
							        }
								}
							}
							else{
								break;
							}
						}
						setlocale( LC_ALL, $rtwwwap_locale );
					}
					//performance bonus end

					// update user level start
					$rtwwwap_commission_settings = get_option( 'rtwwwap_commission_settings_opt' );
					$rtwwwap_comm_base = isset( $rtwwwap_commission_settings[ 'comm_base' ] ) ? $rtwwwap_commission_settings[ 'comm_base' ] : '1';

					if( $rtwwwap_comm_base == 2 ){
						$rtwwwap_total_referrals = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(`id`) as total_referrals FROM ".$wpdb->prefix."rtwwwap_referrals WHERE `aff_id`=%d AND ( `status`=%d OR `status`=%d ) AND `type` != %d", $rtwwwap_referral_user_id, 1, 2, 3 ) );
						$rtwwwap_total_referrals 	= $rtwwwap_total_referrals;
						$rtwwwap_total_sale 		= $rtwwwap_total_referred_amt;
						$rtwwwap_levels_settings 	= get_option( 'rtwwwap_levels_settings_opt' );

						if( !empty( $rtwwwap_levels_settings ) )
						{
							$rtwwwap_sales_arr 		= array();
							$rtwwwap_referrals_arr 	= array();
				  			foreach( $rtwwwap_levels_settings as $rtwwwap_levels_key => $rtwwwap_levels_val )
				  			{
				  				if( $rtwwwap_levels_val[ 'level_criteria_type' ] == 1 ){
				  					$rtwwwap_referrals_arr[] = $rtwwwap_levels_val[ 'level_criteria_val' ];
				  				}
				  				elseif( $rtwwwap_levels_val[ 'level_criteria_type' ] == 2 ){
				  					$rtwwwap_sales_arr[] = $rtwwwap_levels_val[ 'level_criteria_val' ];
				  				}
				  			}
				  			// sort values ascending
				  			if( !empty( $rtwwwap_sales_arr ) ){
				  				asort( $rtwwwap_sales_arr );
				  			}
				  			if( !empty( $rtwwwap_referrals_arr ) ){
				  				asort( $rtwwwap_referrals_arr );
				  			}

				  			// defining level based on referrals
				  			$rtwwwap_old_level = '';
				  			foreach( $rtwwwap_levels_settings as $rtwwwap_referral_levels_key => $rtwwwap_referral_levels_val )
				  			{
				  				if( $rtwwwap_referral_levels_val[ 'level_criteria_type' ] == 1 )
				  				{
				  					if( $rtwwwap_referral_levels_val[ 'level_criteria_val' ] <= $rtwwwap_total_referrals )
				  					{
				  						$rtwwwap_old_level = $rtwwwap_referral_levels_key;
				  					}
				  				}
				  			}
				  			$rtwwwap_referral_level = $rtwwwap_old_level;

				  			// defining level based on sales
				  			$rtwwwap_old_level = '';
				  			foreach( $rtwwwap_levels_settings as $rtwwwap_sales_levels_key => $rtwwwap_sales_levels_val )
				  			{
				  				if( $rtwwwap_sales_levels_val[ 'level_criteria_type' ] == 2 )
				  				{
				  					if( $rtwwwap_sales_levels_val[ 'level_criteria_val' ] <= $rtwwwap_total_sale )
				  					{
				  						$rtwwwap_old_level = $rtwwwap_sales_levels_key;
				  					}
				  				}
				  			}
				  			$rtwwwap_sales_level = $rtwwwap_old_level;

				  			$rtwwwap_main_level = 0;
				  			if( $rtwwwap_referral_level > $rtwwwap_sales_level )
				  			{
				  				$rtwwwap_main_level = $rtwwwap_referral_level;
				  			}
				  			if( $rtwwwap_sales_level > $rtwwwap_referral_level )
				  			{
				  				$rtwwwap_main_level = $rtwwwap_sales_level;
				  			}

				  			//updating user level in usermeta
				  			update_user_meta( $rtwwwap_referral_user_id, 'rtwwwap_affiliate_level', $rtwwwap_main_level );
				  		}
				  	}
					// update user level end

					$rtwwwap_approved_ids[] = $rtwwwap_value;
				}
			}

			if( sizeof( $rtwwwap_reff_ids ) == sizeof( $rtwwwap_approved_ids ) ){
				$rtwwwap_status = true;
				$rtwwwap_message = esc_html__( 'Approved', 'rtwwwap-wp-wc-affiliate-program' );
			}
			else{
				$rtwwwap_status = false;
				$rtwwwap_message = esc_html__( 'Some referrals are not approved. Try again', 'rtwwwap-wp-wc-affiliate-program' );
			}

			echo json_encode( array( 'rtwwwap_status' => $rtwwwap_status, 'rtwwwap_message' => $rtwwwap_message, 'rtwwwap_approved_ids' => $rtwwwap_approved_ids ) );
			die;
		}
	}

	function rtwwwap_reject_callback()
	{
		$rtwwwap_check_ajax = check_ajax_referer( 'rtwwwap-ajax-security-string', 'rtwwwap_security_check' );

		if ( $rtwwwap_check_ajax ) {
			global $wpdb;
			$rtwwwap_reff_ids 		= $_POST[ 'rtwwwap_referral_ids' ];
			$rtwwwap_reject_msg	    = $_POST['rtwwwap_reject_message'];
			$rtwwwap_rejected_ids 	= array();
		
			foreach( $rtwwwap_reff_ids as $rtwwwap_key => $rtwwwap_value ){
				$rtwwwap_updated = $wpdb->update(
										$wpdb->prefix.'rtwwwap_referrals',
										array( 'status' => 3 , 'message' => $rtwwwap_reject_msg ),
										array( 'id' => $rtwwwap_value )
									
									);
				

				if( $rtwwwap_updated ){
					$rtwwwap_rejected_ids[] = $rtwwwap_value;
				}
			}
			

			if( sizeof( $rtwwwap_reff_ids ) == sizeof( $rtwwwap_rejected_ids ) ){
				$rtwwwap_status = true;
				$rtwwwap_message = esc_html__( 'Rejected', 'rtwwwap-wp-wc-affiliate-program' );
			}
			else{
				$rtwwwap_status = false;
				$rtwwwap_message = esc_html__( 'Some referrals are not rejected. Try again', 'rtwwwap-wp-wc-affiliate-program' );
			}

			echo json_encode( array( 'rtwwwap_status' => $rtwwwap_status, 'rtwwwap_message' => $rtwwwap_message, 'rtwwwap_rejected_ids' => $rtwwwap_rejected_ids ) );
			die;
		}
	}

	function rtwwwap_aff_approve_callback()
	{
		$rtwwwap_check_ajax = check_ajax_referer( 'rtwwwap-ajax-security-string', 'rtwwwap_security_check' );

		if ( $rtwwwap_check_ajax ) {
			$rtwwwap_reff_ids 		= $_POST[ 'rtwwwap_referral_ids' ];
			$rtwwwap_approved_ids 	= array();

			foreach( $rtwwwap_reff_ids as $rtwwwap_key => $rtwwwap_value ){
				$rtwwwap_updated = update_user_meta( $rtwwwap_value, 'rtwwwap_aff_approved', 1 );

				if( $rtwwwap_updated ){
					$rtwwwap_mlm = get_option( 'rtwwwap_mlm_opt' );
					if( isset( $rtwwwap_mlm[ 'activate' ] ) && $rtwwwap_mlm[ 'activate' ] == 1 )
					{
						global $wpdb;
						//check if already in MLM chain
						$rtwwwap_already_a_child = $wpdb->get_var( $wpdb->prepare( "SELECT `id` FROM ".$wpdb->prefix."rtwwwap_mlm WHERE `aff_id` = %d", $rtwwwap_user_id ) );

						if( is_null( $rtwwwap_already_a_child  ) ){
							$rtwwwap_allowed_childs = isset( $rtwwwap_mlm[ 'child' ] ) ? $rtwwwap_mlm[ 'child' ] : 1;

							$rtwwwap_parent_id = $wpdb->get_var( $wpdb->prepare( "SELECT `aff_id` FROM ".$wpdb->prefix."rtwwwap_referrals WHERE `signed_up_id` = %d", $rtwwwap_value ) );

							if( $rtwwwap_parent_id ){
								$rtwwwap_current_childs = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT( `id` ) FROM ".$wpdb->prefix."rtwwwap_mlm WHERE `parent_id` = %d", $rtwwwap_parent_id ) );

								if( $rtwwwap_allowed_childs > $rtwwwap_current_childs ){
									$rtwwwap_updated = 	$wpdb->insert(
												            $wpdb->prefix.'rtwwwap_mlm',
												            array(
												                'aff_id'    	=> $rtwwwap_value,
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
												                'aff_id'    	=> $rtwwwap_value,
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

					$rtwwwap_approved_ids[] = $rtwwwap_value;
				}
			}

			if( sizeof( $rtwwwap_reff_ids ) == sizeof( $rtwwwap_approved_ids ) ){
				$rtwwwap_message = esc_html__( 'Approved', 'rtwwwap-wp-wc-affiliate-program' );
			}
			else{
				$rtwwwap_message = esc_html__( 'Something went wrong. Try again', 'rtwwwap-wp-wc-affiliate-program' );
			}

			echo json_encode( array( 'rtwwwap_status' => true, 'rtwwwap_message' => $rtwwwap_message, 'rtwwwap_approved_ids' => $rtwwwap_approved_ids ) );
			die;
		}
	}

	/*
	* Payouts via Paypal
	*/
	function rtwwwap_paypal_callback(){
		$rtwwwap_aff_ids = isset( $_POST[ 'rtwwwap_aff_ids' ] ) ? $_POST[ 'rtwwwap_aff_ids' ] : array();

		if( !empty( $rtwwwap_aff_ids ) ){
			require_once RTWWWAP_DIR . 'third_party/paypal/vendor/autoload.php';
			$rtwwwap_extra_features = get_option( 'rtwwwap_extra_features_opt' );

			$rtwwwap_paypal_type 	= isset( $rtwwwap_extra_features[ 'paypal_type' ] ) ? $rtwwwap_extra_features[ 'paypal_type' ] : '';

			if( $rtwwwap_paypal_type && $rtwwwap_paypal_type == 'live' ){
				$rtwwwap_client_id 		= get_option( 'rtwwwap_paypal_client_id' );
				$rtwwwap_client_secret 	= get_option( 'rtwwwap_paypal_client_secret' );
				$rtwwwap_is_sandbox 	= 0;
			}
			elseif( $rtwwwap_paypal_type && $rtwwwap_paypal_type == 'sandbox' ){
				$rtwwwap_client_id 		= isset( $rtwwwap_extra_features[ 'paypal_sandbox_client_id' ] ) ? $rtwwwap_extra_features[ 'paypal_sandbox_client_id' ] : '';
				$rtwwwap_client_secret 	= isset( $rtwwwap_extra_features[ 'paypal_sandbox_client_secret' ] ) ? $rtwwwap_extra_features[ 'paypal_sandbox_client_secret' ] : '';
				$rtwwwap_is_sandbox 	= 1;
			}

			if( !$rtwwwap_client_id || !$rtwwwap_client_secret ){
				echo json_encode( array( 'rtwwwap_status' => false, 'rtwwwap_message' => esc_html__( 'Paypal not setup correctly.', 'rtwwwap-wp-wc-affiliate-program' ) ) );
				die;
			}

			$rtwwwap_apiContext = new PayPal\Rest\ApiContext(
				new PayPal\Auth\OAuthTokenCredential(
						$rtwwwap_client_id,
						$rtwwwap_client_secret
				)
			);

			$rtwwwap_config = array(
						'log.LogEnabled'=> false,
						'log.FileName' 	=> '',
						'log.LogLevel' 	=> 'DEBUG',
						'cache.enabled' => false,
					);

			if( $rtwwwap_is_sandbox ){
				$rtwwwap_config[ 'mode' ] = 'sandbox';
			}
			else{
				$rtwwwap_config[ 'mode' ] = 'live';
			}

			$rtwwwap_apiContext->setConfig( $rtwwwap_config );

			$rtwwwap_payouts = new \PayPal\Api\Payout();
			$rtwwwap_senderBatchHeader = new \PayPal\Api\PayoutSenderBatchHeader();
			$rtwwwap_senderBatchHeader->setSenderBatchId( uniqid() )
			->setEmailSubject( esc_html__( "You have a payment", 'rtwwwap-wp-wc-affiliate-program' ) );
			$rtwwwap_payouts->setSenderBatchHeader( $rtwwwap_senderBatchHeader );

			$rtwwwap_commission_settings 	= get_option( 'rtwwwap_commission_settings_opt' );
			$rtwwwap_withdraw_commission 	= isset( $rtwwwap_commission_settings[ 'withdraw_commission' ] ) ? $rtwwwap_commission_settings[ 'withdraw_commission' ] : '0';

			global $wpdb;
			foreach( $rtwwwap_aff_ids as $rtwwwap_key => $rtwwwap_aff_id ){
				$rtwwwap_amount 	= floatval( $rtwwwap_aff_id[ 'amount' ] ) - $rtwwwap_withdraw_commission;
				$rtwwwap_currency 	= $rtwwwap_aff_id[ 'currency' ];

				$rtwwwap_email = get_user_meta( $rtwwwap_aff_id[ 'aff_id' ], 'rtwwwap_paypal_email', true );

				$rtwwwap_new_sender = new \PayPal\Api\PayoutItem();
				$rtwwwap_new_sender->setRecipientType( 'Email' )
				                    ->setReceiver( $rtwwwap_email )
									->setSenderItemId( uniqid() )
									->setAmount( new \PayPal\Api\Currency( '{
												"value":"'.esc_attr( $rtwwwap_amount ).'",
												"currency":"'.esc_attr( $rtwwwap_currency ).'"
											}')
									);

				$rtwwwap_payouts->addItem( $rtwwwap_new_sender );
			}

			$rtwwwap_request = clone $rtwwwap_payouts;

			try{
				$rtwwwap_output = $rtwwwap_payouts->create( null, $rtwwwap_apiContext );
			}
			catch( Exception $rtwwwap_ex ){
				$rtwwwap_return_arr = array( "Payout", null, $rtwwwap_request, $rtwwwap_ex );

				echo json_encode( array( 'rtwwwap_status' => esc_html__( "Something went wrong. Try again.", 'rtwwwap-wp-wc-affiliate-program' ), 'rtwwwap_payment_arr' => $rtwwwap_return_arr ) );
				die;
			}

			$rtwwwap_batch_id = $rtwwwap_output->getBatchHeader()->getPayoutBatchId();

			if( $rtwwwap_batch_id && $rtwwwap_batch_id != '0' ){
				foreach( $rtwwwap_aff_ids as $rtwwwap_key => $rtwwwap_reff_id ){
					$wpdb->update(
						$wpdb->prefix.'rtwwwap_referrals',
						array(
							'payment_type' 			=> 'paypal',
							'payment_create_date' 	=> date( 'Y-m-d H:i:s', time() ),
							'payment_update_date' 	=> date( 'Y-m-d H:i:s', time() ),
							'status' 				=> 2,
							'batch_id' 				=> $rtwwwap_batch_id
						),
						array(
							'aff_id' => $rtwwwap_reff_id[ 'aff_id' ],
							'status' => 1,
							'capped' => 0
						),
						array(
							'%s',
							'%s',
							'%s',
							'%d',
							'%s'
						),
						array(
							'%d',
							'%d',
							'%d',
						)
					);

					$rtwwwap_wallet = get_user_meta( $rtwwwap_aff_id, 'rtw_user_wallet', true );
					$rtwwwap_new_amount = floatval( $rtwwwap_wallet ) - floatval( $rtwwwap_amount );
					update_user_meta( $rtwwwap_reff_id[ 'aff_id' ], 'rtw_user_wallet', $rtwwwap_new_amount );

					$rtwwwap_affiliate_id 	= $rtwwwap_reff_id[ 'aff_id' ];
					$rtwwwap_amount 		= floatval( $rtwwwap_aff_id[ 'amount' ] ) - $rtwwwap_withdraw_commission;
					$rtwwwap_currency 		= $rtwwwap_aff_id[ 'currency' ];
					$rtwwwap_message 		= esc_html__( 'Affilate Payout via PayPal', 'rtwwwap-wp-wc-affiliate-program' );
					/*
					* params
					* $rtwwwap_affiliate_id  	ID of user to which the amount is being paid too
					* $rtwwwap_amount  			Amount paid to user
					* $rtwwwap_currency  		Currency
					* $rtwwwap_message  		Message
					*/
					do_action( 'rtwwwap_affiliate_paypal_payout', $rtwwwap_affiliate_id, $rtwwwap_amount, $rtwwwap_currency, $rtwwwap_message );
				}
			}

			$rtwwwap_return_arr = array( "Payout", $rtwwwap_output->getBatchHeader()->getPayoutBatchId(), $rtwwwap_request, $rtwwwap_output );

			echo json_encode( array( 'rtwwwap_status' => esc_html__( "Successfully paid", 'rtwwwap-wp-wc-affiliate-program' ), 'rtwwwap_payment_arr' => $rtwwwap_return_arr ) );
			die;
		}
	}

	function rtwwwap_export( $exporters ){
		$exporters[ 'rtwwwap-my-plugin-exporter-affiliate' ] = array(
			'exporter_friendly_name' => esc_html__( 'WordPress & WooCommerce Affiliate Program Exporter', 'rtwwwap-wp-wc-affiliate-program' ),
			'callback'	=> array( $this, 'rtwwwap_affilate_plugin_exporter' ),
		);

		return $exporters;
	}

	function rtwwwap_affilate_plugin_exporter( $rtwwwap_email_address, $rtwwwap_page = 1 ) {
		$rtwwwap_user		= get_user_by( 'email', $rtwwwap_email_address );
		$rtwwwap_user_id 	= $rtwwwap_user->ID;

		$rtwwwap_direct_details = get_user_meta( $rtwwwap_user_id, 'rtwwwap_direct', true );
		$rtwwwap_paypal_email 	= get_user_meta( $rtwwwap_user_id, 'rtwwwap_paypal_email', true );
		$rtwwwap_stripe_email 	= get_user_meta( $rtwwwap_user_id, 'rtwwwap_stripe_email', true );

		$rtwwwap_internal_data 		= array();
		$rtwwwap_data_to_export 	= array();

		if( $rtwwwap_direct_details ){
			$rtwwwap_internal_data[0] 	= array( 'name' => esc_html__( 'Bank Details', 'rtwwwap-wp-wc-affiliate-program' ), 'value' => $rtwwwap_direct_details );
			$rtwwwap_data_to_export[] 	= array(
										'group_id'    => 'rtwwwap_affiliate_exporter',
										'group_label' => esc_html__( 'Affiliate Program', 'rtwwwap-wp-wc-affiliate-program' ),
										'item_id'     => "affiliate-bank",
										'data'        => $rtwwwap_internal_data,
									);
		}
		if( $rtwwwap_paypal_email ){
			$rtwwwap_internal_data[0] 	= array( 'name' => esc_html__( 'Paypal Details', 'rtwwwap-wp-wc-affiliate-program' ), 'value' => $rtwwwap_paypal_email );
			$rtwwwap_data_to_export[] 	= array(
										'group_id'    => 'rtwwwap_affiliate_exporter',
										'group_label' => esc_html__( 'Affiliate Program', 'rtwwwap-wp-wc-affiliate-program' ),
										'item_id'     => "affiliate-paypal",
										'data'        => $rtwwwap_internal_data,
									);
		}
		if( $rtwwwap_stripe_email ){
			$rtwwwap_internal_data[0] 	= array( 'name' => esc_html__( 'Stripe Details', 'rtwwwap-wp-wc-affiliate-program' ), 'value' => $rtwwwap_stripe_email );
			$rtwwwap_data_to_export[] 	= array(
										'group_id'    => 'rtwwwap_affiliate_exporter',
										'group_label' => esc_html__( 'Affiliate Program', 'rtwwwap-wp-wc-affiliate-program' ),
										'item_id'     => "affiliate-stripe",
										'data'        => $rtwwwap_internal_data,
									);
		}

		return array(
			'data' => $rtwwwap_data_to_export,
			'done' => true,
		);
	}

	function rtwwwap_eraser( $erasers ) {
		$erasers[ 'rtwwwap-my-plugin-eraser-affiliate' ] = array(
			'eraser_friendly_name' => esc_html__( 'WordPress & WooCommerce Affiliate Program Eraser', 'rtwwwap-wp-wc-affiliate-program' ),
			'callback'	=> array( $this, 'rtwwwap_affilate_plugin_eraser' ),
		);

		return $erasers;
	}

	function rtwwwap_affilate_plugin_eraser( $rtwwwap_email_address, $rtwwwap_page = 1 ) {
		$rtwwwap_user		= get_user_by( 'email', $rtwwwap_email_address );
		$rtwwwap_user_id 	= $rtwwwap_user->ID;

		$rtwwwap_direct_details = delete_user_meta( $rtwwwap_user_id, 'rtwwwap_direct' );
		$rtwwwap_paypal_email 	= delete_user_meta( $rtwwwap_user_id, 'rtwwwap_paypal_email' );
		$rtwwwap_stripe_email 	= delete_user_meta( $rtwwwap_user_id, 'rtwwwap_stripe_email' );

		return array(
				'items_removed'  => true,
				'items_retained' => false,
				'messages'       => [],
				'done'           => true,
			);
	}

	/**
	 * This function is for delete affiliate level
	 */
	function rtwwwap_aff_level_delete_callback()
	{
		$rtwwwap_check_ajax = check_ajax_referer( 'rtwwwap-ajax-security-string', 'rtwwwap_security_check' );

		if ( $rtwwwap_check_ajax ) {
			$rtwwwap_level_id 	= $_POST[ 'rtwwwap_level_id' ];
			$rtwwwap_levels_settings = get_option( 'rtwwwap_levels_settings_opt' );
			if( !empty( $rtwwwap_levels_settings ) ){
				unset( $rtwwwap_levels_settings[ $rtwwwap_level_id ] );
				$rtwwwap_levels_settings = array_values( $rtwwwap_levels_settings );
				update_option( 'rtwwwap_levels_settings_opt', $rtwwwap_levels_settings );
			}

			$rtwwwap_args = array(
				'meta_key' 		=> 'rtwwwap_affiliate_level',
				'meta_value' 	=> $rtwwwap_level_id
			);

			$rtwwwap_users = get_users( $rtwwwap_args );
			if( !empty( $rtwwwap_users ) ){
				$rtwwwap_new_level = $rtwwwap_level_id-1;
				$rtwwwap_new_level = ( $rtwwwap_new_level >= 0 ) ? $rtwwwap_new_level : 0;
				foreach( $rtwwwap_users as $rtwwwap_key => $rtwwwap_user ){
					update_user_meta( $rtwwwap_user->ID, 'rtwwwap_affiliate_level', $rtwwwap_new_level );
				}
			}

			$rtwwwap_message = esc_html__( 'Deleted', 'rtwwwap-wp-wc-affiliate-program' );

			echo json_encode( array( 'rtwwwap_status' => true, 'rtwwwap_message' => $rtwwwap_message ) );
			die;
		}
	}

	/**
	 * This function is for delete referrals
	 */
	function rtwwwap_referral_delete_callback()
	{
		global $wpdb;
		$rtwwwap_check_ajax = check_ajax_referer( 'rtwwwap-ajax-security-string', 'rtwwwap_security_check' );

		if ( $rtwwwap_check_ajax ) {
			$rtwwwap_referral_id 		= $_POST[ 'rtwwwap_referral_id' ];
			$rtwwwap_delete_referral 	= $wpdb->delete( $wpdb->prefix.'rtwwwap_referrals', array( 'id' => $rtwwwap_referral_id ), array( '%d' ) );

			if( $rtwwwap_delete_referral ){
				$rtwwwap_message 	= esc_html__( 'Deleted', 'rtwwwap-wp-wc-affiliate-program' );
				$rtwwwap_status 	= true;
			}
			else{
				$rtwwwap_message 	= esc_html__( 'Something went wrong. Try again', 'rtwwwap-wp-wc-affiliate-program' );
				$rtwwwap_status 	= false;
			}

			echo json_encode( array( 'rtwwwap_status' => $rtwwwap_status, 'rtwwwap_message' => $rtwwwap_message ) );
			die;
		}
	}

	/*
	* Function to mark direct bank transfers as paid
	*/
	function rtwwwap_direct_pay_callback(){
		$rtwwwap_aff_id = isset( $_POST[ 'rtwwwap_aff_id' ] ) ? $_POST[ 'rtwwwap_aff_id' ] : '';
		$rtwwwap_amount = isset( $_POST[ 'rtwwwap_amount' ] ) ? $_POST[ 'rtwwwap_amount' ] : '';

		if( $rtwwwap_aff_id ){
			global $wpdb;

			$wpdb->update(
				$wpdb->prefix.'rtwwwap_referrals',
				array(
					'payment_type' 			=> 'direct',
					'payment_create_date' 	=> date( 'Y-m-d H:i:s', time() ),
					'payment_update_date' 	=> date( 'Y-m-d H:i:s', time() ),
					'status' 				=> 2
				),
				array(
					'aff_id' => $rtwwwap_aff_id,
					'status' => 1,
					'capped' => 0
				),
				array(
					'%s',
					'%s',
					'%s',
					'%d'
				),
				array(
					'%d',
					'%d',
					'%d',
				)
			);

			$rtwwwap_wallet = get_user_meta( $rtwwwap_aff_id, 'rtw_user_wallet', true );
			$rtwwwap_new_amount = floatval( $rtwwwap_wallet ) - floatval( $rtwwwap_amount );
			update_user_meta( $rtwwwap_aff_id, 'rtw_user_wallet', $rtwwwap_new_amount );

			echo json_encode( array( 'rtwwwap_status' => esc_html__( "Successfully paid", 'rtwwwap-wp-wc-affiliate-program' ) ) );
			die;
		}
	}

	/*
	* Function to update level orders
	*/
	function rtwwwap_update_level_order_callback(){
		$rtwwwap_new_order = isset( $_POST[ 'rtwwwap_new_order' ] ) ? $_POST[ 'rtwwwap_new_order' ] : array();
		$rtwwwap_levels_settings = get_option( 'rtwwwap_levels_settings_opt' );

		$rtwwwap_levels_new = array();
		if( !empty( $rtwwwap_new_order ) ){
			foreach( $rtwwwap_new_order as $rtwwwap_levels_val )
			{
				$rtwwwap_levels_new[] = $rtwwwap_levels_settings[ $rtwwwap_levels_val ];
			}

			if( !empty( $rtwwwap_levels_new ) ){
				$rtwwwap_updated = update_option( 'rtwwwap_levels_settings_opt', $rtwwwap_levels_new );

				if( $rtwwwap_updated ){
					echo json_encode( array( 'rtwwwap_status' => true, 'rtwwwap_message' => esc_html__( 'Order Successfully updated', 'rtwwwap-wp-wc-affiliate-program' ) ) );
					die;
				}
				else{
					echo json_encode( array( 'rtwwwap_status' => false, 'rtwwwap_message' => esc_html__( 'Something Went Wrong', 'rtwwwap-wp-wc-affiliate-program' ) ) );
					die;
				}
			}
		}
	}

	function rtwwwap_loop_each_parent( $rtwwwap_user_id, $rtwwwap_html, $rtwwwap_mlm_depth, $rtwwwap_count, $rtwwwap_active = 0, $rtwwwap_mlm_child ){
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
			$rtwwwap_html .= '<ul>';
			foreach( $rtwwwap_mlm_chain as $rtwwwap_key => $rtwwwap_value ){
				$rtwwwap_name = get_userdata( $rtwwwap_value[ 'aff_id' ] );
				$rtwwwap_name = $rtwwwap_name->data->display_name;
				if( $rtwwwap_value[ 'status' ] == 0 ){
					$rtwwwap_html .= 	'<li data-class="rtwwwap_disabled" data-id="'.$rtwwwap_value[ 'aff_id' ].'">';
				}
				else{
					$rtwwwap_html .= 	'<li data-id="'.$rtwwwap_value[ 'aff_id' ].'">';
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

	function rtwwwap_get_mlm_chain_callback(){
		global $rtwwwap_improper_chain;
		$rtwwwap_improper_chain = false;

		$rtwwwap_mlm 		= get_option( 'rtwwwap_mlm_opt' );
		$rtwwwap_mlm_depth 	= isset( $rtwwwap_mlm[ 'depth' ] ) ? $rtwwwap_mlm[ 'depth' ] : 0;
		$rtwwwap_mlm_child 	= isset( $rtwwwap_mlm[ 'child' ] ) ? $rtwwwap_mlm[ 'child' ] : 1;
		$rtwwwap_user_id 	= $_POST[ 'rtwwwap_user_id' ];
		$rtwwwap_active 	= $_POST[ 'rtwwwap_active' ];

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

		echo json_encode( array( 'rtwwwap_tree_html' => $rtwwwap_final_html, 'rtwwwap_improper_chain' => $rtwwwap_improper_chain ) ); die;
	}

	function rtwwwap_deactive_aff_callback(){
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

	function rtwwwap_active_aff_callback(){
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

	/*
	 * to delete user from MLM
	 */
	function rtwwwap_delete_user_mlm( $rtwwwap_user_id ){
		if( $rtwwwap_user_id ){
			global $wpdb;

			// delete child
			$rtwwwap_delete_child_from_mlm = $wpdb->delete( $wpdb->prefix.'rtwwwap_mlm', array( 'aff_id' => $rtwwwap_user_id ), array( '%d' ) );

			// delete parent
			$rtwwwap_delete_parent_from_mlm = $wpdb->delete( $wpdb->prefix.'rtwwwap_mlm', array( 'parent_id' => $rtwwwap_user_id ), array( '%d' ) );
		}
	}

	/*
	* Payouts via Stripe
	*/
	function rtwwwap_stripe_callback(){
		$rtwwwap_aff_ids = isset( $_POST[ 'rtwwwap_aff_ids' ] ) ? $_POST[ 'rtwwwap_aff_ids' ] : array();

		if( !empty( $rtwwwap_aff_ids ) ){
			require_once RTWWWAP_DIR . 'third_party/stripe/init.php';
			$rtwwwap_extra_features = get_option( 'rtwwwap_extra_features_opt' );

			$rtwwwap_stripe_type 	= isset( $rtwwwap_extra_features[ 'stripe_type' ] ) ? $rtwwwap_extra_features[ 'stripe_type' ] : '';

			if( $rtwwwap_stripe_type && $rtwwwap_stripe_type == 'live' ){
				$rtwwwap_publishable_key = get_option( 'stripe_live_publishable_key' );
				$rtwwwap_client_secret 	= get_option( 'stripe_live_secret_key' );
				$rtwwwap_is_sandbox 	= 0;
			}
			elseif( $rtwwwap_stripe_type && $rtwwwap_stripe_type == 'sandbox' ){
				$rtwwwap_publishable_key = isset( $rtwwwap_extra_features[ 'stripe_sandbox_publishable_key' ] ) ? $rtwwwap_extra_features[ 'stripe_sandbox_publishable_key' ] : '';
				$rtwwwap_client_secret 	= isset( $rtwwwap_extra_features[ 'stripe_sandbox_secret_key' ] ) ? $rtwwwap_extra_features[ 'stripe_sandbox_secret_key' ] : '';
				$rtwwwap_is_sandbox 	= 1;
			}

			if( !$rtwwwap_publishable_key || !$rtwwwap_client_secret ){
				echo json_encode( array( 'rtwwwap_status' => false, 'rtwwwap_message' => esc_html__( 'Stripe not setup correctly.', 'rtwwwap-wp-wc-affiliate-program' ) ) );
				die;
			}

			$rtwwwap_commission_settings 	= get_option( 'rtwwwap_commission_settings_opt' );
			$rtwwwap_withdraw_commission 	= isset( $rtwwwap_commission_settings[ 'withdraw_commission' ] ) ? $rtwwwap_commission_settings[ 'withdraw_commission' ] : '0';

			global $wpdb;
			foreach( $rtwwwap_aff_ids as $rtwwwap_key => $rtwwwap_reff_id ){
				$rtwwwap_aff_id 	= $rtwwwap_reff_id[ 'aff_id' ];
				$rtwwwap_amount 	= floatval( $rtwwwap_reff_id[ 'amount' ] ) - $rtwwwap_withdraw_commission;
				$rtwwwap_currency 	= $rtwwwap_reff_id[ 'currency' ];
				$rtwwwap_email 		= get_user_meta( $rtwwwap_aff_id, 'rtwwwap_stripe_email', true );

				$rtwwwap_stripe_trans_id = $this->rtwwwap_stripe_payout( $rtwwwap_aff_id, $rtwwwap_amount, $rtwwwap_currency, $rtwwwap_client_secret );

				if( !is_array( $rtwwwap_stripe_trans_id ) ){
					$wpdb->update(
						$wpdb->prefix.'rtwwwap_referrals',
						array(
							'payment_type' 			=> 'stripe',
							'payment_create_date' 	=> date( 'Y-m-d H:i:s', time() ),
							'payment_update_date' 	=> date( 'Y-m-d H:i:s', time() ),
							'status' 				=> 2,
							'batch_id' 				=> $rtwwwap_stripe_trans_id
						),
						array(
							'aff_id' => $rtwwwap_aff_id,
							'status' => 1,
							'capped' => 0
						),
						array(
							'%s',
							'%s',
							'%s',
							'%d',
							'%s'
						),
						array(
							'%d',
							'%d',
							'%d',
						)
					);

					$rtwwwap_wallet = get_user_meta( $rtwwwap_aff_id, 'rtw_user_wallet', true );
					$rtwwwap_new_amount = floatval( $rtwwwap_wallet ) - floatval( $rtwwwap_amount );
					update_user_meta( $rtwwwap_aff_id, 'rtw_user_wallet', $rtwwwap_new_amount );

					$rtwwwap_amount 	= floatval( $rtwwwap_aff_id[ 'amount' ] ) - $rtwwwap_withdraw_commission;
					$rtwwwap_message 	= esc_html__( 'Affiliate Payout via Stripe', 'rtwwwap-wp-wc-affiliate-program' );
					/*
					* params
					* $rtwwwap_affiliate_id  	ID of user to which the amount is being paid too
					* $rtwwwap_amount  			Amount paid to user
					* $rtwwwap_currency  		Currency
					* $rtwwwap_message  		Message
					*/
					do_action( 'rtwwwap_affiliate_stripe_payout', $rtwwwap_affiliate_id, $rtwwwap_amount, $rtwwwap_currency, $rtwwwap_message );
				}
				else{
					$rtwwwap_return_arr = array( "Payout", $rtwwwap_stripe_trans_id );

					echo json_encode( array( 'rtwwwap_status' => esc_html( $rtwwwap_stripe_trans_id[0] ), 'rtwwwap_payment_arr' => $rtwwwap_return_arr ) );
					die;
				}
			}
			$rtwwwap_return_arr = array( "Payout", $rtwwwap_stripe_trans_id );

			echo json_encode( array( 'rtwwwap_status' => esc_html__( "Successfully paid", 'rtwwwap-wp-wc-affiliate-program' ), 'rtwwwap_payment_arr' => $rtwwwap_return_arr ) );
			die;
		}
	}

	public function rtwwwap_stripe_payout( $rtwwwap_aff_id = 0, $rtwwwap_amount = 0, $rtwwwap_currency = 'USD', $rtwwwap_client_secret = '' )
	{
		if( $rtwwwap_aff_id ){
			$rtwwwap_amount = $rtwwwap_amount * 100;
			if( $rtwwwap_amount > 0 ){
				$rtwwwap_aff_stripe_id = get_user_meta( $rtwwwap_aff_id, 'rtwwwap_user_stripe_account_id', TRUE );
				$rtwwwap_userdata = get_userdata( $rtwwwap_aff_id );
				$rtwwwap_aff_mail = esc_html( $rtwwwap_userdata->data->user_email );
				$rtwwwap_aff_country = 'US';

				if( !$rtwwwap_aff_stripe_id ){
					$rtwwwap_aff_stripe_id = $this->rtwwwap_register_user( $rtwwwap_aff_id, $rtwwwap_client_secret, $rtwwwap_currency, $rtwwwap_aff_mail, $rtwwwap_aff_country );

					if( is_array( $rtwwwap_aff_stripe_id ) ){
						$rtwwwap_err_msg = $rtwwwap_aff_stripe_id[0];
						echo json_encode( array( 'rtwwwap_status' => esc_html__( $rtwwwap_err_msg ) ) );
						die;
					}
				}

				if( !is_array( $rtwwwap_aff_stripe_id ) ){
					$rtwwwap_site_name 	= get_option( 'blogname' );
					$rtwwwap_username 	= $rtwwwap_userdata->data->user_login;
					try{
						\Stripe\Stripe::setApiKey( $rtwwwap_client_secret );
						$rtwwwap_transfer_details = \Stripe\Transfer::create(array(
							  	"amount" 		=> floor( $rtwwwap_amount ),
							  	"currency" 		=> $rtwwwap_currency,
							  	"destination" 	=> $rtwwwap_aff_stripe_id,
							  	"description" 	=> esc_html__("From ", 'rtwwwap-wp-wc-affiliate-program') . $rtwwwap_site_name . esc_html__(" to ", 'rtwwwap-wp-wc-affiliate-program') . $rtwwwap_username . '.',
							));
					}
					catch( exception $rtwwwap_stripe_err ){
						if( $rtwwwap_stripe_err->httpStatus == 400 ){
							$rtwwwap_err_msg = json_decode( $rtwwwap_stripe_err->httpBody );
							$rtwwwap_err_msg = $rtwwwap_err_msg->error->message;

							return array( $rtwwwap_err_msg );
						}
					}

					if( isset( $rtwwwap_transfer_details->id ) ){
						return $rtwwwap_transfer_details->id;
					}
				}
			}
		}
		return '';
	}

	public function rtwwwap_register_user( $rtwwwap_aff_id = 0, $rtwwwap_client_secret = '', $rtwwwap_currency = 'USD', $rtwwwap_aff_mail = '', $rtwwwap_aff_country = 'US' ){
		if( $rtwwwap_aff_id ){
			\Stripe\Stripe::setApiKey( $rtwwwap_client_secret );

			$rtwwwap_user_arr = array(
								"type" 					=> "custom",
							  	"country" 				=> $rtwwwap_aff_country,
							  	"email" 				=> $rtwwwap_aff_mail,
							  	"requested_capabilities"=> ["card_payments"],
							  	"default_currency" 		=> $rtwwwap_currency
							);

			try{
				$rtwwwap_user_new_acct = \Stripe\Account::create( $rtwwwap_user_arr );
			}
			catch( exception $rtwwwap_stripe_error ){
				if( $rtwwwap_stripe_error->httpStatus == 400 ){
					$rtwwwap_err_msg = json_decode($rtwwwap_stripe_error->httpBody);
					$rtwwwap_err_msg = $rtwwwap_err_msg->error->message;

					return array( $rtwwwap_err_msg );
				}
			}
			return $rtwwwap_user_new_acct->id;
		}
		return FALSE;
	}


	/**
	 * Add a Affiliate product tab for simple.
	*/
	function rtwwwap_affiliate_product_tabs( $tabs)
	{
		$tabs['rtwwwap_cust_comm'] = array(
			'label'		=> __( 'Referee Commission Setting', 'rtwwwap-wp-wc-affiliate-program' ),
			'target'	=> 'rtwwwap_affiliate_commission_tab',
			'class'		=> array('show_if_simple'),
			'priority' => 80
		);
		return $tabs;
	}


	/**
	 * HTML Content of referee commission tab.
	 */
	function rtwwwap_commission_product_tab_content() {
		global $post;
		?>
		<div id='rtwwwap_affiliate_commission_tab' class='panel woocommerce_options_panel'>
			<div class='options_group'>
				<?php
					woocommerce_wp_select(
						array(
							'id'          => '_rtwwwap_cust_comm_type',
							'label'       => __( 'Commission Type', 'rtwwwap-wp-wc-affiliate-program' ),
							'description' => __( 'Choose a commission type.', 'rtwwwap-wp-wc-affiliate-program' ),
							'value'       => get_post_meta( $post->ID, '_rtwwwap_cust_comm_type', true ),
							'options' => array(
								'fixed'   => __( 'Fixed', 'rtwwwap-wp-wc-affiliate-program' ),
								'percentage'   => __( 'Percentage', 'rtwwwap-wp-wc-affiliate-program' )
							)
						)
					);

					// Number Field
					woocommerce_wp_text_input(
						array(
							'id'          => '_rtwwwap_cust_comm_value',
							'label'       => __( 'Commission Amount', 'rtwwwap-wp-wc-affiliate-program' ),
							'desc_tip'    => 'true',
							'description' => __( 'Enter the commission amount.', 'rtwwwap-wp-wc-affiliate-program' ),
							'value'       => get_post_meta( $post->ID, '_rtwwwap_cust_comm_value', true ),
							'custom_attributes' => array(
									'step' 	=> 'any',
									'min'	=> '0'
							)
						)
					);	
				?>
			</div>
		</div>
		<?php
	}


	/**
	 * Save the custom fields.
	 */
	function rtwwwap_save_commission_fields( $post_id )
	{
		$rtwwwap_comm_type = sanitize_text_field( $_POST['_rtwwwap_cust_comm_type'] );
		if( ! empty( $rtwwwap_comm_type ) ) 
		{
			update_post_meta( $post_id, '_rtwwwap_cust_comm_type', esc_attr( $rtwwwap_comm_type ) );
		}

		$rtwwwap_comm_value = sanitize_text_field( $_POST['_rtwwwap_cust_comm_value'] );
		if( ! empty( $rtwwwap_comm_value ) ) 
		{
			update_post_meta( $post_id, '_rtwwwap_cust_comm_value', esc_attr( $rtwwwap_comm_value ) );
		}
	}




	function rtwwwap_add_two_way_custom_meta_box(){
		if( current_user_can( 'manage_options' ) )
		{
			$rtwwwap_commission_settings 	= get_option( 'rtwwwap_commission_settings_opt' );
			$rtwwwap_comm_base 	= isset( $rtwwwap_commission_settings[ 'two_way_comm' ] ) ? $rtwwwap_commission_settings[ 'two_way_comm' ] : '0';	
			if( $rtwwwap_comm_base == 1 )
			{
				add_meta_box( 'rtwwwap_two_way_custom_meta_box', esc_html__( 'Referee Commission Setting', 'rtwwwap-wp-wc-affiliate-program' ), array( $this, 'rtwwwap_two_way_custom_meta_box_show' ), 'download' );
			}
		}
	}
	function rtwwwap_two_way_custom_meta_box_show()
	{
		global $post;
		$rtwwwap_comm_type = get_post_meta( $post->ID, '_rtwwwap_cust_comm_type', true );
		$rtwwwap_comm_value = get_post_meta( $post->ID, '_rtwwwap_cust_comm_value', true );
		
		?>
		<div id='rtwwwap_affiliate_commission_tab' class='panel woocommerce_options_panel'>
			<div class='options_group'>
			
			<p class=" form-field _rtwwwap_cust_comm_type_field">
				<label for="_rtwwwap_cust_comm_type"><?php esc_html_e( 'Commission Type', 'rtwwwap-wp-wc-affiliate-program' )  ?></label>
					<select style="" id="_rtwwwap_cust_comm_type" name="_rtwwwap_cust_comm_type" class="select short" value="<?php echo esc_attr($rtwwwap_comm_type) ?>">
						<option value="fixed" <?php if($rtwwwap_comm_type == 'fixed'){ echo 'selected';} ?> ><?php esc_html_e( 'Fixed', 'rtwwwap-wp-wc-affiliate-program' )  ?></option>
						<option value="percentage" <?php if($rtwwwap_comm_type == 'percentage'){ echo 'selected';} ?>><?php esc_html_e( 'Percentage', 'rtwwwap-wp-wc-affiliate-program' )?></option>

					</select>
				<span class="description"><?php esc_html_e( 'Choose a commission type', 'rtwwwap-wp-wc-affiliate-program' )?></span>
			</p>

			<p class="form-field _rtwwwap_cust_comm_value_field ">
				<label for="_rtwwwap_cust_comm_value"><?php esc_html_e( 'Commission Amount', 'rtwwwap-wp-wc-affiliate-program' )?></label>
					<span ></span>
						<input type="number" class="short "  id="comm_box" style="" name="_rtwwwap_cust_comm_value" id="_rtwwwap_cust_comm_value" value ="<?php echo esc_attr($rtwwwap_comm_value) ?>"  placeholder="" step="any" min="0"> 
			</p>
			</div>
		</div>

		<?php

	}
	function rtwwwap_save_two_way_commission_fields( $post_id )
	{

		if(isset($_POST['_rtwwwap_cust_comm_type']) && $_POST['_rtwwwap_cust_comm_value'])
		{
			$rtwwwap_comm_type = sanitize_text_field( $_POST['_rtwwwap_cust_comm_type'] );
			if( ! empty( $rtwwwap_comm_type ) ) 
				{
					update_post_meta( $post_id, '_rtwwwap_cust_comm_type', esc_attr( $rtwwwap_comm_type ) );
				}

			$rtwwwap_comm_value = sanitize_text_field( $_POST['_rtwwwap_cust_comm_value'] );
			if( ! empty( $rtwwwap_comm_value ) ) 
				{
					update_post_meta( $post_id, '_rtwwwap_cust_comm_value', esc_attr( $rtwwwap_comm_value ) );
				}
		}
	}

}


