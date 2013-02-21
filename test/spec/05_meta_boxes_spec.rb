require './test/spec/config.rb'

feature 'Custom Fields' do

  scenario 'Create Custom Fields' do

    mp_update_files
    
    wp_login

    mp_settings

    within('#magic-posts') do

      find('textarea[name=scaffolds]').set("Article 'Field A':string 'Field B':text 'Field C':editor 'Field D':mini-editor 'Field E':image  'Field F':gallery")

      find('input[type=submit]').click

    end

    page.should have_content 'Settings saved.'

    within('#adminmenu #menu-posts-m-p-article') do

      visit find_link('Add New')['href']

    end

    within('#poststuff') do

      page.should have_css '#m-p-field-a-string'
      page.should have_css '#m-p-field-b-text'
      page.should have_css '#m-p-field-c-editor'
      page.should have_css '#m-p-field-d-mini-editor'
      page.should have_css '#m-p-field-e-image'
      page.should have_css '#m-p-field-f-gallery'

    end

  end

end