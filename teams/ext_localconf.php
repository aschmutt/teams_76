<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Teams.' . $_EXTKEY,
	'Pi1',
	array(
		'Teams' => 'list, show, new, create, edit, update, delete',
		
	),
	// non-cacheable actions
	array(
		'Teams' => 'create, update, delete',
		
	)
);
