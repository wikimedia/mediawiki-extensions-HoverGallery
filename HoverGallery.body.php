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

		$maxhoverwidth = '';
		$maxhoverheight = '';
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

		$normalGallery = $parser->recursiveTagParse( '<gallery>' . $input . '</gallery>' );

		$hiddenGallery = '<div class="hover-gallery">';
		$FILENAMES = explode( "\n", $input );
		$FILENAMES = array_filter( $FILENAMES );
		foreach ( $FILENAMES as $filename ) {
			if ( $maxhoverwidth or $maxhoverheight ) {
				$hiddenGallery .= $parser->recursiveTagParse( '[[' . $filename . '|' . $maxhoverwidth . 'x' . $maxhoverheight . 'px]]' );
			} else {
				$hiddenGallery .= $parser->recursiveTagParse( '[[' . $filename . ']]' );
			}
		}
		$hiddenGallery .= '</div>';

		return $normalGallery . $hiddenGallery;
	}
}