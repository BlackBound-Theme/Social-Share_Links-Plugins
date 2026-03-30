<?php
/**
 * Plugin Name:       Social Share Pro - Demo
 * Plugin URI:        https://www.codester.com/blackbound
 * Description:       A premium, modern, and lightweight social sharing plugin allowing users to share posts, pages, and custom post types to major social platforms seamlessly.
 * Version:           1.0.0
 * Author:            Blackbound
 * Author URI:        https://www.codester.com/blackbound
 * Text Domain:       social-share-pro
 * Domain Path:       /languages
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'SOCIAL_SHARE_PRO_VERSION', '1.0.0' );
define( 'SOCIAL_SHARE_PRO_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'SOCIAL_SHARE_PRO_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'SSP_DEMO_MODE', true );

require plugin_dir_path( __FILE__ ) . 'includes/class-social-share-core.php';

function run_social_share_pro() {
	$plugin = new Social_Share_Pro_Core();
	$plugin->run();
}
run_social_share_pro();
