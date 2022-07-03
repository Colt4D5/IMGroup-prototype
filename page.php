<?php
/**
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

$context['custom_header'] = get_field('custom_header');


//$data = file_get_contents($default_img_url.'.json'); // put the contents of the file into a variable

// query cloudinary api
// $cloudinary_images = $cloudinary->searchApi()
// ->expression('resource_type=image AND folder:' . $imgset_collection . '/' . $imgset_category)
// ->maxResults(1)
// ->execute();

// $total_count = $cloudinary_images["total_count"];

$args = array(
	'post_type' => 'promo_btn',
	'posts_per_page' => '-1',
	'orderby' => 'menu_order',
	'order' => 'ASC'
);
$context['promos'] = Timber::get_posts($args);

$context['menu_title'] = $menu_title;
$context['current_menu'] = $menu_title . '_menu';
$context['sidebar'] = Timber::get_sidebar('sidebar.twig');
Timber::render( array( 'page-' . $timber_post->post_name . '.twig', 'page.twig' ), $context );
