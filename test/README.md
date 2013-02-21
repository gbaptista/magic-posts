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

* install [Ruby](http://www.ruby-lang.org/)
* install [Firefox](http://www.mozilla.org/firefox/)

### Setup

```bash
git submodule update
gem install bundler
bundle install
```

Edit your [hosts](http://en.wikipedia.org/wiki/Hosts_\(file\)) and server files:
*http://test.magic-posts.local* **=>** *test/tmp/*

MySQL Config: test/spec/config.rb
```ruby
def mysql_config
  {
    'db_name'     => 'test-magic-posts',
    'db_user'     => 'root',
    'db_password' => '',
    'db_host'     => 'localhost'
  }
end
```

### Running Tests:
```bash
rspec test/spec
```

#### Skip Install Tests:

Change run_install: test/spec/config.rb
```ruby
def run_install
  false
end
```

Run:
```bash
rspec test/spec
```