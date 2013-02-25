require './test/spec/00_config.rb'

feature 'Custom Fields' do

  scenario 'Save and retrieve image/gallery custom fields' do
    
    mp_set_scaffolds "Article 'Field A':image 'Field B':image 'Field C':gallery 'Field D':gallery"

    mp_add_new 'article'

    mp_image_select_media '#m-p-field-a-image', 1

    mp_image_select_media '#m-p-field-b-image', 2

    mp_gallery_select_media '#m-p-field-c-gallery', [1,2]

    mp_gallery_select_media '#m-p-field-d-gallery', [2,1]

    find('#submitpost input[name=publish]').click

  end

end