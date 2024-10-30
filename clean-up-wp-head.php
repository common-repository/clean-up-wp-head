<?php
/*
Plugin Name: Clean up wp_head
Plugin URI: http://fredrikmalmgren.com/wordpress/plugins/clean-up-wp-head/
Description: Clean up wp_head from unnecessary tags
Version: 0.2.1
Author: Fredrik Malmgren	
Author URI: http://fredrikmalmgren.com/
*/

$clean_up_wp_head = new clean_up_wp_head;
	
class clean_up_wp_head {
	
	function __construct() {
		add_action( 'init', array( $this, 'init' ) );		
	}

	function init() {
		add_action( 'admin_init', array( $this, 'admin_init' ) );
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );

		if(get_option( 'clean_up_rsd_link' ) == true ){
			remove_action('wp_head', 'rsd_link');
		}		
		if(get_option( 'clean_up_wlwmanifest_link' ) == true ){
			remove_action('wp_head', 'wlwmanifest_link');
		}	
		if(get_option( 'clean_up_wp_generator' ) == true ){
			remove_action('wp_head', 'wp_generator');
		}	
		if(get_option( 'clean_up_start_post_rel_link' ) == true ){
			remove_action('wp_head', 'start_post_rel_link');
		}		
		if(get_option( 'clean_up_index_rel_link' ) == true ){
			remove_action('wp_head', 'index_rel_link');
		}		
		if(get_option( 'clean_up_adjacent_posts_rel_link' ) == true ){
			remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
		}				
		if(get_option( 'clean_up_feed_links' ) == true ){
			remove_action( 'wp_head', 'feed_links', 2 );
		}
		if(get_option( 'clean_up_feed_links_extra' ) == true ){
			remove_action( 'wp_head', 'feed_links_extra', 3 );
		}
		if(get_option( 'clean_up_feeds' ) == true ){
			remove_action('do_feed_rdf', 'do_feed_rdf', 10, 1);
			remove_action('do_feed_rss', 'do_feed_rss', 10, 1);
			remove_action('do_feed_rss2', 'do_feed_rss2', 10, 1);
			remove_action('do_feed_atom', 'do_feed_atom', 10, 1);
		}		
	}

	function admin_init() {
		wp_register_style('clean_up_wp_head_css', plugins_url('clean-up-wp-head.css', __FILE__));
		
		register_setting( 'clean_up_wp_head_settings_page', 'easy_excerpt' );
		add_settings_section( 'default', 'Remove unwanted tags from wp_head', array( $this, 'option_content' ), 'clean_up_wp_head_settings_page' );
		
		register_setting( 'clean_up_wp_head_settings_page', 'clean_up_rsd_link' );
		add_settings_field( 'clean_up_rsd_link', 'Really Simple Discovery', array( $this, 'rds_link' ), 'clean_up_wp_head_settings_page', 'default' );
		
		register_setting( 'clean_up_wp_head_settings_page', 'clean_up_wlwmanifest_link' );
		add_settings_field( 'clean_up_wlwmanifest_link', 'Windows Live Writer', array( $this, 'wlwmanifest_link' ), 'clean_up_wp_head_settings_page', 'default' );

		register_setting( 'clean_up_wp_head_settings_page', 'clean_up_wp_generator' );
		add_settings_field( 'clean_up_wp_generator', 'WordPress Generator', array( $this, 'wp_generator' ), 'clean_up_wp_head_settings_page', 'default' );

		register_setting( 'clean_up_wp_head_settings_page', 'clean_up_start_post_rel_link' );
		add_settings_field( 'clean_up_start_post_rel_link', 'Post Relational Links - Start', array( $this, 'start_post_rel_link' ), 'clean_up_wp_head_settings_page', 'default' );

		register_setting( 'clean_up_wp_head_settings_page', 'clean_up_index_rel_link' );
		add_settings_field( 'clean_up_index_rel_link', 'Post Relational Links - Index', array( $this, 'index_rel_link' ), 'clean_up_wp_head_settings_page', 'default' );		

		register_setting( 'clean_up_wp_head_settings_page', 'clean_up_adjacent_posts_rel_link' );
		add_settings_field( 'clean_up_adjacent_posts_rel_link', 'Post Relational Links - Next, Prev', array( $this, 'adjacent_posts_rel_link' ), 'clean_up_wp_head_settings_page', 'default' );

		register_setting( 'clean_up_wp_head_settings_page', 'clean_up_feed_links' );
		add_settings_field( 'clean_up_feed_links', 'Post and Comment Feed', array( $this, 'feed_links' ), 'clean_up_wp_head_settings_page', 'default' );				

		register_setting( 'clean_up_wp_head_settings_page', 'clean_up_feed_links_extra' );
		add_settings_field( 'clean_up_feed_links_extra', 'Extra feeds such as category feeds', array( $this, 'feed_links_extra' ), 'clean_up_wp_head_settings_page', 'default' );	
		
		register_setting( 'clean_up_wp_head_settings_page', 'clean_up_feeds' );
		add_settings_field( 'clean_up_feeds', 'Disable Feeds', array( $this, 'feeds' ), 'clean_up_wp_head_settings_page', 'default' );			
		
	}	
	
	function admin_menu() {
		$page = add_options_page( 'wp_head Options', 'Clean up wp_head', 'manage_options', 'clean_up_wp_head', array( $this, 'options' ) );
        add_action('admin_print_styles-' . $page, array( $this, 'admin_register_css' ) );
	}

	function options() {
		echo '<div class="wrap">';
		screen_icon();
		echo '<h2>Clean up wp_head</h2>';
		echo '<form action="options.php" method="post">';
		settings_fields('clean_up_wp_head_settings_page');
		do_settings_sections('clean_up_wp_head_settings_page');
		echo '<p class="submit"><input type="submit" name="Submit" class="button-primary" value="Save Changes" /></p>';
		echo '</form></div>';
	}

	function admin_register_css()
    {
        wp_enqueue_style('clean_up_wp_head_css');
    }
	
	/*
	* Functions for adding form fields
	*/
	
	function rds_link() {
?>
	<input type="checkbox" name="clean_up_rsd_link" id="clean_up_rsd_link" value="1" <?php checked( (bool) get_option( 'clean_up_rsd_link' ) ); ?>" />
	<label for="clean_up_rsd_link" class="small">RSD - Really Simple Discovery, is the discover mechanism used by XML-RPC clients.</label>
<?php
	}
	function wlwmanifest_link() {
?>
	<input type="checkbox" name="clean_up_wlwmanifest_link" id="clean_up_wlwmanifest_link" value="1" <?php checked( (bool) get_option( 'clean_up_wlwmanifest_link' ) ); ?>" />
	<label for="clean_up_wlwmanifest_link" class="small">Code used by Windows Live Writer.</label>
<?php
	}
	function wp_generator() {
?>
	<input type="checkbox" name="clean_up_wp_generator" id="clean_up_wp_generator" value="1" <?php checked( (bool) get_option( 'clean_up_wp_generator' ) ); ?>" />
	<label for="clean_up_wp_generator" class="small">Displays WordPress version.</label>
<?php
	}	
	function start_post_rel_link() {
?>
	<input type="checkbox" name="clean_up_start_post_rel_link" id="clean_up_start_post_rel_link" value="1" <?php checked( (bool) get_option( 'clean_up_start_post_rel_link' ) ); ?>" />
	<label for="clean_up_start_post_rel_link" class="small">Display relational link for the first post.</label>
<?php
	}	
	function index_rel_link() {
?>
	<input type="checkbox" name="clean_up_index_rel_link" id="clean_up_index_rel_link" value="1" <?php checked( (bool) get_option( 'clean_up_index_rel_link' ) ); ?>" />
	<label for="clean_up_index_rel_link" class="small">Display relational link for the site index.</label>
<?php
	}		
	function adjacent_posts_rel_link() {
?>
	<input type="checkbox" name="clean_up_adjacent_posts_rel_link" id="clean_up_adjacent_posts_rel_link" value="1" <?php checked( (bool) get_option( 'clean_up_adjacent_posts_rel_link' ) ); ?>" />
	<label for="clean_up_adjacent_posts_rel_link" class="small">Display relational links for the posts adjacent to the current post.</label>
<?php
	}	

	function feed_links() {
?>
	<input type="checkbox" name="clean_up_feed_links" id="clean_up_feed_links" value="1" <?php checked( (bool) get_option( 'clean_up_feed_links' ) ); ?>" />
	<label for="clean_up_feed_links" class="small">Displays the main feed and comments feed. This will only hide the feeds from the browser. It is still accessible if you know the link.</label>
<?php
	}

	function feed_links_extra() {
?>
	<input type="checkbox" name="clean_up_feed_links_extra" id="clean_up_feed_links_extra" value="1" <?php checked( (bool) get_option( 'clean_up_feed_links_extra' ) ); ?>" />
	<label for="clean_up_feed_links_extra" class="small">Displays extra feeds for example categories. This will only hide the feeds from the browser. It is still accessible if you know the link.</label>
<?php
	}
	
	function feeds() {
?>
	<input type="checkbox" name="clean_up_feeds" id="clean_up_feeds" value="1" <?php checked( (bool) get_option( 'clean_up_feeds' ) ); ?>" />
	<label for="clean_up_feeds" class="small">Disable all feeds. Feeds are not accessible through direct link, however they are still visible to the browser. Use this together with the other feed options.</label>
<?php
	}
	
	function option_content() {
		echo "<p>With Clean up wp_head you can remove unused tags from your pages.</p>";
	}

}
?>