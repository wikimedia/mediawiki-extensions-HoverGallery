<?php

$wgExtensionCredits['parserhook'][] = array(
	'path' => __FILE__,
	'name' => 'HoverGallery',
	'descriptionmsg' => 'hovergallery-desc',
	'version' => 0.2,
	'author' => 'Luis Felipe Schenone',
	'url' => 'https://www.mediawiki.org/wiki/Extension:HoverGallery',
);

$wgResourceModules['ext.HoverGallery'] = array(
	'scripts' => 'HoverGallery.js',
	'styles' => 'HoverGallery.css',
	'position' => 'top',
	'localBasePath' => __DIR__,
	'remoteExtPath' => 'HoverGallery',
);

$wgExtensionMessagesFiles['HoverGallery'] = __DIR__ . '/HoverGallery.i18n.php';
$wgAutoloadClasses['HoverGallery'] = __DIR__ . '/HoverGallery.body.php';

$wgHooks['BeforePageDisplay'][] = 'HoverGallery::addModule';
$wgHooks['ParserFirstCallInit'][] = 'HoverGallery::setParserHook';