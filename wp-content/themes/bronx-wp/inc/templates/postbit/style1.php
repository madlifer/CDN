<article itemscope itemtype="http://schema.org/BlogPosting" <?php post_class('post style1'); ?> id="post-<?php the_ID(); ?>" role="article">
	<?php
		$format = get_post_format();
		set_query_var( 'thb_masonry', false );
		$formats = get_theme_support( 'post-formats' );
		if ($format && in_array($format, $formats[0] ) ) {
			get_template_part( 'inc/templates/postformats/'.$format );
		} else {
			get_template_part( 'inc/templates/postformats/image' );
		}
	?>
	<header class="post-title entry-header">
		<?php the_title( sprintf( '<h3 class="entry-title" itemprop="headline"><a href="%s" rel="bookmark" title="%s">', esc_url( get_permalink() ), esc_attr(get_the_title()) ), '</a></h3>' ); ?>
	</header>

	<div class="post-content entry-content">
		<?php the_excerpt(); ?>
	</div>
	<?php get_template_part( 'inc/postformats/post-meta' ); ?>
</article>