require 'mysql'
require 'capybara/rspec'
require 'capybara/dsl'

require './test/spec/helpers/wordpress_helper'
require './test/spec/helpers/magic_posts_helper'

module WordPressHelper

  def run_install
    true
  end

  def mysql_config
    {
      'db_name'     => 'test-magic-posts',
      'db_user'     => 'root',
      'db_password' => '',
      'db_host'     => 'localhost'
    }
  end

end

RSpec.configure do |config|
  config.include Capybara::DSL
  config.include WordPressHelper
  config.include MagicPostsHelper
end

Capybara.default_driver = :selenium

Capybara.app_host = 'http://test.magic-posts.local'