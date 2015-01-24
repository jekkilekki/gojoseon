<?php

/* 
 * Header Widgets
 */

if ( ! is_active_sidebar( 'sidebar-header' ) ) {
    return;
}
?>

<div id="supplementary">
    <div id="header-widgets" class="header-widgets widget-area clear" role="complementary">
        <?php dynamic_sidebar( 'sidebar-header' ); ?>
    </div><!-- #header-sidebar -->
</div><!-- #supplementary -->