require './test/spec/00_config.rb'

feature 'Wordpress' do

  scenario 'Install WordPress' do
    
    wp_install if run_install

  end

end