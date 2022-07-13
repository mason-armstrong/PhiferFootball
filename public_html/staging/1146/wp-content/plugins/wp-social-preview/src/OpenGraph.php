<?php

namespace Dev7studios\WPSocialPreview;

class OpenGraph extends Base {
	public function init() {
		add_action( 'wp_head', [ $this, 'add_meta_tags' ] );
	}

	public function add_meta_tags() {
		echo $this->generateMetaTags();
	}

	/**
	 * @return string
	 */
	public function generateMetaTags() {
		$output = '<meta property="og:locale" content="' . esc_attr( $this->getLocale() ) . '" />' . "\n";
		$output .= '<meta property="og:url" content="' . esc_url( $this->getUrl() ) . '" />' . "\n";

		if ( $title = $this->getTitle() ) {
			$title = wp_strip_all_tags( $title );

			$output .= '<meta property="og:title" content="' . esc_attr( $title ) . '" />' . "\n";
			$output .= '<meta name="twitter:title" content="' . esc_attr( $title ) . '" />' . "\n";
		}
		if ( $description = $this->getDescription() ) {
			$description = wp_strip_all_tags( $description );

			$output .= '<meta property="og:description" content="' . esc_html( $description ) . '" />' . "\n";
			$output .= '<meta name="twitter:description" content="' . esc_html( $description ) . '" />' . "\n";
		}
		if ( $type = $this->getType() ) {
			$output .= '<meta property="og:type" content="' . esc_attr( $type ) . '" />' . "\n";

			if ( $type === 'article' ) {
				$output .= '<meta property="og:article:published_time" content="' . esc_attr( $this->getArticlePublishedTime() ) . '" />' . "\n";
				if ( $modifiedTime = $this->getArticleModifiedTime() ) {
					$output .= '<meta property="og:article:modified_time" content="' . esc_attr( $modifiedTime ) . '" />' . "\n";
					$output .= '<meta property="og:updated_time" content="' . esc_attr( $modifiedTime ) . '" />' . "\n";
				}
				if ( $twitterCreator = $this->getTwitterCreator() ) {
					$output .= '<meta name="twitter:creator" content="' . esc_attr( $twitterCreator ) . '" />' . "\n";
				}
			}
		}
		if ( $imageId = $this->getImageId() ) {
			$imageData = $this->getImageData( $imageId );
			if ( ! empty( $imageData['url'] ) ) {
				$output .= '<meta property="og:image" content="' . esc_url( $imageData['url'] ) . '" />' . "\n";
				$output .= '<meta name="twitter:card" content="summary_large_image" />' . "\n";
				$output .= '<meta name="twitter:image" content="' . esc_url( $imageData['url'] ) . '" />' . "\n";
			}
			if ( ! empty( $imageData['width'] ) ) {
				$output .= '<meta property="og:image:width" content="' . esc_attr( $imageData['width'] ) . '" />' . "\n";
			}
			if ( ! empty( $imageData['height'] ) ) {
				$output .= '<meta property="og:image:height" content="' . esc_attr( $imageData['height'] ) . '" />' . "\n";
			}
		}
		if ( $facebookAppId = $this->get_option( 'facebook_settings_app_id' ) ) {
			$output .= '<meta property="fb:app_id" content="' . esc_attr( $facebookAppId ) . '" />' . "\n";
		}
		if ( $twitterSite = $this->get_option( 'twitter_settings_website_attribution' ) ) {
			$output .= '<meta name="twitter:site" content="' . esc_attr( $twitterSite ) . '" />' . "\n";
		}
		if ( $pinterestVerification = $this->get_option( 'pinterest_settings_verification_code' ) ) {
			$output .= '<meta name="p:domain_verify" content="' . esc_attr( $pinterestVerification ) . '" />' . "\n";
		}

		return "<!-- WP Social Preview -->\n" .
		       apply_filters( 'wp_social_preview_open_graph_meta_tags', $output ) .
		       "<!-- / WP Social Preview -->\n";
	}

	/**
	 * @return string
	 */
	protected function getLocale() {
		return get_locale();
	}

	/**
	 * @return string
	 */
	protected function getUrl() {
		if ( is_home() || is_front_page() ) {
			return home_url();
		}

		return get_the_permalink();
	}

	/**
	 * @return string
	 */
	protected function getTitle() {
		if ( is_home() || is_front_page() ) {
			if ( $frontPageTitle = $this->get_option( 'general_settings_front_page_title' ) ) {
				return $frontPageTitle;
			}

			return get_bloginfo( 'name' );
		}

		if ( is_category() || is_tag() ) {
			return single_term_title( '', false );
		}

		$metaTitle = get_post_meta( get_the_ID(), $this->metaPrefix . 'title', true );
		if ( $metaTitle ) {
			return $metaTitle;
		}

		return get_the_title();
	}

	/**
	 * @return string
	 */
	protected function getDescription() {
		if ( is_home() || is_front_page() ) {
			if ( $frontPageDescription = $this->get_option( 'general_settings_front_page_description' ) ) {
				return $frontPageDescription;
			}

			return get_bloginfo( 'description' );
		}

		if ( is_category() || is_tag() ) {
			return sanitize_text_field( term_description() );
		}

		$metaDescription = get_post_meta( get_the_ID(), $this->metaPrefix . 'description', true );
		if ( $metaDescription ) {
			return $metaDescription;
		}

		return get_the_excerpt();
	}

	/**
	 * @return string
	 */
	protected function getType() {
		if ( ! is_singular( [ 'post' ] ) ) {
			return '';
		}

		return 'article';
	}

	/**
	 * @return int|null
	 */
	private function getImageId() {
		// Front page image
		if ( ( is_home() || is_front_page() ) &&
		     $imageId = $this->get_option( 'general_settings_front_page_image' ) ) {
			return $imageId;
		}

		// Post meta image
		if ( $imageId = get_post_meta( get_the_ID(), $this->metaPrefix . 'image', true ) ) {
			return $imageId;
		}

		// Featured image
		if ( $imageId = get_post_thumbnail_id() ) {
			return $imageId;
		}

		// Fallback image
		if ( $imageId = $this->get_option( 'general_settings_fallback_image' ) ) {
			return $imageId;
		}

		return null;
	}

	/**
	 * @param int $imageId
	 *
	 * @return array
	 */
	protected function getImageData( $imageId ) {
		if ( ! $imageId ) {
			return apply_filters( 'wp_social_preview_open_graph_image_data', [
				'id'     => $imageId,
				'url'    => '',
				'width'  => '',
				'height' => '',
			] );
		}

		$url  = wp_get_attachment_image_url( $imageId, 'wp_social_preview_default' );
		$meta = wp_get_attachment_metadata( $imageId );
		if ( isset( $meta['sizes']['wp_social_preview_default'] ) ) {
			$meta = $meta['sizes']['wp_social_preview_default'];
		}

		return apply_filters( 'wp_social_preview_open_graph_image_data', [
			'id'     => $imageId,
			'url'    => $url,
			'width'  => ! empty( $meta['width'] ) ? $meta['width'] : '',
			'height' => ! empty( $meta['height'] ) ? $meta['height'] : '',
		] );
	}

	/**
	 * @return string
	 */
	protected function getArticlePublishedTime() {
		return get_the_date( 'c' );
	}

	/**
	 * @return string
	 */
	protected function getArticleModifiedTime() {
		return get_the_modified_date( 'c' );
	}

	protected function getTwitterCreator() {
		$authorId = get_post_field( 'post_author', get_the_ID() );
		if ( ! $authorId ) {
			return '';
		}

		return get_the_author_meta( $this->metaPrefix . 'twitter_username', $authorId );
	}
}
