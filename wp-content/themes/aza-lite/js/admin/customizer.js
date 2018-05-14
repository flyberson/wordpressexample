/**
 * customizer.js
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );
	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title a, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title a, .site-description' ).css( {
					'clip': 'auto',
					'color': to,
					'position': 'relative'
				} );
			}
		} );
	} );
	wp.customize( 'aza_hero_color', function( value ) {
		value.bind( function( to ) {
			$( '.header-image' ).css( { 'background-color': to } );
		} );
	} );

	wp.customize( 'aza_header_title', function( value ) {
		value.bind( function( to ) {
			var header = $( '.cover-text h1' );
			if( to !== '' ) {
				header.removeClass( 'aza_only_customizer' );
			} else {
				header.addClass('aza_only_customizer');
			}
			header.html( to );
		} );
	} );

	wp.customize( 'aza_subheader_title', function( value ) {
		value.bind( function( to ) {
			var subheader = $( '.cover-text h2' );
			if( to !== '' ) {
				subheader.removeClass( 'aza_only_customizer' );
			} else {
				subheader.addClass('aza_only_customizer');
			}
			subheader.html( to );
		} );
	} );

	wp.customize( 'aza_button_text_1', function( value ) {
		value.bind( function( to ) {
			var button = $( '.first-header-button' );
			if( to !== '' ) {
				button.removeClass( 'aza_only_customizer' );
			} else {
				button.addClass('aza_only_customizer');
			}
			button.html( to );
		} );
	} );

	wp.customize( 'aza_button_text_2', function( value ) {
		value.bind( function( to ) {
			var button = $( '.second-header-button' );
 			if( to !== '' ) {
				button.removeClass( 'aza_only_customizer' );
			} else {
				button.addClass('aza_only_customizer');
			}
			button.html( to );
		} );
	} );

	wp.customize( 'aza_button_color_2', function( value ) {
		value.bind( function( to ) {
			$( '.second-header-button' ).css( { 'background-color': to } );
		} );
	} );

	wp.customize( 'aza_button_text_color_2', function( value ) {
		value.bind( function( to ) {
			$( '.second-header-button' ).css( { 'color': to } );
		} );
	} );

	wp.customize( 'aza_button_color_1', function( value ) {
		value.bind( function( to ) {
			$( '.first-header-button' ).css( { 'background-color': to } );
		} );
	} );

	wp.customize( 'aza_button_text_color_1', function( value ) {
		value.bind( function( to ) {
			$( '.first-header-button' ).css( { 'color': to } );
		} );
	} );

	wp.customize( 'aza_parallax_image', function( value ) {
		value.bind( function( to ) {
			$( '.parallax-img' ).attr( 'src', to );
		} );
	} );

} )( jQuery );
