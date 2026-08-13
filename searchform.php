<?php
/**
 * Search form template.
 *
 * @package Simple Grey
 */

?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="search-label">
		<?php echo esc_html__( 'Search for', 'simple-grey' ); ?>
		<span class="required"><?php echo esc_html__( '(required)', 'simple-grey' ); ?></span>
	</label>
	<div class="search-input-wrap">
		<input type="search" class="form-control" placeholder="<?php echo esc_attr__('Enter keyword(s)', 'simple-grey'); ?>" value="" name="s" required>
		<input type="submit" class="search-submit" value="Search">
	</div>
</form>