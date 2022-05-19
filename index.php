<?php
/**
 * The main template file
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since   Timber 0.1
 */

$menu_title = '';
if ( get_field('that_sidebar' )) {
  $menu_title = get_field( 'that_sidebar' );
} elseif (is_archive() || is_author() || is_category() || is_home() || is_single() || is_tag()) {
  $menu_title = 'blog';
} else {
  $menu_title = 'about';
}

$context = Timber::context();
$context['posts'] = new Timber\PostQuery();
$context['sidebar'] = Timber::get_sidebar('sidebar.twig');
$context['menu_title'] = $menu_title;
$context['current_menu'] = $menu_title . '_menu';
$context['blog_sidebar'] = Timber::get_widgets( 'blog_sidebar' );
$templates = array( 'blog.twig' );
Timber::render( $templates, $context );
