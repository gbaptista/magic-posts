<?php

$migrations = get_option('magic-posts_migrations');

if(!empty($_POST)) {

  add_option('magic-posts_migrations');
  update_option('magic-posts_migrations', $_POST['migrations']);

  add_option('magic-posts_scaffolds');
  update_option('magic-posts_scaffolds', $_POST['scaffolds']);

  add_option('magic-posts_locale');
  update_option('magic-posts_locale', $_POST['locale']);

  if($_POST['run_migrations'] == 'true') {

    $migrations = get_option('magic-posts_migrations');
    Magic_Posts::instance()->migrations(stripcslashes($migrations));
    echo'<script type="text/javascript">window.location="?page='.$_GET['page'].'&updated=true&migrated=true";</script>';

  } else {

    echo'<script type="text/javascript">window.location="?page='.$_GET['page'].'&updated=true";</script>';

  }

} else {

  $scaffolds = get_option('magic-posts_scaffolds');
  $locale = get_option('magic-posts_locale');

  if(empty($locale)) {

    add_option('magic-posts_locale');

    if(substr(get_locale(), 0, 2) == 'pt') {

      update_option('magic-posts_locale', 'pt'); $locale = 'pt';

    } else {

      update_option('magic-posts_locale', 'en'); $locale = 'en';

    }

  }

}

?>