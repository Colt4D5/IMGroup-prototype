<?php
/*
Template Name: Full Width (No Sidebar)
*/


/**
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

$context = Timber::context();
$timber_post = new Timber\Post();
$context['post'] = $timber_post;

$context['custom_header'] = get_field('custom_header');

Timber::render( array( 'template-full-width.twig' ), $context );
