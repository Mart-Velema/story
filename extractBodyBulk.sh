#!/bin/bash

source config.sh

getHtmlBody() 
{
    local dir="$1"
    for file in "$dir"/*.odt; 
    do
        libreoffice --headless --convert-to html "$file"

        local filename=$(basename -- "$file")
        filename="${filename%.*}"

        local body_content=$(pandoc "${filename}.html" --standalone --to html5 | sed -n '/<body.*>/,/<\/body>/p' | sed '1d;$d')

        body_content=$(echo "$body_content" | sed 's/<br \/>/<br>/g')

        echo "$body_content" > "$outputdir/${filename//[^a-zA-Z0-9]/-}.html"
        rm "${filename}.html"
    done
}

pids=()

for dir in "${directories[@]}"; 
do
    fullpath="$basedir/$dir"
    if [ -d "$fullpath" ];
    then
        getHtmlBody "$fullpath" &
        pids+=($!)
    else
        echo "Error: Dir $fullpath not found"
    fi
done