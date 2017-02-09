<?php
/**
 * Materialist functions and definitions
 *
 * @package Materialist
 */

wp_deregister_script('l10n');
remove_action('wp_head',                'wp_generator');
remove_action('wp_head',                'wlwmanifest_link');
remove_action('wp_head',                'rsd_link');
remove_action('wp_head',		'print_emoji_detection_script',7);
remove_action('wp_head',                'index_rel_link');//当前文章的索引 
remove_action('wp_head',                'feed_links_extra', 3);// 额外的feed,例如category, tag页 
remove_action('wp_head',                'start_post_rel_link', 10, 0);// 开始篇 
remove_action('wp_head',                'parent_post_rel_link', 10, 0);// 父篇 
remove_action('wp_head',                'adjacent_posts_rel_link', 10, 0); // 上、下篇. 
remove_action('wp_head',                'adjacent_posts_rel_link_wp_head', 10, 0 );//rel=pre 
remove_action('wp_head',                'wp_shortlink_wp_head', 10, 0 );//rel=shortlink 
remove_action('template_redirect',      'wp_shortlink_header', 11, 0 );
remove_action('wp_head',                'rel_canonical' ); 
remove_action('admin_print_scripts',	'print_emoji_detection_script');
remove_action('admin_print_styles',	'print_emoji_styles');
remove_action('wp_print_styles',	'print_emoji_styles');
remove_action('embed_head',		'print_emoji_detection_script');
remove_filter('the_content_feed',	'wp_staticize_emoji');
remove_filter('comment_text_rss',	'wp_staticize_emoji');
remove_filter('wp_mail',		'wp_staticize_emoji_for_email');

add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);
function special_nav_class($classes, $item){
     if( in_array('current-menu-item', $classes) ){
             $classes[] = 'active ';
     }
     return $classes;
}

if ( ! function_exists( 'materialist_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function materialist_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Materialist, use a find and replace
	 * to change 'materialist' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'materialist', get_template_directory() . '/languages' );

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
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Header', 'materialist' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside'
	) );

	// Adding editor style
	//add_editor_style( array(
	//	'editor.css'
	//) );	
}
endif; // materialist_setup
add_action( 'after_setup_theme', 'materialist_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function materialist_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Left Sidebar', 'materialist' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_title'  => '<h5 class="white-text widget-title">',
		'after_title'   => '</h5>',
	) );
	register_sidebar( array(
		'name'          => __( 'Medium Sidebar', 'materialist' ),
		'id'            => 'sidebar-2',
		'description'   => '',
		'before_title'  => '<h5 class="white-text widget-title">',
		'after_title'   => '</h5>',
	) );
	register_sidebar( array(
		'name'          => __( 'Right Sidebar', 'materialist' ),
		'id'            => 'sidebar-3',
		'description'   => '',
		'before_title'  => '<h5 class="white-text widget-title">',
		'after_title'   => '</h5>',
	) );
}
add_action( 'widgets_init', 'materialist_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function materialist_scripts() {

	wp_enqueue_style( 'materialist-style', get_stylesheet_uri() );
	
	wp_enqueue_script( 'materialist-script', get_template_directory_uri() . '/js/materialist.js', array( 'jquery' ), '20150121' );

	wp_enqueue_script( 'materialist-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'materialist_scripts' );

/**
 * Display color scheme based on one accent color choosen by user
 */
/*if( ! function_exists( 'materialist_color_scheme' ) ) :
function materialist_color_scheme(){
	$color_scheme = get_theme_mod( 'color_scheme', false );

	if( $color_scheme ){
		wp_add_inline_style( 'materialist-style', $color_scheme );
	}
}
endif;*/
add_action( 'wp_enqueue_scripts', 'materialist_color_scheme' );

if( ! function_exists( 'materialist_excerpt_length') ) :
/**
 * Modifying excerpt's length
 * 
 * @return int
 */
function materialist_excerpt_length(){
	return 300;
}
endif;
add_filter( 'excerpt_length', 'materialist_excerpt_length' );

if( ! function_exists( 'materialist_excerpt_more' ) ) :
/**
 * Replacing excerpt's annoying [&hellip;]
 * 
 * @return string
 */
function materialist_excerpt_more(){
	return ' &hellip;';
}
endif;
add_filter( 'excerpt_more', 'materialist_excerpt_more' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Load simple color adjuster library
 */
if( ! class_exists( 'Materialist_Simple_Color_Adjuster' ) ){
	require get_template_directory() . '/inc/simple-color-adjuster.php';
}

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
