<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package Simple Grey
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

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php

				printf(
					// phpcs:ignore
					_nx( '%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'simple-grey' ) ,
					esc_html( number_format_i18n( get_comments_number() ) ),
					'<span>' . esc_html( get_the_title() ) . '</span>'
				);
			?>
		</h2>

		<?php
		// are there comments to navigate through?
		if ( 1 < get_comment_pages_count() && get_option( 'page_comments' ) ) :
			?>
		<nav id="comment-nav-above" class="comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php echo esc_html__( 'Comment navigation', 'simple-grey' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'simple-grey' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'simple-grey' ) ); ?></div>
		</nav><!-- #comment-nav-above -->
		<?php endif; // check for comment navigation. ?>
		<ol class="comment-list">
			<?php
				wp_list_comments(
					array(
						'style'      => 'ol',
						'short_ping' => true,
					)
				);
			?>
		</ol><!-- .comment-list -->
		<?php
		// are there comments to navigate through.
		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
			?>
		<nav id="comment-nav-below" class="comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php echo esc_html__( 'Comment navigation', 'simple-grey' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'simple-grey' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'simple-grey' ) ); ?></div>
		</nav><!-- #comment-nav-below -->
		<?php endif; // check for comment navigation. ?>

	<?php endif; // have_comments. ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && '0' !== get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
		?>
		<p class="no-comments"><?php echo esc_html__( 'Comments are closed.', 'simple-grey' ); ?></p>
	<?php endif; ?>

	<?php comment_form(); ?>

</div><!-- #comments -->
