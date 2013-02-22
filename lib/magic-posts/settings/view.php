<div id="magic-posts" class="wrap">

  <?php screen_icon(); ?><h2>Magic Posts Settings</h2>

  <?php if(!empty($_GET['migrated'])) { ?>
    <div id="message" class="updated below-h2"><p>Migrations executed!</p></div>
  <?php } ?>

  <form action="?page=magic-posts-settings" method="post" class="<?php if(!empty($_GET['migrated']) || !empty($_GET['updated'])) echo 'm-p-message'; ?>">

    <h2>Scaffolds:</h2>

    <em>Need help? See: <a href="https://github.com/gbaptista/magic-posts#readme" target="_blank">https://github.com/gbaptista/magic-posts#readme</a></em>

    <textarea name="scaffolds" class="scaffolds"><?php echo stripslashes($scaffolds); ?></textarea>

    <div class="magic-posts-locale">
      Language:
      <label>
        <input type="radio" name="locale" value="en" <?php if($locale == 'en') echo 'checked="checked"'; ?> /> English
      </label>
      <label>
        <input type="radio" name="locale" value="pt" <?php if($locale == 'pt') echo 'checked="checked"'; ?> /> Português
      </label>
    </div>

    <h2>Migrations:</h2>

    <em>Need help? See: <a href="https://github.com/gbaptista/magic-posts#migrations" target="_blank">https://github.com/gbaptista/magic-posts#migrations</a></em>

    <textarea name="migrations" class="migrations"><?php echo stripslashes($migrations); ?></textarea>

    <div class="run_migrations">
      <label>
        <input type="checkbox" name="run_migrations" value="true" /> Run Migrations
      </label>
    </div>

    <?php submit_button(); ?>

  </form>

</div>