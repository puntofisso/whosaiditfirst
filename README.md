# whosaiditfirst

This repository can be used to replicate the functions of the "Who said it first" functionality of Parli-N-Grams at http://parli-n-grams.puntofisso.net/hansard.php. Note that this is a very quick hack, and not intended to be a production system.

In order to set up the system, you will spin up an ElasticSearch instance.

1. In the ```elastic``` folder there is a JSON file with the right mappings to create an index.
2. The index can be fed with data and the ```script_copy``` folder has two ways to do this
2a. For a new system, upon rsyncing the whole of the [TheyWorkForYou archive](https://parser.theyworkforyou.com/hansard.html), the script ```parse_all.sh``` will call ```parse_year.sh``` for each available year (you need to configure this in the script). This will create one ```.txt``` file per year. The script ```ingest_batch_existing_year_files.sh``` can be used to ingest all the ```.txt``` files into ElasticSearch.
2b. Once you have a set up system, you can create a ```crontab``` with the ```automate.sh``` script (or run it manually at will). This script will rsync the latest versione of the data from TheyWorkForYou, and parse/ingest it.
