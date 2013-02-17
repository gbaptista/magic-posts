Magic Posts 0.0.3
--------

Create [Custom Post Types](http://codex.wordpress.org/Post_Types#Custom_Types) with simple [scaffolds](http://en.wikipedia.org/wiki/Scaffold_\(programming\)).

Download: [http://wordpress.org/extend/plugins/magic-posts/](http://wordpress.org/extend/plugins/magic-posts/)

* [Scaffolding](#scaffolding)
* [Retrieving Data](#retrieving-data)
* [Command Reference](#command-reference)
* [Custom Post Types Features](#custom-post-types-features)
* [Demos](#demos)

Scaffolding
--------

### Custom Post Types

```bash
Product Price:string 'In Stock':string Shipping:string Description:editor
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
Article Name:string Photo:image 'My Travel Photos':gallery
```

### Current Post
```html
<h4><?php echo magic_posts('Name'); ?></h4>

<img src="<?php echo magic_posts('Photo')->url; ?>" width="50" height="50" />

<ul>
  <?php foreach(magic_posts('My Travel Photos') as $photo) { ?>
    <li><img src="<?php echo $photo->url; ?>" width="50" height="50" /></li>
  <?php } ?>
</ul>
```

### Post ID
```html
<h4><?php echo magic_posts(137, 'Name'); ?></h4>

<img src="<?php echo magic_posts(137, 'Photo')->url; ?>" width="50" height="50" />

<ul>
  <?php foreach(magic_posts(137, 'My Travel Photos') as $photo) { ?>
    <li><img src="<?php echo $photo->url; ?>" width="50" height="50" /></li>
  <?php } ?>
</ul>
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
`'My Field':gallery` | Multiple images from Media Library.

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