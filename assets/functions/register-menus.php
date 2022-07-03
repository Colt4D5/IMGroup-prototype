<?php 

function register_theme_menus () {
	register_nav_menus( [
			'primary-menu' 		=> 'Primary Menu',
			'services-menu' 		=> 'Services Menu',
			'about-menu' 		=> 'About Menu',
			'locations-menu'	=> 'Locations Menu',
			'aveda-menu'	=> 'Aveda Menu',
			'footer-menu'	 		=> 'Footer Menu' 
	] );
}
add_action( 'init', 'register_theme_menus' );