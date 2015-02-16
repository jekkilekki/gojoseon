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

</head>

<body <?php body_class(); ?>>
    
<div class="off-canvas-wrap" data-offcanvas><!-- Start Foundation's off-canvas portion -->
<div class="inner-wrap"><!-- Foundation's inner-wrap -->
    
    <a id="primary-nav-button" class="left-off-canvas-toggle menu-icon" href="#" rel="primarymenu-list"><?php _e( 'Main Menu', 'gojoseon' ); ?></a>
    <?php gojoseon_primary_menu(); ?>
        
<div id="page" class="hfeed site main-section">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'gojoseon' ); ?></a>

        <?php if ( get_theme_mod( 'quickmenu_position', 'left' ) !== 'none' ) {
            echo '<div id="quickmenu-wrap">';
                get_template_part( 'quickmenu' );
            echo '</div><!-- #quickmenu-wrap -->';
        } ?>
        
<!--        <div class="off-canvas-wrap" data-offcanvas> Start Foundation's off-canvas portion 
        <div class="inner-wrap"> Foundation's inner-wrap -->
    
            <!--<a class="left-off-canvas-toggle" href="#" rel="quickmenu-list">Quick Menu</a>-->
            <?php gojoseon_quick_menu(); // Place this outside the "quickmenu" div so it will stay on top ?>
            
        <div class="qm-padded-page">
            
            <!-- Primary Site Navigation Bar (sticky) -->
            <div id="primary-menu">
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
                    <!--<button id="primary-nav-button" class="menu-toggle" aria-controls="menu" aria-expanded="true"></button>-->
                        <?php wp_nav_menu( array( 'container' => false, 'menu_id' => 'primary-nav-ul', 'theme_location' => 'primary' ) ); ?>
                </nav><!-- End #site-nav -->
            </div><!-- End #primary-menu -->
            

            <?php if ( get_header_image() ) : ?>
            <!-- Header Image -->
            <div class="row header-image-row <?php if ( get_theme_mod( 'logo_image_background_color' ) != 1 ) { echo 'padded-row'; } else { echo ''; } ?>">
                <div class="header-image<?php if ( get_theme_mod( 'header_image_type' ) ) { ?>-pattern<?php } ?>" style="background: url(<?php header_image(); ?>)">
                </div>
            </div>
            <?php endif; // End header image check. ?>
            
            
            <div class="row padded-row">
                
                <!-- Header area -->
                <header id="masthead" class="site-header" role="banner">

                    <div class="header-wrap large-12 columns">
                        <!-- Top Widgetized Area -->
                        <div class="large-12 columns google-ad-space">
                            
                        </div>

                        <!-- Site description/tagline -->
                        <div class=" large-6 small-9 columns">
                            <h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
                        </div>

                        <!-- Menu bar over sidebar -->
                        <div class=" large-6 small-3 columns">
                            <nav id="site-navigation" class="top-navigation" role="navigation">
                                <button class="menu-toggle" aria-controls="menu" aria-expanded="false"><?php _e( 'Top Menu', 'gojoseon' ); ?></button>
                                <?php wp_nav_menu( array( 'theme_location' => 'top' ) ); ?>
                            </nav><!-- #top-navigation -->
                        </div>
                    </div><!-- .header-wrap -->

                </header><!-- End header #masthead -->
            </div><!-- .row .padded-row -->

            
            <div class="row padded-row">
                <!-- Begin main content area -->
                <div id="content" class="site-content large-12 columns" data-equalizer> 

                <!-- Main Content Area -->  
                <?php if ( get_theme_mod( 'sidebar_position', 'right' ) == 'none' || is_page_template( 'page-templates/page-nosidebar.php' ) ) {
                    echo '<div id="primary" class="content-area large-12 columns full-width" data-equalizer-watch>';
                } else {
                    echo '<div id="primary" class="content-area large-9 medium-12 columns" data-equalizer-watch>';
                } ?>

                <?php if ( get_theme_mod( 'show_breadcrumbs', true ) == true && !is_home() && !is_archive() && !is_search() && !is_404() ) { the_breadcrumb(); } ?>