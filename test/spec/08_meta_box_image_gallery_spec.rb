require './test/spec/00_config.rb'

feature 'Custom Fields' do

  scenario 'Save and retrieve image/gallery custom fields' do
    
    mp_set_scaffolds "Article 'Field A':image 'Field B':image 'Field C':gallery 'Field D':gallery"

    mp_add_new 'article'

    mp_image_select_media '#m-p-field-a-image', 1

    mp_image_select_media '#m-p-field-b-image', 2

    mp_gallery_select_media '#m-p-field-c-gallery', [1,2]

    mp_gallery_select_media '#m-p-field-d-gallery', [2,1]

    mp_count_images('#m-p-field-a-image').should == 1
    mp_count_images('#m-p-field-b-image').should == 1

    mp_count_images('#m-p-field-c-gallery').should == 2
    mp_count_images('#m-p-field-d-gallery').should == 2

    mp_send_image_content('#m-p-field-a-image').should == mp_original_image_content('1280x800_HD_Wallpeper_154_Zixpk-300x187.jpg')
    mp_send_image_content('#m-p-field-b-image').should == mp_original_image_content('01113_different_1280x800-300x187.jpg')

    mp_send_image_content('#m-p-field-c-gallery').should == mp_original_image_content('1280x800_HD_Wallpeper_154_Zixpk-150x150.jpg')
    mp_send_image_content('#m-p-field-d-gallery').should == mp_original_image_content('01113_different_1280x800-150x150.jpg')

    find('#submitpost input[name=publish]').click

    mp_count_images('#m-p-field-a-image').should == 1
    mp_count_images('#m-p-field-b-image').should == 1

    mp_count_images('#m-p-field-c-gallery').should == 2
    mp_count_images('#m-p-field-d-gallery').should == 2

    mp_send_image_content('#m-p-field-a-image').should == mp_original_image_content('1280x800_HD_Wallpeper_154_Zixpk-300x187.jpg')
    mp_send_image_content('#m-p-field-b-image').should == mp_original_image_content('01113_different_1280x800-300x187.jpg')

    mp_send_image_content('#m-p-field-c-gallery').should == mp_original_image_content('1280x800_HD_Wallpeper_154_Zixpk-150x150.jpg')
    mp_send_image_content('#m-p-field-d-gallery').should == mp_original_image_content('01113_different_1280x800-150x150.jpg')

  end

end