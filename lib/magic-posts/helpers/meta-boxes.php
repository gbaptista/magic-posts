<?php

function Magic_Posts_Meta_Box($post, $args) {

  $type = $args['args']['type'];

  if(!in_array($type, Magic_Posts::instance()->meta_box_types))
    return NULL;

  $plugin_folder = preg_replace('/lib\/magic-posts.*/', '', plugin_basename(__FILE__));

  // [todo] Just for the first...
  wp_nonce_field($plugin_folder, 'magic_posts_data');

  $field_name = wp_create_nonce($plugin_folder) . '-m-p' . $args['args']['meta_box'];

  $field_value = get_post_meta($post->ID, '_m-p' . $args['args']['meta_box'], true);

  include(__DIR__.'/meta-boxes/'.$type.'.php');

}