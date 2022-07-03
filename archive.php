<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since   Timber 0.2
 */

$menu_title = '';
if (is_archive() || is_author() || is_category() || is_home() || is_single() || is_tag() || is_search() ) {
  $menu_title = 'blog';
} elseif ( get_field('that_sidebar' )) {
  $menu_title = get_field( 'that_sidebar' );
} else {
  $menu_title = 'about';
}

$templates = array( 'archive.twig', 'index.twig' );

$context = Timber::context();

$context['custom_header'] = get_field('custom_header');

$context['title'] = 'Archive';
if ( is_day() ) {
	$context['title'] = 'Day: ' . get_the_date( 'D M Y' );
} elseif ( is_month() ) {
	$context['title'] = 'Month: ' . get_the_date( 'M Y' );
} elseif ( is_year() ) {
	$context['title'] = 'Year: ' . get_the_date( 'Y' );
} elseif ( is_tag() ) {
	$context['title'] = 'Tag: ' . single_tag_title( '', false );
} elseif ( is_category() ) {
	$context['title'] = 'Category: ' . single_cat_title( '', false );
	array_unshift( $templates, 'archive-' . get_query_var( 'cat' ) . '.twig' );
} elseif ( is_post_type_archive() ) {
	$context['title'] = post_type_archive_title( '', false );
	array_unshift( $templates, 'archive-' . get_post_type() . '.twig' );
}

$context['posts'] = new Timber\PostQuery();
$context['sidebar'] = Timber::get_sidebar('sidebar.twig');
$context['menu_title'] = $menu_title;
$context['current_menu'] = $menu_title . '_menu';
$context['blog_sidebar'] = Timber::get_widgets( 'blog_sidebar' );

Timber::render( $templates, $context );
