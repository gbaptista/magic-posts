<?php

class Magic_Posts_Image {

  /*
   * url()
   * url(size)
   *
   * id()
   * title()
   * legend()
   * alt()
   * description()
   *
   * post() [
      ID, post_author, post_date, post_date_gmt, post_content, post_title,
      post_excerpt, post_status, comment_status, ping_status, post_password,
      post_name, to_ping, pinged, post_modified, post_modified_gmt,
      post_content_filtered, post_parent, guid, menu_order, post_type,
      post_mime_type, comment_count, filter
     ]
   *
   * post_meta() [
      _wp_attached_file, _wp_attachment_metadata,
      _wp_attachment_image_alt, _edit_lock
     ]
   *
   * metadata() [
      width, height, file, sizes, image_meta
     ]
   *
   * image_meta() [
      aperture, credit, camera, caption, created_timestamp,
      copyright, focal_length, iso, shutter_speed, title
     ]
   *
   */

  private $id;

  public function id() { return $this->id; }

  private $post = NULL;
  private $post_meta = NULL;
  private $metadata = NULL;

  public function __construct($id) { $this->id = $id; }

  public function image_meta($key=NULL)
  {
    if(empty($this->metadata)) $this->metadata = wp_get_attachment_metadata($this->id);
    
    if(empty($key)) return $this->metadata['image_meta'];
    else            return $this->metadata['image_meta'][$key];
  }

  public function metadata($key=NULL)
  {
    if(empty($this->metadata)) $this->metadata = wp_get_attachment_metadata($this->id);
    
    if(empty($key)) return $this->metadata;
    else            return $this->metadata[$key];
  }

  public function post_meta($key=NULL, $i=0)
  {
    if(empty($this->post_meta)) $this->post_meta = get_post_meta($this->id);

    if(empty($key))     return $this->post_meta;
    elseif($i === NULL) return $this->post_meta[$key];
    else                return $this->post_meta[$key][$i];
  }

  public function post($key=NULL)
  {
    if(empty($this->post)) $this->post = (array) get_post($this->id);

    if(empty($key)) return $this->post;
    else            return $this->post[$key];
  }

  public function title()       { return $this->post('post_title'); }
  public function legend()      { return $this->post('post_excerpt'); }
  public function description() { return $this->post('post_content'); }
  public function alt()         { return $this->post_meta('_wp_attachment_image_alt'); }

  public function url($size=NULL)
  {
    if($size)
    {
      $image = wp_get_attachment_image_src($this->id, 'm-p-' . str_replace(':', '', $size));
      if(!isset($image[0]) || empty($image[0]))
      {
        $size = explode('x', $size);
        $image = wp_get_attachment_image_src($this->id, array($size[0],$size[1]));
        return $image[0];
      } else return $image[0];
    } else {
      $image = wp_get_attachment_image_src($this->id, array($size[0],$size[1]));
      return $image[0];
    }
  }

}

Magic_Posts::instance()->inject(

  'image_sizes', function($sizes) {

    $sizes = explode(',', $sizes);

    foreach ($sizes as $size) {

      $size_name = $size;

      $crop = FALSE;
      if(preg_match_all('/:\S{1,}/', $size, $type))
      {
        $size = str_replace($type[0][0], '', $size);
        if($type[0][0] == ':crop') $crop = TRUE;
      }

      $size = explode('x', $size);

      if(function_exists('sanitize_title'))
      {
        add_image_size('m-p-'.sanitize_title($size_name), $size[0], $size[1], $crop);
      }

    }

  }

);