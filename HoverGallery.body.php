<?php

class HoverGallery {

	static function onBeforePageDisplay( OutputPage &$out, Skin &$skin ) {
		$out->addModules( 'ext.HoverGallery' );
		return true;
	}

	static function onParserFirstCallInit( Parser &$parser ) {
		$parser->setHook( 'hovergallery', 'HoverGallery::render' );
		return true;
	}

	static function render( $input, array $ARGS, Parser $parser, PPFrame $frame ) {

		$maxhoverwidth = 640;
		$maxhoverheight = 640;
		if ( array_key_exists( 'maxhoversize', $ARGS ) ) {
			$maxhoverwidth = $ARGS['maxhoversize'];
			$maxhoverheight = $ARGS['maxhoversize'];
		}
		if ( array_key_exists( 'maxhoverwidth', $ARGS ) ) {
			$maxhoverwidth = $ARGS['maxhoverwidth'];
		}
		if ( array_key_exists( 'maxhoverheight', $ARGS ) ) {
			$maxhoverheight = $ARGS['maxhoverheight'];
		}

		$FILEURLS = array();
		$FILENAMES = array_filter( explode( PHP_EOL, trim( $input ) ) );
		foreach ( $FILENAMES as $filename ) {
			$title = Title::newFromText( $filename, NS_FILE );
			$file = wfLocalFile( $title );
			$FILEURLS[] = $file->getFullUrl();
		}

		$fileUrls = json_encode( $FILEURLS );
		$fileUrls = htmlspecialchars( $fileUrls, ENT_QUOTES );

		$gallery = '<gallery
		data-hovergallery-maxhoverwidth="' . $maxhoverwidth . '"
		data-hovergallery-maxhoverheight="' . $maxhoverheight . '"
		data-hovergallery-fileurls="' . $fileUrls . '">' . $input . '</gallery>';

		return $parser->recursiveTagParse( $gallery );
	}
}