<?php
/*
 * Template Name: Single Column Narrow
 * Description: Displays the main page content in one column, with a
 * maximum width of 60em for optimum legibility. The secondary
 * sidebar is displayed below the main content in this template.
 *
 * @package Simple Grey
 */

get_header(); ?>

    <main id="main" role="main">
    <?php if ( have_posts() ) : ?>
        <?php
        /* Start the Loop */
        while ( have_posts() ) : the_post();
          get_template_part( 'content', 'page' );

    			// If comments are open or we have at least one comment, load up the comment template
    			if ( comments_open() || get_comments_number() ) :
    				comments_template();
    			endif;

			  endwhile;
      else :
        get_template_part( 'content', 'none' );
      endif;
      ?>
    </main>
    <?php get_sidebar(); ?>

<?php get_footer(); ?>
