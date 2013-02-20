<?php

Magic_Posts::instance()->inject(

  'migrate_post_type', function($from, $to) {

    global $wpdb;

    return $wpdb->query(
      $wpdb->prepare(
        "UPDATE $wpdb->posts SET post_type = %s WHERE post_type = %s",
        Magic_Posts::instance()->post_type($to),
        Magic_Posts::instance()->post_type($from)
      )
    );

  }

);

Magic_Posts::instance()->inject(

  'migrate_field', function($post_type, $from, $to) {

    global $wpdb;

    if(preg_match('/^\[[0-9]{1,}\]$/', $post_type))
    {
      $posts = $wpdb->get_results($wpdb->prepare(
        "SELECT ID FROM $wpdb->posts WHERE ID = %d",
        Magic_Posts::instance()->trim_chars($post_type, '[', ']')
      ));
    }
    elseif($post_type == '[post]' || $post_type == '[page]')
    {
      $posts = $wpdb->get_results($wpdb->prepare(
        "SELECT ID FROM $wpdb->posts WHERE post_type = %s",
        Magic_Posts::instance()->trim_chars($post_type, '[', ']')
      ));
    }
    else
    {
      $posts = $wpdb->get_results($wpdb->prepare(
        "SELECT ID FROM $wpdb->posts WHERE post_type = %s",
        Magic_Posts::instance()->post_type($post_type)
      ));
    }

    foreach($posts as $post) {
      $wpdb->query(
        $teste = $wpdb->prepare("
          UPDATE $wpdb->postmeta
          SET meta_key = REPLACE(meta_key, %s, %s)
          WHERE meta_key LIKE %s
          ",
          '_m-p' . Magic_Posts::instance()->field($from),
          '_m-p' . Magic_Posts::instance()->field($to),
          '_m-p' . Magic_Posts::instance()->field($from) . '%'
        )
      );
    }

  }

);

Magic_Posts::instance()->inject(

  'migration', function($migration) {

    $migration = trim($migration);

    if(empty($migration) || preg_match('/^#|^\/\//', $migration)) return FALSE;

    // Post Types
    if(
      preg_match('/^\[.*\]$/', $migration)
      &&
      !preg_match('/^\[[0-9]{1,}\]|^\[\w{1,}\]/', $migration)
    )
    {
      
      $migration = Magic_Posts::instance()->trim_chars($migration, '[', ']');
      $post_types = array();
      foreach(explode(',', $migration) as $post_type) {
        $post_type = explode('=>', $post_type);
        $post_types[] = array(
          'from'  => Magic_Posts::instance()->trim_quotes($post_type[0]),
          'to'    => Magic_Posts::instance()->trim_quotes($post_type[1]),
        );
      }
      
      return $post_types;

    // Deeper...
    } else {

      $tmp_migration = $migration;

      if(preg_match_all('/\[.*?\]/', $tmp_migration, $replaces))
      {
        foreach ($replaces as $replace_match) {
          foreach ($replace_match as $replace) {
            if(!preg_match('/^\[[0-9]{1,}\]|^\[\w{1,}\]/', $replace))
              $tmp_migration = str_replace($replace, preg_replace('/\s{1,}/', '', $replace), $tmp_migration);
          }
        }
      }

      preg_match('/\'.*\'\s|\".*\"\s/', $tmp_migration, $title);
      if(empty($title)) $title = preg_split('/\s{1,}/', $tmp_migration);

      $title = trim($title[0]);

      $title_reg = str_replace('[', '\[', $title);
      $title_reg = str_replace(']', '\]', $title_reg);

      $migration = preg_replace("/^$title_reg\s{1,}/", '', $migration);

      $title = Magic_Posts::instance()->trim_quotes($title);

      $migration = trim($migration);

      // Post Type
      if(!preg_match('/^\[|\]$/', $migration))
      {

        return array(array('from' => $title, 'to' => Magic_Posts::instance()->trim_quotes(str_replace('=>', '', $migration))));

      }

      // Fields
      else
      {

        $migration = preg_replace('/^\[|\]$/', '', $migration);

        $fields = array();

        foreach(explode(',', $migration) as $field) {
          $field = explode('=>', $field);
          $fields[] = array(
            'from'  => Magic_Posts::instance()->trim_quotes($field[0]),
            'to'    => Magic_Posts::instance()->trim_quotes($field[1])
          );
        }

        return array('post_type' => $title, 'fields' => $fields);

      }

    }

  }

);

Magic_Posts::instance()->inject(

  'migrations', function($migrations_texts) {
    
    if(empty($migrations_texts)) return FALSE;

    $migrations_texts = explode("\n", $migrations_texts);

    foreach($migrations_texts as $migrations_text) {
      Magic_Posts::instance()->migrate(Magic_Posts::instance()->migration($migrations_text));
    }

    return TRUE;

  }

);

Magic_Posts::instance()->inject(

  'migrate', function($migration) {

    if($migration)
    {
      if(isset($migration['fields']))
      {
        foreach ($migration['fields'] as $field)
          Magic_Posts::instance()->migrate_field($migration['post_type'], $field['from'], $field['to']);
      } else {
        foreach ($migration as $post_type)
          Magic_Posts::instance()->migrate_post_type($post_type['from'], $post_type['to']);
      }
    }

  }

);