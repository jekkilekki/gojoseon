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
    $standard_fonts = array();
    $google_fonts = array();
    
    $standard_fonts[] = array(
        'Arial, sans-serif'     => 'Arial',
        '"Avant Garde", sans-serif' => 'Avant Garde',
        'Cambria, Georgia, serif'   => 'Cambria',
        'Copse, sans-serif'         => 'Copse',
        'Garamond, "Hoefler Text", "Times New Roman", Times, serif' => 'Garamond', 
        'Georgia, serif'            => 'Georgia',
        '"Helvetica Neue", Helvetica, sans-serif'   => 'Helvetica Neue', 
        'Tahoma, Geneva, sans-serif'    => 'Tahoma'
            'stack' => 'Georgia, Times, "Times New Roman", serif'
        'sans-serif' => array(
            'label' => _x( 'Sans Serif fonts', 'font style', 'gather' ),
            'stack' => '"Helvetica Neue", Helvetica, Arial, sans-serif'
        ),
        'monospace' => array(
            'label' => _x( 'Monospaced fonts', 'font style', 'gather' ),
            'stack' => 'Monaco, "Lucida Sans Typewriter", "Lucida Typewriter", "Courier New", Courier, monospace'
        )
    );
    
    $google_fonts[] = array(
        'serif' => array(
            'label' => _x( 'Serif fonts', 'font style', 'gather' ),
            'stack' => '"Roboto Slab", "PT Serif", Merriweather'
        ),
        'sans-serif' => array(
            'label' => _x( 'Sans Serif fonts', 'font style', 'gather' ),
            'stack' => 'Roboto, "Roboto Condensed", "Open Sans", "PT Sans", Lato, Raleway'
        ),
        'monospace' => array(
            'label' => _x( 'Monospaced fonts', 'font style', 'gather' ),
            'stack' => ''
        )
    );
    
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
                    'choices'   => array(
                        'Roboto'                => 'Roboto',
                        'Roboto Condensed'      => 'Roboto Condensed',
                        'Roboto Slab'           => 'Roboto Slab',
                        'PT Sans'               => 'PT Sans',
                        'PT Serif'              => 'PT Serif',
                        'Open Sans'             => 'Open Sans',
                        'Merriweather'          => 'Merriweather'
                    )
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
                        'label'     => __( 'Upload Logo (replaces text)', 'gojoseon' ),
                        'section'   => 'title_tagline',
                        'settings'  => 'logo_image',
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
            'sidebar-right'     => 'Right',
            'sidebar-left'      => 'Left',
            'sidebar-none'      => 'None',
        ),
    ));
    $wp_customize->add_section( 'layout', array(
        'title'     => __( 'Layout', 'gojoseon' ),
        'priority'  => 50,
    ));
}
add_action( 'customize_register', 'gojoseon_theme_customizer' );