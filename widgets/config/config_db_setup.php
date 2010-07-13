<?php
class config_db_setup extends db_setup {
  function db_setup() {
    $sql = 'IF NOT EXIST CREATE TABLE `la_indymedia_org_crows`.`config` (
      `id` INT(11)  NOT NULL AUTO_INCREMENT,
      PRIMARY KEY (`id`)';
    $this->db->query($sql);
    print '<p>config_db_setup::db_setup</p>';
  }
  public function config_setup() {
    $this->config_add_column( 'page_title', 'VARCHAR(255)' );
    $this->config_add_column( 'page_description', 'VARCHAR(255)' );
    $this->config_add_column( 'contact_email', 'VARCHAR(255)' );
    $this->config_add_column( 'logo_url', 'VARCHAR(255)' );
    $this->config_add_column( 'trim_background_color', 'VARCHAR(8)' );
    $this->config_add_column( 'trim_font_color', 'VARCHAR(8)' );
    $this->config_add_column( 'background_image', 'VARCHAR(255)' );
    $this->config_add_column( 'background_color', 'VARCHAR(8)' );
    $this->config_add_column( 'top_left_width', 'VARCHAR(5)' );
    $this->config_add_column( 'top_left_heading', 'VARCHAR(255)' );
    $this->config_add_column( 'top_left_html', 'VARCHAR(255)' );
    $this->config_add_column( 'top_center_width', 'VARCHAR(5)' );
    $this->config_add_column( 'top_center_heading', 'VARCHAR(255)' );
    $this->config_add_column( 'top_center_html', 'VARCHAR(255)' );
    $this->config_add_column( 'top_right_width', 'VARCHAR(5)' );
    $this->config_add_column( 'top_right_heading', 'VARCHAR(255)' );
    $this->config_add_column( 'top_right_html', 'VARCHAR(255)' );
  } 
}
