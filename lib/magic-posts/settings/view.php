<div id="magic-posts" class="wrap">

  <?php screen_icon(); ?><h2>Magic Posts Settings</h2>

  <form method="post">

    <h2>Scaffolds:</h2>

    <em>Need help? See: <a href="https://github.com/gbaptista/magic-posts#readme" target="_blank">https://github.com/gbaptista/magic-posts#readme</a></em>

    <textarea name="scaffolds" class="scaffolds"><?php echo stripslashes($scaffolds); ?></textarea>

    <?php submit_button(); ?>

  </form>

</div>