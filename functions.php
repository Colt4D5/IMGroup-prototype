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
		add_filter( 'wp_theme_editor_filetypes', array($this, 'add_custom_editor_file_types') );
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
		$context['main_logo_url']  = get_option( 'main_logo_img' );
		$context['dark_logo_url']  = get_option( 'dark_logo_img' );
		$context['salon_name']  = get_option( 'salon_name' );
		$context['salon_name_short']  = get_option( 'salon_name_abbrev' );
		$context['google_analytics_id'] = get_option( 'google_analytics_id' );
		$context['google_maps_api_key'] = get_option( 'google_maps_api_key' );
		$context['typekit_id'] = get_option( 'typekit_id' );
		$context['foxycart_id'] = get_option( 'foxycart_id' );
		$context['aveda_id'] = get_option( 'aveda_id' );
		$context['facebook_url'] = get_option( 'facebook_url' );
		$context['instagram_url'] = get_option( 'instagram_url' );
		$context['twitter_url'] = get_option( 'twitter_url' );
		$context['pinterest_url'] = get_option( 'pinterest_url' );
		$context['yelp_url'] = get_option( 'yelp_url' );
		$context['hours'] = get_option('hours');
		$context['acomm_popup'] = get_option('acomm_popup');
		$context['menu']  = new Timber\Menu( 'primary-menu' );
		$context['services_menu']  = new Timber\Menu( 'services-menu' );
		$context['about_menu']  = new Timber\Menu( 'about-menu' );
		$context['locations_menu']  = new Timber\Menu( 'locations-menu' );
		$context['aveda_menu']  = new Timber\Menu( 'aveda-menu' );
		$context['footer_menu']  = new Timber\Menu( 'footer-menu' );
		$context['footer_column_1'] = Timber::get_widgets( 'footer_column_1' );
		$context['footer_column_2'] = Timber::get_widgets( 'footer_column_2' );
		$context['footer_column_3'] = Timber::get_widgets( 'footer_column_3' );
		$context['footer_column_4'] = Timber::get_widgets( 'footer_column_4' );
		$context['imgset_collection'] = get_option('imageset_collection');
		if ($context['imgset_collection'] === 'aveda') {
			$context['imgset_category'] = get_option('aveda_collection');
		} elseif ($context['imgset_collection'] === 'stock') {
			$context['imgset_category'] = get_option('stock_collection');
		} else {
			$context['imgset_category'] = get_option('aveda_collection');
		}
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

	// adds twig files to theme editor
	public function add_custom_editor_file_types( $types ) {
		$types[] = 'twig';
		return $types;
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

// connect to cloudinary
require_once(get_template_directory().'/assets/functions/cloudinary.php');

// promos & stuff
require_once(get_template_directory().'/assets/functions/promos.php');

// homepage slides & stuff
require_once(get_template_directory().'/assets/functions/cpt.php');

// register menus
require_once(get_template_directory().'/assets/functions/register-menus.php');

// enqueue all css files in assets/css folder
require_once(get_template_directory().'/assets/functions/enqueue-theme-assets.php');

// Register our sidebars and widgetized areas.
require_once(get_template_directory().'/assets/functions/register-widgets.php');

// Dequeue Gutenberg Block Library from loading client-side
require_once(get_template_directory().'/assets/functions/dequeue-scripts.php');

// remove drafted pages from navigation
require_once(get_template_directory().'/assets/functions/hide-draft-pages.php');