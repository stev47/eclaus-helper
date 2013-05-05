<?php

require "common.php";

if ($files = @scandir($path)) {
	$files = array_filter($files, function ($v) use ($path) {
		return substr($v, 0, 1) != "." && !is_dir($path . '/' . $v); 
	});
	$files = array_values($files);
} else {
	$files = array();
}

$result = array();

foreach ($files as $file) {
	if (preg_match('/\.(java|c|cpp|txt)(~[0-9]*)?$/i', $file, $matches)) {
		$result[$file] = array(
			'type' => 'source',
			'lang' => $matches[1]
		);
	} else if (preg_match('/\.(jpg|png|svg)(~[0-9]*)?$/i', $file, $matches)) {
		$result[$file] = array(
			'type' => 'image',
			'path' => $path_from_root . '/' . $file
		);
	} else if (preg_match('/\.(pdf)(~[0-9]*)?$/i', $file, $matches)) {
		$result[$file] = array(
			'type' => 'pdf',
			'path' => $path_from_root . '/' . $file
		);
	// Ignored files
	} else if (preg_match('/\.class$/i', $file, $matches)) {
		continue;
	} else {
		$result[$file] = array(
			'type' => 'other',
			'path' => $path_from_root . '/' . $file
		);
	}
}

echo json_encode($result);



