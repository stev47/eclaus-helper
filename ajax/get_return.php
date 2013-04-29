<?php

require "common.php";
require "../inc/Encoding.php";

$path .= '../return.eclaus.txt';

header('Content-Type: text/html');

echo \ForceUTF8\Encoding::toUTF8(file_get_contents($path));

