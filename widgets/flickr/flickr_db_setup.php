<?php
// this should be called by admin/db_setup.php
class flickr_db_setup extends db_setup {
  public function config_setup() {
    $this->config_add_column( 'flickr_api_key', 'VARCHAR(80)' );
    $this->config_add_column( 'flickr_photos_per_page', 'INT(8)' );
    $this->config_add_column( 'flickr_mode', 'VARCHAR(80)' );
    $this->config_add_column( 'flickr_sortby', 'VARCHAR(80)' );
    $this->config_add_column( 'flickr_tags', 'VARCHAR(80)' );
    $this->config_add_column( 'flickr_tag_mode', 'VARCHAR(80)' );
    $this->config_add_column( 'flickr_photoset_id', 'VARCHAR(80)' );
    $this->config_add_column( 'flickr_favorites_user_id', 'VARCHAR(80)' );
    $this->config_add_column( 'flickr_ttl', 'VARCHAR(80)' );
  }
}
