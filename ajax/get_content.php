<?php

require "common.php";
require "../inc/Encoding.php";

if (empty($_GET['file']))
	throw new Exception("No file specified.");

$path .= $_GET['file'];


echo htmlspecialchars(\ForceUTF8\Encoding::toUTF8(file_get_contents($path)));
