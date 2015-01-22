<?php ?>

<!-- Quick Menu -->

<div id="search-container" class="search-box-wrapper clear">
    <div class="search-box clear">
        <?php get_search_form(); // Place this outside the "quickmenu" div so it will stay on top ?>
    </div>
</div>

<?php gojoseon_quick_menu(); // Place this outside the "quickmenu" div so it will stay on top ?>

<div id="quickmenu">
    <div class="search-toggle">
        <i class="fa fa-search"></i>
        <a href="#search-container" class="screen-reader-text"><?php _e( 'Search', 'gojoseon' ); ?></a>
    </div>
    
    <div id="social-icons">
        <?php gojoseon_social_menu(); ?>
    </div>
    
    <div class="topbutton">
        <a href="#" class="topbutton"><i class="fa fa-angle-up"></i><br />Top</a>
    </div>
    
</div>

