<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package Gojoseon
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<div id="secondary" class="widget-area large-2 medium-3 columns sidebar" role="complementary" data-equalizer-watch>
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</div><!-- #secondary -->
