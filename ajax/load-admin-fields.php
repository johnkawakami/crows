<?php

include_once('../config2.php');

// assume that some login process put the user's config_id
// into the session array. -johnk
session_start();
if (isset($_SESSION['config_id'])) {
  $config_id = $_SESSION['config_id'];
} else {
  $config_id = 0;
  // it should really fail at this point - user has no session.
}

// load up the current config.
$sth = $dbc->prepare('SELECT * FROM config WHERE id=?');
$result = $sth->execute(array($config_id));
$arr = $sth->fetchAll(PDO::FETCH_ASSOC);
$fields = $arr[0];

// load up all the admin_fields
$sth = $dbc->query('SELECT * FROM admin_fields');

// now join the config values with the admin fields
while( $row = $sth->fetch(PDO::FETCH_ASSOC) ) {
  // how to check for bad field names?  how to report?
  $row['value'] = $fields[$row['name']];
  $admin_fields[] = $row;
}

echo json_encode( array( 'success'=>true, 'data'=>$admin_fields ) );

