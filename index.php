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

get_header(); ?>

<div class="row" data-equalizer>
    
    <!-- Primary Menu -->
    <div class="large-2 columns" data-equalizer-watch>
        
        <nav id="site-navigation" class="main-navigation" role="navigation">
            <button class="menu-toggle" aria-controls="menu" aria-expanded="true"><?php _e( 'Primary Menu', 'gojoseon' ); ?></button>
            <?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
        </nav><!-- #site-navigation -->
        
    </div><!-- #large-2 -->
    
    <!-- Main Content Area -->
    <div class="large-8 medium-7 columns" data-equalizer-watch>
    
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

                    <ul class="large-block-grid-2"><!-- Foundation's block grid -->
                        
			<?php /* Start the Loop */ ?>
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
        
    </div><!-- #large-9 medium-8 -->
    
    <!-- Widget Sidebar -->
    <div class="large-2 medium-3 columns sidebar" data-equalizer-watch>

        <?php get_sidebar(); ?>

    </div>
    
    </div><!-- #row -->
<?php get_footer(); ?>
