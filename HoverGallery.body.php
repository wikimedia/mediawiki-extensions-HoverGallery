<?php

class HoverGallery {

	public static function addModule( &$output ) {
		$output->addModules( 'ext.HoverGallery' );
		return true;
	}

	public static function setParserHook( &$parser ) {
		$parser->setHook( 'hovergallery', 'HoverGallery::renderGallery' );
		return true;
	}

	public static function renderGallery( $input, array $ARGS, Parser $parser, PPFrame $frame ) {

		$maxhoverwidth = '100%';
		$maxhoverheight = '100%';
		if ( array_key_exists( 'hoversize', $ARGS ) ) {
			$maxhoverwidth = $ARGS['hoversize'] . 'px';
			$maxhoverheight = $ARGS['hoversize'] . 'px';
		}
		if ( array_key_exists( 'maxhoverwidth', $ARGS ) ) {
			$maxhoverwidth = $ARGS['maxhoverwidth'] . 'px';
		}
		if ( array_key_exists( 'maxhoverheight', $ARGS ) ) {
			$maxhoverheight = $ARGS['maxhoverheight'] . 'px';
		}			

		$normalGallery = $parser->recursiveTagParse( '<gallery>' . $input . '</gallery>' );

		$hiddenGallery = '<div class="hover-gallery">';
		$FILENAMES = explode( "\n", $input );
		$FILENAMES = array_filter( $FILENAMES );
		foreach ( $FILENAMES as $filename ) {
			$hiddenGallery .= $parser->recursiveTagParse( '[[' . $filename . ']]' );
		}
		$hiddenGallery .= '</div>';

		return $normalGallery . $hiddenGallery;
	}
}