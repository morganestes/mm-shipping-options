/**
 * Custom Shipping Options for MemberMouse
 */
var MM_FSO = MM_FSO || {};

MM_FSO.getURLParameter = function ( name ) {
	'use strict';
	return decodeURIComponent(
		(new RegExp( name + '=' + '(.+?)(&|$)' ).exec( location.search ) || [, null])[1]
	);
};

/**
 * Polyfill forEach for browsers without native support (IE<9).
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/forEach#Polyfill
 */
if ( ! Array.prototype.forEach ) {
	Array.prototype.forEach = function ( fun /*, thisArg */ ) {
		"use strict";

		var t = Object( this ),
		    len = t.length >>> 0,
		    thisArg = arguments.length >= 2 ? arguments[1] : void 0;

		if ( ( this === void 0 || this === null ) || typeof fun !== 'function' ) {
			throw new TypeError();
		}

		for ( var i = 0; i < len; i ++ ) {
			if ( i in t ) {
				fun.call( thisArg , t[i] , i , t );
			}
		}
	};
}

/**
 * Filter the shipping options in MemberMouse checkout pages.
 */
MM_FSO.filterShippingOptions = (function ( $ ) {
	"use strict";
	var isShippable = document.getElementById( 'mm_is_shippable' ),
	    hasShippingMethods = document.getElementById( 'mm_field_shipping_method' ),
	    customShippingOptions = MM_FSO.getURLParameter( 'mm-fso' ).split( ',' ).map( Number ),
	    $shippingOptions = $( '#mm_field_shipping_method' ).find( 'option' ),
	    shippingMethods = [],
	    allowedShipping = [];

	// Use MM checks to see if we're on a shippable product checkout form.
	if ( isShippable && hasShippingMethods ) {
		// Get options from query and make them compatible with MM.
		customShippingOptions.forEach( function ( element , index , array ) {
			array[index] = 'FLATRATE-' + element;
		} );

		// Push all the available options into an array.
		$shippingOptions.each( function ( index , value ) {
			shippingMethods.push( this.value );
		} );

		// Filter out the unwanted options and remove them from the DOM
		$.each( $shippingOptions , function () {
			var $optval = $( this ).val();
			if ( $.inArray( $optval , customShippingOptions ) === - 1 ) {
				$( this ).remove();
			}
		} );

	}
})( jQuery );
