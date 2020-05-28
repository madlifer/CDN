<?php add_filter( 'excerpt_length', 'thb_supershort_excerpt_length' ); ?>
<article itemscope itemtype="http://schema.org/BlogPosting" <?php post_class('post'); ?> id="post-<?php the_ID(); ?>" role="article">
	<?php if ( has_post_thumbnail() ) { ?>
	<figure class="post-gallery fresco">
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('bronx-blog-post'); ?></a>
	</figure>
	<?php } ?>
	<header class="post-title">
		<?php the_title( sprintf( '<h4 class="entry-title" itemprop="headline"><a href="%s" rel="bookmark" title="%s">', esc_url( get_permalink() ), esc_attr(get_the_title()) ), '</a></h4>' ); ?>
	</header>
	<div class="post-content">
		<?php the_excerpt(); ?>
	</div>
	<?php get_template_part( 'inc/postformats/post-meta' ); ?>
</article>