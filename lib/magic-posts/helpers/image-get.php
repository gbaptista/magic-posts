<?php

// Fix for Windows...
if(preg_match('/\//', dirname(__FILE__)))
{
  $dir = explode('lib/magic-posts/helpers', dirname(__FILE__));
  $dir = $dir[0];
  $dir = preg_replace('/\/wp-content\/plugins\/magic-posts.*/', '', $dir);
} else {
  $dir = explode('lib\magic-posts\helpers', dirname(__FILE__));
  $dir = $dir[0];
  $dir = preg_replace('/\\\wp-content\\\plugins\\\magic-posts.*/', '', $dir);
}

// Fix for SVN repository...
if(preg_match('/\/svn\/wordpress\/magic-posts\/trunk\/$/', $dir)) {
  $dir = str_replace('svn/wordpress', 'web/wordpress/wordpress-plugins', $dir);
  $dir = str_replace('/magic-posts/trunk/', '', $dir);
}

require_once($dir.'/'.'wp-load.php');

$image = new Magic_Posts_Image($_GET['id']);

header('Content-type: image');
echo file_get_contents($image->url($_GET['size']));