<?php
/**
 * Template Name: Page with no sidebar
 *
 * @package Gojoseon
 */

get_header(); ?>

		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

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
  
    <?php get_footer(); ?>

    </div><!-- #content -->
</div><!-- #row -->
