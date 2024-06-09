# Story updater

Story updater is a collectio of tools to ease the publishing of stories related to the Infinite Night Timeline. It takes ODT files as an input, and extracts the contents into an HTML 5 compatible HTML file, which can be included into other files as part of the HTML body.

# Usage

## Dependencies

The story updater relies on a few packages to work. You can install them with the package manager of your likings, but I only tested this on Ubuntu.
```bash
sudo apt install libreoffice libreoffice-java-common pandoc sed
```

For non Ubuntu based distro, you need these packages from your package manager:
- libreoffice
- pandoc
- sed

## Installing

Before using, you must first configure the config.sh file to be used in the conversion script.
```bash
git clone https://git.infinite-night.com/helenv/story-updater.git
cd story-updater
mv config_example.sh config.sh
```

Now that you have a config.sh file, you can tweak it to your specific needs.
```bash
basedir=        # Directory where the document directories are loacted
outputdir=      # Directory where the HTML files will be saved
directories=    # List of directories where the documents are stored
```

The output directory will most likely be the same as the directory that you have assigned as your DocumentRoot in Apache2. If this is not the case, you can create a symbolic link instead of changing the output directory.
```bash
ln -s /path/to/your/outputdir /var/www/docs
```

## Running the script

Once everything is configured correctly, you can run the script with the following command.
```bash
./extractBodyBulk.sh
```

This will run the script only once, resulting in all the documents being converted. Most likely, you would want to do this periodically, to which I recommend setting up a cronjob to do this once a week.
```bash
crontab -e
```

In this file, you need to add the following line at the bottom:
```
0 0 * * 0 /path/to/this/directory/extractBodyBulk.sh
```

The crontab should automatically reload once you exit the file. After which, it should update periodically, depending on how you have configured the timing intervals.

# Author

[Helen (AKA 1_hele_euro)](https://git.infinite-night.com/helenv)