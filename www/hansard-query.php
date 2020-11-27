<?php
header('Content-type: application/json');

$queryvalue = $_GET['query'];
$url = "http://165.232.101.71/hansard.php";
$url = "$url"."?query=".urlencode($queryvalue);


$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$res = curl_exec($curl);
curl_close($curl);

echo $res;

?>
