Magic Posts 0.0.5
--------

WordPress Plugin: Create [Custom Post Types](http://codex.wordpress.org/Post_Types) and [Custom Fields](http://codex.wordpress.org/Custom_Fields) with [scaffolds](http://en.wikipedia.org/wiki/Scaffold_\(programming\)).

Download: [http://wordpress.org/extend/plugins/magic-posts/](http://wordpress.org/extend/plugins/magic-posts/)

Online Demo: [http://gbaptista.com/galeria-de-imagens/](http://gbaptista.com/galeria-de-imagens/)

* [Scaffolding](#scaffolding)
* [Retrieving Data](#retrieving-data)
* [Retrieving Images](#retrieving-images)
* [Image Data Reference](#image-data-reference)
* [Command Reference](#command-reference)
* [Custom Post Types Features](#custom-post-types-features)
* [Demos](#demos)

Scaffolding
--------

### Custom Post Types

```bash
'Singular Term' description:mini-editor
```

```bash
Product Price:string 'In Stock':string Shipping:string Description:editor
```

```bash
'Travel Album' photos:gallery
```

```bash
Celebrity Profile:image[200x200:crop] Album:gallery[150x150:crop, 800x600, 1024x768]
```

```bash
Article editor:true
```

### All WordPress Default Posts

```bash
[post] Photos:gallery
```

### All WordPress Default Pages

```bash
[page] Illustration:image Credits:string
```

### Post ID, Page ID or Custom Post Type ID
```bash
[378] Name:string Profile:image
```

Retrieving Data
--------

```bash
Article Name:string
```

### Current Post
```html
<h4><?php echo magic_posts('Name'); ?></h4>
```

### Post ID
```html
<h4><?php echo magic_posts(137, 'Name'); ?></h4>
```

Retrieving Images
--------

```bash
Travel Album:gallery[150x150:crop, 800x600, 1024x768] Profile:image[200x200:crop]
```

### Current Post

```html
<?php $image = magic_posts('Profile'); ?>
 
<img src="<?php echo $image->url('200x200:crop'); ?>" alt="<?php echo $image->alt(); ?>" />
```

```html
<?php foreach(magic_posts('Album') as $image) { ?>

  <a target="_blank" href="<?php echo $image->url('800x600'); ?>">
    <img src="<?php echo $image->url('150x150:crop'); ?>" alt="<?php echo $image->alt(); ?>" />
  </a>

  <br />

<?php } ?>
 ```

### Post ID
```php
$image = magic_posts(169, 'Profile');
```

```php
foreach(magic_posts(169, 'Album') as $image)
 ```

Image Data Reference
--------

```bash
Travel Profile:image Album:gallery
```

```php
$image = magic_posts('Profile');
 ```

```php
foreach(magic_posts('Album') as $image)
 ```
 
 ```php
echo $image->url() . '<br />';

echo $image->url('800x600') . '<br />';

echo $image->url('100x100:crop') . '<br />';

echo $image->id() . '<br />';

echo $image->title() . '<br />';

echo $image->legend() . '<br />';

echo $image->alt() . '<br />';

echo $image->description() . '<br />';

print_r($image->post());

echo $image->post('ID') . '<br />';
/*
  All [post] attributes:
    ID, post_author, post_date, post_date_gmt, post_content, post_title,
    post_excerpt, post_status, comment_status, ping_status, post_password,
    post_name, to_ping, pinged, post_modified, post_modified_gmt,
    post_content_filtered, post_parent, guid, menu_order, post_type,
    post_mime_type, comment_count, filter
*/

print_r($image->post_meta());

echo $image->post_meta('_wp_attachment_image_alt') . '<br />';
/*
  All [post_meta] attributes:
    _wp_attached_file, _wp_attachment_metadata,
    _wp_attachment_image_alt, _edit_lock
*/

print_r($image->metadata());

echo $image->metadata('height') . '<br />';
/*
  All [metadata] attributes:
    width, height, file, sizes, image_meta
*/

print_r($image->image_meta());

echo $image->image_meta('focal_length') . '<br />';
/*
  All [image_meta] attributes:
    aperture, credit, camera, caption, created_timestamp,
    copyright, focal_length, iso, shutter_speed, title
*/
 ```

Command Reference
--------

Command | Description
--- | ---
`title:false` | Disable WordPress Title. `default:true`
`editor:true` | Enable WordPress Editor. `default:false`
`'My Field':string` | Text field.
`'My Field':text` | Textarea field.
`'My Field':editor` | Custom Wordpress Editor.
`'My Field':mini-editor` | Custom Wordpress Mini-Editor (teeny).
`'My Field':image` | Unique image from Media Library.
`'My Field':image[100x100:crop, 800x600]` | Unique image custom sizes.
`'My Field':gallery` | Multiple images from Media Library.
`'My Field':gallery[80x70:crop, 500x400, 10x20:crop]` | Multiple images custom sizes.

Custom Post Types Features
--------

WordPress Post Feature | Default
--- | ---
title | `true`
editor | `false`
author | `false`
thumbnail | `false`
excerpt | `false`
trackbacks | `false`
custom-fields | `false`
comments | `false`
revisions | `false`
page-attributes | `false`
post-formats | `false`

Demos
--------

![Magic Posts](http://gbaptista.com/images/m-p-04-s.png "Magic Posts")
![Magic Posts](http://gbaptista.com/images/m-p-01-s-b.png "Magic Posts")
![Magic Posts](http://gbaptista.com/images/m-p-02-s.png "Magic Posts")
![Magic Posts](http://gbaptista.com/images/m-p-03-s.png "Magic Posts")
