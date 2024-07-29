import pypandoc as pandoc
import os
from config import *
import pkg_resources

def convert_odt_to_html(sub_directory, filename):
    final_file_name = \
        (sub_directory + '-' + filename) \
        .replace(' ', '-') \
        .lower() \
        .strip('.odt')
    print('Converting file: ' + input_directory + '/' + sub_directory + '/' + filename)
    pandoc.convert_file(
        source_file = input_directory + '/' + sub_directory + '/' + filename,
        to = 'html5',
        outputfile = output_directory + '/' + final_file_name + '.html',
        extra_args = [
            '--toc',
            '--extract-media=' + output_directory + '/assets',
            '--template=html.template',
            '--lua-filter=filter.lua',
            '--quiet'
        ]
    )
    print('Converted file to: ' + final_file_name)


# preparing directories
os.makedirs(output_directory + '/assets', exist_ok=True)

for sub_directory in sub_directories:
    for file in os.listdir(input_directory + '/' + sub_directory):
        if file[-4:] == '.odt':
            convert_odt_to_html(sub_directory, file)