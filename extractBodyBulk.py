import pypandoc as pandoc
import os
from config import input_directory, output_directory, sub_directories

def convert_odt_to_html(sub_directory, filename):
    base_name, file_extention = os.path.splitext(filename)
    if file_extention.lower() != ".odt":
        return

    final_file_name = \
        f"{sub_directory}-|-{base_name}.html" \
        .replace(' ', '-') \
        .lower()
    
    source_file = os.path.join(input_directory, sub_directory, filename)
    output_file = os.path.join(output_directory, final_file_name)

    try:
        print(f'Converting file: {source_file}')
        pandoc.convert_file(
            source_file = source_file,
            to = 'html5',
            outputfile = output_file,
            extra_args = [
                '--toc',
                f'--extract-media={os.path.join(output_directory, "assets")}',
                '--template=html.template',
                '--lua-filter=filter.lua',
                '--self-contained',
                '--quiet'
            ]
        )
        print(f'Converted file to: {final_file_name}')
    except Exception as ex:
        print(f'Failed to convert file {final_file_name}: {ex}')

# preparing directories
os.makedirs(output_directory + '/assets', exist_ok=True)

for sub_directory in sub_directories:
    sub_dir_path = os.path.join(input_directory, sub_directory)
    for file in os.listdir(sub_dir_path):
        convert_odt_to_html(sub_directory, file)