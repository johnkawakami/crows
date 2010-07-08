<?php
class db_setup {
  public function __construct( $db ) {
    $this->db =& $db;
  }
  public function config_add_column( $name, $type ) {
    $sql = "ALTER TABLE config ADD COLUMN `$name` $type";
    try {
      if (! $this->db->query($sql) ) {
        $error = $this->db->errorInfo();
        switch($error[0]) {
          case '42S21': // duplicate column
            break;
          default:
            echo $error[2];
            break;
        }
      }
    } catch(Exception $e) {
      echo $e->getMessage();
    }
  }
  function config_setup() { }
}
