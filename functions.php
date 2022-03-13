<?php
/**
 * Timber starter-theme
 * https://github.com/timber/starter-theme
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since   Timber 0.1
 */

/**
 * This ensures that Timber is loaded and available as a PHP class.
 * If not, it gives an error message to help direct developers on where to activate
 */
if ( ! class_exists( 'Timber' ) ) {

	add_action(
		'admin_notices',
		function() {
			echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url( admin_url( 'plugins.php#timber' ) ) . '">' . esc_url( admin_url( 'plugins.php' ) ) . '</a></p></div>';
		}
	);

	add_filter(
		'template_include',
		function( $template ) {
			return get_stylesheet_directory() . '/src/no-timber.html';
		}
	);
	return;
}

/**
 * Sets the directories (inside your theme) to find .twig files
 */
Timber::$dirname = array( 'views', 'views' );

/**
 * By default, Timber does NOT autoescape values. Want to enable Twig's autoescape?
 * No prob! Just set this value to true
 */
Timber::$autoescape = false;


/**
 * We're going to configure our theme inside of a subclass of Timber\Site
 * You can move this to its own file and include here via php's include("MySite.php")
 */
class StarterSite extends Timber\Site {
	/** Add timber support. */
	public function __construct() {
		add_action( 'after_setup_theme', array( $this, 'theme_supports' ) );
		add_filter( 'timber/context', array( $this, 'add_to_context' ) );
		add_filter( 'timber/twig', array( $this, 'add_to_twig' ) );
		add_action( 'init', array( $this, 'register_post_types' ) );
		add_action( 'init', array( $this, 'register_taxonomies' ) );
		parent::__construct();
	}
	/** This is where you can register custom post types. */
	public function register_post_types() {

	}
	/** This is where you can register custom taxonomies. */
	public function register_taxonomies() {

	}

	/** This is where you add some context
	 *
	 * @param string $context context['this'] Being the Twig's {{ this }}.
	 */
	public function add_to_context( $context ) {
		$context['menu']  = new Timber\Menu( 'primary-menu' );
		$context['services_menu']  = new Timber\Menu( 'services-menu' );
		$context['about_menu']  = new Timber\Menu( 'about-menu' );
		$context['locations_menu']  = new Timber\Menu( 'locations-menu' );
		$context['aveda_menu']  = new Timber\Menu( 'aveda-menu' );
		$context['footer_menu']  = new Timber\Menu( 'footer-menu' );
		$context['footer_column_1'] = Timber::get_widgets( 'footer_column_1' );
		$context['client_aveda_id'] = '23467';
		$context['site']  = $this;
		return $context;
	}

	public function theme_supports() {
		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		/*
		 * Enable support for Post Formats.
		 *
		 * See: https://codex.wordpress.org/Post_Formats
		 */
		add_theme_support(
			'post-formats',
			array(
				'aside',
				'image',
				'video',
				'quote',
				'link',
				'gallery',
				'audio',
			)
		);

		add_theme_support( 'menus' );
	}

	/** This Would return 'foo bar!'.
	 *
	 * @param string $text being 'foo', then returned 'foo bar!'.
	 */
	public function myfoo( $text ) {
		$text .= ' bar!';
		return $text;
	}

	/** This is where you can add your own functions to twig.
	 *
	 * @param string $twig get extension.
	 */
	public function add_to_twig( $twig ) {
		$twig->addExtension( new Twig\Extension\StringLoaderExtension() );
		$twig->addFilter( new Twig\TwigFilter( 'myfoo', array( $this, 'myfoo' ) ) );
		return $twig;
	}

}


new StarterSite();




// register menus
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



// enqueue site stylesheet
// add_action( 'wp_enqueue_scripts', 'my_site_css' );
// function my_site_css() {
//     wp_register_style( 'my-css', get_template_directory_uri() . '/assets/css/style.min.css' );

//     wp_enqueue_style( 'my-css' );
// }

// TODO: MINIFY ALL JS AND ENQUEUE SINGLE FILE
// add_action( 'wp_enqueue_scripts', 'responsive_headers' );
// function responsive_headers() {
//     wp_register_script( 'headers', get_template_directory_uri() . '/assets/js/headers.js', [], '1.0.0', true );
//     wp_enqueue_script( 'headers' );
// }

// add_action( 'wp_enqueue_scripts', 'my_site_js' );
// function my_site_js() {
//     wp_register_script( 'my-js', get_template_directory_uri() . '/static/site.js', [], '1.0.0', true );
//     wp_enqueue_script( 'my-js' );
// }

// add_action( 'wp_enqueue_scripts', 'enqueue_swiper_js' );
// function enqueue_swiper_js() {
//     wp_register_script( 'swiper', get_template_directory_uri() . '/assets/js/swiper.js', [], '1.0.0', true );

//     wp_enqueue_script( 'swiper' );
// }

// add_action( 'wp_enqueue_scripts', 'enqueue_nav_menu_js' );
// function enqueue_nav_menu_js() {
//     wp_register_script( 'nav_menu', get_template_directory_uri() . '/assets/js/nav-menu.js', [], '1.0.0', true );

//     wp_enqueue_script( 'nav_menu' );
// }

// ENQUEUE CURSOR JS
// add_action( 'wp_enqueue_scripts', 'enqueue_cursor_js' );
// function enqueue_cursor_js() {
//     wp_register_script( 'cursor', get_template_directory_uri() . '/assets/js/cursor.js', [], '1.0.0', true );

//     wp_enqueue_script( 'cursor' );
// }



function add_custom_assets() {
  foreach( glob( get_template_directory(). '/dist/assets/*.css' ) as $file ) {
    $file = str_replace(get_template_directory(), '', $file);
    // $file contains the name and extension of the file
    wp_register_style( $file.'style', get_template_directory_uri() . $file, array(), false, 'all' );
    wp_enqueue_style( $file . 'style' );
  }



  foreach( glob( get_template_directory(). '/dist/assets/*.js' ) as $file ) {
  $file = str_replace(get_template_directory(), '', $file);
  // $file contains the name and extension of the file
  wp_register_script( $file . 'script', get_template_directory_uri() . $file, [],'1.0.0', true);

	wp_enqueue_script( $file . 'script' );
  }
}
add_action('wp_enqueue_scripts', 'add_custom_assets');




// adds twig files to theme editor
function add_custom_editor_file_types( $types ) {
    $types[] = 'twig';
    return $types;
}
add_filter( 'wp_theme_editor_filetypes', 'add_custom_editor_file_types' );


// register Salon Info Settings page
// require_once(get_stylesheet_directory() . '/assets/functions/salon_info.php');
// require_once(get_stylesheet_directory() . '/assets/functions/salon_test.php');


/**
 * Register our sidebars and widgetized areas.
 *
 */
function arphabet_widgets_init() {

	register_sidebar( array(
		'name'          => 'Footer Column 1',
		'id'            => 'footer_column_1',
		'before_widget' => '<div id="foot1">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'arphabet_widgets_init' );



// Dequeue Gutenberg Block Library from loading client-side
function remove_gb_block_styles() {
	wp_dequeue_style( 'wp-block-library' );
	wp_dequeue_style( 'wp-block-library-theme' );
}
add_action( 'wp_enqueue_scripts', 'remove_gb_block_styles', 100 );