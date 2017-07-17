<?php
/**
 * The template for displaying all single posts.
 *
 * @package Simple Grey
 */

get_header(); ?>

    <main id="main" role="main">
		<?php
    while ( have_posts() ) : the_post(); ?>

			<?php
      get_template_part( 'content', 'single' );

      // If comments are open or we have at least one comment, load up the comment template.
      if ( comments_open() || get_comments_number() ) :
        comments_template();
      endif;

      get_template_part( 'post', 'navigation' );

    endwhile; // end of the loop. ?>

		</main><!-- #main -->
      <?php get_sidebar(); ?>

<?php get_footer(); ?>
