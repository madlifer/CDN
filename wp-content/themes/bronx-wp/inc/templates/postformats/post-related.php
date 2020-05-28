<!-- Start Related Posts -->
<?php
	global $post;
  $postId = $post->ID;
  $query = thb_get_blog_posts_related_by_category($postId);
?>
<?php if ($query->have_posts()) : ?>
<aside class="related-posts cf hide-on-print">
	<h4 class="related-title"><?php esc_html_e( 'Related News', 'bronx' ); ?></h4>
	<div class="row">
  <?php while ($query->have_posts()) : $query->the_post(); ?>
    <div class="small-12 medium-4 columns">
    	<?php get_template_part( 'inc/templates/postbit/related'); ?>
    </div>
  <?php endwhile; ?>
  </div>
</aside>
<?php endif; ?>
<?php wp_reset_postdata(); ?>
<!-- End Related Posts -->