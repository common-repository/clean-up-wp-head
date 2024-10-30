=== Clean up wp_head ===
Contributors: 	   fredrikmalmgren
Plugin Name:       Clean up wp_head
Plugin URI:        http://fredrikmalmgren.com/wordpress/plugins/clean-up-wp-head/
Tags:              wp_head, wlwmanifest, wp_generator, start_post_rel, rsd, index_rel, adjacent_posts_rel, rss, feed
Author URI:        http://fredrikmalmgren.com
Author:            Fredrik Malmgren   
Requires at least: 3.0.1
Tested up to:      3.4.2
Stable tag:        0.2.1

Use Clean up wp_head to remove unused tags in wp_head.

== Description ==
With Clean up wp_head you can easily remove all those unused tags in wp_head.

= Usage =

1. Go to 'Clean up wp_head' under 'Settings' menu
1. Change the options of your choice

Follow the development of this plugin at [FredrikMalmgren.com](http://fredrikmalmgren.com/wordpress/plugins/clean-up-wp-head/ "Clean up wp_head - Fredrik Malmgren").

== Installation ==

1. Upload the plugin folder to your plugin folder (manually or through 'Plugins' / 'Add new' menu in Wordpress)
1. Activate the plugin through the 'Plugins' menu in WordPress

= Uninstallation = 
1. Deactivate the plugin through the 'Plugins' menu in WordPress
1. Click on delete which will both delete plugin files and data stored in database

**NB:** If you uninstall the plugin in any other way you will manually have to remove these entries the options table:

* clean_up_rsd_link
* clean_up_wlwmanifest_link
* clean_up_wp_generator
* clean_up_start_post_rel_link
* clean_up_index_rel_link
* clean_up_adjacent_posts_rel_link
* clean_up_feed_links
* clean_up_feed_links_extra
* clean_up_feeds

== Screenshots ==
1. Admin panel for removing tags in wp_head

== Changelog ==

= 0.2.1 =
* Removed: File with code snippets
* Updated: Readme.txt

= 0.2.0 =
* New: Added options for removing feeds from wp_admin
* New: Added options for disabling feeds

= 0.1.1 =
* Bugfix: Missing PHP closing tag
* Changed: Uses adjacent_posts_rel_link_wp_head instead of adjacent_posts_rel_link

= 0.1.0 =
* Initial release