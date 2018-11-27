<?php
/**
 * The template for the sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage BootBam
 */
?>
<?php if ( is_active_sidebar( 'mainbar' )  ) : ?>
	<div id="secondary" class="mainbar" role="complementary">
		<?php dynamic_sidebar( 'mainbar' ); ?>
	</div>
<?php endif; ?>
