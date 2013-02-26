module WordPressHelper

  def wp_insert_from_media_library index=1

    within('.media-router') do

      click_link 'Media Library'

    end

    sleep 0.2
    
    within('.attachments-browser') do

      all('.attachment-preview')[index-1].click

    end

    within('.media-frame-toolbar') do

      click_link 'Insert into post'

    end

    sleep 0.2

  end
  
  def wp_login

    mp_update_files if update_files
    
    visit path + 'wp-admin'

    sleep 0.2 # Fix for Windows...

    page.should have_css '#loginform'

    within('#loginform') do

      find('#user_login').set('admin')
      find('#user_pass').set('123')

      find('#wp-submit').click

    end

  end
  
  def wp_install

    mysql = Mysql.new(
      mysql_config['db_host'],
      mysql_config['db_user'],
      mysql_config['db_password']
    )

    mysql.query('DROP DATABASE IF EXISTS `' + mysql_config['db_name'] + '`')
    mysql.query('CREATE DATABASE `' + mysql_config['db_name'] + '`')

    FileUtils.mkdir 'test/tmp' if !Dir.exists? 'test/tmp'

    FileUtils.rm_rf 'test/tmp/'+test if Dir.exists? 'test/tmp/'+test
    FileUtils.mkdir 'test/tmp/'+test

    if test == 'b'
      FileUtils.mkdir 'test/tmp/b/sub' if !Dir.exists? 'test/tmp/b/sub'
      FileUtils.mkdir 'test/tmp/b/sub/dir' if !Dir.exists? 'test/tmp/b/sub/dir'
      FileUtils.cp_r Dir.glob('test/data/wordpress/*'), 'test/tmp/b/sub/dir'
      system('chmod 777 test/tmp/b/sub/dir/')
      system('chmod 777 test/tmp/b/sub/dir/wp-content/')
    else
      FileUtils.cp_r Dir.glob('test/data/wordpress/*'), 'test/tmp/'+test
      system('chmod 777 test/tmp/'+test+'/')
      system('chmod 777 test/tmp/'+test+'/wp-content/')
    end

    visit path

    within('#error-page') do
      visit find_link('Create a Configuration File')['href']
    end

    within('.wp-core-ui') do
      visit find('.step a')['href']
    end

    within('.wp-core-ui') do

      fill_in 'Database Name',  :with => mysql_config['db_name']
      fill_in 'User Name',      :with => mysql_config['db_user']
      fill_in 'Password',       :with => mysql_config['db_password']
      fill_in 'Database Host',  :with => mysql_config['db_host']

      find('input[type=submit]').click

    end

    within('.wp-core-ui') do
      visit find('.step a')['href']
    end
    
    within('#setup') do

      find('#weblog_title').set('Magic Posts Test Site')
      find('#user_login').set('admin')
      find('#pass1').set('123')
      find('#pass2').set('123')
      find('#admin_email').set('test@gmail.com')

      find('input[type=submit]').click

    end

  end

  def wp_create_attachment

    mysql = Mysql.new(
      mysql_config['db_host'],
      mysql_config['db_user'],
      mysql_config['db_password']
    )

    if test == 'b'
      url = 'http://test-b.magic-posts.local/sub/dir/wp-content/uploads/'
      FileUtils.mkdir 'test/tmp/b/sub/dir/wp-content/uploads' if !Dir.exists? 'test/tmp/b/sub/dir/wp-content/uploads'
      FileUtils.cp_r Dir.glob('test/data/uploads/*'), 'test/tmp/b/sub/dir/wp-content/uploads'
    else
      url = 'http://test-'+test+'.magic-posts.local/wp-content/uploads/'
      FileUtils.mkdir 'test/tmp/'+test+'/wp-content/uploads' if !Dir.exists? 'test/tmp/'+test+'/wp-content/uploads'
      FileUtils.cp_r Dir.glob('test/data/uploads/*'), 'test/tmp/'+test+'/wp-content/uploads'
    end

    begin

      mysql.query("
        INSERT INTO `test-magic-posts-#{test}`.`wp_posts`
          (
          `ID`,
          `post_author`,
          `post_date`,
          `post_date_gmt`,
          `post_content`,
          `post_title`,
          `post_excerpt`,
          `post_status`,
          `comment_status`,
          `ping_status`,
          `post_password`,
          `post_name`,
          `to_ping`,
          `pinged`,
          `post_modified`,
          `post_modified_gmt`,
          `post_content_filtered`,
          `post_parent`,
          `guid`,
          `menu_order`,
          `post_type`,
          `post_mime_type`,
          `comment_count`
        )
        VALUES
        (
         '9',
         '1',
         '2013-02-24 18:19:06',
         '2013-02-24 18:19:06',
         '',
         '01113_different_1280x800',
         '',
         'inherit',
         'open',
         'open',
         '',
         '01113_different_1280x800',
         '',
         '',
         '2013-02-24 18:19:06',
         '2013-02-24 18:19:06',
         '',
         '8',
         '#{url}2013/02/01113_different_1280x800.jpg',
         '0',
         'attachment',
         'image/jpeg',
         '0'
        );
      ")

      mysql.query("
        INSERT INTO `test-magic-posts-#{test}`.`wp_postmeta`
          (`meta_id`,
          `post_id`,
          `meta_key`,
          `meta_value`)
          VALUES
          (
          '14', '9', '_wp_attached_file', '2013/02/01113_different_1280x800.jpg'
          );
      ")

      mysql.query("
        INSERT INTO `test-magic-posts-#{test}`.`wp_postmeta`
          (
            `meta_id`,
            `post_id`,
            `meta_key`,
            `meta_value`
          )
          VALUES
          (
            '15',
            '9',
            '_wp_attachment_metadata',
            '" + 'a:5:{s:5:"width";i:1280;s:6:"height";i:800;s:4:"file";s:36:"2013/02/01113_different_1280x800.jpg";s:5:"sizes";a:4:{s:9:"thumbnail";a:4:{s:4:"file";s:36:"01113_different_1280x800-150x150.jpg";s:5:"width";i:150;s:6:"height";i:150;s:9:"mime-type";s:10:"image/jpeg";}s:6:"medium";a:4:{s:4:"file";s:36:"01113_different_1280x800-300x187.jpg";s:5:"width";i:300;s:6:"height";i:187;s:9:"mime-type";s:10:"image/jpeg";}s:5:"large";a:4:{s:4:"file";s:37:"01113_different_1280x800-1024x640.jpg";s:5:"width";i:1024;s:6:"height";i:640;s:9:"mime-type";s:10:"image/jpeg";}s:14:"post-thumbnail";a:4:{s:4:"file";s:36:"01113_different_1280x800-624x390.jpg";s:5:"width";i:624;s:6:"height";i:390;s:9:"mime-type";s:10:"image/jpeg";}}s:10:"image_meta";a:10:{s:8:"aperture";i:0;s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";i:0;s:9:"copyright";s:0:"";s:12:"focal_length";i:0;s:3:"iso";i:0;s:13:"shutter_speed";i:0;s:5:"title";s:0:"";}}' + "'
          );
      ")

      mysql.query("
        INSERT INTO `test-magic-posts-#{test}`.`wp_posts`
          (
          `ID`,
          `post_author`,
          `post_date`,
          `post_date_gmt`,
          `post_content`,
          `post_title`,
          `post_excerpt`,
          `post_status`,
          `comment_status`,
          `ping_status`,
          `post_password`,
          `post_name`,
          `to_ping`,
          `pinged`,
          `post_modified`,
          `post_modified_gmt`,
          `post_content_filtered`,
          `post_parent`,
          `guid`,
          `menu_order`,
          `post_type`,
          `post_mime_type`,
          `comment_count`
        )
        VALUES
        (
         '10',
         '1',
         '2013-02-24 20:24:10',
         '2013-02-24 20:24:10',
         '',
         '1280x800_HD_Wallpeper_154_Zixpk',
         '',
         'inherit',
         'open',
         'open',
         '',
         '1280x800_hd_wallpeper_154_zixpk',
         '',
         '',
         '2013-02-24 20:24:10',
         '2013-02-24 20:24:10',
         '',
         '8',
         'http://test-b.magic-posts.local/sub/dir/wp-content/uploads/2013/02/1280x800_HD_Wallpeper_154_Zixpk.jpg',
         '0',
         'attachment',
         'image/jpeg',
         '0'
        );
      ")

      mysql.query("
        INSERT INTO `test-magic-posts-#{test}`.`wp_postmeta`
          (`meta_id`,
          `post_id`,
          `meta_key`,
          `meta_value`)
          VALUES
          (
          '16', '10', '_wp_attached_file', '2013/02/1280x800_HD_Wallpeper_154_Zixpk.jpg'
          );
      ")

      mysql.query("
        INSERT INTO `test-magic-posts-#{test}`.`wp_postmeta`
          (
            `meta_id`,
            `post_id`,
            `meta_key`,
            `meta_value`
          )
          VALUES
          (
            '17',
            '10',
            '_wp_attachment_metadata',
            '" + 'a:5:{s:5:"width";i:1280;s:6:"height";i:800;s:4:"file";s:43:"2013/02/1280x800_HD_Wallpeper_154_Zixpk.jpg";s:5:"sizes";a:4:{s:9:"thumbnail";a:4:{s:4:"file";s:43:"1280x800_HD_Wallpeper_154_Zixpk-150x150.jpg";s:5:"width";i:150;s:6:"height";i:150;s:9:"mime-type";s:10:"image/jpeg";}s:6:"medium";a:4:{s:4:"file";s:43:"1280x800_HD_Wallpeper_154_Zixpk-300x187.jpg";s:5:"width";i:300;s:6:"height";i:187;s:9:"mime-type";s:10:"image/jpeg";}s:5:"large";a:4:{s:4:"file";s:44:"1280x800_HD_Wallpeper_154_Zixpk-1024x640.jpg";s:5:"width";i:1024;s:6:"height";i:640;s:9:"mime-type";s:10:"image/jpeg";}s:14:"post-thumbnail";a:4:{s:4:"file";s:43:"1280x800_HD_Wallpeper_154_Zixpk-624x390.jpg";s:5:"width";i:624;s:6:"height";i:390;s:9:"mime-type";s:10:"image/jpeg";}}s:10:"image_meta";a:10:{s:8:"aperture";i:0;s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";i:0;s:9:"copyright";s:0:"";s:12:"focal_length";i:0;s:3:"iso";i:0;s:13:"shutter_speed";i:0;s:5:"title";s:0:"";}}' + "'
          );
      ")

    rescue => e
    end

  end

end