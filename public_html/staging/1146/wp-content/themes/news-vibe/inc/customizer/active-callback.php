<?php
/**
 * Customizer active callbacks
 *
 * @package Theme Palace
 * @subpackage News Vibe
 * @since News Vibe 1.0.0
 */

if ( ! function_exists( 'news_vibe_is_pagination_enable' ) ) :
	/**
	 * Check if pagination is enabled.
	 *
	 * @since News Vibe 1.0.0
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function news_vibe_is_pagination_enable( $control ) {
		return $control->manager->get_setting( 'news_vibe_theme_options[pagination_enable]' )->value();
	}
endif;

/**
 * Front Page Active Callbacks
 */

/**
 * Check if breakingnews section is enabled.
 *
 * @since News Vibe 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function news_vibe_is_breakingnews_section_enable( $control ) {
	return ( $control->manager->get_setting( 'news_vibe_theme_options[breakingnews_section_enable]' )->value() );
}

/**
 * Check if breaking news slider section is enabled.
 *
 * @since News Vibe 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function news_vibe_is_breakingnews_slider_section_enable( $control ) {
	return ( $control->manager->get_setting( 'news_vibe_theme_options[slider_section_enable]' )->value() );
}


/**
 * Check if slider section content type is custom.
 *
 * @since News Vibe 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function news_vibe_is_media_post_section_content_custom_enable( $control ) {
	$content_type = $control->manager->get_setting( 'news_vibe_theme_options[media_video_post_content_type]' )->value();
	return news_vibe_is_media_post_section_enable( $control ) && ( 'custom' == $content_type );
}

/**
 * Check if slider section content type is page.
 *
 * @since News Vibe 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function news_vibe_is_media_post_section_content_page_enable( $control ) {
	$content_type = $control->manager->get_setting( 'news_vibe_theme_options[media_post_content_type]' )->value();
	return news_vibe_is_media_post_section_enable( $control ) && ( 'page' == $content_type );
}

/**
 * Check if media section content type is post.
 *
 * @since News Vibe 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function news_vibe_is_media_post_section_content_post_enable( $control ) {
	$content_type = $control->manager->get_setting( 'news_vibe_theme_options[media_post_content_type]' )->value();
	return news_vibe_is_media_post_section_enable( $control ) && ( 'post' == $content_type );
}

/**
 * Check if media section content type is category.
 *
 * @since News Vibe 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function news_vibe_is_media_post_section_content_category_enable( $control ) {
	$content_type = $control->manager->get_setting( 'news_vibe_theme_options[media_post_content_type]' )->value();
	return news_vibe_is_media_post_section_enable( $control ) && ( 'category' == $content_type );
}

/**
 * Check if Related Post section is enabled.
 *
 * @since News Vibe 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function news_vibe_is_related_post_section_enable( $control ) {
	return ( $control->manager->get_setting( 'news_vibe_theme_options[related_post_section_enable]' )->value() );
}

/**
 * Check if related section content type is page.
 *
 * @since News Vibe 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function news_vibe_is_related_post_section_content_page_enable( $control ) {
	$content_type = $control->manager->get_setting( 'news_vibe_theme_options[related_post_content_type]' )->value();
	return news_vibe_is_related_post_section_enable( $control ) && ( 'page' == $content_type );
}

/**
 * Check if related section content type is category.
 *
 * @since News Vibe 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function news_vibe_is_related_post_section_content_category_enable( $control ) {
	$content_type = $control->manager->get_setting( 'news_vibe_theme_options[related_post_content_type]' )->value();
	return news_vibe_is_related_post_section_enable( $control ) && ( 'category' == $content_type );
}

/**
 * Check if related section content type is recent.
 *
 * @since News Vibe 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function news_vibe_is_related_post_section_content_recent_enable( $control ) {
	$content_type = $control->manager->get_setting( 'news_vibe_theme_options[related_post_content_type]' )->value();
	return news_vibe_is_related_post_section_enable( $control ) && ( 'recent' == $content_type );
}


/**
 * Check if latest_post section is enabled.
 *
 * @since News Vibe 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function news_vibe_is_latest_post_section_enable( $control ) {
	return ( $control->manager->get_setting( 'news_vibe_theme_options[latest_post_section_enable]' )->value() );
}

/**
 * Check if popular section is enabled.
 *
 * @since News Vibe 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function news_vibe_is_popular_section_enable( $control ) {
	return ( $control->manager->get_setting( 'news_vibe_theme_options[popular_section_enable]' )->value() );
}

/**
 * Check if most_viewed section is enabled.
 *
 * @since News Vibe 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function news_vibe_is_most_viewed_section_enable( $control ) {
	return ( $control->manager->get_setting( 'news_vibe_theme_options[most_viewed_section_enable]' )->value() );
}

/**
 * Check if related section content type is category.
 *
 * @since News Vibe 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function news_vibe_is_most_viewed_section_content_category_enable( $control ) {
	$content_type = $control->manager->get_setting( 'news_vibe_theme_options[most_viewed_content_type]' )->value();
	return news_vibe_is_most_viewed_section_enable( $control ) && ( 'category' == $content_type );
}

/**
 * Check if related section content type is recent.
 *
 * @since News Vibe 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function news_vibe_is_most_viewed_section_content_recent_enable( $control ) {
	$content_type = $control->manager->get_setting( 'news_vibe_theme_options[most_viewed_content_type]' )->value();
	return news_vibe_is_most_viewed_section_enable( $control ) && ( 'recent' == $content_type );
}


/**
 * Check if featured_post section is enabled.
 *
 * @since News Vibe 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function news_vibe_is_featured_post_section_enable( $control ) {
	return ( $control->manager->get_setting( 'news_vibe_theme_options[featured_post_section_enable]' )->value() );
}


function news_vibe_is_topbar_section_enable( $control ) {
	return ( $control->manager->get_setting( 'news_vibe_theme_options[topbar_section_enable]' )->value() );
}