<?php
	if ( ! defined( 'ABSPATH' ) ) {
	    exit; // Exit if accessed directly.
	}

	$rtwwwap_html 			= '';
	$rtwwwap_is_affiliate 	= false;
	$rtwwwap_user_id 		= get_current_user_id();
	

	if(!is_user_logged_in())
	{
		
		if(isset($_GET['action']) && !empty($_GET['action']) )
		{
			if( (($_GET['action'] == 'rp') || ($_GET['action'] == 'resetpass')) && !empty($_GET['action']))
				{
					$rtwwwap_html .= "<div id='rtwwwap_aff_not_login'>";
					$rtwwwap_html .= 	"<div id='rtwwwap_reset_password_page'>";
					$rtwwwap_html .=		do_shortcode('[rtwwwap_aff_reset_password]');
					$rtwwwap_html .=	"</div>";
					$rtwwwap_html .= "</div>";
				}
		}
		else 
		{
			$rtwwwap_html .= "<div id='rtwwwap_aff_not_login'>";
			$rtwwwap_html .= 	"<div id='rtwwwap_aff_page_login'>";
			$rtwwwap_html .=		do_shortcode('[rtwwwap_aff_login_page]');
			$rtwwwap_html .=	"</div>";
			$rtwwwap_html .= 	"<div id='rtwwwap_aff_page_reg'>";
			$rtwwwap_html .=		do_shortcode('[rtwwwap_aff_reg_page]');
			$rtwwwap_html .=	"</div>";
			$rtwwwap_html .= "</div>";
		}
	}


	
	$rtwwwap_extra_features = get_option( 'rtwwwap_extra_features_opt' );

	$rtwwwap_css = isset( $rtwwwap_extra_features[ 'css' ] ) ? $rtwwwap_extra_features[ 'css' ] : '';
	if( $rtwwwap_css ){
		$rtwwwap_html .= '<style>';
		$rtwwwap_html .= 	$rtwwwap_css;
		$rtwwwap_html .= '</style>';
	}
	if(is_user_logged_in()){

	
		
			if( $rtwwwap_user_id ){
				$rtwwwap_ask_aff_approval 	= isset( $rtwwwap_extra_features[ 'aff_verify' ] ) ? $rtwwwap_extra_features[ 'aff_verify' ] : 0;
				$rtwwwap_is_aff_approved 	= ( $rtwwwap_ask_aff_approval ) ? get_user_meta( $rtwwwap_user_id, 'rtwwwap_aff_approved', true ) : 1;
				$rtwwwap_is_affiliate 		= get_user_meta( $rtwwwap_user_id, 'rtwwwap_affiliate', true );
			}

			$rtwwwap_html .= 	'<div id="rtwwwap_main_container">';
			if( $rtwwwap_is_affiliate && !$rtwwwap_is_aff_approved ){
				$rtwwwap_html .= 	'<div id="rtwwwap_not_approved">';
				$rtwwwap_html .=	 esc_html__( 'Not approved yet', 'rtwwwap-wp-wc-affiliate-program' );
				$rtwwwap_html .=	'</div>';
			}
			elseif( !$rtwwwap_is_affiliate ){

				
				$rtwwwap_become_button 		= isset( $rtwwwap_extra_features[ 'become_title' ] ) ? $rtwwwap_extra_features[ 'become_title' ] : esc_html__( 'Become an Affiliate', 'rtwwwap-wp-wc-affiliate-program' );
				
				if($rtwwwap_extra_features[ 'become_title' ] != '' )
				{
					$rtwwwap_become_text 		= $rtwwwap_become_button;
					
				}
				else
				{
					$rtwwwap_become_text  =  esc_html__( 'Become an Affiliate', 'rtwwwap-wp-wc-affiliate-program' );
				}
				$rtwwwap_default_benefits 	= sprintf( "<ul><li>%s</li><li>%s</li><li>%s</li></ul>", esc_html__( 'Earn extra money just by marketing our products with our affiliate tools', 'rtwwwap-wp-wc-affiliate-program' ), esc_html__( 'Earn wallet amount to buy products on our site', 'rtwwwap-wp-wc-affiliate-program' ), esc_html__( 'Signup Bonus when someone signup from your shared link', 'rtwwwap-wp-wc-affiliate-program' ) );

				$rtwwwap_benefits 			= isset( $rtwwwap_extra_features[ 'aff_benefits' ] ) ? $rtwwwap_extra_features[ 'aff_benefits' ] : $rtwwwap_default_benefits;

				$rtwwwap_html .= 	'<div id="rtwwwap_not_affiliate">';
				$rtwwwap_html .=		'<div id="rtwwwap_become_affiliate">';
				
				$rtwwwap_html .=		'<input id="rtwwwap_affiliate_activate" type="button" name="" value="'.esc_attr( $rtwwwap_become_text ).'" data-rtwwwap_num="'.$rtwwwap_user_id.'" />';

				$rtwwwap_benefits_title = isset( $rtwwwap_extra_features[ 'benefits_title' ] ) ? $rtwwwap_extra_features[ 'benefits_title' ] : esc_html__( 'Benefits of becoming our Affiliate', 'rtwwwap-wp-wc-affiliate-program' );

				$rtwwwap_html .=		'</div>';
				$rtwwwap_html .=		'<br>';
				$rtwwwap_html .=		'<hr>';
				$rtwwwap_html .=		'<h3>';
				$rtwwwap_html .=			$rtwwwap_benefits_title;
				$rtwwwap_html .=		'</h3>';
				$rtwwwap_html .=		'<div id="rtwwwap_benefits">'.$rtwwwap_benefits.'</div>';
				$rtwwwap_html .=	'</div>';
			}
			else{
				$rtwwwap_html1 = include( RTWWWAP_DIR.'public/templates/rtwwwap_affiliate_body.php' );

				$rtwwwap_mlm = get_option( 'rtwwwap_mlm_opt' );

				$rtwwwap_overview_active 			= '';
				$rtwwwap_commissions_active 		= '';
				$rtwwwap_affiliate_tools_active 	= '';
				$rtwwwap_download_active 			= '';
				$rtwwwap_payout_active 				= '';
				$rtwwwap_profile_active 			= '';
				$rtwwwap_mlm_active 				= '';

				if( isset( $_GET[ 'rtwwwap_tab' ] ) )
				{
					if( $_GET[ 'rtwwwap_tab' ] == "overview" )
					{
						$rtwwwap_overview_active = "current-menu-item";
					}
					elseif( $_GET[ 'rtwwwap_tab' ] == "commissions" )
					{
						$rtwwwap_commissions_active = "current-menu-item";
					}
					elseif( $_GET[ 'rtwwwap_tab' ] == "affiliate_tools" )
					{
						$rtwwwap_affiliate_tools_active = "current-menu-item";
					}
					elseif( $_GET[ 'rtwwwap_tab' ] == "download" )
					{
						$rtwwwap_download_active = "current-menu-item";
					}
					elseif( $_GET[ 'rtwwwap_tab' ] == "payout" )
					{
						$rtwwwap_payout_active = "current-menu-item";
					}elseif( $_GET[ 'rtwwwap_tab' ] == "profile" )
					{
						$rtwwwap_profile_active = "current-menu-item";
					}elseif( $_GET[ 'rtwwwap_tab' ] == "mlm" )
					{
						$rtwwwap_mlm_active = "current-menu-item";
					}
				}
				else
				{
					$rtwwwap_overview_active = "current-menu-item";
				}

				$rtwwwap_overview_url		= get_page_link().'?rtwwwap_tab=overview';
				$rtwwwap_commissions_url	= get_page_link().'?rtwwwap_tab=commissions';
				$rtwwwap_affiliate_tools_url= get_page_link().'?rtwwwap_tab=affiliate_tools';
				$rtwwwap_download_url		= get_page_link().'?rtwwwap_tab=download';
				$rtwwwap_payout_url			= get_page_link().'?rtwwwap_tab=payout';
				$rtwwwap_profile_url		= get_page_link().'?rtwwwap_tab=profile';
				$rtwwwap_mlm_url			= get_page_link().'?rtwwwap_tab=mlm';
				$rtwwwap_overview_label = isset($rtwwwap_extra_features['affiliate_dash_overview']) && !empty($rtwwwap_extra_features['affiliate_dash_overview']) ? $rtwwwap_extra_features['affiliate_dash_overview'] : 'Overview';
				$rtwwwap_commission_label = isset($rtwwwap_extra_features['affiliate_dash_commission']) && !empty($rtwwwap_extra_features['affiliate_dash_commission']) ? $rtwwwap_extra_features['affiliate_dash_commission'] : 'Commissions';
				$rtwwwap_tools_label = isset($rtwwwap_extra_features['affiliate_dash_tools']) && !empty($rtwwwap_extra_features['affiliate_dash_tools']) ? $rtwwwap_extra_features['affiliate_dash_tools'] : 'Affilate Tools';
				$rtwwwap_download_label = isset($rtwwwap_extra_features['affiliate_dash_download']) && !empty($rtwwwap_extra_features['affiliate_dash_download']) ? $rtwwwap_extra_features['affiliate_dash_download'] : 'Download';
				$rtwwwap_payout_label = isset($rtwwwap_extra_features['affiliate_dash_payout']) && !empty($rtwwwap_extra_features['affiliate_dash_payout']) ? $rtwwwap_extra_features['affiliate_dash_payout'] : 'Payout';
				$rtwwwap_profile_label = isset($rtwwwap_extra_features['affiliate_dash_profile']) && !empty($rtwwwap_extra_features['affiliate_dash_profile']) ? $rtwwwap_extra_features['affiliate_dash_profile'] : 'Profile';

				$rtwwwap_html .=	'<div id="rtwwwap_is_affiliate">';
				$rtwwwap_html .=		'<div id="rtwwwap_affiliate_menu">';
				$rtwwwap_html .=			'<nav class="rtwwwap_main_navigation">';
				$rtwwwap_html .=			'<ul class="rtwwwap_menu">';
				$rtwwwap_html .=				'<li class="'.$rtwwwap_overview_active.'">';
				$rtwwwap_html .=					'<a class="rtwwwap_nav_tab" href="'.esc_url( $rtwwwap_overview_url ).'">';
				$rtwwwap_html .=						esc_html__( $rtwwwap_overview_label, 'rtwwwap-wp-wc-affiliate-program' );
				$rtwwwap_html .=					'</a>';
				$rtwwwap_html .=				'</li>';
				$rtwwwap_html .=				'<li class="'.$rtwwwap_commissions_active.'">';
				$rtwwwap_html .=					'<a class="rtwwwap_nav_tab" href="'.esc_url( $rtwwwap_commissions_url ).'">';
				$rtwwwap_html .=						esc_html__( $rtwwwap_commission_label, 'rtwwwap-wp-wc-affiliate-program' );
				$rtwwwap_html .=					'</a>';
				$rtwwwap_html .=				'</li>';
				$rtwwwap_html .=				'<li class="'.$rtwwwap_affiliate_tools_active.'">';
				$rtwwwap_html .=					'<a class="rtwwwap_nav_tab" href="'.esc_url( $rtwwwap_affiliate_tools_url ).'">';
				$rtwwwap_html .=						esc_html__( $rtwwwap_tools_label, 'rtwwwap-wp-wc-affiliate-program' );
				$rtwwwap_html .=					'</a>';
				$rtwwwap_html .=				'</li>';
				$rtwwwap_html .=				'<li class="'.$rtwwwap_download_active.'">';
				$rtwwwap_html .=					'<a class="rtwwwap_nav_tab" href="'.esc_url( $rtwwwap_download_url ).'">';
				$rtwwwap_html .=						esc_html__( $rtwwwap_download_label, 'rtwwwap-wp-wc-affiliate-program' );
				$rtwwwap_html .=					'</a>';
				$rtwwwap_html .=				'</li>';
				$rtwwwap_html .=				'<li class="'.$rtwwwap_payout_active.'">';
				$rtwwwap_html .=					'<a class="rtwwwap_nav_tab" href="'.esc_url( $rtwwwap_payout_url ).'">';
				$rtwwwap_html .=						esc_html__( $rtwwwap_payout_label, 'rtwwwap-wp-wc-affiliate-program' );
				$rtwwwap_html .=					'</a>';
				$rtwwwap_html .=				'</li>';
				$rtwwwap_html .=				'<li class="'.$rtwwwap_profile_active.'">';
				$rtwwwap_html .=					'<a class="rtwwwap_nav_tab" href="'.esc_url( $rtwwwap_profile_url ).'">';
				$rtwwwap_html .=						esc_html__( $rtwwwap_profile_label, 'rtwwwap-wp-wc-affiliate-program' );	
				$rtwwwap_html .=					'</a>';
				$rtwwwap_html .=				'</li>';
				if( isset( $rtwwwap_mlm[ 'activate' ] ) && $rtwwwap_mlm[ 'activate' ] == 1 ){
					$rtwwwap_html .=				'<li class="'.$rtwwwap_mlm_active.'">';
					$rtwwwap_html .=					'<a class="rtwwwap_nav_tab" href="'.esc_url( $rtwwwap_mlm_url ).'">';
					$rtwwwap_html .=						esc_html__( 'MLM', 'rtwwwap-wp-wc-affiliate-program' );
					$rtwwwap_html .=					'</a>';
					$rtwwwap_html .=				'</li>';
				}
				$rtwwwap_html .=			'</ul>';
				$rtwwwap_html .=			'</nav>';
				$rtwwwap_html .=		'</div>';
				$rtwwwap_html .=		'<div id="rtwwwap_affiliate_body">';
				$rtwwwap_html .=			$rtwwwap_html1;
				$rtwwwap_html .=		'</div>';
				$rtwwwap_html .=	'</div>';
			}
			$rtwwwap_html .= 	'</div>';
	}
		return $rtwwwap_html;

