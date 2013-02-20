<?php

require_once('lib/magic-posts.php');

require_once('lib/magic-posts/images.php');

require_once('lib/magic-posts/retrieve-meta.php');

class RetrieveMeta_Test extends PHPUnit_Framework_TestCase
{

  public function test_retrieve_meta()
  {

    Magic_Posts::instance()->metas['45'] = array(
      'imagens-na-pagina' => array(
        'type'  => 'gallery',
        'value' => '[{"id":329,"url":"http://local.gbaptista.com/wp-content/uploads/2013/02/01914_sandilandssunset20_1280x800.jpg"},{"id":330,"url":"http://local.gbaptista.com/wp-content/uploads/2013/02/01936_bluetiles_1280x800.jpg"},{"id":328,"url":"http://local.gbaptista.com/wp-content/uploads/2013/02/01901_bluelake_1280x800.jpg"},{"id":327,"url":"http://local.gbaptista.com/wp-content/uploads/2013/02/01898_lifeintechnicolor_1280x800.jpg"},{"id":326,"url":"http://local.gbaptista.com/wp-content/uploads/2013/02/01635_doublerainbow_1280x800.jpg"},{"id":325,"url":"http://local.gbaptista.com/wp-content/uploads/2013/02/01493_lightstillshinesonthefair_1280x800.jpg"},{"id":324,"url":"http://local.gbaptista.com/wp-content/uploads/2013/02/1280x800_Zixpk_HD_Wallpaper_209.jpg"},{"id":323,"url":"http://local.gbaptista.com/wp-content/uploads/2013/02/1280x800_HD_Wallpeper_154_Zixpk.jpg"},{"id":322,"url":"http://local.gbaptista.com/wp-content/uploads/2013/02/1280x800_HD_Wallpaper_198_Zixpk.jpg"},{"id":320,"url":"http://local.gbaptista.com/wp-content/uploads/2013/02/1280x800_HD_Wallpaper_182_Zixpk.jpg"},{"id":321,"url":"http://local.gbaptista.com/wp-content/uploads/2013/02/1280x800_HD_Wallpaper_197_Zixpk.jpg"},{"id":319,"url":"http://local.gbaptista.com/wp-content/uploads/2013/02/1280x800_HD_Wallpaper_178_Zixpk.jpg"},{"id":318,"url":"http://local.gbaptista.com/wp-content/uploads/2013/02/1280x800_HD_Wallpaper_177_Zixpk.jpg"},{"id":317,"url":"http://local.gbaptista.com/wp-content/uploads/2013/02/1280x800_HD_Wallpaper_155_Zixpk.jpg"},{"id":316,"url":"http://local.gbaptista.com/wp-content/uploads/2013/02/1280x800_HD_Wallpaper_136_Zixpk.jpg"},{"id":315,"url":"http://local.gbaptista.com/wp-content/uploads/2013/02/1280x800_HD_wallpaper_123_zixpkcom.jpg"},{"id":314,"url":"http://local.gbaptista.com/wp-content/uploads/2013/02/1280x800.jpg"},{"id":313,"url":"http://local.gbaptista.com/wp-content/uploads/2013/02/01113_different_1280x800.jpg"}]'
      ),
      'capa' => array(
        'type' => 'image',
        'value' => '{"id":342,"url":"http://local.gbaptista.com/wp-content/uploads/2013/02/Wallpapers-room_com___Water_Drops_by_Alexander-GG_1280x800.jpg"}'
      ),
      'galeria' => array(
        'type' => 'string',
        'value' => 'Minha Galeria'
      )
    );

    $this->assertEquals(
      'Minha Galeria',
      Magic_Posts::instance()->retrieve_meta('galeria')
    );

    $this->assertEquals(
      342,
      Magic_Posts::instance()->retrieve_meta('capa')->id()
    );

    $this->assertEquals(
      18,
      count(Magic_Posts::instance()->retrieve_meta('imagens-na-pagina'))
    );

  }

}