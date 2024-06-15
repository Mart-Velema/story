#!/bin/bash

source config.sh

if [ ! -d $outputdir ];
then
    echo "Making output directory at : $outputdir"
    mkdir "$outputdir"
fi

getHtmlBody() 
{
    local dir="$1"
    local directoryName=$(echo "${2//[^a-zA-Z0-9]/-}" | tr '[:upper:]' '[:lower:]')
    for file in "$dir"/*.odt; 
    do
        libreoffice --headless --convert-to html "$file" --outdir "$dir"
        if [ $? -ne 0 ];
        then
            echo "Error: Failed to convert ODT $file to HTML"
            continue
        fi

        local filename=$(basename -- "$file")
        filename="${filename%.*}"

        local htmlFile="$dir/$filename.html"
        if [ ! -f "$htmlFile" ];
        then
            echo "Error: $htmlFile not found after conversion"
            continue
        fi

        local body_content=$(pandoc "$htmlFile" --standalone --to html5 --quiet | sed -n '/<body.*>/,/<\/body>/p' | sed '1d;$d' | sed 's/<br \/>/<br>/g')
        if [ $? -ne 0 ];
        then
            echo "Error: Failed to convert $htmlFile to HTML5"
            rm -f "$htmlFile"
            continue
        fi

        local output_filename=$(echo "${filename//[^a-zA-Z0-9]/-}" | tr '[:upper:]' '[:lower:]')
        
        echo "$body_content" > "$outputdir/$directoryName-$output_filename.html"

        rm -f "$htmlFile"
    done
}

for dir in "${directories[@]}"; 
do
    fullpath="$basedir/$dir"
    if [ -d "$fullpath" ];
    then
        getHtmlBody "$fullpath" "$dir"
    else
        echo "Error: Dir $fullpath not found"
    fi
done