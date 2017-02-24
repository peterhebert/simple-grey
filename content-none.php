<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Simple Grey
 */
?>

<section class="no-results not-found">
	<header class="no-results-header">
		<h3 class="no-results-title"><?php _e( 'Nothing Found', 'simple-grey' ); ?></h3>
	</header><!-- .page-header -->

	<div class="page-content">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'simple-grey' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

		<?php elseif ( is_tag() || is_category() || is_tax() ) : ?>
			<?php
			  $qobj = get_queried_object();
				$tax_obj = get_taxonomy( $qobj->taxonomy );
			?>
			<p><?php printf( __( 'Sorry, but no content was found matching the %1$s <em>%2$s</em>. Perhaps searching can help.', 'simple-grey' ), strtolower( $tax_obj->labels->singular_name ), single_tag_title( '', false ) ); ?></p>

			<?php get_search_form(); ?>

		<?php elseif ( is_search() ) : ?>

			<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'simple-grey' ); ?></p>
			<?php get_search_form(); ?>

		<?php else : ?>

			<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'simple-grey' ); ?></p>
			<?php get_search_form(); ?>

		<?php endif; ?>
	</div><!-- .page-content -->
</section><!-- .no-results -->
