<?php

// script that scans the configs table and
// produces some PHP code that can be inserted
// into the setup_config() method.
// The setup_config() method adds columns to config, and
// specifies what control will set the column's value.

include_once('../config.php');

$db = new PDO($database_dsn, $database_user, $database_password);

function get_config_meta() {
  global $db;
  $stm = $db->query('DESCRIBE config');
  $o = '';
  foreach($stm as $row) {
    $field = $row['Field'];
    $type = $row['Type'];
    // varchar
    if (strpos($type, 'varchar') == 0) {
      $control = 'textfield';
      if (strpos($field, 'color')) $control = 'colorpicker';
    } else if (strpos($type,'int') == 0) {
      $control = 'textfield';
    } else if (strpos($type,'double') == 0) {
      $control = 'textfield';
    }
    $o .= "    \$this->admin_add_field(   '$field', 'layout', '$control' );\n";
  }
  return $o;
}

$code = get_config_meta();

?><html>
<body>
<pre><?=$code?></pre>
</body>
</html>
