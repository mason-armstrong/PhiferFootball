<?php
/*
Plugin Name:  WP Social Preview
Plugin URI:   https://wpsocialpreview.com
Description:  Previewing and manage how your content will look on social media sites before sharing it.
Author:       Iain Poulson
Author URI:   https://wpsocialpreview.com/
Version:      1.0.2
Requires PHP: 7.1
Requires WP:  5.3
License:      GPLv2 or later
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Text Domain:  wp-social-preview
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
	require_once __DIR__ . '/vendor/autoload.php';
}

if ( ! function_exists( 'wpsocpr_deactivate_other_instances' ) ) {
	require_once dirname( __FILE__ ) . '/util/deactivate.php';
}

add_action( 'activated_plugin', 'wpsocpr_deactivate_other_instances' );

/**
 * @return bool
 */
function wp_social_preview() {
	if ( isset( $GLOBALS['wp_social_preview'] ) && $GLOBALS['wp_social_preview'] instanceof \Dev7studios\WPSocialPreview\Plugin ) {
		return $GLOBALS['wp_social_preview'];
	}

	$GLOBALS['wp_social_preview'] = new \Dev7studios\WPSocialPreview\Plugin( __FILE__ );
	$GLOBALS['wp_social_preview']->run();

	return true;
}

add_action( 'plugins_loaded', 'wp_social_preview' );
