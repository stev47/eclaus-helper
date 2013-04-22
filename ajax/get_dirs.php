<?php

require "common.php";


$files = scandir($path);
$files = array_filter($files, function ($v) use ($path) {
	return substr($v, 0, 1) != "." && is_dir($path . '/' . $v); 
});
$files = array_values($files);

$names = array_map(function ($v) {
	return str_replace('_', ' ', $v);
}, $files);

$result = array_combine($files, $names);

echo json_encode($result);

