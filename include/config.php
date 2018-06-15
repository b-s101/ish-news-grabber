<?php

//false = don't use proxy server, true = use proxy server
$use_proxy = true;
//your proxy login and password here (user:password)
$proxy_login = '';
//proxy IP/hostname
$proxy_host = '';
//proxy port
$proxy_port = '';

//Timezone (refer PHP docs for more)
date_default_timezone_set("Europe/Berlin");

//turn curl debuggin on or off (true=on, false=off)
$curl_debug = false;
$curl_debug_url = 'https://www.is-handel.net/content/element/00000061.asp?eo=frmAccountName='.$ish_user.'&action=11&NewsChannelId=2';

// IS News Handel settings
//------------------------
//valid username at is-handel.net
$ish_user = '';
//corresponding password for is-handel.net user
$ish_passw = '';
//content URL
$ish_hotnews_url = 'https://www.is-handel.net/content/element/00000061.asp?eo=frmAccountName='.$ish_user.'&action=11&NewsChannelId=2';
$ish_evanews_url = 'https://www.is-handel.net/content/element/00000061.asp?eo=frmAccountName='.$ish_user.'&action=11&NewsChannelId=11';
$ish_odisnews_url = 'https://www.is-handel.net/content/element/00000061.asp?eo=frmAccountName='.$ish_user.'&action=11&NewsChannelId=30';
$ish_crossnews_url = 'https://www.is-handel.net/content/element/00000061.asp?eo=frmAccountName='.$ish_user.'&action=11&NewsChannelId=27';
//URL which performs the login
$ish_loginurl = 'https://www.is-handel.net/content/element/00000046.asp?eo=&s_et=&s_qs=';
//POST data which will be sent to login
$ish_postdata = 'frmAccountName='.$ish_user.'&frmAccountPassword='.$ish_passw.'&frmAction12=Anmelden';
//user agent to use
$ish_useragent = 'Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; WOW64; Trident/5.0)';

?>