<?php
/**
 * The Template for the sidebar containing the main widget area
 *
 * @package  WordPress
 * @subpackage  Timber
 */

// $side = '';

// if(is_home() || is_singular('post') || is_search() || is_archive()) {
//   $side = dynamic_sidebar('blog');
// } elseif( get_field('that_sidebar', $post->post_parent) ) {
//   $side = wp_nav_menu( array( 'menu_class' => 'interiorsub-nav', 'menu' => get_field('that_sidebar', $post->post_parent) ) );
// } elseif( get_field('that_sidebar') ) {
//   $side = wp_nav_menu( array( 'menu_class' => 'interiorsub-nav', 'menu' => get_field('that_sidebar') ) );
// } else {
//   $side = dynamic_sidebar('default');
// }
$menu_title = '';
if ( get_field('that_sidebar' )) {
  $menu_title = get_field( 'that_sidebar' );
} else {
  $menu_title = 'about';
}


$context = Timber::context();
$timber_post = Timber::get_post();
$context['post'] = $timber_post;
Timber::render( array( 'sidebar.twig' ), $context );
