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
<div class="large-3 medium-4 columns sidebar" data-equalizer-watch>
<div id="secondary" class="widget-area <?php get_theme_mod( 'sidebar_position'); ?>" role="complementary">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</div><!-- #secondary -->
</div>
