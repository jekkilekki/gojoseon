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

<div id="secondary" class="widget-area large-3 medium-4 columns sidebar <?php get_theme_mod( 'sidebar_position'); ?>" role="complementary" data-equalizer-watch>
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</div><!-- #secondary -->
