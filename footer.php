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
                <div class="large-8 columns">
                    <nav id="site-navigation" class="main-navigation" role="navigation">
                        <button class="menu-toggle" aria-controls="menu" aria-expanded="true"><?php _e( 'Footer Menu', 'gojoseon' ); ?></button>
                        <?php wp_nav_menu( array( 'theme_location' => 'footer' ) ); ?>
                    </nav><!-- #site-navigation -->
                </div>
                
                <!-- Site Info -->
                <div class="large-4 columns">
                    <div class="site-info">
                            <a href="<?php echo esc_url( __( 'http://wordpress.org/', 'gojoseon' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'gojoseon' ), 'WordPress' ); ?></a>
                            <span class="sep"> | </span>
                            <?php printf( __( 'Theme: %1$s by %2$s.', 'gojoseon' ), 'Gojoseon', '<a href="http://www.jekkilekki.com" rel="designer">Aaron Snowberger</a>' ); ?>
                    </div><!-- .site-info -->
                </div><!-- .large-4 -->
                
            </div><!-- .row -->
        </footer><!-- #colophon -->
     
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
