<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package Gojoseon
 */

$sidebar_display = get_theme_mod( 'sidebar_position' );
get_header(); ?>

		<main id="main" class="site-main" role="main">

			<?php get_template_part( 'content', 'none' ); ?>

		</main><!-- #main -->
	</div><!-- #primary -->

    <!-- Widget Sidebar -->
    <?php if ( $sidebar_display != 'none' ) { get_sidebar(); } ?> 
  
    <?php get_footer(); ?>
    
    </div><!-- #content -->
</div><!-- #row -->
