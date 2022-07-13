<?php
/**
* Homepage (Static ) options
*
* @package Theme Palace
* @subpackage News Vibe
* @since News Vibe 1.0.0
*/

// Homepage (Static ) setting and control.
$wp_customize->add_setting( 'news_vibe_theme_options[enable_frontpage_content]', array(
	'sanitize_callback'   => 'news_vibe_sanitize_checkbox',
	'default'             => $options['enable_frontpage_content'],
) );

$wp_customize->add_control( 'news_vibe_theme_options[enable_frontpage_content]', array(
	'label'       	=> esc_html__( 'Enable Content', 'news-vibe' ),
	'description' 	=> esc_html__( 'Check to enable content on static front page only.', 'news-vibe' ),
	'section'     	=> 'static_front_page',
	'type'        	=> 'checkbox',
) );