
//
// Rijkshuisstijl (Digitale Overheid) - genesis-skiplinks.js
// ----------------------------------------------------------------------------------
// script for skiplinks
// ----------------------------------------------------------------------------------
// * @author  Rian Rietveld
// * @license GPL-2.0+
// * @package wp-rijkshuisstijl
// * @version 0.8.23 (wp-theme) / 1.2.0 (genesis accessible)
// * @desc.   Added javascript for skiplinks
// * @link    http://genesis-accessible.org/



function ga_skiplinks() {
    'use strict';
    var element = document.getElementById( location.hash.substring( 1 ) );

    if ( element ) {
        if ( ! /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) ) {
            element.tabIndex = -1;
        }
        element.focus();
    }
}

if ( window.addEventListener ) {
    window.addEventListener( 'hashchange', ga_skiplinks, false );
} else { // IE8 and earlier
    window.attachEvent( 'onhashchange', ga_skiplinks, false );
}
