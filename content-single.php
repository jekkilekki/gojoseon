<?php
/**
 * @package Gojoseon
 */
?>

<?php edit_post_link( __( 'Edit', 'gojoseon' ), '<span class="edit-link">', '</span>' ); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">
			<?php gojoseon_posted_on(); ?>
                        <?php gojoseon_social_sharing_buttons(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
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
