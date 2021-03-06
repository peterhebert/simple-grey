<?php
/**
 * Template for content aside.
 *
 * @package Simple Grey
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php if ( has_post_thumbnail() ) : ?>
	<div class="post-thumbnail">
		<a href="<?php the_post_thumbnail_url( 'full' ); ?>"><?php the_post_thumbnail( 'large' ); ?></a>
	</div><!-- .post-thumbnail -->
<?php endif; ?>

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'simple-grey' ),
					'after'  => '</div>',
				)
			);
			?>
	<?php get_template_part( 'partials/meta' ); ?>
	</div><!-- .entry-content -->

	<?php get_template_part( 'partials/footer', 'entry-meta' ); ?>

</article><!-- #post-## -->
