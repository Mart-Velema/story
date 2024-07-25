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
    echo "===== converting directory $dir ====="
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

        local has_images=false

        for image_file in "$outputdir"/*.{png,jpeg,jpg};
        do
            if [ -e "$image_file" ];
            then
                has_images=true
                break
            fi
        done

        if [ "$has_images" = true ]; 
        then
            if [ ! -d "$outputdir/img/$output_filename" ]
            then
                echo "Making output directory at : $outputdir/img"
                mkdir "$outputdir/img/$output_filename"
            fi

            local amount_of_images_moved=0

            mv "$outputdir"/*.png "$outputdir/img/$output_filename"
            if [ $? -ne 0 ]; 
            then
                echo "Warning: Failed to move PNG files of $file to image directory. This could be because there are no PNG images"
            else
                (($amount_of_images_moved++))
                echo "Moved all PNG images"
            fi

            mv "$outputdir"/*.jpeg "$outputdir/img/$output_filename"
            if [ $? -ne 0 ]; 
            then
                echo "Warning: Failed to move JPEG files of $file to image directory. This could be because there are no JPEG images"
            else
                (($amount_of_images_moved++))
                echo "Moved all JPEG images"
            fi

            mv "$outputdir"/*.jpg "$outputdir/img/$output_filename"
            if [ $? -ne 0 ]; 
            then
                echo "Warning: Failed to move JPG files of $file to image directory. This could be because there are no JPG images"
            else
                (($amount_of_images_moved++))
                echo "Moved all JPG images"
            fi

            if [ $amount_of_images_moved -gt 0 ];
            then
                echo "Error: Failed to move any images to $outputdir/img/$output_filename"
            else
                echo "Succesfully moved images of $file to $outputdir/img/$output_filename"
            fi
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