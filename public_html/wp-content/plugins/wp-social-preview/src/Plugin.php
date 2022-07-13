<?php

namespace Dev7studios\WPSocialPreview;

class Plugin {
	/**
	 * @var string
	 */
	public $path;

	/**
	 * @var string
	 */
	public $url;

	/**
	 * @var bool
	 */
	public $isPro;

	/**
	 * Plugin constructor.
	 *
	 * @param string $path
	 * @param bool $isPro
	 */
	public function __construct( $path, $isPro = false ) {
		$this->path  = $path;
		$this->url   = plugin_dir_url( $path );
		$this->isPro = $isPro;
	}

	public function run() {
		( new SidebarMeta( $this->path, $this->url, $this->isPro ) )->init();

		if ( is_admin() ) {
			( new Settings( $this->path, $this->url, $this->isPro ) )->init();
			( new UserProfile( $this->path, $this->url, $this->isPro ) )->init();
			( new Sidebar( $this->path, $this->url, $this->isPro ) )->init();
		} else {
			( new OpenGraph( $this->path, $this->url, $this->isPro ) )->init();
		}

		add_action( 'init', [ $this, 'init' ] );
	}

	public function init() {
		add_image_size( 'wp_social_preview_default', 1200, 630, true ); // 1.9:1
		add_image_size( 'wp_social_preview_twitter', 1200, 600, true ); // 2:1
		add_image_size( 'wp_social_preview_twitter_square', 600, 600, true ); // 1:1

		wp_register_style(
			'wp-social-preview-preview',
			$this->url . 'css/preview.css'
		);
	}
}
