<?php

$post_metabox = array(
  'id'          => 'post_meta_video',
  'title'       => esc_html__( 'Post Settings', 'bronx' ),
  'pages'       => array( 'post' ),
  'context'     => 'normal',
  'priority'    => 'high',
  'fields'      => array(
    array(
      'id'          => 'tab1',
      'label'       => esc_html__( 'Gallery Format', 'bronx' ),
      'type'        => 'tab'
    ),
    array(
      'id'          => 'pp_gallery_slider',
      'type'        => 'gallery',
      'desc'        => esc_html__( 'Images selected here will be displayed inside the gallery.', 'bronx' ),
    ),
    array(
      'id'          => 'tab2',
      'label'       => esc_html__( 'Video Format', 'bronx' ),
      'type'        => 'tab'
    ),
    array(
      'label'       => esc_html__( 'Video URL', 'bronx' ),
      'id'          => 'post_video',
      'type'        => 'textarea-simple',
      'desc'        => esc_html__( 'Video URL. You can find a list of websites you can embed here: <a href="http://codex.wordpress.org/Embeds">Wordpress Embeds</a>', 'bronx' ),
      'rows'        => '5'
    )
  )
);

ot_register_meta_box( $post_metabox );