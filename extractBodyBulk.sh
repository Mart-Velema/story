#!/bin/bash

source config.sh

if [ ! -d $outputdir ];
then
    echo "Making output directory at : $outputdir"
    mkdir "$outputdir"
fi

if [ ! -d "$outputdir/img" ]
then
    echo "Making output directory at : $outputdir/img"
    mkdir "$outputdir/img"
fi

getHtmlBody() 
{
    local dir="$1"
    local directoryName=$(echo "${2//[^a-zA-Z0-9]/-}" | tr '[:upper:]' '[:lower:]')
    for file in "$dir"/*.odt; 
    do
        local filename=$(basename -- "$file")
        echo "===== converting $dir ====="
        filename="${filename%.*}"
        local output_filename=$(echo "${filename//[^a-zA-Z0-9]/-}" | tr '[:upper:]' '[:lower:]')

        libreoffice --headless --convert-to html "$file" --outdir "$outputdir"
        if [ $? -ne 0 ];
        then
            echo "Error: Failed to convert ODT $file to HTML"
            continue
        fi

        local htmlFile="$outputdir/$filename.html"
        if [ ! -f "$htmlFile" ];
        then
            echo "Error: $htmlFile not found after conversion"
            rm -f *.png
            continue
        fi

        local body_content=$(
            pandoc "$htmlFile" --standalone --to html5 --quiet | \
            sed -n "/<body.*>/,/<\/body>/p" | \
            sed "1d;\$d" | \
            sed "s/<br \/>/<br>/g" | \
            sed "s/\(<h1[^>]*>\)/<hr>\n\1/g" | \
            sed "s|<img src=\"|<img src=\"output/img/$output_filename/|g" 
        )

        if [ $? -ne 0 ];
        then
            echo "Error: Failed to convert $htmlFile to HTML5"
            rm -fv "$htmlFile"
            rm -fv *.png
            continue
        fi
        
        echo "$body_content" > "$outputdir/$directoryName-$output_filename.html"
        if [ $? -ne 0 ];
        then
            echo "Error: Failed to put output into $outputdir/$directoryName-$output_filename.html"
            continue
        fi
        echo "Succesfully converted $file to $outputdir/$directoryName-$output_filename.html"

        if ls "$outputdir"/*.png 1> /dev/null 2>&1; 
        then
            if [ ! -d "$outputdir/img/$output_filename" ]
            then
                echo "Making output directory at : $outputdir/img"
                mkdir "$outputdir/img/$output_filename"
            fi

            mv -v "$outputdir"/*.png "$outputdir/img/$output_filename"

            if [ $? -ne 0 ]; 
            then
                echo "Error: Failed to move images of $file to image directory"
                continue
            fi
            echo "Succesfully moved images of $file to $outputdir/img/"
        else
            echo "No images to move for $file"
        fi

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