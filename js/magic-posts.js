jQuery(document).ready(function() {

  if(jQuery('.m-p-m-b-image').size() || jQuery('.m-p-m-b-gallery').size())
  {

    function Magic_Posts_media_append(media_show, image)
    {

      var media_html = '';

      media_html += '<div>';
        media_html += '<img src="' + image.url + '" />';
        media_html += '<a class="m-p-m-b-img-remove m-p-m-b-img-' + image.id + '" href="javascript:void(0);">remove</a>';
      media_html += '</div>';

      jQuery(media_show).append(media_html);

    }

  }

  if(jQuery('.m-p-m-b-image').size())
  {

    function Magic_Posts_image_thumb(media_show, image)
    {
      jQuery(media_show).html('');
      Magic_Posts_media_append(media_show, image);
    }

    jQuery('.m-p-m-b-image').each(function() {
      try {
        var image = JSON.parse(jQuery(this).find('.media_url').val());
        Magic_Posts_image_thumb(jQuery(this).find('.media_show'), image);
      } catch(e) {}
    });

    jQuery('.m-p-m-b-image .m-p-m-b-img-remove').live('click', function() {
      var area = jQuery(this).parent().parent().parent();
      jQuery(area).find('.media_show').html('');
      jQuery(area).find('.media_url').val('');
    });

    jQuery('.m-p-m-b-image-add_media').click(function() {

      var original_insert = wp.media.editor.insert;
      var original_attachment = wp.media.editor.send.attachment;

      var area = jQuery(this).parent().parent();

      wp.media.editor.insert = function(medias) {}
      wp.media.editor.send.attachment = function(props, media) {

        var image = new Object();
        image.id  = media.id;
        image.url = media.url;

        jQuery(area).find('.media_url').val(JSON.stringify(image));

        Magic_Posts_image_thumb(jQuery(area).find('.media_show'), image);

        if(window.tb_remove) try { window.tb_remove(); } catch( e ) {}

        wp.media.editor.insert = original_insert;
        wp.media.editor.send.attachment = original_attachment;

      }

    });

  }

  if(jQuery('.m-p-m-b-gallery').size())
  {

    function Magic_Posts_gallery_thumb(media_show, images)
    {
      jQuery(media_show).html('');
      jQuery(images).each(function() {
        Magic_Posts_media_append(media_show, this);
      });
    }

    jQuery('.m-p-m-b-gallery').each(function() {
      try {
        var images = JSON.parse(jQuery(this).find('.medias_url').val());
        Magic_Posts_gallery_thumb(jQuery(this).find('.media_show'), images);
      } catch(e) {}
    });

    jQuery('.m-p-m-b-gallery .m-p-m-b-img-remove').live('click', function() {

      var area = jQuery(this).parent().parent().parent();

      var id = jQuery(this).attr('class').match(/m-p-m-b-img-[0-9]{1,}/g);
      id = parseInt(id.toString().replace('m-p-m-b-img-', ''));

      jQuery(this).parent().remove();

      var images = JSON.parse(jQuery(area).find('.medias_url').val());

      jQuery(images).each(function(i) {
        if(this.id == id) images.splice(i,1);
      });

      jQuery(area).find('.medias_url').val(JSON.stringify(images));

    });

    jQuery('.m-p-m-b-gallery-add_media').click(function() {

      var original_insert = wp.media.editor.insert;

      var area = jQuery(this).parent().parent();

      function check_url(images, id) {
        var exists = false;
        jQuery(images).each(function() {
          if(this.id == id) exists = true;
        });
        return exists;
      }

      wp.media.editor.insert = function(medias) {

        jQuery(area).find('.temp_medias').html(medias);

        try {
          var images = JSON.parse(jQuery(area).find('.medias_url').val());
        } catch(e) {
          var images = new Array();
        }

        jQuery(area).find('.temp_medias a').each(function() {

          var url = jQuery(this).attr('href');

          var id = jQuery(this).find('img').attr('class').match(/wp-image-[0-9]{1,}/g);
          id = parseInt(id.toString().replace('wp-image-', ''));

          if(!check_url(images, id)) {
            var image = new Object();
            image.id  = id;
            image.url = url;
            images.push(image);
          }

        });

        jQuery(area).find('.medias_url').val(JSON.stringify(images));

        Magic_Posts_gallery_thumb(jQuery(area).find('.media_show'), images);

        if(window.tb_remove) try { window.tb_remove(); } catch( e ) {}

        wp.media.editor.insert = original_insert;

      }

    });

  }

});