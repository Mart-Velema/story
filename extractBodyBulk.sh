#!/bin/bash

source config.sh

getHtmlBody() 
{
    for file in *.odt; 
    do
        libreoffice --headless --convert-to html "$file"

        filename=$(basename -- "$file")
        filename="${filename%.*}"

        body_content=$(pandoc "${filename}.html" --standalone --to html5 | sed -n '/<body.*>/,/<\/body>/p' | sed '1d;$d')

        body_content=$(echo "$body_content" | sed 's/<br \/>/<br>/g')

        echo "$body_content" > "$outputdir/${filename//[^a-zA-Z0-9]/-}.html"
        rm "${filename}_html5.html" "${filename}.html"
    done
}

for dir in "$basedir/${directories[@]}";
do
    if [ -d "$dir" ];
    then
        cd "$dir" || exit
        getHtmlBody
        cd - || exit
    else
        echo "Error: Dir $dir not found"
    fi
done