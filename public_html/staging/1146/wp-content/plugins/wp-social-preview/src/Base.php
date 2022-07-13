<?php

namespace Dev7studios\WPSocialPreview;

abstract class Base {
	/**
	 * @var string
	 */
	protected $path;

	/**
	 * @var string
	 */
	protected $url;

	/**
	 * @var bool
	 */
	public $isPro;

	/**
	 * @var string
	 */
	protected $textDomain = 'wp-social-preview';

	/**
	 * @var string
	 */
	protected $optionName = 'wp_social_preview_settings';

	/**
	 * @var string
	 */
	protected $metaPrefix = 'wp_social_preview_';

	/**
	 * @param string $path
	 * @param string $url
	 * @param bool $isPro
	 */
	public function __construct( $path, $url, $isPro ) {
		$this->path  = $path;
		$this->url   = $url;
		$this->isPro = $isPro;
	}

	/**
	 * @param string $key
	 * @param mixed|null $default
	 *
	 * @return mixed
	 */
	public function get_option( $key, $default = null ) {
		$options = get_option( $this->optionName );

		return isset( $options[ $key ] ) ? $options[ $key ] : $default;
	}
}
