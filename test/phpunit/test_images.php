<?php

require_once('lib/magic-posts.php');

require_once('lib/magic-posts/images.php');

class Images_Test extends PHPUnit_Framework_TestCase
{

  public function test_magic_posts_image()
  {

    $image = new Magic_Posts_Image(3);

    $this->assertEquals(3, $image->id());

  }

}