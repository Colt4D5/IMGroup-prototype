<?php

// load the css + js for the image header popup selector in WP's page editor
// add_action( 'admin_print_scripts-post-new.php', 'pageheader_admin_script', 11 );
// add_action( 'admin_print_scripts-post.php', 'pageheader_admin_script', 11 );
// function pageheader_admin_script() {
//     global $post_type;
//     if( 'page' == $post_type || 'promo_btn' == $post_type || 'locations' == $post_type || 'post' == $post_type || 'hp_slides' == $post_type )
//     wp_enqueue_script( 'pageheader-admin-script', '/wp-content/plugins/homepage-slides/assets/headerimg.js' );
// }
// add_action( 'admin_print_styles-post-new.php', 'pageheader_admin_styles', 11 );
// add_action( 'admin_print_styles-post.php', 'pageheader_admin_styles', 11 );
// function pageheader_admin_styles() {
//     global $post_type;
//     if( 'page' == $post_type || 'promo_btn' == $post_type || 'locations' == $post_type || 'post' == $post_type || 'hp_slides' == $post_type )
//     wp_enqueue_style( 'pageheader-admin-styles', '/wp-content/plugins/homepage-slides/assets/headerimg.css' );
// }

// add_action( 'admin_print_scripts-post-new.php', 'home_pageheader_admin_script', 11 );
// add_action( 'admin_print_scripts-post.php', 'home_pageheader_admin_script', 11 );
// function home_pageheader_admin_script() {
//     global $post_type;
//     if( 'page' == $post_type || 'promo_btn' == $post_type || 'locations' == $post_type || 'post' == $post_type || 'hp_slides' == $post_type )
//     wp_enqueue_script( 'pageheader-admin-script', get_template_directory() .'/assets/functions/js/headerimg.js' );
// }
// add_action( 'admin_print_styles-post-new.php', 'home_pageheader_admin_styles', 11 );
// add_action( 'admin_print_styles-post.php', 'home_pageheader_admin_styles', 11 );
// function home_pageheader_admin_styles() {
//     global $post_type;
//     if( 'page' == $post_type || 'promo_btn' == $post_type || 'locations' == $post_type || 'post' == $post_type || 'hp_slides' == $post_type )
//     wp_enqueue_style( 'pageheader-admin-styles', get_template_directory() .'/assets/functions/css/headerimg.css' );
// }

// HOMEPAGE SLIDES
$img_collection = '';
$img_collection = get_option('imageset_collection');
if ($img_collection == 'aveda') {
	$img_preset = get_option('aveda_collection');
} elseif ($img_collection == 'stock') {
	$img_preset = get_option('stock_collection');
} else {
	$img_preset = get_option('aveda_collection');
}

$cloudinary_header_images = $cloudinary->searchApi()
->expression('resource_type=image AND folder:' . $img_collection . '/' . $img_preset)
->sortBy('filename','asc')
->maxResults(50)
->execute();

// if ( 'page' == $post_type || 'locations' == $post_type || 'post' == $post_type || 'hp_slides' == $post_type ) {
//   echo '<pre>' . var_dump($cloudinary_header_images->rateLimitRemaining) . '</pre>';
// }
  echo '<pre>' . var_dump($cloudinary_header_images->rateLimitRemaining) . '</pre>';

$header_resources = $cloudinary_images['resources'];
$img_array = array();
foreach ($header_resources as $key => $header_img) {
	$img_array[$key] = '<span class="headimg_thumb" style="background-image: url(https://res.cloudinary.com/imaginal-marketing-group/image/upload/'  . $img_collection . '/' . $img_preset . '/slides/' . $header_img['filename'] . ')"></span>';
}
$slides_choices = $img_array;

// $img_collection = '';
// $img_preset = '';
// $img_collection = get_option('imageset_collection');
// if ($img_collection == 'aveda') {
// 	$img_preset = get_option('aveda_collection');
// } elseif ($img_collection == 'stock') {
// 	$img_preset = get_option('stock_collection');
// } else {
// 	$img_preset = get_option('aveda_collection');
// }

// $slides_imgset_url = 'https://imaginalhosting.com/wp-themes/images/img/' . $img_collection . '/' . $img_preset; // path to your img collection
// echo $img_collection;
// $slides_data = file_get_contents($slides_imgset_url . '.json'); // put the contents of the file into a variable
// header images dropdown
// $slides_image_array = json_decode($slides_data, true);
// $slides_images = array_column($slides_image_array, 'image');
// $slides_thumb = array();
// $slides_id = array();
// foreach ($slides_image_array as $key => $slides_image) {
//   $slides_thumb[] = '<span class="headimg_thumb" style="background-image: url('.$slides_imgset_url.'/'.$slides_image["image"].');"></span>';
//   $slides_id[] = $slides_image["id"];
// }
//$header_id = array_column(json_decode($data, true), 'id');
// $slides_choices = array_combine($slides_id, $slides_thumb); // e.g., [2, 003.jpg] or [3, 004.jpg]


// dropdown style/functionality
$header_dropdown = '<span class="open_thumbs button">Choose Image &raquo;</span>';

if(function_exists("register_field_group")) {
    register_field_group(array (
      'id' => 'acf_homepage-slideshow',
      'title' => 'Homepage Slideshow',
      'fields' => array (
        array (
          'key' => 'field_3b7cf4252atb4',
          'label' => 'Custom Slider Image?',
          'name' => 'custom_home_header',
          'type' => 'true_false',
          'message' => '',
          'default_value' => 0,
        ),
        array (
          'key' => 'field_577edae185b9d',
          'label' => 'Background Image',
          'name' => 'slide_background_image',
          'type' => 'image',
          'save_format' => 'url',
          'preview_size' => 'medium',
          'library' => 'all',
          'conditional_logic' => array (
            'status' => 1,
            'rules' => array (
              array (
                'field' => 'field_3b7cf4252atb4',
                'operator' => '==',
                'value' => '1',
              ),
            ),
            'allorany' => 'all',
          ),
        ),
        array (
          'key' => 'field_5796949d9d028',
          'label' => 'Mobile Background Image',
          'name' => 'background_image_mobile',
          'type' => 'image',
          'save_format' => 'url',
          'preview_size' => 'medium',
          'library' => 'all',
          'conditional_logic' => array (
            'status' => 1,
            'rules' => array (
              array (
                'field' => 'field_3b7cf4252atb4',
                'operator' => '==',
                'value' => '1',
              ),
            ),
            'allorany' => 'all',
          ),
        ),
        array (
          'key' => 'field_5s7ef2382ecaq',
          'label' => 'Image',
          'name' => 'slider_preset_header',
          'type' => 'radio',
          'instructions' => $header_dropdown,
          'conditional_logic' => array (
            'status' => 1,
            'rules' => array (
              array (
                'field' => 'field_3b7cf4252atb4',
                'operator' => '!=',
                'value' => '1',
              ),
            ),
            'allorany' => 'all',
          ),
          'choices' => $slides_choices,
          'other_choice' => 0,
          'save_other_choice' => 0,
          'default_value' => '',
          'layout' => 'vertical',
        ),
        array (
          'key' => 'field_57d1c5334604b',
          'label' => 'Slide Type',
          'name' => 'slide_type',
          'type' => 'radio',
          'required' => 1,
          'choices' => array (
            'graphic' => 'Graphic',
            'text' => 'Text',
          ),
          'other_choice' => 0,
          'save_other_choice' => 0,
          'default_value' => '',
          'layout' => 'horizontal',
        ),
        array (
          'key' => 'field_57d1c4df46049',
          'label' => 'Slide Text',
          'name' => 'slide_text',
          'type' => 'wysiwyg',
          'conditional_logic' => array (
            'status' => 1,
            'rules' => array (
              array (
                'field' => 'field_57d1c5334604b',
                'operator' => '==',
                'value' => 'text',
              ),
            ),
            'allorany' => 'all',
          ),
          'default_value' => '',
          'toolbar' => 'full',
          'media_upload' => 'yes',
        ),
        array (
          'key' => 'field_57d1c5154604a',
          'label' => 'Slide Graphic',
          'name' => 'slide_graphic',
          'type' => 'image',
          'conditional_logic' => array (
            'status' => 1,
            'rules' => array (
              array (
                'field' => 'field_57d1c5334604b',
                'operator' => '==',
                'value' => 'graphic',
              ),
            ),
            'allorany' => 'all',
          ),
          'save_format' => 'object',
          'preview_size' => 'medium',
          'library' => 'all',
        ),
        array (
          'key' => 'field_577edb0285b9e',
          'label' => 'Slide Link',
          'name' => 'slide_link',
          'type' => 'text',
          'default_value' => '',
          'placeholder' => '',
          'prepend' => '',
          'append' => '',
          'formatting' => 'none',
          'maxlength' => '',
        ),
        array (
          'key' => 'field_577edb2785b9f',
          'label' => 'Animation Timeout',
          'name' => 'slide_timeout',
          'type' => 'text',
          'default_value' => '',
          'placeholder' => '',
          'prepend' => '',
          'append' => '',
          'formatting' => 'html',
          'maxlength' => '',
        ),
        array ( // background-gradient
          'key' => 'field_3b7cf4252atb6',
          'label' => 'Header Gradient',
          'name' => 'has_gradient_header',
          'type' => 'true_false',
          'message' => '',
          'default_value' => 0,
        ),
        array (
          'key' => 'field_3b7cf4252atb7',
          'label' => 'Light or Dark Gradient?',
          'name' => 'gradient_header_option',
          'type' => 'radio',
          'conditional_logic' => array (
            'status' => 1,
            'rules' => array (
              array (
                'field' => 'field_3b7cf4252atb6',
                'operator' => '!=',
                'value' => '0',
              ),
            ),
            'allorany' => 'all',
          ),
          'choices' => array(
		  	'light'	=> 'Light',
			'dark' => 'Dark'
		  ),
          'other_choice' => 0,
          'save_other_choice' => 0,
          'default_value' => '',
          'layout' => 'vertical',
        ),
        array ( // holiday option
          'key' => 'field_3b7cf4252atb5',
          'label' => 'Holiday Slide?',
          'name' => 'is_holiday_slide',
          'type' => 'true_false',
          'message' => '',
          'default_value' => 0,
        ),
      ),
      'location' => array (
        array (
          array (
            'param' => 'post_type',
            'operator' => '==',
            'value' => 'hp_slides',
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