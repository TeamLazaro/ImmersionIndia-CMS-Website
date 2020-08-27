
#! /bin/bash

while getopts "p:" opt; do
	case ${opt} in
		p )
			PROJECT_DIR=${OPTARG}
			;;
	esac
done

# Establish symbolic links for the following:
# # the configuration file
rm -rf conf.php
ln -s ../environment/${PROJECT_DIR}/conf.php conf.php
# # the content directory
rm -rf content
ln -s ../environment/${PROJECT_DIR}/content content
