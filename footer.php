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
            
        </footer><!-- #colophon -->
            
            <div id="footer-area">
                
                <!-- Footer Menu -->
                <nav id="footer-navigation" class="footer-navigation large-8 small-12 columns" role="navigation">
                    <?php wp_nav_menu( array( 'theme_location' => 'footer' ) ); ?>
                </nav><!-- #site-navigation -->
                
                <div id="copyright" class="large-4 small-12 columns">
                    &copy; <?php echo date( 'Y' ); ?> <?php bloginfo( 'title' ); ?> <span id="copyright-message"><?php echo get_theme_mod( 'gojoseon_copyright_message', 'All Rights Reserved' ); ?></span>
                </div><!-- #copyright -->
                
                <div class="clear"></div>
                
            </div><!-- #footer-area -->
            

        
        </div><!-- #large-10 from header.php -->
                
    </div><!-- #row from header.php -->
    
    <!--</div> End Foundation's inner-wrap (must go after ALL content) -->

    </div><!-- .qm-padded-page -->
<!--    <a class="exit-off-canvas"></a>
</div> End Foundation's off-canvas portion -->
</div><!-- #page -->
            
                <div class="site-info">
                
                    <!-- Site Info -->
                    <?php printf( __( '%1$s Theme by %2$s', 'gojoseon' ), 'Gojoseon', '<a href="http://www.jekkilekki.com" rel="designer">Aaron Snowberger</a>' ); ?>
                    <span class="sep"> | </span>
                    <?php printf( __( 'Proudly powered by %s', 'gojoseon' ), '<a href="http://wordpress.org">WordPress</a>' ); ?>
                    
                </div><!-- .site-info -->

                <a class="exit-off-canvas"></a>
</div><!-- End Foundation's inner-wrap (must go after ALL content) -->


</div><!-- End Foundation's off-canvas portion -->

<?php wp_footer(); // calls the scripts in the footer ?>

</body>
</html>
