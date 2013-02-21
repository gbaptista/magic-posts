<?php

require_once('helpers/meta-boxes.php');

Magic_Posts::instance()->inject(

  'save_meta_boxes', function()
  {

    if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return NULL;

    $plugin_folder = preg_replace('/lib\/magic-posts.*/', '', plugin_basename(__FILE__));

    if(
      !isset($_POST['magic_posts_data'])
      ||
      !wp_verify_nonce($_POST['magic_posts_data'], $plugin_folder)
    ) return NULL;

    if('page' == $_POST['post_type']) {
      if(!current_user_can('edit_page', $post_id)) return NULL;
    } else {
      if(!current_user_can('edit_post', $post_id)) return NULL;
    }

    $field_prefix = wp_create_nonce($plugin_folder);

    foreach($_POST as $name => $value) {

      if(preg_match("/^$field_prefix" . Magic_Posts::instance()->meta_prefix() . "\{/", $name)) {

        $name = '_'.str_replace($field_prefix.'_', '', $name);

        if(!add_post_meta($_POST['post_ID'], $name, $value, true))
          update_post_meta($_POST['post_ID'], $name, $value);

      }

    }

  }

);

Magic_Posts::instance()->inject(

  'meta_boxes', function()
  {

    foreach (Magic_Posts::instance()->custom_fields as $post_type) {

      // [todo] I think... We have a performance problem in this code...
      //        We are checking get_post_type thousand times!

      $prefix = Magic_Posts::instance()->prefix();

      // Current post-type:
      if($post_type[0] == $prefix.'post' || $post_type[0] == $prefix.'page') {

        if(!empty($_GET['post_type'])) 
          $force_post_type = $_GET['post_type'];

        elseif(!empty($_GET['post']))
          $force_post_type = get_post_type($_GET['post']);

        elseif(basename($_SERVER['REQUEST_URI'], '.php') == 'post-new')
          $force_post_type = 'post';

        $current_post_type = $prefix . $force_post_type;

      } elseif(preg_match('/' . $prefix . '[0-9]{1,}/', $post_type[0])) {

        $current_post_type = $prefix . $_GET['post'];

        if(!empty($_GET['post_type']))
          $force_post_type = $_GET['post_type'];

        elseif(!empty($_GET['post']))
          $force_post_type = get_post_type($_GET['post']);

      } else {

        if(!empty($_GET['post_type']))
          $current_post_type = $_GET['post_type'];

        elseif(!empty($_GET['post']))
          $current_post_type = get_post_type($_GET['post']);

        $force_post_type = NULL;

      }

      // Just load if needed:
      if($current_post_type == $post_type[0]) {

        Magic_Posts::instance()->current_custom_fields = $post_type[1];

        foreach($post_type[1] as $field) {
          Magic_Posts::instance()->meta_box(
            $post_type[0], $field[0], $field[1], $force_post_type
          );
        }

      }

    }

  }

);

Magic_Posts::instance()->inject(

  'meta_box', function($post_type, $field, $type, $force_post_type=NULL)
  {

    if(!in_array($type, Magic_Posts::instance()->meta_box_types))
      return NULL;

    $meta_box = Magic_Posts::instance()->field($field, $type);

    $meta_box_name = Magic_Posts::instance()->to_slug('m-p-'.$field.'-'.$type);

    if($force_post_type)
      $post_type_set = $force_post_type;
    else
      $post_type_set = $post_type;

    add_meta_box(
      $meta_box_name, $field, 'Magic_Posts_Meta_Box',
      $post_type_set, 'advanced', 'default',
      array(
        'post_type' => $post_type,
        'field'     => $field,
        'type'      => $type,
        'meta_box'  => $meta_box
      )
    );

  }

);