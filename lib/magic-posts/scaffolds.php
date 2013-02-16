<?php

Magic_Posts::instance()->inject(

  'scaffolds', function($scaffolds_texts) {

    if(empty($scaffolds_texts)) return FALSE;

    $scaffolds_texts = explode("\n", $scaffolds_texts);

    $scaffolds = array();

    foreach($scaffolds_texts as $scaffolds_text) {
      $scaffold = Magic_Posts::instance()->scaffold(trim($scaffolds_text));
      if($scaffold) $scaffolds[] = $scaffold;
    }

    return $scaffolds;

  }

);

Magic_Posts::instance()->inject(

  'scaffold', function($scaffold) {

    if(empty($scaffold)) return FALSE;

    $title = preg_split('/\s{1,}/', $scaffold);
    $title = $title[0];

    $fields = array();

    $scaffold = preg_replace("/^$title\s{1,}/", '', $scaffold);
    preg_match_all('/\'.*?\':\S{1,}|".*?":\S{1,}|\S{1,}:\S{1,}/', $scaffold, $fields_ar);

    foreach($fields_ar as $fields_m) {

      foreach ($fields_m as $field) {

        $field = explode(':', $field);

        if(preg_match('/^\'.*\'$/', $field[0]))
          $field[0] = preg_replace('/^\'|\'$/', '', $field[0]);

        elseif(preg_match('/^".*"$/', $field[0]))
          $field[0] = preg_replace('/^"|"$/', '', $field[0]);

        $fields[] = $field;

      }

    }

    return array('title' => $title, 'fields' => $fields);

  }

);