/**
 * Custom Superfish settings
 * This JS menu enhancer helps touch devices and keyboards better access dropdowns
 * 
 * @link: http://users.tpg.com.au/j_birch/plugins/superfish/
 */

jQuery(document).ready(function($) {
    // Primary menu hover dropdowns
//    var sf = $('ul.sub-menu');
//    sf.superfish({
//        delay: 200,
//        speed: 'fast',
//    });
    
    // Quick menu click to open the menu
    var sc = $('ul.quick');
    sc.superclick({
        delay: 200,
        speed: 'fast',
        activeClass: 'active',
    });
    
    var sc2 = $('ul.sub-menu');
    sc2.superclick({
        delay: 200,
        speed: 'fast',
        activeClass: 'active',
    });
    
    // Trying to get this to display TWO left-off-canvas-menus
    // Multi-level @link: http://foundation.zurb.com/docs/components/offcanvas.html#off-canvas-multilevel-menu
    // First try JS @link: http://foundation.zurb.com/forum/posts/2216-multiple-off-canvas-menu
    // Codepen works @link: http://codepen.io/sandwich/pen/mpCrq
    /*$( ".left-off-canvas-toggle" ).click(function() {
        $( ".left-off-canvas-menu ul.off-canvas-list" ).css( "display", "none" );
        $( "." + $(this).data("listname") ).css( "display", "block" );
    });*/
    
    // When an off-canvas toggle is clicked...
    $(".left-off-canvas-toggle[rel]").click(function() {
       // ... first hide all off-canvas menus except for the targeted one
       $(".left-off-canvas-menu:not(#" + this.rel + ")").removeClass('off-canvas-visible');
       
       // ... and then show that off-canvas-menu, or toggle it
       $("#" + this.rel).addClass('off-canvas-visible').toggleClass('mega-menu-visible');
    });
    
    // Make the responsive main menu button work
    // @TODO: Make main menu visible ALWAYS on large screens and hidden by DEFAULT on small screens
    /*var button = $('#primary-nav-button');
    var mainmenu = $('#primary-nav-ul');
    
    if ((button).is(':visible')) { // If button is visible or document width is small...
        mainmenu.css({ "display": "none" });
    } else {
        mainmenu.css({ "display": "block" });
    }
    
    button.click(
                function() {
                    if (( mainmenu.is(':visible') )) {
                        mainmenu.css({ "display": "none" });
                    } else {
                        mainmenu.css({ "display": "block" });
                    }
                });*/
    
});

/**
 * Excellent resource on styling dropdown menus (Didn't try)
 * @link: http://tympanus.net/codrops/2012/10/04/custom-drop-down-list-styling/
 * 
 * Super-long Dropdown Menus (CSS-Tricks) (Didn't work immediately - will require fixing if I want it)
 * @link: http://css-tricks.com/long-dropdowns-solution/
 */
var maxHeight = 400;

$(function() {
   
    $(".dropdown > li").click(function() {
        
        var $container = $(this),
            $list = $container.find("ul"),
            $anchor = $container.find("a"),
            height = $list.height() * 1.1,      // make sure there is enough room at the bottom
            multiplier = height / maxHeight;    // needs to move faster if list is taller
            
        // need to save height here so it can revert on mouseout
        $container.data( "origHeight", $container.height() );
        
        // so it can retain its rollover color all the while the dropdown is open
        $anchor.addClass( "hover" );
        
        // make sure dropdown appears directly below parent list item
        $list
                .show()
                .css( {
                    paddingTop: $container.data( "origHeight" )
                });
                
        // don't do any animation if list shorter than max
        if ( multiplier > 1 ) {
            $container
                .css( {
                    height: maxHeight,
                    overflow: "hidden"
                })
                .mousemove( function(e) {
                   var offset = $container.offset();
                   var relativeY = ( ( e.pageY - offset.top ) * multiplier ) - ( $container.data( "origHeight" ) * multiplier );
                   if (relativeY > $container.data( "origHeight" ) ) {
                        $list.css( "top", -realtiveY + $container.data( "origHeight" ) );
                   };
                });
        }
    }, function() {
        
        var $el = $(this);
        
        // put things back to normal
        $el
                .height( $(this).data( "origHeight" ) )
                .find("ul")
                .css( { top: 0 } )
                .hide()
                .end()
                .find("a")
                .removeClass( "hover" );
    });
    
    // Add down arrow only to menu items with submenus
    $( ".dropdown > li:has('ul')" ).each(function() {
        $(this).find("a:first").append( "<img src='images/down-arrow.png' />" );
    });
    
});