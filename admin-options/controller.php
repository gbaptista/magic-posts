<?php

  if(!empty($_POST))
  {
    add_option('magic-posts_scaffolds');
    update_option('magic-posts_scaffolds', $_POST['scaffolds']);
    echo'<script type="text/javascript">window.location="?page=magic-posts-options";</script>';
  }

  $scaffolds = get_option('magic-posts_scaffolds');

?>