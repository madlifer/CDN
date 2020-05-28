<?php get_header(); ?>
<?php
 	if (is_page()) {
 		$thb_id = $wp_query->get_queried_object_id();
 		$snap_scroll = (get_post_meta( $thb_id, 'snap_scroll', true) !== 'on' ? false : 'snap_scroll');
 		$page_title = get_post_meta( $thb_id, 'page_title', true);
 		$header_container = get_post_meta( $thb_id, 'header_container', true);
 		$VC = class_exists('WPBakeryVisualComposerAbstract');
 	}
?>
<?php if ( have_posts() ) :  while ( have_posts() ) : the_post(); ?>
	<?php if ( $snap_scroll ) { ?>
		<?php the_content();?>
	<?php } else if ( thb_is_woocommerce() ) {
		$class = is_account_page() ? '' : 'page-padding';
		?>
    <?php if (!is_user_logged_in()) { ?>
      <?php the_content(); ?>
    <?php } else { ?>
		<div <?php post_class($class); ?>>
			<div class="row">
				<div class="small-12 columns">
					<div class="post-content no-vc">
						<?php the_content(); ?>
					</div>
				</div>
			</div>
		</div>
    <?php } ?>
	<?php } else { ?>
		<article <?php post_class('post post-detail'); ?> id="post-<?php the_ID(); ?>">
			<div class="post-content">
				<?php if ($VC) { ?>
					<?php if ($page_title =='on' && $header_container != 'on' ) { ?>
					<div class="row">
						<div class="small-12 columns">
							<header class="post-title page-title text-center">
								<?php the_title('<h1 class="entry-title" itemprop="headline">', '</h1>' ); ?>
							</header>
						</div>
					</div>
					<?php } ?>
					<?php the_content('Read More'); ?>
				<?php } else { ?>
					<div class="row">
						<div class="small-12 columns">
							<?php if ($page_title =='on' && $header_container != 'on' ) { ?>
							<header class="post-title page-title">
								<?php the_title('<h1 class="entry-title" itemprop="headline">', '</h1>' ); ?>
							</header>
							<?php } ?>
							<div class="post-content">
							<?php the_content('Read More');?>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>
		</article>
	<?php } ?>
<?php endwhile; endif; ?>
<?php get_footer();