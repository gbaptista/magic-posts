<?php

require_once('lib/magic-posts.php');

require_once('lib/magic-posts/strings.php');

require_once('lib/magic-posts/migrations.php');

class Migrations_Test extends PHPUnit_Framework_TestCase
{

  public function test_migrations()
  {

    $this->assertEquals(
      TRUE,
      Magic_Posts::instance()->migrations(
        "[page] ['Nome da Galeria' => 'Galeria', 'Capa da Galeria' => 'Capa']"
      )
    );

  }

  public function test_migration()
  {

    $this->assertEquals(
      array(
        'post_type' => '[page]',
        'fields' => array(
          array('from' => 'Nome da Galeria', 'to' => 'Galeria'),
          array('from' => 'Capa da Galeria', 'to' => 'Capa')
        )
      ),
      Magic_Posts::instance()->migration(
        "[page] ['Nome da Galeria' => 'Galeria', 'Capa da Galeria' => 'Capa']"
      )
    );

    $this->assertEquals(
      array(
        'post_type' => '[post]',
        'fields' => array(
          array('from' => 'Nome da Galeria', 'to' => 'Galeria'),
          array('from' => 'Capa da Galeria', 'to' => 'Capa')
        )
      ),
      Magic_Posts::instance()->migration(
        "[post] ['Nome da Galeria' => 'Galeria', 'Capa da Galeria' => 'Capa']"
      )
    );

    $this->assertEquals(
      array(
        'post_type' => '[236]',
        'fields' => array(
          array('from' => 'Nome da Galeria', 'to' => 'Galeria'),
          array('from' => 'Capa da Galeria', 'to' => 'Capa')
        )
      ),
      Magic_Posts::instance()->migration(
        "[236] ['Nome da Galeria' => 'Galeria', 'Capa da Galeria' => 'Capa']"
      )
    );

    $this->assertEquals(
      array(
        'post_type' => 'Imóvel - Apartamento',
        'fields' => array(
          array('from' => 'bairro', 'to' => 'neighborhood'),
          array('from' => 'cidade', 'to' => 'Main City')
        )
      ),
      Magic_Posts::instance()->migration(
        '\'Imóvel - Apartamento\' [bairro => "neighborhood", "cidade" => \'Main City\']'
      )
    );

    $this->assertEquals(
      array(
        'post_type' => 'Apartamento',
        'fields' => array(
          array('from' => 'bairro', 'to' => 'neighborhood'),
          array('from' => 'cidade', 'to' => 'Main City')
        )
      ),
      Magic_Posts::instance()->migration(
        'Apartamento [bairro => "neighborhood", "cidade" => \'Main City\']'
      )
    );

    $this->assertEquals(
      array(
        'post_type' => 'Apartamento Maneiro',
        'fields' => array(
          array('from' => 'bairro', 'to' => 'neighborhood'),
          array('from' => 'cidade', 'to' => 'Main City')
        )
      ),
      Magic_Posts::instance()->migration(
        '"Apartamento Maneiro" [bairro => "neighborhood", "cidade" => \'Main City\']'
      )
    );

    $this->assertEquals(
      array(
        array('from' => 'Apartamento', 'to' => 'Imóvel - Apartamento')
      ),
      Magic_Posts::instance()->migration(
        "Apartamento => 'Imóvel - Apartamento'"
      )
    );

    $this->assertEquals(
      array(
        array('from' => 'Apartamento', 'to' => 'Imóvel - Apartamento'),
        array('from' => 'Apartamento 2', 'to' => 'Imóvel - Apartamento 2')
      ),
      Magic_Posts::instance()->migration(
        "[Apartamento => 'Imóvel - Apartamento', 'Apartamento 2' => 'Imóvel - Apartamento 2']"
      )
    );

    $this->assertEquals(
      array(
        array('from' => 'Apartamento', 'to' => 'Imóvel - Apartamento'),
        array('from' => 'Teste', 'to' => 'Dog')
      ),
      Magic_Posts::instance()->migration(
        "[Apartamento => 'Imóvel - Apartamento', 'Teste' => 'Dog']"
      )
    );

    $this->assertEquals(
      array(
        array('from' => 'Apartamento', 'to' => 'Imóvel - Apartamento'),
        array('from' => 'Teste', 'to' => 'Dog')
      ),
      Magic_Posts::instance()->migration(
        "[Apartamento => 'Imóvel - Apartamento', 'Teste' => 'Dog']"
      )
    );

  }

}