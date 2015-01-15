<?php
/**
 * The template for displaying all single posts.
 *
 * @package Gojoseon
 */

get_header(); ?>

    <div id="content" class="large-10 columns" data-equalizer-watch>
        
        <!-- Main Content Area -->    
        <div id="primary" class="content-area large-9 medium-8 columns" data-equalizer-watch>
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
    
    <!-- Widget Sidebar -->
    <?php get_sidebar(); ?>
        
    </div><!-- #large-10 -->
</div><!-- #row -->
        
<?php get_footer(); ?>
