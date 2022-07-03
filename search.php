<?php
/**
 * Search results page
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since   Timber 0.1
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

$templates = array( 'search.twig', 'archive.twig', 'index.twig' );

$context          = Timber::context();
$context['title'] = 'Search results for "' . get_search_query() . '"';
$context['posts'] = new Timber\PostQuery();
$context['sidebar'] = Timber::get_sidebar('sidebar.twig');
$context['menu_title'] = $menu_title;
$context['current_menu'] = $menu_title . '_menu';
$context['blog_sidebar'] = Timber::get_widgets( 'blog_sidebar' );

Timber::render( $templates, $context );
