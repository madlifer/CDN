<?php

/* Body Classes */
function thb_body_classes( $classes ) {
	$thb_id      = get_queried_object_id();
	$page_scroll = get_post_meta( $thb_id, 'page_scroll', true) === 'on' ? 'page_scroll' : '';
	$snap_scroll = get_post_meta( $thb_id, 'snap_scroll', true) === 'on' ? 'snap_scroll' : '';


	/* Classes */
	$classes[] = $page_scroll;
	$classes[] = ! empty( $snap_scroll ) ? 'snap' : '';
	$classes[] = 'thb-single-product-ajax-' . ot_get_option( 'shop_product_ajax_addtocart', 'on' );
	$classes[] = 'header-full-width-' . ot_get_option( 'thb_header_full_width', 'on' );

	return $classes;
}
add_filter( 'body_class', 'thb_body_classes' );

/* Youtube & Vimeo Embeds */
function thb_remove_youtube_controls($code){
  if ( strpos($code, 'youtu.be' ) !== false || strpos($code, 'youtube.com' ) !== false || strpos($code, 'player.vimeo.com' ) !== false){
  		if(strpos($code, 'youtu.be' ) !== false || strpos($code, 'youtube.com' ) !== false) {
      	$return = preg_replace("@src=(['\"])?([^'\">\s]*)@", "src=$1$2&showinfo=0&rel=0&modestbranding=1&wmode=transparent", $code);
  		} else {
      	$return = $code;
  		}
      $return = '<div class="flex-video widescreen' . (strpos($code, 'player.vimeo.com' ) !== false ? ' vimeo' : ' youtube' ).'">' . $return . '</div>';
  } else {
      $return = $code;
  }
  return $return;
}

add_filter( 'embed_handler_html', 'thb_remove_youtube_controls' );
add_filter( 'embed_oembed_html', 'thb_remove_youtube_controls' );

/* Set Revolution Slider Setting */
function thb_revsliderSetAsTheme() {
	if ( function_exists( 'set_revslider_as_theme' ) ){ set_revslider_as_theme(); }
}
add_action( 'init', 'thb_revsliderSetAsTheme' );

/* Category Rel Fix */
function remove_category_list_rel( $output ) {
  return str_replace( ' rel="category tag"', '', $output );
}
add_filter( 'wp_list_categories', 'remove_category_list_rel' );
add_filter( 'the_category', 'remove_category_list_rel' );

/* Author FB, TW & G+ Links */
function thb_new_contactmethods( $contactmethods ) {
	// Add Twitter
	$contactmethods['twitter'] = 'Twitter URL';
	// Add Facebook
	$contactmethods['facebook'] = 'Facebook URL';
	// Add Google+
	$contactmethods['googleplus'] = 'Google Plus URL';

	return $contactmethods;
}
add_filter( 'user_contactmethods','thb_new_contactmethods',10,1);

/* Translate Columns */
function thb_translate_columns($size) {
	if ( $size == 6) {
		return 'medium-2';
	}	elseif ( $size == 5) {
		return 'medium-1/5';
	}	elseif ( $size == 4) {
		return 'medium-3';
	}	elseif ( $size == 3) {
		return 'medium-4';
	}	elseif ( $size == 2) {
		return 'medium-6';
	} else {
		return 'medium-12';
	}
}

/* Font Awesome Array */
function thb_getIconArray(){
	$icons = array(
		'' => '', 'fa-glass' => 'fa-glass', 'fa-music' => 'fa-music', 'fa-search' => 'fa-search', 'fa-envelope-o' => 'fa-envelope-o', 'fa-heart' => 'fa-heart', 'fa-star' => 'fa-star', 'fa-star-o' => 'fa-star-o', 'fa-user' => 'fa-user', 'fa-film' => 'fa-film', 'fa-th-large' => 'fa-th-large', 'fa-th' => 'fa-th', 'fa-th-list' => 'fa-th-list', 'fa-check' => 'fa-check', 'fa-times' => 'fa-times', 'fa-search-plus' => 'fa-search-plus', 'fa-search-minus' => 'fa-search-minus', 'fa-power-off' => 'fa-power-off', 'fa-signal' => 'fa-signal', 'fa-cog' => 'fa-cog', 'fa-trash-o' => 'fa-trash-o', 'fa-home' => 'fa-home', 'fa-file-o' => 'fa-file-o', 'fa-clock-o' => 'fa-clock-o', 'fa-road' => 'fa-road', 'fa-download' => 'fa-download', 'fa-arrow-circle-o-down' => 'fa-arrow-circle-o-down', 'fa-arrow-circle-o-up' => 'fa-arrow-circle-o-up', 'fa-inbox' => 'fa-inbox', 'fa-play-circle-o' => 'fa-play-circle-o', 'fa-repeat' => 'fa-repeat', 'fa-refresh' => 'fa-refresh', 'fa-list-alt' => 'fa-list-alt', 'fa-lock' => 'fa-lock', 'fa-flag' => 'fa-flag', 'fa-headphones' => 'fa-headphones', 'fa-volume-off' => 'fa-volume-off', 'fa-volume-down' => 'fa-volume-down', 'fa-volume-up' => 'fa-volume-up', 'fa-qrcode' => 'fa-qrcode', 'fa-barcode' => 'fa-barcode', 'fa-tag' => 'fa-tag', 'fa-tags' => 'fa-tags', 'fa-book' => 'fa-book', 'fa-bookmark' => 'fa-bookmark', 'fa-print' => 'fa-print', 'fa-camera' => 'fa-camera', 'fa-font' => 'fa-font', 'fa-bold' => 'fa-bold', 'fa-italic' => 'fa-italic', 'fa-text-height' => 'fa-text-height', 'fa-text-width' => 'fa-text-width', 'fa-align-left' => 'fa-align-left', 'fa-align-center' => 'fa-align-center', 'fa-align-right' => 'fa-align-right', 'fa-align-justify' => 'fa-align-justify', 'fa-list' => 'fa-list', 'fa-outdent' => 'fa-outdent', 'fa-indent' => 'fa-indent', 'fa-video-camera' => 'fa-video-camera', 'fa-picture-o' => 'fa-picture-o', 'fa-pencil' => 'fa-pencil', 'fa-map-marker' => 'fa-map-marker', 'fa-adjust' => 'fa-adjust', 'fa-tint' => 'fa-tint', 'fa-pencil-square-o' => 'fa-pencil-square-o', 'fa-share-square-o' => 'fa-share-square-o', 'fa-check-square-o' => 'fa-check-square-o', 'fa-arrows' => 'fa-arrows', 'fa-step-backward' => 'fa-step-backward', 'fa-fast-backward' => 'fa-fast-backward', 'fa-backward' => 'fa-backward', 'fa-play' => 'fa-play', 'fa-pause' => 'fa-pause', 'fa-stop' => 'fa-stop', 'fa-forward' => 'fa-forward', 'fa-fast-forward' => 'fa-fast-forward', 'fa-step-forward' => 'fa-step-forward', 'fa-eject' => 'fa-eject', 'fa-chevron-left' => 'fa-chevron-left', 'fa-chevron-right' => 'fa-chevron-right', 'fa-plus-circle' => 'fa-plus-circle', 'fa-minus-circle' => 'fa-minus-circle', 'fa-times-circle' => 'fa-times-circle', 'fa-check-circle' => 'fa-check-circle', 'fa-question-circle' => 'fa-question-circle', 'fa-info-circle' => 'fa-info-circle', 'fa-crosshairs' => 'fa-crosshairs', 'fa-times-circle-o' => 'fa-times-circle-o', 'fa-check-circle-o' => 'fa-check-circle-o', 'fa-ban' => 'fa-ban', 'fa-arrow-left' => 'fa-arrow-left', 'fa-arrow-right' => 'fa-arrow-right', 'fa-arrow-up' => 'fa-arrow-up', 'fa-arrow-down' => 'fa-arrow-down', 'fa-share' => 'fa-share', 'fa-expand' => 'fa-expand', 'fa-compress' => 'fa-compress', 'fa-plus' => 'fa-plus', 'fa-minus' => 'fa-minus', 'fa-asterisk' => 'fa-asterisk', 'fa-exclamation-circle' => 'fa-exclamation-circle', 'fa-gift' => 'fa-gift', 'fa-leaf' => 'fa-leaf', 'fa-fire' => 'fa-fire', 'fa-eye' => 'fa-eye', 'fa-eye-slash' => 'fa-eye-slash', 'fa-exclamation-triangle' => 'fa-exclamation-triangle', 'fa-plane' => 'fa-plane', 'fa-calendar' => 'fa-calendar', 'fa-random' => 'fa-random', 'fa-comment' => 'fa-comment', 'fa-magnet' => 'fa-magnet', 'fa-chevron-up' => 'fa-chevron-up', 'fa-chevron-down' => 'fa-chevron-down', 'fa-retweet' => 'fa-retweet', 'fa-shopping-cart' => 'fa-shopping-cart', 'fa-folder' => 'fa-folder', 'fa-folder-open' => 'fa-folder-open', 'fa-arrows-v' => 'fa-arrows-v', 'fa-arrows-h' => 'fa-arrows-h', 'fa-bar-chart' => 'fa-bar-chart', 'fa-twitter-square' => 'fa-twitter-square', 'fa-facebook-square' => 'fa-facebook-square', 'fa-camera-retro' => 'fa-camera-retro', 'fa-key' => 'fa-key', 'fa-cogs' => 'fa-cogs', 'fa-comments' => 'fa-comments', 'fa-thumbs-o-up' => 'fa-thumbs-o-up', 'fa-thumbs-o-down' => 'fa-thumbs-o-down', 'fa-star-half' => 'fa-star-half', 'fa-heart-o' => 'fa-heart-o', 'fa-sign-out' => 'fa-sign-out', 'fa-linkedin-square' => 'fa-linkedin-square', 'fa-thumb-tack' => 'fa-thumb-tack', 'fa-external-link' => 'fa-external-link', 'fa-sign-in' => 'fa-sign-in', 'fa-trophy' => 'fa-trophy', 'fa-github-square' => 'fa-github-square', 'fa-upload' => 'fa-upload', 'fa-lemon-o' => 'fa-lemon-o', 'fa-phone' => 'fa-phone', 'fa-square-o' => 'fa-square-o', 'fa-bookmark-o' => 'fa-bookmark-o', 'fa-phone-square' => 'fa-phone-square', 'fa-twitter' => 'fa-twitter', 'fa-facebook' => 'fa-facebook', 'fa-github' => 'fa-github', 'fa-unlock' => 'fa-unlock', 'fa-credit-card' => 'fa-credit-card', 'fa-rss' => 'fa-rss', 'fa-hdd-o' => 'fa-hdd-o', 'fa-bullhorn' => 'fa-bullhorn', 'fa-bell' => 'fa-bell', 'fa-certificate' => 'fa-certificate', 'fa-hand-o-right' => 'fa-hand-o-right', 'fa-hand-o-left' => 'fa-hand-o-left', 'fa-hand-o-up' => 'fa-hand-o-up', 'fa-hand-o-down' => 'fa-hand-o-down', 'fa-arrow-circle-left' => 'fa-arrow-circle-left', 'fa-arrow-circle-right' => 'fa-arrow-circle-right', 'fa-arrow-circle-up' => 'fa-arrow-circle-up', 'fa-arrow-circle-down' => 'fa-arrow-circle-down', 'fa-globe' => 'fa-globe', 'fa-wrench' => 'fa-wrench', 'fa-tasks' => 'fa-tasks', 'fa-filter' => 'fa-filter', 'fa-briefcase' => 'fa-briefcase', 'fa-arrows-alt' => 'fa-arrows-alt', 'fa-users' => 'fa-users', 'fa-link' => 'fa-link', 'fa-cloud' => 'fa-cloud', 'fa-flask' => 'fa-flask', 'fa-scissors' => 'fa-scissors', 'fa-files-o' => 'fa-files-o', 'fa-paperclip' => 'fa-paperclip', 'fa-floppy-o' => 'fa-floppy-o', 'fa-square' => 'fa-square', 'fa-bars' => 'fa-bars', 'fa-list-ul' => 'fa-list-ul', 'fa-list-ol' => 'fa-list-ol', 'fa-strikethrough' => 'fa-strikethrough', 'fa-underline' => 'fa-underline', 'fa-table' => 'fa-table', 'fa-magic' => 'fa-magic', 'fa-truck' => 'fa-truck', 'fa-pinterest' => 'fa-pinterest', 'fa-pinterest-square' => 'fa-pinterest-square', 'fa-google-plus-square' => 'fa-google-plus-square', 'fa-google-plus' => 'fa-google-plus', 'fa-money' => 'fa-money', 'fa-caret-down' => 'fa-caret-down', 'fa-caret-up' => 'fa-caret-up', 'fa-caret-left' => 'fa-caret-left', 'fa-caret-right' => 'fa-caret-right', 'fa-columns' => 'fa-columns', 'fa-sort' => 'fa-sort', 'fa-sort-desc' => 'fa-sort-desc', 'fa-sort-asc' => 'fa-sort-asc', 'fa-envelope' => 'fa-envelope', 'fa-linkedin' => 'fa-linkedin', 'fa-undo' => 'fa-undo', 'fa-gavel' => 'fa-gavel', 'fa-tachometer' => 'fa-tachometer', 'fa-comment-o' => 'fa-comment-o', 'fa-comments-o' => 'fa-comments-o', 'fa-bolt' => 'fa-bolt', 'fa-sitemap' => 'fa-sitemap', 'fa-umbrella' => 'fa-umbrella', 'fa-clipboard' => 'fa-clipboard', 'fa-lightbulb-o' => 'fa-lightbulb-o', 'fa-exchange' => 'fa-exchange', 'fa-cloud-download' => 'fa-cloud-download', 'fa-cloud-upload' => 'fa-cloud-upload', 'fa-user-md' => 'fa-user-md', 'fa-stethoscope' => 'fa-stethoscope', 'fa-suitcase' => 'fa-suitcase', 'fa-bell-o' => 'fa-bell-o', 'fa-coffee' => 'fa-coffee', 'fa-cutlery' => 'fa-cutlery', 'fa-file-text-o' => 'fa-file-text-o', 'fa-building-o' => 'fa-building-o', 'fa-hospital-o' => 'fa-hospital-o', 'fa-ambulance' => 'fa-ambulance', 'fa-medkit' => 'fa-medkit', 'fa-fighter-jet' => 'fa-fighter-jet', 'fa-beer' => 'fa-beer', 'fa-h-square' => 'fa-h-square', 'fa-plus-square' => 'fa-plus-square', 'fa-angle-double-left' => 'fa-angle-double-left', 'fa-angle-double-right' => 'fa-angle-double-right', 'fa-angle-double-up' => 'fa-angle-double-up', 'fa-angle-double-down' => 'fa-angle-double-down', 'fa-angle-left' => 'fa-angle-left', 'fa-angle-right' => 'fa-angle-right', 'fa-angle-up' => 'fa-angle-up', 'fa-angle-down' => 'fa-angle-down', 'fa-desktop' => 'fa-desktop', 'fa-laptop' => 'fa-laptop', 'fa-tablet' => 'fa-tablet', 'fa-mobile' => 'fa-mobile', 'fa-circle-o' => 'fa-circle-o', 'fa-quote-left' => 'fa-quote-left', 'fa-quote-right' => 'fa-quote-right', 'fa-spinner' => 'fa-spinner', 'fa-circle' => 'fa-circle', 'fa-reply' => 'fa-reply', 'fa-github-alt' => 'fa-github-alt', 'fa-folder-o' => 'fa-folder-o', 'fa-folder-open-o' => 'fa-folder-open-o', 'fa-smile-o' => 'fa-smile-o', 'fa-frown-o' => 'fa-frown-o', 'fa-meh-o' => 'fa-meh-o', 'fa-gamepad' => 'fa-gamepad', 'fa-keyboard-o' => 'fa-keyboard-o', 'fa-flag-o' => 'fa-flag-o', 'fa-flag-checkered' => 'fa-flag-checkered', 'fa-terminal' => 'fa-terminal', 'fa-code' => 'fa-code', 'fa-reply-all' => 'fa-reply-all', 'fa-star-half-o' => 'fa-star-half-o', 'fa-location-arrow' => 'fa-location-arrow', 'fa-crop' => 'fa-crop', 'fa-code-fork' => 'fa-code-fork', 'fa-chain-broken' => 'fa-chain-broken', 'fa-question' => 'fa-question', 'fa-info' => 'fa-info', 'fa-exclamation' => 'fa-exclamation', 'fa-superscript' => 'fa-superscript', 'fa-subscript' => 'fa-subscript', 'fa-eraser' => 'fa-eraser', 'fa-puzzle-piece' => 'fa-puzzle-piece', 'fa-microphone' => 'fa-microphone', 'fa-microphone-slash' => 'fa-microphone-slash', 'fa-shield' => 'fa-shield', 'fa-calendar-o' => 'fa-calendar-o', 'fa-fire-extinguisher' => 'fa-fire-extinguisher', 'fa-rocket' => 'fa-rocket', 'fa-maxcdn' => 'fa-maxcdn', 'fa-chevron-circle-left' => 'fa-chevron-circle-left', 'fa-chevron-circle-right' => 'fa-chevron-circle-right', 'fa-chevron-circle-up' => 'fa-chevron-circle-up', 'fa-chevron-circle-down' => 'fa-chevron-circle-down', 'fa-html5' => 'fa-html5', 'fa-css3' => 'fa-css3', 'fa-anchor' => 'fa-anchor', 'fa-unlock-alt' => 'fa-unlock-alt', 'fa-bullseye' => 'fa-bullseye', 'fa-ellipsis-h' => 'fa-ellipsis-h', 'fa-ellipsis-v' => 'fa-ellipsis-v', 'fa-rss-square' => 'fa-rss-square', 'fa-play-circle' => 'fa-play-circle', 'fa-ticket' => 'fa-ticket', 'fa-minus-square' => 'fa-minus-square', 'fa-minus-square-o' => 'fa-minus-square-o', 'fa-level-up' => 'fa-level-up', 'fa-level-down' => 'fa-level-down', 'fa-check-square' => 'fa-check-square', 'fa-pencil-square' => 'fa-pencil-square', 'fa-external-link-square' => 'fa-external-link-square', 'fa-share-square' => 'fa-share-square', 'fa-compass' => 'fa-compass', 'fa-caret-square-o-down' => 'fa-caret-square-o-down', 'fa-caret-square-o-up' => 'fa-caret-square-o-up', 'fa-caret-square-o-right' => 'fa-caret-square-o-right', 'fa-eur' => 'fa-eur', 'fa-gbp' => 'fa-gbp', 'fa-usd' => 'fa-usd', 'fa-inr' => 'fa-inr', 'fa-jpy' => 'fa-jpy', 'fa-rub' => 'fa-rub', 'fa-krw' => 'fa-krw', 'fa-btc' => 'fa-btc', 'fa-file' => 'fa-file', 'fa-file-text' => 'fa-file-text', 'fa-sort-alpha-asc' => 'fa-sort-alpha-asc', 'fa-sort-alpha-desc' => 'fa-sort-alpha-desc', 'fa-sort-amount-asc' => 'fa-sort-amount-asc', 'fa-sort-amount-desc' => 'fa-sort-amount-desc', 'fa-sort-numeric-asc' => 'fa-sort-numeric-asc', 'fa-sort-numeric-desc' => 'fa-sort-numeric-desc', 'fa-thumbs-up' => 'fa-thumbs-up', 'fa-thumbs-down' => 'fa-thumbs-down', 'fa-youtube-square' => 'fa-youtube-square', 'fa-youtube' => 'fa-youtube', 'fa-xing' => 'fa-xing', 'fa-xing-square' => 'fa-xing-square', 'fa-youtube-play' => 'fa-youtube-play', 'fa-dropbox' => 'fa-dropbox', 'fa-stack-overflow' => 'fa-stack-overflow', 'fa-instagram' => 'fa-instagram', 'fa-flickr' => 'fa-flickr', 'fa-adn' => 'fa-adn', 'fa-bitbucket' => 'fa-bitbucket', 'fa-bitbucket-square' => 'fa-bitbucket-square', 'fa-tumblr' => 'fa-tumblr', 'fa-tumblr-square' => 'fa-tumblr-square', 'fa-long-arrow-down' => 'fa-long-arrow-down', 'fa-long-arrow-up' => 'fa-long-arrow-up', 'fa-long-arrow-left' => 'fa-long-arrow-left', 'fa-long-arrow-right' => 'fa-long-arrow-right', 'fa-apple' => 'fa-apple', 'fa-windows' => 'fa-windows', 'fa-android' => 'fa-android', 'fa-linux' => 'fa-linux', 'fa-dribbble' => 'fa-dribbble', 'fa-skype' => 'fa-skype', 'fa-foursquare' => 'fa-foursquare', 'fa-trello' => 'fa-trello', 'fa-female' => 'fa-female', 'fa-male' => 'fa-male', 'fa-gratipay' => 'fa-gratipay', 'fa-sun-o' => 'fa-sun-o', 'fa-moon-o' => 'fa-moon-o', 'fa-archive' => 'fa-archive', 'fa-bug' => 'fa-bug', 'fa-vk' => 'fa-vk', 'fa-weibo' => 'fa-weibo', 'fa-renren' => 'fa-renren', 'fa-pagelines' => 'fa-pagelines', 'fa-stack-exchange' => 'fa-stack-exchange', 'fa-arrow-circle-o-right' => 'fa-arrow-circle-o-right', 'fa-arrow-circle-o-left' => 'fa-arrow-circle-o-left', 'fa-caret-square-o-left' => 'fa-caret-square-o-left', 'fa-dot-circle-o' => 'fa-dot-circle-o', 'fa-wheelchair' => 'fa-wheelchair', 'fa-vimeo-square' => 'fa-vimeo-square', 'fa-try' => 'fa-try', 'fa-plus-square-o' => 'fa-plus-square-o', 'fa-space-shuttle' => 'fa-space-shuttle', 'fa-slack' => 'fa-slack', 'fa-envelope-square' => 'fa-envelope-square', 'fa-wordpress' => 'fa-wordpress', 'fa-openid' => 'fa-openid', 'fa-university' => 'fa-university', 'fa-graduation-cap' => 'fa-graduation-cap', 'fa-yahoo' => 'fa-yahoo', 'fa-google' => 'fa-google', 'fa-reddit' => 'fa-reddit', 'fa-reddit-square' => 'fa-reddit-square', 'fa-stumbleupon-circle' => 'fa-stumbleupon-circle', 'fa-stumbleupon' => 'fa-stumbleupon', 'fa-delicious' => 'fa-delicious', 'fa-digg' => 'fa-digg', 'fa-pied-piper-pp' => 'fa-pied-piper-pp', 'fa-pied-piper-alt' => 'fa-pied-piper-alt', 'fa-drupal' => 'fa-drupal', 'fa-joomla' => 'fa-joomla', 'fa-language' => 'fa-language', 'fa-fax' => 'fa-fax', 'fa-building' => 'fa-building', 'fa-child' => 'fa-child', 'fa-paw' => 'fa-paw', 'fa-spoon' => 'fa-spoon', 'fa-cube' => 'fa-cube', 'fa-cubes' => 'fa-cubes', 'fa-behance' => 'fa-behance', 'fa-behance-square' => 'fa-behance-square', 'fa-steam' => 'fa-steam', 'fa-steam-square' => 'fa-steam-square', 'fa-recycle' => 'fa-recycle', 'fa-car' => 'fa-car', 'fa-taxi' => 'fa-taxi', 'fa-tree' => 'fa-tree', 'fa-spotify' => 'fa-spotify', 'fa-deviantart' => 'fa-deviantart', 'fa-soundcloud' => 'fa-soundcloud', 'fa-database' => 'fa-database', 'fa-file-pdf-o' => 'fa-file-pdf-o', 'fa-file-word-o' => 'fa-file-word-o', 'fa-file-excel-o' => 'fa-file-excel-o', 'fa-file-powerpoint-o' => 'fa-file-powerpoint-o', 'fa-file-image-o' => 'fa-file-image-o', 'fa-file-archive-o' => 'fa-file-archive-o', 'fa-file-audio-o' => 'fa-file-audio-o', 'fa-file-video-o' => 'fa-file-video-o', 'fa-file-code-o' => 'fa-file-code-o', 'fa-vine' => 'fa-vine', 'fa-codepen' => 'fa-codepen', 'fa-jsfiddle' => 'fa-jsfiddle', 'fa-life-ring' => 'fa-life-ring', 'fa-circle-o-notch' => 'fa-circle-o-notch', 'fa-rebel' => 'fa-rebel', 'fa-empire' => 'fa-empire', 'fa-git-square' => 'fa-git-square', 'fa-git' => 'fa-git', 'fa-hacker-news' => 'fa-hacker-news', 'fa-tencent-weibo' => 'fa-tencent-weibo', 'fa-qq' => 'fa-qq', 'fa-weixin' => 'fa-weixin', 'fa-paper-plane' => 'fa-paper-plane', 'fa-paper-plane-o' => 'fa-paper-plane-o', 'fa-history' => 'fa-history', 'fa-circle-thin' => 'fa-circle-thin', 'fa-header' => 'fa-header', 'fa-paragraph' => 'fa-paragraph', 'fa-sliders' => 'fa-sliders', 'fa-share-alt' => 'fa-share-alt', 'fa-share-alt-square' => 'fa-share-alt-square', 'fa-bomb' => 'fa-bomb', 'fa-futbol-o' => 'fa-futbol-o', 'fa-tty' => 'fa-tty', 'fa-binoculars' => 'fa-binoculars', 'fa-plug' => 'fa-plug', 'fa-slideshare' => 'fa-slideshare', 'fa-twitch' => 'fa-twitch', 'fa-yelp' => 'fa-yelp', 'fa-newspaper-o' => 'fa-newspaper-o', 'fa-wifi' => 'fa-wifi', 'fa-calculator' => 'fa-calculator', 'fa-paypal' => 'fa-paypal', 'fa-google-wallet' => 'fa-google-wallet', 'fa-cc-visa' => 'fa-cc-visa', 'fa-cc-mastercard' => 'fa-cc-mastercard', 'fa-cc-discover' => 'fa-cc-discover', 'fa-cc-amex' => 'fa-cc-amex', 'fa-cc-paypal' => 'fa-cc-paypal', 'fa-cc-stripe' => 'fa-cc-stripe', 'fa-bell-slash' => 'fa-bell-slash', 'fa-bell-slash-o' => 'fa-bell-slash-o', 'fa-trash' => 'fa-trash', 'fa-copyright' => 'fa-copyright', 'fa-at' => 'fa-at', 'fa-eyedropper' => 'fa-eyedropper', 'fa-paint-brush' => 'fa-paint-brush', 'fa-birthday-cake' => 'fa-birthday-cake', 'fa-area-chart' => 'fa-area-chart', 'fa-pie-chart' => 'fa-pie-chart', 'fa-line-chart' => 'fa-line-chart', 'fa-lastfm' => 'fa-lastfm', 'fa-lastfm-square' => 'fa-lastfm-square', 'fa-toggle-off' => 'fa-toggle-off', 'fa-toggle-on' => 'fa-toggle-on', 'fa-bicycle' => 'fa-bicycle', 'fa-bus' => 'fa-bus', 'fa-ioxhost' => 'fa-ioxhost', 'fa-angellist' => 'fa-angellist', 'fa-cc' => 'fa-cc', 'fa-ils' => 'fa-ils', 'fa-meanpath' => 'fa-meanpath', 'fa-buysellads' => 'fa-buysellads', 'fa-connectdevelop' => 'fa-connectdevelop', 'fa-dashcube' => 'fa-dashcube', 'fa-forumbee' => 'fa-forumbee', 'fa-leanpub' => 'fa-leanpub', 'fa-sellsy' => 'fa-sellsy', 'fa-shirtsinbulk' => 'fa-shirtsinbulk', 'fa-simplybuilt' => 'fa-simplybuilt', 'fa-skyatlas' => 'fa-skyatlas', 'fa-cart-plus' => 'fa-cart-plus', 'fa-cart-arrow-down' => 'fa-cart-arrow-down', 'fa-diamond' => 'fa-diamond', 'fa-ship' => 'fa-ship', 'fa-user-secret' => 'fa-user-secret', 'fa-motorcycle' => 'fa-motorcycle', 'fa-street-view' => 'fa-street-view', 'fa-heartbeat' => 'fa-heartbeat', 'fa-venus' => 'fa-venus', 'fa-mars' => 'fa-mars', 'fa-mercury' => 'fa-mercury', 'fa-transgender' => 'fa-transgender', 'fa-transgender-alt' => 'fa-transgender-alt', 'fa-venus-double' => 'fa-venus-double', 'fa-mars-double' => 'fa-mars-double', 'fa-venus-mars' => 'fa-venus-mars', 'fa-mars-stroke' => 'fa-mars-stroke', 'fa-mars-stroke-v' => 'fa-mars-stroke-v', 'fa-mars-stroke-h' => 'fa-mars-stroke-h', 'fa-neuter' => 'fa-neuter', 'fa-genderless' => 'fa-genderless', 'fa-facebook-official' => 'fa-facebook-official', 'fa-pinterest-p' => 'fa-pinterest-p', 'fa-whatsapp' => 'fa-whatsapp', 'fa-server' => 'fa-server', 'fa-user-plus' => 'fa-user-plus', 'fa-user-times' => 'fa-user-times', 'fa-bed' => 'fa-bed', 'fa-viacoin' => 'fa-viacoin', 'fa-train' => 'fa-train', 'fa-subway' => 'fa-subway', 'fa-medium' => 'fa-medium', 'fa-y-combinator' => 'fa-y-combinator', 'fa-optin-monster' => 'fa-optin-monster', 'fa-opencart' => 'fa-opencart', 'fa-expeditedssl' => 'fa-expeditedssl', 'fa-battery-full' => 'fa-battery-full', 'fa-battery-three-quarters' => 'fa-battery-three-quarters', 'fa-battery-half' => 'fa-battery-half', 'fa-battery-quarter' => 'fa-battery-quarter', 'fa-battery-empty' => 'fa-battery-empty', 'fa-mouse-pointer' => 'fa-mouse-pointer', 'fa-i-cursor' => 'fa-i-cursor', 'fa-object-group' => 'fa-object-group', 'fa-object-ungroup' => 'fa-object-ungroup', 'fa-sticky-note' => 'fa-sticky-note', 'fa-sticky-note-o' => 'fa-sticky-note-o', 'fa-cc-jcb' => 'fa-cc-jcb', 'fa-cc-diners-club' => 'fa-cc-diners-club', 'fa-clone' => 'fa-clone', 'fa-balance-scale' => 'fa-balance-scale', 'fa-hourglass-o' => 'fa-hourglass-o', 'fa-hourglass-start' => 'fa-hourglass-start', 'fa-hourglass-half' => 'fa-hourglass-half', 'fa-hourglass-end' => 'fa-hourglass-end', 'fa-hourglass' => 'fa-hourglass', 'fa-hand-rock-o' => 'fa-hand-rock-o', 'fa-hand-paper-o' => 'fa-hand-paper-o', 'fa-hand-scissors-o' => 'fa-hand-scissors-o', 'fa-hand-lizard-o' => 'fa-hand-lizard-o', 'fa-hand-spock-o' => 'fa-hand-spock-o', 'fa-hand-pointer-o' => 'fa-hand-pointer-o', 'fa-hand-peace-o' => 'fa-hand-peace-o', 'fa-trademark' => 'fa-trademark', 'fa-registered' => 'fa-registered', 'fa-creative-commons' => 'fa-creative-commons', 'fa-gg' => 'fa-gg', 'fa-gg-circle' => 'fa-gg-circle', 'fa-tripadvisor' => 'fa-tripadvisor', 'fa-odnoklassniki' => 'fa-odnoklassniki', 'fa-odnoklassniki-square' => 'fa-odnoklassniki-square', 'fa-get-pocket' => 'fa-get-pocket', 'fa-wikipedia-w' => 'fa-wikipedia-w', 'fa-safari' => 'fa-safari', 'fa-chrome' => 'fa-chrome', 'fa-firefox' => 'fa-firefox', 'fa-opera' => 'fa-opera', 'fa-internet-explorer' => 'fa-internet-explorer', 'fa-television' => 'fa-television', 'fa-contao' => 'fa-contao', 'fa-500px' => 'fa-500px', 'fa-amazon' => 'fa-amazon', 'fa-calendar-plus-o' => 'fa-calendar-plus-o', 'fa-calendar-minus-o' => 'fa-calendar-minus-o', 'fa-calendar-times-o' => 'fa-calendar-times-o', 'fa-calendar-check-o' => 'fa-calendar-check-o', 'fa-industry' => 'fa-industry', 'fa-map-pin' => 'fa-map-pin', 'fa-map-signs' => 'fa-map-signs', 'fa-map-o' => 'fa-map-o', 'fa-map' => 'fa-map', 'fa-commenting' => 'fa-commenting', 'fa-commenting-o' => 'fa-commenting-o', 'fa-houzz' => 'fa-houzz', 'fa-vimeo' => 'fa-vimeo', 'fa-black-tie' => 'fa-black-tie', 'fa-fonticons' => 'fa-fonticons', 'fa-reddit-alien' => 'fa-reddit-alien', 'fa-edge' => 'fa-edge', 'fa-credit-card-alt' => 'fa-credit-card-alt', 'fa-codiepie' => 'fa-codiepie', 'fa-modx' => 'fa-modx', 'fa-fort-awesome' => 'fa-fort-awesome', 'fa-usb' => 'fa-usb', 'fa-product-hunt' => 'fa-product-hunt', 'fa-mixcloud' => 'fa-mixcloud', 'fa-scribd' => 'fa-scribd', 'fa-pause-circle' => 'fa-pause-circle', 'fa-pause-circle-o' => 'fa-pause-circle-o', 'fa-stop-circle' => 'fa-stop-circle', 'fa-stop-circle-o' => 'fa-stop-circle-o', 'fa-shopping-bag' => 'fa-shopping-bag', 'fa-shopping-basket' => 'fa-shopping-basket', 'fa-hashtag' => 'fa-hashtag', 'fa-bluetooth' => 'fa-bluetooth', 'fa-bluetooth-b' => 'fa-bluetooth-b', 'fa-percent' => 'fa-percent', 'fa-gitlab' => 'fa-gitlab', 'fa-wpbeginner' => 'fa-wpbeginner', 'fa-wpforms' => 'fa-wpforms', 'fa-envira' => 'fa-envira', 'fa-universal-access' => 'fa-universal-access', 'fa-wheelchair-alt' => 'fa-wheelchair-alt', 'fa-question-circle-o' => 'fa-question-circle-o', 'fa-blind' => 'fa-blind', 'fa-audio-description' => 'fa-audio-description', 'fa-volume-control-phone' => 'fa-volume-control-phone', 'fa-braille' => 'fa-braille', 'fa-assistive-listening-systems' => 'fa-assistive-listening-systems', 'fa-american-sign-language-interpreting' => 'fa-american-sign-language-interpreting', 'fa-deaf' => 'fa-deaf', 'fa-glide' => 'fa-glide', 'fa-glide-g' => 'fa-glide-g', 'fa-sign-language' => 'fa-sign-language', 'fa-low-vision' => 'fa-low-vision', 'fa-viadeo' => 'fa-viadeo', 'fa-viadeo-square' => 'fa-viadeo-square', 'fa-snapchat' => 'fa-snapchat', 'fa-snapchat-ghost' => 'fa-snapchat-ghost', 'fa-snapchat-square' => 'fa-snapchat-square', 'fa-pied-piper' => 'fa-pied-piper', 'fa-first-order' => 'fa-first-order', 'fa-yoast' => 'fa-yoast', 'fa-themeisle' => 'fa-themeisle', 'fa-google-plus-official' => 'fa-google-plus-official', 'fa-font-awesome' => 'fa-font-awesome'
	);
  return $icons;
}
/* Secondary Area */
function thb_secondary_area() {
	$header_cart     = ot_get_option( 'header_cart' );
	$header_search   = ot_get_option( 'header_search' );
	$header_wishlist = ot_get_option( 'header_wishlist' );

	if ( $header_wishlist !== 'off' ) { do_action( 'thb_quick_wishlist' ); }
	if ( $header_cart !== 'off' ) { do_action( 'thb_quick_cart' ); }
	if ( $header_search !== 'off' ) { do_action( 'thb_quick_search' ); }
	do_action( 'thb_mobile_toggle' );
}
add_action('thb_secondary_area', 'thb_secondary_area', 1);

/* Thb Mobile Toggle */
function thb_mobile_toggle() {
	?>
	<a class="mobile-toggle" data-target="open-menu">
		<span></span><span></span><span></span>
	</a>
	<?php
}
add_action( 'thb_mobile_toggle', 'thb_mobile_toggle',3 );

/* Excerpts */
add_filter( 'excerpt_length', 'thb_default_excerpt_length' );
add_filter( 'excerpt_more', 'thb_default_excerpt_more' );

function thb_default_excerpt_length() {
	return 45;
}

function thb_short_excerpt_length() {
	return 32;
}

function thb_supershort_excerpt_length() {
	return 15;
}

function thb_default_excerpt_more(){
	return "&hellip;";
}

/* Thb Header Search */
function thb_quick_search() {
 ?>
	<a href="#searchpopup" rel="inline" data-class="quick-search" class="quick_search">
		<?php get_template_part( 'assets/img/svg/search.svg' ); ?>
	</a>
<?php
	function thb_add_searchform() {
	$search_results = ot_get_option( 'search_results' );
	?>
	   <aside id="searchpopup" class="mfp-hide theme-popup large">
   			<label><?php esc_html_e('What are you looking for?', 'bronx' ); ?></label>
   			<?php
   				if ( $search_results =='products' && class_exists( 'WooCommerce' )) {
   					if ( !defined( 'YITH_WCAS' ) ) {
   						get_product_search_form();
   					} else {
   						echo do_shortcode('[yith_woocommerce_ajax_search]' );
   					}
   				} else {
   					get_search_form();
   				}
   			?>
	   </aside>
	<?php
	}
	add_action( 'wp_footer', 'thb_add_searchform', 100 );
}
add_action( 'thb_quick_search', 'thb_quick_search', 3 );

/**
 * Shorten large numbers into abbreviations (i.e. 1,500 = 1.5k)
 *
 * @param int    $number  Number to shorten
 * @return String   A number with a symbol
 */
function thb_numberAbbreviation($number) {
    $abbrevs = array(12 => "T", 9 => "B", 6 => "M", 3 => "K", 0 => "");

	if ( $number > 999) {
	    foreach($abbrevs as $exponent => $abbrev) {
	        if($number >= pow(10, $exponent)) {
	        	$display_num = $number / pow(10, $exponent);
	        	$decimals = ($exponent >= 3 && round($display_num) < 100) ? 1 : 0;
	            return number_format($display_num,$decimals) . $abbrev;
	        }
	    }
	} else {
		return $number;
	}
}

/* Page Content */
function thb_page_content( $page_id ) {
	if ( $page_id ) {
		$args = array(
		    'page_id' => apply_filters( 'wpml_object_id', $page_id, 'page' ),
		    'post_status' => 'publish'
		);
		$page_query = new WP_Query($args);
		if ($page_query->have_posts()) : while ($page_query->have_posts()) : $page_query->the_post();
			the_content();
		endwhile; endif;
		wp_reset_postdata();
		echo '<style>';
		echo get_post_meta($page_id, '_wpb_shortcodes_custom_css', true );
		echo '</style>';
	}
}
add_action( 'thb_page_content', 'thb_page_content', 99, 1 );

/* Thb Newsletter Popup */
function thb_popup() {
	if ( ! is_admin() && (ot_get_option( 'popup' ) === 'on' )) {
		$cookie = isset($_COOKIE['bronx_popup']) ? $_COOKIE['bronx_popup'] : false;
		if ( ! $cookie ) {
			$popup_content = ot_get_option( 'popup_content' );
	 		?>
			<aside id="popup" rel="inline-auto" class="mfp-hide theme-popup subscription" data-class="popup">
				<?php if ( $popup_content) { echo do_shortcode($popup_content); } ?>
				<form class="newsletter-form" action="#" method="post" data-security="<?php echo esc_attr( wp_create_nonce( 'thb_subscription' ) ); ?>">
					<input placeholder="<?php esc_attr_e("Your E-Mail",'bronx' ); ?>" type="text" name="widget_subscribe" class="widget_subscribe">
					<button type="submit" name="submit"><?php esc_html_e("&rarr;",'bronx' ); ?></button>
				</form>
				<div class="result"></div>
			</aside>
			<?php

		}
	}
}
add_action( 'wp_footer', 'thb_popup', 3 );

function thb_popup_cookie() {
	$popup_interval = ot_get_option( 'popup-interval', 1 );
	$time           = '';
	switch ( $popup_interval ) {
		case '0':
			$time = 0;
			break;
		case '1':
			$time = DAY_IN_SECONDS;
			break;
		case '2':
			$time = DAY_IN_SECONDS * 2;
			break;
		case '3':
			$time = DAY_IN_SECONDS * 3;
			break;
		case '7':
			$time = WEEK_IN_SECONDS;
			break;
		case '14':
			$time = WEEK_IN_SECONDS * 2;
			break;
		case '21':
			$time = WEEK_IN_SECONDS * 3;
			break;
		case '30':
			$time = DAY_IN_SECONDS * 30;
			break;
	}
	if ( $time ) {
		if (isset($_COOKIE['bronx_popup'])) {
			return;
		} else {
			setcookie('bronx_popup', '1', time() + $time, COOKIEPATH, COOKIE_DOMAIN );
		}
	} else {
		setcookie('bronx_popup', '', time() - 3600, COOKIEPATH, COOKIE_DOMAIN );
	}
}
add_action( 'init', 'thb_popup_cookie' );

/* Author */
function thb_author($id) {
	$id = $id ? $id : get_the_author_meta( 'ID' );
	?>
	<?php echo get_avatar( $id , '164' ); ?>
	<div class="author-content">
		<h5><a href="<?php echo esc_url(get_author_posts_url( $id )); ?>"><?php the_author_meta('display_name', $id ); ?></a></h5>
		<p><?php the_author_meta('description', $id ); ?></p>
		<?php if(get_the_author_meta('url', $id ) !== '' ) { ?>
			<a href="<?php echo esc_url(get_the_author_meta('url', $id )); ?>"><i class="fa fa-link"></i></a>
		<?php } ?>
		<?php if(get_the_author_meta('twitter', $id ) !== '' ) { ?>
			<a href="<?php echo esc_url(get_the_author_meta('twitter', $id )); ?>" class="twitter"><i class="fa fa-twitter"></i></a>
		<?php } ?>
		<?php if(get_the_author_meta('facebook', $id ) !== '' ) { ?>
			<a href="<?php echo esc_url(get_the_author_meta('facebook', $id )); ?>" class="facebook"><i class="fa fa-facebook"></i></a>
		<?php } ?>
		<?php if(get_the_author_meta('googleplus', $id ) !== '' ) { ?>
			<a href="<?php echo esc_url(get_the_author_meta('googleplus', $id )); ?>" class="google-plus"><i class="fa fa-google-plus"></i></a>
		<?php } ?>
	</div>
	<?php
}
add_action( 'thb_author', 'thb_author',3 );

// Related Posts by Category
function thb_get_blog_posts_related_by_category($post_id, $args=array()) {
	$post_categories = wp_get_post_categories( $post_id );
  $args = wp_parse_args($args,array(
    'category__in'        => $post_categories,
    'post__not_in'        => array( $post_id ),
    'ignore_sticky_posts' => 1,
    'orderby'             => 'rand',
  	'showposts'           => 3,
  	'no_found_rows'       => true,
  ));
  $query = new WP_Query( $args );
	wp_reset_postdata();
  return $query;
}

/* Social Icons in footer */
function thb_social() {
 ?>
	<?php if ( $fb_link = ot_get_option( 'fb_link' )) { ?>
	<a href="<?php echo esc_url($fb_link); ?>" target="_blank" class="facebook"><i class="fa fa-facebook"></i></a>
	<?php } ?>
	<?php if ( $pin_link = ot_get_option( 'pinterest_link' )) { ?>
	<a href="<?php echo esc_url($pin_link); ?>" target="_blank" class="pinterest"><i class="fa fa-pinterest"></i></a>
	<?php } ?>
	<?php if ( $tw_link = ot_get_option( 'twitter_link' )) { ?>
	<a href="<?php echo esc_url($tw_link); ?>" target="_blank" class="twitter"><i class="fa fa-twitter"></i></a>
	<?php } ?>
	<?php if ( $li_link = ot_get_option( 'linkedin_link' )) { ?>
	<a href="<?php echo esc_url($li_link); ?>" target="_blank" class="linkedin"><i class="fa fa-linkedin"></i></a>
	<?php } ?>
	<?php if ( $ins_link = ot_get_option( 'instragram_link' )) { ?>
	<a href="<?php echo esc_url($ins_link); ?>" target="_blank" class="instagram"><i class="fa fa-instagram"></i></a>
	<?php } ?>
	<?php if ( $xing_link = ot_get_option( 'xing_link' )) { ?>
	<a href="<?php echo esc_url($xing_link); ?>" target="_blank" class="xing"><i class="fa fa-xing"></i></a>
	<?php } ?>
	<?php if ( $tu_link = ot_get_option( 'tumblr_link' )) { ?>
	<a href="<?php echo esc_url($tu_link); ?>" target="_blank" class="tumblr"><i class="fa fa-tumblr"></i></a>
	<?php } ?>
	<?php if ( $vk_link = ot_get_option( 'vk_link' )) { ?>
	<a href="<?php echo esc_url($vk_link); ?>" target="_blank" class="vk"><i class="fa fa-vk"></i></a>
	<?php } ?>
	<?php if ( $sc_link = ot_get_option( 'soundcloud_link' )) { ?>
	<a href="<?php echo esc_url($sc_link); ?>" target="_blank" class="soundcloud"><i class="fa fa-soundcloud"></i></a>
	<?php } ?>
	<?php if ( $dri_link = ot_get_option( 'dribbble_link' )) { ?>
	<a href="<?php echo esc_url($dri_link); ?>" target="_blank" class="dribbble"><i class="fa fa-dribbble"></i></a>
	<?php } ?>
	<?php if ( $yt_link = ot_get_option( 'youtube_link' )) { ?>
	<a href="<?php echo esc_url($yt_link); ?>" target="_blank" class="youtube"><i class="fa fa-youtube"></i></a>
	<?php } ?>
	<?php if ( $sf_link = ot_get_option( 'spotify_link' )) { ?>
	<a href="<?php echo esc_url($sf_link); ?>" target="_blank" class="spotify"><i class="fa fa-spotify"></i></a>
	<?php } ?>
	<?php if ( $be_link = ot_get_option( 'behance_link' )) { ?>
	<a href="<?php echo esc_url($be_link); ?>" target="_blank" class="behance"><i class="fa fa-behance"></i></a>
	<?php } ?>
	<?php if ( $da_link = ot_get_option( 'deviantart_link' )) { ?>
	<a href="<?php echo esc_url($da_link); ?>" target="_blank" class="deviantart"><i class="fa fa-deviantart"></i></a>
	<?php } ?>
<?php
}
add_action( 'thb_social', 'thb_social',3 );

/* Social Icons */
function thb_social_header() {
	?>
	<?php if (ot_get_option( 'fb_link_header' )) { ?>
	<a href="<?php echo esc_url(ot_get_option( 'fb_link_header' )); ?>" class="facebook icon-1x" target="_blank"><i class="fa fa-facebook"></i></a>
	<?php } ?>
	<?php if (ot_get_option( 'pinterest_link_header' )) { ?>
	<a href="<?php echo esc_url(ot_get_option( 'pinterest_link_header' )); ?>" class="pinterest icon-1x" target="_blank"><i class="fa fa-pinterest"></i></a>
	<?php } ?>
	<?php if (ot_get_option( 'twitter_link_header' )) { ?>
	<a href="<?php echo esc_url(ot_get_option( 'twitter_link_header' )); ?>" class="twitter icon-1x" target="_blank"><i class="fa fa-twitter"></i></a>
	<?php } ?>
	<?php if (ot_get_option( 'linkedin_link_header' )) { ?>
	<a href="<?php echo esc_url(ot_get_option( 'linkedin_link_header' )); ?>" class="linkedin icon-1x" target="_blank"><i class="fa fa-linkedin"></i></a>
	<?php } ?>
	<?php if (ot_get_option( 'instragram_link_header' )) { ?>
	<a href="<?php echo esc_url(ot_get_option( 'instragram_link_header' )); ?>" class="instagram icon-1x" target="_blank"><i class="fa fa-instagram"></i></a>
	<?php } ?>
	<?php if (ot_get_option( 'xing_link_header' )) { ?>
	<a href="<?php echo esc_url(ot_get_option( 'xing_link_header' )); ?>" class="xing icon-1x" target="_blank"><i class="fa fa-xing"></i></a>
	<?php } ?>
	<?php if (ot_get_option( 'tumblr_link_header' )) { ?>
	<a href="<?php echo esc_url(ot_get_option( 'tumblr_link_header' )); ?>" class="tumblr icon-1x" target="_blank"><i class="fa fa-tumblr"></i></a>
	<?php } ?>
	<?php if (ot_get_option( 'vk_link_header' )) { ?>
	<a href="<?php echo esc_url(ot_get_option( 'vk_link_header' )); ?>" class="vk icon-1x" target="_blank"><i class="fa fa-vk"></i></a>
	<?php } ?>
	<?php if (ot_get_option( 'soundcloud_link' )) { ?>
	<a href="<?php echo esc_url(ot_get_option( 'soundcloud_link' )); ?>" class="soundcloud icon-1x" target="_blank"><i class="fa fa-soundcloud"></i></a>
	<?php } ?>
	<?php if (ot_get_option( 'dribbble_link_header' )) { ?>
	<a href="<?php echo esc_url(ot_get_option( 'dribbble_link_header' )); ?>" class="dribbble icon-1x" target="_blank"><i class="fa fa-dribbble"></i></a>
	<?php } ?>
	<?php if (ot_get_option( 'youtube_link_header' )) { ?>
	<a href="<?php echo esc_url(ot_get_option( 'youtube_link_header' )); ?>" class="youtube icon-1x" target="_blank"><i class="fa fa-youtube"></i></a>
	<?php } ?>
	<?php if (ot_get_option( 'spotify_link_header' )) { ?>
	<a href="<?php echo esc_url(ot_get_option( 'spotify_link_header' )); ?>" class="spotify icon-1x" target="_blank"><i class="fa fa-spotify"></i></a>
	<?php } ?>
	<?php
}
add_action( 'thb_social_header', 'thb_social_header',3 );

function thb_social_product($id = false) {
	$thb_id       = $id ? $id : get_the_ID();
	$permalink    = get_permalink( $thb_id);
	$title        = the_title_attribute( array( 'echo' => 0, 'post' => $thb_id ) );
	$image_id     = get_post_thumbnail_id( $thb_id );
	$image        = wp_get_attachment_image_src( $image_id, 'full' );
	$twitter_user = ot_get_option( 'twitter_bar_username', 'fuel_themes' );
	$sharing_type = ot_get_option( 'sharing_buttons' ) ? ot_get_option( 'sharing_buttons' ) : array();
 ?>
 	<?php if (!empty($sharing_type)) { ?>
 	<div class="share-container">
		<aside class="share-article">
			<a href="#" class="product_share"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
				 width="16.007px" height="19.996px" viewBox="0 0 16.007 19.996" enable-background="new 0 0 16.007 19.996" xml:space="preserve">
					<path d="M7.644,1.797v11.937h0.918V1.851l3.203,3.151l0.697-0.686L8.076,0L3.689,4.315l0.697,0.686L7.644,1.797z M11.013,7.188
						v0.799l4.19,0.011v11.2h-14.4v-11.2l4.389-0.011V7.188H0v12.808h16.007V7.188H11.013z"/>
			</svg> <?php esc_html_e('Share This Product', 'bronx' ); ?></a>
			<div class="icons">
				<div class="inner">
			<?php if (in_array('facebook',$sharing_type)) { ?>
			<a href="<?php echo 'http://www.facebook.com/sharer.php?u=' . urlencode( esc_url( $permalink ) ).''; ?>" class="boxed-icon facebook social"><i class="fa fa-facebook"></i></a>
			<?php } ?>
			<?php if (in_array('twitter',$sharing_type)) { ?>
			<a href="<?php echo 'https://twitter.com/intent/tweet?text=' . htmlspecialchars(urlencode(html_entity_decode($title, ENT_COMPAT, 'UTF-8' )), ENT_COMPAT, 'UTF-8' ) . '&url=' . urlencode( esc_url( $permalink ) ) . '&via=' . get_bloginfo( 'name' ) . ''; ?>" class="boxed-icon twitter social "><i class="fa fa-twitter"></i></a>
			<?php } ?>
			<?php if (in_array('pinterest',$sharing_type)) { ?>
			<a href="<?php echo 'http://pinterest.com/pin/create/link/?url=' . esc_url( $permalink ) . '&amp;media=' . ( ! empty( $image[0] ) ? $image[0] : '' ) . ''; ?>" class="boxed-icon pinterest social" nopin="nopin" data-pin-no-hover="true"><i class="fa fa-pinterest"></i></a>
			<?php } ?>
			<?php if (in_array('vk', $sharing_type)) { ?>
			<a href="<?php echo 'http://vkontakte.ru/share.php?url=' . esc_url( $permalink ); ?>" class="boxed-icon vk social"><i class="fa fa-vk"></i></a>
			<?php } ?>
				</div>
			</div>
		</aside>
	</div>
	<?php } ?>
<?php
}
add_action( 'thb_social_product', 'thb_social_product', 3, 3 );

/* Payment Icons */
function thb_payment() {
?>
	<?php if (ot_get_option( 'payment_visa' ) !== 'off' ) { ?>
		<figure class="paymenttypes visa"></figure>
	<?php } ?>
	<?php if (ot_get_option( 'payment_mc' ) !== 'off' ) { ?>
		<figure class="paymenttypes mc"></figure>
	<?php } ?>
	<?php if (ot_get_option( 'payment_pp' ) !== 'off' ) { ?>
		<figure class="paymenttypes paypal"></figure>
	<?php } ?>
	<?php if (ot_get_option( 'payment_discover' ) !== 'off' ) { ?>
		<figure class="paymenttypes discover"></figure>
	<?php } ?>
	<?php if (ot_get_option( 'payment_amazon' ) !== 'off' ) { ?>
		<figure class="paymenttypes amazon"></figure>
	<?php } ?>
	<?php if (ot_get_option( 'payment_stripe' ) !== 'off' ) { ?>
		<figure class="paymenttypes stripe"></figure>
	<?php } ?>
	<?php if (ot_get_option( 'payment_amex' ) !== 'off' ) { ?>
		<figure class="paymenttypes amex"></figure>
	<?php } ?>
	<?php if (ot_get_option( 'payment_diners' ) !== 'off' ) { ?>
		<figure class="paymenttypes diners"></figure>
	<?php } ?>
	<?php if (ot_get_option( 'payment_wallet' ) !== 'off' ) { ?>
		<figure class="paymenttypes wallet"></figure>
	<?php } ?>
	<?php if (ot_get_option( 'payment_apple' ) !== 'off' ) { ?>
		<figure class="paymenttypes applepay"></figure>
	<?php } ?>
<?php
}
add_action( 'thb_payment', 'thb_payment',3 );

/* Load Template */
function thb_load_template_part($template_name) {
  ob_start();
  get_template_part($template_name);
  $var = ob_get_clean();
  return $var;
}

/* Add Shortcode */
function thb_add_short( $name, $call ) {
  $func = 'add' . '_shortcode';
  return $func( $name, $call );
}

/* Encoding */
function thb_encode( $value ) {
  $func = 'base64' . '_encode';
  return $func( $value );
}
function thb_decode( $value ) {
  $func = 'base64' . '_decode';
  return $func( $value );
}

/* Mobile Menu */
function thb_mobile_menu() {
	$ls = ot_get_option( 'subheader_ls' ) === 'on';
	$cs = (ot_get_option( 'subheader_cs' ) === 'on' && !is_account_page()) && shortcode_exists('currency_switcher' );
	$col = ( ($ls && !$cs) || (!$ls && $cs)) ? 'small-12' : 'small-6';
	?>
		<nav id="mobile-menu">
			<?php if ( $ls || $cs) { ?>
			<div class="row full-width-row no-padding no-row-padding">
				<?php if ( $ls) { ?>
				<div class="<?php echo esc_attr($col);?> columns">
					<?php if ( $ls) { do_action( 'thb_language_switcher' ); } ?>
				</div>
				<?php } ?>
				<?php if ( $cs) { ?>
				<div class="<?php echo esc_attr($col);?> columns">
					<?php if ( $cs) { ?>
					<div class="select-wrapper currency_switcher"><?php do_action( 'currency_switcher' ); ?></div>
					<?php } ?>
				</div>
				<?php } ?>
			</div>
			<?php } ?>
			<div class="custom_scroll" id="menu-scroll">
				<?php if(has_nav_menu('mobile-menu' )) { ?>
				  <?php wp_nav_menu( array( 'theme_location' => 'mobile-menu', 'depth' => 3, 'container' => false, 'menu_class' => 'mobile-menu', 'walker' => new thb_mobileDropdown ) ); ?>
				<?php } else { ?>
					<ul class="mobile-menu">
						<li><a href="<?php echo get_admin_url().'nav-menus.php'; ?>"><?php esc_html_e( 'Please assign a menu', 'bronx' ); ?></a></a></li>
					</ul>
				<?php } ?>
				<div class="social-links">
					<?php do_action( 'thb_social_header' ); ?>
				</div>
				<nav class="subheader-menu">
					<?php if ( has_nav_menu('acc-menu-in' ) && is_user_logged_in()) { ?>
					  <?php wp_nav_menu( array( 'theme_location' => 'acc-menu-in', 'depth' => 1, 'container' => false ) ); ?>
					<?php } elseif ( has_nav_menu('acc-menu-out' ) && !is_user_logged_in()) { ?>
						<?php wp_nav_menu( array( 'theme_location' => 'acc-menu-out', 'depth' => 1, 'container' => false ) ); ?>
					<?php } ?>
				</nav>
				<div class="menu-footer">
					<?php echo do_shortcode( ot_get_option( 'menu_footer' ) ); ?>
				</div>
			</div>
		</nav>
	<?php
}
add_action( 'thb_mobile_menu', 'thb_mobile_menu',3 );

/* WooCommerce Check */
function thb_wc_supported() {
	return class_exists( 'WooCommerce' );
}
function thb_is_woocommerce() {
	if ( ! thb_wc_supported() ) {
		return false;
	}
	return ( is_woocommerce() || is_cart() || is_checkout() || is_account_page() );
}

/* Header Container Check */
function thb_header_container($header_container) {
	$cond = true;
	if(thb_wc_supported()) {
		if ((thb_is_woocommerce() || $header_container === 'on' ) && !is_product()) {
			$cond = true;
		} else {
			$cond = false;
		}
	} elseif ( $header_container === 'on' ) {
		$cond = true;
	} else {
		$cond = false;
	}
	return $cond;
}

/* Post Categories Array */
function thb_blogCategories(){
	$blog_categories = get_categories();
	$out = array();
	foreach($blog_categories as $category) {
		$out[$category->name] = $category->cat_ID;
	}
	return $out;
}

/* Product Categories Array */
function thb_productCategories(){
	if ( ! thb_wc_supported() ) {
		return array();
	}
	$args = array(
		'orderby'    => 'name',
		'order'      => 'ASC',
		'hide_empty' => false,
	);

	$product_categories = get_terms( 'product_cat', $args );
	$out = array();

	if ( $product_categories) {
		foreach($product_categories as $product_category) {
			$out[$product_category->name.' ID: '.$product_category->term_id] = $product_category->slug;
		}
	}
	return $out;
}


/* Human time */
function thb_human_time_diff_enhanced( $duration = 60 ) {

	$post_time = get_the_time('U' );
	$human_time = '';

	$time_now = date('U' );

	// use human time if less that $duration days ago (60 days by default)
	// 60 seconds * 60 minutes * 24 hours * $duration days
	if ( $post_time > $time_now - ( 60 * 60 * 24 * $duration ) ) {
		$human_time = sprintf( __( '%s ago', 'bronx' ), human_time_diff( $post_time, current_time( 'timestamp' ) ) );
	} else {
		$human_time = get_the_date();
	}

	return $human_time;

}

// Custom filter function to modify default gallery shortcode output
function get_id($inc = false) {
  static $id;
  if ( $inc) {
    $id++;
  }
  return $id;
}
add_filter(
  'post_gallery',
  function() {
    get_id(true);
    add_filter( 'wp_get_attachment_link', function($link) {
      $id = get_id();
      return str_replace('<a href=', '<a class="fresco" data-fresco-group="group-'.$id.'" data-fresco-group-options="thumbnails: false, overflow: true" data-fresco-type="image" href=', $link);
    });
  }
);


function thb_dns_prefetch() {
	echo '
	<meta http-equiv="x-dns-prefetch-control" content="on">
	<link rel="dns-prefetch" href="//fonts.googleapis.com" />
	<link rel="dns-prefetch" href="//fonts.gstatic.com" />
	<link rel="dns-prefetch" href="//0.gravatar.com/" />
	<link rel="dns-prefetch" href="//2.gravatar.com/" />
	<link rel="dns-prefetch" href="//1.gravatar.com/" />
	';
}
add_action('wp_head', 'thb_dns_prefetch', 0);