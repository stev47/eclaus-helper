<?php

header('Content-Type: application/json');

/*if (!isset($_GET['dir']))
	throw new Exception("No directory specified.");
 */

$course = (!empty($_GET['course']))? $_GET['course'] . '/' : '';
$class = (!empty($_GET['class']))? $_GET['class'] . '/' : '';
$sheet = (!empty($_GET['sheet']))? $_GET['sheet'] . '/' : '';
$exercise = (!empty($_GET['exercise']))? $_GET['exercise'] . '/' : '';
$exercise_part = (!empty($_GET['exercise_part']))? $_GET['exercise_part'] . '/' : '';
$group = (!empty($_GET['group']))? $_GET['group'] . '/uploads/' : '';

$path_from_root = "data/{$course}{$class}{$sheet}{$exercise}{$exercise_part}{$group}";
$path = "../data/{$course}{$class}{$sheet}{$exercise}{$exercise_part}{$group}";

$group = (!empty($_GET['group']))? $_GET['group'] : '';
$path_group = "../data/{$course}{$class}{$sheet}{$exercise}{$exercise_part}{$group}";


