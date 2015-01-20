<?php
/**
 * Gojoseon functions and definitions
 *
 * @package Gojoseon
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'gojoseon_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function gojoseon_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Gojoseon, use a find and replace
	 * to change 'gojoseon' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'gojoseon', get_template_directory() . '/languages' );

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
		'top'       => __( 'Top Menu', 'gojoseon' ),
                'primary'   => __( 'Primary Menu', 'gojoseon' ),
                'quick'     => __( 'Quick Menu', 'gojoseon' ),
                'footer'    => __( 'Footer Menu', 'gojoseon' ),
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
		'aside', 'gallery', 'image', 'video', 'quote', 'link', 'status', 'audio', 'chat' // Added gallery, status, audio, chat
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'gojoseon_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // gojoseon_setup
add_action( 'after_setup_theme', 'gojoseon_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function gojoseon_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'gojoseon' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'gojoseon_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function gojoseon_scripts() {
	wp_enqueue_style( 'gojoseon-style', get_stylesheet_uri() );
        
        wp_enqueue_script( 'gojoseon-superfish', get_template_directory_uri() . '/js/superfish.min.js', array( 'jquery' ), '20150120', true ); 
        
        wp_enqueue_script( 'gojoseon-superfish-settings', get_template_directory_uri() . '/js/superfish-settings.js', array( 'gojoseon-superfish' ), '20150120', true ); 
        
        wp_enqueue_script( 'gojoseon-navigation', get_template_directory_uri() . '/js/hide-search.js', array( 'jquery' ), '20150121', true );
        
	wp_enqueue_script( 'gojoseon-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'gojoseon-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
        
        // Add the topbutton script ref @link: http://premium.wpmudev.org/blog/back-to-top-button-wordpress/
        wp_enqueue_script( 'gojoseon-topbutton', get_template_directory_uri() . '/js/topbutton.js', array( 'jquery' ), true ); 
        
        // Enqueue FontAwesome ref @link: http://sridharkatakam.com/using-font-awesome-wordpress/
        wp_enqueue_style( 'font-awesome', '//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'gojoseon_scripts' );

/**
 * Enqueue Foundation scripts and styles.
 * 
 * @link: http://wordpress.tv/2014/06/11/steve-zehngut-build-a-wordpress-theme-with-foundation-and-underscores/
 * @link: http://wordpress.tv/2014/03/31/steve-zehngut-theme-development-with-foundation-framework/
 * @link: http://www.justinfriebel.com/wordpress-underscores-with-the-foundation-framework-116/
 * 
*/
function gojoseon_foundation_enqueue() {
    
        /* Add Foundation 5.5 CSS */
        wp_enqueue_style( 'foundation-normalize', get_stylesheet_directory_uri() . '/foundation/css/normalize.css' );   // Underscores has its own normalize.css, so this is layered on top
        wp_enqueue_style( 'foundation', get_stylesheet_directory_uri() . '/foundation/css/foundation.css', array(), 'all' );            // This is the Foundation CSS
        
        /* Add Custom CSS */
        wp_enqueue_style( 'gojoseon-custom-style', get_stylesheet_directory_uri() . '/gojoseon.css' );
        
        /* Add Foundation JS */
        wp_enqueue_script( 'foundation-js', get_template_directory_uri() . '/foundation/js/foundation.min.js', array( 'jquery' ), true );
        wp_enqueue_script( 'foundation-modernizr-js', get_template_directory_uri() . '/foundation/js/vendor/modernizr.js', array( 'jquery' ), true );     // This specifically enqueues modernizr.js which had been unenqueued when doing this using Foundation 5.2
        
        /* Foundation Init JS */
        wp_enqueue_script( 'foundation-init-js', get_template_directory_uri() . '/foundation.js', array( 'jquery' ), true );   // Small (author) customized JS script to start the Foundation library, sitting freely in the Theme folder
        
}
add_action( 'wp_enqueue_scripts', 'gojoseon_foundation_enqueue' );

/**
 * Modify Underscores nav menus to work with Foundation
 */
function gojoseon_nav_menu( $menu ) {
    
    $menu = str_replace( 'menu-item-has-children', 'menu-item-has-children has-dropdown', $menu );
    $menu = str_replace( 'sub-menu', 'sub-menu dropdown', $menu );
    return $menu;
    
}
add_filter( 'wp_nav_menu', 'gojoseon_nav_menu' );


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

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
 * -----------------------------------------------------------------------------
 * My custom functions below
 * -----------------------------------------------------------------------------
 */

/**
 * Load Theme Options file that includes the Theme Customizer and the Theme Options page
 */
require get_template_directory() . '/inc/theme-options.php';

/**
 * Custom Breadcrumbs
 * 
 * @link: http://thewebtaylor.com/articles/wordpress-creating-breadcrumbs-without-a-plugin
 */
function the_breadcrumb() {
    global $post;
    echo '<ul id="breadcrumbs">';
    if ( !is_home() ) {
        echo '<li><a href="';
        echo get_option( 'home' );
        echo '">';
        echo 'Home';
        echo '</a></li>';
        
        if ( is_category() || is_single() ) {
            echo '<li>';
            the_category('</li><li>');
            if ( is_single() ) {
                echo '</li><li>';
                the_title();
                echo '</li>';
            }
        } else if ( is_page() ) {
            if( $post->post_parent ) {
                $ancestors = get_post_ancestors( $post->ID );
                $title = get_the_title();
                
                foreach ( $ancestors as $ancestor ) {
                    $output = '<li><a href="' . get_permalink( $ancestor ) . '" title="' . get_the_title( $ancestor ) . '">' . get_the_title( $ancestor ) . '</a></li></li>';    
                }
                
                echo $output;
                echo '<strong title="' . $title . '"> ' . $title . '</strong>';
            } else {
                echo '<li><strong> ' . get_the_title() . '</strong></li>';
            }
        } 
        else if ( is_tag() ) { single_tag_title(); }
        else if ( is_day() ) { echo "<li>Archive for "; the_time( 'F jS, Y' ); echo '</li>'; }
        else if ( is_month() ) { echo "<li>Archive for "; the_time( 'F, Y' ); echo '</li>'; }
        else if ( is_year() ) { echo "<li>Archive for "; the_time( 'Y' ); echo '</li>'; }
        else if ( is_author() ) { echo "<li>Author Archive"; echo '</li>'; }
        else if ( isset( $_GET[ 'paged' ] ) && !empty( $_GET[ 'paged' ] ) ) { echo "<li>Blog Archives"; echo '</li>'; }
        else if ( is_search() ) { echo "<li>Search Results"; echo '</li>'; }
        
        echo '</ul>';
    }
}