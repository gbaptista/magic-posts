<?php

Magic_Posts::instance()->inject(
  
  'custom_posts', function() {

    $scaffolds = Magic_Posts::instance()->scaffolds(stripslashes(get_option('magic-posts_scaffolds')));

    Magic_Posts::instance()->custom_fields = array();

    foreach($scaffolds as $scaffold) {
      Magic_Posts::instance()->custom_post($scaffold['title'], $scaffold['fields']);
    }

  }

);

Magic_Posts::instance()->inject(

  'custom_post', function($title, $fields) {
  
    /*
     * Supports:
     * title, editor, author, thumbnail,
     * excerpt, trackbacks, custom-fields,
     * comments, revisions, page-attributes,
     * post-formats
     *
    */

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

    Magic_Posts::instance()->custom_fields[] = array($post_type, $fields);

  }

);