<?php

function extract_zip ($path) {

	exec("unzip -d data/tmp/ -o " . $path); // needs permissions

	preg_match('/([^\/]+)\.zip/', $path, $matches);
	exec("mv data/tmp/" . $matches[1] . '/* data/tmp/');
	exec("rm -rf data/tmp/" . $matches[1]);

}

