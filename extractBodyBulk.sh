#!/bin/bash

source config.sh

getHtmlBody() 
{
    local dir="$1"
    for file in "$dir"/*.odt; 
    do
        libreoffice --headless --convert-to html "$file" --outdir "$dir"

        local filename=$(basename -- "$file")
        filename="${filename%.*}"

        local body_content=$(pandoc "$dir/$filename.html" --standalone --to html5 --quiet | sed -n '/<body.*>/,/<\/body>/p' | sed '1d;$d')

        body_content=$(echo "$body_content" | sed 's/<br \/>/<br>/g')

        echo "$body_content" > "$outputdir/${filename//[^a-zA-Z0-9]/-}.html"
        rm "$dir/$filename.html"
    done
}

for dir in "${directories[@]}"; 
do
    fullpath="$basedir/$dir"
    if [ -d "$fullpath" ];
    then
        getHtmlBody "$fullpath"
    else
        echo "Error: Dir $fullpath not found"
    fi
done