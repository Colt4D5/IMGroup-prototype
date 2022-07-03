<?php

// load the css + js for the image header popup selector in WP's page editor
add_action( 'admin_print_scripts-post-new.php', 'int_pageheader_admin_script', 11 );
add_action( 'admin_print_scripts-post.php', 'int_pageheader_admin_script', 11 );
function int_pageheader_admin_script() {
    global $post_type;
    if( 'page' == $post_type || 'promo_btn' == $post_type || 'locations' == $post_type || 'post' == $post_type || 'hp_slides' == $post_type )
    wp_enqueue_script( 'pageheader-admin-script', get_template_directory() .'/assets/functions/js/headerimg.js' );
}
add_action( 'admin_print_styles-post-new.php', 'int_pageheader_admin_styles', 11 );
add_action( 'admin_print_styles-post.php', 'int_pageheader_admin_styles', 11 );
function int_pageheader_admin_styles() {
    global $post_type;
    if( 'page' == $post_type || 'promo_btn' == $post_type || 'locations' == $post_type || 'post' == $post_type || 'hp_slides' == $post_type )
    wp_enqueue_style( 'pageheader-admin-styles', get_template_directory() .'/assets/functions/css/headerimg.css' );
}


// page header
$img_collection = '';
$img_collection = get_option('imageset_collection');
if ($img_collection == 'aveda') {
	$img_preset = get_option('aveda_collection');
} elseif ($img_collection == 'stock') {
	$img_preset = get_option('stock_collection');
} else {
	$img_preset = get_option('aveda_collection');
}
// echo $img_preset;
// $imgset_url = 'https://imaginalhosting.com/wp-themes/images/img/' . $img_collection . '/' . $img_preset; // path to your img collection
// $imgset_url = 'https://imaginalhosting.com/wp-themes/images/img/' . $img_collection . '/' . $img_preset;

// $data = file_get_contents($imgset_url . '.json'); // put the contents of the file into a variable

// $header_image_array = json_decode($data, true);
// $header_images = array_column($header_image_array, 'image');
// $header_thumb = array();
// $header_id = array();
// foreach ($header_image_array as $key => $header_image) {
// 	$header_thumb[] = '<span class="headimg_thumb" style="background-image: url('.$imgset_url.'/'.$header_image["image"].');"></span>';
// 	$header_id[] = $header_image["id"];
// }
//$header_id = array_column(json_decode($data, true), 'id');
// $headerchoices = array_combine($header_id, $header_thumb); // e.g., [2, 003.jpg] or [3, 004.jpg]





$base_url = 'https://res.cloudinary.com/imaginal-marketing-group/image/upload/';

$cloudinary_images = $cloudinary->searchApi()
->expression('resource_type=image AND folder:' . $img_collection . '/' . $img_preset)
->sortBy('filename','asc')
->maxResults(50)
->execute();

$resources = $cloudinary_images['resources'];
$img_array = array();
foreach ($resources as $key => $header_img) {
	$img_array[$key] = '<span class="headimg_thumb" style="background-image: url(https://res.cloudinary.com/imaginal-marketing-group/image/upload/'  . $img_collection . '/' . $img_preset . '/' . $header_img['filename'] . '.webp)"></span>';
}
$headerchoices = $img_array;


// Home header
$slides_imgset_url = 'https://imaginalhosting.com/wp-themes/images/img/'; // path to your img collection
$slides_data = file_get_contents($slides_imgset_url . $img_collection . '/' . $img_preset . '.json'); // put the contents of the file into a variable
// header images dropdown
$slides_image_array = json_decode($slides_data, true);
$slides_images = array_column($slides_image_array, 'image');
$slides_thumb = array();
$slides_id = array();
foreach ($slides_image_array as $key => $slides_image) {
  $slides_thumb[] = '<span class="headimg_thumb" style="background-image: url('.$slides_imgset_url.'/'.$slides_image["image"].');"></span>';
  $slides_id[] = $slides_image["id"];
}
//$header_id = array_column(json_decode($data, true), 'id');
$slides_choices = array_combine($slides_id, $slides_thumb); // e.g., [2, 003.jpg] or [3, 004.jpg]


// dropdown style/functionality
$header_dropdown = '<span class="open_thumbs button">Choose Image &raquo;</span>';

// Register Promo Buttons
function add_promos() { 
	// creating (registering) the custom type 
	register_post_type( 'promo_btn', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
	 	// let's now add all the options for this post type
		array('labels' => array(
			'name' => __('Promo Buttons', 'studio'), /* This is the Title of the Group */
			'singular_name' => __('Promo Button', 'studio'), /* This is the individual type */
			'all_items' => __('All Promo Buttons', 'studio'), /* the all items menu item */
			'add_new' => __('Add New', 'studio'), /* The add new menu item */
			'add_new_item' => __('Add New Promo Button', 'studio'), /* Add New Display Title */
			'edit' => __( 'Edit', 'studio' ), /* Edit Dialog */
			'edit_item' => __('Edit Promo Buttons', 'studio'), /* Edit Display Title */
			'new_item' => __('New Promo Button', 'studio'), /* New Display Title */
			'view_item' => __('View Promo Button', 'studio'), /* View Display Title */
			'search_items' => __('Search Promo Buttons', 'studio'), /* Search Custom Type Title */ 
			'not_found' =>  __('Nothing found in the Database.', 'studio'), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __('Nothing found in Trash', 'studio'), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'Promo Buttons for the bottom of all pages', 'studio' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => 'dashicons-grid-view', /* the icon for the custom post type menu */
			'rewrite'	=> array( 'slug' => 'promo_btn', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => 'promo_btn', /* you can rename the slug here */
			'capability_type' => 'page',
			'hierarchical' => false,
			'supports' => array( 'title', 'page-attributes'),
			/* the next one is important, it tells what's enabled in the post editor */
	 	) /* end of options */
	); /* end of register post type */
} 

// adding the function to the Wordpress init
add_action( 'init', 'add_promos');


// Register Promo ACF Fields
if(function_exists("register_field_group")) {
	register_field_group(array (
		'id' => 'acf_custom-css',
		'title' => 'Custom Css',
		'fields' => array (
			array (
				'key' => 'field_59b9819fc9289',
				'label' => 'custom css',
				'name' => 'custom_css',
				'type' => 'textarea',
				'instructions' => 'Add custom css for this page, to be called in head',
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => '',
				'formatting' => 'none',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_homepage',
		'title' => 'Homepage',
		'fields' => array (
			array (
				'key' => 'field_580a2fd614998',
				'label' => 'Show Promo Boxes?',
				'name' => 'show_promo_boxes',
				'type' => 'true_false',
				'message' => '',
				'default_value' => 0,
			),
			array (
				'key' => 'field_580a30da1499f',
				'label' => 'Show Banner Area?',
				'name' => 'show_banner_area',
				'type' => 'true_false',
				'message' => '',
				'default_value' => 0,
			),
			array (
				'key' => 'field_580a34c970339',
				'label' => 'Banner Background Attachment',
				'name' => 'banner_background_attachment',
				'type' => 'radio',
				'choices' => array (
					'scroll' => 'Default',
					'fixed' => 'Fixed',
				),
				'other_choice' => 0,
				'save_other_choice' => 0,
				'default_value' => '',
				'layout' => 'horizontal',
			),
			array (
				'key' => 'field_580a30f6149a0',
				'label' => 'Banner Background Image',
				'name' => 'banner_background_image',
				'type' => 'image',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_580a30da1499f',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'save_format' => 'url',
				'preview_size' => 'medium',
				'library' => 'all',
			),
			array (
				'key' => 'field_580a310e149a1',
				'label' => 'Banner Content',
				'name' => 'banner_content',
				'type' => 'wysiwyg',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_580a30da1499f',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page',
					'operator' => '==',
					'value' => '5',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_page-design',
		'title' => 'Page Design',
		'fields' => array (
			array (
				'key' => 'field_5b7ef4852adb0',
				'label' => 'Custom Header Image?',
				'name' => 'custom_header',
				'type' => 'true_false',
				'message' => '',
				'default_value' => 0,
			),
			array (
				'key' => 'field_586e8995af27b',
				'label' => 'Custom Page Title Image',
				'name' => 'page_title_image',
				'type' => 'image',
				'instructions' => 'Shaded background for the title block',
				'save_format' => 'url',
				'preview_size' => 'thumbnail',
				'library' => 'all',
						'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_5b7ef4852adb0',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
			),
			array (
				'key' => 'field_5b7ef4212edaf',
				'label' => 'Page Header',
				'name' => 'page_preset_header',
				'type' => 'radio',
				'instructions' => $header_dropdown,
				'save_format' => 'url',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_5b7ef4852adb0',
							'operator' => '!=',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'choices' => $headerchoices,
				'other_choice' => 0,
				'save_other_choice' => 0,
				'default_value' => '',
				'layout' => 'vertical',
			),
			array (
				'key' => 'field_56e63b9bbb6dc',
				'label' => 'Header Align',
				'name' => 'header_align',
				'type' => 'radio',
				'instructions' => 'Position of the header background image when scaling to mobile',
				'choices' => array (
					'left' => 'Left',
					'center' => 'Center',
					'right' => 'Right',
				),
				'other_choice' => 0,
				'save_other_choice' => 0,
				'default_value' => 'center',
				'layout' => 'vertical',
			),
			array (
				'key' => 'field_579a6f9111c8e',
				'label' => 'Header Color Scheme',
				'name' => 'header_color_scheme',
				'type' => 'radio',
				'instructions' => 'Sets the color of the page title in the header.',
				'choices' => array (
					'light' => 'Light',
					'dark' => 'Dark',
				),
				'other_choice' => 0,
				'save_other_choice' => 0,
				'default_value' => 'light',
				'layout' => 'horizontal',
			),
            array (
				'key' => 'field_579a6f911ewth3',
				'label' => 'Header Gradient',
				'name' => 'header_gradient',
				'type' => 'radio',
				'instructions' => 'Sets the color of the page gradient.',
				'choices' => array (
                    'none' => 'None',
                    'light' => 'Light',
					'dark' => 'Dark',
				),
				'other_choice' => 0,
				'save_other_choice' => 0,
				'default_value' => 'none',
				'layout' => 'horizontal',
			),
			array (
				'key' => 'field_56cebe9d8adec',
				'label' => 'Which Sidebar?',
				'name' => 'that_sidebar',
				'type' => 'text',
				'instructions' => 'By title or slug, please.',
				'default_value' => 'about',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
					'order_no' => 0,
					'group_no' => 0,
				),
				array (
					'param' => 'page_type',
					'operator' => '!=',
					'value' => 'front_page',
					'order_no' => 1,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'locations',
					'order_no' => 0,
					'group_no' => 1,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
					'order_no' => 0,
					'group_no' => 2,
				),
			)
		),
		'options' => array (
			'position' => 'acf_after_title',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_promo-buttons',
		'title' => 'Promo Buttons',
		'fields' => array (
			array (
				'key' => 'field_5b1ef4652cdb5',
				'label' => 'Custom Image?',
				'name' => 'custom_promo',
				'type' => 'true_false',
				'message' => '',
				'default_value' => 0,
			),
			array (
				'key' => 'field_526e8195cf28b',
				'label' => 'Custom Promo Image',
				'name' => 'custom_promo_image',
				'type' => 'image',
				'save_format' => 'url',
				'preview_size' => 'thumbnail',
				'library' => 'all',
						'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_5b1ef4652cdb5',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
			),
// 			array (
// 				'key' => 'field_577f1b8e85d4b',
// 				'label' => 'Image',
// 				'name' => 'promo_image',
// 				'type' => 'radio',
// 				'instructions' => $header_dropdown,
// 				'conditional_logic' => array (
// 					'status' => 1,
// 					'rules' => array (
// 						array (
// 							'field' => 'field_5b1ef4652cdb5',
// 							'operator' => '!=',
// 							'value' => '1',
// 						),
// 					),
// 					'allorany' => 'all',
// 				),
// 				'choices' => $promo_choices,
// 				'other_choice' => 0,
// 				'save_other_choice' => 0,
// 				'default_value' => '',
// 				'layout' => 'vertical',
// 			),
			array (
				'key' => 'field_577f1bc385d4c',
				'label' => 'Promo Link',
				'name' => 'promo_link',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_577f1bc385aaa',
				'label' => 'Open in new window?',
				'name' => 'promo_target',
				'type' => 'true_false',
				'message' => '',
				'default_value' => 0,
			),
			array (
				'key' => 'field_57d1d5c3033a7',
				'label' => 'Promo Text',
				'name' => 'promo_text',
				'type' => 'wysiwyg',
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
			),
			array (
				'key' => 'field_577f1be185d4d',
				'label' => 'CTA',
				'name' => 'promo_cta',
				'type' => 'text',
				'instructions' => 'Call To Action',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'promo_btn',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'acf_after_title',
			'layout' => 'default',
			'hide_on_screen' => array (
				0 => 'permalink',
				1 => 'the_content',
				2 => 'excerpt',
				3 => 'custom_fields',
				4 => 'discussion',
				5 => 'comments',
				6 => 'revisions',
				7 => 'slug',
				8 => 'author',
				9 => 'format',
				10 => 'featured_image',
				11 => 'categories',
				12 => 'tags',
				13 => 'send-trackbacks',
			),
		),
		'menu_order' => 0,
	));
}