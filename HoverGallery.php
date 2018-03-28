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
			$filename = strtok( $filename, '|' ); // Remove the options
			$filename = substr( $filename, ( $position = strpos( $filename, ':' ) ) === false ? 0 : $position + 1 ); // Remove the File prefix
			$filepath = $parser->recursiveTagParse( '{{filepath:' . $filename . '|nowiki}}' ); // Get the filepath
			$FILEURLS[] = $filepath;
		}

		$fileUrls = json_encode( $FILEURLS );
		$fileUrls = htmlspecialchars( $fileUrls, ENT_QUOTES );

		$gallery = '<gallery class="hovergallery"
		data-hovergallery-maxhoverwidth="' . $maxhoverwidth . '"
		data-hovergallery-maxhoverheight="' . $maxhoverheight . '"
		data-hovergallery-fileurls="' . $fileUrls . '">' . $input . '</gallery>';

		return $parser->recursiveTagParse( $gallery );
	}
}