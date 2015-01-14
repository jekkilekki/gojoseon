<?php

/**
 * Enable Theme Customizer
 * @link: http://codex.wordpress.org/Theme_Customization_API
 * @link: http://www.smashingmagazine.com/2013/03/05/the-wordpress-theme-customizer-a-developers-guide/
 * @link: http://code.tutsplus.com/tutorials/a-guide-to-the-wordpress-theme-customizer-a-methodology-for-sections-settings-and-controls-part-2--wp-33252
 */
function gojoseon_theme_customizer( $wp_customize ) {
    
    // Add all sections, settings, and controls here
    
    /**
     * Fonts
     * TODO: Actually enqueue the Google CSS files from Google (or Google API)
     *      - right now this works for me because these fonts are installed on my machine
     * @link: https://github.com/BFTrick/wp-google-font-picker-control seems easy
     * @link: http://www.dezzain.com/wordpress-tutorials/how-to-add-google-web-fonts-with-font-preview-in-wordpress-without-plugins/
     * @link: http://www.paulund.co.uk/custom-wordpress-controls very comprehensive but uses classes
     * 
     * @link: http://wptheming.com/2012/06/loading-google-fonts-from-theme-options/ Font array
     */
    $system_fonts = array();
    $google_fonts = array();
    $typography = array();
    
    $system_fonts = array(
        'Arial, sans-serif'                     => 'Arial',
        '"Avant Garde", sans-serif'             => 'Avant Garde',
        'Cambria, Georgia, serif'               => 'Cambria',
        '"Courier New", Courier, monospace'     => 'Courier New',
        'Garamond, "Hoefler Text", "Times New Roman", Times, serif' => 'Garamond', 
        'Georgia, serif'                        => 'Georgia',
        '"Helvetica Neue", Helvetica, sans-serif'   => 'Helvetica Neue',
        '"Lucida Sans Typewriter", monospace'   => 'Lucida Sans Typewriter',
        '"Lucida Typewriter", monospace'        => 'Lucida Typewriter',
        'Monaco, monospace'                     => 'Monaco',
        'Tahoma, Geneva, sans-serif'            => 'Tahoma',
        '"Times New Roman", Times, serif'       => 'Times',
    );
    
    $google_fonts = array(
        'Arvo, serif'                           => 'Arvo',
        'Copse, sans-serif'                     => 'Copse',
        '"Droid Sans", sans-serif'              => 'Droid Sans',
        '"Droid Serif", serif'                  => 'Droid Serif',
        'Lato, sans-serif'                      => 'Lato',
        'Lobster, cursive'                      => 'Lobster',
        'Merriweather, serif'                   => 'Merriweather',
        'Nobile, sans-serif'                    => 'Nobile',
        '"Open Sans", sans-serif'               => 'Open Sans',
        'Oswald, sans-serif'                    => 'Oswald',
        'Pacifico, cursive'                     => 'Pacifico',
        'Roboto, sans-serif'                    => 'Roboto',
        '"Roboto Condensed", sans-serif'        => 'Roboto Condensed',
        '"Roboto Slab", serif'                  => 'Roboto Slab',
        '"PT Sans", sans-serif'                 => 'PT Sans',
        '"PT Serif", serif'                     => 'PT Serif',
        'Quattrocento, serif'                   => 'Quattrocento',
        'Raleway, cursive'                      => 'Raleway',
        'Rokkitt, serif'                        => 'Rokkit',
        'Ubuntu, sans-serif'                    => 'Ubuntu',
        '"Yanone Kaffeesatz", sans-serif'       => 'Yanone Kaffeesatz',
    );
    
    $typography = array_merge( $system_fonts, $google_fonts );
    asort( $typography );
    
    $fonts = array();
    $fonts[] = array(
        'slug'      => 'header_font',
        'default'   => '"Roboto Slab"', 
        'label'     => __( 'Title Fonts', 'gojoseon' )
    );
    $fonts[] = array(
        'slug'      => 'content_font',
        'default'   => 'Roboto',
        'label'     => __( 'Content Font', 'gojoseon' )
    );
    
    foreach( $fonts as $font ) {
        
        // SETTINGS
        $wp_customize->add_setting(
                $font[ 'slug' ], array(
                    'default'       => $font[ 'default' ],
                    'type'          => 'theme_mod',
                    'capability'    => 'edit_theme_options'
                )
        );
        
        // CONTROLS
        $wp_customize->add_control(
                $font[ 'slug' ],
                array(
                    'label'     => $font[ 'label' ],
                    'section'   => 'fonts',
                    'type'      => 'select',
                    'choices'   => $typography,
                )
        );
        
        $wp_customize->add_section( 'fonts', array(
            'title'     => __( 'Fonts', 'gojoseon' ),
            'priority'  => 30,
        ));
    }
    
    /*
     * Colors
     */
    $colors = array();
    $colors[] = array(
        'slug'      => 'content_text_color',
        'default'   => '#333',
        'label'     => __( 'Content Text Color', 'gojoseon' )
    );
    $colors[] = array(
        'slug'      => 'content_link_color',
        'default'   => '#cd7f32', 
        'label'     => __( 'Link Color', 'gojoseon' )
    );
    foreach( $colors as $color ) {
        
        // SETTINGS
        $wp_customize->add_setting(
                $color[ 'slug' ], array(
                    'default'       => $color[ 'default' ],
                    'type'          => 'option',
                    'capability'    => 'edit_theme_options'
                )
        );
        
        // CONTROLS
        $wp_customize->add_control(
                new WP_Customize_Color_Control(
                        $wp_customize,
                        $color[ 'slug' ],
                        array(
                            'label'     => $color[ 'label' ],
                            'section'   => 'colors',
                            'settings'  => $color[ 'slug' ]
                        )
                )
        );
    }
    
    /**
     * Logo Image
     * 
     * @link: http://scottbolinger.com/add-a-custom-logo-uploader-to-the-wordpress-theme-customizer/
     * @link: http://kwight.ca/2012/12/02/adding-a-logo-uploader-to-your-wordpress-site-with-the-theme-customizer/
     */
    $wp_customize->add_setting( 'logo_image' );
    $wp_customize->add_control(
            new WP_Customize_Image_Control(
                    $wp_customize,
                    'logo_image',
                    array(
                        'label'         => __( 'Upload Logo', 'gojoseon' ),
                        'description'   => __( 'Replaces site title and tagline.', 'gojoseon' ),
                        'section'       => 'title_tagline',
                        'settings'      => 'logo_image',
                    )
            )
    );
    
    /**
     * Layout
     * TODO: Make the style code in header.php actually move the sidebar position
     * TODO: Also, make the quick menu fixed and layout left/right chooseable too
     * 
     * @link: http://www.wpexplorer.com/interacting-with-wordpress-theme-customizer/
     * @link: http://wptricks.co.uk/create-a-better-options-page-with-the-theme-customizer/#three
     * 
     * PROBLEM: If following tutorials above, there's a problem with the 'body_class' filter
     */
    $wp_customize->add_setting( 'sidebar_position', array(
        'default'   => 'right',
        'type'      => 'theme_mod',
    ));
    $wp_customize->add_control( 'sidebar_position', array(
        'label'     => __( 'Sidebar Position', 'gojoseon' ),
        'section'   => 'layout',
        'settings'  => 'sidebar_position',
        'type'      => 'radio',
        'choices'   => array(
            'right'     => 'Right',
            'left'      => 'Left',
            'none'      => 'None',
        ),
    ));
    $wp_customize->add_section( 'layout', array(
        'title'     => __( 'Layout', 'gojoseon' ),
        'priority'  => 50,
    ));
    
    $wp_customize->add_setting( 'quickmenu_position', array(
        'default'   => 'left',
        'type'      => 'theme_mod',
    ));
    $wp_customize->add_control( 'quickmenu_position', array(
        'label'     => __( 'Quickmenu Position', 'gojoseon' ),
        'section'   => 'layout',
        'settings'  => 'quickmenu_position',
        'type'      => 'radio',
        'choices'   => array(
            'left'      => 'Left',
            'right'     => 'Right',
            'none'      => 'None',
        ),
    ));
}
add_action( 'customize_register', 'gojoseon_theme_customizer' );