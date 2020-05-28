<?php $posttags = get_the_tags(); ?>
<?php if (!empty($posttags)) { ?>
<footer class="article-tags entry-footer">
	<?php
	if ($posttags) {
		$return = '';
		foreach($posttags as $thb_tag) {
			$return .= '<a href="'. esc_url(get_tag_link($thb_tag->term_id)).'" title="'. esc_attr(get_tag_link($thb_tag->name)).'" class="tag-cloud-link tag-link">' . esc_html($thb_tag->name) . '</a> ';
		}
		echo substr($return, 0, -1);
	} ?>
</footer>
<?php } ?>
<?php if (ot_get_option( 'article_author', 'on' ) === 'on' ) { ?>
<section class="authorpage">
	<?php do_action( 'thb_author'); ?>
</section>
<?php }