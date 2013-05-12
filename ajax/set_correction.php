<?php

require "common.php";
require "../inc/Encoding.php";

$path_points = $path . '../points.eclaus.txt';
$path .= '../correction.eclaus.txt';

if (isset($_POST['correction'])) {
	file_put_contents($path, \ForceUTF8\Encoding::toUTF8($_POST['correction']));

	$points = file_get_contents($path_points);
	if (!preg_match('/^GROUP-GRADING\=.*$/m', $points)) {
		$points .= "GROUP-GRADING=\n";
	}
	$points = preg_replace('/^(GROUP-GRADING\=).*$/m', '${1}' . $_POST['group_points'], $points);
	echo $points;
	file_put_contents($path_points, $points);

}


