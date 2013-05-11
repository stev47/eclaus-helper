#!/bin/bash

target=data/

dir=$(dirname $1)
zipname=$(basename $1)
name=$(unzip -l $zipname | grep -Po "EClausAbgaben-[^\/]+(?=\/\.identity\.eclaus)")

#echo $name;

mkdir $target/tmp

unzip -q -d $target/tmp -o $1
mv -f $target/tmp/$name/* $target/tmp/
rm -rf $target/tmp/$name

for f in $(find $target/tmp -name '*.zip'); do 
	unzip -qqq -B -j $f -d $(dirname $f) -x *.class *.core.prefs;
	rm $f;
done



cp -R $target/tmp/* $target/
chmod -R a+rw $target/
rm -rf $target/tmp/*
rm -rf $target/tmp


