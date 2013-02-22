require './test/spec/config.rb'

feature 'Custom Fields' do

  scenario 'Create Custom Fields' do

    mp_set_scaffolds "Article 'Field A':string 'Field B':text 'Field C':editor 'Field D':mini-editor 'Field E':image  'Field F':gallery"
      
    mp_add_new 'article'

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