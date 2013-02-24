#!/bin/bash

# cd /media/gbaptista/server/projects/svn/wordpress/magic-posts/
# bash trunk/tag.sh 0.0.0

svn=$PWD
trunk="$PWD/trunk"

cd $trunk
ruby tag.rb $1 tag
ruby tag.rb $1 git
cd $svn
ruby trunk/tag.rb $1 svn