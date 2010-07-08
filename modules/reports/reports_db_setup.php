<?php
// this should be called by admin/db_setup.php
class reports_db_setup extends db_setup {
  var $db;
  public function __construct($db) {
    $this->db =& $db; 
  }
  public function db_setup() {
    $sql = array(
      'sqlite' => 
          'CREATE TABLE reports (
          id INTEGER PRIMARY KEY, 
          date STRING, 
          title STRING, 
          name STRING, 
          location STRING, 
          lat STRING, 
          long STRING, 
          report STRING, 
          link STRING, 
          photo STRING, 
          embed STRING
          )',
        'mysql' => 
          'CREATE TABLE reports (
          id INT(11) PRIMARY KEY AUTO_INCREMENT, 
          title VARCHAR(255), 
          name VARCHAR(255), 
          date DATETIME, 
          location VARCHAR(255), 
          lat VARCHAR(30), 
          `long` VARCHAR(30), 
          report TEXT, 
          link TEXT, 
          photo VARCHAR(255), 
          embed TEXT,
          INDEX (name)
          )'
    );
    // run the query
    global $database_type;
    $st = $this->db->query($sql[$database_type]);
    if ($st == false) {
      $error = $this->db->errorInfo();
      print_r($error);
    }
    print '<p>reports_db_setup::db_setup';
  }
  public function db_upgrade() {
    // check state of column
    // alter column
    // add column
    // remove column
  }
}
