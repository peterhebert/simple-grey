<?php
/**
 * @package Simple Grey
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
	</header><!-- .entry-header -->
	<?php if ( has_post_thumbnail() ) : ?>
    <div class="post-thumbnail">
      <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail('medium'); ?></a>
    </div><!-- .post-thumbnail -->
	<?php endif; ?>

	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">
		<?php
			/* translators: %s: Name of current post */
			the_content( sprintf(
				__( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'simple-grey' ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );
		?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'simple-grey' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	<?php endif; ?>

	<?php if ( 'post' == get_post_type() ) : ?>
	<footer class="entry-meta">
    <?php simple_grey_posted_on(); ?>
		<?php edit_post_link( __( 'Edit', 'simple-grey' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
    <?php endif; ?>
</article><!-- #post-## -->
