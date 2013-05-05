=== Plugin Name ===
Contributors: igorcek
Tags: wordpress mu, post
Requires at least: 3.5
Tested up to: 3.5.1
Stable tag: 0.1
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Allow display posts form one site to all sites of a Wordpress MU network installation. 
Merge the post from one category of first site to the second category on the second website.  

== Description ==

Is possible to define the categories of post of the two sites, number of posts and the order.
For display post of both categories in child site theme use this shortcode syntax:

[mupost blogid=XX maincategoryid=YY selfcategoryid=YY order=asc/desc]



== Installation ==

This section describes how to install the plugin and get it working.

1. Upload `postmu` directory to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Place `[mupost blogid=XX maincategoryid=YY selfcategoryid=YY order=asc/desc]` in your templates

== Frequently Asked Questions ==

== Screenshots ==

== Changelog ==

= 0.1 =
* The first release.



