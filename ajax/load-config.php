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

$sth = $dbc->prepare('SELECT * FROM config WHERE id=?');
$result = $sth->execute(array($config_id));
$arr = $sth->fetchAll(PDO::FETCH_ASSOC);

// Possible problem - json_encode treats all data
// as strings.
$data = array( 'success'=>true, 'data'=>$arr[0] );
echo json_encode($data);
