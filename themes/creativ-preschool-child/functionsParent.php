<?php
/**
 * Creativ Preschool functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Creativ Preschool
 */

if ( ! function_exists( 'creativ_preschool_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function creativ_preschool_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Creativ Preschool, use a find and replace
	 * to change 'creativ-preschool' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'creativ-preschool', get_template_directory() . '/languages' );

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

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'creativ-preschool' ),
	) );

	// Enable support for custom logo.
	add_theme_support( 'custom-logo' , array(
		'height'		=>45,
		'width'			=>45,
		'flex-height'	=>true,
		'flex-width'	=>true,
	));

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'creativ_preschool_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/*
	* This theme styles the visual editor to resemble the theme style,
	* specifically font, colors, icons, and column width.
	*/
	$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
	add_editor_style( array( '/assets/css/editor-style' . $min . '.css', creativ_preschool_fonts_url() ) );

	// Gutenberg support
	add_theme_support( 'editor-color-palette', array(
       	array(
			'name' => esc_html__( 'Tan', 'creativ-preschool' ),
			'slug' => 'tan',
			'color' => '#E6DBAD',
       	),
       	array(
           	'name' => esc_html__( 'Yellow', 'creativ-preschool' ),
           	'slug' => 'yellow',
           	'color' => '#FDE64B',
       	),
       	array(
           	'name' => esc_html__( 'Orange', 'creativ-preschool' ),
           	'slug' => 'orange',
           	'color' => '#ED7014',
       	),
       	array(
           	'name' => esc_html__( 'Red', 'creativ-preschool' ),
           	'slug' => 'red',
           	'color' => '#D0312D',
       	),
       	array(
           	'name' => esc_html__( 'Pink', 'creativ-preschool' ),
           	'slug' => 'pink',
           	'color' => '#b565a7',
       	),
       	array(
           	'name' => esc_html__( 'Purple', 'creativ-preschool' ),
           	'slug' => 'purple',
           	'color' => '#A32CC4',
       	),
       	array(
           	'name' => esc_html__( 'Blue', 'creativ-preschool' ),
           	'slug' => 'blue',
           	'color' => '#3A43BA',
       	),
       	array(
           	'name' => esc_html__( 'Green', 'creativ-preschool' ),
           	'slug' => 'green',
           	'color' => '#3BB143',
       	),
       	array(
           	'name' => esc_html__( 'Brown', 'creativ-preschool' ),
           	'slug' => 'brown',
           	'color' => '#231709',
       	),
       	array(
           	'name' => esc_html__( 'Grey', 'creativ-preschool' ),
           	'slug' => 'grey',
           	'color' => '#6C626D',
       	),
       	array(
           	'name' => esc_html__( 'Black', 'creativ-preschool' ),
           	'slug' => 'black',
           	'color' => '#000000',
       	),
   	));

	add_theme_support( 'align-wide' );
	add_theme_support( 'editor-font-sizes', array(
	   	array(
	       	'name' => esc_html__( 'small', 'creativ-preschool' ),
	       	'shortName' => esc_html__( 'S', 'creativ-preschool' ),
	       	'size' => 12,
	       	'slug' => 'small'
	   	),
	   	array(
	       	'name' => esc_html__( 'regular', 'creativ-preschool' ),
	       	'shortName' => esc_html__( 'M', 'creativ-preschool' ),
	       	'size' => 16,
	       	'slug' => 'regular'
	   	),
	   	array(
	       	'name' => esc_html__( 'larger', 'creativ-preschool' ),
	       	'shortName' => esc_html__( 'L', 'creativ-preschool' ),
	       	'size' => 36,
	       	'slug' => 'larger'
	   	),
	   	array(
	       	'name' => esc_html__( 'huge', 'creativ-preschool' ),
	       	'shortName' => esc_html__( 'XL', 'creativ-preschool' ),
	       	'size' => 48,
	       	'slug' => 'huge'
	   	)
	));
	add_theme_support('editor-styles');
	add_theme_support( 'wp-block-styles' );
}
endif;
add_action( 'after_setup_theme', 'creativ_preschool_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function creativ_preschool_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'creativ_preschool_content_width', 640 );
}
add_action( 'after_setup_theme', 'creativ_preschool_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function creativ_preschool_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'creativ-preschool' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'creativ-preschool' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
		register_sidebar( array(
		'name'          => sprintf( esc_html__( 'Footer %d', 'creativ-preschool' ), 1 ),
		'id'            => 'footer-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => sprintf( esc_html__( 'Footer %d', 'creativ-preschool' ), 2 ),
		'id'            => 'footer-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => sprintf( esc_html__( 'Footer %d', 'creativ-preschool' ), 3 ),
		'id'            => 'footer-3',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => sprintf( esc_html__( 'Footer %d', 'creativ-preschool' ), 4 ),
		'id'            => 'footer-4',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'creativ_preschool_widgets_init' );

/**
 * Register custom fonts.
 */
function creativ_preschool_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/* translators: If there are characters in your language that are not supported by Montserrat, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Open Sans: on or off', 'creativ-preschool' ) ) {
		$fonts[] = 'Open Sans:300,400,500,600,700';
	}

	if ( 'off' !== _x( 'on', 'Sniglet: on or off', 'creativ-preschool' ) ) {
		$fonts[] = 'Sniglet:400';
	}

	if ( 'off' !== _x( 'on', 'Shadows Into Light: on or off', 'creativ-preschool' ) ) {
		$fonts[] = 'Shadows Into Light:400';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}

/**
 * Enqueue scripts and styles.
 */
function creativ_preschool_scripts() {
	$min = "";//defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
	$fonts_url = creativ_preschool_fonts_url();
	$primary_color = creativ_preschool_get_option( 'primary_color' );
	if ( ! empty( $fonts_url ) ) {
		wp_enqueue_style( 'creativ-preschool-google-fonts', $fonts_url, array(), null );
	}

	wp_enqueue_style( 'fontawesome-all', get_template_directory_uri() . '/assets/css/all' . $min . '.css', '', '4.7.0' );

	wp_enqueue_style( 'slick-theme-css', get_template_directory_uri() .'/assets/css/slick-theme' . $min . '.css', '', 'v2.2.0');

	wp_enqueue_style( 'slick-css', get_template_directory_uri() .'/assets/css/slick' . $min . '.css', '', 'v1.8.0');

	wp_enqueue_style( 'creativ-preschool-blocks', get_template_directory_uri() . '/assets/css/blocks.css', array(), 3 );

	wp_enqueue_style( 'creativ-preschool-style', get_stylesheet_uri() );

	wp_enqueue_script( 'jquery-slick', get_template_directory_uri() . '/assets/js/slick' . $min . '.js', array('jquery'), '2017417', true );

	wp_enqueue_script( 'jquery-match-height', get_template_directory_uri() . '/assets/js/jquery.matchHeight' . $min . '.js', array('jquery'), '2017417', true );

	wp_enqueue_script( 'creativ-preschool-navigation', get_template_directory_uri() . '/assets/js/navigation' . $min . '.js', array(), '20151215', true );

	wp_enqueue_script( 'creativ-preschool-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix' . $min . '.js', array(), '20151215', true );

	wp_enqueue_script( 'creativ-preschool-custom-js', get_template_directory_uri() . '/assets/js/custom' . $min . '.js', array('jquery'), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'creativ_preschool_scripts' );

/**
 * Enqueue editor styles for Gutenberg
 *
 * @since Creativ Preschool 1.0.0
 */
function creativ_preschool_block_editor_styles() {
	$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
	// Block styles.
	wp_enqueue_style( 'creativ-preschool-block-editor-style', get_theme_file_uri( '/assets/css/editor-blocks' . $min . '.css' ) );
	// Add custom fonts.
	wp_enqueue_style( 'creativ-preschool-fonts', creativ_preschool_fonts_url(), array(), null );
}
add_action( 'enqueue_block_editor_assets', 'creativ_preschool_block_editor_styles' );

/**
 * Load init.
 */
require_once get_template_directory() . '/inc/init.php';

/**
* TGM plugin additions.
*/
require get_template_directory() . '/inc/tgm-plugin/tgm-hook.php';
