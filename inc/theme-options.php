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
    
    /**
     * Select Categories for the Home Page
     * 
     * @link: http://josephfitzsimmons.com/adding-a-select-box-with-categories-into-wordpress-theme-customizer/
     */
    
    /**
     * Social site icons for Quick Menu bar
     */
    $wp_customize->add_section( 'social_settings', array(
        'title'     => __( 'Social Media Icons', 'gojoseon' ),
        'priority'  => 100,
    ));
    
    $social_sites = gojoseon_get_social_sites();
    $priority = 5;
    
    foreach( $social_sites as $social_site ) {
        
        $wp_customize->add_setting( "$social_site", array(
            'type'              => 'theme_mod',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'esc_url_raw',
        ));
        
        $wp_customize->add_control( $social_site, array(
            'label'             => __( "$social_site url:", 'social_icon' ),
            'section'           => 'social_settings',
            'type'              => 'text',
            'priority'          => $priority,
        ));
        
        $priority += 5;
    }
}
add_action( 'customize_register', 'gojoseon_theme_customizer' );

/**
 * Custom functions to store and enqueue Google Fonts
 * 
 * @link: http://www.slidedeck.com/blog/tutorial-how-to-integrate-custom-google-fonts-into-slidedeck-2-for-wordpress/
 * 
 * 
 */
function gojoseon_get_system_fonts() {
    
}

function gojoseon_get_google_fonts() {
    
}

// Check font options to see if a Google font is selected.
// If so, gojoseon_enqueue_google_fonts() is called to enqueue the font.
// Ensures that each Google font is only enqueued once.
// @link: http://wptheming.com/2012/06/loading-google-fonts-from-theme-options/
if ( !function_exists( 'gojoseon_google_fonts' ) ) {
    function gojoseon_google_fonts() {
        
        $all_google_fonts = array_keys( gojoseon_get_google_fonts() );
        
        // Define all the options that possibly have a unique Google font
        // ...
        
        // Get the font face for each option and put it in an array 
        // ...
        
        // Remove any duplicates in the list
        // ...
        
        // Check each of the unique fonts against the defined Google fonts
        // If it is a Google font, go ahead and call the function to enqueue it
        foreach ( $selected_fonts as $selected_font ) {
            if ( in_array( $font, $all_google_fonts ) ) {
                gojoseon_enqueue_google_fonts( $font );
            }
        }
    }
}
add_action( 'wp_enqueue_scripts', 'gojoseon_google_fonts' );

// Enqueues the Google $font that is passed
function gojoseon_enqueue_google_fonts( $font ) {
    $font = explode( ',', $font );
    $font = $font[0];
    
    // Certain Google fonts need slight tweaks in order to load properly like Raleway
    if ( $font == 'Raleway' )
        $font = 'Raleway:100';
    
    $font = str_replace( " ", "+", $font );
    
    wp_enqueue_style( "gojoseon_typography_$font", "http://fonts.googleapis.com/css?family=$font", false, null, 'all' );
}

/**
 * Custom functions to store and output social media icons
 * 
 * @return array
 * 
 * @link: https://www.competethemes.com/social-icons-wordpress-menu-theme-customizer/
 */
function gojoseon_get_social_sites() {
    
    // Store social site names in array
    $social_sites = array(
        'twitter', 
        'facebook', 
        'google-plus',
        'flickr',
        'pinterest', 
        'youtube',
        'vimeo',
        'tumblr',
        'dribbble',
        'rss',
        'linkedin',
        'instagram',
        'email'
    );
    return $social_sites;
}

// Get user input from the Customizer and output the linked social media icons
function gojoseon_show_social_icons() {
    
    $social_sites = gojoseon_get_social_sites();
    
    // Any inputs that aren't empty are stored in $active_sites array
    foreach( $social_sites as $social_site ) {
        if ( strlen( get_theme_mod( $social_site ) ) > 0 ) {
            $active_sites[] = $social_site;
        }
    }
    
    // For each active social site, add it as a list item
    if ( !empty( $active_sites ) ) {
        echo "<ul class='social-media-icons'>";
        
        foreach ( $active_sites as $active_site ) {?>
            <li>
                <a href="<?php echo get_theme_mod( $active_site ); ?>">
                    <?php if( $active_site == 'vimeo' ) { ?>
                        <i class="fa fa-<?php echo $active_site; ?>-square"></i> <?php
                    } else { ?>
                        <i class="fa fa-<?php echo $active_site; ?>"></i> <?php
                    } ?>
                </a>
            </li> <?php
        }
        echo "</ul>";
    }
}