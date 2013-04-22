<?php

require "common.php";

$groupdirs = scandir($path);
$groupdirs = array_filter($groupdirs, function ($v) use ($path) {
	return substr($v, 0, 1) != "." && is_dir($path . '/' . $v); 
});
$groupdirs = array_values($groupdirs);

$result = array();

foreach ($groupdirs as $groupdir) {
	preg_match_all(
		'/^(.*)_(.*)-([0-9]+)=.*$/m', 
		file_get_contents($path . '/' . $groupdir . '/points.eclaus.txt'),
		$matches
	);
	
	$names = array_map(function ($v) {
		return str_replace('_', ' ', $v);
	}, $matches[1]);

	sort($names);

	$result[$groupdir] = implode($names, ' / ');
}
asort($result);

echo json_encode($result);

