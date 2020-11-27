#!/bin/bash
# d/l rsync -avz --progress data.theyworkforyou.com::parldata/scrapedxml/debates/debates* hansard/
for i in `seq 1919 2020`
do
	echo $i
	echo "$i" > current
	./parse_year.sh $i
done
rm -f current

