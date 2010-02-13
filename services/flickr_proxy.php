<?
/*
 * Crows - Crowd Syndication 1.0
 * Copyright 2009
 * contact@crowsne.st
 * http://www.crowsne.st/license
 */

include_once('../config.php');
include_once('../common.php');

send_cache_headers($flickr_ttl);

if($result = cache_fetch("flickr-proxy")) {
	print $result;
	exit;
}

$page=$_POST['page'];
$user_id=$_POST['user_id'];

if($user_id){
	$flickr_api_url='http://api.flickr.com/services/rest/?method=flickr.people.getInfo&api_key='.$flickr_api_key.'&format=json&user_id='.$user_id.'&nojsoncallback=1';
}


$curl = curl_init();
curl_setopt ($curl, CURLOPT_URL,$flickr_api_url.'&format=json&page='.$page);
curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec ($curl);
curl_close ($curl);

cache_store("flickr-proxy", $result, $flickr_ttl);

print $result;
