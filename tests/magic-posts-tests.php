<?php

$Magic_Posts_Test = TRUE;

require_once('magic-posts.php');

class Magic_Posts_Test extends PHPUnit_Framework_TestCase
{

  public function test_process_scaffold()
  {

    /*
    $debug = Magic_Posts::getInstance(true)->process_scaffold(
      "Produto"
    );
    print_r($debug);
    */

    $this->assertEquals(
      array(
        'title' => 'Produto',
        'fields' => array(
          array('Nome do Produto', 'text'),
          array('Valor do Produto', 'text')
        )
      ),
      Magic_Posts::getInstance(true)->process_scaffold(
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
      Magic_Posts::getInstance(true)->process_scaffold(
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
      Magic_Posts::getInstance(true)->process_scaffold(
        'Cachorro \'Nome do Produto\':text "Valor dos Produto\'s":text Imagem:image'
      )
    );

  }

}
?>