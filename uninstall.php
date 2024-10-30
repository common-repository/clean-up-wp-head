<?php
if ( !defined('WP_UNINSTALL_PLUGIN') ) {
    exit();
}

delete_option('clean_up_rsd_link');
delete_option('clean_up_wlwmanifest_link');
delete_option('clean_up_wp_generator');
delete_option('clean_up_start_post_rel_link');
delete_option('clean_up_index_rel_link');
delete_option('clean_up_adjacent_posts_rel_link');
delete_option('clean_up_feed_links');
delete_option('clean_up_feed_links_extra');
delete_option('clean_up_feeds');

?>