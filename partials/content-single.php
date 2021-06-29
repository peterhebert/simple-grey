<?php
/**
 * Content template for single post no format.
 *
 * @package Simple Grey
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->
<?php if ( has_post_thumbnail() && ! has_post_format( 'gallery' ) ) { ?>
<div class="post-thumbnail">
<a href="<?php the_post_thumbnail_url( 'full' ); ?>"><?php the_post_thumbnail( 'large' ); ?></a>
</div><!-- .post-thumbnail -->
	<?php } ?>
	<div class="entry-content">
		<?php the_content(); ?>
		<?php get_template_part( 'partials/meta' ); ?>
		<?php
		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'simple-grey' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->

	<?php get_template_part( 'partials/footer', 'entry-meta' ); ?>
	
</article><!-- #post-## -->
