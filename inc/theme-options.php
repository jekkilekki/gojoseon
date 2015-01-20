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
     * Logo Image
     * 
     * @link: http://scottbolinger.com/add-a-custom-logo-uploader-to-the-wordpress-theme-customizer/
     * @link: http://kwight.ca/2012/12/02/adding-a-logo-uploader-to-your-wordpress-site-with-the-theme-customizer/
     * @link: http://buildwpyourself.com/customizing-client-options-using-the-theme-customizer/
     * 
     * TODO (later): Add support for JetPack logo
     * @link: http://jetpack.me/support/site-logo/
     */
    
    // Modify the Site Title & Tagline section heading
    $wp_customize->get_section( 'title_tagline' )->title = __( 'Site Title, Logo, & Tagline', 'gojoseon' );
    $wp_customize->get_section( 'nav' )->title = __( 'Menus', 'gojoseon' );
    
    $wp_customize->add_setting( 'gojoseon_logo' );
    $wp_customize->add_control(
            new WP_Customize_Image_Control(
                    $wp_customize,
                    'gojoseon_logo',
                    array(
                        'label'         => __( 'Upload Logo (replaces title)', 'gojoseon' ),
                        'section'       => 'title_tagline',
                        'settings'      => 'gojoseon_logo',
                        'priority'      => 20,
                    )
            )
    );
    
    $wp_customize->add_setting( 'logo_image_background_color' );
    $wp_customize->add_control( 
            'logo_image_background_color',
            array (
                'label'     => __( 'Hide logo background color?', 'gojoseon' ),
                'section'   => 'title_tagline',
                'type'      => 'checkbox',
                'priority'  => 15
            )
    );
    
    //Adjust the order of Site Title & Tagline controls
    $wp_customize->get_control( 'blogname' )->priority = 10;
    $wp_customize->get_control( 'blogdescription' )->priority = 30;
    $wp_customize->get_control( 'display_header_text' )->priority = 40;
    $wp_customize->get_control( 'display_header_text' )->label = __( 'Display tagline?', 'gojoseon');
    
    
    /**
     * Fonts
     *
     * @link: https://github.com/BFTrick/wp-google-font-picker-control seems easy
     * @link: http://www.dezzain.com/wordpress-tutorials/how-to-add-google-web-fonts-with-font-preview-in-wordpress-without-plugins/
     * @link: http://www.paulund.co.uk/custom-wordpress-controls very comprehensive but uses classes
     * 
     * @link: http://wptheming.com/2012/06/loading-google-fonts-from-theme-options/ Font array
     */
    
    $typography = array();
    
    $typography = array_merge( gojoseon_get_system_fonts(), gojoseon_get_google_fonts(), gojoseon_get_korean_fonts() );
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
    
    $wp_customize->add_setting( 'show_korean_fonts' );
    $wp_customize->add_control( 
            'show_korean_fonts', 
            array(
                'label'     => __( 'Show Korean font options?', 'gojoseon' ),
                'section'   => 'fonts',
                'type'      => 'checkbox',
                'priority'  => 1
            ));
    
    
    /**
     * Colors
     * 
     * @link: http://www.smashingmagazine.com/2013/03/05/the-wordpress-theme-customizer-a-developers-guide/
     * @link: http://buildwpyourself.com/customizing-client-options-using-the-theme-customizer/
     */
    $wp_customize->get_control( 'background_color' )->priority = 60;
    
    $colors = array();
    $colors[] = array(
        'slug'      => 'content_text_color',
        'default'   => '#333',
        'label'     => __( 'Content Text Color', 'gojoseon' )
    );
    $colors[] = array(
        'slug'      => 'primary_design_color',
        'default'   => '#cd7f32', 
        'label'     => __( 'Primary Design Color', 'gojoseon' )
    );
    $colors[] = array(
        'slug'      => 'primary_design_color_hover',
        'default'   => '#814001', 
        'label'     => __( 'Primary Design Color: Hover', 'gojoseon' )
    );
    $colors[] = array(
        'slug'      => 'secondary_design_color',
        'default'   => '#1ED3A4', 
        'label'     => __( 'Secondary Design Color', 'gojoseon' )
    );
    $colors[] = array(
        'slug'      => 'secondary_design_color_hover',
        'default'   => '#169A70', 
        'label'     => __( 'Secondary Design Color: Hover', 'gojoseon' )
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
     * Layout
     * 
     * @link: http://www.wpexplorer.com/interacting-with-wordpress-theme-customizer/
     * @link: http://wptricks.co.uk/create-a-better-options-page-with-the-theme-customizer/#three
     * 
     * PROBLEM: In following tutorials above, there's a problem with the 'body_class' filter
     */
    
    // Sidebar Position
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
    
    // Quickmenu Position
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
    
    // Show Excerpts?
    $wp_customize->add_setting( 'show_excerpts', array(
        'default'   => false,
    ));
    $wp_customize->add_control( 'show_excerpts', array(
        'label'     => __( 'Show post excerpts?', 'gojoseon' ),
        'section'   => 'layout',
        'type'      => 'checkbox'
    ));
    
    $wp_customize->add_section( 'layout', array(
        'title'     => __( 'Layout & Content Options', 'gojoseon' ),
        'priority'  => 50,
    ));
    
    // Show Breadcrumbs?
    $wp_customize->add_setting( 'show_breadcrumbs', array(
        'default'   => true,
    ));
    $wp_customize->add_control( 'show_breadcrumbs', array(
        'label'     => __( 'Show breadcrumbs?', 'gojoseon' ),
        'section'   => 'layout',
        'type'      => 'checkbox'
    ));
    
    
    
    /**
     * Header Image: Is this a Pattern (tileable) or Image (should stretch)?
     */
    $wp_customize->add_setting( 'header_image_type' );
    $wp_customize->add_control( 'header_image_type', array(
        'label'     => __( 'Is your image a (tileable) pattern?', 'gojoseon' ),
        'section'   => 'header_image',
        'priority'  => 5,
        'type'      => 'checkbox',
    ));
    
    
    /**
     * Select Categories for the Home Page
     * 
     * @link: http://josephfitzsimmons.com/adding-a-select-box-with-categories-into-wordpress-theme-customizer/
     * @link: http://code.tutsplus.com/articles/custom-controls-in-the-theme-customizer--wp-34556
     * 
     * TODO: Create a homepage and ADD these to it
     * @link: http://code.tutsplus.com/tutorials/how-to-create-a-homepage-with-multiple-listings-using-custom-queries--wp-32073
     */
    
    // Change "Static Front Page" to "Front Page Options"
    $wp_customize->get_section( 'static_front_page' )->title = __( 'Front Page Options', 'gojoseon' );
    
    // Front Page Category 1
    $wp_customize->add_setting( 'front_category_1', array(
        'default'   => '',
        'type'      => 'option',
        'capability'    => 'manage_options',
    ));
    $wp_customize->add_control( 
            new WP_Customize_Dropdown_Categories_Control(
                    $wp_customize,
                    'front_category_1',
                    array(
                        'label'     => __( 'Front Category 1', 'gojoseon' ),
                        'section'   => 'static_front_page',
                        'type'      => 'dropdown-categories',
                        'settings'  => 'front_category_1',
                        'priority'  => 30,
                    )
            )
    ); 
    
    // Front Page Category 2
    $wp_customize->add_setting( 'front_category_2', array(
        'default'   => '',
        'type'      => 'option',
        'capability'    => 'manage_options',
    ));
    $wp_customize->add_control( 
            new WP_Customize_Dropdown_Categories_Control(
                    $wp_customize,
                    'front_category_2',
                    array(
                        'label'     => __( 'Front Category 2', 'gojoseon' ),
                        'section'   => 'static_front_page',
                        'type'      => 'dropdown-categories',
                        'settings'  => 'front_category_2',
                        'priority'  => 40,
                    )
            )
    ); 
    
    // Front Page Category 3
    $wp_customize->add_setting( 'front_category_3', array(
        'default'   => '',
        'type'      => 'option',
        'capability'    => 'manage_options',
    ));
    $wp_customize->add_control( 
            new WP_Customize_Dropdown_Categories_Control(
                    $wp_customize,
                    'front_category_3',
                    array(
                        'label'     => __( 'Front Category 3', 'gojoseon' ),
                        'section'   => 'static_front_page',
                        'type'      => 'dropdown-categories',
                        'settings'  => 'front_category_3',
                        'priority'  => 50,
                    )
            )
    ); 
    
    
    /**
     * Social site icons for Quick Menu bar
     * 
     * @link: https://www.competethemes.com/social-icons-wordpress-menu-theme-customizer/
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
            'label'             => ucwords( __( "$social_site URL:", 'social_icon' ) ),
            'section'           => 'social_settings',
            'type'              => 'text',
            'priority'          => $priority,
        ));
        
        $priority += 5;
    }
    
    /**
     * Custom Copyright Message in the Footer
     * 
     * @link: http://code.tutsplus.com/tutorials/a-guide-to-the-wordpress-theme-customizer-a-methodology-for-sections-settings-and-controls-part-2--wp-33252
     */
    $wp_customize->add_setting(
            'gojoseon_copyright_message', 
            array(
                'default'           => 'All Rights Reserved',
                'sanitize_callback' => 'gojoseon_sanitize_copyright',
            )
    );
    $wp_customize->add_control(
            'gojoseon_copyright_message',
            array(
                'section'       => 'footer_options',
                'label'         => __( 'Copyright Message', 'gojoseon' ),
                'type'          => 'text'
            )
    );
    $wp_customize->add_section(
            'footer_options',
            array(
                'title'         => __( 'Footer Options', 'gojoseon' ),
                'priority'      => 160
            )
    );
    
    /**
     * Backend Stuff
     */
    $wp_customize->add_setting(
            'gojoseon_google_analytics', 
            array(
                'sanitize_callback' => 'gojoseon_sanitize_analytics',
            )
    );
    $wp_customize->add_control(
            'gojoseon_google_analytics',
            array(
                'section'       => 'backend',
                'label'         => __( 'Google Analytics Code', 'gojoseon' ),
                'type'          => 'textarea'
            )
    );
    $wp_customize->add_section(
            'backend',
            array(
                'title'         => __( 'Backend Options', 'gojoseon' ),
                'priority'      => 200
            )
    );
}
add_action( 'customize_register', 'gojoseon_theme_customizer' );

/* -----------------------------------------------------------------------------
 * Helper functions
 * ----------------------------------------------------------------------------- */

/**
 * Google Fonts helper functions
 * 
 * @link: http://www.slidedeck.com/blog/tutorial-how-to-integrate-custom-google-fonts-into-slidedeck-2-for-wordpress/
 * @link: http://wptheming.com/2012/06/loading-google-fonts-from-theme-options/
 */

function gojoseon_get_system_fonts() {
    
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
    return $system_fonts;
}

function gojoseon_get_google_fonts() {
    
    $google_fonts = array(
        'Arvo, serif'                           => 'Arvo',
        'Copse, sans-serif'                     => 'Copse',
        '"Droid Sans", sans-serif'              => 'Droid Sans',
        '"Droid Serif", serif'                  => 'Droid Serif',
        'Lato, sans-serif'                      => 'Lato',
        'Lobster, cursive'                      => 'Lobster',
        'Merriweather, serif'                   => 'Merriweather',
        'Nobile, sans-serif'                    => 'Nobile',
        '"Noto Sans", sans-serif'               => 'Noto Sans',
        '"Noto Serif", serif'                   => 'Noto Serif',
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
    return $google_fonts;
}

function gojoseon_get_korean_fonts() {
    
    $korean_fonts = array(
        'Hanna, sans-serif'                     => 'Hanna [KO]',
        '"Jeju Gothic", sans-serif'             => 'Jeju Gothic [KO]',
        '"Jeju Hallasan", cursive'              => 'Jeju Hallasan [KO]',
        '"Jeju Myeongjo", serif'                => 'Jeju Myeongjo [KO]',
        '"KoPub Batang", serif'                 => 'KoPub Batang [KO]',
        '"Nanum Brush Script", cursive'         => 'Nanum Brush Script [KO]',
        '"Nanum Gothic", sans-serif'            => 'Nanum Gothic [KO]',
        '"Nanum Gothic Coding", monospace'      => 'Nanum Gothic Coding [KO]',
        '"Nanum Myeongjo", serif'               => 'Nanum Myeongjo [KO]',
        '"Nanum Pen Script", cursive'           => 'Nanum Pen Script [KO]',
    );
    return $korean_fonts;
}

/* 
 * Check font options to see if a Google font is selected.
 * If so, gojoseon_enqueue_google_fonts() is called to enqueue the font.
 * Ensures that each Google font is only enqueued once.
 */

if ( !function_exists( 'gojoseon_google_fonts' ) ) {
    function gojoseon_google_fonts() {
        
        $all_google_fonts = array_keys( gojoseon_get_google_fonts() );
        $ea_google_fonts = array_keys( gojoseon_get_korean_fonts() );
        
        // Get the font face for each option and put it in an array 
        $selected_fonts[] = get_theme_mod( 'content_font' );
        $selected_fonts[] = get_theme_mod( 'header_font' );
        
        // Check each of the unique fonts against the defined Google fonts
        // If it is a Google font, go ahead and call the function to enqueue it
        foreach ( $selected_fonts as $selected_font ) {
            if ( in_array( $selected_font, $all_google_fonts ) ) {
                gojoseon_enqueue_google_fonts( $selected_font );
            } else if ( in_array( $selected_font, $ea_google_fonts ) ) {
                gojoseon_enqueue_early_access_fonts( $selected_font );
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
    if ( $font == 'Raleway' ) {
        $font = 'Raleway:100';
    } 
    $font = str_replace( " ", "+", $font );

    wp_enqueue_style( "gojoseon_typography_$font", "http://fonts.googleapis.com/css?family=$font", false, null, 'all' );
}

// Enqueues the Early Access Google $font that is passed
function gojoseon_enqueue_early_access_fonts( $font ) {
    $font = explode( ',', $font );
    $font = $font[0];
    
    $font = str_replace( "[KO]", "", $font );
    $font = strtolower( str_replace( " ", "", $font ) );
        
    wp_enqueue_style( "gojoseon_typography_$font", "http://fonts.googleapis.com/earlyaccess/$font.css", false, null, 'all' );
}


/**
 * Social Media icon helper functions
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
        
        foreach ( $active_sites as $active_site ) { ?>

            <li>
                <a href="<?php echo get_theme_mod( $active_site ); ?>">
                    <?php if( $active_site == 'vimeo' ) { ?>
                        <i class="fa fa-<?php echo $active_site; ?>-square"></i> <?php
                    } else if( $active_site == 'email' ) { ?>
                        <i class="fa fa-envelope"></i> <?php
                    } else { ?>
                        <i class="fa fa-<?php echo $active_site; ?>"></i> <?php
                    } ?>
                </a>
            </li> <?php
        }
        echo "</ul>";
    }
}


/**
 * Categories Drop-Down List Control
 * 
 * @link: http://code.tutsplus.com/articles/custom-controls-in-the-theme-customizer--wp-34556
 */
if( class_exists( 'WP_Customize_Control' ) ) {
class WP_Customize_Dropdown_Categories_Control extends WP_Customize_Control {
    public $type = 'dropdown-categories';
    
    public function render_content() {
        $dropdown = wp_dropdown_categories(
                array(
                    'name'          => '_customize-dropdown-categories-' . $this->id,
                    'echo'          => 0,
                    'hide_empty'    => false,
                    'show_option_none'  => '&mdash; ' . __( 'Select', 'gojoseon' ) . ' &mdash;',
                    'hide_if_empty'     => false,
                    'selected'          => $this->value(),
                )
        );
        
        $dropdown = str_replace( '<select', '<select ' . $this->get_link(), $dropdown );
        
        printf(
                '<label class="customize-control-select"><span class="customize-control-title">%s</span> %s</label>',
                $this->label,
                $dropdown
        );
    }
}
}


/**
 * Sanitize Copyright Message Helper function
 * 
 * @link: http://code.tutsplus.com/tutorials/a-guide-to-the-wordpress-theme-customizer-a-methodology-for-sections-settings-and-controls-part-2--wp-33252
 */
function gojoseon_sanitize_copyright( $input ) {
    return strip_tags( stripslashes( $input ) );
}