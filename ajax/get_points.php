<?php

require "common.php";
require "../inc/Encoding.php";

$path_points = $path . '../points.eclaus.txt';
$path = $path_group . '/correction.eclaus.txt';

header('Content-Type: text/html');

$result = array();
if (file_exists($path)) {
	if (preg_match('/^GROUP-GRADING\=(.*)$/m', file_get_contents($path_points), $match) == 1)
		echo $match[1];
}
