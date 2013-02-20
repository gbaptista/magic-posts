<?php

Magic_Posts::instance()->inject(

  'pluralize', function($string, $lang) {

    include_once('inflector/magic_posts_inflector.php');

    return Magic_Posts_Inflector::instance()->pluralize($string, $lang);

  }

);

Magic_Posts::instance()->inject(

  'trim_char', function($string, $chars) {

    $string = trim($string);

    foreach($chars as $char) {
      if(!is_array($char)) $char = array($char, $char);
      $match = '/^\\' . $char[0] . '.*\\' . $char[1] . '$/';
      $replace = '/^\\' . $char[0] . '|\\' . $char[1] . '$/';
      if(preg_match($match, $string)) return $string = trim(preg_replace($replace, '', $string));
    }

    return $string;

  }

);

Magic_Posts::instance()->inject(

  'trim_chars', function($string, $char_s, $char_e) {

    return Magic_Posts::instance()->trim_char($string, array(array($char_s, $char_e)));

  }

);

Magic_Posts::instance()->inject(

  'trim_quotes', function($string) {

    return Magic_Posts::instance()->trim_char($string, array('\'', '"'));

  }

);

Magic_Posts::instance()->inject(

  'match_char', function($string, $chars) {

    $string = trim($string);

    foreach($chars as $char) {
      if(!is_array($char)) $char = array($char, $char);
      $match = '/^\\' . $char[0] . '.*\\' . $char[1] . '$/';
      if(preg_match($match, $string)) return TRUE;
    }

    return FALSE;

  }

);

Magic_Posts::instance()->inject(

  'match_chars', function($string, $char_s, $char_e) {

    return Magic_Posts::instance()->match_char($string, array(array($char_s, $char_e)));

  }

);

Magic_Posts::instance()->inject(

  'match_quotes', function($string) {

    return Magic_Posts::instance()->match_char($string, array('\'', '"'));

  }

);