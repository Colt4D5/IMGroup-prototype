<?php
/*
Template Name: Plus Rewards
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

$context['custom_header'] = get_field('custom_header');

$timber_post = new Timber\Post();
$context['post'] = $timber_post;
$context['menu_title'] = $menu_title;
$context['current_menu'] = $menu_title . '_menu';
$context['sidebar'] = Timber::get_sidebar('sidebar.twig');
$context['aveda_id'] = get_option('aveda_id');
Timber::render( array( 'template-plus-rewards.twig' ), $context );
