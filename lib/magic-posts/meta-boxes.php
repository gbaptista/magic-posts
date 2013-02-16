<?php

include_once('helpers/meta-boxes.php');

Magic_Posts::instance()->inject(

  'save_meta_boxes', function() {

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

      if(preg_match("/^$field_prefix-m-p-/", $name)) {

        $name = '_'.str_replace($field_prefix.'-', '', $name);
        //$value = sanitize_text_field($value);

        if(!add_post_meta($_POST['post_ID'], $name, $value, true))
          update_post_meta($_POST['post_ID'], $name, $value);

      }

    }

  }

);

Magic_Posts::instance()->inject(

  'meta_boxes', function() {

    foreach (Magic_Posts::instance()->custom_fields as $post_type) {

      // Current post-type:
      if(!empty($_GET['post_type']))  $current_post_type = $_GET['post_type'];
      elseif(!empty($_GET['post']))   $current_post_type = get_post_type($_GET['post']);

      // Just load if needed:
      if($current_post_type == $post_type[0])
      {

        Magic_Posts::instance()->current_custom_fields = $post_type[1];

        foreach($post_type[1] as $field) {
          Magic_Posts::instance()->meta_box(
            $post_type[0], $field[0], $field[1]
          );
        }

      }

    }

  }

);

Magic_Posts::instance()->inject(

  'meta_box', function($post_type, $field, $type) {

    if(!in_array($type, Magic_Posts::instance()->meta_box_types))
      return NULL;

    $meta_box = sanitize_title($field . ' '. $type);

    add_meta_box(
      $meta_box,
      __($field.':'),
      'Magic_Posts_Meta_Box',
      $post_type, 'advanced', 'default', array(
        'post_type' => $post_type,
        'field'     => $field,
        'type'      => $type,
        'meta_box'  => $meta_box
      )
    );

  }

);