<?php

/*
Plugin Name: Magic Posts
Plugin URI: http://wordpress.org/extend/plugins/magic-posts/
Description: Coming soon...
Version: 0.1
Author: Guilherme Baptista
Author URI: http://gbaptista.com
License: MIT
*/

if(!class_exists('Magic_Posts')) {

  class Magic_Posts {

    private static $instance;

    public static function getInstance()
    {
      if(!isset(self::$instance)) self::$instance = new self;
      return self::$instance;
    }

    private function __construct()
    {

      $this->admin_menu();

    }

    private function admin_menu()
    {

      function magic_posts_options() {
        if (!current_user_can('manage_options'))
          wp_die(__('You do not have sufficient permissions to access this page.'));
        else
          include_once('magic-posts-options.php');
      }

      function magic_posts_menu() {
        add_options_page( 'Magic Posts Options', 'Magic Posts', 'manage_options', 'magic-posts-options', 'magic_posts_options' );
      }

      add_action('admin_menu', 'magic_posts_menu');

    }

  }

  function Magic_Posts() { return Magic_Posts::getInstance(); }
  add_action('plugins_loaded', 'Magic_Posts');

}