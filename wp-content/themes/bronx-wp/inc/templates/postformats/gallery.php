<?php
	$thb_id = get_the_ID();
	$attachments = get_post_meta( $thb_id, 'pp_gallery_slider', TRUE);
	$attachment_array = explode(',', $attachments);
	$vars = $wp_query->query_vars;
	$masonry = array_key_exists('masonry', $vars) ? $vars['masonry'] : false;
?>
<div class="post-gallery">
	<div class="carousel slick" data-columns="1" data-navigation="true">
			<?php foreach ($attachment_array as $attachment) : ?>
			    <?php
			    	if ($masonry) {
			    		echo wp_get_attachment_image($attachment, 'bronx-blog-masonry-x2');
			    	} else if (!is_singular()) {
			    		echo wp_get_attachment_image($attachment, 'bronx-blog-post-x2');
			    	} else {
			    		echo wp_get_attachment_image($attachment, 'bronx-blog-detail-x2');
			    	}
			    ?>
			<?php endforeach; ?>
		</div>
</div>