<?php ?>

<!-- Quick Menu -->

<div id="search-container" class="search-box-wrapper clear">
    <div class="search-box clear">
        <?php get_search_form(); ?>
    </div>
</div>

<div id="quickmenu">
    <div class="search-toggle">
        <i class="fa fa-search"></i>
        <a href="#search-container" class="screen-reader-text"><?php _e( 'Search', 'gojoseon' ); ?></a>
    </div>
    
    <nav>
        
    </nav>
    
    <div id="social-icons">
        <?php gojoseon_social_menu(); ?>
    </div>
    
    <a href="#" class="topbutton"><i class="fa fa-angle-up"></i><br />Top</a>
    
</div>

