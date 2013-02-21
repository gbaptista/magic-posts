# encoding: utf-8

# ruby tag.rb 0.0.0 tag
# ruby tag.rb 0.0.0 svn
# ruby tag.rb 0.0.0 git

require 'fileutils'

trunk = Dir.pwd
tag   = trunk.gsub(/trunk$/, 'tags/'+ARGV.first)

if ARGV[1] == 'git'

  system("git tag -a #{ARGV.first} -m \"Magic Posts #{ARGV.first}\"")

elsif ARGV[1] == 'svn'

  system("svn add tags/#{ARGV.first}")
  system("svn ci -m \"tagging version #{ARGV.first}\"")

elsif ARGV[1] == 'tag'

  if Dir.exists? tag
    puts 'tag exists!'
    abort
  end

  FileUtils.mkdir tag
  FileUtils.cp_r Dir.glob('*'), tag

  [
    tag + '/css/.svn',
    tag + '/js/.svn',
    tag + '/lib/.svn',
    tag + '/lib/magic-posts/.svn',
    tag + '/lib/magic-posts/helpers/.svn',
    tag + '/lib/magic-posts/helpers/meta-boxes/.svn',
    tag + '/lib/magic-posts/inflector/.svn',
    tag + '/lib/magic-posts/settings/.svn',
    tag + '/test/.svn',
    tag + '/.git',
    tag + '/.svn',
    tag + '/README.md',
    tag + '/tag.rb',
    tag + '/tag.sh',
    tag + '/.gitignore',
  ].each do |remove|
    if File.exists? remove
      if File.directory?(remove)
        FileUtils.rm_rf remove
      else
        File.delete remove
      end
    end
  end

end