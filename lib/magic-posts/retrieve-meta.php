<?php

Magic_Posts::instance()->inject(

  'retrieve_metas', function($id) {

    if(empty(Magic_Posts::instance()->metas[$id]))
    {

      Magic_Posts::instance()->metas[$id] = array();

      foreach (get_post_meta($id) as $key => $value) {
        if(preg_match('/^_m-p\{/', $key))
        {
          $key = explode('}', $key);
          Magic_Posts::instance()->metas[$id][str_replace('_m-p{', '', $key[0])] = array(
            'type' => $key[1], 'value' => $value[0]
          );
        }
      }

    }

    return Magic_Posts::instance()->metas[$id];

  }

);

Magic_Posts::instance()->inject(

  'retrieve_meta', function($key, $force_id=NULL) {

    if($force_id)
    {
      $id = $key; $key = $force_id;
    } else {
      $id = get_the_ID();
    }

    if(empty($id)) return NULL;

    $meta = Magic_Posts::instance()->retrieve_metas($id);
    $meta = $meta[sanitize_title($key)];

    if(!empty($meta['value']))
    {

      $value = $meta['value'];

      if(in_array($meta['type'], array('gallery', 'image')))
        $value = json_decode($value);

      elseif(in_array($meta['type'], array('text', 'editor', 'mini-editor')))
        $value = wpautop($value);

      return $value;

    } else return NULL;

  }

);