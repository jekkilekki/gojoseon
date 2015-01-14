<?php
/**
 * @package Gojoseon
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php gojoseon_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			
                    if ( get_theme_mod( 'show_excerpts' ) ) : 
                        /* translators: %s: Name of current post */
			the_excerpt( sprintf(
				__( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'gojoseon' ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );
                    else: 
                        /* translators: %s: Name of current post */
			the_content( sprintf(
				__( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'gojoseon' ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );
                    endif;
		?>

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'gojoseon' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php gojoseon_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->