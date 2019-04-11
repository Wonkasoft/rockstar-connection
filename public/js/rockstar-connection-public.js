(function( $ ) {
	'use strict';

	$( document ).ready( function() {
		if ( $( '.post-slide' ).length && $( '.post-slide' ).is( ':visible' ) ) {
			$( '.post-slide' ).wrapAll( '<div class="post-slide-wrap post-slide-options"></div>');
			$( '.post-slide-wrap' ).slick({
				centerMode: true,
				infinite: true,
				arrows:  true,
				dots:  false,
				variableWidth: true,
				focusOnSelect: true,
				slidesToShow:  1,
				appendArrows: $( '.post-slide-wrap' ),
				centerPadding: '0',
				autoplay: true,
				autoplaySpeed: '5000',
			});

		}
	});

})( jQuery );