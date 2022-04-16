<?php
/*
Template Name: Team Page
*/

/**
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

$menu_title = '';
if ( get_field('that_sidebar' )) {
  $menu_title = get_field( 'that_sidebar' );
} else {
  $menu_title = 'about';
}

$context = Timber::context();
$timber_post = new Timber\Post();
$context['post'] = $timber_post;
$context['menu_title'] = $menu_title;
$context['current_menu'] = $menu_title . '_menu';
$context['sidebar'] = Timber::get_sidebar('sidebar.twig');

$args = array(
	'post_type' => 'people',
	'posts_per_page' => '-1',
	'orderby' => 'menu_order',
	'order' => 'ASC'
	);
$context['team'] = Timber::get_posts($args);
var_dump($context['team'][9]);

Timber::render( array( 'template-teampage.twig' ), $context );