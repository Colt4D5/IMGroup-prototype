<?php
/*
Template Name: Why Aveda
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

// default headers
$imgset_collection = get_option('imageset_collection');
if ( $imgset_collection == 'aveda' ) {
	$imgset_category = get_option('aveda_collection');
} elseif ( $imgset_collection == 'stock' ) {
	$imgset_category = get_option('stock_collection');
} else {
	$imgset_category = get_option('aveda_collection');
}
$default_img_url = 'https://imaginalhosting.com/wp-themes/images/img/'. $imgset_collection . '/' . $imgset_category;

$data = file_get_contents($default_img_url.'.json'); // put the contents of the file into a variable

$header_image_array = json_decode($data, true);
$context['preset_header'] = $default_img_url . '/' . $header_image_array[get_field('page_preset_header')]['image'];

$timber_post = new Timber\Post();
$context['post'] = $timber_post;
$context['menu_title'] = $menu_title;
$context['current_menu'] = $menu_title . '_menu';
$context['sidebar'] = Timber::get_sidebar('sidebar.twig');
$context['aveda_id'] = get_option('aveda_id');
Timber::render( array( 'template-why-aveda.twig' ), $context );
