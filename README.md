CONTENTS OF THIS FILE
---------------------
* Introduction
* Requirements
* Installation
* Configuration
* Usage

INTRODUCTION
------------
Platform.gsa.gov.gov project using docker.

This is a repo containing the dockerized version of the platform.gsa.gov WordPress site environment.

REQUIREMENTS
------------
This site requires docker to run. https://www.docker.com

INSTALLATION
------------
* Install docker on local machine
   See https://www.docker.com/get-docker for further information.
* Clone this repository onto local machine that is running docker
* Create new DB on local machine called 'sitesgsa' (if different name is used it must be updated in dev.env)
* Grab a copy of the production db from https://gsa-ci.ctacdev.com/job/platform-docker/job/platform-fetch-db-backup/
* Run sed statement to turn production links to local ones (ex. sed -ie 's/platform.gsa.gov/platform.gsa.local/g' <.sqlfile>)
* Load updated sql with .local urls into newly created database
* Setup hosts file entries to 192.168.99.100 or whatever IP that you have docker running on for platform.gsa.local
* Add a 'return;' to the beginning of /app/<project>/wp-content/plugins/omb-max/omb-max.php. This will disable the plugin that forces admins to login using OMB MAX so we can use l/p locally
* Build PHP/WP docker images if you haven't already and start up the project.

CONFIGURATION
-------------
* Run UPDATE wp_users SET user_pass = '$P$BT3Z5Il.Rrk5qX6bXx8YHTieNpPXtK.' in database for any user; (this will switch the account pwd to 'admin', so you can now login as <username>/admin)
* You should now be able to login from https://platform.gsa.local/wp-login.php
* If you run into any issues with the site not loading, check dev.env and make sure the db info matches yours as all of this gets injected into wp-config.php

USAGE
------------
After installing and configuring this site will run locally as a normal WordPress site. See https://wordpress.org/ for any additional information on WordPress