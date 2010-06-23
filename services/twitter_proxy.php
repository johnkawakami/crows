<?

/*
 * Crows - Crowd Syndication 1.0
 * Copyright 2009
 * contact@crowsne.st
 */


/*
 * This file is part of Crows.
 *
 * Crows is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Crows is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Crows.  If not, see <http://www.gnu.org/licenses/>.
 *  */


include_once('../config.php');
include('../common.php');
send_cache_headers($twitter_ttl);

if($result = cache_fetch("twitter-proxy")) {
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
