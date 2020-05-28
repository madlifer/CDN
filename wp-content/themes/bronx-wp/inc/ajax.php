<?php
add_action( 'wp_ajax_nopriv_thb_ajax', 'thb_load_more_posts' );
add_action( 'wp_ajax_thb_ajax', 'thb_load_more_posts' );

function thb_load_more_posts() {
	check_ajax_referer( 'thb_ajax', 'security' );
	$count = filter_input( INPUT_POST, 'count', FILTER_VALIDATE_INT );
	$page  = filter_input( INPUT_POST, 'page', FILTER_VALIDATE_INT );

  $args = array(
		'paged'	           => $page,
		'post_status'      => 'publish',
  	'no_found_rows'    => true,
  );

	$query = new WP_Query( $args );
	if ( $query->have_posts() ) :  while ( $query->have_posts() ) : $query->the_post(); ?>
		<div class="small-12 medium-6 large-4 item columns">
			<?php get_template_part( 'inc/templates/postbit/style2' ); ?>
		</div>
	<?php
	endwhile; endif;
	wp_die();
}

/* Email Subscribe */
add_action( 'wp_ajax_nopriv_thb_subscribe_emails', 'thb_subscribe_emails' );
add_action( 'wp_ajax_thb_subscribe_emails', 'thb_subscribe_emails' );
function thb_subscribe_emails() {
	check_ajax_referer( 'thb_subscription', 'security' );
	// the email
	$email = filter_input( INPUT_POST, 'email', FILTER_SANITIZE_EMAIL );

	//if the email is valid
	if (is_email($email)) {

		//get all the current emails
		$stack = get_option( 'subscribed_emails' );

		//if there are no emails in the database
		if (!$stack) {
			//update the option with the first email as an array
			update_option('subscribed_emails', array($email));
		} else {
			//if the email already exists in the array
			if( in_array($email, $stack) ) {
				echo '<div class="woocommerce-error">'.__('<strong>Oh snap!</strong> That email address is already subscribed!', 'bronx' ).'</div>';
			} else {

				// If there is more than one email, add the new email to the array
				array_push($stack, $email);

				//update the option with the new set of emails
				update_option('subscribed_emails', $stack);

				echo '<div class="woocommerce-message">'. __("<strong>Well done!</strong> Your address has been added", 'bronx' ).'</div>';
			}
		}
	} else {
		echo '<div class="woocommerce-error">'.__("<strong>Oh snap!</strong> Please enter a valid email address", 'bronx' ).'</div>';
	}
	wp_die();
}
