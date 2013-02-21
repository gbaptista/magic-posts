require './test/spec/config.rb'

feature 'MagicPosts' do

  scenario 'Install the plugin.' do

    if run_install

      mp_update_files
      
      wp_login

      mp_install

    end

  end

end