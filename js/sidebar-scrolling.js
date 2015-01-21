/* 
 * Enable sidebar scrolling like the TwentyFifteen theme
 * 
 * @link: https://core.trac.wordpress.org/browser/trunk/src/wp-content/themes/twentyfifteen/js/functions.js?rev=30388
 */

( function( $ ) {
    var $body, $window, $document, $sidebar, adminbarOffset, top = false, 
            bottom = false, windowWidth, windowHeight, lastWindowPos = 0, 
            topOffset = 0, documentHeight, sidebarWidth, sidebarHeight, resizeTimer;
    
    // Sidebar scrolling
    function resize() {
        windowWidth = $window.width();
        windowHeight = $window.height();
        documentHeight = $document.height();
        sidebarHeight = $sidebar.height();
        
        if ( 955 >= windowWidth ) {
            top = bottom = false;
            $sidebar.removeAttr( 'style' );
        }
    }
    
    function scroll() {
        var windowPos = $window.scrollTop();
        
        if ( 955 <= windowWidth && sidebarHeight + adminbarOffset < documentHeight ) {
            if ( sidebarHeight + adminbarOffset > windowHeight ) {
                if ( windowPos > lastWindowPos ) {
                    if ( top ) {
                        top = false;
                        topOffset = ( $sidebar.offset().top > 0 ) ? $sidebar.offset().top - adminbarOffset : 0;
                        $sidebar.attr( 'style', 'top: ' + topOffset + 'px;' );
                    } else if ( ! bottom && windowPos + windowHeight > sidebarHeight + $sidebar.offset().top ) {
                        bottom = true;
                        $sidebar.attr( 'style', 'position: fixed; bottom: 0; padding-right: 11px;' ); // Hackily fix the width of the sidebar. More details @link: https://wordpress.org/support/topic/scrolling-fixed-menu-like-twentyfifteen?replies=3
                    }
                } else if ( windowPos < lastWindowPos ) {
                    if ( bottom ) {
                        bottom = false;
                        topOffset = ( $sidebar.offset().top > 0 ) ? $sidebar.offset().top - adminbarOffset : 0;
                        $sidebar.attr( 'style', 'top: ' + topOffset + 'px;' );
                    } else if ( ! top && windowPos + adminbarOffset < $sidebar.offset().top ) {
                        top = true;
                        $sidebar.attr( 'style', 'position: fixed; padding-right: 11px;' );
                    }
                } else {
                    top = bottom = false;
                    topOffset = ( $sidebar.offset.top > 0 ) ? $sidebar.offset().top - adminbarOffset : 0;
                    $sidebar.attr( 'style', 'top: ' + topOffset + 'px;' );
                }
            } else if ( ! top ) {
                top = true;
                $sidebar.attr( 'style', 'position: fixed; padding-right: 11px;' );
            }
        }
        
        lastWindowPos = windowPos;
    }
    
    function resizeAndScroll() {
        resize();
        scroll();
    }
    
    // jQuery document ready function here
    $( document ).ready( function() {
        $body       = $( 'body' );
        $window     = $( window );
        $document   = $( document );
        $sidebar    = $( '#primary-menu' ).first();
        adminbarOffset  = $body.is( 'admin-bar' ) ? $( '#wpadminbar' ).height() : 0;
        
        $window
                .on( 'scroll.gojoseon', scroll )
                .on( 'resize.gojoseon', function() {
                    clearTimeout( resizeTimer );
                    resizeTimer = setTimeout( resizeAndScroll, 500 );
        } );
        $sidebar.on( 'click keydown', 'button', resizeAndScroll );
        
        resizeAndScroll();
        
        for ( var i = 1; i < 6; i++ ) {
            setTimeout( resizeAndScroll, 100 * i );
        }
    } ); 
})( jQuery );