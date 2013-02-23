<?php

/*
Plugin Name: Magic Posts
Plugin URI: http://wordpress.org/extend/plugins/magic-posts/
Description: Create Custom Post Types with simple scaffolds.
Version: 0.0.8
Author: Guilherme Baptista
Author URI: http://gbaptista.com
License: MIT
*/

// Test Suite: https://github.com/gbaptista/magic-posts/tree/master/test#readme

require_once('lib/magic-posts.php');

function Magic_Posts_plugin() { return Magic_Posts::instance(); }
add_action('plugins_loaded', 'Magic_Posts_plugin');