<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package Simple Grey
 */

if ( ! is_active_sidebar( 'sidebar-secondary' ) ) {
	return;
}
?>

<section id="secondary" class="widget-area" role="complementary" aria-label="<?php echo esc_attr__( 'Secondary', 'simple-grey' ); ?>">
	<div class="sidebar-row"><?php dynamic_sidebar( 'sidebar-secondary' ); ?></div>
</section><!-- #secondary -->
