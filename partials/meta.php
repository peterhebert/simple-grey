<?php
/**
 * Custom fields display.
 *
 * @package Simple Grey
 * @since 1.7.0
 */

$show_meta = get_theme_mod( 'simple_grey_show_meta' );
if ( $show_meta ) :

	$post_meta = get_post_meta( get_the_ID() );

	if ( is_array( $post_meta ) ) : ?>
<ul class="post-meta">
		<?php
		foreach ( $post_meta as $key => $value ) :

			preg_match( '/^[^_]/', $key, $match_array );

			if ( is_array( $match_array ) && 0 < count( $match_array ) ) :
				?>
<li><strong><?php echo esc_html( $key ); ?></strong>: <?php echo esc_html( $value[0] ); ?></li>
	<?php endif; ?>
<?php endforeach; ?> 
</ul><!-- .post-meta -->
<?php endif; ?>
<?php endif; ?>
