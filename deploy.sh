chmod 600 /tmp/aerospace_travis
eval "$(ssh-agent -s)" # Start the ssh agent
ssh-add /tmp/aerospace_travis
git remote add aerospace_wp git@git.wpengine.com:staging/csisaerospace.git # add remote for staging site
git fetch --unshallow # fetch all repo history or wpengine complain
git status # check git status
git checkout master # switch to master branch
git add wp-content/themes/aerospace/*.css -f # force all compiled CSS files to be added
git commit -m "compiled assets" # commit the compiled CSS files
git push -f aerospace_wp master:master #deploy to staging site from master to master