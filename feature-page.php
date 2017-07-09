<?php
/*
 * Template Name: Feature Page
 * Description: A Page Template with a featured sidebar, which can be used for
 * a front page or a splash page
 *
 * @package Simple Grey
 */

get_header(); ?>

    <main id="main" role="main">
      <?php if ( have_posts() ) : ?>
        <?php /* Start the Loop */ ?>
        <?php while ( have_posts() ) : the_post(); ?>
        	<?php get_template_part( 'content', 'page' ); ?>
          <?php
          // If comments are open or we have at least one comment, load up the comment template
          if ( comments_open() || get_comments_number() ) :
            comments_template();
          endif;
          ?>
        <?php endwhile; ?>
        <?php else : ?>
        <?php get_template_part( 'content', 'none' ); ?>
        <?php endif; ?>
      </main>
      <?php get_sidebar('featured'); ?>
      <?php get_sidebar(); ?>

<?php get_footer(); ?>
