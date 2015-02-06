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

<script type="text/javascript" src="http://apis.google.com/js/plusone.js"></script>

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
    
    // @TODO: Fix this whole repositioning thing for different Theme Customizer options
    $quickmenu_position = get_theme_mod( 'quickmenu_position', 'left' );
    if ( $quickmenu_position == 'none' ) {
        $quickmenu = false;
        $row_padding = '256px';
        $row_padding_right = '0px';
        $primarymenu_margin = '0px';
    } else if ( $quickmenu_position == 'right' ) {
        $quickmenu = true;
        $row_padding = '256px';
        $row_padding_right = '64px';
        $primarymenu_margin = '0px';
    } else {
        $quickmenu = true;
        $row_padding = '320px';
        $rox_padding_right = '0px';
        $primarymenu_margin = '64px';
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
    .padded-row { padding-left: <?php echo $row_padding; ?>; padding-right: <?php echo $row_padding_right; ?>; } // Give extra padding for the Quickmenu
    #primary-menu { margin-left: <?php echo $primarymenu_margin; ?>; }
    #top-navigation ul li a { color: <?php echo $header_textcolor; ?>; }
    #side-nav, #main, #secondary { border-top-width: <?php echo $header_border_width; ?>; }
    <?php if ( get_theme_mod ( 'logo_image_background_color' ) == 1 ) : ?> 
        .site-branding { background-color: transparent; }
    <?php endif; ?>
</style>

</head>

<body <?php body_class(); ?>>

<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'gojoseon' ); ?></a>
        
        <?php if ( $quickmenu ) {
            get_template_part( 'quickmenu' );
        } ?>
        
        <!-- Primary Site Navigation Bar (sticky) -->
        <div id="primary-menu">

            <div class="something"><!-- @TODO: Change this name -->
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
            <nav id="primary-navigation" class="primary-nav navigation" role="navigation">
                <button id="primary-nav-button" class="menu-toggle" aria-controls="menu" aria-expanded="true"><?php _e( 'Main Menu', 'gojoseon' ); ?></button>
                    <?php // gojoseon_primary_menu(); ?>
                    <?php wp_nav_menu( array( 'container' => false, 'menu_id' => 'primary-nav-ul', 'theme_location' => 'primary' ) ); ?>
            </nav><!-- End #site-nav -->
            
            </div><!-- .something -->

        </div><!-- End #primary-menu -->

        
    <!-- Foundation's Responsive Awesomeness Begins here -->
    <div class="row padded-row">
        
        <!-- Begin main content area -->
        <div id="content" class="site-content large-12 columns" data-equalizer> 

            <!-- Header area -->
            <header id="masthead" class="site-header" role="banner">

                <?php if ( get_header_image() ) : ?>
                
                <!-- Header Image -->
                <div class="header-image<?php if ( get_theme_mod( 'header_image_type' ) ) { ?>-pattern<?php } ?>" style="background: url(<?php header_image(); ?>)">;
                </div>
                
                <?php endif; // End header image check. ?>

                
                <!-- Top Widgetized Area -->
                <div class="large-12 columns sidebar-top">
                    <?php get_sidebar( 'header' ); ?>
                </div>

                <!-- Site description/tagline -->
                <div class=" large-6 medium-10 columns">
                    <h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
                </div>

                <!-- Menu bar over sidebar -->
                <div class=" large-6 medium-2 columns">
                    <nav id="site-navigation" class="top-navigation" role="navigation">
                        <button class="menu-toggle" aria-controls="menu" aria-expanded="false"><?php _e( 'Top Menu', 'gojoseon' ); ?></button>
                        <?php wp_nav_menu( array( 'theme_location' => 'top' ) ); ?>
                    </nav><!-- #top-navigation -->
                </div>

            </header><!-- End header #masthead -->
                
            <!-- Main Content Area -->  
            <?php if ( $sidebar_display == 'none' || is_page_template( 'page-templates/page-nosidebar.php' ) ) {
                echo '<div id="primary" class="content-area large-12 columns full-width" data-equalizer-watch>';
            } else {
                echo '<div id="primary" class="content-area large-9 medium-12 columns" data-equalizer-watch>';
            } ?>

            <?php if ( get_theme_mod( 'show_breadcrumbs', true ) == true && !is_home() && !is_archive() && !is_search() && !is_404() ) { the_breadcrumb(); } ?>