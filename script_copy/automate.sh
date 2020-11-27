#!/bin/bash

rm -f list

# Rsync dry run to save list of files
rsync -avzni --progress --out-format="%n"  data.theyworkforyou.com::parldata/scrapedxml/debates/debates* hansard > list
cat list | head -n -3 | tail -n +2 > list2
mv list2 list

# Real rsync
rsync -avz --progress --out-format="%n"  data.theyworkforyou.com::parldata/scrapedxml/debates/debates* hansard


# Parse list of files
rm -f addtemp.txt
while read line
do
	filename=$line
	python3 harvest.py hansard/$filename A >> addtemp.txt
done < list

# ingest
if test -f "addtemp.txt"; then
while read line; do 
	curl -XPOST http://localhost:9200/hansard/_doc -H 'Content-Type: application/json' -d "$line"
done < addtemp.txt
fi
