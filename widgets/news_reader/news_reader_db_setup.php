<?php
// this should be called by admin/db_setup.php
class news_db_setup extends db_setup {
  public function config_setup() {
    $this->config_add_column( 'news_feed_url', 'VARCHAR(255)' );
  }
}
