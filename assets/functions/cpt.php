<?php

include_once('register_hp_slides.php');

// Register Homepage Slides
function add_slides() { 
	// creating (registering) the custom type 
	register_post_type( 'hp_slides', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
	 	// let's now add all the options for this post type
		array('labels' => array(
			'name' => __('Homepage Slides', 'studio'), /* This is the Title of the Group */
			'singular_name' => __('Slide', 'studio'), /* This is the individual type */
			'all_items' => __('All Slides', 'studio'), /* the all items menu item */
			'add_new' => __('Add New', 'studio'), /* The add new menu item */
			'add_new_item' => __('Add New Slide', 'studio'), /* Add New Display Title */
			'edit' => __( 'Edit', 'studio' ), /* Edit Dialog */
			'edit_item' => __('Edit Slides', 'studio'), /* Edit Display Title */
			'new_item' => __('New Slide', 'studio'), /* New Display Title */
			'view_item' => __('View Slide', 'studio'), /* View Display Title */
			'search_items' => __('Search Slides', 'studio'), /* Search Custom Type Title */ 
			'not_found' =>  __('Nothing found in the Database.', 'studio'), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __('Nothing found in Trash', 'studio'), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'Slides for the homepage banner', 'studio' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => true,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => 'dashicons-align-center', /* the icon for the custom post type menu */
			'rewrite'	=> array( 'slug' => 'promotion', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => 'promotion', /* you can rename the slug here */
			'capability_type' => 'page',
			'hierarchical' => false,
			'supports' => array( 'title', 'page-attributes'),
			/* the next one is important, it tells what's enabled in the post editor */
	 	) /* end of options */
	); /* end of register post type */
	
	
	
} 

// adding the function to the Wordpress init
add_action( 'init', 'add_slides');

// Add the custom columns to the HP Slides post type:
add_filter( 'manage_hp_slides_posts_columns', 'set_custom_edit_book_columns' );
function set_custom_edit_book_columns($columns) {
//     unset( $columns['author'] );
//     $columns['book_author'] = __( 'Author', 'your_text_domain' );
    $columns['holiday'] = __( 'Is Holiday Slide', 'hp_slides' );

    return $columns;
}

// Add the data to the custom columns for the HP Slides post type:
add_action( 'manage_hp_slides_posts_custom_column' , 'custom_slide_column', 10, 2 );
function custom_slide_column( $column, $post_id ) {
    switch ( $column ) {

        case 'holiday' :
//             echo get_post_meta( $post_id , 'is_holiday_slide' , true ); 
          	if (get_post_meta( $post_id , 'is_holiday_slide' , true ) == 1) {
				echo 'true';
			} else {
				echo 'false';
			}
            break;

    }
}