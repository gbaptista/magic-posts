<?php

if(!class_exists('Magic_Posts_Types')) {

  class Magic_Posts_Types {

    private static $instance;

    public static function getInstance()
    {
      if(!isset(self::$instance)) self::$instance = new self;
      return self::$instance;
    }

  }

}