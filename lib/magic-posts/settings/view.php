<style type="text/css"><?php include('style.css'); ?></style>

<div id="magic-posts" class="wrap">

  <?php screen_icon(); ?><h2>Magic Posts Settings</h2>

  <form method="post">

    <h2>Scaffolds:</h2>
    <textarea name="scaffolds" class="scaffolds"><?php echo stripslashes($scaffolds); ?></textarea>

    <?php submit_button(); ?>

  </form>

</div>