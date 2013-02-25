require './test/spec/00_config.rb'

feature 'Settings' do

  scenario 'Create and Update Settings' do
    
    wp_login

    # Create Settings

    mp_settings

    within('#magic-posts') do

      find('textarea[name=scaffolds]').set('Article field_a:string')
      find('textarea[name=migrations]').set('LastArticle => Article')
      find('input[name=run_migrations]').set(true)

      find('input[type=submit]').click

      page.should have_content 'Settings saved.'
      page.should have_content 'Migrations executed!'

      find('textarea[name=scaffolds]').value.should == 'Article field_a:string'
      find('textarea[name=migrations]').value.should == 'LastArticle => Article'

    end

    mp_settings

    within('#magic-posts') do

      find('textarea[name=scaffolds]').value.should == 'Article field_a:string'
      find('textarea[name=migrations]').value.should == 'LastArticle => Article'

    # Update Settings

      find('textarea[name=scaffolds]').set('ArticleB field_a:string')
      find('textarea[name=migrations]').set('LastArticleB => ArticleB')

      find('input[type=submit]').click

      page.should have_content 'Settings saved.'

      find('textarea[name=scaffolds]').value.should == 'ArticleB field_a:string'
      find('textarea[name=migrations]').value.should == 'LastArticleB => ArticleB'

    end

    mp_settings    

    within('#magic-posts') do

      find('textarea[name=scaffolds]').value.should == 'ArticleB field_a:string'
      find('textarea[name=migrations]').value.should == 'LastArticleB => ArticleB'

    # Clear Settings

      find('textarea[name=scaffolds]').set('')
      find('textarea[name=migrations]').set('')

      find('input[type=submit]').click

      page.should have_content 'Settings saved.'

      find('textarea[name=scaffolds]').value.should == ''
      find('textarea[name=migrations]').value.should == ''

    end

    mp_settings
    
    within('#magic-posts') do

      find('textarea[name=scaffolds]').value.should == ''
      find('textarea[name=migrations]').value.should == ''

    end

  end

end