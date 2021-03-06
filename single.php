<?php
/**
 * The Template for displaying all single posts
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

$menu_title = '';
if (is_archive() || is_author() || is_category() || is_home() || is_single() || is_tag() || is_search() ) {
  $menu_title = 'blog';
} elseif ( get_field('that_sidebar' )) {
  $menu_title = get_field( 'that_sidebar' );
} else {
  $menu_title = 'about';
}

$context['custom_header'] = get_field('custom_header');

$context         = Timber::context();
$timber_post     = Timber::get_post();
$context['post'] = $timber_post;
$context['category'] = get_the_category_list(', ');
$context['sidebar'] = Timber::get_sidebar('sidebar.twig');
$context['menu_title'] = $menu_title;
$context['current_menu'] = $menu_title . '_menu';
$context['blog_sidebar'] = Timber::get_widgets( 'blog_sidebar' );

if ( post_password_required( $timber_post->ID ) ) {
	Timber::render( 'single-password.twig', $context );
} else {
	Timber::render( array( 'single-' . $timber_post->ID . '.twig', 'single-' . $timber_post->post_type . '.twig', 'single-' . $timber_post->slug . '.twig', 'single.twig' ), $context );
}
