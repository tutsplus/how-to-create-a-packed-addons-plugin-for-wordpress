<?php 
    /*
    Plugin Name: Ninzio add-ons
    Plugin URI: http://www.ninzio.com
    Text Domain: ninzio-addons
    Domain Path: /languages/
    Description: Plugin comes with Ninzio Themes to extend theme functionality (shortcodes, portfolio, ninzio slider)
    Author: Ninzio Themes
    Version: 1.0
    Author URI: http://ninzio.com
    */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

function ninzio_addons_load_plugin_textdomain() {
    load_plugin_textdomain( 'ninzio-addons', false, dirname( plugin_basename(__FILE__) ) . '/languages/' );
}
add_action( 'plugins_loaded', 'ninzio_addons_load_plugin_textdomain' );

define( 'NINZIO_ADDONS', plugin_dir_path( __FILE__ ));

require_once('/includes/ninzio-functions.php');
require_once('ninzio-widgets/ninzio-recent-tweets.php' );
require_once('ninzio-widgets/ninzio-mailchimp.php' );
require_once('ninzio-projects/ninzio-projects.php' );
require_once('ninzio-shortcodes/ninzio-shortcodes.php' );

function ninzio_addons_enqueue_script(){
    if(!is_admin()){
        // enqueue your scripts and styles here
    }
}
add_action( 'wp_enqueue_scripts', 'ninzio_addons_enqueue_script' );

function ninzio_addons_projects_single_template($single_template) {
    global $post;
    if ($post->post_type == 'projects') {
        if ( $theme_file = locate_template( array ( 'single-projects.php' ) ) ) {
            $single_template = $theme_file;
        } else {
            $single_template = NINZIO_ADDONS . 'ninzio-projects/single-projects.php';
        }
    }
    return $single_template;
}
add_filter( "single_template", "ninzio_addons_projects_single_template", 20 );

function ninzio_addons_projects_archive_template($archive_template) {
    global $post;
    if ($post->post_type == 'projects') {
        if ( $theme_file = locate_template( array ( 'archive-projects.php' ) ) ) {
            $archive_template = $theme_file;
        } else {
            $archive_template = NINZIO_ADDONS . 'ninzio-projects/archive-projects.php';
        }
    }
    return $archive_template;
}
add_filter( "archive_template", "ninzio_addons_projects_archive_template", 20 );

function ninzio_addons_projects_taxonomy_template($taxonomy_template) {
    if (is_tax('projects-category')) {

        if ( $theme_file = locate_template( array ( 'taxonomy-projects.php' ) ) ) {
            $taxonomy_template = $theme_file;
        } else {

            $taxonomy_template = NINZIO_ADDONS . 'ninzio-projects/taxonomy-projects.php';
        }

    }
    return $taxonomy_template;
}
add_filter( "taxonomy_template", "ninzio_addons_projects_taxonomy_template", 20 );
?>