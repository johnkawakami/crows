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

// Compare the POST values, and fail if they don't
// all have a corresponding field in the config table.
foreach( $_POST as $key=>$value ) {
  if (!array_key_exists( $key, $fields )) 
    return_failure();
}

// Set the config fields.
foreach( $_POST as $key=>$value ) {
  $sth = $dbc->prepare("UPDATE config SET `$key`=?");
  $result = $sth->execute(array($value));
  if (!$result) {
    $error = $sth->errorInfo();
    // how do i return an error message -johnk
    //echo $error[2]." for $key set to $value.<br />";
  }
}

echo json_encode( array( 'success'=>true ) );

function return_failure() {
  $data = array( 'success'=>false );
  echo json_encode($data);
  exit;
}
