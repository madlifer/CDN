jQuery(document).ready(function($){
	// Post Formats
	function checkFormat(){
		var format = $('#post-formats-select input:checked').attr('value');

		//only run on the posts page
		if(typeof format !== 'undefined'){

			$('#post-body div[id^=post_meta_]').hide();
			$('#post-body div[id^=post_meta_'+format+']').stop(true,true).fadeIn(500);

		}

	}
	$('#post-formats-select input').change(checkFormat);
	$(window).load(function(){
		checkFormat();
	});
	// Activate Product Key
	$('.thb-register:not(.disabled)').on("click", function(e){
		var _this = $(this),
				key = $('#thb_product_key').val(),
				purchase_code = $('#thb_purchase_code').val(),
				is_purchase_code = _this.hasClass('thb_purchase_code'),
				url = is_purchase_code ? _this.data('verify-by-purchase') : _this.data('verify'),
				data = {
					'domain': _this.data('domain')
				};

		if ( is_purchase_code ) {
			data.purchase_code = purchase_code;
		} else {
			data.product_key = key;
		}

		$.ajax({
			method: 'GET',
			url: url,
			data: data,
			beforeSend: function() {
				_this.addClass('disabled');
			},
			error: function(data) {
				_this.removeClass('disabled');
				if (data.responseText) {
					var response = $.parseJSON(data.responseText);
					if (response.error_message) {
						$('#thb_error_messages').html('<p>'+response.error_message+'</p>');
					}
				}
			},
			success: function(data) {
				if (data.product_key) {
					key = data.product_key;
				}
				$.ajax( ajaxurl, {
					method : 'POST',
					data : {
						action: 'thb_update_options',
						key: key,
						expired: 0,
						security: _this.data('security'),
					},
					success:function() {
						location.reload();
					}
				});

			},
		});
		return false;
	});
	// Remove Product Key
	$('.thb-delete-key').on("click", function(e){
		var _this = $(this);
		$.ajax( ajaxurl, {
			method : 'POST',
			data : {
				action: 'thb_update_options',
				key: '',
				expired: 0,
				security: _this.data('security'),
			},
			success:function() {
				location.reload();
			}
		});
		return false;
	});
	// Demo Content Import
	var thb_data = new FormData(),
			thb_once = false;

	if (typeof ocdi !== 'undefined') {
		thb_data.append( 'action', 'ocdi_import_demo_data' );
		thb_data.append( 'security', ocdi.ajax_nonce );
	}

	function thb_ajaxCall(thb_data) {

		// AJAX call.
		$.ajax({
			method: 'POST',
			url: ocdi.ajax_url,
			data: thb_data,
			contentType: false,
			processData: false
		})
		.done( function( response ) {
			if ( 'undefined' !== typeof response.status && 'newAJAX' === response.status ) {
				thb_ajaxCall( thb_data );
			} else if ( 'undefined' !== typeof response.status && 'afterAllImportAJAX' === response.status ) {
				// Fix for data.set and data.delete, which they are not supported in some browsers.
				var newData = new FormData();
				newData.append( 'action', 'ocdi_after_import_data' );
				newData.append( 'security', ocdi.ajax_nonce );
				thb_ajaxCall( newData );
			} else {
				location.reload();
			}
		});
	}

	$('.thb-load-demo:not(.disabled)').on("click", function(e){
		var _this = $(this),
				parent = _this.parents('.theme'),
				demo = _this.data('demo');

		parent.addClass('loading');
		$('.thb-load-demo').addClass('disabled').attr('disabled', 'disabled').unbind('click');

		thb_data.append( 'selected', demo );

		thb_ajaxCall(thb_data);

		e.preventDefault();
	});
});