<?php

require "common.php";
require "../inc/Encoding.php";

$path = $path_group . '/correction.eclaus.txt';

header('Content-Type: text/html');

if (file_exists($path)) {
	echo \ForceUTF8\Encoding::toUTF8(file_get_contents($path));
}

