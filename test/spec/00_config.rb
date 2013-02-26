require 'mysql'
require 'capybara/rspec'
require 'capybara/dsl'

require './test/spec/helpers/wordpress_helper'
require './test/spec/helpers/magic_posts_helper'

module MagicPostsHelper

  TEST          = 'a'
  RUN_INSTALL   = true
  UPDATE_FILES  = true

  MYSQL_CONFIG  = {
    'db_name'     => 'test-magic-posts-'+TEST,
    'db_user'     => 'root',
    'db_password' => '',
    'db_host'     => 'localhost'
  }

end

RSpec.configure do |config|
  config.include Capybara::DSL
  config.include WordPressHelper
  config.include MagicPostsHelper
end

Capybara.default_wait_time  = 5
Capybara.default_driver     = :selenium

Capybara.app_host = 'http://test-'+MagicPostsHelper::TEST+'.magic-posts.local'