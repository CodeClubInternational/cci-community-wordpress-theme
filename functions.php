<?php

/**
 * CCW_Countries functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package CCW_Countries
 */

if ( ! function_exists( 'ccw_countries_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function ccw_countries_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 */
		load_theme_textdomain( 'ccw_countries', get_template_directory() . '/languages' );

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

		// This theme uses multiple nav menus
		register_nav_menus( array(
			'primary_navigation'   => esc_html__( 'Primary Navigation', 'ccw_countries' ),
			'footer_navigation_1'  => esc_html__( 'Footer Nav 1', 'ccw_countries' ),
			'footer_navigation_2'  => esc_html__( 'Footer Nav 2', 'ccw_countries' ),
			'footer_navigation_3'  => esc_html__( 'Footer Nav 3', 'ccw_countries' ),
			'footer_navigation_4'  => esc_html__( 'Footer Nav 4', 'ccw_countries' ),
			'club_navigation_menu' => esc_html__( 'Club Navigation Menu', 'ccw_countries' ),
		) );

		  /*
		   * Switch default core markup for search form, comment form, and comments
		   * to output valid HTML5.
		   */
			add_theme_support( 'html5', array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			) );

			/*
			 * Enable support for Post Formats.
			 * See https://developer.wordpress.org/themes/functionality/post-formats/
			 */
			// add_theme_support( 'post-formats', array(
			// 'aside',
			// 'image',
			// 'video',
			// 'quote',
			// 'link',
			// ) );
	}
endif;
add_action( 'after_setup_theme', 'ccw_countries_setup' );

function display_php_errors() {
	ini_set( 'display_errors', 1 );
	error_reporting( E_ALL ^ E_NOTICE );
}

/**
 * Enqueue scripts and styles.
 */
function ccw_countries_scripts() {
	// set style guide version, or default to false (see https://developer.wordpress.org/reference/functions/wp_enqueue_style/)
	$styleguide_meta = file_get_contents( get_template_directory() . '/bower_components/code-club/.bower.json' );
	$styleguide_meta_json = json_decode( $styleguide_meta, true );
	$styleguide_version = $styleguide_meta_json['version'] ?: false;

	// enqueue the style guide & theme styles
	wp_enqueue_style( 'ccw-countries-style-guide-style', get_template_directory_uri() . '/bower_components/code-club/dist/stylesheets/code-club.min.css', false, $styleguide_version );
	wp_enqueue_style( 'ccw-countries-style', get_stylesheet_uri() );

	// enqueue the style guide & theme scripts
	wp_enqueue_script( 'ccw-countries-style-guide-script', get_template_directory_uri() . '/bower_components/code-club/dist/javascripts/code-club.min.js', 'jquery', $styleguide_version, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'ccw_countries_scripts' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load nav markup overrides file.
 */
require get_template_directory() . '/inc/nav-overrides.php';

/**
 * Load utilities file.
 */
require get_template_directory() . '/inc/utilities.php';

/**
 * Country-specific config.
 */
if ( file_exists( get_stylesheet_directory() . '/inc/country-config.php' ) ) {
	require get_stylesheet_directory() . '/inc/country-config.php';
} else {
	require get_template_directory() . '/inc/country-config.php';
}

/**
 * CCW API class.
 */
require get_template_directory() . '/inc/ccw-api.php';

/**
 * Host Volunteer Matching class.
 */
require get_template_directory() . '/inc/host-volunteer-matching.php';

/**
 * Flash Messages class.
 */
require get_template_directory() . '/inc/flash-messages.php';

/**
 * Generic PHP class autoloader, in lieu of using Composer.
 * See: https://gist.github.com/jwage/221634
 */
require get_template_directory() . '/inc/SplClassLoader.php';

/**
 * Load the League Plates package via the above class autoloader.
 */
$classLoader = new SplClassLoader( 'League\Plates', get_template_directory() . '/inc' );
$classLoader->register();

/**
 * Helper methods
 */
require get_template_directory() . '/inc/helpers.php';

/**
 * Sign in logic functions and Club Session class.
 */
require get_template_directory() . '/inc/club-session.php';

/**
 * Set up
 */
require get_template_directory() . '/inc/set-up/run-setup.php';
