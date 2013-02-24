module WordPressHelper

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

end