<div class="m-p-m-b-image" id="<?php echo $field_name; ?>_image_box">

  <!-- [todo] Load unique editor instance. -->
  <div class="wp_editor_hidden"><?php wp_editor('', $field_name.'_hidden'); ?></div>

  <div id="wp-content-media-buttons" class="wp-media-buttons">
    <a href="javascript:void(0);" class="m-p-m-b-image-add_media button insert-media add_media" data-editor="content" title="Add Media"><span class="wp-media-buttons-icon"></span> Select Media</a>
  </div>

  <input class="input-entry media_url" type="hidden" name="<?php echo $field_name; ?>" value='<?php echo $field_value; ?>' />
  <div class="media_show"></div>

</div>