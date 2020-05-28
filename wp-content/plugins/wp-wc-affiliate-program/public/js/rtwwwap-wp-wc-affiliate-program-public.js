(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */
    $(function(){
        $(document).find( '.rtwwwap_select_cat' ).select2({ width: '50%' });
        $(document).find( '.rtwwwap_payment_method' ).select2({ width: '40%' });

        $(document).find( '#rtwwwap_coupons_table, #rtwwwap_referrals_table' ).DataTable({
            "pageLength": 5,
            "lengthMenu": [ [5, 10, 25, 50, -1], [5, 10, 25, 100, "All"] ],
            "searching" : false
        });

        $(document).find( '#rtwwwap_requests_table' ).DataTable({
            "pageLength": 5,
            "lengthMenu": [ [5, 10, 25, 50, -1], [5, 10, 25, 100, "All"] ],
            "searching" : false
        });

    	$(document).on( 'click', '#rtwwwap_affiliate_activate', function(){
    		var rtwwwap_user_id = $(this).data( 'rtwwwap_num' );

    		var rtwwwap_data = {
     			action 	               : 'rtwwwap_become_affiliate',
     			rtwwwap_user_id        : rtwwwap_user_id,
     			rtwwwap_security_check : rtwwwap_global_params.rtwwwap_nonce
     		};

            $.blockUI({ message: '' });
    		$.ajax({
     			url 		: rtwwwap_global_params.rtwwwap_ajaxurl,
     			type 		: "POST",
     			data 		: rtwwwap_data,
     			dataType 	: 'json',
     			success 	: function(response)
     			{
     				if( response.rtwwwap_status ){
     					alert( response.rtwwwap_message );
                        window.location.reload();
     				}
                    else{
                        alert( response.rtwwwap_message );
                        window.location.reload();
                    }
                    $.unblockUI();
     			}
     		});
     	});

     	$(document).on( 'click', '#rtwwwap_generate_button', function(){
        	var rtwwwap_url = $(document).find( '#rtwwwap_aff_link_input' ).val();

            if( rtwwwap_url != '' && rtwwwap_url.startsWith( rtwwwap_global_params.rtwwwap_home_url ) ){
    	    	var rtwwwap_aff_id        = $(this).data( 'rtwwwap_aff_id' );
    	    	var rtwwwap_aff_name      = $(this).data( 'rtwwwap_aff_name' );
    	    	var rtwwwap_generated_url = '';
                var rtwwwap_generated_url_share = '';

    	    	if( rtwwwap_url.indexOf( '?' ) > 0 ){
    	    		rtwwwap_generated_url        = rtwwwap_url+'&rtwwwap_aff='+rtwwwap_aff_name+'_'+rtwwwap_aff_id;
                    rtwwwap_generated_url_share  = rtwwwap_url+'&rtwwwap_aff='+rtwwwap_aff_name+'_'+rtwwwap_aff_id+'_share';
    	    	}
    	    	else{
    	    		rtwwwap_generated_url        = rtwwwap_url+'?rtwwwap_aff='+rtwwwap_aff_name+'_'+rtwwwap_aff_id;
                    rtwwwap_generated_url_share  = rtwwwap_url+'?rtwwwap_aff='+rtwwwap_aff_name+'_'+rtwwwap_aff_id+'_share';
    	    	}

    	    	$(document).find( '#rtwwwap_generated_link' ).text( rtwwwap_generated_url ).css({ 'visibility' : 'visible' });
    	    	$(document).find( '#rtwwwap_copy_to_clip, #rtwwwap_generate_qr, .rtwwwap_download_qr' ).css({ 'visibility' : 'visible' });

                $(document).find( '.rtwwwap_twitter' ).attr( 'href', rtwwwap_global_params.rtwwwap_twitter_url+rtwwwap_generated_url_share );
                $(document).find( '.rtwwwap_twitter' ).attr( 'target', '_blank' );

                $(document).find( '.rtwwwap_fb_share' ).attr( 'href', rtwwwap_global_params.rtwwwap_fb_url+rtwwwap_generated_url_share );
                $(document).find( '.rtwwwap_fb_share' ).attr( 'target', '_blank' );

                $(document).find( '.rtwwwap_whatsapp_share' ).attr( 'href', rtwwwap_global_params.rtwwwap_whatsapp_url+encodeURIComponent( rtwwwap_generated_url_share ) );
                $(document).find( '.rtwwwap_whatsapp_share' ).attr( 'target', '_blank' );

                $(document).find( '.rtwwwap_mail_button' ).attr( 'href', rtwwwap_global_params.rtwwwap_mail_url+rtwwwap_generated_url_share );

                $(document).find( '.rtwwwap_social_share' ).css( 'display', 'flex' );

                $(document).find( '#rtwwwap_qrcode_main' ).hide();
            }
            else{
                alert( rtwwwap_global_params.rtwwwap_enter_valid_url )
            }
        });

        $(document).on( 'click', '#rtwwwap_copy_to_clip', function(){
        	var $rtwwwap_temp = $("<input>");
    	  	$( "body" ).append( $rtwwwap_temp );
    	  	$rtwwwap_temp.val( $( '#rtwwwap_generated_link' ).text() ).select();
    	  	document.execCommand( "copy" );
      		$rtwwwap_temp.remove();

            $(document).find( '#rtwwwap_copy_tooltip_link' ).css( { 'visibility' : 'visible', 'opacity' : 1  } );
            setTimeout( function(){
                $(document).find( '#rtwwwap_copy_tooltip_link' ).css( { 'visibility' : 'hidden', 'opacity' : 0  } );
            }, 2000 );
        });

        $(document).on( 'click', '#rtwwwap_copy_to_clip_mlm', function(){
            var $rtwwwap_temp = $("<input>");
            $( "body" ).append( $rtwwwap_temp );
            $rtwwwap_temp.val( $( '#rtwwwap_aff_link_input' ).val() ).select();
            document.execCommand( "copy" );
            $rtwwwap_temp.remove();

            $(document).find( '#rtwwwap_copy_tooltip_link' ).css( { 'visibility' : 'visible', 'opacity' : 1  } );
            setTimeout( function(){
                $(document).find( '#rtwwwap_copy_tooltip_link' ).css( { 'visibility' : 'hidden', 'opacity' : 0  } );
            }, 2000 );
        });

        $(document).on( 'click', '#rtwwwap_search_button', function(){
        	var rtwwwap_prod_name  = $(document).find( '#rtwwwap_banner_prod_search' ).val();
        	var rtwwwap_cat_id 	   = $(document).find( '.rtwwwap_select_cat' ).val();

        	var rtwwwap_data = {
     			action                  : 'rtwwwap_search_prod',
     			rtwwwap_prod_name       : rtwwwap_prod_name,
     			rtwwwap_cat_id          : rtwwwap_cat_id,
     			rtwwwap_security_check  : rtwwwap_global_params.rtwwwap_nonce
     		};

            $.blockUI({ message: '' });
    		$.ajax({
     			url 		: rtwwwap_global_params.rtwwwap_ajaxurl,
     			type 		: "POST",
     			data 		: rtwwwap_data,
     			dataType 	: 'json',
     			success 	: function(response)
     			{
     				if( response.rtwwwap_products == '' ){
     					alert( response.rtwwwap_message );
     				}
     				else{
     					$(document).find( '#rtwwwap_search_main_container' ).html('');
     					$(document).find( '#rtwwwap_search_main_container' ).append( response.rtwwwap_products );
     				}
                    $.unblockUI();
     			}
     		});
        });

        $(document).on( 'click', '#rtwwwap_create_link', function(){
        	var rtwwwap_prod_url = $(this).closest( 'p' ).data( 'rtwwwap_url' );
        	$(document).find( '#rtwwwap_aff_link_input' ).val( rtwwwap_prod_url );
        	$(document).find( '#rtwwwap_generate_button' ).trigger( 'click' );
        	$( 'html, body' ).animate({
    	        scrollTop: $( "#rtwwwap_affiliates" ).offset().top
    	    }, 200);
        });

        $(document).on( 'click', 'body', function (e) {
            if ( !$(e.target).is( "#rtwwwap_txtPicker, #rtwwwap_linkPicker, #rtwwwap_bgPicker, .iris-picker, .iris-picker-inner, .iris-palette-container" ) )
            {
            	if( $(document).find( '#rtwwwap_txtPicker' ).siblings( '.iris-picker' ).css( 'display' ) == 'block' || $(document).find( '#rtwwwap_linkPicker' ).siblings( '.iris-picker' ).css( 'display' ) == 'block' || $(document).find( ' #rtwwwap_bgPicker' ).siblings( '.iris-picker' ).css( 'display' ) == 'block' )
            	{
    	            $( '#rtwwwap_txtPicker, #rtwwwap_linkPicker, #rtwwwap_bgPicker' ).iris( 'hide' );
    	            return false;
    	        }
            }
        });

        $(document).on( 'click', '#rtwwwap_txtPicker, #rtwwwap_linkPicker, #rtwwwap_bgPicker', function (event) {
            $(this).iris('hide');
            $(this).iris('show');
            return false;
        });

        $(document).on( 'click', '#rtwwwap_create_banner', function(){
        	var rtwwwap_prod_id           = $(this).closest( 'p' ).data( 'rtwwwap_id' );
        	var rtwwwap_prod_url          = $(this).closest( 'p' ).data( 'rtwwwap_url' );
        	var rtwwwap_prod_name         = $(this).closest( 'p' ).data( 'rtwwwap_title' );
        	var rtwwwap_prod_img 		  = $(this).closest( 'p' ).data( 'rtwwwap_image' );
            var rtwwwap_prod_display_price= $(this).closest( 'p' ).data( 'rtwwwap_displayprice' );

        	var rtwwwap_text_lang 	  = rtwwwap_global_params.rtwwwap_text_color;
        	var rtwwwap_link_lang 	  = rtwwwap_global_params.rtwwwap_link_color;
        	var rtwwwap_bg_lang       = rtwwwap_global_params.rtwwwap_background_color;
        	var rtwwwap_price_lang    = rtwwwap_global_params.rtwwwap_show_price;
        	var rtwwwap_border_lang   = rtwwwap_global_params.rtwwwap_border_color;

        	if( rtwwwap_prod_url != '' ){
    	    	var rtwwwap_aff_id 		  = $(document).find( '#rtwwwap_generate_button' ).data( 'rtwwwap_aff_id' );
    	    	var rtwwwap_aff_name      = $(document).find( '#rtwwwap_generate_button' ).data( 'rtwwwap_aff_name' );
    	    	var rtwwwap_generated_url = '';

    	    	if( rtwwwap_prod_url.indexOf( '?' ) > 0 ){
    	    		rtwwwap_generated_url = rtwwwap_prod_url+'&rtwwwap_aff='+rtwwwap_aff_name+'_'+rtwwwap_aff_id;
    	    	}
    	    	else{
    	    		rtwwwap_generated_url = rtwwwap_prod_url+'?rtwwwap_aff='+rtwwwap_aff_name+'_'+rtwwwap_aff_id;
    	    	}
    	    }

        	var rtwwwap_html = '';
        	rtwwwap_html += '<div id="rtwwwap_banner_setting">';
        	rtwwwap_html += 	'<div class="rtwwwap_text_color">';
        	rtwwwap_html += 		'<label for="rtwwwap_txtPicker">'+rtwwwap_text_lang+'</label>';
        	rtwwwap_html += 		'<input type="text" id="rtwwwap_txtPicker" data-type="text_color" class="rtwwwap_text_color_field"/>';
        	rtwwwap_html += 	'</div>';
        	rtwwwap_html += 	'<div class="rtwwwap_link_color">';
        	rtwwwap_html += 		'<label for="rtwwwap_linkPicker">'+rtwwwap_link_lang+'</label>';
        	rtwwwap_html += 		'<input type="text" id="rtwwwap_linkPicker" data-type="link_color" class="rtwwwap_text_color_field" />';
        	rtwwwap_html += 	'</div>';
        	rtwwwap_html += 	'<div class="rtwwwap_bg_color">';
        	rtwwwap_html += 		'<label for="rtwwwap_bgPicker">'+rtwwwap_bg_lang+'</label>';
        	rtwwwap_html += 		'<input type="text" id="rtwwwap_bgPicker" data-type="bg_color" class="rtwwwap_text_color_field" />';
        	rtwwwap_html += 	'</div>';
        	rtwwwap_html += 	'<div class="rtwwwap_price">';
        	rtwwwap_html += 		'<label for="rtwwwap_price_check">'+rtwwwap_price_lang+'</label>';
        	rtwwwap_html += 		'<input type="checkbox" id="rtwwwap_price_check" checked/>';
        	rtwwwap_html += 	'</div>';
        	rtwwwap_html += 	'<div class="rtwwwap_border">';
        	rtwwwap_html += 		'<label for="rtwwwap_border_check">'+rtwwwap_border_lang+'</label>';
        	rtwwwap_html += 		'<input type="checkbox" id="rtwwwap_border_check"/>';
        	rtwwwap_html += 	'</div>';
        	rtwwwap_html += '</div>';
        	rtwwwap_html += '<div id="rtwwwap_banner_preview">';
        	rtwwwap_html += 	'<p>'+rtwwwap_global_params.rtwwwap_preview+'</p>';
        	//
        	var rtwwwap_html2 = '';
        	rtwwwap_html2 += 	'<div id="rtwwwap_preview">';
        	rtwwwap_html2 += 		'<div class="l_b_preview rtwwwap_border_show_hide" id="l_b_preview" style="width: 150px; border-radius: 3px;">';
        	rtwwwap_html2 += 			'<div class="rtwwwap_banner" style="padding: 10px; text-align: center;">';
        	rtwwwap_html2 += 				'<div>';
        	rtwwwap_html2 += 					'<a href="'+rtwwwap_generated_url+'" title="" target="_blank">';
        	rtwwwap_html2 += 						'<img src="'+rtwwwap_prod_img+'" id="rtwwwap_prod_img" alt="" title="" style="border-radius: 3px; height: 130px; max-width: 100%; display: block;">';
        	rtwwwap_html2 += 					'</a>';
        	rtwwwap_html2 += 				'</div>';
        	rtwwwap_html2 += 				'<div id="rtwwwap_banner_link">';
        	rtwwwap_html2 += 					'<a style="text-decoration: none;margin: 7px 0;display: inline-block;" href="'+rtwwwap_generated_url+'" title="" target="_blank">';
        	rtwwwap_html2 += 						rtwwwap_prod_name;
        	rtwwwap_html2 += 					'</a>';
        	rtwwwap_html2 += 				'</div>';
        	rtwwwap_html2 += 				'<div id="rtwwwap_banner_price">';
        	rtwwwap_html2 += 					rtwwwap_prod_display_price;
        	rtwwwap_html2 += 				'</div>';
        	rtwwwap_html2 += 				'<div>';
        	rtwwwap_html2 += 					'<a style="text-decoration: none;display: inline-block;padding: 5px 13px;background: linear-gradient(to right,#e7e740,#cccc34);margin-top: 10px;font-size: 14px;color: #000000;border-radius: 4px;border: 1px solid #ddd;" href="'+rtwwwap_generated_url+'" title="" target="_blank" value="'+rtwwwap_global_params.rtwwwap_buy_now+'">';
            rtwwwap_html2 +=                            rtwwwap_global_params.rtwwwap_buy_now;
        	rtwwwap_html2 += 					'</a>';
        	rtwwwap_html2 += 				'</div>';
        	rtwwwap_html2 += 			'</div>';
        	rtwwwap_html2 += 		'</div>';
        	rtwwwap_html2 += 	'</div>';
        	//
        	rtwwwap_html += 	'<iframe id="rtwwwap_iframe" frameborder="0" src="" style="height:256px; width:170px;">';
        	rtwwwap_html += 	'</iframe>';
        	rtwwwap_html += 	'<div class="rtwwwap_span_copied width-100">';
        	rtwwwap_html += 		'<input type="button" id="rtwwwap_get_script" value="'+rtwwwap_global_params.rtwwwap_copy_script+'" data-prod_id='+rtwwwap_prod_id+' />';
            rtwwwap_html +=        '<span id="rtwwwap_copy_tooltip_script">';
            rtwwwap_html +=             rtwwwap_global_params.rtwwwap_copied;
            rtwwwap_html +=        '</span>';
            rtwwwap_html +=     '</div>';
            rtwwwap_html +=     '<div class="rtwwwap_span_copied width-100">';
        	rtwwwap_html += 		'<input type="button" id="rtwwwap_get_html" value="'+rtwwwap_global_params.rtwwwap_copy_html+'" data-prod_id='+rtwwwap_prod_id+' />';
            rtwwwap_html +=        '<span id="rtwwwap_copy_tooltip_html">';
            rtwwwap_html +=             rtwwwap_global_params.rtwwwap_copied;
            rtwwwap_html +=        '</span>';
        	rtwwwap_html += 	'</div>';
        	rtwwwap_html += '</div>';

        	$(document).find( '#rtwwwap_search_main_container' ).html('');
        	$(document).find( '#rtwwwap_search_main_container' ).append( rtwwwap_html );

        	rtwwwap_updateIframe( rtwwwap_html2 );
        	$(document).find( '#rtwwwap_txtPicker' ).iris({
        		defaultColor  : true,
        		clear         : function() {},
        		hide          : true,
        		palettes      : true,
        		width         : 400,
    			change        : function( event, ui ) {
    			 	$(document).find( "#rtwwwap_txtPicker" ).css( 'background', ui.color.toString());
                    $(document).find( "#rtwwwap_txtPicker" ).css( 'color', ui.color.toString());
    				$(document).find( '#rtwwwap_iframe' ).contents().find( "#rtwwwap_banner_price" ).css( 'color', ui.color.toString());
    			}
        	});
            $(document).find( '#rtwwwap_txtPicker' ).iris( 'color', '#222222' );

        	$(document).find( '#rtwwwap_linkPicker' ).iris({
        		defaultColor  : true,
        		clear         : function() {},
        		hide          : true,
        		palettes      : true,
        		width         : 400,
    			change        : function( event, ui ) {
    			 	$(document).find( "#rtwwwap_linkPicker" ).css( 'background', ui.color.toString());
                    $(document).find( "#rtwwwap_linkPicker" ).css( 'color', ui.color.toString());
    			 	$(document).find( '#rtwwwap_iframe' ).contents().find( "#rtwwwap_banner_link > a" ).css( 'color', ui.color.toString());
    			}
        	});
            $(document).find( '#rtwwwap_linkPicker' ).iris( 'color', '#1a8688' );

        	$(document).find( '#rtwwwap_bgPicker' ).iris({
        		defaultColor  : true,
        		clear         : function() {},
        		hide          : true,
        		palettes      : true,
        		width         : 400,
    			change       : function( event, ui ){
    			 	$(document).find( "#rtwwwap_bgPicker" ).css( 'background', ui.color.toString());
                    $(document).find( "#rtwwwap_bgPicker" ).css( 'color', ui.color.toString());
    			 	$(document).find( '#rtwwwap_iframe' ).contents().find( '#l_b_preview' ).css( 'background', ui.color.toString());
    			}
        	});
            $(document).find( '#rtwwwap_bgPicker' ).iris( 'color', '#f6cfcf' );
        });

    	function rtwwwap_updateIframe( rtwwwap_html2 ){
    		var rtwwwap_target = $(document).find( '#rtwwwap_iframe' ).contents()[0];
    		rtwwwap_target.open();
    		rtwwwap_target.write( '<!doctype html><html><head></head><body></body></html>' );
    		rtwwwap_target.close();
    		$(document).find( '#rtwwwap_iframe' ).contents().find('body').html( rtwwwap_html2 );
        }

    	$(document).on( 'change', '#rtwwwap_price_check', function(){
    		if( $(this).prop( 'checked' ) ){
    			$(document).find( '#rtwwwap_iframe' ).contents().find('body').find( '#rtwwwap_banner_price' ).show();
    		}
    		else{
    			$(document).find( '#rtwwwap_iframe' ).contents().find('body').find( '#rtwwwap_banner_price' ).hide();
    		}
    	});

    	$(document).on( 'change', '#rtwwwap_border_check', function(){
    		if( $(this).prop( 'checked' ) ){
    			$(document).find( '#rtwwwap_iframe' ).contents().find('body').find( '#l_b_preview' ).css( 'border', '1px solid #000' );
    		}
    		else{
    			$(document).find( '#rtwwwap_iframe' ).contents().find('body').find( '#l_b_preview' ).css( 'border', '' );
    		}
    	});

    	$(document).on( 'click', '#rtwwwap_get_script', function(){
            var rtwwwap_prod_id = $(this).data( 'prod_id' );
    		var rtwwwap_html = $(document).find( '#rtwwwap_iframe' ).contents().find( 'body' ).html();
    		var rtwwwap_script_html = '';

    		rtwwwap_script_html += "'";
    		rtwwwap_script_html += rtwwwap_html;
    		rtwwwap_script_html += "'";

    		var rtwwwap_script = '<script type="text/javascript">';
    		rtwwwap_script += 	'$(document).ready( function(){';
    		rtwwwap_script += 		'var target = $(document).find( "#rtwwwap_iframe_'+rtwwwap_prod_id+'" ).contents()[0];';
    		rtwwwap_script += 		'target.open();';
    		rtwwwap_script += 		'target.write( "<!doctype html><html><head></head><body></body></html>" );';
    		rtwwwap_script += 		'target.close();';
    		rtwwwap_script += 		'$(document).find( "#rtwwwap_iframe_'+rtwwwap_prod_id+'" ).contents().find("body").html( '+rtwwwap_script_html+' );';
    		rtwwwap_script += 	'});';
    		rtwwwap_script += '</script>';

    		var $rtwwwap_temp = $( "<input>" );
    	  	$( "body" ).append( $rtwwwap_temp );
    	  	$rtwwwap_temp.val( rtwwwap_script ).select();
    	  	document.execCommand( "copy" );
      		$rtwwwap_temp.remove();

            $(document).find( '#rtwwwap_copy_tooltip_script' ).css( { 'visibility' : 'visible', 'opacity' : 1  } );
            setTimeout( function(){
                $(document).find( '#rtwwwap_copy_tooltip_script' ).css( { 'visibility' : 'hidden', 'opacity' : 0  } );
            }, 2000 );
    	});

    	$(document).on( 'click', '#rtwwwap_get_html', function(){
    		var rtwwwap_html = '';
            var rtwwwap_prod_id = $(this).data( 'prod_id' );
    		//rtwwwap_html += '<iframe id="rtwwwap_iframe_'+rtwwwap_prod_id+'" frameborder="0" src="" style="height: 256px; width: 170px;">';
				//rtwwwap_html += "<!doctype html><html>";
				rtwwwap_html += $('#rtwwwap_iframe').contents().find('body').html();
    		//rtwwwap_html += '</html>';

    		var $rtwwwap_temp = $( "<input>" );
    	  	$( "body" ).append( $rtwwwap_temp );
    	  	$rtwwwap_temp.val( rtwwwap_html ).select();
    	  	document.execCommand( "copy" );
      		$rtwwwap_temp.remove();

            $(document).find( '#rtwwwap_copy_tooltip_html' ).css( { 'visibility' : 'visible', 'opacity' : 1  } );
            setTimeout( function(){
                $(document).find( '#rtwwwap_copy_tooltip_html' ).css( { 'visibility' : 'hidden', 'opacity' : 0  } );
            }, 2000 );
    	});

        $(document).on( 'click', '#rtwwwap_generate_csv', function(){
            var rtwwwap_cat_id = $(document).find( '.rtwwwap_select_cat' ).val();
         
                
            var rtwwwap_data = {
                action                  : 'rtwwwap_generate_csv',
                rtwwwap_cat_id          : rtwwwap_cat_id,
                rtwwwap_security_check  : rtwwwap_global_params.rtwwwap_nonce
            };

            $.blockUI({ message: '' });
            $.ajax({
                url         : rtwwwap_global_params.rtwwwap_ajaxurl,
                type        : "POST",
                data        : rtwwwap_data,
                success     : function(response)
                {
                    window.location.href = response;
                    $.unblockUI();
                }
            });
        });

        $(document).on( 'click', "#rtwwwap_create_coupon", function (e){
            var rtwwwap_amount      = parseFloat( $(document).find( '#rtwwwap_coupon_amount' ).val() );
            var rtwwwap_amount_min  = parseFloat( $(document).find( '#rtwwwap_coupon_amount' ).attr( 'min' ) );
            var rtwwwap_amount_max  = parseFloat( $(document).find( '#rtwwwap_coupon_amount' ).attr( 'max' ) );

            if( rtwwwap_amount < rtwwwap_amount_min ){
                alert( rtwwwap_global_params.rtwwwap_valid_coupon_less_msg+' '+rtwwwap_amount_min );
                return false;
            }
            else if( rtwwwap_amount > rtwwwap_amount_max ){
                alert( rtwwwap_global_params.rtwwwap_valid_coupon_more_msg+' '+rtwwwap_amount_max );
                return false;
            }
            else{
                var rtwwwap_data = {
                    action                  : 'rtwwwap_create_coupon',
                    rtwwwap_amount          : rtwwwap_amount,
                    rtwwwap_security_check  : rtwwwap_global_params.rtwwwap_nonce
                };

                $.blockUI({ message: '' });
                $.ajax({
                    url         : rtwwwap_global_params.rtwwwap_ajaxurl,
                    type        : "POST",
                    data        : rtwwwap_data,
                    dataType    : 'json',
                    success     : function(response)
                    {
                        window.location.reload();
                        $.unblockUI();
                    }
                });
            }
        });

        //generate qr code
        $(document).on( 'click', '#rtwwwap_generate_qr', function(){
            $(document).find( '#rtwwwap_qrcode' ).html('');
            var rtwwwap_qrcode  = new QRCode( "rtwwwap_qrcode" );
            var rtwwwap_Text    = $(document).find( '#rtwwwap_generated_link' ).text();

            rtwwwap_qrcode.makeCode(rtwwwap_Text);

            setTimeout( function(){
                var rtwwwap_link = $(document).find( '#rtwwwap_qrcode' ).find( 'img' ).attr( 'src' );
                $(document).find( '#rtwwwap_qrcode' ).attr( 'href', rtwwwap_link );
                $(document).find( '#rtwwwap_download_qr' ).attr( 'href', rtwwwap_link );
                $(document).find( '#rtwwwap_qrcode_main' ).show();
            }, 300 );
        });


        $(document).on( 'click', '.rtwwwap_download_qr', function(){
            $(document).find( '#rtwwwap_qrcode' ).trigger( 'download' );
        });

        $(document).on( 'change', '.rtwwwap_payment_method', function(){
            if( $(this).val() == 'rtwwwap_payment_direct' ){
                $(document).find( '.rtwwwap_direct' ).show();
                $(document).find( '.rtwwwap_paypal' ).hide();
                $(document).find( '.rtwwwap_stripe' ).hide();
            }
            if( $(this).val() == 'rtwwwap_payment_paypal' ){
                $(document).find( '.rtwwwap_direct' ).hide();
                $(document).find( '.rtwwwap_paypal' ).show();
                $(document).find( '.rtwwwap_stripe' ).hide();
            }
            if( $(this).val() == 'rtwwwap_payment_stripe' ){
                $(document).find( '.rtwwwap_direct' ).hide();
                $(document).find( '.rtwwwap_paypal' ).hide();
                $(document).find( '.rtwwwap_stripe' ).show();
            }
        });

        $(document).on( 'click', '#rtwwwap_show_mlm_chain', function(){
            var rtwwwap_user_id = $(this).data( 'user_id' );
            var rtwwwap_active  = $(document).find( '#rtwwwap_show_active_only' ).prop( 'checked' );

            var data = {
                action                  : 'rtwwwap_public_get_mlm_chain',
                rtwwwap_security_check  : rtwwwap_global_params.rtwwwap_nonce,
                rtwwwap_user_id         : rtwwwap_user_id,
                rtwwwap_active          : rtwwwap_active
            };

            $.blockUI({ message: '' });
            $.ajax({
                url         : rtwwwap_global_params.rtwwwap_ajaxurl,
                type        : "POST",
                data        : data,
                dataType    : 'json',
                success     : function(response)
                {
                    $(document).find( '#rtwwwap_mlm_show' ).html('');
                    $(document).find( '#rtwwwap_mlm_chain_struct' ).html( response.rtwwwap_tree_html );

                    $(document).find( '#rtwwwap_mlm_show' ).orgchart({
                        'data' : $(document).find( '#rtwwwap_mlm_data' ),
                        'className': 'top-level',
                        'createNode': function($node, data) {
                            if( data.class == 'rtwwwap_noedit_disabled' ){
                                var secondMenuIcon = $('<i>', {
                                    'class': 'fa fa-info-circle rtwwwap-second-menu-icon'
                                });
                                var secondMenu = '<div class="rtwwwap-second-menu">'+rtwwwap_global_params.rtwwwap_disabled+'</div>';

                                $node.append(secondMenuIcon).append(secondMenu);
                            }
                            else if( data.class == 'rtwwwap_noedit' ){
                                var secondMenuIcon = $('<i>', {
                                    'class': 'fa fa-info-circle rtwwwap-second-menu-icon'
                                });
                                var secondMenu = '<div class="rtwwwap-second-menu">'+rtwwwap_global_params.rtwwwap_enabled+'</div>';

                                $node.append(secondMenuIcon).append(secondMenu);
                            }
                            else if( data.class == 'rtwwwap_disabled' ){
                                var secondMenuIcon = $('<i>', {
                                    'class': 'fa fa-check-circle rtwwwap_active rtwwwap-second-menu-icon'
                                });
                                var secondMenu = '<div class="rtwwwap-second-menu">'+rtwwwap_global_params.rtwwwap_mlm_user_activate+'</div>';

                                $node.append(secondMenuIcon).append(secondMenu);
                            }
                            else if( data.class == 'rtwwwap_enabled' ){
                                var secondMenuIcon = $('<i>', {
                                    'class': 'fa fa-times-circle rtwwwap_deactive rtwwwap-second-menu-icon'
                                });
                                var secondMenu = '<div class="rtwwwap-second-menu">'+rtwwwap_global_params.rtwwwap_mlm_user_deactivate+'</div>';

                                $node.append(secondMenuIcon).append(secondMenu);
                            }
                            else{
                                var secondMenuIcon = $('<i>', {
                                    'class': 'fa fa-info-circle rtwwwap-second-menu-icon'
                                });
                                var secondMenu = '<div class="rtwwwap-second-menu">'+rtwwwap_global_params.rtwwwap_parent+'</div>';

                                $node.append(secondMenuIcon).append(secondMenu);
                            }
                        }
                    });
                    $(document).find( '#rtwwwap_show_active_only' ).removeAttr( 'disabled' );

                    if( response.rtwwwap_improper_chain && response.rtwwwap_mlm_user_status_checked ){
                        $(document).find( '.rtwwwap_mlm_chain_not' ).show();
                    }
                    $.unblockUI();
                }
            });
        });

        $(document).on('click', '#rtwwwap_show_active_only', function(){
            $(document).find( '#rtwwwap_show_mlm_chain' ).trigger( 'click' );
        });

        $(document).on('click', '.rtwwwap_deactive', function(){
            var $this = $(this);
            var rtwwwap_aff_id      = $(this).closest('td').find( '.node' ).attr( 'id' );
            var rtwwwap_parent_id   = $(this).closest('td').find( '.node' ).data( 'parent' );

            if( rtwwwap_aff_id && rtwwwap_parent_id ){
                var data = {
                    action                  : 'rtwwwap_public_deactive_aff',
                    rtwwwap_security_check  : rtwwwap_global_params.rtwwwap_nonce,
                    rtwwwap_aff_id          : rtwwwap_aff_id,
                    rtwwwap_parent_id       : rtwwwap_parent_id
                };

                $.blockUI({ message: '' });
                $.ajax({
                    url         : rtwwwap_global_params.rtwwwap_ajaxurl,
                    type        : "POST",
                    data        : data,
                    dataType    : 'json',
                    success     : function(response)
                    {
                        if( response.rtwwwap_status ){
                            $this.removeClass( 'rtwwwap_deactive' ).addClass( 'rtwwwap_active' );
                            $this.closest('td').find( '.node' ).addClass( 'rtwwwap_disabled' );
                            $this.removeClass( 'fa-times-circle' ).addClass( 'fa-check-circle' );
                            $this.closest('td').find( '.rtwwwap-second-menu' ).text( rtwwwap_global_params.rtwwwap_mlm_user_activate );
                        }
                        alert( response.rtwwwap_message );
                        $.unblockUI();
                    }
                });
            }
        });

        $(document).on('click', '.rtwwwap_active', function(){
            var $this = $(this);
            var rtwwwap_aff_id      = $(this).closest('td').find( '.node' ).attr( 'id' );
            var rtwwwap_parent_id   = $(this).closest('td').find( '.node' ).data( 'parent' );

            if( rtwwwap_aff_id && rtwwwap_parent_id ){
                var data = {
                    action                  : 'rtwwwap_public_active_aff',
                    rtwwwap_security_check  : rtwwwap_global_params.rtwwwap_nonce,
                    rtwwwap_aff_id          : rtwwwap_aff_id,
                    rtwwwap_parent_id       : rtwwwap_parent_id
                };

                $.blockUI({ message: '' });
                $.ajax({
                    url         : rtwwwap_global_params.rtwwwap_ajaxurl,
                    type        : "POST",
                    data        : data,
                    dataType    : 'json',
                    success     : function(response)
                    {
                        if( response.rtwwwap_status ){
                            $this.removeClass( 'rtwwwap_active' ).addClass( 'rtwwwap_deactive' );
                            $this.closest('td').find( '.node' ).removeClass( 'rtwwwap_disabled' );
                            $this.removeClass( 'fa-check-circle' ).addClass( 'fa-times-circle' );
                            $this.closest('td').find( '.rtwwwap-second-menu' ).text( rtwwwap_global_params.rtwwwap_mlm_user_deactivate );
                        }
                        alert( response.rtwwwap_message );
                        $.unblockUI();
                    }
                });
            }
        });

        $(document).on( 'click', '#rtwwwap_rqst_mail', function(){
            var rtwwwap_msg = $(document).find( '.rtwwwap_request_msg' ).val();
            if( rtwwwap_msg != '' ){
                if( confirm( rtwwwap_global_params.rtwwwap_rqst_sure ) ){
                    var data = {
                        action                  : 'rtwwwap_send_rqst',
                        rtwwwap_security_check  : rtwwwap_global_params.rtwwwap_nonce,
                        rtwwwap_msg             : rtwwwap_msg
                    };

                    $.blockUI({ message: '' });
                    $.ajax({
                        url         : rtwwwap_global_params.rtwwwap_ajaxurl,
                        type        : "POST",
                        data        : data,
                        dataType    : 'json',
                        success     : function(response)
                        {
                            if( response.rtwwwap_status ){
                                $(document).find( '.rtwwwap_rqst_mail_sent' ).show();
                                $(document).find( '.rtwwwap_request_msg' ).val('');
                                setTimeout( function(){
                                    $(document).find( '.rtwwwap_rqst_mail_sent' ).hide();
                                }, 20000 );
                            }
                            else{
                                alert( response.rtwwwap_message );
                            }
                            $.unblockUI();
                        }
                    });
                }
            }
            else{
                alert( rtwwwap_global_params.rtwwwap_add_rqst_msg );
            }
        });
        $(document).on( 'click', '.rtwbma_edit_apntmnt', function(){
        
            $(".rtwwwap-reject-message-shown").addClass('show');
        });
     
        $(document).on( 'click', '#rtwwwap_rp_submit', function(){
     
            var rtwwwap_rp_password = $(document).find( '#pass1' ).val();
            var rtwwwap_user_id     = $('#user_login').val();
            var rtwwwap_redirect_url = $('#rp_redirect').val();
            var pass_strength_result = $('#pass-strength-result').text();
            
            console.log(pass_strength_result);  
           
          
        
            if(rtwwwap_rp_password !='' && rtwwwap_user_id !='' )
            {
                if ((pass_strength_result != "Very weak") && (pass_strength_result != "Weak") )
                {
                    

                    var data = {
                        action                  : 'rtwwwap_reset_password',
                        rtwwwap_security_check  : rtwwwap_global_params.rtwwwap_nonce,
                        rtwwwap_rp_password     : rtwwwap_rp_password,
                        rtwwwap_user_id         : rtwwwap_user_id
                    };

                    $.blockUI({ message: '' });
                    $.ajax({
                        url         : rtwwwap_global_params.rtwwwap_ajaxurl,
                        type        : "POST",
                        data        : data,
                        dataType    : 'json',
                        success     : function(response)
                        {
                            if( response.rtwwwap_status ){
                            alert('successfully password generated');
                            window.location.replace(rtwwwap_redirect_url);
                           
                         
                           
                            }
                            else{
                                alert( response.rtwwwap_message );
                            }
                            $.unblockUI();
                        }
                    });
                
                }
                else{
                    alert("Strength of password is not good");
                }
            }
           else{
                alert('You can not enter blank password');
                }
        });
     
    });

  



})( jQuery );
