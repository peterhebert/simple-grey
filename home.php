<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Simple Grey
 */

get_header(); ?>

	<main id="main" aria-label="<?php echo esc_attr__( 'Content', 'simple-grey' ); ?>">
		<?php if ( get_option( 'show_on_front' ) === 'page' ) : ?>
		<h1 class="page-title"><?php single_post_title(); ?></h1>
		<?php else : ?>
			<div class="page-title"><?php echo esc_html__( 'Latest Posts', 'simple-grey' ); ?></div>
		<?php endif; ?>

		<?php if ( have_posts() ) : ?>
			<?php /* Start the Loop */ ?>
			<?php
			while ( have_posts() ) :
				the_post();

				/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'partials/content', get_post_format() );
				?>
		<?php endwhile; ?>
			<?php the_posts_pagination(); ?>
		<?php else : ?>
			<?php get_template_part( 'partials/content', 'none' ); ?>
		<?php endif; ?>
	</main>
	<?php get_sidebar(); ?>

<?php get_footer(); ?>
