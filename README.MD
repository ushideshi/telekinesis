# README

Telekinesis is a small Wordpress plugin that allows remote updates on a website

### Installation

Dowload and install as you would do for a standard Wordpress plugin

### Configuration

Access /wp-admin/tools.php?page=telekinesis or Tools -> Telekinesis and set up a secret key.

### Usage

The plugin on itself won't do anything if you do not access the url provided 

`example.com/telekinesis-report/[secret.key]` will proceed to
 
 - Check that `wp-cli` is available or download it if needed
 - Return a report on available core updates and plugins updates in `json` format.

`example.com/telekinesis-update/[secret.key]` will proceed to 
 - Check if a /dumps/ folder exists on the server
 - Create an .htaccess file that redirects to a 404 in order to block direct access / indexing the /dumps/ dir
 - Create a database backup in gz format and name it accordingly
 - Create a wp-content/plugins backup in gz format and name it accordingly
 - Check that `wp-cli` is available or download it if needed
 - Update Wordpress Core
 - Update the plugins
 - Report everything in a `json` format response

