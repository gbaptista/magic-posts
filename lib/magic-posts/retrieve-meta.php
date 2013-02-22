<?php

Magic_Posts::instance()->inject(

  'retrieve_metas', function($id)
  {

    if(empty(Magic_Posts::instance()->metas[$id])) {

      Magic_Posts::instance()->metas[$id] = array();

      foreach (get_post_meta($id) as $key => $value) {

        if(preg_match('/^'.Magic_Posts::instance()->meta_prefix().'\{/', $key)) {

          $key = explode('}', $key);
          Magic_Posts::instance()->metas[$id][str_replace(''.Magic_Posts::instance()->meta_prefix().'{', '', $key[0])] = array(
            'type' => $key[1], 'value' => $value[0]
          );

        }

      }

    }

    return Magic_Posts::instance()->metas[$id];

  }

);

Magic_Posts::instance()->inject(

  'retrieve_meta', function($key, $force_id=NULL)
  {

    if($force_id) {
      $id = $key; $key = $force_id;
    } else {
      $id = get_the_ID();
    }

    if(empty($id)) return NULL;

    $meta = Magic_Posts::instance()->retrieve_metas($id);
    $meta = $meta[Magic_Posts::instance()->to_slug($key)];

    if(!empty($meta['value'])) {

      $value = $meta['value'];

      if(in_array($meta['type'], array('gallery', 'image'))) {

        $value = json_decode($value);

        if(is_array($value)) {
          foreach ($value as $i => $v) $value[$i] = new Magic_Posts_Image($v->id);
        } else {
          $value = new Magic_Posts_Image($value->id);
        }

      } elseif(in_array($meta['type'], array('text', 'editor', 'mini-editor'))) {
        $value = wpautop($value);
      }

      return $value;

    } else return NULL;

  }

);