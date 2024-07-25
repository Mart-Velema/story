#!/bin/bash

source config.sh

if [ -z "$outputdir" ];
then
    echo "$outputdir is not defined! This might cause critical issues, and should be fixed IMMEDIATELY"
    exit 1
elif [ ! -d "$outputdir" ];
then
    echo "Making output directory at: $outputdir"
    mkdir "$outputdir"
else
    echo "Empying $outputdir"
    rm -fv "$outputdir/"*
fi

if [ ! -d "$outputdir/img" ]
then
    echo "Making output directory at : $outputdir/img"
    mkdir "$outputdir/img"
else
    echo "Emptying images from $outputdir"
    rm -rfv "$outputdir/img/"*
fi

getHtmlBody() 
{
    local dir="$1"
    local directoryName=$(echo "${2//[^a-zA-Z0-9]/-}" | tr '[:upper:]' '[:lower:]')
    echo "===== converting directory $dir ====="

    files=$(ls "$dir"/*.odt 2> /dev/null | wc -l)
    if [ "$files" = "0" ]
    then
        echo "Warning: directory $dir does not contain any .odt files"
        return
    fi

    for file in "$dir"/*.odt; 
    do
        local filename=$(basename -- "$file")
        echo "===== converting $filename ====="
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
            sed -n '/<body[^>]*>/,/<\/body>/ {
                /^<body[^>]*>/d
                /<\/body>/d
                s/<br \/>/<br>/g
                s/<h1[^>]*>/<hr>\n&/g
                s|<img src="|<img alt="image from '"$output_filename"'\" src="output/img/'$output_filename'/|g
                p
            }'
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

        local image_file_extentions=('jpg' 'jpeg' 'png')
        local used_image_file_extentions=()


        for i in "${image_file_extentions[@]}";
        do
            if [ -e "$outputdir"/*."$i" ];
            then
                used_image_file_extentions+="$i"
            fi
        done

        if [ "${#used_image_file_extentions[@]}" -gt 0 ]; 
        then
            if [ ! -d "$outputdir/img/$output_filename" ]
            then
                echo "Making output directory at : $outputdir/img"
                mkdir "$outputdir/img/$output_filename"
            fi

            for i in "${used_image_file_extentions[@]}";
            do
                mv "$outputdir"/*."$i" "$outputdir/img/$output_filename"
                if [ $? -ne 0 ]; 
                then
                    echo "Error: Failed to move images to $outputdir/img/$output_filename"
                else
                    echo "Moved all images to $outputdir/img/$output_filename"
                fi
            done
        else
            echo "No images to move for $output_filename"
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