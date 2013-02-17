<?php

Magic_Posts::instance()->inject(
  
  'custom_posts', function() {

    $scaffolds = Magic_Posts::instance()->scaffolds(stripslashes(get_option('magic-posts_scaffolds')));

    Magic_Posts::instance()->custom_fields = array();

    if(!empty($scaffolds)) {
      foreach($scaffolds as $scaffold) {
        Magic_Posts::instance()->custom_post($scaffold['title'], $scaffold['fields']);
      }
    }

  }

);

Magic_Posts::instance()->inject(

  'custom_post', function($title, $fields) {

    $post_type = substr('m-p-'.sanitize_title($title), 0, 20);

    if(!preg_match('/\[[0-9]{1,}\]/', $title) && $title != '[post]' && $title != '[page]')
    {

      # [todo] Smart pluralize and l18n.
      $singular = $title;
      $plural   = $title.'s';
      $labels = array(
        'name'                => __($plural),
        'singular_name'       => __($singular),
        'add_new'             => __('Add New'),
        'add_new_item'        => __('Add New '.$singular),
        'edit_item'           => __('Edit '.$singular),
        'new_item'            => __('New '.$singular),
        'all_items'           => __('All '.$plural),
        'view_item'           => __('View '.$singular),
        'search_items'        => __('Search '.$plural),
        'not_found'           => __('No '.$plural.' found'),
        'not_found_in_trash'  => __('No '.$plural.' found in Trash'),
        'parent_item_colon'   => __(''),
        'menu_name'           => __($plural)
      );

      $supports_ar = Magic_Posts::instance()->custom_posts_supports;

      foreach($fields as $support) {
        if(isset($supports_ar[$support[0]]))
          $supports_ar[$support[0]] = $support[1];
      }

      $supports = array();

      foreach ($supports_ar as $support => $value) {
        if(!empty($value) && $value !== 'false') $supports[] = $support;
      }

      register_post_type(
        $post_type,
        array(
          'labels'      => $labels,
          'supports'    => $supports,
          'public'      => true,
          'has_archive' => true,
        )
      );

    }

    Magic_Posts::instance()->custom_fields[] = array($post_type, $fields);

  }

);