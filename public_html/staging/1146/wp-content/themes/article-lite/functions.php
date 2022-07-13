<?php
/**
 * Article Lite functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Article Lite
 */

if ( ! function_exists( 'article_lite_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function article_lite_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Article, use a find and replace
		 * to change 'article-lite' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'article-lite', get_template_directory() . '/languages' );

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
			'primary' => esc_html__( 'Primary Menu', 'article-lite' ),
			'footer' => esc_html__( 'Footer Menu', 'article-lite' ),
			'top-social' => esc_html__( 'Top Social Menu', 'article-lite' ),
			'bottom-social' => esc_html__( 'Bottom Social Menu', 'article-lite' ),
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

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'article_lite_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 100,
			'width'       => 500,
			'flex-width'  => true,
			'flex-height' => true,
		) );

		//add image 
		add_image_size( 'article_lite_latest_post_sidebar', 87, 67 );


		/**
		 * Changing excerpt length for styled blog theme
		 */
		function article_lite_blog_excerpt_length( $length ) {
			if ( ! is_admin() ) {
				return 50;
			} else {
				return $length;
			}
		}
		add_filter( 'excerpt_length', 'article_lite_blog_excerpt_length', 999 );


		// changing the default end of the_excerpt()
		function article_lite_blog_excerpt_more( $more ) {
			if ( ! is_admin() ) {
				return '...';
			}
		}
		add_filter('excerpt_more', 'article_lite_blog_excerpt_more');


		add_post_type_support( 'page', 'excerpt' );

	}
endif;
add_action( 'after_setup_theme', 'article_lite_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function article_lite_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'article_lite_content_width', 1140 );
}
add_action( 'after_setup_theme', 'article_lite_content_width', 0 );


/**
 * Enqueue scripts and styles.
 */
function article_lite_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'article-fonts', article_lite_fonts_url(), array(), null );

	// Add Font Awesome Icons. Unminified version included.
	wp_enqueue_style('fontAwesome', get_template_directory_uri() . '/inc/font-awesome/css/font-awesome.min.css', array(), '4.7.0' );

	// Load our responsive stylesheet based on Bootstrap. Unminified version included.
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array( ), '3.3.5' );

	// Load our main stylesheet.
	wp_enqueue_style( 'article-style', get_stylesheet_uri() );

	wp_enqueue_script( 'article-moveup', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '1.0.0', true );	
	wp_enqueue_script( 'article-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );
	wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', array(), '3.3.5', true );
	wp_enqueue_script( 'article-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	//stickey sidebar js
	wp_enqueue_script( 'article-stickey-sidebar', get_template_directory_uri() . '/js/theia-sticky-sidebar.js', array('jquery'), '1.7.0', true );
	// customjs
	wp_enqueue_script( 'article-main-js', get_template_directory_uri() . '/js/main.js', array('jquery'), '1.0.0', true );


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'article_lite_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Adding widget areas.
 */
require get_template_directory() . '/inc/sidebars.php';


/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}


/**
* Theme Info
**/
require get_template_directory() . '/inc/admin/class-theme-info.php';

/**
 * Register Google fonts.
 * @return string Google fonts URL for the theme.
 */

if ( ! function_exists( 'article_lite_fonts_url' ) ) :
function article_lite_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
		if( esc_attr(get_theme_mod( 'load_cyrillic_subset', 0 ) ) ) : 
			$subsets   = 'cyrillic,cyrillic-ext';
		else: 
			$subsets   = 'latin,latin-ext';
		endif;
	
	/*
	 * Translators: If there are characters in your language that are not supported by Old Standard TT, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== esc_html_x( 'on', 'Old Standard TT font: on or off', 'article-lite' ) ) {
		$fonts[] = 'Old Standard TT:400,700';
	}	
	
	// check to see if our body font field is empty
	if ( get_theme_mod('second_google_font') !='' ) {	
		// Translators: If there are characters in your language that are not supported by this second Google font, translate this to 'off'. Do not translate into your own language. 
		if ( 'off' !== esc_html_x( 'on', 'Your second Google font: on or off', 'article-lite' ) ) {
			$fonts[] = esc_attr(get_theme_mod('second_google_font'));
		}	
	}
	
	// check to see if our headings font field is empty
	if ( get_theme_mod('third_google_font') !='' ) {
		// Translators: If there are characters in your language that are not supported by this third Google font, translate this to 'off'. Do not translate into your own language. 
		if ( 'off' !== esc_html_x( 'on', 'Your third Google font: on or off', 'article-lite' ) ) {
			$fonts[] = esc_attr(get_theme_mod('third_google_font'));
		}	
	}
	
	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;
