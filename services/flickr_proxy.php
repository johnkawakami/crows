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
include_once('../common.php');

$page=!empty($_POST['page']) ? $_POST['page'] : 1;

send_cache_headers($flickr_ttl);


$flickr_request_url = $flickr_api_url.'&format=json&page='.$page;

if($result = cache_fetch($flickr_request_url)) {
	print $result;
	exit;
}

$curl = curl_init();
curl_setopt ($curl, CURLOPT_URL,$flickr_request_url);
curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec ($curl);
curl_close ($curl);

cache_store($flickr_request_url, $result, $flickr_ttl);

print $result;
