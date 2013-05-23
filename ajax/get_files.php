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
	// Ignored files
	if (preg_match('/\.class$/i', $file, $matches))
		continue;

	$result[$file] = array(
		'mime-type' => finfo_file(finfo_open(FILEINFO_MIME_TYPE), $path . '/' . $file),
		'path' => $path_from_root . '/' . $file
	);

	if (preg_match('/\.(java|c|cpp|txt)(~[0-9]*)?$/i', $file, $matches)) {
		$result[$file]['type'] = 'source';
		$result[$file]['lang'] = $matches[1];
	} else if ($result[$file]['mime-type'] == "text/plain") {
		$result[$file]['type'] = 'source';
		$result[$file]['lang'] = 'txt';
	} else if (preg_match('/\.(jpg|png|svg)(~[0-9]*)?$/i', $file, $matches)) {
		$result[$file]['type'] = 'image';
	} else if (preg_match('/\.(pdf)(~[0-9]*)?$/i', $file, $matches)) {
		$result[$file]['type'] = 'pdf';
	} else {
		$result[$file]['type'] = 'other';
	}
}

echo json_encode($result);



