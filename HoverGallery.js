var HoverGallery = {

	init: function () {
		HoverGallery.bind();
	},

	bind: function () {
		$( '.gallery img' ).hover( HoverGallery.onMouseEnter, HoverGallery.onMouseLeave );
	},

	onMouseEnter: function ( event ) {
		var gallery = $( this ).closest( '.gallery' ),
			fileUrls = gallery.data( 'hovergallery-fileurls' ),
			maxHoverWidth = gallery.data( 'hovergallery-maxhoverwidth' ),
			maxHoverHeight = gallery.data( 'hovergallery-maxhoverheight' );

		// Determine which of the thumbs is it
		var thumbs = $( 'img', gallery ),
			thumbIndex = $.inArray( this, thumbs );

		// Get the corresponding URL and build the image
		var url = fileUrls[ thumbIndex ],
			image = $( '<img>' ).attr( 'src', url ).addClass( 'hoverimage' ).css({
				'max-width': maxHoverWidth + 'px',
				'max-height': maxHoverHeight + 'px'
			});

		// Show the image
		$( 'body' ).append( image );
	},

	onMouseLeave: function ( event ) {
		$( 'body .hoverimage' ).remove();
	}
};

$( HoverGallery.init );