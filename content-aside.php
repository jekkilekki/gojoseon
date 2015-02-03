<?php
/**
 * @package Gojoseon
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    
    <div class="index-box no-thumb aside">
        
	<header class="entry-header">
		<?php echo '<span class="author-image">' . get_avatar( get_the_author_meta( 'ID' ), 64 ) . '</span>'; ?>
		
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			
                        /* translators: %s: Name of current post */
			the_content( sprintf(
				__( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'gojoseon' ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );
		?>

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'gojoseon' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php gojoseon_posted_on(); ?>
                        <?php edit_post_link( __( 'Edit', 'gojoseon' ), '<span class="edit-link top-edit-link">', '</span>' ); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
        </footer><!-- .entry-footer -->
    </div><!-- .index-box -->
</article><!-- #post-## -->