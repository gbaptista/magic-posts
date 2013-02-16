<?php

Magic_Posts::instance()->inject(

  'meta_boxes', function() {

    foreach (Magic_Posts::instance()->custom_fields as $post_type) {
      foreach($post_type[1] as $field) {
        Magic_Posts::instance()->meta_box(
          $post_type[0], $field[0], $field[1]
        );
      }
    }

  }

);

Magic_Posts::instance()->inject(

  'meta_box', function($post_type, $field, $type) {

    add_meta_box(
      sanitize_title($field . ' '. $type),
      __($field.':'),
      'post_custom_meta_box',
      $post_type
    );

  }

);