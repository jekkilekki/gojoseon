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
                'social'    => __( 'Social Menu', 'gojoseon' ),
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
        
        register_sidebar( array(
                'name'          => __( 'Header Widgets', 'gojoseon' ),
                'id'            => 'sidebar-header',
                'description'   => __( 'Widget appearing above the tagline and top menu, next to the logo.', 'gojoseon' ),
                'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                'after_widget'  => '</aside>',
                'before_title'  => '<h1 class="widget-title">',
                'after_title'   => '</h1>',
        ) );
        
        register_sidebar( array(
                'name'          => __( 'Footer Widgets', 'gojoseon' ),
                'id'            => 'sidebar-footer',
                'description'   => __( 'Widgets appearing above the footer of the site.', 'gojoseon' ),
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
        
        // Superfish and Superclick Menus and settings
        wp_enqueue_script( 'gojoseon-superfish', get_template_directory_uri() . '/js/superfish.min.js', array( 'jquery' ), '20150120', true );
        wp_enqueue_script( 'gojoseon-superclick', get_template_directory_uri() . '/js/superclick.js', array( 'jquery' ), '20150123', true ); 
        wp_enqueue_script( 'gojoseon-superfish-settings', get_template_directory_uri() . '/js/superfish-settings.js', array( 'gojoseon-superfish' ), '20150120', true );
        
        wp_enqueue_script( 'gojoseon-hide-search', get_template_directory_uri() . '/js/hide-search.js', array( 'jquery' ), '20150121', true );
        
        wp_enqueue_script( 'gojoseon-sidebar-scrolling', get_template_directory_uri() . '/js/sidebar-scrolling.js', array( 'jquery' ), '20150121', true );
        
	wp_enqueue_script( 'gojoseon-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'gojoseon-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
        
        /* Use Masonry */
        wp_enqueue_script( 'gojoseon-masonry', get_template_directory_uri() . '/js/masonry-settings.js', array( 'masonry' ), '20150126', true );
        
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
 * Custom Menu Walker to display the Title Attribute from a menu
 * 
 * @link: https://wordpress.org/support/topic/how-to-show-the-description-of-the-menu
 * @link: http://codex.wordpress.org/Function_Reference/wp_nav_menu (this helps add classes to the <ul> elements
 */
class Gojoseon_Quick_Menu_Walker extends Walker_Nav_Menu {
    
    // add classes to ul sub-menus for the Superclick.js menu helper
    function start_lvl( &$output, $depth = 0, $args = array() ) {
        // depth dependent classes
        $indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent
        $display_depth = ( $depth + 1 ); // because it counts the first submenu as 0
        $classes = array(
            'quick',
            ( $display_depth >= 2 ? 'sub-sub-menu' : '' ),
            'menu-depth-' . $display_depth
        );
        
        $class_names = implode( ' ', $classes );
        
        //build html
        $output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
    }
    
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        global $wp_query;
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
        
        $class_names = $value = '';
        
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
        $class_names = ' class=" ' . esc_attr( $class_names ) . '"';
        
        $output .= $indent . '<li id="menu-item-' . $item->ID . '"' . $value . $class_names . '>';
        
        $attributes = ! empty( $item->attr_title )  ? ' title="'  . esc_attr( $item->attr_title ) . '"' : '';
        $attributes = ! empty( $item->target )      ? ' target="' . esc_attr( $item->target     ) . '"' : '';
        $attributes = ! empty( $item->xfn )         ? ' rel="'    . esc_attr( $item->xfn        ) . '"' : '';
        $attributes = ! empty( $item->url )         ? ' href="'   . esc_attr( $item->url        ) . '"' : '';
        
        /* Additional code @link: http://www.kriesi.at/archives/improve-your-wordpress-navigation-menu-output */
        $prepend = '<strong>';
        $append = '</strong>';
        $attr_title = ! empty( $item->attr_title ) ? '<span class="sub">' . esc_attr( $item->attr_title ) . '</span>' : '';
        
        if( $depth == 1 ) {
            $attr_title = "";
            $prepend = "<span>";
            $append = "</span>";
        }
        if( $depth == 2 ) {
            $attr_title = $prepend = $append = "";
        }
        
        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '>';
        $item_output .= $args->link_before . $prepend . apply_filters( 'the_title', $item->title, $item->ID ) . $append . $args->link_after;
        $item_output .= $attr_title . '</a>';  /* Use $item->description for Description */
        $item_output .= $args->after;
        
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}

/**
 * Social Nav Menu Walker to add classes to the <a> elements for better hover styling
 * 
 * @link: http://codex.wordpress.org/Function_Reference/wp_nav_menu
 */
class Gojoseon_Social_Menu_Walker extends Walker_Nav_Menu {
    
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        global $wp_query;
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
        
        $class_names = $value = '';
        
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
        $class_names = ' class=" ' . esc_attr( $class_names ) . '"';
        
        $output .= $indent . '<li id="menu-item-' . $item->ID . '"' . $value . $class_names . '>';
        
        $attributes = ! empty( $item->attr_title )  ? ' title="'  . esc_attr( $item->attr_title ) . '"' : '';
        $attributes = ! empty( $item->target )      ? ' target="' . esc_attr( $item->target     ) . '"' : '';
        $attributes = ! empty( $item->xfn )         ? ' rel="'    . esc_attr( $item->xfn        ) . '"' : '';
        $attributes = ! empty( $item->url )         ? ' href="'   . esc_attr( $item->url        ) . '"' : '';
        
        /* Additional code @link: http://www.kriesi.at/archives/improve-your-wordpress-navigation-menu-output */
        $prepend = '<strong>';
        $append = '</strong>';
        $attr_title = ! empty( $item->attr_title ) ? '<span class="sub">' . esc_attr( $item->attr_title ) . '</span>' : '';
        
        if( $depth == 1 ) {
            $attr_title = "";
            $prepend = "<span>";
            $append = "</span>";
        }
        if( $depth == 2 ) {
            $attr_title = $prepend = $append = "";
        }
        
        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '>';
        $item_output .= $args->link_before . $prepend . apply_filters( 'the_title', $item->title, $item->ID ) . $append . $args->link_after;
        $item_output .= $attr_title . '</a>';  /* Use $item->description for Description */
        $item_output .= $args->after;
        
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}

/**
 * Enable more buttons in TinyMCE Editor & keep kitchen sink always ON
 * 
 * @link: http://premium.wpmudev.org/blog/display-the-full-tinymce-editor-in-wordpress/
 */
function gojoseon_full_tinymce( $buttons ) {
    $buttons[] = 'fontselect';
    $buttons[] = 'fontsizeselect';
    $buttons[] = 'styleselect';
    $buttons[] = 'backcolor';
    $buttons[] = 'newdocument';
    $buttons[] = 'charmap';
    $buttons[] = 'hr';
    $buttons[] = 'code'; /* @TODO: Doesn't work currently */
    
    return $buttons;
}
add_filter( 'mce_buttons_3', 'gojoseon_full_tinymce' );

function gojoseon_tinymce_always_on ( $in ) {
    $in[ 'wordpress_adv_hidden' ] = false;
    
    return $in;
}
add_filter( 'tiny_mce_before_init', 'gojoseon_tinymce_always_on' );

/**
 * Remove Jetpack's sharing so that we can tweak them in our theme
 * 
 * @link: http://jetpack.me/2013/06/10/moving-sharing-icons/
 */
function jptweak_remove_share() {
    remove_filter( 'the_content', 'sharing_display', 19 );
    remove_filter( 'the_excerpt', 'sharing_display', 19 );
    if ( class_exists( 'Jetpack_Likes' ) ) {
        remove_filter( 'the_content', array( Jetpack_Likes::init(), 'post_likes' ), 30, 1 );
    }
}
add_action( 'loop_start', 'jptweak_remove_share' );

/**
 * Modify Jetpack's Related Posts settings
 * 
 * @link: http://jetpack.me/support/related-posts/customize-related-posts/
 */
function jetpackme_more_related_posts( $options ) {
    $options[ 'size' ] = 5;
    return $options;
}
add_filter( 'jetpack_relatedposts_filter_options', 'jetpackme_more_related_posts' );

function jetpackme_related_posts_headline( $headline ) {
    $headline = sprintf(
            '<h3 class="jp-relatedposts-headline"><em>%s</em></h3>',
            esc_html( 'Check These Out!' ) 
            );
    return $headline;
}
add_filter( 'jetpack_related_posts_filter_headline', 'jetpackme_related_posts_headline' );