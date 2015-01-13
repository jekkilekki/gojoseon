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
    $content_text_color = get_option( 'content_text_color' );
    $content_link_color = get_option( 'content_link_color' );
    $sidebar_position = get_theme_mod( 'sidebar_position' );
    $sidebar_display = 'block';
    if ( $sidebar_position == 'none' ) {
        $sidebar_display = 'none';
    } else if ( $sidebar_position == 'left' ) {
        $content_position = 'right';
    } else {
        $content_position = 'left';
    }
    $quickmenu_position = get_theme_mod( 'quickmenu_position' );
    if ( $quickmenu_position == 'none' ) {
        $quickmenu = false;
        $quickmenu_padding = '0px';
    } else {
        $quickmenu = true;
        $quickmenu_padding = '50px';
    }
    
    $content_font = get_theme_mod( 'content_font' );
    $header_font = get_theme_mod( 'header_font' );
    
?>
<style>
    body { color: <?php echo $content_text_color; ?>; font-family: "<?php echo $content_font; ?>"; }
    h1, h2, h3, h4, h5, h6 { font-family: "<?php echo $header_font; ?>"; }
    a { color: <?php echo $content_link_color; ?>; }
    #primary { float: <?php echo $content_position; ?>; }
    #secondary { display: <?php echo $sidebar_display; ?>; }
    #quickmenu { <?php echo $quickmenu_position; ?>: 0; }
    .row { padding-<?php echo $quickmenu_position; ?>: <?php echo $quickmenu_padding; ?>; } // Give extra padding for the Quickmenu
</style>

</head>

<body <?php body_class(); ?>>

<?php if ( $quickmenu ) {
    get_template_part( 'quickmenu' );
} ?>
    
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'gojoseon' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
            
            <div class="row">
                
                <!-- Site branding -->
                <div class="site-branding large-2 columns">
                    <?php if ( get_theme_mod( 'logo_image' ) ) : ?>
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" id="site-logo" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">

                            <img src="<?php echo get_theme_mod( 'logo_image' ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">

                        </a>

                    <?php else : ?>
                        <hgroup>
                            <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                            <h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
                        </hgroup>

                    <?php endif; ?>
                </div><!-- .site-branding -->
                
                <div class="large-8 columns"><!-- Possible ad space or additional menu -->
                    
                </div><!-- #large-8 -->
                
                <!-- Menu bar over sidebar -->
                    <nav id="top-navigation" class="main-navigation large-2 columns" role="navigation">
                            <button class="menu-toggle" aria-controls="menu" aria-expanded="false"><?php _e( 'Top Menu', 'gojoseon' ); ?></button>
                            <?php wp_nav_menu( array( 'theme_location' => 'top' ) ); ?>
                    </nav><!-- #top-navigation -->
                
            </div><!-- #row -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
