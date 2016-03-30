jQuery( function ( $ ) {

	var thumbs, mouseX, mouseY, clientWidth, clientHeight, fullImage, fullImageWidth, fullImageHeight, fullImageX, fullImageY;

	// Get all the thumbnails
	// The normal gallery is right before the hidden gallery, so just move to it and select all the images it contains
	thumbs = $( 'div.hovergallery' ).prev().find( 'img' );

	thumbs.mouseenter( function ( event ) {

		// Determine which of the thumbs is it
		var thumbIndex = $.inArray( this, thumbs );

		// Get the corresponding full-size image, and its width and height
		fullImage = $( 'div.hovergallery' ).children().eq( thumbIndex ).children();

		// Calculate the position of the mouse
		mouseX = event.clientX;
		mouseY = event.clientY;

		// Now the position of the top left corner of the full image
		fullImageX = mouseX + 10;
		fullImageY = mouseY + 10;

		// Make sure the image doesnt go off the screen
		clientWidth = document.body.clientWidth;
		clientHeight = document.body.clientHeight;
		fullImageWidth = fullImage.width();
		fullImageHeight = fullImage.height();
		if ( mouseX + fullImageWidth > clientWidth ) {
			fullImageX -= 20 + mouseX + fullImageWidth - clientWidth;
		}
		if ( mouseY + fullImageHeight > clientHeight ) {
			fullImageY -= 20 + mouseY + fullImageHeight - clientHeight;
		}

		// Show the image
		fullImage.css({ 'top': fullImageY, 'left': fullImageX }).show();

	}).mouseleave(function(){
		fullImage.hide();
	});
}( jQuery ) );