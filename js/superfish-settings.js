/**
 * Custom Superfish settings
 * This JS menu enhancer helps touch devices and keyboards better access dropdowns
 * 
 * @link: http://users.tpg.com.au/j_birch/plugins/superfish/
 */

jQuery(document).ready(function($) {
    var sf = $('ul.sub-menu');
    sf.superfish({
        delay: 200,
        speed: 'fast'
    });
});

