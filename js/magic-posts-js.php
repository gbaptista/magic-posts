<?php

header('Content-type: application/x-javascript');

$url = explode('wp-content/plugins', $_SERVER['REQUEST_URI']);
$url[0] .= 'wp-content/plugins/magic-posts/';

echo "var magic_posts_path = '$url[0]';\n\n";

echo file_get_contents('magic-posts.js');