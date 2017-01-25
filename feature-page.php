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
        <?php endwhile; ?>
        <?php the_post_navigation(); ?>
        <?php else : ?>
        <?php get_template_part( 'content', 'none' ); ?>
        <?php endif; ?>
      </main>
      <?php get_sidebar('featured'); ?>
      <?php get_sidebar(); ?>

<?php get_footer(); ?>
