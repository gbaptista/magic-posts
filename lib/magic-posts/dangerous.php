<?php

/*
  =======================================
  =========== DANGEROUS AREA! ===========
  =======================================
*/
Magic_Posts::instance()->inject(

  'post_type', function($name) {

    return substr('m-p-'.sanitize_title($name), 0, 20);

  }

);

Magic_Posts::instance()->inject(

  'image_size', function($name) {

    return Magic_Posts::instance()->post_type($name);

  }

);

Magic_Posts::instance()->inject(

  'field', function($name, $type=NULL) {

    if(!empty($type))
      return '{' . sanitize_title($name) . '}' . $type;
    else
      return '{' . sanitize_title($name) . '}';

  }

);