Magic Posts Test Suite
--------

## [PHPUnit](https://github.com/sebastianbergmann/phpunit/)

* install [PHP](http://php.net/)
* install [PHPUnit](https://github.com/sebastianbergmann/phpunit/)

### Running tests:
```bash
phpunit --configuration test/phpunit/magic-posts.xml
```

## [Capybara with RSpec](https://github.com/jnicklas/capybara)

* install [Git](http://git-scm.com/)
* install [Ruby](http://www.ruby-lang.org/)
* install [Firefox](http://www.mozilla.org/firefox/)
* Server with [PHP](http://php.net/) and [MySQL](http://www.mysql.com/)

### Setup

```bash
git submodule init
git submodule update
gem install bundler
bundle install
```

Edit your [hosts](http://en.wikipedia.org/wiki/Hosts_\(file\)) and server files:

* *http://test-a.magic-posts.local* **=>** *test/tmp/a*
* *http://test-b.magic-posts.local* **=>** *test/tmp/b*

MySQL Config: [test/spec/config.rb](spec/config.rb)
```ruby
MYSQL_CONFIG  = {
  'db_name'     => 'test-magic-posts-'+TEST,
  'db_user'     => 'root',
  'db_password' => '',
  'db_host'     => 'localhost'
}
end
```

### Running Tests:
```bash
rspec test/spec --format documentation
```

#### Skip Install Tests:

Change run_install: [test/spec/config.rb](spec/config.rb)
```ruby
RUN_INSTALL = false
```

Run:
```bash
rspec test/spec
```

[![Tests running!](http://gbaptista.com/images/youtube-tests.png)](https://www.youtube.com/watch?v=hXT9XTZsPOU)
