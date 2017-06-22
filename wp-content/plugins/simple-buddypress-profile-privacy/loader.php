<?php
/*
Plugin Name: Simple Buddypress Profile Privacy
Plugin URI: http://justin-hansen.com/buddypress-profile-privacy
Description: Allow each user to decide if everyone, only logged in users or only friends can see their profile tabs.
Version: 0.7.2
Author: Justin Hansen
Author URI: http://justin-hansen.com
License: GPL2
*/

/**
 * Load files
 */
function sbpp04_include() {
    //Define constants used in plugin.
    define( 'SBPP04_PLUGIN_DIR', dirname( __FILE__ ) );
    define( 'SBPP04_PLUGIN_DOMAIN', 'sbpp04-profile-privacy' );
    define( "SBPP04_VIEW_LOGGED_IN", "logged-in" );
    define( "SBPP04_VIEW_FRIENDS", "friends" );
    define( "SBPP04_VIEW_EVERYONE", "everyone" );
    define( "SBPP04_PRIVACY_SETTING_KEY", "bpp_profile_privacy");
    define( "SBPP04_HIDE_DIRECTORY_KEY", "bpp_hide_directory" );
    define( "SBPP04_ADMIN_HIDE_DIRECTORY_KEY", "sbpp04-hide-directory" );
    define( "SBPP04_ADMIN_NOTIFICATION_HIDDEN_KEY", "sbpp04-update-notice-hidden" );
    define( "SBPP04_FRIENDS_ACTIVE", bp_is_active( 'friends' ) );

    if( is_admin() ){
        require( dirname( __FILE__ ) . '/includes/buddypress-profile-privacy-admin.php' );
    }else{
        require( dirname( __FILE__ ) . '/includes/buddypress-profile-privacy.php' );
    }
}
add_action( 'bp_include', 'sbpp04_include' );

/*
 * Enqueue admin plugin js
 */
function sbpp04_admin_enqueue(){
    wp_enqueue_script( 'simple-buddypress-profile-privacy-admin', plugins_url( 'js/simple-buddypress-profile-privacy-admin.js', __FILE__), array( 'jquery' ), '0.7', true );
}
add_action( 'admin_enqueue_scripts', 'sbpp04_admin_enqueue' );