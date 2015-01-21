<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Gojoseon
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>

<?php
/**
 * Customizer options
 */
    $header_textcolor = get_theme_mod( 'header_textcolor', '#000' );
    $content_text_color = get_option( 'content_text_color', '#333' );
    $content_link_color = get_option( 'content_link_color', '#cd7f32' );
    $sidebar_position = get_theme_mod( 'sidebar_position', 'right' );
    $sidebar_display = 'block';
    if ( $sidebar_position == 'none' ) {
        $sidebar_display = 'none';
    } else if ( $sidebar_position == 'left' ) {
        $content_position = 'right';
    } else {
        $content_position = 'left';
    }
    $quickmenu_position = get_theme_mod( 'quickmenu_position', 'left' );
    if ( $quickmenu_position == 'none' ) {
        $quickmenu = false;
        $quickmenu_padding = '0px';
    } else {
        $quickmenu = true;
        $quickmenu_padding = '64px';
    }
    
    $content_font = get_theme_mod( 'content_font', 'Roboto' );
    $header_font = get_theme_mod( 'header_font', 'Roboto Slab' );
    
    if ( get_header_image() ) {
        $header_border_width = '0px';
    } else {
        $header_border_width = '5px';
    }
    
?>
<style>
    body { color: <?php echo $content_text_color; ?>; font-family: <?php echo $content_font; ?>; }
    h1, h2, h3, h4, h5, h6 { font-family: <?php echo $header_font; ?>; }
    a { color: <?php echo $content_link_color; ?>; }
    #primary { float: <?php echo $content_position; ?>; }
    #secondary { display: <?php echo $sidebar_display; ?>; }
    #quickmenu, .topbutton { <?php echo $quickmenu_position; ?>: 0; }
    #search-container { <?php echo $quickmenu_position; ?>: 4rem; }
    .row { padding-<?php echo $quickmenu_position; ?>: <?php echo $quickmenu_padding; ?>; } // Give extra padding for the Quickmenu
    #top-navigation ul li a { color: <?php echo $header_textcolor; ?>; }
    #side-nav, #main, #secondary { border-top-width: <?php echo $header_border_width; ?>; }
    <?php if ( get_theme_mod ( 'logo_image_background_color' ) == 1 ) : ?> 
        .site-branding { background-color: transparent; }
    <?php endif; ?>
</style>

</head>

<body <?php body_class(); ?>>

<?php if ( $quickmenu ) {
    get_template_part( 'quickmenu' );
} ?>
    
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'gojoseon' ); ?></a>
        
    <div class="row">
        
        <!-- Primary Site Navigation Bar (sticky) -->
        <div id="primary-menu" class="large-2 columns">

            <div class="something">
            <!-- Site Branding -->
            <div class="site-branding">
                
                <?php if ( get_theme_mod( 'gojoseon_logo' ) ) : ?>
                
                <!-- Site logo (replaces title) -->    
                <div  id="site-logo">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
                        <img src="<?php echo get_theme_mod( 'gojoseon_logo' ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
                    </a>
                </div>
                
                <?php else : ?>
                
                <!-- Site title -->
                <hgroup>
                    <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                </hgroup>
                
                <?php endif; ?>
                
            </div><!-- End .site-branding -->

            <!-- Primary Menu -->  
            <nav id="side-nav" class="navigation" role="navigation">
                <button class="menu-toggle" aria-controls="menu" aria-expanded="true"><?php _e( 'Primary Menu', 'gojoseon' ); ?></button>
                <?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
            </nav><!-- End #site-nav -->
            </div>

        </div><!-- End #primary-menu .large-2 columns -->
        
        <!-- Begin main content area -->
        <div id="content" class="site-content large-10 columns"> 

            <!-- Header area -->
            <header id="masthead" class="site-header" role="banner">

                <?php if ( get_header_image() ) : ?>
                
                <!-- Header Image -->
                <div class="header-image<?php if ( get_theme_mod( 'header_image_type' ) ) { ?>-pattern<?php } ?>" style="background: url(<?php header_image(); ?>)">;
                </div>
                
                <?php endif; // End header image check. ?>

                
                <!-- Top Widgetized Area -->
                <div class="large-12 columns sidebar-top">

                </div>

                <!-- Site description/tagline -->
                <div class=" large-6 columns">
                    <h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
                </div>

                <!-- Menu bar over sidebar -->
                <div class=" large-6 columns">
                    <nav id="top-navigation" class="main-navigation" role="navigation">
                        <button class="menu-toggle" aria-controls="menu" aria-expanded="false"><?php _e( 'Top Menu', 'gojoseon' ); ?></button>
                        <?php wp_nav_menu( array( 'theme_location' => 'top' ) ); ?>
                    </nav><!-- #top-navigation -->
                </div>

            </header><!-- End header #masthead -->
                
            <!-- Main Content Area -->  
            <?php if ( $sidebar_display != 'none' ) {
                echo '<div id="primary" class="content-area large-9 medium-8 columns" data-equalizer-watch>';
            } else {
                echo '<div id="primary" class="content-area large12 columns" data-equalizer-watch>';
            } ?>

            <?php if ( get_theme_mod( 'show_breadcrumbs' ) == true ) { the_breadcrumb(); } ?>