<?php
/**
 * The template for displaying all single posts.
 *
 * @package Gojoseon
 */

get_header(); ?>

<div class="row" data-equalizer><!-- Foundation grid row -->
    
    <!-- Primary Menu -->
    <div class="large-1 columns" data-equalizer-watch>
        
        <nav id="site-navigation" class="main-navigation" role="navigation">
            <button class="menu-toggle" aria-controls="menu" aria-expanded="true"><?php _e( 'Primary Menu', 'gojoseon' ); ?></button>
            <?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
        </nav><!-- #site-navigation -->
        
    </div><!-- #large-2 -->

    <!-- Main Content -->
    <div class="large-8 medium-7 columns" data-equalizer-watch>
        
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'single' ); ?>

			<?php gojoseon_post_nav(); ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			?>

		<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->
        
    </div><!-- #large-9 medium-8 -->
    
    <!-- Widget Sidebar -->
    <div class="large-3 medium-4 columns" data-equalizer-watch>

        <?php get_sidebar(); ?>
        
    </div><!-- #large-3 medium-4 -->
    
</div><!-- #row -->
        
<?php get_footer(); ?>
