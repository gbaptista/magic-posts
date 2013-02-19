<?php

  if(!empty($_POST))
  {

    add_option('magic-posts_scaffolds');
    update_option('magic-posts_scaffolds', $_POST['scaffolds']);

    add_option('magic-posts_locale');
    update_option('magic-posts_locale', $_POST['locale']);

    echo'<script type="text/javascript">window.location="?page='.$_GET['page'].'";</script>';
  }

  $scaffolds = get_option('magic-posts_scaffolds');
  $locale = get_option('magic-posts_locale');

  if(empty($locale))
  {

    add_option('magic-posts_locale');
    if(substr(get_locale(), 0, 2) == 'pt') {
      update_option('magic-posts_locale', 'pt');
      $locale = 'pt';
    } else {
      update_option('magic-posts_locale', 'en');
      $locale = 'en';
    }
    
  }

?>