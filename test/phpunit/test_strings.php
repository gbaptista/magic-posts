<?php

require_once('lib/magic-posts.php');

require_once('lib/magic-posts/strings.php');

class Strings_Test extends PHPUnit_Framework_TestCase
{

  public function test_pluralize()
  {

    $this->assertEquals('Celebrities', Magic_Posts::instance()->pluralize('Celebrity', 'en'));

    $this->assertEquals('Carrões', Magic_Posts::instance()->pluralize('Carrão', 'pt'));

    $this->assertEquals('Travel Photos', Magic_Posts::instance()->pluralize('Travel Photo', 'en'));

    $this->assertEquals('Houses', Magic_Posts::instance()->pluralize('House', 'en'));

    $this->assertEquals('My Awesome Galleries', Magic_Posts::instance()->pluralize('My Awesome Gallery', 'en'));

    $this->assertEquals('Últimas Notícias', Magic_Posts::instance()->pluralize('Última Notícia', 'pt'));

    $this->assertEquals('Awesome Galleries', Magic_Posts::instance()->pluralize('Awesome Gallery', 'en'));

    $this->assertEquals('Travel Albums', Magic_Posts::instance()->pluralize('Travel Album', 'en'));

  }

  public function test_trim_char()
  {

    $this->assertEquals('Teste', Magic_Posts::instance()->trim_char('"Teste"', array('"', "'")));

    $this->assertEquals('Teste', Magic_Posts::instance()->trim_char("'Teste'", array('"', "'")));

    $this->assertEquals('Teste', Magic_Posts::instance()->trim_char('[Teste]', array(array('[', ']'))));

  }

  public function test_trim_chars()
  {

    $this->assertEquals('Teste', Magic_Posts::instance()->trim_chars("[Teste]", '[', ']'));

    $this->assertEquals('Teste', Magic_Posts::instance()->trim_chars("'Teste'", "'"));

    $this->assertEquals('Teste', Magic_Posts::instance()->trim_chars('"Teste"', '"'));

  }

  public function test_trim_quotes()
  {

    $this->assertEquals('Teste', Magic_Posts::instance()->trim_quotes("'Teste'"));

    $this->assertEquals('Teste Test', Magic_Posts::instance()->trim_quotes('"Teste Test"'));

  }

}