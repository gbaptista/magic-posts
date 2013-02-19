# encoding: utf-8

require 'fileutils'

# Use: ruby svn_tag.rb 0.0.5

trunk = Dir.pwd
tag   = trunk.gsub(/trunk$/, 'tags/'+ARGV.first)

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
  tag + '/lib/magic-posts/helpers/.svn',
  tag + '/lib/magic-posts/helpers/meta-boxes/.svn',
  tag + '/lib/magic-posts/inflector/.svn',
  tag + '/lib/magic-posts/settings/.svn',
  tag + '/test/.svn',
  tag + '/.git',
  tag + '/.svn',
  tag + '/README.md',
  tag + '/svn_tag.rb',
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