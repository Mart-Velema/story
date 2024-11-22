#!/bin/bash

directory="/var/www/${1}"

cd "${directory}"

date -d @$(date -u +%s)

git restore .
git pull

if command -v -- python3 > /dev/null 2>&1;
then
    python3 extractBodyBulk.py
else
    echo "Python is not installed! Please install Python with 'sudo apt install python3', or your package manager of choice"
fi