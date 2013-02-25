require './test/spec/00_config.rb'

feature 'Custom Fields' do

  scenario 'Save and retrieve editor/mini-editor custom fields' do
    
    mp_set_scaffolds "Article 'Field A':editor 'Field B':editor 'Field C':mini-editor 'Field D':mini-editor"

    mp_add_new 'article'

    within('#poststuff') do

      mp_set_TinyMCE('#m-p-field-a-editor', 'Value 01<br>Value 02')
      mp_set_TinyMCE('#m-p-field-b-editor', 'Value 03<br>Value 04')

      mp_set_TinyMCE('#m-p-field-c-mini-editor', 'Value 05<br>Value 06')
      mp_set_TinyMCE('#m-p-field-d-mini-editor', 'Value 07<br>Value 08')

    end

    find('#submitpost input[name=publish]').click

    within('#poststuff') do

      mp_get_TinyMCE('#m-p-field-a-editor').should == '<p>Value 01<br> Value 02</p>'
      mp_get_TinyMCE('#m-p-field-b-editor').should == '<p>Value 03<br> Value 04</p>'

      mp_get_TinyMCE('#m-p-field-c-mini-editor').should == '<p>Value 05<br> Value 06</p>'
      mp_get_TinyMCE('#m-p-field-d-mini-editor').should == '<p>Value 07<br> Value 08</p>'

    end

  end

end