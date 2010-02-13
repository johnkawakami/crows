<?php

function send_cache_headers($ttl) {
  header("Cache-Control: max-age=$ttl");
  header("Expires: " . gmdate("D, d M Y H:i:s", time() + $ttl) . " GMT");
}

function cache_fetch($key) {
  global $use_apc;
  global $memcache;
  global $cacheid;

 if($use_apc) {
    return apc_fetch($cacheid.$key);
  } else if($memcache) {
    return memcache_get($memcache, $cacheid.$key);
  } else {
    return false;
  }
  
}

function cache_store($key, $value, $ttl) {
  global $use_apc;
  global $memcache;
  global $cacheid;

  if($use_apc) {
    return apc_store($cacheid.$key, $value, $ttl);
  } else if($memcache) {
    return memcache_get($memcache, $cacheid.$key);
  } else {
    return false;
  }
}

