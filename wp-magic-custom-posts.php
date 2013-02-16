<?php

/*
Plugin Name: WP-Magic-Custom-Posts
Plugin URI: http://wordpress.org/extend/plugins/wp-magic-custom-posts/
Description: Coming soon...
Version: 0.1
Author: Guilherme Baptista
Author URI: http://gbaptista.com
License: MIT
*/

if(!class_exists('WP_Magic_Custom_Posts')) {

  class WP_Magic_Custom_Posts {

    private static $instance;

    public static function getInstance() {
      if(!isset(self::$instance)) self::$instance = new self;
      return self::$instance;
    }

    private function __construct() {}

  }

  function WP_Magic_Custom_Posts() { return WP_Magic_Custom_Posts::getInstance(); }
  add_action('plugins_loaded', 'WP_Magic_Custom_Posts');

}