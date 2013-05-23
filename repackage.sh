#!/bin/bash

datadir=data/

output=upload.zip
subdir=$1

if [ -z "$subdir" ]; then
	echo "Specify subdir!"
	exit;
fi

rm -rf $output;
find $subdir -name "points.eclaus.txt" -o -name "correction.eclaus.txt" -o -name ".identity.eclaus" \
	| zip -q $output -@;

idents=$(find $datadir -name ".identity.eclaus" | sed -r 's/\/\.identity\.eclaus$//');
for ident in $idents; do
	if [[ $subdir = $ident* ]]; then
		zip -q $output "$ident/.identity.eclaus";
	fi
done;



