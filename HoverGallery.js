var HoverGallery = {

	init: function () {
		HoverGallery.bind();
	},

	bind: function () {
		$( '.gallery img' ).hover( HoverGallery.onMouseEnter, HoverGallery.onMouseLeave );
	},

	onMouseEnter: function () {
		// First show the loading icon
		var loadingUrl = mw.config.get( 'wgExtensionAssetsPath' ) + '/hovergallery/images/loading.gif',
			loadingImg = $( '<img>' ).addClass( 'hoverimage' ).attr( 'src', loadingUrl );
		$( 'body' ).append( loadingImg );

		var gallery = $( this ).closest( '.gallery' ),
			fileUrls = gallery.data( 'hovergallery-fileurls' ),
			maxHoverWidth = gallery.data( 'hovergallery-maxhoverwidth' ),
			maxHoverHeight = gallery.data( 'hovergallery-maxhoverheight' );

		// Determine which of the thumbs is it
		var thumbs = $( 'img', gallery ),
			thumbIndex = $.inArray( this, thumbs );

		// Get the corresponding URL and build the image
		var url = fileUrls[ thumbIndex ],
			image = new Image();
			image.src = url;
			image.onload = function () {
				loadingImg.css({
					'max-width': maxHoverWidth + 'px',
					'max-height': maxHoverHeight + 'px'
				}).attr( 'src', url );
			};
	},

	onMouseLeave: function () {
		$( 'body .hoverimage' ).remove();
	}
};

$( HoverGallery.init );