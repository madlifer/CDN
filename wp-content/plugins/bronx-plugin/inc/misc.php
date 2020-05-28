<?php

// Download Emails
function thb_csv_export() {
	$download = filter_input( INPUT_GET, 'thb_download_emails', FILTER_SANITIZE_STRING );
	if ( $download && current_user_can( 'manage_options' ) ) {
		$filename = 'thb_subcribed_emails_' . time() . '.csv';
		// emails
		$stack = get_option('subscribed_emails');

		$fh = @fopen( 'php://output', 'w' );

		header( 'Cache-Control: must-revalidate, post-check=0, pre-check=0' );
		header( 'Content-Description: File Transfer' );
		header( 'Content-type: text/csv' );
		header( "Content-Disposition: attachment; filename={$filename}" );
		header( 'Expires: 0' );
		header( 'Pragma: public' );

		foreach ( $stack as $line ) {
			$val = explode( ",",$line );
			fputcsv( $fh, $val );
		}

		fclose( $fh );
		wp_die();
	}

}
add_action( 'admin_init', 'thb_csv_export' );
