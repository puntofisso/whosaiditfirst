<?php

$query=urldecode($_GET['query']);
$header = array(
	"Content-Type: application/json"
    );


$param = '{
  "query": {
    "match_phrase": {
      "speech": "'.$query.'"
    }
  },
  "sort": [
    { "date": "asc" },
    { "counter": "asc"}
  ]
}';

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, "http://localhost:9200/hansard/_search");
curl_setopt($curl,CURLOPT_HTTPHEADER, $header);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS, $param);
$res = curl_exec($curl);
curl_close($curl);

$x = json_decode($res);

$y=$x->hits->hits;
$out=array();

foreach ($y as $mp) {


	//var_dump($mp);
	$thisone=array();
	$thisone['speakername']=$mp->_source->speakername;
	$thisone['date']=$mp->_source->date;
	$thisone['id']=$mp->_source->id;
	$thisone['speakerid'] =$mp->_source->speakerid;
	$thisone['personid']=$mp->_source->personid;
	$out[] = $thisone;
	//$out[] = $mp;
}





echo json_encode($out);
?>
