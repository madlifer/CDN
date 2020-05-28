(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
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

		 $(document).ready(function(){

			 $('.rtwwwap-extra-features-wrap > ul >li').on('click', function(){
				 $('.rtwwwap-extra-features-wrap > ul >li').removeClass('active');
				 $(this).addClass('active');
				 $('.rtwwwap-extra-table-wrapper > table').removeClass('rtwwwap-show');
				 $('.rtwwwap-extra-table-wrapper > table').addClass('rtwwwap-hide-table');
				 $('#'+$(this).attr('data-target')).removeClass('rtwwwap-hide-table');
				 $('#'+$(this).attr('data-target')).addClass('rtwwwap-show');
			 });

			 $(document).on('click','.rtwwwap-manual-referral', function(){
				 $('.rtwwwap-popup-wrapper').addClass('show');
			 });
			 $(document).on('click','.rtwwwap_manual_add_message', function(){
				 $('.rtwwwap-popup-wrapper').removeClass('show');
			 });
			

			 $('#rtwwwap-manual-aff-id').select2();
		 });


	




		 $(document).ready(function(){

			$('.rtwwwap-extra-features-wrap > ul >li').on('click', function(){
				$('.rtwwwap-extra-features-wrap > ul >li').removeClass('active');
				$(this).addClass('active');
				$('.rtwwwap-extra-table-wrapper > table').removeClass('rtwwwap-show');
				$('.rtwwwap-extra-table-wrapper > table').addClass('rtwwwap-hide-table');
				$('#'+$(this).attr('data-target')).removeClass('rtwwwap-hide-table');
				$('#'+$(this).attr('data-target')).addClass('rtwwwap-show');
			});

			$(document).on('click','.rtwwwap-manual-referral', function(){
				$('.rtwwwap-popup-wrapper').addClass('show');
			});
			$(document).on('click','.rtwwwap-button-reset', function(){
				$('.rtwwwap-popup-wrapper').removeClass('show');
			});
			$('#rtwwwap-manual-aff-id').select2();
		});

		














		// License
		$(document).find('.rtwwwap_notice_error').addClass('rtwwwap_hide');
		var rules = {
		    rtwwwap_purchase_code 	: { required: true }
		};

		var messages = {
		    rtwwwap_purchase_code 	: { required: 'Required' }
		};

		$(document).find( "#rtwwwap_verify" ).validate({
		    rules: rules,
		    messages: messages
		});

		$(document).on('click', '#rtwwwap_verify_code', function(){
		    if( $(document).find( "#rtwwwap_verify" ).valid() )
		    {
		        var rtwwwap_purchase_code = $(document).find('.rtwwwap_purchase_code').val();

		        var data = {
		            action	  		:'rtwwwap_verify_purchase_code',
		            purchase_code 	: rtwwwap_purchase_code,
		            rtwwwap_security_check 	: rtwwwap_global_params.rtwwwap_nonce
		        };
		        $.blockUI({ message: '',
		        timeout: 20000000 });
		        $.ajax({
		            url: rtwwwap_global_params.rtwwwap_ajaxurl,
		            type: "POST",
		            data: data,
		            dataType :'json',
		            success: function(response)
		            {
		                if( response.status )
		                {
		                    $(document).find('.rtwwwap_notice_success').removeClass('rtwwwap_hide');
		                    $(document).find('.rtwwwap_msg_response').html(response.message);
		                    $(document).find('.rtwwwap_msg_response').removeClass('rtwwwap_errorr');
		                    $(document).find('.rtwwwap_msg_response').addClass('rtwwwap_successs');
		                    window.setTimeout(function(){
		                        window.location.reload(true);
		                    }, 3000);

		                }
		                else{
		                    $(document).find('.rtwwwap_msg_response').html(response.message);
		                    $(document).find('.rtwwwap_msg_response').removeClass('rtwwwap_successs');
		                    $(document).find('.rtwwwap_msg_response').addClass('rtwwwap_errorr');
		                }
		                $.unblockUI();
		            }
		        });
		    }
		});

		// Add Manual Referral
		$(document).on( 'click', '#rtwwwap_manual_add_ref', function(){
			var rtwwwap_aff_id 	= $('#rtwwwap-manual-aff-id').val();
			if(rtwwwap_aff_id == '')
			{
				var html = '<div id="message" class="error notice is-dismissible rtwwwap_affiliate_notice"><p>'+$('#rtwwwap-manual-aff-id').attr('data-error')+'.</p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button></div>';

				if( $(document).find( '.rtwwwap_affiliate_notice' ).length ){
					$(document).find( '.rtwwwap_affiliate_notice' ).removeClass('updated');
					if(!$(document).find( '.rtwwwap_affiliate_notice' ).hasClass('error'))
					{
						$(document).find( '.rtwwwap_affiliate_notice' ).addClass('error');
					}
					$(document).find( '.rtwwwap_affiliate_notice p' ).text( $('#rtwwwap-manual-aff-id').attr('data-error') );
					$(document).find( '.rtwwwap_notification_section' ).show();
				}
				else{
					$(document).find( '.rtwwwap_notification_section' ).html( html );
					$(document).find( '.rtwwwap_notification_section' ).show();
				}
				return false;
			}
			var rtwwwap_aff_manual_ref 	= $('#rtwwwap-manual-aff-ref').val();
			if(rtwwwap_aff_manual_ref == '')
			{
				var html = '<div id="message" class="error notice is-dismissible rtwwwap_affiliate_notice"><p>'+$('#rtwwwap-manual-aff-ref').attr('data-error')+'.</p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button></div>';

				if( $(document).find( '.rtwwwap_affiliate_notice' ).length ){
					$(document).find( '.rtwwwap_affiliate_notice' ).removeClass('updated');
					if(!$(document).find( '.rtwwwap_affiliate_notice' ).hasClass('error'))
					{
						$(document).find( '.rtwwwap_affiliate_notice' ).addClass('error');
					}
					$(document).find( '.rtwwwap_affiliate_notice p' ).text( $('#rtwwwap-manual-aff-ref').attr('data-error') );
					$(document).find( '.rtwwwap_notification_section' ).show();
				}
				else{
					$(document).find( '.rtwwwap_notification_section' ).html( html );
					$(document).find( '.rtwwwap_notification_section' ).show();
				}
				return false;
			}
			var rtwwwap_aff_manual_amnt 	= $('#rtwwwap-manual-ref-amnt').val();
			if(rtwwwap_aff_manual_amnt == '')
			{
				var html = '<div id="message" class="error notice is-dismissible rtwwwap_affiliate_notice"><p>'+$('#rtwwwap-manual-ref-amnt').attr('data-error')+'.</p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button></div>';

				if( $(document).find( '.rtwwwap_affiliate_notice' ).length ){
					$(document).find( '.rtwwwap_affiliate_notice' ).removeClass('updated');
					if(!$(document).find( '.rtwwwap_affiliate_notice' ).hasClass('error'))
					{
						$(document).find( '.rtwwwap_affiliate_notice' ).addClass('error');
					}
					$(document).find( '.rtwwwap_affiliate_notice p' ).text( $('#rtwwwap-manual-ref-amnt').attr('data-error') );
					$(document).find( '.rtwwwap_notification_section' ).show();
				}
				else{
					$(document).find( '.rtwwwap_notification_section' ).html( html );
					$(document).find( '.rtwwwap_notification_section' ).show();
				}
				return false;
			}
			var rtwwwap_manual_aff_status 	= $('#rtwwwap-manual-aff-status').val();

			if(rtwwwap_manual_aff_status == '')
			{
				var html = '<div id="message" class="error notice is-dismissible rtwwwap_affiliate_notice"><p>'+$('#rtwwwap-manual-aff-status').attr('data-error')+'.</p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button></div>';

				if( $(document).find( '.rtwwwap_affiliate_notice' ).length ){
					$(document).find( '.rtwwwap_affiliate_notice' ).removeClass('updated');
					if(!$(document).find( '.rtwwwap_affiliate_notice' ).hasClass('error'))
					{
						$(document).find( '.rtwwwap_affiliate_notice' ).addClass('error');
					}
					$(document).find( '.rtwwwap_affiliate_notice p' ).text( $('#rtwwwap-manual-aff-status').attr('data-error') );
					$(document).find( '.rtwwwap_notification_section' ).show();
				}
				else{
					$(document).find( '.rtwwwap_notification_section' ).html( html );
					$(document).find( '.rtwwwap_notification_section' ).show();
				}
				return false;
			}

			var rtwwwap_data = {
				action 					: 'rtwwwap_add_manual_referral',
				rtwwwap_aff_id 		: rtwwwap_aff_id,
				rtwwwap_aff_manual_ref 			: rtwwwap_aff_manual_ref,
				rtwwwap_aff_manual_amnt : rtwwwap_aff_manual_amnt,
				rtwwwap_manual_aff_status : rtwwwap_manual_aff_status,
				rtwwwap_security_check	: rtwwwap_global_params.rtwwwap_nonce
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
						$('#rtwwwap-manual-aff-id').val('');
						$('#rtwwwap-manual-aff-ref').val('');
						$('#rtwwwap-manual-ref-amnt').val('');
						$('#rtwwwap-manual-aff-status').val('');
						var html = '<div id="message" class="updated notice is-dismissible rtwwwap_affiliate_notice"><p>'+response.rtwwwap_message+'.</p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button></div>';

						if( $(document).find( '.rtwwwap_affiliate_notice' ).length ){
							$(document).find( '.rtwwwap_affiliate_notice' ).removeClass('error');
							if(!$(document).find( '.rtwwwap_affiliate_notice' ).hasClass('updated'))
							{
								$(document).find( '.rtwwwap_affiliate_notice' ).addClass('updated');
							}
							$(document).find( '.rtwwwap_affiliate_notice p' ).text( response.rtwwwap_message );
							$(document).find( '.rtwwwap_notification_section' ).show();
						}
						else{
							$(document).find( '.rtwwwap_notification_section' ).html( html );
							$(document).find( '.rtwwwap_notification_section' ).show();
						}
					}
					else
					{
						var html = '<div id="message" class="error notice is-dismissible rtwwwap_affiliate_notice"><p>'+response.rtwwwap_message+'.</p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button></div>';

						if( $(document).find( '.rtwwwap_affiliate_notice' ).length ){
							$(document).find( '.rtwwwap_affiliate_notice' ).removeClass('updated');
							if(!$(document).find( '.rtwwwap_affiliate_notice' ).hasClass('error'))
							{
								$(document).find( '.rtwwwap_affiliate_notice' ).addClass('error');
							}
							$(document).find( '.rtwwwap_affiliate_notice p' ).text( response.rtwwwap_message );
						}
						else{
							$(document).find( '.rtwwwap_notification_section' ).html( html );
							$(document).find( '.rtwwwap_notification_section' ).show();
						}
					}
					$.unblockUI();
				}
			});
		});

	 	$(document).find( ".rtwwwap_select2" ).select2();
	 	$(document).find( ".rtwwwap_select2_all" ).select2({ width : '40%' });
	 	$(document).find( ".rtwwwap_select2_level" ).select2({ width : '60%' });
	 	$(document).find( ".rtwwwap_select2_level_criteria" ).select2({ width : '60%' });
	 	$(document).find( ".rtwwwap_select2_mlm" ).select2({ width : '30%' });
	 	$(document).find( ".rtwwwap_select2_mlm_default_comm" ).select2({ width : '60%' });
	 	$(document).find( ".rtwwwap_select2_mlm_level_comm_type" ).select2({ width : '60%' });
	 	$(document).find( ".rtwwwap_select2_page" ).select2({ width : '20%' });
	 	$(document).find( ".rtwwwap_select2_curr" ).select2({ width : '30%' });
	 	$(document).find( ".rtwwwap_select2_sharing_bonus_time_limit" ).select2({ width : '40%' });

	 	$(document).on( 'hover', '.select2-selection__rendered', function(){
	 		$(this).removeAttr( "title" );
	 	});

		//button css start
		$(document).find( '#rtwwwap_buttonPicker' ).iris({
			defaultColor  : true,
			clear         : function() {},
			hide          : true,
			palettes      : true,
			width         : 400,
			change        : function( event, ui ) {
				$(document).find( "#rtwwwap_buttonPicker" ).css( 'background', ui.color.toString());
				$(document).find( "#rtwwwap_buttonPicker" ).css( 'color', ui.color.toString());
				$(this).siblings( '.rtwwwap_button_color' ).html( ui.color.toString());
			}
		});

		var rtwwwap_saved_button_color = $(document).find( '#rtwwwap_buttonPicker' ).val();
		if( rtwwwap_saved_button_color != '' ){
			$(document).find( '#rtwwwap_buttonPicker' ).iris( 'color', rtwwwap_saved_button_color );
		}
		else{
			$(document).find( '#rtwwwap_buttonPicker' ).iris( 'color', '#DADAF2' );
		}
        //button css end

        //form bg css start
        $(document).find( '#rtwwwap_bgPicker' ).iris({
        	defaultColor  : true,
        	clear         : function() {},
        	hide          : true,
        	palettes      : true,
        	width         : 400,
        	change        : function( event, ui ) {
        		$(document).find( "#rtwwwap_bgPicker" ).css( 'background', ui.color.toString());
        		$(document).find( "#rtwwwap_bgPicker" ).css( 'color', ui.color.toString());
        		$(this).siblings( '.rtwwwap_bg_color' ).html( ui.color.toString());
        	}
        });

        var rtwwwap_saved_bg_color = $(document).find( '#rtwwwap_bgPicker' ).val();
        if( rtwwwap_saved_bg_color != '' ){
        	$(document).find( '#rtwwwap_bgPicker' ).iris( 'color', rtwwwap_saved_bg_color );
        }
        else{
        	$(document).find( '#rtwwwap_bgPicker' ).iris( 'color', '#DADAF2' );
        }
        //form bg css end

        //main bg css start
        $(document).find( '#rtwwwap_mainbgPicker' ).iris({
        	defaultColor  : true,
        	clear         : function() {},
        	hide          : true,
        	palettes      : true,
        	width         : 400,
        	change        : function( event, ui ) {
        		$(document).find( "#rtwwwap_mainbgPicker" ).css( 'background', ui.color.toString());
        		$(document).find( "#rtwwwap_mainbgPicker" ).css( 'color', ui.color.toString());
        		$(this).siblings( '.rtwwwap_mainbg_color' ).html( ui.color.toString());
        	}
        });

        var rtwwwap_saved_bg_color = $(document).find( '#rtwwwap_mainbgPicker' ).val();
        if( rtwwwap_saved_bg_color != '' ){
        	$(document).find( '#rtwwwap_mainbgPicker' ).iris( 'color', rtwwwap_saved_bg_color );
        }
        else{
        	$(document).find( '#rtwwwap_mainbgPicker' ).iris( 'color', '#DADAF2' );
        }
        //main bg css end

        //header css start
        $(document).find( '#rtwwwap_headPicker' ).iris({
        	defaultColor  : true,
        	clear         : function() {},
        	hide          : true,
        	palettes      : true,
        	width         : 400,
        	change        : function( event, ui ) {
        		$(document).find( "#rtwwwap_headPicker" ).css( 'background', ui.color.toString());
        		$(document).find( "#rtwwwap_headPicker" ).css( 'color', ui.color.toString());
        		$(this).siblings( '.rtwwwap_head_color' ).html( ui.color.toString());
        	}
        });

        var rtwwwap_saved_bg_color = $(document).find( '#rtwwwap_headPicker' ).val();
        if( rtwwwap_saved_bg_color != '' ){
        	$(document).find( '#rtwwwap_headPicker' ).iris( 'color', rtwwwap_saved_bg_color );
        }
        else{
        	$(document).find( '#rtwwwap_headPicker' ).iris( 'color', '#DADAF2' );
        }
        //header css end

		//show hide color picker on click start
		$(document).on( 'click', '#rtwwwap_bgPicker, #rtwwwap_buttonPicker, #rtwwwap_mainbgPicker, #rtwwwap_headPicker', function (event) {
			$(this).iris('hide');
			$(this).iris('show');
			return false;
		});

		$(document).on( 'click', 'body', function (e) {
			if ( !$(e.target).is( "#rtwwwap_bgPicker, #rtwwwap_buttonPicker, #rtwwwap_mainbgPicker, #rtwwwap_headPicker" ) )
			{
				if( $(document).find( '#rtwwwap_bgPicker' ).siblings( '.iris-picker' ).css( 'display' ) == 'block' || $(document).find( '#rtwwwap_buttonPicker' ).siblings( '.iris-picker' ).css( 'display' ) == 'block' || $(document).find( '#rtwwwap_mainbgPicker' ).siblings( '.iris-picker' ).css( 'display' ) == 'block' || $(document).find( '#rtwwwap_headPicker' ).siblings( '.iris-picker' ).css( 'display' ) == 'block' )
				{
					$( '#rtwwwap_bgPicker, #rtwwwap_buttonPicker, #rtwwwap_mainbgPicker, #rtwwwap_headPicker' ).iris( 'hide' );
					return false;
				}
			}
		});
        //show hide color picker on click end

        $(document).on( 'change', '.rtwwwap_select2_mlm', function(){
        	if( $(document).find( '.rtwwwap_select2_mlm' ).val() == 0 ){
        		$(document).find( '#rtwwwap_mlm_child' ).attr( 'max', 2 );
        		$(document).find( '#rtwwwap_mlm_child' ).closest('tr').show();
        		$(document).find( '#rtwwwap_mlm_child' ).removeAttr( 'disabled', 'disabled' );
        		$(document).find( '#rtwwwap_mlm_child' ).val( 2 );
        	}
        	else if( $(document).find( '.rtwwwap_select2_mlm' ).val() == 1 ){
        		$(document).find( '#rtwwwap_mlm_child' ).removeAttr( 'max' );
        		$(document).find( '#rtwwwap_mlm_child' ).closest('tr').show();
        		$(document).find( '#rtwwwap_mlm_child' ).removeAttr( 'disabled', 'disabled' );
        	}
        	else if( $(document).find( '.rtwwwap_select2_mlm' ).val() == 2 ){
        		$(document).find( '#rtwwwap_mlm_child' ).closest('tr').hide();
        		$(document).find( '#rtwwwap_mlm_child' ).attr( 'disabled', 'disabled' );
        	}
        });

        $(document).find( '.rtwwwap_payout_table' ).DataTable({
        	responsive: false,
        	"order" : [],
        	"columnDefs": [
        	{ orderable: false, targets: [0] },
        	{ "width": "5%", "targets": 0 },
        	{ "width": "10%", "targets": 1 },
        	{ "width": "15%", "targets": 2 },
        	{ "width": "15%", "targets": 3 },
        	{ "width": "10%", "targets": 4 },
        	{ "width": "20%", "targets": 5 },
        	{ "width": "25%", "targets": 6 }
        	],
		});
	
		
		// counting column for referral table

		var count = $(".rtwwwap_referral_table").find("tr:first td").length;
		// console.log(count);



		if(count == 8)
			{
				$(document).find( '.rtwwwap_referral_table').DataTable({
				responsive: false,
				"order" : [],
				"columnDefs": [
				{ orderable: false, targets: [0,7] },
				{ "width": "5%", "targets": 0 },
				{ "width": "10%", "targets": 1 },
				{ "width": "10%", "targets": 2 },
				// { "width": "10%", "targets": 3 },
				{ "width": "10%", "targets": 3 },
				{ "width": "10%", "targets": 4 },
				{ "width": "20%", "targets": 5 },
				{ "width": "20%", "targets": 6 },
				{ "width": "15%", "targets": 7 },
				],
			});
		
			}
		if(count == 9)
			{
				$(document).find( '.rtwwwap_referral_table').DataTable({
				responsive: false,
				"order" : [],
				"columnDefs": [
				{ orderable: false, targets: [0,8] },
				{ "width": "5%", "targets": 0 },
				{ "width": "10%", "targets": 1 },
				{ "width": "10%", "targets": 2 },
				{ "width": "10%", "targets": 3 },
				{ "width": "10%", "targets": 4 },
				{ "width": "10%", "targets": 5 },
				{ "width": "20%", "targets": 6 },
				{ "width": "20%", "targets": 7 },
				{ "width": "15%", "targets": 8 },
				],
			});
		
			}
		
			

        if( $(document).find( '.rtwwwap_affiliates_table' ).length != 0 ){
        	var rtwwwap_affiliate_table_length = $(document).find( '.rtwwwap_affiliates_table > thead > tr' )[0].cells.length;

        	if( rtwwwap_affiliate_table_length == 6 ){
        		$(document).find( '.rtwwwap_affiliates_table' ).DataTable({
        			responsive: false,
        			"order" : [],
        			"columnDefs": [
        			{ orderable: false, targets: [ 0, 5 ] },
        			{ "width": "5%", "targets": 0 },
        			{ "width": "10%", "targets": 1 },
        			{ "width": "20%", "targets": 2 },
        			{ "width": "20%", "targets": 3 },
        			{ "width": "25%", "targets": 4 },
        			{ "width": "20%", "targets": 5 }
        			]
        		});
        	}
        	else if( rtwwwap_affiliate_table_length == 7 ){
        		$(document).find( '.rtwwwap_affiliates_table' ).DataTable({
        			responsive: false,
        			"order" : [],
        			"columnDefs": [
        			{ orderable: false, targets: [ 0, 6 ] },
        			{ "width": "5%", "targets": 0 },
        			{ "width": "5%", "targets": 1 },
        			{ "width": "20%", "targets": 2 },
        			{ "width": "20%", "targets": 3 },
        			{ "width": "20%", "targets": 4 },
        			{ "width": "20%", "targets": 5 },
        			{ "width": "10%", "targets": 6 }
        			]
        		});
        	}
        }

        $(document).find( '.rtwwwap_levels_table' ).DataTable({
        	responsive: false,
        	rowReorder: true,
        	"columnDefs": [
        	{ orderable: false, targets: [ 1, 2, 3, 4, 5 ] },
        	{ "width": "10%", "targets": 0 },
        	{ "width": "10%", "targets": 1 },
        	{ "width": "25%", "targets": 2 },
        	{ "width": "15%", "targets": 3 },
        	{ "width": "25%", "targets": 4 },
        	{ "width": "15%", "targets": 5 }
        	]
        });

        $(document).on( 'change', '#rtwwwap_affiliate', function(){
        	var rtwwwap_user_id 	= $(this).parent().data( 'rtwwwap-num' );
        	var rtwwwap_value 		= $(this).prop( 'checked' );

        	var rtwwwap_data = {
        		action 					: 'rtwwwap_change_affiliate',
        		rtwwwap_user_id 		: rtwwwap_user_id,
        		rtwwwap_value 			: (rtwwwap_value) ? 1 : 0,
        		rtwwwap_security_check	: rtwwwap_global_params.rtwwwap_nonce
        	};

        	$.blockUI({ message: '' });
        	if( rtwwwap_value ){
        		$(this).closest('tr').find( '.rtwwwap_aff_level_hidden' ).show();
        	}
        	else{
        		$(this).closest('tr').find( '.rtwwwap_aff_level_hidden' ).hide();
        	}
        	$.ajax({
        		url 		: rtwwwap_global_params.rtwwwap_ajaxurl,
        		type 		: "POST",
        		data 		: rtwwwap_data,
        		dataType 	: 'json',
        		success 	: function(response)
        		{
        			if( response.rtwwwap_status ){
        				var html = '<div id="message" class="updated notice is-dismissible rtwwwap_affiliate_notice"><p>'+response.rtwwwap_message+'.</p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button></div>';

        				if( $(document).find( '.rtwwwap_affiliate_notice' ).length ){
        					$(document).find( '.rtwwwap_affiliate_notice p' ).text( response.rtwwwap_message );
        				}
        				else{
        					$(document).find( '.wp-header-end' ).after( html );
        				}

        				$('html, body').animate({
        					scrollTop: $("body").offset().top
        				}, 500, "linear", function(){
        				});
        			}
        			else{

        			}
        			$.unblockUI();
        		}
        	});
        });

        $(document).on( 'click', '.rtwwwap_affiliate_notice', function(){
        	$(this).remove();
        });

        $(document).on( 'keypress', '.rtwwwap_perc_commission_box, .rtwwwap_fix_commission_box', function (e) {
        	if( e.which != 8 && e.which != 0 && ( e.which < 48 || e.which > 57 ) ){
        		alert( rtwwwap_global_params.rtwwwap_digit );
        		return false;
        	}
        });

        $(document).on( 'blur', ".rtwwwap_perc_commission_box", function (e) {
			console.log('hello');
			var $rtwwwap_this 			= $(this);
        	var rtwwwap_check_if_same 	= $(this).prop( "defaultValue" );

        	if( rtwwwap_check_if_same != $(this).val() ){
        		var rtwwwap_post_id 	= $(this).data( 'rtwwwap-num' );
        		var rtwwwap_value 		= $(this).val();
				var rtwwwap_type 		= 'perc_comm';
				console.log(rtwwwap_value);

        		var rtwwwap_data = {
        			action 					: 'rtwwwap_change_prod_commission',
        			rtwwwap_post_id 		: rtwwwap_post_id,
        			rtwwwap_value 			: rtwwwap_value,
        			rtwwwap_type 			: rtwwwap_type,
        			rtwwwap_security_check	: rtwwwap_global_params.rtwwwap_nonce
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
        					$rtwwwap_this.prop( 'defaultValue', $rtwwwap_this.val() );
        				}
        				alert( response.rtwwwap_message );
        				$.unblockUI();
        			}
        		});
        	}
        });

        $(document).on( 'blur', ".rtwwwap_fix_commission_box", function (e) {
        	var $rtwwwap_this 			= $(this);
        	var rtwwwap_check_if_same 	= $(this).prop( "defaultValue" );

        	if( rtwwwap_check_if_same != $(this).val() ){
        		var rtwwwap_post_id 	= $(this).data( 'rtwwwap-num' );
        		var rtwwwap_value 		= $(this).val();
        		var rtwwwap_type 		= 'fix_comm';

        		var rtwwwap_data = {
        			action 					: 'rtwwwap_change_prod_commission',
        			rtwwwap_post_id 		: rtwwwap_post_id,
        			rtwwwap_value 			: rtwwwap_value,
        			rtwwwap_type 			: rtwwwap_type,
        			rtwwwap_security_check	: rtwwwap_global_params.rtwwwap_nonce
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
        					$rtwwwap_this.prop( 'defaultValue', $rtwwwap_this.val() );
        				}
        				alert( response.rtwwwap_message );
        				$.unblockUI();
        			}
        		});
        	}
        });

        $(document).on( 'click', '.rtwwwap_add_new_row', function(){
        	var rtwwwap_rowCount 	= $( '.rtwwwap_tbody tr' ).length-1;
        	var rtwwwap_cloned 		= $(document).find( '.rtwwwap_add_new_row_hidden' ).clone();
        	$( rtwwwap_cloned ).insertAfter( $( document ).find( '.rtwwwap_tbody tr:last-child' ).last() );
        	$(document).find( '.rtwwwap_tbody tr:last-child' ).removeClass( 'rtwwwap_add_new_row_hidden' );
        	$(document).find( '.rtwwwap_tbody tr:last-child' ).find( '.rtwwwap_select2_hidden' ).removeClass( 'rtwwwap_select2_hidden' ).addClass( 'rtwwwap_select2' );
        	$(document).find( '.rtwwwap_tbody tr:last-child' ).find( '.rtwwwap_select2' ).select2();

        	var rtwwwap_new_row_name 			= 'rtwwwap_commission_settings_opt[per_cat_'+rtwwwap_rowCount+'][]';
        	var rtwwwap_new_row_percentage_name= 'rtwwwap_commission_settings_opt[per_cat_'+rtwwwap_rowCount+'][cat_percentage_commission]';
        	var rtwwwap_new_row_fixed_name 	= 'rtwwwap_commission_settings_opt[per_cat_'+rtwwwap_rowCount+'][cat_fixed_commission]';

        	$(document).find( '.rtwwwap_tbody tr:last-child' ).find( '.rtwwwap_select2' ).attr( 'name', rtwwwap_new_row_name );
        	$(document).find( '.rtwwwap_tbody tr:last-child' ).find( '.rtwwwap_cat_percentage_commission' ).attr( 'name', rtwwwap_new_row_percentage_name );
        	$(document).find( '.rtwwwap_tbody tr:last-child' ).find( '.rtwwwap_cat_fixed_commission' ).attr( 'name', rtwwwap_new_row_fixed_name );
        	$(document).find( '.rtwwwap_tbody tr:last-child' ).show();
        });

        $(document).on( 'click', '.rtwwwap_add_new_row_perf', function(){
        	var rtwwwap_rowCount 	= $( '.rtwwwap_perf_table tr' ).length;
        	var rtwwwap_cloned 		= $(document).find( '.rtwwwap_add_new_row_hidden' ).clone();
        	$( rtwwwap_cloned ).insertAfter( $( document ).find( '.rtwwwap_perf_table tr:last-child' ).last() );
        	$(document).find( '.rtwwwap_perf_table tr:last-child' ).removeClass( 'rtwwwap_add_new_row_hidden' );

        	var rtwwwap_new_row_sale_name 		= 'rtwwwap_extra_features_opt[performance_bonus]['+rtwwwap_rowCount+'][sale_amount]';
        	var rtwwwap_new_row_incentive_name 	= 'rtwwwap_extra_features_opt[performance_bonus]['+rtwwwap_rowCount+'][incentive]';

        	$(document).find( '.rtwwwap_perf_table tr:last-child' ).find( '.rtwwwap_sale_amount' ).attr( 'name', rtwwwap_new_row_sale_name );
        	$(document).find( '.rtwwwap_perf_table tr:last-child' ).find( '.rtwwwap_incentive' ).attr( 'name', rtwwwap_new_row_incentive_name );
        	$(document).find( '.rtwwwap_perf_table tr:last-child' ).show();
        });

        $(document).on( 'click', '.rtwwwap_remove_row', function(){
        	$(this).closest( 'tr' ).remove();
        	var rtwwwap_rowCount = $( '.rtwwwap_tbody tr' ).length;
        	if( rtwwwap_rowCount == 1 ){
        		$(document).find( '.rtwwwap_add_new_row' ).trigger( 'click' );
        	}
        });

        $(document).on( 'click', '.rtwwwap_remove_row_perf', function(){
        	$(this).closest( 'tr' ).remove();
        	var rtwwwap_rowCount = $( '.rtwwwap_perf_table tr' ).length;
        	if( rtwwwap_rowCount == 1 ){
        		$(document).find( '.rtwwwap_add_new_row_perf' ).trigger( 'click' );
        	}
        });

        $(document).on( 'click', ".rtwwwap_coupons", function (e){
        	if( $(this).val() == 1 ){
        		$(document).find( '#rtwwwap_min_amount' ).show();
        	}
        	else if( $(this).val() == 0 ){
        		$(document).find( '#rtwwwap_min_amount' ).hide();
        	}
        });

        $(document).on( 'click', '.rtwwwap_referrals_check_all', function(){
        	if( $(this).is( ':checked' ) ){
        		$(document).find( '.rtwwwap_referral_table > tbody  > tr' ).each( function()
        		{
        			if( $(this).find( 'input:checkbox' ).length == 1 ){
        				$(this).find( 'input:checkbox' ).prop( 'checked', true );
        			}
        		});
        	}
        	else{
        		$(document).find( '.rtwwwap_referral_table > tbody > tr' ).each( function()
        		{
        			if( $(this).find( 'input:checkbox' ).length == 1 ){
        				$(this).find( 'input:checkbox' ).prop( 'checked', false );
        			}
        		});
        	}
        });

        $(document).on( 'click', ".rtwwwap_approve", function () {
        	if( confirm( rtwwwap_global_params.rtwwwap_approval_sure ) ){
        		var $this 					= $(this);
        		var rtwwwap_referral_ids 	= [];

        		rtwwwap_referral_ids.push( $(this).closest( 'tr' ).data( 'referral_id' ) );

        		var data = {
        			action 					: 'rtwwwap_approve',
        			rtwwwap_security_check	: rtwwwap_global_params.rtwwwap_nonce,
        			rtwwwap_referral_ids	: rtwwwap_referral_ids,
        		};

        		$.blockUI({ message: '' });
        		$.ajax({
        			url 		: rtwwwap_global_params.rtwwwap_ajaxurl,
        			type 		: "POST",
        			data 		: data,
        			dataType 	: 'json',
        			success 	: function(response)
        			{
        				if( response.rtwwwap_status ){
        					$this.closest( 'td' ).find( '.rtwwwap_reject' ).remove();
        					$this.html( response.rtwwwap_message );
        					$this.removeClass( 'rtwwwap_approve' ).addClass( 'rtwwwap_approved' );
        					$this.closest('tr').find( '.rtwwwap-checkbox' ).remove();
        				}
        				else{
        					alert( response.rtwwwap_message );
        				}
        				$.unblockUI();
        			}
        		});
        	}
        });

        $(document).on( 'click', ".rtwwwap_approve_all_referrals", function () {
        	if( confirm( rtwwwap_global_params.rtwwwap_approval_sure_all ) ){
        		var rtwwwap_referral_ids 	= [];
        		var rtwwwap_all_checked 	= 0;
        		var rtwwwap_already_approved_capped = 0;
        		$(document).find( '.rtwwwap_referral_table > tbody > tr' ).each( function()
        		{
        			if( $(this).find( 'input:checkbox' ).length == 1 ){
        				if( $(this).find( 'input:checkbox' ).is( ':checked' ) ){
        					rtwwwap_all_checked++;
        					if( $(this).find( '.rtwwwap_approve' ).length == 0 ){
        						rtwwwap_already_approved_capped++;
        					}
        					else{
        						rtwwwap_referral_ids.push( $(this).data( 'referral_id' ) );
        					}
        				}
        			}
        		});

        		if( rtwwwap_all_checked == rtwwwap_already_approved_capped ){
        			alert( 'rtwwwap_global_params.rtwwwap_nothing_marked' );
        			return;
        		}

        		if( rtwwwap_referral_ids.length > 0 ){
        			var data = {
        				action 					: 'rtwwwap_approve',
        				rtwwwap_security_check	: rtwwwap_global_params.rtwwwap_nonce,
        				rtwwwap_referral_ids	: rtwwwap_referral_ids,
        			};

        			$.blockUI({ message: '' });
        			$.ajax({
        				url 		: rtwwwap_global_params.rtwwwap_ajaxurl,
        				type 		: "POST",
        				data 		: data,
        				dataType 	: 'json',
        				success 	: function(response)
        				{
        					alert( response.rtwwwap_message );
        					window.location.reload();
        					$.unblockUI();
        				}
        			});
        		}
        		else{
        			alert( rtwwwap_global_params.rtwwwap_nothing_marked );
        		}
        	}
		});
		
		
	
	

        $(document).on( 'click', ".rtwwwap_reject", function () {

			var closest_td = $(this).closest('td');

			$(".rtwwwap-reject-message-wrapper").addClass('show');

			$("#rtwwwap_manual_add_message").on('click',function(){
				var rtwwwap_message_content    = $(".rtwwwap_reject_message_content").val();


					if( confirm( rtwwwap_global_params.rtwwwap_reject_sure ))
					{
								
							if(rtwwwap_message_content != '')
							{
									
								var rtwwwap_referral_ids 	= [];
								
							
								rtwwwap_referral_ids.push( $(".rtwwwap_reject").closest( 'tr' ).data( 'referral_id' ) );
									
								var data = {
									action 					: 'rtwwwap_reject',
									rtwwwap_security_check	: rtwwwap_global_params.rtwwwap_nonce,
									rtwwwap_referral_ids	: rtwwwap_referral_ids,
									rtwwwap_reject_message  : rtwwwap_message_content,
									
								};
				
								$.blockUI({ message: '' });
								$.ajax({
									url 		: rtwwwap_global_params.rtwwwap_ajaxurl,
									type 		: "POST",
									data 		: data,
									dataType 	: 'json',
									success 	: function(response)
									{
										// $(".rtwwwap_reject_message_content").HTML("");
										// $('.rtwwwap_reject_message_content').text("");
										if( response.rtwwwap_status){
											closest_td.html( '<span class="rtwwwap_rejected">'+response.rtwwwap_message+'</span>' );
											$(".rtwwwap-reject-message-wrapper").removeClass('show');
											$('.rtwwwap_reject_message_content').val("");
											window.location.reload();
										}
										else {
											alert( response.rtwwwap_message );
										}
										
										$.unblockUI();
									}
								});
								
							}
							else
							{
								alert(rtwwwap_global_params.rtwwwap_reject_message_blank);
							}	
					}
					
			
			});

			$("#rtwwwap_cancle_add_message").on('click',function(){
				$(".rtwwwap-reject-message-wrapper").removeClass('show');
			});
			

		
        });
		// $(document).on('click','.rtwwwap_manual_add_message', function(){
		// 	$('.rtwwwap-reject-message-wrapper').removeClass('show');
		// });
        $(document).on( 'click', ".rtwwwap_reject_all_referrals", function () {
        	if( confirm( rtwwwap_global_params.rtwwwap_reject_sure_all ) ){
        		var rtwwwap_referral_ids = [];
        		$(document).find( '.rtwwwap_referral_table > tbody > tr' ).each( function()
        		{
        			if( $(this).find( 'input:checkbox' ).length == 1 ){
        				if( $(this).find( 'input:checkbox' ).is( ':checked' ) ){
        					rtwwwap_referral_ids.push( $(this).data( 'referral_id' ) );
        				}
        			}
        		});

        		if( rtwwwap_referral_ids.length > 0 ){
        			var data = {
        				action 					: 'rtwwwap_reject',
        				rtwwwap_security_check	: rtwwwap_global_params.rtwwwap_nonce,
        				rtwwwap_referral_ids	: rtwwwap_referral_ids,
        			};

        			$.blockUI({ message: '' });
        			$.ajax({
        				url 		: rtwwwap_global_params.rtwwwap_ajaxurl,
        				type 		: "POST",
        				data 		: data,
        				dataType 	: 'json',
        				success 	: function(response)
        				{
        					alert( response.rtwwwap_message );
        					window.location.reload();
        					$.unblockUI();
        				}
        			});
        		}
        		else{
        			alert( rtwwwap_global_params.rtwwwap_nothing_marked );
        		}
        	}
        });

        $(document).on( 'click', '.rtwwwap_pay_check_all', function(){
        	if( $(this).is( ':checked' ) ){
        		$(document).find( '.rtwwwap_payout_table > tbody > tr' ).each( function()
        		{
        			if( $(this).find( 'input:checkbox' ).length == 1 ){
        				$(this).find( 'input:checkbox' ).prop( 'checked', true );
        			}
        		});
        	}
        	else{
        		$(document).find( '.rtwwwap_payout_table > tbody > tr' ).each( function()
        		{
        			if( $(this).find( 'input:checkbox' ).length == 1 ){
        				$(this).find( 'input:checkbox' ).prop( 'checked', false );
        			}
        		});
        	}
        });

        $(document).on( 'click', ".rtwwwap_payment_paypal", function (e) {
        	var rtwwwap_aff_ids = [];
        	rtwwwap_aff_ids.push({
        		'aff_id' 	: $(this).closest('tr').find( '.rtwwwap_aff_id' ).data( 'aff_id' ),
        		'amount' 	: $(this).closest('tr').find( '.rtwwwap_amount' ).data( 'amount' ),
        		'currency' 	: $(this).closest('tr').find( '.rtwwwap_amount' ).data( 'currency' )
        	});

        	var data = {
        		action 					: 'rtwwwap_paypal',
        		rtwwwap_security_check	: rtwwwap_global_params.rtwwwap_nonce,
        		rtwwwap_aff_ids			: rtwwwap_aff_ids,
        	};

        	$.blockUI({ message: '' });
        	$.ajax({
        		url 		: rtwwwap_global_params.rtwwwap_ajaxurl,
        		type 		: "POST",
        		data 		: data,
        		dataType 	: 'json',
        		success 	: function(response)
        		{
        			alert( response.rtwwwap_status );
        			window.location.reload();
        			$.unblockUI();
        		}
        	});
        });

        $(document).on( 'click', ".rtwwwap_all_paypal_affiliate", function () {
        	var rtwwwap_aff_ids = [];
        	$(document).find( '.rtwwwap_payout_table > tbody > tr' ).each( function()
        	{
        		if( $(this).find( 'input:checkbox' ).length == 1 )
        		{
        			if( $(this).find( 'input:checkbox' ).is( ':checked' ) && ( $(this).find( 'input:checkbox' ).data( 'rtwwwap_pay_method' ) == 'paypal' ) )
        			{
        				rtwwwap_aff_ids.push({
        					'aff_id' 	: $(this).closest('tr').find( '.rtwwwap_aff_id' ).data( 'aff_id' ),
        					'amount' 	: $(this).closest('tr').find( '.rtwwwap_amount' ).data( 'amount' ),
        					'currency' 	: $(this).closest('tr').find( '.rtwwwap_amount' ).data( 'currency' )
        				});
        			}
        		}
        	});

        	if( rtwwwap_aff_ids.length > 0 ){
        		var data = {
        			action 					: 'rtwwwap_paypal',
        			rtwwwap_security_check	: rtwwwap_global_params.rtwwwap_nonce,
        			rtwwwap_aff_ids			: rtwwwap_aff_ids,
        		};

        		$.blockUI({ message: '' });
        		$.ajax({
        			url 		: rtwwwap_global_params.rtwwwap_ajaxurl,
        			type 		: "POST",
        			data 		: data,
        			dataType 	: 'json',
        			success 	: function(response)
        			{
        				alert( response.rtwwwap_status );
        				window.location.reload();
        				$.unblockUI();
        			}
        		});
        	}
        	else{
        		alert( rtwwwap_global_params.rtwwwap_nothing_marked );
        	}
        });

        $(document).on( 'click', "#rtwwwap_payment_stripe", function (e) {
        	var rtwwwap_aff_ids = [];
        	rtwwwap_aff_ids.push({
        		'aff_id' 	: $(this).closest('tr').find( '.rtwwwap_aff_id' ).data( 'aff_id' ),
        		'amount' 	: $(this).closest('tr').find( '.rtwwwap_amount' ).data( 'amount' ),
        		'currency' 	: $(this).closest('tr').find( '.rtwwwap_amount' ).data( 'currency' )
        	});

        	var data = {
        		action 					: 'rtwwwap_stripe',
        		rtwwwap_security_check	: rtwwwap_global_params.rtwwwap_nonce,
        		rtwwwap_aff_ids			: rtwwwap_aff_ids,
        	};

        	$.blockUI({ message: '' });
        	$.ajax({
        		url 		: rtwwwap_global_params.rtwwwap_ajaxurl,
        		type 		: "POST",
        		data 		: data,
        		dataType 	: 'json',
        		success 	: function(response)
        		{
        			alert( response.rtwwwap_status );
        			window.location.reload();
        			$.unblockUI();
        		}
        	});
        });

        $(document).on( 'click', '.rtwwwap_affiliate_check_all', function(){
        	if( $(this).is( ':checked' ) ){
        		$(document).find( '.rtwwwap_affiliates_table > tbody  > tr' ).each( function()
        		{
        			if( $(this).find( 'input:checkbox' ).length == 1 ){
        				$(this).find( 'input:checkbox' ).prop( 'checked', true );
        			}
        		});
        	}
        	else{
        		$(document).find( '.rtwwwap_affiliates_table > tbody > tr' ).each( function()
        		{
        			if( $(this).find( 'input:checkbox' ).length == 1 ){
        				$(this).find( 'input:checkbox' ).prop( 'checked', false );
        			}
        		});
        	}
        });

        $(document).on( 'click', ".rtwwwap_aff_approve", function (e) {
        	var $this = $(this);
        	var rtwwwap_referral_ids = [];

        	rtwwwap_referral_ids.push( $(this).closest( 'tr' ).data( 'referral_id' ) );

        	var data = {
        		action 					: 'rtwwwap_aff_approve',
        		rtwwwap_security_check	: rtwwwap_global_params.rtwwwap_nonce,
        		rtwwwap_referral_ids	: rtwwwap_referral_ids,
        	};

        	$.blockUI({ message: '' });
        	$.ajax({
        		url 		: rtwwwap_global_params.rtwwwap_ajaxurl,
        		type 		: "POST",
        		data 		: data,
        		dataType 	: 'json',
        		success 	: function(response)
        		{
        			if( response.rtwwwap_status ){
        				alert( response.rtwwwap_message );
        				$this.closest( 'tr' ).find( '.rtwwwap-checkbox' ).remove();
        				$this.removeClass( 'rtwwwap_aff_approve' ).addClass( 'rtwwwap_aff_approved' );
        			}
        			else {
        				alert( response.rtwwwap_message );
        			}
        			$.unblockUI();
        		}
        	});
        });

        $(document).on( 'click', ".rtwwwap_approve_all_affiliate", function () {
        	var rtwwwap_referral_ids = [];
        	$(document).find( '.rtwwwap_affiliates_table > tbody > tr' ).each( function()
        	{
        		if( $(this).find( 'input:checkbox' ).length == 1 ){
        			if( $(this).find( 'input:checkbox' ).is( ':checked' ) ){
        				rtwwwap_referral_ids.push( $(this).data( 'referral_id' ) );
        			}
        		}
        	});

        	if( rtwwwap_referral_ids.length > 0 ){
        		var data = {
        			action 					: 'rtwwwap_aff_approve',
        			rtwwwap_security_check	: rtwwwap_global_params.rtwwwap_nonce,
        			rtwwwap_referral_ids	: rtwwwap_referral_ids,
        		};

        		$.blockUI({ message: '' });
        		$.ajax({
        			url 		: rtwwwap_global_params.rtwwwap_ajaxurl,
        			type 		: "POST",
        			data 		: data,
        			dataType 	: 'json',
        			success 	: function(response)
        			{
        				if( response.rtwwwap_status ){
        					$(document).find( '.rtwwwap_affiliates_table > tbody  > tr' ).each( function()
        					{
        						if( $.inArray( $(this).data( 'referral_id' ), response.rtwwwap_approved_ids ) ){
        							if( $(this).find( 'input:checkbox' ).length == 1 ){
        								$(this).find( '.rtwwwap-checkbox' ).remove();
        								$(this).find( '.rtwwwap-add-link > span' ).removeClass( 'rtwwwap_aff_approve' ).addClass( 'rtwwwap_aff_approved' );
        							}
        						}
        					});
        				}
        				alert( response.rtwwwap_message );
        				$.unblockUI();
        			}
        		});
        	}
        	else{
        		alert( rtwwwap_global_params.rtwwwap_nothing_marked );
        	}
        });

        $(document).on( 'change', '.rtwwwap_paypal_live_radio', function(){
        	if( $(this).is(':checked') ){
        		$(this).closest( 'div' ).find( '#rtwwwap_paypal_live_id, #rtwwwap_paypal_live_secret' ).attr( 'required', 'required' );
        	}
        	else{
        		$(this).closest( 'div' ).find( '#rtwwwap_paypal_live_id, #rtwwwap_paypal_live_secret' ).attr( 'required', 'required' );
        	}
        });

        $(document).on( 'change', '.rtwwwap_paypal_sandbox_radio', function(){
        	if( $(this).is(':checked') ){
        		$(this).closest( 'div' ).find( '#rtwwwap_paypal_sandbox_id, #rtwwwap_paypal_sandbox_secret' ).attr( 'required', 'required' );
        	}
        	else{
        		$(this).closest( 'div' ).find( '#rtwwwap_paypal_sandbox_id, #rtwwwap_paypal_sandbox_secret' ).attr( 'required', 'required' );
        	}
        });

        $(document).on( 'click', ".rtwwwap_override_show_hide", function (e){
        	if( $(this).val() == 1 ){
        		$(document).find( '.rtwwwap_override' ).show();
        	}
        	else if( $(this).val() == 0 ){
        		$(document).find( '.rtwwwap_override' ).hide();
        	}
        });

        $(document).on( 'click', ".rtwwwap_show_hide_prod_comm", function (e){
        	if( $(this).val() == 1 ){
        		$(document).find( '.rtwwwap_prod_comm' ).show();
        	}
        	else if( $(this).val() == 2 ){
        		$(document).find( '.rtwwwap_prod_comm' ).hide();
        	}
        });

        $(document).on( 'change', ".rtwwwap_affiliate_level_select", function (e){
        	var rtwwwap_user_id 	= $(this).data( 'rtwwwap-num' );
        	var rtwwwap_value 		= $(this).val();

        	var rtwwwap_data = {
        		action 					: 'rtwwwap_change_affiliate_level',
        		rtwwwap_user_id 		: rtwwwap_user_id,
        		rtwwwap_value 			: rtwwwap_value,
        		rtwwwap_security_check	: rtwwwap_global_params.rtwwwap_nonce
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
        				var html = '<div id="message" class="notice notice-success is-dismissible rtwwwap_affiliate_notice"><p>'+response.rtwwwap_message+'.</p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button></div>';

        				if( $(document).find( '.rtwwwap_affiliate_notice' ).length ){
        					$(document).find( '.rtwwwap_affiliate_notice p' ).text( response.rtwwwap_message );
        				}
        				else{
        					$(document).find( '.wp-header-end' ).after( html );
        				}

        				$('html, body').animate({
        					scrollTop: $("body").offset().top
        				}, 500, "linear", function(){
        				});
        			}
        			else{
        				var html = '<div id="message" class="notice notice-error is-dismissible rtwwwap_affiliate_notice"><p>'+response.rtwwwap_message+'.</p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button></div>';

        				if( $(document).find( '.rtwwwap_affiliate_notice' ).length ){
        					$(document).find( '.rtwwwap_affiliate_notice p' ).text( response.rtwwwap_message );
        				}
        				else{
        					$(document).find( '.wp-header-end' ).after( html );
        				}

        				$('html, body').animate({
        					scrollTop: $("body").offset().top
        				}, 500, "linear", function(){
        				});
        			}
        			$.unblockUI();
        		}
        	});
        });

        $(document).on( 'change', ".rtwwwap_select2_level_criteria", function (e){
        	if( $(this).val() == 0 ){
        		$(document).find( '.rtwwwap_level_criteria_amount' ).val( '0' );
        		$(document).find( '.rtwwwap_level_criteria_amount' ).attr( 'disabled', 'disabled' );
        	}
        	else{
        		$(document).find( '.rtwwwap_level_criteria_amount' ).removeAttr( 'disabled' );
        	}
        });

        $(document).on( 'click', '.rtwwwap_level_delete', function(){
        	var $this = $(this);
        	var rtwwwap_level_id = $(this).closest('tr').data( 'level_id' );

        	var data = {
        		action 					: 'rtwwwap_aff_level_delete',
        		rtwwwap_security_check	: rtwwwap_global_params.rtwwwap_nonce,
        		rtwwwap_level_id		: rtwwwap_level_id,
        	};

        	$.blockUI({ message: '' });
        	$.ajax({
        		url 		: rtwwwap_global_params.rtwwwap_ajaxurl,
        		type 		: "POST",
        		data 		: data,
        		dataType 	: 'json',
        		success 	: function(response)
        		{
        			if( response.rtwwwap_status ){
        				alert( response.rtwwwap_message );
        				$this.closest( 'tr' ).remove();
        				window.location.reload();
        			}
        			else {
        				alert( response.rtwwwap_message );
        			}
        			$.unblockUI();
        		}
        	});
        });

        $(document).on( 'click', '.rtwwwap_referral_delete', function(){
        	var $this = $(this);
        	var rtwwwap_referral_id = $(this).closest('tr').data( 'referral_id' );

        	var data = {
        		action 					: 'rtwwwap_referral_delete',
        		rtwwwap_security_check	: rtwwwap_global_params.rtwwwap_nonce,
        		rtwwwap_referral_id		: rtwwwap_referral_id,
        	};

        	$.blockUI({ message: '' });
        	$.ajax({
        		url 		: rtwwwap_global_params.rtwwwap_ajaxurl,
        		type 		: "POST",
        		data 		: data,
        		dataType 	: 'json',
        		success 	: function(response)
        		{
        			if( response.rtwwwap_status ){
        				alert( response.rtwwwap_message );
        				$this.closest( 'tr' ).remove();
        			}
        			else {
        				alert( response.rtwwwap_message );
        			}
        			$.unblockUI();
        		}
        	});
        });

        $(document).on( 'click', '.rtwwwap_payment_type', function() {
        	if( $(this).hasClass( 'rtwwwap_payment_direct' ) ){
        		var rtwwwap_bank_details = $(this).closest('tr').data( 'bank_details' );
        		if( rtwwwap_bank_details ){
        			var rtwwwap_match = /\r|\n/.exec(rtwwwap_bank_details);
        			if( rtwwwap_match ){
        				rtwwwap_bank_details = rtwwwap_bank_details.replace(/\n/g,"<br>");
        			}
        			$(document).find( "#dialogForm" ).html( rtwwwap_bank_details );
        		}
        		else{
        			$(document).find( "#dialogForm" ).html( rtwwwap_global_params.rtwwwap_bank_det );
        		}
        		$(document).find( "#dialogForm" ).dialog({
        			modal 		: true,
        			autoOpen 	: true,
        			show 		: { effect: "blind", duration: 800 },
        			title 		: 'Bank details',
        			dialogClass : 'success-dialog'
        		});
        		$(document).find( "#dialogForm" ).dialog("open");
        	}
        });

        $(document).on( 'click', '.rtwwwap_payment_direct', function() {
        	if( $(this).hasClass( 'rtwwwap_paid' ) ){
        		if( confirm( rtwwwap_global_params.rtwwwap_bank_sent ) ){
        			var rtwwwap_aff_id = $(this).closest('tr').find( '.rtwwwap_aff_id' ).data( 'aff_id' );
        			var rtwwwap_amount = $(this).closest('tr').find( '.rtwwwap_amount' ).data( 'amount' );

        			var data = {
        				action 					: 'rtwwwap_direct_pay',
        				rtwwwap_security_check	: rtwwwap_global_params.rtwwwap_nonce,
        				rtwwwap_aff_id			: rtwwwap_aff_id,
        				rtwwwap_amount			: rtwwwap_amount
        			};

        			$.blockUI({ message: '' });
        			$.ajax({
        				url 		: rtwwwap_global_params.rtwwwap_ajaxurl,
        				type 		: "POST",
        				data 		: data,
        				dataType 	: 'json',
        				success 	: function(response)
        				{
        					alert( response.rtwwwap_status );
        					window.location.reload();
        					$.unblockUI();
        				}
        			});
        		}
        	}
        });

        if( $(document).find( '.rtwwwap_edit_user_level' ).length != 0 ){
        	var rtwwwap_aff = $(document).find( '.rtwwwap_edit_user_affiliate' ).val();
        	if( $(document).find( '.rtwwwap_edit_user_affiliate' ).prop( 'checked' ) ){
        		$(document).find( '.rtwwwap_edit_user_level' ).show()
        	}
        }

        $(document).on( 'click', '.rtwwwap_add_user_affiliate', function() {
        	if( $(this).prop( 'checked' ) ){
        		$(document).find( '.rtwwwap_new_user_level' ).show();
        	}
        	else{
        		$(document).find( '.rtwwwap_new_user_level' ).hide();
        	}
        });

        $(document).on( 'click', '.rtwwwap_edit_user_affiliate', function() {
        	if( $(this).prop( 'checked' ) ){
        		$(document).find( '.rtwwwap_edit_user_level' ).show();
        	}
        	else{
        		$(document).find( '.rtwwwap_edit_user_level' ).hide();
        	}
        });

        $(document).on( 'click', '.rtwwwap_update_level_order', function() {
        	var rtwwwap_new_order = [];
        	$(document).find( '.rtwwwap_levels_table > tbody > tr' ).each( function()
        	{
        		rtwwwap_new_order.push( $(this).data( 'level_id' ) );
        	});

        	if( rtwwwap_new_order.length ){
        		var data = {
        			action 					: 'rtwwwap_update_level_order',
        			rtwwwap_security_check	: rtwwwap_global_params.rtwwwap_nonce,
        			rtwwwap_new_order		: rtwwwap_new_order,
        		};

        		$.blockUI({ message: '' });
        		$.ajax({
        			url 		: rtwwwap_global_params.rtwwwap_ajaxurl,
        			type 		: "POST",
        			data 		: data,
        			dataType 	: 'json',
        			success 	: function(response)
        			{
        				alert( response.rtwwwap_message );
        				window.location.reload();
        				$.unblockUI();
        			}
        		});
        	}
        });

        var rtwwwap_mlm_depth_reset = $(document).find( '.rtwwwap_mlm_depth' ).data( 'rtwwwap_depth' );
        $(document).find( '.rtwwwap_mlm_depth' ).val( rtwwwap_mlm_depth_reset );

        $(document).on( 'keydown', '.rtwwwap_mlm_depth', function(e){
        	e.preventDefault();
        });

        $(document).on( 'change', '.rtwwwap_mlm_depth', function(){
        	var rtwwwap_new_depth = $(this).val();
        	var rtwwwap_old_depth = $(this).data( 'rtwwwap_depth' );

        	if( rtwwwap_new_depth > rtwwwap_old_depth )
        	{
        		$(this).data( 'rtwwwap_depth', rtwwwap_new_depth );
        		var rtwwwap_rowCount = $( '.rtwwwap_tbody tr' ).length;
        		var rtwwwap_cloned 	= $(document).find( '.rtwwwap_add_new_row_hidden' ).clone();
        		$( rtwwwap_cloned ).insertAfter( $( document ).find( '.rtwwwap_tbody tr:last-child' ).last() );
        		$(document).find( '.rtwwwap_tbody tr:last-child' ).removeClass( 'rtwwwap_add_new_row_hidden' );
        		$(document).find( '.rtwwwap_tbody tr:last-child' ).find( '.rtwwwap_select2_mlm_level_comm_type_hidden' ).removeClass( 'rtwwwap_select2_mlm_level_comm_type_hidden' ).addClass( 'rtwwwap_select2_mlm_level_comm_type' );

        		var rtwwwap_new_row_td_name = 'rtwwwap_mlm_opt[mlm_levels][ '+rtwwwap_rowCount+' ][mlm_level_id]';
        		var rtwwwap_new_row_select2_name = 'rtwwwap_mlm_opt[mlm_levels][ '+rtwwwap_rowCount+' ][mlm_level_comm_type]';
        		var rtwwwap_new_row_comm_name 	= 'rtwwwap_mlm_opt[mlm_levels][ '+rtwwwap_rowCount+' ][mlm_level_comm_amount]';

        		$(document).find( '.rtwwwap_tbody tr:last-child' ).find( 'td:eq(0)' ).attr( 'name', rtwwwap_new_row_td_name );
        		$(document).find( '.rtwwwap_tbody tr:last-child' ).find( 'td:eq(0)' ).html( rtwwwap_rowCount );

        		$(document).find( '.rtwwwap_tbody tr:last-child' ).find( 'td:eq(1) > .rtwwwap_select2_mlm_level_comm_type' ).attr( 'name', rtwwwap_new_row_select2_name );

        		$(document).find( '.rtwwwap_tbody tr:last-child' ).find( 'td:eq(2) > .rtwwwap_mlm_level_comm_amount' ).attr( 'name', rtwwwap_new_row_comm_name );
        		var rtwwwap_default_comm_val 	= $(document).find( '.rtwwwap_mlm_default_comm_amount' ).val();
        		var rtwwwap_default_comm_type 	= $(document).find( '.rtwwwap_select2_mlm_default_comm' ).val();

        		$(document).find( '.rtwwwap_tbody tr:last-child' ).find( 'td:eq(2) > .rtwwwap_mlm_level_comm_amount' ).val( rtwwwap_default_comm_val );
        		$(document).find( '.rtwwwap_tbody tr:last-child' ).find( 'td:eq(1) > .rtwwwap_select2_mlm_level_comm_type' ).val( rtwwwap_default_comm_type );
        		$(document).find( '.rtwwwap_tbody tr:last-child' ).find( '.rtwwwap_select2_mlm_level_comm_type' ).select2({ width : '60%' });

        		$(document).find( '.rtwwwap_tbody tr:last-child' ).show();
        	}
        	else if( rtwwwap_old_depth > rtwwwap_new_depth )
        	{
        		$(this).data( 'rtwwwap_depth', rtwwwap_new_depth );
        		$(document).find( '.rtwwwap_tbody tr:last-child' ).remove();
        	}
        });

        $(document).on( 'click', '#rtwwwap_show_mlm_chain', function(){
        	var rtwwwap_user_id = $(this).data( 'user_id' );
        	var rtwwwap_active 	= $(document).find( '#rtwwwap_show_active_only' ).prop( 'checked' );

        	var data = {
        		action 					: 'rtwwwap_get_mlm_chain',
        		rtwwwap_security_check	: rtwwwap_global_params.rtwwwap_nonce,
        		rtwwwap_user_id			: rtwwwap_user_id,
        		rtwwwap_active			: rtwwwap_active
        	};

        	$.blockUI({ message: '' });
        	$.ajax({
        		url 		: rtwwwap_global_params.rtwwwap_ajaxurl,
        		type 		: "POST",
        		data 		: data,
        		dataType 	: 'json',
        		success 	: function(response)
        		{
        			$(document).find( '#rtwwwap_mlm_show' ).html('');
        			$(document).find( '#rtwwwap_mlm_chain_struct' ).html( response.rtwwwap_tree_html );

        			$(document).find( '#rtwwwap_mlm_show' ).orgchart({
        				'data' : $(document).find( '#rtwwwap_mlm_data' ),
        				'className': 'top-level',
        				'createNode': function($node, data) {
        					if( data.class == 'rtwwwap_disabled' ){
        						var secondMenuIcon = $('<i>', {
        							'class': 'fa fa-check-circle rtwwwap_active rtwwwap-second-menu-icon'
        						});
        						var secondMenu = '<div class="rtwwwap-second-menu">'+rtwwwap_global_params.rtwwwap_mlm_user_activate+'</div>';
        					}
        					else{
        						var secondMenuIcon = $('<i>', {
        							'class': 'fa fa-times-circle rtwwwap_deactive rtwwwap-second-menu-icon'
        						});
        						var secondMenu = '<div class="rtwwwap-second-menu">'+rtwwwap_global_params.rtwwwap_mlm_user_deactivate+'</div>';
        					}

        					$node.append(secondMenuIcon).append(secondMenu);
        				}
        			});
        			$(document).find( '#rtwwwap_show_active_only' ).removeAttr( 'disabled' );

        			if( response.rtwwwap_improper_chain ){
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
        	var rtwwwap_aff_id 		= $(this).closest('td').find( '.node' ).attr( 'id' );
        	var rtwwwap_parent_id 	= $(this).closest('td').find( '.node' ).data( 'parent' );

        	if( rtwwwap_aff_id && rtwwwap_parent_id ){
        		var data = {
        			action 					: 'rtwwwap_deactive_aff',
        			rtwwwap_security_check	: rtwwwap_global_params.rtwwwap_nonce,
        			rtwwwap_aff_id			: rtwwwap_aff_id,
        			rtwwwap_parent_id		: rtwwwap_parent_id
        		};

        		$.blockUI({ message: '' });
        		$.ajax({
        			url 		: rtwwwap_global_params.rtwwwap_ajaxurl,
        			type 		: "POST",
        			data 		: data,
        			dataType 	: 'json',
        			success 	: function(response)
        			{
        				if( response.rtwwwap_status ){
        					$this.removeClass( 'rtwwwap_deactive' ).addClass( 'rtwwwap_active' );
        					$this.closest('td').find( '.node' ).addClass( 'rtwwwap_disabled' );
        					$this.removeClass( 'fa-times-circle' ).addClass( 'fa-check-circle' );
        				}
        				alert( response.rtwwwap_message );
        				$.unblockUI();
        			}
        		});
        	}
        });

        $(document).on('click', '.rtwwwap_active', function(){
        	var $this = $(this);
        	var rtwwwap_aff_id 		= $(this).closest('td').find( '.node' ).attr( 'id' );
        	var rtwwwap_parent_id 	= $(this).closest('td').find( '.node' ).data( 'parent' );

        	if( rtwwwap_aff_id && rtwwwap_parent_id ){
        		var data = {
        			action 					: 'rtwwwap_active_aff',
        			rtwwwap_security_check	: rtwwwap_global_params.rtwwwap_nonce,
        			rtwwwap_aff_id			: rtwwwap_aff_id,
        			rtwwwap_parent_id		: rtwwwap_parent_id
        		};

        		$.blockUI({ message: '' });
        		$.ajax({
        			url 		: rtwwwap_global_params.rtwwwap_ajaxurl,
        			type 		: "POST",
        			data 		: data,
        			dataType 	: 'json',
        			success 	: function(response)
        			{
        				if( response.rtwwwap_status ){
        					$this.removeClass( 'rtwwwap_active' ).addClass( 'rtwwwap_deactive' );
        					$this.closest('td').find( '.node' ).removeClass( 'rtwwwap_disabled' );
        					$this.removeClass( 'fa-check-circle' ).addClass( 'fa-times-circle' );
        				}
        				alert( response.rtwwwap_message );
        				$.unblockUI();
        			}
        		});
        	}
        });

        $(document).on( 'change', '.rtwwwap_select2_sharing_bonus_time_limit', function(){
        	if( $(this).val() == 0 ){
        		$(document).find( '.sharing_bonus_amount_limit' ).attr( 'disabled', 'disabled' );
        	}
        	else{
        		$(document).find( '.sharing_bonus_amount_limit' ).removeAttr( 'disabled' );
        	}
        });

        $(document).on('click', '.rtwwwap-form-custom-field-clone', function(){
        	var clone_id = $('.rtwwwap_clone_counter').val();
        	var updated_clone_id = parseInt(clone_id)+parseInt(1)
        	$('.rtwwwap_clone_counter').val(parseInt(updated_clone_id));
        	var rtwwwap_cloned = $(".rtwwwap-input_type-inner-wrapper").clone();
        	rtwwwap_cloned.html(function(i, Html){
        		$(Html+":contains("+clone_id+")").each(function(){
        			Html = Html.replace(0,updated_clone_id)
        		});
        		return  Html
        	});
                rtwwwap_cloned.find("input:text").val("");
                rtwwwap_cloned.find('select').each(function(index, item) {
                     $(item).val("");

                });
        	rtwwwap_cloned.find(".rtwwwap-custom-input-options-span").remove();
        	$(rtwwwap_cloned).addClass('rtwwwap-input_type-inner-wrapper'+updated_clone_id).removeClass('rtwwwap-input_type-inner-wrapper');
        	rtwwwap_cloned.appendTo('.rtwwwap-input_type-wrapper');
        });

        $(document).on( 'change', '.rtwwwap-custom-input_type', function(){
        	var current_clone_id = $(this).data('current_count');
        	var selected_val = $(this).children("option:selected").val();
	        if(selected_val == 'checkbox' || selected_val == 'radio' || selected_val == 'select'){
        		if($(this).parents('.rtwwwap-input_type-inner').find(".rtwwwap-custom-options").length == 0){
	        		$(this).parents('.rtwwwap-input_type-inner').append('<span class="rtwwwap-custom-input-options-span">\
	        			<label for="rtwwwap-custom-label-class">Options</label>\
	        			<input type="text" name="rtwwwap_reg_temp_opt[custom-input]['+current_clone_id+'][custom-input-options]" class="rtwwwap-custom-options">\
	        			</span>');
	        	}
        	}else{
        		$(this).parents('.rtwwwap-input_type-inner').find(".rtwwwap-custom-input-options-span").remove();
        	}
        });
	});
	


})( jQuery );
