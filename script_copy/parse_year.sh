#!/bin/bash
year=$1

rm -f $year.txt
touch $year.txt

# Extract text
for i in `ls hansard/debates$year*`
do	
	filename=`basename $i`
	echo $filename
	#python2.7 $PARS/harvest.py $i $HARV/hansard > $PARS/$year/$filename.txt
	
	python3 harvest.py $i A >> $year.txt
done

