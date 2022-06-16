<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * Methods for TimberHelper can be found in the /functions sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

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
Timber::render( '404.twig', $context );
