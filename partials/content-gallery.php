<?php
/**
 * Template for gallery post format.
 *
 * @package Simple Grey
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
	</header><!-- .entry-header -->

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
