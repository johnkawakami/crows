<?
/*
 * Crows - Crowd Syndication 1.0
 * Copyright 2009
 * contact@crowsne.st
 * http://www.crowsne.st/license
 */

include_once('../config.php');

if($use_apc && $result = apc_fetch($apc_unique_id."-flickr")) {
  render_result($result);
  exit();
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

if($has_apc) {
  apc_add($apc_unique_id."-flickr", $result, $flickr_ttl);
}
render_result($result);

function render_result($result) {
        global $flickr_ttl;
	header("Cache-Control: max-age=$flickr_ttl");
	header("Expires: " . gmdate("D, d M Y H:i:s", time() + $flickr_ttl) . " GMT");
	print($result);
}

