#!/bin/bash

cd /var/www/story

source config.sh

if [ $resetGit -eq 1 ];
then
    echo "Updating Git..."
    git restore .
    git pull
else
    echo "Not updating Git..."
fi

./extractBodyBulk.sh
