<?php

if(!class_exists('Magic_Posts')) {

  class Magic_Posts {

    public $meta_box_types = array(
      'string', 'text', 'editor', 'mini-editor', 'image', 'gallery'
    );

    public $meta_box_types_images = array(
      'image', 'gallery'
    );

    public $custom_posts_supports = array(
      'title'           => TRUE,
      'editor'          => FALSE,
      'author'          => FALSE,
      'thumbnail'       => FALSE,
      'excerpt'         => FALSE,
      'trackbacks'      => FALSE,
      'custom-fields'   => FALSE,
      'comments'        => FALSE,
      'revisions'       => FALSE,
      'page-attributes' => FALSE,
      'post-formats'    => FALSE
    );

    public $metas = array();

    private static $instance;

    public static function instance()
    {
      if(!isset(self::$instance)) self::$instance = new self();
      return self::$instance;
    }

    private function __construct() {}

    public $custom_fields = array();
    public $current_custom_fields = array();

    public function init_custom_posts()
    {

      function custom_posts() {
        Magic_Posts::instance()->custom_posts();
      } add_action('init', 'custom_posts');

    }

    public function site() { $this->init_custom_posts(); }

    public function admin()
    {

      $this->admin_menu();

      $this->init_custom_posts();

      function meta_boxes() {
        Magic_Posts::instance()->meta_boxes();
      } add_action('add_meta_boxes', 'meta_boxes');

      function save_meta_boxes($id) {
        Magic_Posts::instance()->save_meta_boxes($id);
      } add_action('save_post', 'save_meta_boxes');

      function magic_posts_enqueue() {

        // Fix for Windows...
        if(preg_match('/\//', dirname(__FILE__))) $dir = array_reverse(explode('/', dirname(__FILE__)));
        else $dir = array_reverse(explode('\\', dirname(__FILE__)));

        if($dir[1] == 'trunk') $dir[1] = $dir[2];

        wp_register_script('magic-posts-js', plugins_url($dir[1].'/js/magic-posts-js.php?v=0.0.6'));
        wp_enqueue_script('magic-posts-js');

        wp_register_style('magic-posts-css', plugins_url($dir[1].'/css/magic-posts.css?v=0.0.6'));
        wp_enqueue_style('magic-posts-css');

      } add_action('admin_enqueue_scripts', 'magic_posts_enqueue');

      function magic_posts_links($links, $file) {
        if(basename($file) == basename(__FILE__)) {
          array_push($links, '<a href="' . site_url() . '/wp-admin/options-general.php?page=magic-posts-settings">Settings</a>');
          array_push($links, '<a target="_blank" href="https://github.com/gbaptista/magic-posts#readme">Help</a>');
        }
        return $links;
      } add_filter('plugin_action_links', 'magic_posts_links', 10, 2);

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
        case 4:   return $this->_methods[$name]($args[0], $args[1], $args[2], $args[3]);
        default:  return $this->_methods[$name]();
      }

    }

  }

  // Plugin
  if(function_exists('is_admin')) {

    require_once('magic-posts/dangerous.php');
    require_once('magic-posts/strings.php');
    require_once('magic-posts/images.php');
    require_once('magic-posts/scaffolds.php');
    require_once('magic-posts/custom-posts.php');

    // Admin
    if(is_admin()) {

      require_once('magic-posts/migrations.php');
      require_once('magic-posts/settings.php');
      require_once('magic-posts/meta-boxes.php');

      Magic_Posts::instance()->admin();

    }

    // Site
    else {

      require_once('magic-posts/retrieve-meta.php');

      function magic_posts($key, $force_id=NULL) {
        return Magic_Posts::instance()->retrieve_meta($key, $force_id);
      }

      Magic_Posts::instance()->site();

    }

  }

}