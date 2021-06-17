<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Simple Grey
 */

$basic_allowed  = simple_grey_basic_allowed_html();
$footer_bottom  = get_theme_mod( 'simple_grey_footer_text_bottom' );
$footer_credits = get_theme_mod( 'simple_grey_show_footer_credits' );

?>
</div>
</div>
</div>
<footer id="footer" class="site-footer" role="contentinfo">
<div class="wrap">
<div class="row">
<?php if ( get_theme_mod( 'simple_grey_footer_text_top' ) ) : ?>
<div class="footer-text"><?php echo esc_html( get_theme_mod( 'simple_grey_footer_text_top' ) ); ?></div>
<?php endif; ?>
<?php if ( is_active_sidebar( 'sidebar-footer' ) ) : ?>
<div class="widget-area">
	<?php if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar( 'sidebar-footer' ) ) : ?>
<?php endif; ?>
</div>
<!-- .widget-area -->
<?php endif; ?>

<?php if ( $footer_bottom || 1 === $footer_credits ) : ?>
	<div class="footer-text">
			<?php if ( $footer_bottom ) : ?>
		<p><?php echo wp_kses( $footer_bottom, $basic_allowed ); ?></p>
<?php endif; ?>
			<?php if ( 1 === $footer_credits ) : ?>
				<?php
				do_action( 'simple_grey_credits' );
				?>
	<p><i class="mv mv-wordpress icon-large"></i> <a href="http://wordpress.org/" rel="generator"><?php esc_html_e( 'Proudly powered by WordPress' ); ?></a>.
				<?php esc_html_e( 'Theme', 'simple-grey' ); ?>: <a href="https://github.com/peterhebert/simple-grey"><?php esc_html_e( 'Simple Grey', 'simple-grey' ); ?></a>.

</p>
<?php endif; ?>
</div>
<?php endif; ?>
</div>
</div>
</footer>
<!-- #footer -->

<?php wp_footer(); ?>
</body>
</html>
