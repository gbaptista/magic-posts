<div class="m-p-m-b-gallery" id="<?php echo $field_name; ?>_gallery_box">

  <!-- [todo] Load unique editor instance. -->
  <div class="wp_editor_hidden"><?php wp_editor('', $field_name.'_hidden'); ?></div>

  <div id="wp-content-media-buttons" class="wp-media-buttons">
    <a href="javascript:void(0);" class="m-p-m-b-gallery-add_media button insert-media add_media" data-editor="content" title="Add Media"><span class="wp-media-buttons-icon"></span> Select Media</a>
  </div>

  <div class="media_show"></div>

  <input type="hidden" class="medias_url" name="<?php echo $field_name; ?>" value='<?php echo $field_value; ?>' />

  <div class="temp_medias"></div>

</div>