<?php
// this should be called by admin/db_setup.php
class youtube_db_setup extends db_setup {
  public function config_setup() {
    $this->config_add_column( 'youtube_mode', 'VARCHAR(20)' );
    $this->config_add_column( 'youtube_user', 'VARCHAR(80)' );
    $this->config_add_column( 'youtube_keywords', 'VARCHAR(255)' );
    $this->config_add_column( 'youtube_orderby', 'VARCHAR(30)' );
    $this->config_add_column( 'youtube_ttl', 'INT(5)' );
  }
}
