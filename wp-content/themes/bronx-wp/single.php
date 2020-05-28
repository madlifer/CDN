<?php get_header(); ?>
<div class="blog-section no-padding">
	<div class="row align-center">
		<section class="small-12 medium-10 columns cf">
	  <?php if ( have_posts() ) :  while ( have_posts() ) : the_post(); ?>
		  <article itemscope itemtype="http://schema.org/BlogPosting" <?php post_class('post blog-post'); ?> id="post-<?php the_ID(); ?>" role="article">
				<div class="row align-center">
			  	<header class="post-title entry-header small-12 medium-10 columns">
			  		<?php the_title('<h1 class="entry-title" itemprop="headline">', '</h1>' ); ?>
			  	</header>
				</div>
		  	<?php get_template_part( 'inc/templates/postformats/post-meta' ); ?>
		    <?php
		      // The following determines what the post format is and shows the correct file accordingly
		      $format = get_post_format();
		      set_query_var( 'thb_masonry', false );
		      $formats = get_theme_support( 'post-formats' );
		      if ($format && in_array($format, $formats[0] ) ) {
		      	get_template_part( 'inc/templates/postformats/'.$format );
		      } else {
		      	get_template_part( 'inc/templates/postformats/image' );
		      }
		    ?>

		    <div class="row align-center">
		    	<div class="small-12 medium-10 columns">
		    		<div class="post-content entry-content cf">
				    	<?php the_content(); ?>
				    	<?php if ( is_single()) { wp_link_pages(); } ?>
	    			</div>
	    			<?php get_template_part( 'inc/templates/postformats/post-end' ); ?>
	    		</div>
		    </div>
		  </article>
	  <?php endwhile; endif; ?>
	  	<?php if ( comments_open() || get_comments_number() ) : ?>
	  	<!-- Start #comments -->
	  	<section id="comments" class="row align-center">
	  		<div class="small-12 medium-10 columns">
	  			<?php comments_template('', true); ?>
	  		</div>
	  	</section>
	  	<!-- End #comments -->
	  	<?php endif; ?>

	  	<?php get_template_part( 'inc/templates/postformats/post-related' ); ?>
		</section>
	</div>
</div>
<?php get_footer();
