<?php
/**
 * The Sidebar containing the featured widget areas.
 *
 * @package peterhebert
 */

if ( ! is_active_sidebar( 'sidebar-featured' ) ) {
	return;
}
?>
<section id="featured" class="widget-area" role="complementary">
    <div class="sidebar-row"><?php dynamic_sidebar( 'sidebar-featured' ); ?></div>
</section><!-- #featured -->
