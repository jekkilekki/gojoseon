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
    
    $wp_customize->add_setting( 'gojoseon_logo', array( 'sanitize_callback' => 'esc_url_raw' ) );
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
    
    // Add back in in @VERSION2
//    $wp_customize->add_setting( 'logo_image_background_color', array( 'sanitize_callback' => 'sanitize_hex_color' ) );
//    $wp_customize->add_control( 
//            'logo_image_background_color',
//            array (
//                'label'     => __( 'Hide logo background color?', 'gojoseon' ),
//                'section'   => 'title_tagline',
//                'type'      => 'checkbox',
//                'priority'  => 15
//            )
//    );
    
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
                    'capability'    => 'edit_theme_options',
                    'sanitize_callback' => 'gojoseon_sanitize_font_select'
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

//      Add this back in @VERSION2
//    $wp_customize->add_setting( 'show_korean_fonts' );
//    $wp_customize->add_control( 
//            'show_korean_fonts', 
//            array(
//                'label'     => __( 'Show Korean font options?', 'gojoseon' ),
//                'section'   => 'fonts',
//                'type'      => 'checkbox',
//                'priority'  => 1
//            ));
    
    
    /**
     * Colors
     * 
     * @link: http://www.smashingmagazine.com/2013/03/05/the-wordpress-theme-customizer-a-developers-guide/
     * @link: http://buildwpyourself.com/customizing-client-options-using-the-theme-customizer/
     */
    $wp_customize->get_control( 'background_color' )->priority = 60;
    $wp_customize->get_setting( 'background_color' )->default = '#169A70';
    $wp_customize->get_control( 'header_textcolor' )->label = __( 'Titles Text Color', 'gojoseon' );
    
    $colors = array();
    $colors[] = array(
        'slug'      => 'content_text_color',
        'default'   => '#333333',
        'label'     => __( 'Content Text Color', 'gojoseon' )
    );
    $colors[] = array(
        'slug'      => 'primary_design_color',
        'default'   => '#cd7f32', 
        'label'     => __( 'Primary Design Color (Links)', 'gojoseon' )
    );
    $colors[] = array(
        'slug'      => 'primary_design_color_hover',
        'default'   => '#814001', 
        'label'     => __( 'Primary Design Color: Hover', 'gojoseon' )
    );
    $colors[] = array(
        'slug'      => 'secondary_design_color',
        'default'   => '#1ED3A4', 
        'label'     => __( 'Secondary Design Color (Sidebars)', 'gojoseon' )
    );
    $colors[] = array(
        'slug'      => 'secondary_design_color_hover',
        'default'   => '#169A70', 
        'label'     => __( 'Secondary Design Color: Hover', 'gojoseon' )
    );
//    $colors[] = array(
//        'slug'      => 'background_color',
//        'default'   => '#169A70',
//        'label'     => __( 'Background Color', 'gojoseon' )
//    );
    
    foreach( $colors as $color ) {
        
        // SETTINGS
        $wp_customize->add_setting(
                $color[ 'slug' ], array(
                    'default'       => $color[ 'default' ],
                    'type'          => 'option',
                    'capability'    => 'edit_theme_options',
                    'sanitize_callback' => 'sanitize_hex_color'
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
     */
    
    // Sidebar Position
    $wp_customize->add_setting( 'sidebar_position', array(
        'default'   => 'right',
        'type'      => 'theme_mod',
        'sanitize_callback' => 'gojoseon_sanitize_sidebar_position'
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
    
//    // Quickmenu Position
//    // Add this back in @VERSION2
//    $wp_customize->add_setting( 'quickmenu_position', array(
//        'default'   => 'left',
//        'type'      => 'theme_mod',
//    ));
//    $wp_customize->add_control( 'quickmenu_position', array(
//        'label'     => __( 'Quickmenu Position', 'gojoseon' ),
//        'section'   => 'layout',
//        'settings'  => 'quickmenu_position',
//        'type'      => 'radio',
//        'choices'   => array(
//            'left'      => 'Left',
//            'right'     => 'Right',
//            'none'      => 'None',
//        ),
//    ));
    
    // Show Excerpts?
    $wp_customize->add_setting( 'show_excerpts', array(
        'default'   => false,
        'sanitize_callback' => 'gojoseon_sanitize_checkbox'
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
        'sanitize_callback' => 'gojoseon_sanitize_checkbox'
    ));
    $wp_customize->add_control( 'show_breadcrumbs', array(
        'label'     => __( 'Show breadcrumbs?', 'gojoseon' ),
        'section'   => 'layout',
        'type'      => 'checkbox'
    ));
    
    
    
    /**
     * Header Image: Is this a Pattern (tileable) or Image (should stretch)?
     */
    $wp_customize->add_setting( 'header_image_type', array( 'sanitize_callback' => 'gojoseon_sanitize_checkbox' ) );
    $wp_customize->add_control( 'header_image_type', array(
        'label'     => __( 'Is your image a (tileable) pattern?', 'gojoseon' ),
        'section'   => 'header_image',
        'priority'  => 5,
        'type'      => 'checkbox',
    ));
    
    $wp_customize->add_setting( 'header_lines', array( 'sanitize_callback' => 'gojoseon_sanitize_checkbox' ) );
    $wp_customize->add_control( 'header_lines', array( 
        'label'     => __( 'Show the lines under the header?', 'gojoseon' ),
        'section'   => 'header_image',
        'priority'  => 6,
        'type'      => 'checkbox',
    ));
    
//    /**
//     * Select Categories for the Home Page
//     * 
//     * Add this back in @VERSION2
//     * 
//     * @link: http://josephfitzsimmons.com/adding-a-select-box-with-categories-into-wordpress-theme-customizer/
//     * @link: http://code.tutsplus.com/articles/custom-controls-in-the-theme-customizer--wp-34556
//     * 
//     * TODO: Create a homepage and ADD these to it
//     * @link: http://code.tutsplus.com/tutorials/how-to-create-a-homepage-with-multiple-listings-using-custom-queries--wp-32073
//     */
//    
//    // Change "Static Front Page" to "Front Page Options"
//    $wp_customize->get_section( 'static_front_page' )->title = __( 'Front Page Options', 'gojoseon' );
//    
//    // Front Page Category 1
//    $wp_customize->add_setting( 'front_category_1', array(
//        'default'   => '',
//        'type'      => 'option',
//        'capability'    => 'manage_options',
//    ));
//    $wp_customize->add_control( 
//            new WP_Customize_Dropdown_Categories_Control(
//                    $wp_customize,
//                    'front_category_1',
//                    array(
//                        'label'     => __( 'Front Category 1', 'gojoseon' ),
//                        'section'   => 'static_front_page',
//                        'type'      => 'dropdown-categories',
//                        'settings'  => 'front_category_1',
//                        'priority'  => 30,
//                    )
//            )
//    ); 
//    
//    // Front Page Category 2
//    $wp_customize->add_setting( 'front_category_2', array(
//        'default'   => '',
//        'type'      => 'option',
//        'capability'    => 'manage_options',
//    ));
//    $wp_customize->add_control( 
//            new WP_Customize_Dropdown_Categories_Control(
//                    $wp_customize,
//                    'front_category_2',
//                    array(
//                        'label'     => __( 'Front Category 2', 'gojoseon' ),
//                        'section'   => 'static_front_page',
//                        'type'      => 'dropdown-categories',
//                        'settings'  => 'front_category_2',
//                        'priority'  => 40,
//                    )
//            )
//    ); 
//    
//    // Front Page Category 3
//    $wp_customize->add_setting( 'front_category_3', array(
//        'default'   => '',
//        'type'      => 'option',
//        'capability'    => 'manage_options',
//    ));
//    $wp_customize->add_control( 
//            new WP_Customize_Dropdown_Categories_Control(
//                    $wp_customize,
//                    'front_category_3',
//                    array(
//                        'label'     => __( 'Front Category 3', 'gojoseon' ),
//                        'section'   => 'static_front_page',
//                        'type'      => 'dropdown-categories',
//                        'settings'  => 'front_category_3',
//                        'priority'  => 50,
//                    )
//            )
//    ); 
    
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
    
//    /**
//     * Backend Stuff
//     * 
//     * Option for @VERSION2 or remove?
//     */
//    $wp_customize->add_setting(
//            'gojoseon_google_analytics', 
//            array(
//                'sanitize_callback' => 'gojoseon_sanitize_analytics',
//            )
//    );
//    $wp_customize->add_control(
//            'gojoseon_google_analytics',
//            array(
//                'section'       => 'backend',
//                'label'         => __( 'Google Analytics Code', 'gojoseon' ),
//                'type'          => 'textarea'
//            )
//    );
//    $wp_customize->add_section(
//            'backend',
//            array(
//                'title'         => __( 'Backend Options', 'gojoseon' ),
//                'priority'      => 200
//            )
//    );
}
add_action( 'customize_register', 'gojoseon_theme_customizer' );

function gojoseon_customize_css() {
/**
 * Customizer options
 */
    // In order as they appear in the Customizer   
    /* Site Title, Logo, & Tagline */

    
    /* Fonts */
    $content_font = get_theme_mod( 'content_font', 'Roboto' );
    $header_font = get_theme_mod( 'header_font', '"Roboto Slab"' );
    
    /* Colors */
    $header_textcolor = get_theme_mod( 'header_textcolor', '#000' );
    $content_text_color = get_option( 'content_text_color', '#333' );
    $primary_color_links = get_option( 'primary_design_color', '#cd7f32' );
    $primary_color_hover = get_option( 'primary_design_color_hover', '#814001' );
    $secondary_color_sidebar = get_option( 'secondary_design_color', '#1ed3a4' );
    $secondary_color_hover = get_option( 'secondary_design_color_hover', '#169A70' );
    $background_color = get_theme_mod( 'background_color', '#169A70' );
    
    
    /* Layout & Content Options */
    
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
    
    
    /* Header Image */
    if ( get_theme_mod( 'header_lines' ) == 1 ) {
        $header_border_width = '5px';
    } else {
        $header_border_width = '0px';
    }
    
    /* Background Image */
    /* Menus */
    /* Widgets */
    /* Static Front Page */
    /* Footer Options */
      
?>
<style>
    body { background: <?php echo $background_color; ?>; color: <?php echo $content_text_color; ?>; font-family: <?php echo $content_font; ?>; }
    .edit-link a, .comments-link a, .posted-on a, .byline a, .comment-metadata a, .reply a, .continue-reading a { color: <?php echo $content_text_color; ?>; }
    
    h1, h1 a, h2, h2 a, h3, h3 a, h4, h4 a, h5, h5 a, h6, h6 a, .entry-title, .entry-title a { font-family: <?php echo $header_font; ?>; color: #<?php echo $header_textcolor; ?> }
    a { color: <?php echo $primary_color_links; ?>; }
    a:hover { color: <?php echo $primary_color_hover; ?>; }
    
    .primary-nav, #secondary, #main { border-color: <?php echo $secondary_color_sidebar; ?>; }
    .thick { border-color: <?php echo $primary_color_links; ?>; }
    #primary { float: <?php echo $content_position; ?>; }
    #secondary { display: <?php echo $sidebar_display; ?>; }
    #quickmenu, .topbutton { <?php echo $quickmenu_position; ?>: 0; }
    #search-container { <?php echo $quickmenu_position; ?>: 4rem; }
    .padded-row { padding-left: <?php echo $row_padding; ?>; padding-right: <?php echo $row_padding_right; ?>; } // Give extra padding for the Quickmenu
    #primary-menu { margin-left: <?php echo $primarymenu_margin; ?>; }
    #top-navigation ul li a { color: <?php echo $header_textcolor; ?>; }
    #side-nav, #main, #secondary { border-top-width: <?php echo $header_border_width; ?>; }
    
    .site-branding { background-color: <?php echo $secondary_color_hover; ?>; }
    <?php if ( get_theme_mod ( 'logo_image_background_color' ) === 1 ) : ?> 
        .site-branding { background-color: transparent; }
    <?php endif; ?>
    <?php if ( get_header_image() ) : ?>
        #masthead { background-color: transparent; margin-top: -160px; }
    <?php endif; ?>
        
    .comments-title, #reply-title { border-color: <?php echo $primary_color_links; ?>; }
    .widget-title { border-color: <?php echo $secondary_color_sidebar; ?>; }
    .search-toggle:hover, .topbutton:hover { background: <?php echo $secondary_color_sidebar; ?>; }
    .search-box { background: <?php echo $secondary_color_sidebar; ?>; }
    

</style>
<?php
}
add_action( 'wp_head', 'gojoseon_customize_css' );

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
 * Categories Drop-Down List Control
 * 
 * Implement in @VERSION2
 * 
 * @link: http://code.tutsplus.com/articles/custom-controls-in-the-theme-customizer--wp-34556
 */
//if( class_exists( 'WP_Customize_Control' ) ) {
//class WP_Customize_Dropdown_Categories_Control extends WP_Customize_Control {
//    public $type = 'dropdown-categories';
//    
//    public function render_content() {
//        $dropdown = wp_dropdown_categories(
//                array(
//                    'name'          => '_customize-dropdown-categories-' . $this->id,
//                    'echo'          => 0,
//                    'hide_empty'    => false,
//                    'show_option_none'  => '&mdash; ' . __( 'Select', 'gojoseon' ) . ' &mdash;',
//                    'hide_if_empty'     => false,
//                    'selected'          => $this->value(),
//                )
//        );
//        
//        $dropdown = str_replace( '<select', '<select ' . $this->get_link(), $dropdown );
//        
//        printf(
//                '<label class="customize-control-select"><span class="customize-control-title">%s</span> %s</label>',
//                $this->label,
//                $dropdown
//        );
//    }
//}
//}

/* -----------------------------------------------------------------------------
 * Sanitize functions
 * ----------------------------------------------------------------------------- */

/**
 * Sanitize Font select callback
 */
function gojoseon_sanitize_font_select( $input ) {
    $valid = array_merge( gojoseon_get_system_fonts(), gojoseon_get_google_fonts(), gojoseon_get_korean_fonts() );

    if ( in_array( $input, $valid ) ) {
        return $input;
    } else {
        return null;
    }
    
}

/**
 * Sanitize Sidebar Position 
 */
function gojoseon_sanitize_sidebar_position( $input ) {
    $valid = array(
        'left'  => 'Left',
        'right' => 'Right',
        'none'  => 'None',
    );
    
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}

/**
 * Sanitize Checkbox callback
 */
function gojoseon_sanitize_checkbox( $input ) {
    if ( $input == 1 ) {
        return 1;
    } else {
        return '';
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