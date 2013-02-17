<?php

require_once('lib/magic-posts.php');
require_once('lib/magic-posts/scaffolds.php');

class Magic_Posts_Test extends PHPUnit_Framework_TestCase
{

  public function test_scaffold()
  {

    $debug = Magic_Posts::instance()->scaffold(
      "Test editor:true 'Field A':string 'Field B':text 'Field C':editor 'Field D':mini-editor 'Field E':image 'Field F':gallery"
    );
    //print_r($debug);

    $this->assertEquals(
      array(
        'title' => 'Produto',
        'fields' => array(
          array('Nome do Produto', 'text'),
          array('Valor do Produto', 'text')
        )
      ),
      Magic_Posts::instance()->scaffold(
        "Produto 'Nome do Produto':text 'Valor do Produto':text"
      )
    );

    $this->assertEquals(
      array(
        'title' => 'Cachorro',
        'fields' => array(
          array('Nome do Produto', 'text'),
          array('Valor do Produto', 'text'),
          array('Imagem', 'image')
        )
      ),
      Magic_Posts::instance()->scaffold(
        'Cachorro "Nome do Produto":text "Valor do Produto":text Imagem:image'
      )
    );

    $this->assertEquals(
      array(
        'title' => 'Cachorro',
        'fields' => array(
          array('Nome do Produto', 'text'),
          array('Valor dos Produto\'s', 'text'),
          array('Imagem', 'image')
        )
      ),
      Magic_Posts::instance()->scaffold(
        'Cachorro \'Nome do Produto\':text "Valor dos Produto\'s":text Imagem:image'
      )
    );

  }

}