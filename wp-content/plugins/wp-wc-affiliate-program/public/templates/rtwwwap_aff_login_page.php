<?php 
	if ( ! defined( 'ABSPATH' ) ) {
	    exit; // Exit if accessed directly.
	}

	if( !is_user_logged_in() ){
		$rtwwwap_extra_features 	= get_option( 'rtwwwap_extra_features_opt' );
		$rtwwwap_signup_bonus_type 	= isset( $rtwwwap_extra_features[ 'signup_bonus_type' ] ) ? $rtwwwap_extra_features[ 'signup_bonus_type' ] : 0;

		$rtwwwap_reg_temp_features = get_option( 'rtwwwap_reg_temp_opt' );
		$rtwwwap_selected_template = isset( $rtwwwap_reg_temp_features[ 'register_page' ] ) ? $rtwwwap_reg_temp_features[ 'register_page' ] : 1;
		$rtwwwap_use_default_color_checked = isset( $rtwwwap_reg_temp_features[ 'temp_colors' ] ) ? $rtwwwap_reg_temp_features[ 'temp_colors' ] : 1;

		if( $rtwwwap_use_default_color_checked ){
			unset( $rtwwwap_reg_temp_features[ 'mainbg_color' ] );
			unset( $rtwwwap_reg_temp_features[ 'bg_color' ] );
			unset( $rtwwwap_reg_temp_features[ 'head_color' ] );
			unset( $rtwwwap_reg_temp_features[ 'button_color' ] );
		}
		
		if( $rtwwwap_selected_template == 1 ){
			$rtwwwap_html = '';
			
			if(isset($_GET['login_errors']) && !empty($_GET['login_errors']))
			{	
				$rtwwwap_html .= '<div id="login_error">' . apply_filters( 'login_errors', $_GET['login_errors'] ) . "</div>\n";
			}
			if(isset($_GET['success']) && !empty($_GET['success']))
			{	
				$rtwwwap_html .= '<div id="success">' .$_GET['success']. "</div>\n";
			}
			$rtwwwap_bg_color 		= isset( $rtwwwap_reg_temp_features[ 'bg_color' ] ) ? $rtwwwap_reg_temp_features[ 'bg_color' ] : '#EEEEEE';
			$rtwwwap_button_color 	= isset( $rtwwwap_reg_temp_features[ 'button_color' ] ) ? $rtwwwap_reg_temp_features[ 'button_color' ] : '#219595';
			$rtwwwap_form_custom_css= isset( $rtwwwap_reg_temp_features[ 'css' ] ) ? $rtwwwap_reg_temp_features[ 'css' ] : '';
			$rtwwwap_form_title 	= isset( $rtwwwap_reg_temp_features[ 'title' ] ) ? $rtwwwap_reg_temp_features[ 'title' ] : '';

			$rtwwwap_html .= 	'<style>';
			$rtwwwap_html .= 	'#login_error
								{
									max-width: 550px;
									margin-bottom: 20px;
									border-left: 4px solid #00a0d2;
									border-left-color: #dc3232;
									margin: 0 auto;
									padding: 12px;
									margin-bottom: 20px;
									background-color: #fff;
									box-shadow: 0 4px 38px 0 rgba(22,21,55,.06), 0 0 21px 0 rgba(22,21,55,.03);}';
			$rtwwwap_html .= 	'#success
									{
										max-width: 550px;
										margin-bottom: 20px;
										border-left: 4px solid #46B450;
										border-left-color: #46B450;
										margin: 0 auto;
										padding: 12px;
										margin-bottom: 20px;
										background-color: #fff;
										box-shadow: 0 4px 38px 0 rgba(22,21,55,.06), 0 0 21px 0 rgba(22,21,55,.03);}';						
			$rtwwwap_html .= 		'#rtwwwap-register-form{';
			$rtwwwap_html .= 			'border-color:'.$rtwwwap_bg_color.';';
			$rtwwwap_html .= 		'}';
			$rtwwwap_html .= 		'#rtwwwap-register-form form input[type="submit"]{';
			$rtwwwap_html .= 			'background-color:'.$rtwwwap_button_color.';';
			$rtwwwap_html .= 		'}';
			if( $rtwwwap_form_custom_css != '' ){
				$rtwwwap_html .= 	$rtwwwap_form_custom_css;
			}
			$rtwwwap_html .= 	'</style>';
			$rtwwwap_html .= 			'<div id="rtwwwap-register-form">';
			$rtwwwap_html .= 				'<div class="rtwwwap-title">';

			$rtwwwap_html .= 					'<h2>';
			if( $rtwwwap_form_title != '' ){
				$rtwwwap_html .= 					esc_html( $rtwwwap_form_title );
			}
			else{
				$rtwwwap_html .= 					esc_html__( "Login your Account", "rtwwwap-wp-wc-affiliate-program" );
			}
			$rtwwwap_html .= 					'</h2>';

			$rtwwwap_html .= 				'</div>';
			$rtwwwap_html .= 				'<form action="'.esc_url( site_url("wp-login.php", "login_post") ).'" method="post">';
			$rtwwwap_html .= 					'<div class="rtwwwap-text"><span class="rtwwwap-text-icon"><i class="far fa-user"></i></span><input type="text" name="log" placeholder="'.esc_attr__( "Username or Email Address", "rtwwwap-wp-wc-affiliate-program" ).'" id="log" class="input" required /></div>';

			$rtwwwap_html .= 					'<div class="rtwwwap-text"><span class="rtwwwap-text-icon"><i class="far fa-envelope"></i></span><input type="password" name="pwd" placeholder="'.esc_attr__( "Password", "rtwwwap-wp-wc-affiliate-program" ).'" id="pwd" class="input" required /></div>';

			if( $rtwwwap_signup_bonus_type == 1 ){
				$rtwwwap_html .= 				'<div class="rtwwwap-text"><span class="rtwwwap-text-icon"><i class="far fa-envelope"></i></span><input type="text" class="input-text" name="rtwwwap_referral_code_field" id="rtwwwap_referral_code_field" value="" placeholder="'.esc_attr__( "Referral Code", "rtwwwap-wp-wc-affiliate-program" ).'" /></div>';
			}
			$rtwwwap_html .= 					'<div><input type="submit" id="one" value="'.esc_attr__( "Login", "rtwwwap-wp-wc-affiliate-program" ).'" id="rtwwwap-Login" /></div>';
			$rtwwwap_html .=                	'<input type="hidden" value="'.esc_attr(remove_query_arg('login_errors',$_SERVER["REQUEST_URI"])).'" name="redirect_to">';
			$rtwwwap_html .=                	'<input type="hidden" name="user-cookie" value="1" />';
			$rtwwwap_html .= 				'</form>';
			$rtwwwap_html .= '</p>';
			$rtwwwap_html .= 		'</div>';
			
		}
		elseif( $rtwwwap_selected_template == 2 ){
			$rtwwwap_html = '';
			if(isset($_GET['login_errors']) && !empty($_GET['login_errors']))
			{
				$rtwwwap_html .= '<div id="login_error">' . apply_filters( 'login_errors', $_GET['login_errors'] ) . "</div>\n";
			}
			if(isset($_GET['success']) && !empty($_GET['success']))
			{	
				$rtwwwap_html .= '<div id="success">' .$_GET['success']. "</div>\n";
			}
			$rtwwwap_head_color 	= isset( $rtwwwap_reg_temp_features[ 'head_color' ] ) ? $rtwwwap_reg_temp_features[ 'head_color' ] : '#232055';
			$rtwwwap_button_color 	= isset( $rtwwwap_reg_temp_features[ 'button_color' ] ) ? $rtwwwap_reg_temp_features[ 'button_color' ] : '#232055';
			$rtwwwap_form_custom_css= isset( $rtwwwap_reg_temp_features[ 'css' ] ) ? $rtwwwap_reg_temp_features[ 'css' ] : '';
			$rtwwwap_form_title 	= isset( $rtwwwap_reg_temp_features[ 'title' ] ) ? $rtwwwap_reg_temp_features[ 'title' ] : '';

			$rtwwwap_html .= 	'<style>';
			$rtwwwap_html .= 	'#login_error
								{
									max-width: 550px;
									margin-bottom: 20px;
									border-left: 4px solid #00a0d2;
									border-left-color: #dc3232;
									margin: 0 auto;
									padding: 12px;
									margin-bottom: 20px;
									background-color: #fff;
									box-shadow: 0 4px 38px 0 rgba(22,21,55,.06), 0 0 21px 0 rgba(22,21,55,.03);}';
			$rtwwwap_html .= 	'#success
									{
										max-width: 550px;
										margin-bottom: 20px;
										border-left: 4px solid #46B450;
										border-left-color: #46B450;
										margin: 0 auto;
										padding: 12px;
										margin-bottom: 20px;
										background-color: #fff;
										box-shadow: 0 4px 38px 0 rgba(22,21,55,.06), 0 0 21px 0 rgba(22,21,55,.03);}';							
			$rtwwwap_html .= 		'.rtwwwap-form-wrapper form h2{';
			$rtwwwap_html .= 			'background-color:'.$rtwwwap_head_color.';';
			$rtwwwap_html .= 		'}';
			$rtwwwap_html .= 		'.rtwwwap-form-wrapper form input[type="submit"]{';
			$rtwwwap_html .= 			'background-color:'.$rtwwwap_button_color.';';
			$rtwwwap_html .= 		'}';
			if( $rtwwwap_form_custom_css != '' ){
				$rtwwwap_html .= 	$rtwwwap_form_custom_css;
			}
			$rtwwwap_html .= 	'</style>';

			$rtwwwap_html .= 	'<div class="rtwwwap-form-wrapper">';
			$rtwwwap_html .= 		'<form action="'.esc_url( site_url("wp-login.php", "login_post") ).'" method="post">';

			$rtwwwap_html .= 			'<h2>';
			if( $rtwwwap_form_title != '' ){
				$rtwwwap_html .= 			esc_html( $rtwwwap_form_title );
			}
			else{
				$rtwwwap_html .= 			esc_html__( "Login Form", "rtwwwap-wp-wc-affiliate-program" );
			}
			$rtwwwap_html .= 			'</h2>';

			$rtwwwap_html .= 			'<div class="rtwwwap-text"><span class="rtwwwap-text-icon"><i class="far fa-user"></i></span><input type="text" name="log" placeholder="'.esc_attr__( "Username or Email Address", "rtwwwap-wp-wc-affiliate-program" ).'" required /></div>';
			$rtwwwap_html .= 			'<div class="rtwwwap-text"><span class="rtwwwap-text-icon"><i class="far fa-envelope"></i></span><input type="password" name="pwd" placeholder="'.esc_attr__( "Password", "rtwwwap-wp-wc-affiliate-program" ).'" required ></div>';

			$rtwwwap_html .= 			'<div><input type="submit" value="'.esc_attr__( "Login", "rtwwwap-wp-wc-affiliate-program" ).'" id="rtwwwap-Login"></div>';
			$rtwwwap_html .=                	'<input type="hidden" value="'.esc_attr(remove_query_arg('login_errors',$_SERVER["REQUEST_URI"])).'" name="redirect_to">';
			$rtwwwap_html .=                	'<input type="hidden" name="user-cookie" value="1" />';
			$rtwwwap_html .= 				'</form>';
					
			$rtwwwap_html .= 	'</div>';
		}
		elseif( $rtwwwap_selected_template == 3 ){
			$rtwwwap_html = '';
			if(isset($_GET['login_errors']) && !empty($_GET['login_errors']))
			{
				$rtwwwap_html .= '<div id="login_error">' . apply_filters( 'login_errors', $_GET['login_errors'] ) . "</div>\n";
			}
			if(isset($_GET['success']) && !empty($_GET['success']))
			{	
				$rtwwwap_html .= '<div id="success">' .$_GET['success']. "</div>\n";
			}
			$rtwwwap_button_color 	= isset( $rtwwwap_reg_temp_features[ 'button_color' ] ) ? $rtwwwap_reg_temp_features[ 'button_color' ] : '#0150C9';
			$rtwwwap_form_custom_css= isset( $rtwwwap_reg_temp_features[ 'css' ] ) ? $rtwwwap_reg_temp_features[ 'css' ] : '';
			$rtwwwap_form_title 	= isset( $rtwwwap_reg_temp_features[ 'title' ] ) ? $rtwwwap_reg_temp_features[ 'title' ] : '';

			$rtwwwap_html .= 	'<style>';
			$rtwwwap_html .= 		'.rtwwwap-form-wrapper-2 form input[type="submit"]{';
			$rtwwwap_html .= 			'background-color:'.$rtwwwap_button_color.';';
			$rtwwwap_html .= 		'}';
			$rtwwwap_html .= 	'#login_error
								{
									max-width: 550px;
									margin-bottom: 20px;
									border-left: 4px solid #00a0d2;
									border-left-color: #dc3232;
									margin: 0 auto;
									padding: 12px;
									margin-bottom: 20px;
									background-color: #fff;
									box-shadow: 0 4px 38px 0 rgba(22,21,55,.06), 0 0 21px 0 rgba(22,21,55,.03);}';
			$rtwwwap_html .= 	'#success
									{
										max-width: 550px;
										margin-bottom: 20px;
										border-left: 4px solid #46B450;
										border-left-color: #46B450;
										margin: 0 auto;
										padding: 12px;
										margin-bottom: 20px;
										background-color: #fff;
										box-shadow: 0 4px 38px 0 rgba(22,21,55,.06), 0 0 21px 0 rgba(22,21,55,.03);}';	
									if( $rtwwwap_form_custom_css != '' ){
				$rtwwwap_html .= 	$rtwwwap_form_custom_css;
			}
			$rtwwwap_html .= 	'</style>';
		
			$rtwwwap_html .= 	'<div class="rtwwwap-form-wrapper-2">';
			$rtwwwap_html .= 		'<div class="rtwwwap-form-inner">';
			$rtwwwap_html .= 			'<div class="rtwwwap-form-image" style="background-image: url('.RTWWWAP_URL."assets/images/rtw-form-banner.jpg".');">';
			
			$rtwwwap_html .= 				'<h2>';
			if( $rtwwwap_form_title != '' ){
				$rtwwwap_html .= 				esc_html( $rtwwwap_form_title );
			}
			else{
				$rtwwwap_html .= 				esc_html__( "Login", "rtwwwap-wp-wc-affiliate-program" );
			}
			$rtwwwap_html .= 				'</h2>';

			$rtwwwap_html .= 			'</div>';
			$rtwwwap_html .= 			'<div class="rtwwwap-form-content">';
			$rtwwwap_html .= 				'<form action="'.esc_url( site_url("wp-login.php", "login_post") ).'" method="post">';
			$rtwwwap_html .= 					'<label>'.esc_html__( "Username or Email Address", "rtwwwap-wp-wc-affiliate-program" ).'</label>';
		    $rtwwwap_html .= 					'<div class="rtwwwap-text"><span class="rtwwwap-text-icon"><i class="far fa-user"></i></span><input type="text" name="log" placeholder="'.esc_attr__( "Username or Email Address", "rtwwwap-wp-wc-affiliate-program" ).'" required ></div>';
		  	$rtwwwap_html .= 					'<label>'.esc_html__( "Password", "rtwwwap-wp-wc-affiliate-program" ).'</label>';
		    $rtwwwap_html .= 					'<div class="rtwwwap-text"><span class="rtwwwap-text-icon"><i class="far fa-envelope"></i></span><input type="password" name="pwd" placeholder="'.esc_attr__( "Password", "rtwwwap-wp-wc-affiliate-program" ).'" required ></div>';
			$rtwwwap_html .= 					'<div><input type="submit" value="'.esc_attr__( "Login", "rtwwwap-wp-wc-affiliate-program" ).'" id="rtwwwap-Login"></div>';
			$rtwwwap_html .=                	'<input type="hidden" value="'.esc_attr(remove_query_arg('login_errors',$_SERVER["REQUEST_URI"])).'" name="redirect_to">';
			$rtwwwap_html .=                	'<input type="hidden" name="user-cookie" value="1" />';
			$rtwwwap_html .= 				'</form>';
			$rtwwwap_html .= 			'</div>';
			$rtwwwap_html .= 		'</div>';
			$rtwwwap_html .= 	'</div>';
		}
		elseif( $rtwwwap_selected_template == 4 ){
			$rtwwwap_html = '';
			if(isset($_GET['login_errors']) && !empty($_GET['login_errors']))
			{
				$rtwwwap_html .= '<div id="login_error">' . apply_filters( 'login_errors', $_GET['login_errors'] ) . "</div>\n";
			}
			if(isset($_GET['success']) && !empty($_GET['success']))
			{	
				$rtwwwap_html .= '<div id="success">' .$_GET['success']. "</div>\n";
			}

			$rtwwwap_mainbg_color 	= isset( $rtwwwap_reg_temp_features[ 'mainbg_color' ] ) ? $rtwwwap_reg_temp_features[ 'mainbg_color' ] : '#E85A26';
			$rtwwwap_bg_color 		= isset( $rtwwwap_reg_temp_features[ 'bg_color' ] ) ? $rtwwwap_reg_temp_features[ 'bg_color' ] : '#DADAF2';
			$rtwwwap_button_color 	= isset( $rtwwwap_reg_temp_features[ 'button_color' ] ) ? $rtwwwap_reg_temp_features[ 'button_color' ] : '#E85A26';
			$rtwwwap_form_custom_css= isset( $rtwwwap_reg_temp_features[ 'css' ] ) ? $rtwwwap_reg_temp_features[ 'css' ] : '';
			$rtwwwap_form_title 	= isset( $rtwwwap_reg_temp_features[ 'title' ] ) ? $rtwwwap_reg_temp_features[ 'title' ] : '';

			$rtwwwap_html .= 	'<style>';
			$rtwwwap_html .= 	'#login_error
								{
									max-width: 550px;
									margin-bottom: 20px;
									border-left: 4px solid #00a0d2;
									border-left-color: #dc3232;
									margin: 0 auto;
									padding: 12px;
									margin-bottom: 20px;
									background-color: #fff;
									box-shadow: 0 4px 38px 0 rgba(22,21,55,.06), 0 0 21px 0 rgba(22,21,55,.03);}';
		    $rtwwwap_html .= 	'#success
									{
										max-width: 550px;
										margin-bottom: 20px;
										border-left: 4px solid #46B450;
										border-left-color: #46B450;
										margin: 0 auto;
										padding: 12px;
										margin-bottom: 20px;
										background-color: #fff;
										box-shadow: 0 4px 38px 0 rgba(22,21,55,.06), 0 0 21px 0 rgba(22,21,55,.03);}';	
			$rtwwwap_html .= 		'.rtwwwap-form-wrapper-3{';
			$rtwwwap_html .= 			'background-color:'.$rtwwwap_mainbg_color.';';
			$rtwwwap_html .= 		'}';
			$rtwwwap_html .= 		'.rtwwwap-form-wrapper-3 .rtwwwap-form-content{';
			$rtwwwap_html .= 			'background-color:'.$rtwwwap_bg_color.';';
			$rtwwwap_html .= 		'}';
			$rtwwwap_html .= 		'.rtwwwap-form-wrapper-3 form input[type="submit"]{';
			$rtwwwap_html .= 			'background-color:'.$rtwwwap_button_color.';';
			$rtwwwap_html .= 		'}';
			if( $rtwwwap_form_custom_css != '' ){
				$rtwwwap_html .= 	$rtwwwap_form_custom_css;
			}
			$rtwwwap_html .= 	'</style>';

			$rtwwwap_html .= 	'<div class="rtwwwap-form-wrapper-3">';
			$rtwwwap_html .= 		'<div class="rtwwwap-form-inner">';
			$rtwwwap_html .= 			'<div class="rtwwwap-form-content">';
			$rtwwwap_html .= 				'<form action="'.esc_url( site_url("wp-login.php", "login_post") ).'" method="post">';

			$rtwwwap_html .= 					'<h2>';
			if( $rtwwwap_form_title != '' ){
				$rtwwwap_html .= 					esc_html( $rtwwwap_form_title );
			}
			else{
				$rtwwwap_html .= 					esc_html__( "Login", "rtwwwap-wp-wc-affiliate-program" );
			}
			$rtwwwap_html .= 					'</h2>';

			$rtwwwap_html .= 					'<label>'.esc_html__( "Username or Email Address", "rtwwwap-wp-wc-affiliate-program" ).'</label>';
		    $rtwwwap_html .= 					'<div class="rtwwwap-text"><span class="rtwwwap-text-icon"><i class="far fa-user"></i></span><input type="text" name="log" placeholder="'.esc_attr__( "Username or Email Address", "rtwwwap-wp-wc-affiliate-program" ).'" required ></div>';
		  	$rtwwwap_html .= 					'<label>'.esc_html__( "Password", "rtwwwap-wp-wc-affiliate-program" ).'</label>';
		    $rtwwwap_html .= 					'<div class="rtwwwap-text"><span class="rtwwwap-text-icon"><i class="far fa-envelope"></i></span><input type="password" name="pwd" placeholder="'.esc_attr__( "Password", "rtwwwap-wp-wc-affiliate-program" ).'" required></div>';
			$rtwwwap_html .= 					'<div><input type="submit" value="'.esc_attr__( "Login", "rtwwwap-wp-wc-affiliate-program" ).'" id="rtwwwap-Login"></div>';
			
			$rtwwwap_html .=                	'<input type="hidden" value="'.esc_attr(remove_query_arg('login_errors',$_SERVER["REQUEST_URI"])).'" name="redirect_to">';
			$rtwwwap_html .=                	'<input type="hidden" name="user-cookie" value="1" />';
			$rtwwwap_html .= 				'</form>';
			$rtwwwap_html .= 			'</div>';
			$rtwwwap_html .= 		'</div>';
			$rtwwwap_html .= 	'</div>';
		}

		return $rtwwwap_html;
	}
	else{
		$rtwwwap_html = do_shortcode( '[rtwwwap_affiliate_page]' );
		return $rtwwwap_html;
	}
	





?>