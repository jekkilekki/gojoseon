<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Gojoseon
 */
?>
            
        <footer id="colophon" class="site-footer" role="contentinfo">
            
            <?php get_sidebar( 'footer' ); ?>
            
            <div id="footer-area">
                
                <!-- Footer Menu -->
                <nav id="site-navigation" class="main-navigation large-8 columns" role="navigation">
                    <button class="menu-toggle" aria-controls="menu" aria-expanded="true"><?php _e( 'Footer Menu', 'gojoseon' ); ?></button>
                    <?php wp_nav_menu( array( 'theme_location' => 'footer' ) ); ?>
                </nav><!-- #site-navigation -->
                
                <div id="copyright" class="large-4 columns">
                    &copy; <?php echo date( 'Y' ); ?> <?php bloginfo( 'title' ); ?> <span id="copyright-message"><?php echo get_theme_mod( 'gojoseon_copyright_message', 'All Rights Reserved' ); ?></span>
                </div><!-- #copyright -->
                
                <div class="site-info large-12 columns">
                
                    <!-- Site Info -->
                    <?php printf( __( 'Theme %1$s by %2$s.', 'gojoseon' ), 'Gojoseon', '<a href="http://www.jekkilekki.com" rel="designer">Aaron Snowberger</a>' ); ?>
                    <span class="sep"> | </span>
                    <a href="<?php echo esc_url( __( 'http://wordpress.org/', 'gojoseon' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'gojoseon' ), 'WordPress' ); ?></a>
                    
                </div><!-- .site-info -->
                
            </div><!-- #footer-area -->
            
        </footer><!-- #colophon -->
        
        </div><!-- #large-10 from header.php -->
                
    </div><!-- #row from header.php -->
    
    </div><!-- End Foundation's inner-wrap (must go after ALL content) -->

    </div><!-- .qm-padded-page -->
    <a class="exit-off-canvas"></a>
</div><!-- End Foundation's off-canvas portion -->
</div><!-- #page -->

</div><!-- End Foundation's inner-wrap (must go after ALL content) -->

<a class="exit-off-canvas"></a>
</div><!-- End Foundation's off-canvas portion -->

<?php wp_footer(); // calls the scripts in the footer ?>

</body>
</html>
