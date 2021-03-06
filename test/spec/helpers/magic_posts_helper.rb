module MagicPostsHelper

  def mp_image_select_media selector, index=1
    mp_select_media selector, '.m-p-m-b-image-add_media', index
  end

  def mp_gallery_select_media selector, index=1
    mp_select_media selector, '.m-p-m-b-gallery-add_media', index
  end

  def mp_select_media selector, button, index=1

    index = [index] if !index.kind_of?(Array)

    index.each do |i|

      within('#poststuff ' + selector) do

        find(button).click

      end

      wp_insert_from_media_library i

    end

  end

  def mp_add_new type

    within('#adminmenu #menu-posts-m-p-' + type) do

      visit find_link('Add New')['href']

    end

  end

  def mp_set_scaffolds scaffolds

    wp_login

    mp_settings

    within('#magic-posts') do

      find('textarea[name=scaffolds]').set(scaffolds)

      find('input[type=submit]').click

    end
    
    page.should have_content 'Settings saved.'

  end

  def mp_count_images selector
    return page.evaluate_script("jQuery('#{selector} .media_show img').size()")
  end

  def mp_send_image_content selector
    File.open('test/tmp/image_1.jpg', 'w') { |f| f.write Net::HTTP.get_response(URI.parse(mp_image_src(selector))).body }
    return Digest::MD5.digest(File.open('test/tmp/image_1.jpg', 'r').read)
  end

  def mp_original_image_content file
    File.open('test/tmp/image_2.jpg', 'w') { |f| f.write File.open('test/data/uploads/2013/02/'+file, 'r').read }
    return Digest::MD5.digest(File.open('test/tmp/image_2.jpg', 'r').read)
  end

  def mp_image_src selector
    return Capybara.app_host + page.evaluate_script("jQuery('#{selector} .media_show img:first').attr('src')")
  end

  def mp_get_TinyMCE selector

    within_frame find(selector + ' iframe')[:id] do
      return page.evaluate_script("document.getElementById('tinymce').innerHTML")
    end

  end

  def mp_set_TinyMCE selector, value

    within_frame find(selector + ' iframe')[:id] do
      page.execute_script("document.getElementById('tinymce').innerHTML = '<p>#{value}</p>';")
    end

  end

  def mp_settings

    page.should have_css '#menu-settings'

    within('#menu-settings') do

      page.should have_content 'Magic Posts'

      visit find_link('Magic Posts')['href']

    end

  end

  def mp_update_files

    if test == 'b'
      mp_folder = 'test/tmp/b/sub/dir/wp-content/plugins/magic-posts/'
    else
      mp_folder = 'test/tmp/'+test+'/wp-content/plugins/magic-posts/'
    end

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

  def test;         TEST;         end
  def run_install;  RUN_INSTALL;  end
  def update_files; UPDATE_FILES; end

  def mysql_config; MYSQL_CONFIG; end

  def path
    return '/sub/dir/' if TEST == 'b'
    return '/'
  end

end