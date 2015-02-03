<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Gojoseon
 */

$sidebar_display = get_theme_mod( 'sidebar_position' );
get_header(); ?>

            <main id="main" class="site-main" role="main">

            <?php if ( have_posts() ) : ?>
                
                <?php $stickies = get_option( 'sticky_posts' ); ?>
                <?php gojoseon_featured_posts( $stickies ); ?>
                
                <?php
                /*if ( $sidebar_display != 'none' ) {
                    echo '<ul id="grid" class="large-block-grid-2 medium-block-grid-1"><!-- Foundation\'s block grid -->';
                } else {
                    echo '<ul id="grid-big" class="large-block-grid-3 medium-block-grid-2"><!-- Foundation\'s block grid -->';
                }*/ ?>

                <ul id="index">
                    <?php /* Start the Loop */ ?>
                    <?php query_posts( array( 'post__not_in' => $stickies ) ); // @link: http://www.smashingmagazine.com/2009/06/10/10-useful-wordpress-loop-hacks/ ?>
                    <?php while ( have_posts() ) : the_post(); ?>

                            <li><!-- Wrap posts in <li> to make Foundation's block grid work -->
                            <?php
                                    /* Include the Post-Format-specific template for the content.
                                     * If you want to override this in a child theme, then include a file
                                     * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                                     */
                                    get_template_part( 'content', get_post_format() );
                            ?>
                            </li>

                    <?php endwhile; ?>

                    </ul><!-- #large-block-grid-2 -->

                    <?php gojoseon_paging_nav(); ?>

            <?php else : ?>

                    <?php get_template_part( 'content', 'none' ); ?>

            <?php endif; ?>

            </main><!-- #main -->
    </div><!-- #primary -->
       
    <!-- Widget Sidebar -->
    <?php if ( $sidebar_display != 'none' ) { get_sidebar(); } ?> 
  
    <?php get_footer(); ?>
    
    </div><!-- #content -->
</div><!-- #row -->