<?php
$sidebar_get = filter_input( INPUT_GET, 'sidebar', FILTER_SANITIZE_STRING );
$sidebar_pos = isset($sidebar_get) ? $sidebar_get : ot_get_option( 'shop_sidebar', 'no');

if ($sidebar_pos == 'no') { return; }

$classes[] = 'sidebar woo small-12 large-3 columns small-order-2';
$classes[] = $sidebar_pos == 'left' ? 'large-order-1' : false;
?>

<aside class="<?php echo esc_attr(implode(' ', $classes)); ?>" role="complementary">
	<?php

		##############################################################################
		# Shop Page Sidebar
		##############################################################################

	 	?>
	<?php dynamic_sidebar('shop'); ?>
</aside>