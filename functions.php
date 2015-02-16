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
	$content_width = 780; /* pixels */
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

	// This theme styles the visual editor to resemble the theme style.
        // @TODO: Make sure this $font_url will call WHATEVER Google Font we have selected in the Theme Customizer Options
        $font_url = 'http://fonts.googleapis.com/css?family=Roboto|Roboto+Slab';
        add_editor_style( array( 'inc/editor-style.css', str_replace( ',', '$2C', $font_url ) ) );
    
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
        add_image_size( 'large-thumb', 880, 500, true );
        add_image_size( 'index-thumb', 780, 200, true );

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
        
        // Enqueue Slick slider
        wp_enqueue_style( 'gojoseon-slick-slider', get_template_directory_uri() . '/slick/slick.css' );
        wp_enqueue_style( 'gojoseon-slick-theme', get_template_directory_uri() . '/slick/slick-theme.css' );
        wp_enqueue_script( 'gojoseon-slick-js', get_template_directory_uri() . '/slick/slick.min.js', array( 'jquery' ), '20150212', true );
        
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
    // @TODO: Make a multi-level off-canvas menu
    // @link: http://foundation.zurb.com/docs/components/offcanvas.html#off-canvas-multilevel-menu
    // @link: http://wordpress.aspcode.net/view/63538464303732726667245/costum-walker-with-sub-menu-item-count

    
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
        $display_depth = ( $depth + 1 ); // because is counts the first submenu as 0
        
        $class_names = $value = '';
        
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
        $class_names = ' class="quick ' . esc_attr( $class_names ) . '"';
        
        $output .= $indent . '<li id="has-submenu menu-item-' . $item->ID . '"' . $value . $class_names . '>';
         
        $attributes  = ! empty( $item->attr_title )  ? ' title="'  . esc_attr( $item->attr_title ) . '"' : '';
        $attributes .= ! empty( $item->target )      ? ' target="' . esc_attr( $item->target     ) . '"' : '';
        $attributes .= ! empty( $item->xfn )         ? ' rel="'    . esc_attr( $item->xfn        ) . '"' : '';
        $attributes .= ! empty( $item->url )         ? ' href="'   . esc_attr( $item->url        ) . '"' : '';
            
        /* Additional code @link: http://www.kriesi.at/archives/improve-your-wordpress-navigation-menu-output */
        $prepend = '<strong>';
        $append = '</strong>';
        $attr_title = ! empty( $item->attr_title ) ? '<span class="sub">' . esc_attr( $item->attr_title ) . '</span>' : '';
        
        // If one level after the <ul>, add a <span> to the title
        if( $depth == 1 ) {
            $attr_title = "";
            $prepend = "<span>";
            $append = "</span>";
        }
        // If two levels deep, no <span>
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
 * Custom Menu Walker for LEARNING 
 * 
 * @TODO: Delete this later?
 * @link: http://shinraholdings.com/62/custom-nav-menu-walker-function/#example-code
 */
class Gojoseon_Basic_Menu_Walker extends Walker_Nav_Menu {

    // Add classes to ul sub-menus
    function start_lvl( &$output, $depth = 0, $args = array() ) {
        // depth dependent classes
        $indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent
        $display_depth = ( $depth + 1 ); // because it counts the first submenu as 0
        $classes = array(
            'sub-menu',
            ( $display_depth % 2 ? 'menu-odd' : 'menu-even' ),
            ( $display_depth >= 2 ? 'sub-sub-menu' : '' ),
            'menu-depth-' . $display_depth
        );
        $class_names = implode( ' ', $classes );
        
        // build html
        $output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
    }
    
    // Add main/sub classes to li's and links
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        global $wp_query;
        $indent = ( $depth > 0 ) ? str_repeat( "\t", $depth ) : ''; // code indent
        
        // depth dependent classes
        $depth_classes = array(
            ( $depth == 0 ? 'main-menu-item' : 'sub-menu-item' ),
            ( $depth >= 2 ? 'sub-sub-menu-item' : '' ),
            ( $depth %  2 ? 'menu-item-odd' : 'menu-item-even' ),
            'menu-item-depth-' . $depth
        );
        $depth_class_names = esc_attr( implode( ' ', $depth_classes ) );
        
        // passed classes
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );
        
        // build html
        $output .= $indent . '<li id="nav-menu-item-' . $item->ID . '" class="' . $depth_class_names . ' ' . $class_names . '">';
        
        // link attributes
        $attributes  = ! empty( $item->attr_title ) ? ' title="'     .esc_attr( $item->attr_title ) . '"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="'    .esc_attr( $item->target     ) . '"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'       .esc_attr( $item->xfn        ) . '"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'      .esc_attr( $item->url        ) . '"' : '';
        $attributes .= ' class="menu-link ' . ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link'   ) . '"';
        
        $item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
                $args->before,
                $attributes,
                $args->link_before,
                apply_filters( 'the_title', $item->title, $item->ID ),
                $args->link_after,
                $args->after
        );
        
        // build html
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}

/**
 * Custom Menu Walker to assign Foundation classes to the Primary Menu #primary-menu
 * 
 * @link: https://github.com/rickbutterfield/FoundationNavWalker/blob/master/FoundationNavWalker.class.php
 * @link: http://foundation.zurb.com/forum/posts/438-enabling-foundation-5-nav-with-wordpress-menus (this one for Top Nav)
 */
class Gojoseon_Foundation_Menu_Walker extends Walker_Nav_Menu {

    // Add classes to ul sub-menus
    function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent
        $display_depth = ( $depth + 1 ); // because it counts the first submenu as 0
        $classes = array(
            'sub-menu',
            ( $display_depth % 2 ? 'menu-odd' : 'menu-even' ),
            ( $display_depth >= 2 ? 'sub-sub-menu' : '' ),
            'menu-depth-' . $display_depth
        );
        $class_names = implode( ' ', $classes );
        
        // build html
        $output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
    }
    
    // Add main/sub classes to li's and links
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        global $wp_query;
        $indent = ( $depth > 0 ) ? str_repeat( "\t", $depth ) : ''; // code indent
        
        // Get classes
        $class_names = $value = '';

        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;
        $classes[] = ( $item->current ) ? 'active' : '';
        
        if ( $depth === 0 ) {
            $level = '';
        } else if ( $depth === 1 ) {
            $level = '';
        } else if ( $depth === 2 ) {
            $level = '<i class="fa fa-long-arrow-right"></i>';
        } else {
            $level = "++\t";
        }
        
        if ( ! empty( $item->url ) ) {
            $link = '<a href="' . $item->url . '">' . $level . $item->title . '</a>';
            $no_link_class = '';
        } else {
            $link = '<span class="no-link">' . esc_attr( $item->title ) . '</span>';
            $no_link_class = ' no-link';
        }

        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );

        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . $no_link_class . '"' : '';

        // Get id
        $id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args );
        $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
        
        
        if ( $depth === 0 ) {
            $output .= '<li' . $id . $value .$class_names . '><label>' . $link . '</label></li>';
        } else if ( $depth > 0 ) {
            $output .= $indent . '<li' . $id . $value . $class_names . '>' . $link . '</li>';
        }
    }
    
    function end_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat( "\t", $depth );
        $output .= "\n$indent\n";
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

/**
 * Add a default fallback image if no image is found in a post (Jetpack)
 * 
 * @link: http://jetpack.me/2013/10/15/add-a-default-fallback-image-if-no-image/
 */
function jeherve_custom_image( $media, $post_id, $args ) {
    if ( $media ) {
        return $media;
    } else {
        $permalink = get_permalink( $post_id );
        $url = apply_filters( 'jetpack_photon_url', 'YOUR_LOGO_IMG_URL' );
        
        return array( array(
            'type'  => 'image',
            'from'  => 'custom_fallback',
            'src'   => esc_url( $url ),
            'href'  => $permalink,
        ) );
    }
}
add_filter( 'jetpack_images_get_images', 'jeherve_custom_image', 10, 3 );

/**
 * Make BETTER Comments by separating "real" comments from trackbacks and pingbacks
 * (PINGS CALLBACK)
 * 
 * @link: http://sivel.net/2008/10/wp-27-comment-separation/
 * @link: http://www.wpbeginner.com/wp-tutorials/how-to-separate-trackbacks-from-comments-in-wordpress/
 */
function list_pings( $comment, $args, $depth ) {
    $GLOBALS[ 'comment' ] = $comment; ?>
    
    <li id="comment-<?php comment_ID(); ?>">
            <?php comment_author_link(); ?>
    </li>
    
    <?php
}

/**
 * Display the TRUE Comments number (minus trackbacks and pingbacks)
 * 
 * @link: http://web-design-weekly.com/snippets/remove-trackbacks-from-comment-count-in-wordpress/ (Updated to deal with "Strict Standards")
 */
function comment_count( $count ) {
    if( ! is_admin() ) {
        global $id;
        $get_comments = get_comments( 'status=approve&post_id=' . $id );
        
        $comments_by_type = separate_comments( $get_comments );
        
        return count( $comments_by_type[ 'comment' ] );
    } else {
        return $count;
    }
}
add_filter( 'get_comments_number', 'comment_count', 0 );