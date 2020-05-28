<?php add_filter( 'excerpt_length', 'thb_short_excerpt_length' ); ?>
<article itemscope itemtype="http://schema.org/BlogPosting" <?php post_class('post style2'); ?> id="post-<?php the_ID(); ?>" role="article">
	<?php
		set_query_var( 'thb_masonry', true );
		get_template_part( 'inc/templates/postformats/image' );
	?>
	<header class="post-title entry-header">
		<?php the_title( sprintf( '<h3 class="entry-title" itemprop="headline"><a href="%s" rel="bookmark" title="%s">', esc_url( get_permalink() ), esc_attr(get_the_title()) ), '</a></h3>' ); ?>
	</header>
	<div class="post-content entry-content ">
		<?php the_excerpt(); ?>
	</div>
	<?php get_template_part( 'inc/postformats/post-meta' ); ?>
</article>