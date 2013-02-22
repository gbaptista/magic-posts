require './test/spec/config.rb'

feature 'Custom Fields' do

  scenario 'Save and retrieve image/gallery custom fields' do
    
    mp_set_scaffolds "Article 'Field A':image 'Field B':image 'Field C':gallery 'Field D':gallery"

    mp_add_new 'article'

    within('#poststuff') do

      # puts 'go!'

    end

    # find('#submitpost input[name=publish]').click

  end

end