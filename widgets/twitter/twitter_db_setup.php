<?php
// this should be called by admin/db_setup.php
class twitter_db_setup extends db_setup {
  public function config_setup() {
    $this->config_add_column( 'hashtags', 'VARCHAR(255)' );
    $this->config_add_column( 'twitter_account', 'VARCHAR(255)' );
    $this->config_add_column( 'twitter_ttl', 'VARCHAR(255)' );
  }
}
