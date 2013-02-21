module MagicPostsHelper

  def mp_settings

    within('#menu-settings') do

      page.should have_content 'Magic Posts'

      visit find_link('Magic Posts')['href']

    end

  end

  def mp_update_files

    mp_folder = 'test/tmp/wp-content/plugins/magic-posts/'

    FileUtils.rm_rf mp_folder if Dir.exists? mp_folder
    FileUtils.mkdir mp_folder

    FileUtils.cp_r  Dir.glob('css/'),   mp_folder
    FileUtils.cp_r  Dir.glob('js/'),    mp_folder
    FileUtils.cp_r  Dir.glob('lib/'),   mp_folder
    FileUtils.cp    'magic-posts.php',  mp_folder
    FileUtils.cp    'README.txt',       mp_folder
    FileUtils.cp    'LICENSE',          mp_folder

    [
      mp_folder + '/css/.svn',
      mp_folder + '/js/.svn',
      mp_folder + '/lib/.svn',
      mp_folder + '/lib/magic-posts/.svn',
      mp_folder + '/lib/magic-posts/helpers/.svn',
      mp_folder + '/lib/magic-posts/helpers/meta-boxes/.svn',
      mp_folder + '/lib/magic-posts/inflector/.svn',
      mp_folder + '/lib/magic-posts/settings/.svn',
      mp_folder + '/test',
      mp_folder + '/.svn',
      mp_folder + '/.git',
      mp_folder + '/.gitignore',
      mp_folder + '/.gitmodules',
      mp_folder + '/Gemfile',
      mp_folder + '/Gemfile.lock',
      mp_folder + '/README.md',
      mp_folder + '/tag.rb',
      mp_folder + '/tag.sh'
    ].each do |remove|
      if File.exists? remove
        if File.directory?(remove)
          FileUtils.rm_rf remove
        else
          File.delete remove
        end
      end
    end
    
  end

  def mp_install

    within('#adminmenu') do

      visit find('#menu-plugins a.menu-top')['href']

    end

    within('#magic-posts') do

      click_link 'Activate'

    end

    page.should have_content 'Plugin activated'

  end

end