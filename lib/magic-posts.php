<?php

if(!class_exists('Magic_Posts')) {

  class Magic_Posts {

    private static $instance;

    public static function instance()
    {
      if(!isset(self::$instance)) self::$instance = new self();
      return self::$instance;
    }

    private function __construct() {}

    public $custom_fields = array();

    public function admin()
    {

      $this->admin_menu();

      function custom_posts() {
        Magic_Posts::instance()->custom_posts();
      } add_action('init', 'custom_posts');

      function meta_boxes() {
        Magic_Posts::instance()->meta_boxes();
      } add_action('add_meta_boxes', 'meta_boxes');

    }

    // Inject Methods
    private $_methods = array();
    public function inject($name, $function){ $this->_methods[$name]=$function; }

    public function __call($name, $args)
    {
      switch (count($args)) {
        case 1:   return $this->_methods[$name]($args[0]);
        case 2:   return $this->_methods[$name]($args[0], $args[1]);
        case 3:   return $this->_methods[$name]($args[0], $args[1], $args[2]);
        default:  return $this->_methods[$name]();
      }
    }

  }

  // Admin
  if(function_exists('is_admin') && is_admin())
  {

    require_once('magic-posts/settings.php');
    require_once('magic-posts/scaffolds.php');
    require_once('magic-posts/custom-posts.php');
    require_once('magic-posts/meta-boxes.php');
    Magic_Posts::instance()->admin();

  }

}