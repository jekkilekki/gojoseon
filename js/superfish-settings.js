/**
 * Custom Superfish settings
 * This JS menu enhancer helps touch devices and keyboards better access dropdowns
 * 
 * @link: http://users.tpg.com.au/j_birch/plugins/superfish/
 */

jQuery(document).ready(function($) {
    // Primary menu hover dropdowns
    var sf = $('ul.sub-menu');
    sf.superfish({
        delay: 200,
        speed: 'fast',
    });
    
    // Quick menu click to open the menu
    var sc = $('ul.quick');
    sc.superclick({
        delay: 200,
        speed: 'fast',
        activeClass: 'active',
    });
    
    // Make the responsive main menu button work
    // @TODO: Make main menu visible ALWAYS on large screens and hidden by DEFAULT on small screens
    var button = $('#primary-nav-button');
    var mainmenu = $('#primary-nav-ul');
    
    if ((button).is(':visible')) {
        mainmenu.css({ "display": "none" });
        
        button.click(
                function() {
                    if (( mainmenu.is(':visible') )) {
                        mainmenu.css({ "display": "none" });
                    } else {
                        mainmenu.css({ "display": "block" });
                    }
                });
    } else {
        mainmenu.css({ "display": "block" });
    }
    
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