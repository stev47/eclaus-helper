<?php

require "common.php";

$files = scandir($path);
$files = array_filter($files, function ($v) use ($path) {
	return substr($v, 0, 1) != "." && !is_dir($path . '/' . $v); 
});
$files = array_values($files);

$result = array();

foreach ($files as $file) {
	if (preg_match('/\.(java|c|cpp|txt)$/i', $file, $matches)) {
		$result[$file] = array(
			'type' => 'source',
			'lang' => $matches[1]
		);
	} else if (preg_match('/\.(jpg|png|svg)$/i', $file, $matches)) {
		$result[$file] = array(
			'type' => 'image',
			'path' => $path_from_root . '/' . $file
		);
	} else {
		$result[$file] = array(
			'type' => 'other',
			'path' => $path_from_root . '/' . $file
		);
	}
}

echo json_encode($result);



