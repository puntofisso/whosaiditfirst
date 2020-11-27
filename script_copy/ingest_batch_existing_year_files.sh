#!/bin/bash

curl -XDELETE localhost:9200/hansard 

rm -f log.log
for year in `seq 1919 2020`
do
	mydate=`date`
	echo "$year, $mydate" >> log.log
	while read line; do 
		curl -XPOST http://localhost:9200/hansard/_doc -H 'Content-Type: application/json' -d "$line"
	done < $year.txt
done
mydate=`date`
echo $mydate >> log.log
