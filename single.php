<?php
/**
 * The template for displaying all single posts.
 *
 * @package Gojoseon
 */

$sidebar_display = get_theme_mod( 'sidebar_position' );
get_header(); ?>


		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'single' ); ?>

			<?php gojoseon_post_nav(); ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || get_comments_number() ) :
					comments_template( '', true );
				endif;
			?>

		<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->
    
    <!-- Widget Sidebar -->
    <?php if ( $sidebar_display != 'none' ) { get_sidebar(); } ?> 
  
        </div><!-- #content -->
</div><!-- .padded-row -->

<div class="row">
    <?php get_footer(); ?>
</div><!-- .row -->

