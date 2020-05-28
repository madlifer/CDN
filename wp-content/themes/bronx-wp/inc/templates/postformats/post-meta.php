<aside class="post-meta">
	<ul>
		<?php if (has_category()) { ?>
		<li><?php the_category(', '); ?> / </li>
		<?php } ?>
		<li itemprop="datePublished"><time class="time" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php the_time( get_option( 'date_format' ) ); ?></time> / </li>
		<li><?php esc_html_e("by", 'bronx' ); ?> <?php the_author_posts_link(); ?></li>
	</ul>
</aside>