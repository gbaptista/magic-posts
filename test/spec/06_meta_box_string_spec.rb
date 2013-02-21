require './test/spec/config.rb'

feature 'Custom Fields' do

  scenario 'Create Custom Fields' do

    mp_update_files
    
    wp_login

    mp_settings

    within('#magic-posts') do

      find('textarea[name=scaffolds]').set("Article 'Field A':string 'Field B':string")

      find('input[type=submit]').click

    end

    page.should have_content 'Settings saved.'

    within('#adminmenu #menu-posts-m-p-article') do

      visit find_link('Add New')['href']

    end

    within('#poststuff') do

      page.should have_css '#m-p-field-a-string'
      page.should have_css '#m-p-field-b-string'

      find('#m-p-field-a-string .input-entry').set('Value 01')
      find('#m-p-field-b-string .input-entry').set('Value 02')

      find('#submitpost input[name=publish]').click

    end

    within('#poststuff') do

      find('#m-p-field-a-string .input-entry').value.should == 'Value 01'
      find('#m-p-field-b-string .input-entry').value.should == 'Value 02'

    end

  end

end