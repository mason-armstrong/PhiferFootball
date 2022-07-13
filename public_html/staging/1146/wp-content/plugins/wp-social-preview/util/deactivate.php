<?php

/**
 * @return array
 */
function wpsocpr_get_active_plugins() {
	if ( is_multisite() ) {
		$active_plugins = (array) get_site_option( 'active_sitewide_plugins', [] );
		$active_plugins = array_keys( $active_plugins );
	} else {
		$active_plugins = (array) get_option( 'active_plugins', [] );
	}

	return $active_plugins;
}

/**
 * Checks if another version of the plugin is active and deactivates it.
 * To be hooked on `activated_plugin` so other plugin is deactivated when current plugin is activated.
 *
 * @param string $plugin
 *
 */
function wpsocpr_deactivate_other_instances( $plugin ) {
	if ( ! in_array( basename( $plugin ), [ 'wp-social-preview.php', 'wp-social-preview-pro.php' ] ) ) {
		return;
	}

	$plugin_to_deactivate  = 'wp-social-preview.php';
	$deactivated_notice_id = '1';
	if ( basename( $plugin ) == $plugin_to_deactivate ) {
		$plugin_to_deactivate  = 'wp-social-preview-pro.php';
		$deactivated_notice_id = '2';
	}

	$active_plugins = wpsocpr_get_active_plugins();

	foreach ( $active_plugins as $basename ) {
		if ( false !== strpos( $basename, $plugin_to_deactivate ) ) {
			set_transient( 'wp_social_preview_deactivated_notice_id', $deactivated_notice_id, 1 * HOUR_IN_SECONDS );
			deactivate_plugins( $basename );

			return;
		}
	}
}
