<?php
// this should be called by admin/db_setup.php
class podcast_db_setup extends db_setup {
  public function config_setup() {
    $this->config_add_column( 'podcast_feed_url', 'VARCHAR(255)' );
    $this->config_add_column( 'podcast_ttl', 'INT(5)' );
  }
}
