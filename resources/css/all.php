<?php

header('Content-type: text/css');

$name = 'Axs.Message';
$outputFile = dirname(__FILE__) . '/' . $name . '-all.css';

if (true) {
	$files = array(
		'Ext.ux.Message.css'
	);
	$pack = '';
	foreach ($files as $file) {
		$filepath = realpath(dirname(__FILE__)) . '/' . $file;
		if (file_exists($filepath) === false) {
			$pack .= '/**'.chr(10).' * ERROR'.chr(10).
				' * File does not exists: ' . $name . '/' . $file . chr(10).' */';
		} else {
			$pack .= "\n/**\n";
			$pack .= " * Start " . $name . "/" . $file;
			$pack .= "\n */\n";
			$pack .= preg_replace('/[\s]+/ism', ' ', file_get_contents($filepath));
			$pack .= "\n/**\n";
			$pack .= " * End " . $name . "/" . $file;
			$pack .= "\n */\n";
		}
	}
	file_put_contents($outputFile, $pack);
}

header('Location: ' . $name . '-all.css');
