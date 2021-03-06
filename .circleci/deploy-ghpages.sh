#!/bin/sh

set -e

pwd

remote=$(git config remote.origin.url)

mkdir gh-pages-branch
cd gh-pages-branch

git init

git config --global user.name "$USER_NAME"
git config --global user.email "$USER_EMAIL"

git remote add --fetch origin "$remote"

if git rev-parse --verify origin/gh-pages > /dev/null 2>&1
then
    git checkout gh-pages
    git rm -rf .
else
    git checkout --orphan gh-pages
fi

cp -r ../lanyon-master/_site/* .

echo 'ly95.me' > CNAME

git add -A

git commit --allow-empty -m "Deploy to GitHub pages [ci skip]"

git push --force origin gh-pages

cd ..

rm -rf gh-pages-branch

echo "Finished Deployment!"
