<?php

class HoverGallery {

	static function addResources( & $out ) {
		$out->addModules( 'ext.HoverGallery' );
		return true;
	}

	static function setParserHook( $parser ) {
		$parser->setHook( 'hovergallery', 'HoverGallery::renderGallery' );
		return true;
	}

	function renderGallery( $input, array $args, Parser $parser, PPFrame $frame ) {

		$maxhoverwidth = '100%';
		$maxhoverheight = '100%';
		if ( array_key_exists( 'hoversize', $args ) ) {
			$maxhoverwidth = $args['hoversize'] . 'px';
			$maxhoverheight = $args['hoversize'] . 'px';
		}
		if ( array_key_exists( 'maxhoverwidth', $args ) ) {
			$maxhoverwidth = $args['maxhoverwidth'] . 'px';
		}
		if ( array_key_exists( 'maxhoverheight', $args ) ) {
			$maxhoverheight = $args['maxhoverheight'] . 'px';
		}

		$normalGallery = $parser->recursiveTagParse( '<gallery>' . $input . '</gallery>' );

		$hiddenGallery = '<div class="hover-gallery">';
		$filenames = explode( "\n", $input );
		$filenames = array_filter( $filenames );
		foreach ( $filenames as $filename ) {
			if ( $start = strpos( $filename, ":" ) ) {
				$filename = substr( $filename, $start + 1 ); // Remove the namespace
			}
			if ( strpos( $filename, "|" ) ) {
				$filename = strstr( $filename, "|", true ); // Remove the parameters
			}
			$file = wfFindFile( $filename );
			if ( is_object( $file ) ) {
				$link = $file->getFullUrl();
				$hiddenGallery .= '<img src="' . $link . '" style="max-width: ' . $maxhoverwidth . '; max-height: ' . $maxhoverheight . '" />';
			}
		}
		$hiddenGallery .= '</div>';

		return $normalGallery . $hiddenGallery;
	}
}