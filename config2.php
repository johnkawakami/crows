<?
/*


 * Crows - Crowd Syndication 1.0
 * Copyright 2009
 * contact@crowsne.st
 */

/*
This file is part of Crows.

Crows is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

Crows is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Crows.  If not, see <http://www.gnu.org/licenses/>.
 */

//database type, you probably want sqlite unless you don't have it installed
//
//valid options: "db", "csv"
$database_type = "db";
$database_dsn = "sqlite:/var/www/crows/db/database.sqlite3";
$database_dsn = "mysql:host=localhost;dbname=la_indymedia_org_crows";
$database_user = "root";
$database_password = false;

//main url, used for the link in the rss feed
$main_url = "http://crowsne.st/";
$use_apc = function_exists('apc_fetch');

# todo
# add url to background_image
# 


if (is_int($_GET['c'])) {
  $config_id = $_GET['c'];
  if ($config_id < 1 or $config_id > 9999) {
    echo 'c is out of range';
    exit;
  }
} else {
  $config_id = 0;
}

$dbc = new PDO( $database_dsn, $database_user, $database_password );

#
# load up global variables from the config table
#
$sth = $dbc->prepare('SELECT * FROM config WHERE id=?');
$result = $sth->execute(array($config_id));
$arr = $sth->fetchAll(PDO::FETCH_ASSOC);
#print_r($arr);
foreach($arr[0] as $key=>$value) {
  $$key = $value;
}

/*
 * load up widgets from the widgets table
 */
$sth = $dbc->prepare('SELECT * FROM widgets WHERE config_id=? ORDER BY weight');
$result = $sth->execute(array($config_id));
$widgets = $sth->fetchAll(PDO::FETCH_ASSOC);
#print_r($widgets);

// adjust some variables
$hashtags = split(',', $hashtags);

/*********************
* advanced api settings
* you dont need to change these settings unless you are familiar with apis...
*/

if($flickr_mode=='tagsearch')$flickr_api_url='http://api.flickr.com/services/rest/?method=flickr.photos.search&api_key='.$flickr_api_key.'&sort='.$flickr_sortby.'&tags='.urlencode($flickr_tags).'&per_page='.$flickr_photos_per_page.'&media=photos&nojsoncallback=1&tag_mode='.$flickr_tag_mode;
if($flickr_mode=='photoset')$flickr_api_url='http://api.flickr.com/services/rest/?method=flickr.photosets.getPhotos&api_key='.$flickr_api_key.'&sort='.$flickr_sortby.'&photoset_id='.$flickr_photoset_id.'&per_page='.$flickr_photos_per_page.'&media=photos&nojsoncallback=1';
if($flickr_mode=='favorites')$flickr_api_url='http://api.flickr.com/services/rest/?method=flickr.favorites.getPublicList&api_key='.$flickr_api_key.'&sort='.$flickr_sortby.'&user_id='.urlencode($flickr_favorites_user_id).'&per_page='.$flickr_photos_per_page.'&media=photos&nojsoncallback=1';

if($youtube_mode=='user')$youtube_api_url='http://gdata.youtube.com/feeds/api/users/'.$youtube_user.'/uploads?start-index=1&max-results=50&v=2';
if($youtube_mode=='keywords')$youtube_api_url='http://gdata.youtube.com/feeds/api/videos?q='.urlencode($youtube_keywords).'&start-index=1&max-results=50&v=2';
if($youtube_mode=='playlist')$youtube_api_url='http://gdata.youtube.com/feeds/api/playlists/'.$youtube_playlist_id.'?start-index=1&max-results=50&v=2';

