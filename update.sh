#!/bin/bash

cd /var/www/story

source config.sh
date -d @$(date -u +%s)
if [ $resetGit -eq 1 ];
then
    echo "Updating Git..."
    git restore .
    git pull
else
    echo "Not updating Git..."
fi

if [ $usePythonUpdater -eq 1];
then
    if command -v -- python3 > /dev/null 2>&1;
    then
        python3 extractBodyBulk.py
    else
        echo "Python is not installed! Please install Python with 'sudo apt install python3', or your package manager of choice"
    fi
else
    ./extractBodyBulk.sh
fi