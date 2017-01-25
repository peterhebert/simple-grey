<?php
/**
 * The template for displaying all single posts.
 *
 * @package Simple Grey
 */

get_header(); ?>

    <main id="main" role="main">
		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'single' ); ?>

      <!-- posts navigation -->
      <?php
      $previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
      $next     = get_adjacent_post( false, '', false );

      	if ( ! $next && ! $previous ) {
      		return;
      	}
      	?>
      	<nav class="navigation post-navigation" role="navigation">
      		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'simple-grey' ); ?></h1>
      		<div class="nav-links">
      			<?php
      				previous_post_link( '<div class="nav-previous">%link</div>', _x( '<span class="meta-nav">&larr;</span>%title', 'Previous post link', 'simple-grey' ) );
      				next_post_link(     '<div class="nav-next">%link</div>',     _x( '%title<span class="meta-nav">&rarr;</span>', 'Next post link',     'simple-grey' ) );
      			?>
      		</div><!-- .nav-links -->
      	</nav><!-- .navigation -->

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			?>

		<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
      <?php get_sidebar(); ?>

<?php get_footer(); ?>
