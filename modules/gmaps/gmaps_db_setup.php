<?php
// this should be called by admin/db_setup.php
class gmaps_db_setup extends db_setup {
  public function config_setup() {
    $this->config_add_column( 'map_key', 'VARCHAR(90)' );
    $this->config_add_column( 'default_map_type', 'VARCHAR(30)' );
    $this->config_add_column( 'latitude', 'DOUBLE' );
    $this->config_add_column( 'longitude', 'DOUBLE' );
    $this->config_add_column( 'zoom', 'INT(4)' );
  }
}
