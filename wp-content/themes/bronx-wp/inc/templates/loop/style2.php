<div class="row">
	<div class="small-12 columns">
		<section class="row masonry blog-masonry" id="infinitescroll" data-count="<?php echo esc_attr(get_option('posts_per_page')); ?>" data-total="<?php echo esc_attr($wp_query->max_num_pages); ?>" data-security="<?php echo esc_attr( wp_create_nonce( 'thb_ajax' ) ); ?>">
		  <?php if ( have_posts() ) :  while ( have_posts() ) : the_post(); ?>
		  	<div class="small-12 medium-6 large-4 item columns">
		  		<?php get_template_part( 'inc/templates/postbit/style2'); ?>
		  	</div>
		  <?php endwhile; else : ?>
		    <p><?php esc_html_e( 'Please add posts from your WordPress admin page.', 'bronx' ); ?></p>
		  <?php endif; ?>
		</section>
	</div>
</div>
<?php get_footer();