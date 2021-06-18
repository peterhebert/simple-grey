<?php
/**
 * Post meta footer.
 *
 * @package Simple Grey
 * @since 1.7.4
 */

?>
	<footer class="entry-meta">
	<?php simple_grey_posted_on(); ?>
	<?php simple_grey_post_taxonomy(); ?>
	<?php simple_grey_post_updated(); ?>

<?php
	// comments link.
if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
	echo '<span class="comments-link">';
	comments_popup_link( __( 'Leave a comment', 'simple-grey' ), __( '1 Comment', 'simple-grey' ), __( '% Comments', 'simple-grey' ) );
	echo '</span>';
}

	edit_post_link( __( 'Edit', 'simple-grey' ), '<span class="edit-link">', '</span>' );
?>
	</footer>
