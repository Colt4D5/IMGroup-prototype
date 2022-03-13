<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * To generate specific templates for your pages you can use:
 * /mytheme/templates/page-mypage.twig
 * (which will still route through this PHP file)
 * OR
 * /mytheme/page-mypage.php
 * (in which case you'll want to duplicate this file and save to the above path)
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

$context = Timber::context();

$timber_post     = new Timber\Post();
$context['post'] = $timber_post;
$args = array(
	'post_type' => 'hp_slides',
	'posts_per_page' => '-1',
	'orderby' => 'menu_order',
	'order' => 'ASC'
	);
$context['headers'] = Timber::get_posts($args);

wp_reset_query();

$args = array(
	'post_type' => 'promo_btn',
	'posts_per_page' => '-1',
	'orderby' => 'menu_order',
	'order' => 'ASC'
	);
$context['promos'] = Timber::get_posts($args);
Timber::render( array( 'page-' . $timber_post->post_name . '.twig', 'page.twig' ), $context );
