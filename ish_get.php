<?php
include_once __DIR__.'/include/functions.php';
include_once __DIR__.'/include/config.php';
if ($debug) {
	error_reporting(E_ALL);
}

//fetching website content

//performing login
$ch = curl_init();
curl_setopt($ch, CURLOPT_FRESH_CONNECT, TRUE);
curl_setopt($ch, CURLOPT_URL, $ish_loginurl);
curl_setopt($ch,CURLOPT_USERAGENT,$ish_useragent);
curl_setopt($ch, CURLOPT_POST, 1 );
curl_setopt($ch, CURLOPT_POSTFIELDS, $ish_postdata);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
if ($use_proxy) {
	curl_setopt($ch, CURLOPT_PROXYPORT, $proxy_port);
	curl_setopt($ch, CURLOPT_PROXYTYPE, 'HTTP');
	curl_setopt($ch, CURLOPT_PROXY, $proxy_host);
	curl_setopt($ch, CURLOPT_PROXYUSERPWD, $proxy_login);
}
curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
$postResult = curl_exec($ch);

//fetching content

echo '<b>HOT NEWS</b><br>';
curl_setopt($ch, CURLOPT_URL, $ish_hotnews_url);
$hotnews_data = curl_exec($ch);
//reworking data
$rows = parseTable($hotnews_data);
foreach($rows as $row) {
	echo get_str(DOMinnerHTML($row),'strong').'<br>';
}
echo '<b>EVA</b><br>';
curl_setopt($ch, CURLOPT_URL, $ish_evanews_url);
$eva_data = curl_exec($ch);
//reworking data
$rows = parseTable($eva_data);
foreach($rows as $row) {
	echo get_str(DOMinnerHTML($row),'strong').'<br>';
}
echo '<b>ODIS</b><br>';
curl_setopt($ch, CURLOPT_URL, $ish_odisnews_url);
$odis_data = curl_exec($ch);
//reworking data
$rows = parseTable($odis_data);
foreach($rows as $row) {
	echo get_str(DOMinnerHTML($row),'strong').'<br>';
}
echo '<b>CROSS</b><br>';
curl_setopt($ch, CURLOPT_URL, $ish_crossnews_url);
$cross_data = curl_exec($ch);
//reworking data
$rows = parseTable($cross_data);
foreach($rows as $row) {
	echo get_str(DOMinnerHTML($row),'strong').'<br>';
}

curl_close($ch);
?>
