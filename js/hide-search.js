/* 
 * Toggles header search on and off
 */
jQuery(document).ready(function($) {
    $("#search-container").hide();
    $(".search-toggle").click(function() {     
        $("#search-container").animate({ width: 'toggle' }, 500 ); 
        $(".search-toggle").toggleClass('active');
    }); 
});

