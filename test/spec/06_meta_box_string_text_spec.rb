require './test/spec/00_config.rb'

feature 'Custom Fields' do

  scenario 'Save and retrieve string/text custom fields' do
    
    mp_set_scaffolds "Article 'Field A':string 'Field B':string 'Field C':text 'Field D':text"

    mp_add_new 'article'

    within('#poststuff') do

      find('#m-p-field-a-string .input-entry').set('Value 01')
      find('#m-p-field-b-string .input-entry').set('Value 02')

      find('#m-p-field-c-text .input-entry').set("Value 03\nValue 04\n")
      find('#m-p-field-d-text .input-entry').set("Value 05\nValue 06\n")

      find('#submitpost input[name=publish]').click

    end
    
    within('#poststuff') do

      find('#m-p-field-a-string .input-entry').value.should == 'Value 01'
      find('#m-p-field-b-string .input-entry').value.should == 'Value 02'

      find('#m-p-field-c-text .input-entry').value.should == "Value 03\nValue 04\n"
      find('#m-p-field-d-text .input-entry').value.should == "Value 05\nValue 06\n"

    end

  end

end