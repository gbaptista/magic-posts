require './test/spec/config.rb'

feature 'MagicPosts' do

  scenario 'Install the plugin.' do

    mp_update_files

    if run_install

      wp_login

      mp_install

    end

  end

end