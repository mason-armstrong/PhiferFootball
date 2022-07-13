<?php

namespace Dev7studios\WPSocialPreview;

class SidebarMeta extends Base {

	public function init() {
		add_action( 'init', [ $this, 'registerMetaKeys' ] );
	}

	public function registerMetaKeys() {
		$postTypes = [ 'post', 'page' ];

		foreach ( $postTypes as $postType ) {
			register_post_meta( $postType, $this->metaPrefix . 'title', [
				'show_in_rest' => true,
				'single'       => true,
				'type'         => 'string',
			] );

			register_post_meta( $postType, $this->metaPrefix . 'description', [
				'show_in_rest' => true,
				'single'       => true,
				'type'         => 'string',
			] );

			register_post_meta( $postType, $this->metaPrefix . 'image', [
				'show_in_rest' => true,
				'single'       => true,
				'type'         => 'integer',
			] );
		}
	}
}