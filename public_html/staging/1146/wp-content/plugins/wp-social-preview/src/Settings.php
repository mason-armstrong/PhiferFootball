<?php

namespace Dev7studios\WPSocialPreview;

class Settings extends Base {
	/**
	 * @var string
	 */
	protected $slug = 'wp_social_preview';

	public function init() {
		add_action( 'admin_init', [ $this, 'admin_init' ] );
		add_action( 'admin_menu', [ $this, 'admin_menu' ] );
	}

	public function admin_init() {
		register_setting( $this->slug, $this->optionName, [ 'sanitize_callback' => [ $this, 'sanitize_settings' ] ] );

		$this->register_general_settings();
		$this->register_facebook_settings();
		$this->register_twitter_settings();
		$this->register_pinterest_settings();

		wp_register_style( 'wp-social-preview-settings', $this->url . 'css/settings.css' );
	}

	public function admin_menu() {
		$hook = add_options_page(
			__( 'WP Social Preview', $this->textDomain ),
			__( 'WP Social Preview', $this->textDomain ),
			'manage_options',
			$this->slug,
			[
				$this,
				'admin_page',
			]
		);

		add_action( 'load-' . $hook, [ $this, 'load_settings_page' ] );
	}

	public function load_settings_page() {
		add_action( 'admin_enqueue_scripts', [ $this, 'admin_enqueue_scripts' ] );
	}

	public function admin_enqueue_scripts() {
		wp_enqueue_media();
		wp_enqueue_script( 'jquery' );
		wp_enqueue_style( 'wp-social-preview-settings' );
	}

	public function admin_page() {
		require_once dirname( $this->path ) . '/pages/settings.php';
	}

	protected function register_settings_fields( $sectionId, $fields ) {
		foreach ( $fields as $settingId => $setting ) {
			$args         = $setting;
			$args['id']   = $settingId;
			$args['name'] = $this->optionName . '[' . $settingId . ']';

			add_settings_field(
				$settingId,
				__( $setting['title'], $this->textDomain ),
				[ $this, 'setting_' . $setting['type'] ],
				$this->slug,
				$sectionId,
				$args
			);
		}
	}

	protected function register_general_settings() {
		$sectionId = 'general_settings';

		add_settings_section(
			$sectionId,
			__( 'General Settings', $this->textDomain ),
			'',
			$this->slug
		);

		$this->register_settings_fields( $sectionId, [
			$sectionId . '_fallback_image'         => [
				'title'       => 'Fallback Image',
				'description' => 'This image will be used if the content being shared does not contain any images.',
				'type'        => 'image',
			],
			$sectionId . '_front_page_title'       => [
				'title'       => 'Front Page Title',
				'description' => 'Use this title when the front page of the site is being shared.',
				'type'        => 'text',
				'placeholder' => get_bloginfo( 'name' ),
			],
			$sectionId . '_front_page_description' => [
				'title'       => 'Front Page Description',
				'description' => 'Use this description when the front page of the site is being shared.',
				'type'        => 'textarea',
				'placeholder' => get_bloginfo( 'description' ),
			],
			$sectionId . '_front_page_image'       => [
				'title'       => 'Front Page Image',
				'description' => 'Use this image when the front page of the site is being shared.',
				'type'        => 'image',
			],
		] );
	}

	protected function register_facebook_settings() {
		$sectionId = 'facebook_settings';

		add_settings_section(
			$sectionId,
			__( 'Facebook Settings', $this->textDomain ),
			'',
			$this->slug
		);

		$this->register_settings_fields( $sectionId, [
			$sectionId . '_app_id' => [
				'title'       => 'Facebook App ID',
				'description' => 'Enter your app ID if you use Facebook Insights.',
				'type'        => 'text',
			],
		] );
	}

	protected function register_twitter_settings() {
		$sectionId = 'twitter_settings';

		add_settings_section(
			$sectionId,
			__( 'Twitter Settings', $this->textDomain ),
			'',
			$this->slug
		);

		$this->register_settings_fields( $sectionId, [
			$sectionId . '_website_attribution' => [
				'title'       => 'Website Attribution',
				'description' => '@username for the website used in the card footer (including the @).',
				'type'        => 'text',
			],
		] );
	}

	protected function register_pinterest_settings() {
		$sectionId = 'pinterest_settings';

		add_settings_section(
			$sectionId,
			__( 'Pinterest Settings', $this->textDomain ),
			'',
			$this->slug
		);

		$this->register_settings_fields( $sectionId, [
			$sectionId . '_verification_code' => [
				'title'       => 'Verification Code',
				'description' => 'Enter the verification code from the meta tag when claiming your site (just the code, not the whole tag).',
				'type'        => 'text',
			],
		] );
	}

	public function setting_text( $args ) {
		$value = $this->get_option( $args['id'], '' );

		echo '<input type="text" class="regular-text" id="' . esc_attr( $args['id'] ) . '" name="' . esc_attr( $args['name'] ) . '" value="' . esc_attr( $value ) . '"' . ( isset( $args['placeholder'] ) ? ' placeholder="' . esc_attr( $args['placeholder'] ) . '"' : '' ) . '>';

		$this->setting_description( $args );
	}

	public function setting_textarea( $args ) {
		$value = $this->get_option( $args['id'], '' );

		echo '<textarea class="regular-text" rows="5" id="' . esc_attr( $args['id'] ) . '" name="' . esc_attr( $args['name'] ) . '"' . ( isset( $args['placeholder'] ) ? ' placeholder="' . esc_attr( $args['placeholder'] ) . '"' : '' ) . '>' . esc_attr( $value ) . '</textarea>';

		$this->setting_description( $args );
	}

	public function setting_image( $args ) {
		$value = $this->get_option( $args['id'], '' );

		echo '<div class="wpsocpr-preview" id="' . esc_attr( $args['id'] ) . '_preview" style="max-width: 600px; margin-bottom: 10px;">';
		if ( $value ) {
			$img = wp_get_attachment_image_url( $value, 'wp_social_preview_default' );
			echo '<img src="' . $img . '" alt="">';
		}
		echo '</div>';

		echo '<div style="margin-bottom: 10px;">';
		echo '<input type="hidden" class="regular-text wpsocpr-url" id="' . esc_attr( $args['id'] ) . '" name="' . esc_attr( $args['name'] ) . '" value="' . esc_attr( $value ) . '">';
		echo '<button type="button" class="button wpsocpr-browse" data-target="' . esc_attr( $args['id'] ) . '">' . __( 'Choose File', $this->textDomain ) . '</button> ';
		echo '<button type="button" class="button wpsocpr-remove" data-target="' . esc_attr( $args['id'] ) . '"' . ( $value ? '' : ' style="display: none;"' ) . '>' . __( 'Remove Image', $this->textDomain ) . '</button>';
		echo '</div>';

		$this->setting_description( $args );
	}

	protected function setting_description( $args ) {
		if ( ! empty( $args['description'] ) ) {
			echo '<p class="description">' . esc_html( $args['description'] ) . '</p>';
		}
	}

	/**
	 * @param array $input
	 *
	 * @return array
	 */
	public function sanitize_settings( $input ) {
		foreach ( $input as $key => $val ) {
			$input[ $key ] = sanitize_text_field( $val );
		}

		if ( ! empty( $input['twitter_settings_website_attribution'] ) && strpos( $input['twitter_settings_website_attribution'], '@' ) !== 0 ) {
			$input['twitter_settings_website_attribution'] = '@' . $input['twitter_settings_website_attribution'];
		}

		return $input;
	}
}
