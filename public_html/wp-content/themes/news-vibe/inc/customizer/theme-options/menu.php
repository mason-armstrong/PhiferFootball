<?php
/**
 * Menu options
 *
 * @package Theme Palace
 * @subpackage News Vibe
 * @since News Vibe 1.0.0
 */

// Add sidebar section
$wp_customize->add_section( 'news_vibe_menu', array(
	'title'             => esc_html__('Header Menu','news-vibe'),
	'description'       => esc_html__( 'Header Menu options.', 'news-vibe' ),
	'panel'             => 'nav_menus',
) );

// search enable setting and control.
$wp_customize->add_setting( 'news_vibe_theme_options[nav_search_enable]', array(
	'sanitize_callback' => 'news_vibe_sanitize_switch_control',
	'default'           => $options['nav_search_enable'],
) );

$wp_customize->add_control( new News_Vibe_Switch_Control( $wp_customize, 'news_vibe_theme_options[nav_search_enable]', array(
	'label'             => esc_html__( 'Enable search', 'news-vibe' ),
	'section'           => 'news_vibe_menu',
	'on_off_label' 		=> news_vibe_switch_options(),
) ) );