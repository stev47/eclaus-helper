#!/bin/bash

datadir=data/

output=upload.zip
subdir=$1

if [ -z "$subdir" ]; then
	echo "Specify subdir!"
	exit;
fi

find $subdir -name "points.eclaus.txt" -o -name "correction.eclaus.txt" -o -name ".identity.eclaus" \
	| zip -q $output -@


