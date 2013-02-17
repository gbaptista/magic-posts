Magic Posts 0.0.2
--------

Create [Custom Post Types](http://codex.wordpress.org/Post_Types#Custom_Types) with simple [scaffolds](http://en.wikipedia.org/wiki/Scaffold_\(programming\)).

Download: [http://wordpress.org/extend/plugins/magic-posts/](http://wordpress.org/extend/plugins/magic-posts/)

Usage
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