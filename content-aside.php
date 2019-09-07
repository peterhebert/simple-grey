<?php
/**
 * @package Simple Grey
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php if ( has_post_thumbnail() ) { ?>
      <div class="post-thumbnail">
  			<a href="<?php the_post_thumbnail_url( 'full' ); ?>"><?php the_post_thumbnail('large'); ?></a>
      </div><!-- .post-thumbnail -->
<?php } ?>

    <div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'simple-grey' ),
				'after'  => '</div>',
			) );
		?>
      <?php get_template_part( 'partials/meta' ); ?>
	</div><!-- .entry-content -->

	<footer class="entry-meta">
        <?php simple_grey_posted_on(); ?>
		<?php edit_post_link( __( 'Edit', 'simple-grey' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-## -->
