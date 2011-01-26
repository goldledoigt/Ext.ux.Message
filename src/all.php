<?php

header('Content-type: application/x-javascript');

$name = 'Axs.Message';
$outputFile = dirname(__FILE__) . '/../' . $name . '-all.js';

if (true) {

	$files = array(
		'Ext.ux.Message.js',
		'namespace.js'
	);

	$pack = '';
	foreach ($files as $file) {
		$filepath = realpath(dirname(__FILE__)) . '/' . $file;
		if (file_exists($filepath) === false) {
			$pack .= 'console.log("File does not exists: ' . $name . '/' . $file . '");';
		} else {
			$pack .= "\n/**\n";
			$pack .= " * Start " . $name . "/" . $file;
			$pack .= "\n */\n";
			$pack .= file_get_contents($filepath);
			$pack .= "\n/**\n";
			$pack .= " * End " . $name . "/" . $file;
			$pack .= "\n */\n";
		}
	}
	file_put_contents($outputFile, $pack);
}

header('Location: ../' . $name . '-all.js');
