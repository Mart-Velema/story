# Story updater

Story updater is a collectio of tools to ease the publishing of stories related to the Infinite Night Timeline. It takes ODT files as an input, and extracts the contents into an HTML 5 compatible HTML file, which can be included into other files as part of the HTML body.

# Installation

This installation guide is for the Python based extractor. The depricated Bash version is still included, but is not supportet anymore

## Dependencies

The story updater relies on a few packages to work. You can install them with the package manager of your likings, but I only tested this on Ubuntu.
```bash
sudo apt install python3 python3-pip pandoc
```

For non Ubuntu based distro, you need these packages from your package manager:
- python3
- pip
- pandoc

You also will need the python package pypandoc, which can be installed with pip.
```bash
pip install pypandoc
```

## Installing

Before using, you must first configure the config.sh file to be used to automatically update if wanted.
```bash
git clone https://git.infinite-night.com/helenv/story-updater.git
cd story-updater
mv config_example.py config.py
```

Update the config.py to use the correct directories
```python
output_directory    # Directory where the document directories are loacted
input_directory     # Directory where the HTML files will be saved
sub_directoreis     # List of directories where the documents are stored
```

## Running the script

Once everything is configured correctly, you can run the script with the following command.
```bash
python extractBodyBulk.py
```

# Setting up a cronjob

This will run the script only once, resulting in all the documents being converted. Most likely, you would want to do this periodically, to which I recommend setting up a cronjob to do this once a week.
```bash
crontab -e
```

In this file, you need to add the following line at the bottom:
```
0 0 * * 0 /path/to/this/directory/update.sh
```

The crontab should automatically reload once you exit the file. After which, it should update periodically, depending on how you have configured the timing intervals.

# Author

[Helen (AKA 1_hele_euro)](https://git.infinite-night.com/helenv)