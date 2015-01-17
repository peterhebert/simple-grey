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
        <?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'content', get_post_format() );
				?>
        <?php endwhile; ?>
        <?php simple_grey_paging_nav(); ?>
        <?php else : ?>
        <?php get_template_part( 'content', 'none' ); ?>
        <?php endif; ?>
      </main>
      <?php get_sidebar('featured'); ?>
      <?php get_sidebar(); ?>

<?php get_footer(); ?>
