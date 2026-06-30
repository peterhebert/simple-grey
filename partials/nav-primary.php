<?php
/**
 * Primary navigation.
 *
 * @package Simple Grey
 * @since 1.9.0
 */

if ( has_nav_menu( 'primary' ) ) : ?>
<div id="navigation" class="main-navigation">
	<div class="wrap">
		<?php simple_grey_main_menu(); ?>
	</div>
</div>
	<?php
endif;
