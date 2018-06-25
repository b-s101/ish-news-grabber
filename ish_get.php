<?php
include_once __DIR__.'/include/functions.php';
include_once __DIR__.'/include/config.php';

unlink('ish_test.html');

if ($curl_debug) {
	ob_start();  
	$dbg_out = fopen('php://output', 'w');
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
if ($curl_debug) {
	curl_setopt($ch, CURLOPT_VERBOSE, true);
	curl_setopt($ch, CURLOPT_STDERR, $dbg_out); 
}
$postResult = curl_exec($ch);

if ($curl_debug) {
	fclose($dbg_out);  
	$debug_entries = ob_get_clean();
	echo '<b>debug is on</b><br>';
	echo '---cURL output---<br>';
	echo '<pre>'.$debug_entries.'</pre>';
	curl_setopt($ch, CURLOPT_URL, $curl_debug_url);
	$curl_response = curl_exec($ch);
	file_put_contents('ish_test.html',$curl_response);
	if ($debug_show_config) {
		echo '---Configuration---<br>';
		echo '$use_proxy: ';
			If ($use_proxy) {
				echo 'true<br>';
			}else{
				echo 'false<br>';
			}
		echo '$proxy_login: '.$proxy_login.'<br>';
		echo '$proxy_host: '.$proxy_host.'<br>';
		echo '$proxy_port: '.$proxy_port.'<br>';
		echo '$curl_debug: ';
			If ($curl_debug) {
				echo 'true<br>';
			}else{
				echo 'false<br>';
			}
		echo '$curl_debug_url: '.$curl_debug_url.'<br>';
		echo '$debug_show_config: ';
			If ($debug_show_config) {
				echo 'true<br>';
			}else{
				echo 'false<br>';
			}
		echo '$ish_user: '.$ish_user.'<br>';
		echo '$ish_passw: '.$ish_passw.'<br>';
		echo '$ish_loginurl: '.$ish_loginurl.'<br>';
		echo '$ish_postdata: '.$ish_postdata.'<br>';
	}		
	echo '---cURL Info---<br>';
	$code = curl_getinfo($ch);
	echo '<pre>';
		print_r($code);
	echo '</pre>';
	echo '---Website fetched before parsing HTML---<br>';
	echo '<iframe src="ish_test.html" width=100% height=100%></iframe>';
}else{
	//fetching content

	echo '<b>HOT NEWS</b><br>';
	curl_setopt($ch, CURLOPT_URL, $ish_hotnews_url);
	$hotnews_data = curl_exec($ch);
	//reworking data
	$rows = parseTable($hotnews_data);
	ish_strip_html_table($rows);

	echo '<b>EVA</b><br>';
	curl_setopt($ch, CURLOPT_URL, $ish_evanews_url);
	$eva_data = curl_exec($ch);
	//reworking data
	$rows = parseTable($eva_data);
	ish_strip_html_table($rows);
	
	echo '<b>ODIS</b><br>';
	curl_setopt($ch, CURLOPT_URL, $ish_odisnews_url);
	$odis_data = curl_exec($ch);
	//reworking data
	$rows = parseTable($odis_data);
	ish_strip_html_table($rows);
	
	echo '<b>CROSS</b><br>';
	curl_setopt($ch, CURLOPT_URL, $ish_crossnews_url);
	$cross_data = curl_exec($ch);
	//reworking data
	$rows = parseTable($cross_data);
	ish_strip_html_table($rows);

}
curl_close($ch);
?>
