<?php
	$vars = $wp_query->query_vars;
	$masonry = array_key_exists('masonry', $vars) ? $vars['masonry'] : false;
?>
<?php if ( has_post_thumbnail() ) { ?>
<figure class="post-gallery">
	<?php
	    $image_id = get_post_thumbnail_id();
	    $image_link = wp_get_attachment_image_src($image_id,'full');
	?>
	<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr(the_title_attribute()); ?>">
		<?php
			if ($masonry) {
				the_post_thumbnail('bronx-blog-masonry-x2');
			} else if (!is_singular()) {
				the_post_thumbnail('bronx-blog-post-x2');
			} else {
				the_post_thumbnail('bronx-blog-detail-x2');
			}
		?>
	</a>
</figure>
<?php }