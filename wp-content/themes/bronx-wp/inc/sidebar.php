<?php
function thb_register_sidebars() {
	register_sidebar(array('name' => esc_html__('Blog Sidebar','bronx'), 'id' => 'blog', 'description' => esc_html__('The sidebar visible in the blog page','bronx'), 'before_widget' => '<div id="%1$s" class="widget cf %2$s">', 'after_widget' => '</div>', 'before_title' => '<h6>', 'after_title' => '</h6>'));

	register_sidebar(array('name' => esc_html__('Shop Sidebar','bronx'), 'id' => 'shop', 'description' => esc_html__('The sidebar visible in the shop page, if its enabled in theme options','bronx'), 'before_widget' => '<div id="%1$s" class="widget cf %2$s">', 'after_widget' => '</div>', 'before_title' => '<h6>', 'after_title' => '</h6>'));

	register_sidebar(array('name' => esc_html__('Footer Column 1', 'bronx' ), 'id' => 'footer1', 'description' => esc_html__('Footer - first column', 'bronx' ), 'before_widget' => '<div id="%1$s" class="widget cf %2$s">', 'after_widget' => '</div>', 'before_title' => '<h6>', 'after_title' => '</h6>'));

	register_sidebar(array('name' => esc_html__('Footer Column 2', 'bronx' ), 'id' => 'footer2', 'description' => esc_html__('Footer - second column', 'bronx' ), 'before_widget' => '<div id="%1$s" class="widget cf %2$s">', 'after_widget' => '</div>', 'before_title' => '<h6>', 'after_title' => '</h6>'));

	register_sidebar(array('name' => esc_html__('Footer Column 3', 'bronx' ), 'id' => 'footer3', 'description' => esc_html__('Footer - third column', 'bronx' ), 'before_widget' => '<div id="%1$s" class="widget cf %2$s">', 'after_widget' => '</div>', 'before_title' => '<h6>', 'after_title' => '</h6>'));

	register_sidebar(array('name' => esc_html__('Footer Column 4', 'bronx' ), 'id' => 'footer4', 'description' => esc_html__('Footer - forth column', 'bronx' ), 'before_widget' => '<div id="%1$s" class="widget cf %2$s">', 'after_widget' => '</div>', 'before_title' => '<h6>', 'after_title' => '</h6>'));

	register_sidebar(array('name' => esc_html__('Footer Column 5', 'bronx' ), 'id' => 'footer5', 'description' => esc_html__('Footer - fifth column', 'bronx' ), 'before_widget' => '<div id="%1$s" class="widget cf %2$s">', 'after_widget' => '</div>', 'before_title' => '<h6>', 'after_title' => '</h6>'));

	register_sidebar(array('name' => esc_html__('Footer Column 6', 'bronx' ), 'id' => 'footer6', 'description' => esc_html__('Footer - sixth column', 'bronx' ), 'before_widget' => '<div id="%1$s" class="widget cf %2$s">', 'after_widget' => '</div>', 'before_title' => '<h6>', 'after_title' => '</h6>'));
}
add_action( 'widgets_init', 'thb_register_sidebars' );

// Do Shortcodes inside widgets.
add_filter( 'widget_text', 'do_shortcode' );