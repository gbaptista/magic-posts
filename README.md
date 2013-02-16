Magic Posts
--------

Create [Custom Post Types](http://codex.wordpress.org/Post_Types#Custom_Types) with simple [scaffolds](http://en.wikipedia.org/wiki/Scaffold_\(programming\)).

Usage
--------

```bash
Product Price:string 'In Stock':string Shipping:string Description:editor
```

```bash
Article editor:true
```

Command | Description
--- | ---
`title:false` | Disable WordPress Title. `default:true`
`editor:true` | Enable WordPress Editor. `default:false`
`'My Filed':string` | Custom text field.
`'My Filed':text` | Custom textarea field.
`'My Filed':editor` | Custom Wordpress Editor.

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

Demo
--------

![Magic Posts](http://gbaptista.com/images/m-p-01-s-b.png "Magic Posts")
![Magic Posts](http://gbaptista.com/images/m-p-02-s.png "Magic Posts")
![Magic Posts](http://gbaptista.com/images/m-p-03-s.png "Magic Posts")
