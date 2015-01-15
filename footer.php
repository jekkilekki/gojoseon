<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Gojoseon
 */
?>

	</div><!-- #content -->
            
        <footer id="colophon" class="site-footer" role="contentinfo">
            
            <div class="row"><!-- Foundation row -->
                
                <!-- Footer Menu -->
                <nav id="site-navigation" class="main-navigation large-8 columns" role="navigation">
                    <button class="menu-toggle" aria-controls="menu" aria-expanded="true"><?php _e( 'Footer Menu', 'gojoseon' ); ?></button>
                    <?php wp_nav_menu( array( 'theme_location' => 'footer' ) ); ?>
                </nav><!-- #site-navigation -->
                
                <div id="copyright" class="large-4 columns">
                    &copy; <?php echo date( 'Y' ); ?> <?php bloginfo( 'title' ); ?> <span id="copyright-message"><?php echo get_theme_mod( 'gojoseon_copyright_message', 'All Rights Reserved' ); ?></span>
                </div><!-- #footer -->
                
            </div>
            <div class="row site-info">
                
                <!-- Site Info -->
                <a href="<?php echo esc_url( __( 'http://wordpress.org/', 'gojoseon' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'gojoseon' ), 'WordPress' ); ?></a>
                <span class="sep"> | </span>
                <?php printf( __( 'Theme: %1$s by %2$s.', 'gojoseon' ), 'Gojoseon', '<a href="http://www.jekkilekki.com" rel="designer">Aaron Snowberger</a>' ); ?>

            </div><!-- .row -->
        </footer><!-- #colophon -->
     
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
