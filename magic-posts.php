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

  # phpunit tests/magic-posts-tests.php

  class Magic_Posts {

    private static $instance;

    private $custom_fields = array();

    public static function getInstance($test=FALSE)
    {
      if(!isset(self::$instance)) self::$instance = new self($test);
      return self::$instance;
    }

    private function __construct($test)
    {

      if(!$test)
      {

        if(is_admin()) $this->admin_menu();

        function build_custom_posts() {
          Magic_Posts::getInstance()->build_custom_posts();
        } add_action('init', 'build_custom_posts');

        function build_custom_meta_boxes() {
          Magic_Posts::getInstance()->build_custom_meta_boxes();
        } add_action('add_meta_boxes', 'build_custom_meta_boxes');

      }
    }

    public function build_custom_posts()
    {

      $scaffolds = stripslashes(get_option('magic-posts_scaffolds'));

      $scaffolds = explode("\n", $scaffolds);

      $this->custom_fields = array();

      foreach($scaffolds as $scaffold) {
        $scaffold = $this->process_scaffold(trim($scaffold));
        if($scaffold) $this->add_custom_post($scaffold['title'], $scaffold['fields']);
      }

    }

    public function process_scaffold($scaffold)
    {

      if(empty($scaffold)) return FALSE;

      $title = preg_split('/\s{1,}/', $scaffold);

      $title = $title[0];

      $fields = array();
      
      $scaffold = preg_replace("/^$title\s{1,}/", '', $scaffold);

      preg_match_all('/\'.*?\':\S{1,}|".*?":\S{1,}|\S{1,}:\S{1,}/', $scaffold, $fields_ar);

      foreach($fields_ar as $fields_m) {

        foreach ($fields_m as $field) {

          $field = explode(':', $field);

          if(preg_match('/^\'.*\'$/', $field[0])) $field[0] = preg_replace('/^\'|\'$/', '', $field[0]);
          elseif(preg_match('/^".*"$/', $field[0])) $field[0] = preg_replace('/^"|"$/', '', $field[0]);

          $fields[] = $field;

        }

      }

      return array('title' => $title, 'fields' => $fields);

    }

    private function add_custom_post($title, $fields)
    {

      $post_type = substr('m-p-'.sanitize_title($title), 0, 20);

      register_post_type(
        $post_type,
        array(
          'labels' => array(
            'name' => __( $title.'s' ),
            'singular_name' => __( $title )
          ),
          'supports' => array(FALSE),
          'public' => true,
          'has_archive' => true,
        )
      );

      $this->custom_fields[] = array($post_type, $fields);

      /*
       * Supports:
       * title, editor, author, thumbnail,
       * excerpt, trackbacks, custom-fields,
       * comments, revisions, page-attributes,
       * post-formats
       *
       */

    }

    public function build_custom_meta_boxes()
    {
      foreach ($this->custom_fields as $post_type) {
        foreach($post_type[1] as $field) {
          $this->add_custom_meta_boxes($post_type[0], $field[0], $field[1]);
        }
      }
    }

    private function add_custom_meta_boxes($post_type, $field, $type)
    {
      add_meta_box(
        sanitize_title($field . ' '. $type),
        __($field.':'),
        'post_custom_meta_box',
        $post_type
      );
    }

    private function admin_menu()
    {

      function magic_posts_options() {
        if (!current_user_can('manage_options'))
          wp_die(__('You do not have sufficient permissions to access this page.'));
        else
        {
          include_once('admin-options/controller.php');
          include_once('admin-options/view.php');
        }
      }

      function magic_posts_menu() {
        add_options_page('Magic Posts Options', 'Magic Posts', 'manage_options', 'magic-posts-options', 'magic_posts_options');
      }

      add_action('admin_menu', 'magic_posts_menu');

    }

  }

  if(empty($Magic_Posts_Test))
  {
    function Magic_Posts() { return Magic_Posts::getInstance(); }
    add_action('plugins_loaded', 'Magic_Posts');
  }

}