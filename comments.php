<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package Gojoseon
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php // Separate comments and pings: @link: http://sivel.net/2008/10/wp-27-comment-separation/ ?>

	<?php if ( ! empty( $comments_by_type[ 'comment' ] ) ) : ?>
		<h2 class="comments-title">
			<?php
				printf( _nx( 'One comment', '%1$s comments', get_comments_number(), 'comments title', 'gojoseon' ),
					number_format_i18n( get_comments_number() ) );
			?>
		</h2>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style'      => 'ol',
					'short_ping' => true,
                                        'avatar_size'=> 84,
                                        'type'       => 'comment'
				) );
			?>
		</ol><!-- .comment-list -->
                
        <?php endif; ?>

        <?php if ( ! empty( $comments_by_type[ 'pings' ] ) ) : ?>
                <h2 class="comments-title">Track/Pingbacks</h2>
                
                <ol>
                    <?php wp_list_comments( 'type=pings&callback=list_pings'); ?>
                </ol>
        <?php endif; ?>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'gojoseon' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '<i class="fa fa-arrow-left"></i> Older Comments', 'gojoseon' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments <i class="fa fa-arrow-right"></i>', 'gojoseon' ) ); ?></div>
		</nav><!-- #comment-nav-below -->
		<?php endif; // check for comment navigation ?>

	<?php //endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'gojoseon' ); ?></p>
	<?php endif; ?>

	<?php comment_form(); ?>

</div><!-- #comments -->
