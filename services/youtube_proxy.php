<?
/*
 * Crows - Crowd Syndication 1.0
 * Copyright 2009
 * contact@crowsne.st
 * http://www.crowsne.st/license
 */

include_once('../config.php');
include('../common.php');
send_cache_headers($youtube_ttl);

if($result = cache_fetch("youtube-data")) {
        print $result;
        exit;
}

$curl = curl_init();

$youtube_api_url=$youtube_api_url.'&alt=json&orderby='.$youtube_orderby;
curl_setopt ($curl, CURLOPT_URL,$youtube_api_url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec ($curl);
curl_close ($curl);

cache_store("youtube-data",$result,$youtube_ttl);

print($result);
