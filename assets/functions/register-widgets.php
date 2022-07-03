<?php

function widgets_init() {

register_sidebar( array(
  'name'          => 'Blog Sidebar',
  'id'            => 'blog_sidebar',
  'before_widget' => '<div class="blog-sidebar-item">',
  'after_widget'  => '</div>',
  'before_title'  => '<h4>',
  'after_title'   => '</h4>',
) );

register_sidebar( array(
  'name'          => 'Footer Column 1',
  'id'            => 'footer_column_1',
  'before_widget' => '<div class="foot-column">',
  'after_widget'  => '</div>',
  'before_title'  => '<h4>',
  'after_title'   => '</h4>',
) );

register_sidebar( array(
  'name'          => 'Footer Column 2',
  'id'            => 'footer_column_2',
  'before_widget' => '<div class="foot-column">',
  'after_widget'  => '</div>',
  'before_title'  => '<h4>',
  'after_title'   => '</h4>',
) );

register_sidebar( array(
  'name'          => 'Footer Column 3',
  'id'            => 'footer_column_3',
  'before_widget' => '<div class="foot-column">',
  'after_widget'  => '</div>',
  'before_title'  => '<h4>',
  'after_title'   => '</h4>',
) );

register_sidebar( array(
  'name'          => 'Footer Column 4',
  'id'            => 'footer_column_4',
  'before_widget' => '<div class="foot-column">',
  'after_widget'  => '</div>',
  'before_title'  => '<h4>',
  'after_title'   => '</h4>',
) );

}
add_action( 'widgets_init', 'widgets_init' );