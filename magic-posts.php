<?php

/*
Plugin Name: Magic Posts
Plugin URI: http://wordpress.org/extend/plugins/magic-posts/
Description: Create Custom Post Types with simple scaffolds.
Version: 0.0.6
Author: Guilherme Baptista
Author URI: http://gbaptista.com
License: MIT
*/

/*
  Running Tests:
  phpunit --configuration test/magic-posts.xml

*/

require_once('lib/magic-posts.php');

function Magic_Posts_plugin() { return Magic_Posts::instance(); }
add_action('plugins_loaded', 'Magic_Posts_plugin');