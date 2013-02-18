<?php

require_once('lib/magic-posts.php');
require_once('lib/magic-posts/images.php');
require_once('lib/magic-posts/scaffolds.php');

class Magic_Posts_Test extends PHPUnit_Framework_TestCase
{

  public function test_scaffold()
  {

    $debug = Magic_Posts::instance()->scaffold(
      "[236] 'Imagens na Página':gallery[100x100:crop, 800x600] 'Capa':image[100x100:crop, 800x600, 900x600]"
    );
    //print_r($debug); exit;

    $this->assertEquals(
      array(
        'title'   => '[236]',
        'fields'  =>  array(
          array('Imagens na Página', 'gallery', '100x100:crop,800x600'),
          array('Capa', 'image', '100x100:crop,800x600,900x600')
        )
      ),
      Magic_Posts::instance()->scaffold(
        "[236] 'Imagens na Página':gallery[100x100:crop, 800x600] 'Capa':image[100x100:crop, 800x600, 900x600]"
      )
    );

    $this->assertEquals(
      array(
        'title'   => '[236]',
        'fields'  =>  array(
          array('Imagens na Página', 'gallery', '100x100:crop,800x600'),
          array('Capa', 'image', '100x100:crop,800x600,900x600')
        )
      ),
      Magic_Posts::instance()->scaffold(
        "[236] 'Imagens na Página':gallery[100x100:crop,800x600] 'Capa':image[100x100:crop,800x600,900x600]"
      )
    );

    $this->assertEquals(
      array(
        'title'   => 'Test',
        'fields'  =>  array(
          array('editor', 'true'),
          array('Field A', 'string'),
          array('Field B', 'text'),
          array('Field C', 'editor'),
          array('Field D', 'mini-editor'),
          array('Field E', 'image'),
          array('Field F', 'gallery')
        )
      ),
      Magic_Posts::instance()->scaffold(
        "Test editor:true 'Field A':string 'Field B':text 'Field C':editor 'Field D':mini-editor 'Field E':image 'Field F':gallery"
      )
    );

    $this->assertEquals(
      array(
        'title'   => 'Produto',
        'fields'  => array(
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
        'title'   => 'Cachorro',
        'fields'  => array(
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
        'title'   => 'Cachorro',
        'fields'  => array(
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