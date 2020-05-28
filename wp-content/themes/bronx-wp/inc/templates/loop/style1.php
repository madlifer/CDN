<div class="row">
	<section class="small-12 large-8 columns cf blog-section">
	  <?php if ( have_posts() ) :  while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'inc/templates/postbit/style1'); ?>
	  <?php endwhile; ?>
	  <?php the_posts_pagination(array(
	  	'prev_text' 	=> '<span>'.esc_html__( "&larr;", 'bronx' ).'</span>',
	  	'next_text' 	=> '<span>'.esc_html__( "&rarr;", 'bronx' ).'</span>',
	  )); ?>
	  <?php else : ?>
	    <p><?php esc_html_e( 'Please add posts from your WordPress admin page.', 'bronx' ); ?></p>
	  <?php endif; ?>
	</section>
	<?php get_sidebar(); ?>
</div>