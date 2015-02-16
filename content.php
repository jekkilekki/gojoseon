<?php
/**
 * @package Gojoseon
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    
    <?php if( has_post_thumbnail() || get_the_first_image( 'index-thumb' ) != '' ) {
    
        echo '<div class="index-box">';    
        
            echo '<div class="small-index-thumbnail clear">';
            echo '<a href="' . get_permalink() . '" title="' . __( 'Click to read ', 'gojoseon' ) . get_the_title() . '" rel="bookmark">';
            if ( has_post_thumbnail() ) {
                echo the_post_thumbnail( 'index-thumb' );
            } else {
                echo '<img class="first-image" src="' . get_the_first_image( 'index-thumb' ) . '" />';
            }
            echo '</a>';
            echo '</div>'; 
            
    } else {
        
        echo '<div class="index-box no-thumb">';
    
    }
    ?>
    
	<header class="entry-header">
		<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php gojoseon_posted_on(); ?>
                        <?php edit_post_link( __( 'Edit', 'gojoseon' ), '<span class="edit-link top-edit-link">', '</span>' ); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			
                    if ( get_theme_mod( 'show_excerpts' ) ) : 
                        /* translators: %s: Name of current post */
			the_fancy_excerpt( sprintf(
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

	<footer class="entry-footer continue-reading">
		<?php echo '<a href="' . get_permalink() . '" title="' . __( 'Continue Reading ', 'gojoseon' ) . get_the_title() . '" rel="bookmark">Continue Reading<i class="fa fa-arrow-right"></i></a>'; ?>
	</footer><!-- .entry-footer -->
    </div><!-- .index-box -->
</article><!-- #post-## -->