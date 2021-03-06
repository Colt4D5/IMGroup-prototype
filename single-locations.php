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
$context['phone_number'] = preg_replace('/\D/', '', get_field('location_phone'));
$context['menu_title'] = $menu_title;
$context['current_menu'] = $menu_title . '_menu';
$context['sidebar'] = Timber::get_sidebar('sidebar.twig');
$context['footer_column_1'] = Timber::get_widgets( 'footer_column_1' );
$context['hours'] = get_option('hours');
$context['contact_info'] = get_option('contact_info');
Timber::render( array( 'single-locations.twig' ), $context );