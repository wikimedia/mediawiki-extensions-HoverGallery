<?php

$wgExtensionCredits['parserhook'][] = array(
	'path' => __FILE__,
	'name' => 'HoverGallery',
	'descriptionmsg' => 'hovergallery-desc',
	'version' => '1.0',
	'author' => '[http://mediawiki.org/wiki/User:Felipe_Schenone Felipe Schenone]',
	'url' => 'https://www.mediawiki.org/wiki/Extension:HoverGallery',
);

$wgResourceModules['ext.HoverGallery'] = array(
	'scripts' => 'HoverGallery.js',
	'styles' => 'HoverGallery.css',
	'position' => 'top',
	'localBasePath' => __DIR__,
	'remoteExtPath' => 'Hovergallery',
);

$wgMessagesDirs['HoverGallery'] = __DIR__ . '/i18n';
$wgExtensionMessagesFiles['HoverGallery'] = __DIR__ . '/HoverGallery.i18n.php';
$wgAutoloadClasses['HoverGallery'] = __DIR__ . '/HoverGallery.body.php';

$wgHooks['BeforePageDisplay'][] = 'HoverGallery::onBeforePageDisplay';
$wgHooks['ParserFirstCallInit'][] = 'HoverGallery::onParserFirstCallInit';