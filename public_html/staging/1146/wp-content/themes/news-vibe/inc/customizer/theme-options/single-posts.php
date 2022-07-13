<?php
/**
 * Excerpt options
 *
 * @package Theme Palace
 * @subpackage News Vibe
 * @since News Vibe 1.0.0
 */

// Add excerpt section
$wp_customize->add_section( 'news_vibe_single_post_section', array(
	'title'             => esc_html__( 'Single Post','news-vibe' ),
	'description'       => esc_html__( 'Options to change the single posts globally.', 'news-vibe' ),
	'panel'             => 'news_vibe_theme_options_panel',
) );

// Archive date meta setting and control.
$wp_customize->add_setting( 'news_vibe_theme_options[single_post_hide_date]', array(
	'default'           => $options['single_post_hide_date'],
	'sanitize_callback' => 'news_vibe_sanitize_switch_control',
) );

$wp_customize->add_control( new News_Vibe_Switch_Control( $wp_customize, 'news_vibe_theme_options[single_post_hide_date]', array(
	'label'             => esc_html__( 'Hide Date', 'news-vibe' ),
	'section'           => 'news_vibe_single_post_section',
	'on_off_label' 		=> news_vibe_hide_options(),
) ) );

// Archive author meta setting and control.
$wp_customize->add_setting( 'news_vibe_theme_options[single_post_hide_author]', array(
	'default'           => $options['single_post_hide_author'],
	'sanitize_callback' => 'news_vibe_sanitize_switch_control',
) );

$wp_customize->add_control( new News_Vibe_Switch_Control( $wp_customize, 'news_vibe_theme_options[single_post_hide_author]', array(
	'label'             => esc_html__( 'Hide Author', 'news-vibe' ),
	'section'           => 'news_vibe_single_post_section',
	'on_off_label' 		=> news_vibe_hide_options(),
) ) );

// Archive author category setting and control.
$wp_customize->add_setting( 'news_vibe_theme_options[single_post_hide_category]', array(
	'default'           => $options['single_post_hide_category'],
	'sanitize_callback' => 'news_vibe_sanitize_switch_control',
) );

$wp_customize->add_control( new News_Vibe_Switch_Control( $wp_customize, 'news_vibe_theme_options[single_post_hide_category]', array(
	'label'             => esc_html__( 'Hide Category', 'news-vibe' ),
	'section'           => 'news_vibe_single_post_section',
	'on_off_label' 		=> news_vibe_hide_options(),
) ) );

// Archive tag category setting and control.
$wp_customize->add_setting( 'news_vibe_theme_options[single_post_hide_tags]', array(
	'default'           => $options['single_post_hide_tags'],
	'sanitize_callback' => 'news_vibe_sanitize_switch_control',
) );

$wp_customize->add_control( new News_Vibe_Switch_Control( $wp_customize, 'news_vibe_theme_options[single_post_hide_tags]', array(
	'label'             => esc_html__( 'Hide Tag', 'news-vibe' ),
	'section'           => 'news_vibe_single_post_section',
	'on_off_label' 		=> news_vibe_hide_options(),
) ) );
