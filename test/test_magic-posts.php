<?php

require_once('lib/magic-posts.php');
require_once('lib/magic-posts/images.php');
require_once('lib/magic-posts/scaffolds.php');
require_once('lib/magic-posts/inflector/magic_posts_inflector.php');

class Magic_Posts_Test extends PHPUnit_Framework_TestCase
{

  public function test_inflector()
  {

    $this->assertEquals(
      'Celebrities',
      Magic_Posts_Inflector::instance()->pluralize('Celebrity', 'en')
    );

    $this->assertEquals(
      'Carrões',
      Magic_Posts_Inflector::instance()->pluralize('Carrão', 'pt')
    );

    $this->assertEquals(
      'Travel Photos',
      Magic_Posts_Inflector::instance()->pluralize('Travel Photo', 'en')
    );

    $this->assertEquals(
      'Houses',
      Magic_Posts_Inflector::instance()->pluralize('House', 'en')
    );

    $this->assertEquals(
      'My Awesome Galleries',
      Magic_Posts_Inflector::instance()->pluralize('My Awesome Gallery', 'en')
    );

    $this->assertEquals(
      'Últimas Notícias',
      Magic_Posts_Inflector::instance()->pluralize('Última Notícia', 'pt')
    );

    $this->assertEquals(
      'Awesome Galleries',
      Magic_Posts_Inflector::instance()->pluralize('Awesome Gallery', 'en')
    );

    $this->assertEquals(
      'Travel Albums',
      Magic_Posts_Inflector::instance()->pluralize('Travel Album', 'en')
    );
    
  }

  public function test_scaffold()
  {

    $debug = Magic_Posts::instance()->scaffold(
      '"Última Notícia " campo:string'
    );
    #print_r($debug); exit;

    $this->assertEquals(
      array(
        'title'   => 'Última Notícia',
        'fields'  =>  array(
          array('campo', 'string')
        )
      ),
      Magic_Posts::instance()->scaffold(
        '"Última Notícia " campo:string'
      )
    );

    $this->assertEquals(
      array(
        'title'   => 'Última Notícia',
        'fields'  =>  array(
          array('campo', 'string')
        )
      ),
      Magic_Posts::instance()->scaffold(
        "'Última Notícia' campo:string"
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