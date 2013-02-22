<?php

require_once('lib/magic-posts.php');

require_once('lib/magic-posts/dangerous.php');

class Dangerous_Test extends PHPUnit_Framework_TestCase
{

  public function test_identifiers()
  {

    $this->assertEquals('m-p',  Magic_Posts::instance()->identifier());

    $this->assertEquals('_m-p', Magic_Posts::instance()->meta_prefix());

    $this->assertEquals('m-p-', Magic_Posts::instance()->prefix());

    $this->assertEquals('-m-p', Magic_Posts::instance()->suffix());

  }

  public function test_to_slug()
  {

    $this->assertEquals('my-field', Magic_Posts::instance()->to_slug('My Field'));

    $this->assertEquals('caca', Magic_Posts::instance()->to_slug('Caça'));

    $this->assertEquals('teste', Magic_Posts::instance()->to_slug('Téste'));

  }

  public function test_field_name()
  {

    $this->assertEquals('-m-p{teste}', Magic_Posts::instance()->field_name('{teste}'));

  }

  public function test_post_type()
  {

    $this->assertEquals('m-p-my-gallery', Magic_Posts::instance()->post_type('My Gallery'));

  }

  public function test_image_size()
  {

    $this->assertEquals('m-p-my-field', Magic_Posts::instance()->image_size('My Field'));

  }

  public function test_field()
  {

    $this->assertEquals('_m-p{my-field}', Magic_Posts::instance()->field('My Field'));

  }

}