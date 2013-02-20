<?php

require_once('lib/magic-posts.php');

require_once('lib/magic-posts/dangerous.php');

class Dangerous_Test extends PHPUnit_Framework_TestCase
{

  public function test_post_type()
  {

    $this->assertEquals(
      'm-p-My Gallery',
      Magic_Posts::instance()->post_type('My Gallery')
    );

  }

  public function test_image_size()
  {

    $this->assertEquals(
      'm-p-My Field',
      Magic_Posts::instance()->image_size('My Field')
    );

  }

  public function test_field()
  {

    $this->assertEquals(
      '{My Field}',
      Magic_Posts::instance()->field('My Field')
    );

  }

}