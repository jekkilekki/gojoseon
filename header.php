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
 * Customizer Color options
 */
    $content_text_color = get_option( 'content_text_color' );
    $content_link_color = get_option( 'content_link_color' );
    $sidebar_position = get_theme_mod( 'sidebar_position' );
?>
<style>
    body { color: <?php echo $content_text_color; ?>; }
    a { color: <?php echo $content_link_color; ?>; }
    .sidebar { float: <?php echo $sidebar_position; ?>; }
</style>

</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'gojoseon' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
            
            <div class="row">
                
                <div class="large-2 columns"><!-- Logo space + site branding -->
                    <div class="site-branding">
                            <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                            <h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
                    </div><!-- .site-branding -->
                </div><!-- #large-2 -->
                
                <div class="large-8 columns"><!-- Possible ad space or additional menu -->
                    
                </div><!-- #large-8 -->
                
                <div class="large-2 columns"><!-- Menu bar over sidebar -->
                    <nav id="site-navigation" class="main-navigation" role="navigation">
                            <button class="menu-toggle" aria-controls="menu" aria-expanded="false"><?php _e( 'Top Menu', 'gojoseon' ); ?></button>
                            <?php wp_nav_menu( array( 'theme_location' => 'top' ) ); ?>
                    </nav><!-- #site-navigation -->
                </div><!-- #large-2 -->
                
            </div><!-- #row -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
