<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Simple Grey
 */

$basic_allowed = simple_grey_basic_allowed_html();
$footer_bottom = get_theme_mod( 'simple_grey_footer_text_bottom' );
$show_credits  = get_theme_mod( 'simple_grey_show_footer_credits' );

?>
</div>
</div>
</div>

<footer id="footer" class="site-footer" role="contentinfo">
<?php if ( get_theme_mod( 'simple_grey_footer_text_top' ) ) : ?>
		<div class="footer-text"><?php echo esc_html( get_theme_mod( 'simple_grey_footer_text_top' ) ); ?></div>
		<?php endif; ?>

		<?php if ( is_active_sidebar( 'sidebar-footer' ) ) : ?>
			<div class="widget-area">
			<?php if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar( 'sidebar-footer' ) ) : ?>
			<?php endif; ?>
			</div>
		<?php endif; ?>

		<?php if ( $footer_bottom ) : ?>
		<div class="footer-text"><?php echo wp_kses( $footer_bottom, $basic_allowed ); ?></div>
		<?php endif; ?>


<?php if ( $show_credits ) : ?>
	<div class="footer-credits">
		<p><?php esc_html_e( 'Theme: ', 'simple-grey' ); ?> <a href="<?php echo esc_url( 'https://wordpress.org/themes/simple-grey/' ); ?>">
		<?php esc_html_e( 'Simple Grey', 'simple-grey' ); ?></a> <br>

		<a href="<?php echo esc_url( 'https://github.com/peterhebert/simple-grey' ); ?>"><?php esc_html_e( 'Theme development on GitHub', 'simple-grey' ); ?></a>
		
	</p>


	<p><i class="mv mv-wordpress icon-large"></i> <a href="<?php echo esc_url( 'http://wordpress.org/' ); ?>" rel="generator"><?php esc_html_e( 'Proudly powered by WordPress', 'simple-grey' ); ?></a>
	</p>

</div>
<?php endif; ?>



</footer>
<!-- #footer -->

<?php wp_footer(); ?>
</body>
</html>
