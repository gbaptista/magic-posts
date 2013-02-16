<style type="text/css"><?php include('style.css'); ?></style>

<div id="magic-posts" class="wrap">

  <?php screen_icon(); ?><h2>Magic Posts Settings</h2>

  <form method="post">

    <textarea name="scaffolds" class="scaffolds"><?php echo stripslashes($scaffolds); ?></textarea>

    <?php submit_button(); ?>

  </form>

</div>