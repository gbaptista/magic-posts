require './test/spec/00_config.rb'

feature 'Custom Posts' do

  scenario 'Create Custom Posts' do
    
    wp_login

    mp_settings
    
    within('#magic-posts') do

      find('textarea[name=scaffolds]').set(
'Article field_a:string

Travel field_a:string'
      )

      find('input[type=submit]').click

    end

    page.should have_css '#adminmenu #menu-posts-m-p-article'

    page.should have_css '#adminmenu #menu-posts-m-p-travel'

  end

end