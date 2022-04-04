<?php

$salon_name = 'KLJ Hair Studio';
$salon_name_short = 'KLJ Hair';

function register_salon_settings_page() {
  global $salon_name;
  global $salon_name_short;
  
  add_menu_page(
    $salon_name . ' Info',  // full name
    $salon_name_short,   // name of page in sidebar
    'manage_options',       // permissions
    'klj-hair',             // page slug
    'create_page_callback',     // callback
    'dashicons-cart', // menu icon
    0 // order in WP menu
  );

}

function create_page_callback() {

}