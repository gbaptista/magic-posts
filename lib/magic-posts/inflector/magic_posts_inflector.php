<?php

/*
 * CakePHP Inflector | thanks: https://github.com/cakephp/cakephp/blob/master/lib/Cake/Utility/Inflector.php
 *
 * Replaces:
     [Inflector.php]     to [magic_posts_cakephp_inflector.php]
     [protected static]  to [public static]
     [class Inflector]   to [class Magic_Posts_CakePHP_Inflector]
     [Inflector::]       to [Magic_Posts_CakePHP_Inflector::]
 */
require_once('magic_posts_cakephp_inflector.php');

class Magic_Posts_Inflector {

  private static $instance;
  public static function instance()
  {
    if(!isset(self::$instance)) self::$instance = new self();
    return self::$instance;
  }

  private $rules = array();

  private function __construct()
  {

    # Português | thanks: http://felipems.com.br/blog/?p=209
    $this->rules['pt'] = array(
      'rules' => array(
        '/^(.*)ao$/i' => '\1oes',
        '/^(.*)ão$/i' => '\1ões',
        '/^(.*)(r|s|z)$/i' => '\1\2es',
        '/^(.*)(a|e|o|u)l$/i' => '\1\2is',
        '/^(.*)il$/i' => '\1is',
        '/^(.*)(m|n)$/i' => '\1ns',
        '/^(.*)$/i' => '\1s'
      ),
      'uninflected' => array('atlas', 'lapis', 'onibus', 'pires', 'virus', '.*x', 'status'),
      'irregular' =>  array('abdomens' => 'abdomen', 'alemao' => 'alemaes')
    );

    # English
    $this->rules['en'] = Magic_Posts_CakePHP_Inflector::$_plural;
    $this->rules['en']['uninflected'][] = 'my';

  }

  private $lang;

  private function set_lang($lang)
  {

    if($this->lang != $lang) {

      $rules = $this->rules[$lang];

      if(empty($rules)) $rules = $this->rules['en'];

      Magic_Posts_CakePHP_Inflector::rules('plural', $rules, true);

      $this->lang = $lang;

    }

  }

  public function pluralize($singular, $lang)
  {

    $this->set_lang($lang);

    $plural = '';

    if($lang == 'pt') {

      foreach(explode(' ', $singular) as $word) $plural .= ' ' . Magic_Posts_CakePHP_Inflector::pluralize($word);

    } else {

      $words = explode(' ', $singular);
      $words[count($words)-1] = Magic_Posts_CakePHP_Inflector::pluralize(end($words));
      $plural = implode(' ', $words);

    }

    return trim($plural);

  }

}