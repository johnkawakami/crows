<?php

// script to create the database objects 
define(MODULES,'../modules/');

include_once('../config.php');
include_once('db_setup.class.php');

function modules_enumerate_files($directory, $pattern) {
  $files = array();
  $dh = opendir($directory);
  while($dir = readdir($dh)) {
    if ($dir=='.' or $dir=='..') continue;
    $file = $directory.$dir.'/'.$dir.$pattern;
    if (file_exists($file)) {
      $files[$dir] = $file;
    }
  }
  return $files;
}


$db = new PDO($database_dsn, $database_user, $database_password);
$setups = modules_enumerate_files( MODULES, '_db_setup.php' );

## Create an array of setup objects.
foreach($setups as $module=>$include) {
  include($include);
  $class = $module.'_db_setup';
  $setup_objects[ $module ] = new $class( $db );
}

## Call config_setup() on all the setup objects.
try { 
  foreach( $setup_objects as $module=>$object )
    $object->config_setup();
} catch (PDOException $e) {
  print $e->getMessage();
} catch (Exception $e) {
  print $e->getMessage();
}


