<?php

namespace Dev7studios\WPSocialPreview;

class Sidebar extends Base {
	public function init() {
		add_action( 'init', [ $this, 'wp_init' ] );
		add_action( 'enqueue_block_editor_assets', [ $this, 'enqueue_block_editor_assets' ] );
		add_action( 'enqueue_block_assets', [ $this, 'enqueue_block_assets' ] );
	}

	public function wp_init() {
		$assetFile = include( dirname( $this->path ) . '/build/sidebar.asset.php' );

		wp_register_script(
			'wp-social-preview-sidebar',
			$this->url . 'build/sidebar.js',
			$assetFile['dependencies'],
			$assetFile['version']
		);

		wp_register_style(
			'wp-social-preview-sidebar',
			$this->url . 'css/sidebar.css'
		);
	}

	public function enqueue_block_editor_assets() {
		wp_enqueue_script( 'wp-social-preview-sidebar' );
	}

	public function enqueue_block_assets() {
		wp_enqueue_style( 'wp-social-preview-sidebar' );
		wp_enqueue_style( 'wp-social-preview-preview' );

		wp_localize_script( 'wp-social-preview-sidebar', 'WPSocialPreview', [
			'fallback_image' => $this->get_option( 'general_settings_fallback_image' ),
		] );
	}
}
