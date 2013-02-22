<?php

Magic_Posts::instance()->inject(

  'scaffolds', function($scaffolds_texts)
  {

    if(empty($scaffolds_texts)) return FALSE;

    $scaffolds_texts = explode("\n", $scaffolds_texts);

    $scaffolds = array();

    foreach($scaffolds_texts as $scaffolds_text) {
      $scaffold = Magic_Posts::instance()->scaffold($scaffolds_text);
      if($scaffold) $scaffolds[] = $scaffold;
    }

    return $scaffolds;

  }

);

Magic_Posts::instance()->inject(

  'scaffold', function($scaffold)
  {

    $scaffold = trim($scaffold);

    if(empty($scaffold) || preg_match('/^#|^\/\//', $scaffold)) return FALSE;

    if(preg_match_all('/\[.*?\]/', $scaffold, $replaces))
    {
      foreach ($replaces as $replace_match) {
        foreach ($replace_match as $replace) {
          $scaffold = str_replace($replace, preg_replace('/\s{1,}/', '', $replace), $scaffold);
        }
      }
    }

    preg_match('/\'.*\'\s|\".*\"\s/', $scaffold, $title);
    if(empty($title)) $title = preg_split('/\s{1,}/', $scaffold);

    $title = trim($title[0]);

    $scaffold = preg_replace("/^$title\s{1,}/", '', $scaffold);

    $title = Magic_Posts::instance()->trim_quotes($title);

    $fields = array();

    preg_match_all('/\'.*?\':\S{1,}|".*?":\S{1,}|\S{1,}:\S{1,}/', $scaffold, $fields_ar);

    foreach($fields_ar as $fields_m) {

      foreach ($fields_m as $field) {

        $field = explode(':', $field);

        $field[0] = Magic_Posts::instance()->trim_quotes($field[0]);

        if(count($field) > 2) {
          $field = array(
            $field[0], implode(':', array_slice($field, 1, count($field)-1))
          );
        }

        if(preg_match('/\[.*\]/', $field[1], $options)) {

          $field[1] = str_replace($options[0], '', $field[1]);
          $field[2] = preg_replace('/^\[|\]$/', '', $options[0]);

          if(in_array($field[1], Magic_Posts::instance()->meta_box_types_images))
            Magic_Posts::instance()->image_sizes($field[2]);

        }

        $fields[] = $field;

      }

    }

    return array('title' => $title, 'fields' => $fields);

  }

);