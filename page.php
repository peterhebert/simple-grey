<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Simple Grey
 */

get_header(); ?>

	<main id="main" role="main" aria-label="<?php echo esc_attr__( 'Main Content', 'simple-grey' ); ?>">
		<?php if ( have_posts() ) : ?>
			<?php /* Start the Loop */ ?>
			<?php
			while ( have_posts() ) :
				the_post();
				?>
				<?php get_template_part( 'partials/content', 'page' ); ?>
				<?php get_template_part( 'partials/meta' ); ?>
		<?php endwhile; ?>
		<?php else : ?>
			<?php get_template_part( 'partials/content', 'none' ); ?>
		<?php endif; ?>
	</main>
	<?php get_sidebar(); ?>

<?php get_footer(); ?>
