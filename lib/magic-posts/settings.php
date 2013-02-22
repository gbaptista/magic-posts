<?php

Magic_Posts::instance()->inject(

  'admin_menu', function()
  {

    function magic_posts_settings() {  
      if(!current_user_can('manage_options'))
        wp_die(__('You do not have sufficient permissions to access this page.'));
      else {
        require_once('settings/controller.php');
        require_once('settings/view.php');
      }
    }

    function magic_posts_menu() {
      add_options_page(
        'Magic Posts Settings', 'Magic Posts',
        'manage_options', 'magic-posts-settings', 'magic_posts_settings'
      );
    } add_action('admin_menu', 'magic_posts_menu');

  }

);