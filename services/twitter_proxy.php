<?

/*
 * Crows - Crowd Syndication 1.0
 * Copyright 2009
 * contact@crowsne.st
 * http://www.crowsne.st/license
 */

include_once('../config.php');
include('../common.php');
send_cache_headers($twitter_ttl);

if($result == cache_fetch("twitter-proxy")) {
        print $result;
        exit;
}

header("Content-type: text/json");


$searchterm=$_POST['searchterm'];
$page=$_POST['page'];


$twitterquery='http://search.twitter.com/search.json?q='.urlencode($searchterm).'&rpp=100&page='.$page;

//call twitter 
$curl = curl_init();
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Accept-Charset:ISO-8859-1,utf-8;q=0.7,*;q=0.7'));  
curl_setopt ($curl, CURLOPT_URL,$twitterquery);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec ($curl);
curl_close ($curl);

cache_store("twitter-proxy", $result, $twitter_ttl);
print($result);
