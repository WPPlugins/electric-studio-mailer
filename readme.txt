=== Electric Studio Mailer ===
Contributors: irvingswiftj, Electric Studio
Tags: email, developing, utility, mail, smtp, contact
Requires at least: 3.1
Tested up to: 3.2.1
Stable tag: 1.1

Creates an easy function for sending mail from your Wordpress site

== Description ==

This plugin adds a function called 'esm_send' that sends an email. Mail Server settings can easily be changed from the wp-admin interface.

The function works like so:
`esm_send($from, $to, $content, $subj = "", $fromName = "");`


== Installation ==

Install from wordpress plugins directory.

Else, to install manually:

1. Upload unzipped plugin folder to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress

== Screenshots ==

1. Admin interface for Mail settings

== Changelog ==

= 1.0 =
* Version 1.

= 1.1 =
* Fixed bug that caused fatal error is used more than once on the same page

== Upgrade Notice ==

= 1.0 =
* Inital Release

= 1.1 =
* Bug Fix
