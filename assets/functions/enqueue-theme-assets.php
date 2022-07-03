<?php

function add_custom_assets() {
  foreach( glob( get_template_directory(). '/assets/css/*.css' ) as $file ) {
    $file = str_replace(get_template_directory(), '', $file);
    // $file contains the name and extension of the file
    wp_register_style( $file.'style', get_template_directory_uri() . $file, array(), false, 'all' );
    wp_enqueue_style( $file . 'style' );
  }


// enqueue all js files in assets/js folder
  foreach( glob( get_template_directory(). '/assets/js/*.js' ) as $file ) {
  $file = str_replace(get_template_directory(), '', $file);
  // $file contains the name and extension of the file
  wp_register_script( $file . 'script', get_template_directory_uri() . $file, [],'1.0.0', true);

	wp_enqueue_script( $file . 'script' );
  }
}
add_action('wp_enqueue_scripts', 'add_custom_assets');