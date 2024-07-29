#!/bin/bash

cd /var/www/story

date -d @$(date -u +%s)

echo "Updating Git..."
git restore .
git pull

if command -v -- python3 > /dev/null 2>&1;
then
    python3 extractBodyBulk.py
else
    echo "Python is not installed! Please install Python with 'sudo apt install python3', or your package manager of choice"
fi