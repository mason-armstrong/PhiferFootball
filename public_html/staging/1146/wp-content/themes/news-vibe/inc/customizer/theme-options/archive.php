<?php
/**
 * Archive options
 *
 * @package Theme Palace
 * @subpackage News Vibe
 * @since News Vibe 1.0.0
 */

// Add archive section
$wp_customize->add_section( 'news_vibe_archive_section', array(
	'title'             => esc_html__( 'Blog/Archive','news-vibe' ),
	'description'       => esc_html__( 'Archive section options.', 'news-vibe' ),
	'panel'             => 'news_vibe_theme_options_panel',
) );

// Your latest posts title setting and control.
$wp_customize->add_setting( 'news_vibe_theme_options[your_latest_posts_title]', array(
	'default'           => $options['your_latest_posts_title'],
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'news_vibe_theme_options[your_latest_posts_title]', array(
	'label'             => esc_html__( 'Your Latest Posts Title', 'news-vibe' ),
	'description'       => esc_html__( 'This option only works if Static Front Page is set to "Your latest posts."', 'news-vibe' ),
	'section'           => 'news_vibe_archive_section',
	'type'				=> 'text',
	'active_callback'   => 'news_vibe_is_latest_posts'
) );

// Archive category setting and control.
$wp_customize->add_setting( 'news_vibe_theme_options[hide_category]', array(
	'default'           => $options['hide_category'],
	'sanitize_callback' => 'news_vibe_sanitize_switch_control',
) );

$wp_customize->add_control( new News_Vibe_Switch_Control( $wp_customize, 'news_vibe_theme_options[hide_category]', array(
	'label'             => esc_html__( 'Hide Category', 'news-vibe' ),
	'section'           => 'news_vibe_archive_section',
	'on_off_label' 		=> news_vibe_hide_options(),
) ) );

// Archive date setting and control.
$wp_customize->add_setting( 'news_vibe_theme_options[hide_date]', array(
	'default'           => $options['hide_date'],
	'sanitize_callback' => 'news_vibe_sanitize_switch_control',
) );

$wp_customize->add_control( new News_Vibe_Switch_Control( $wp_customize, 'news_vibe_theme_options[hide_date]', array(
	'label'             => esc_html__( 'Hide Date', 'news-vibe' ),
	'section'           => 'news_vibe_archive_section',
	'on_off_label' 		=> news_vibe_hide_options(),
) ) );

// Archive author setting and control.
$wp_customize->add_setting( 'news_vibe_theme_options[hide_author]', array(
	'default'           => $options['hide_author'],
	'sanitize_callback' => 'news_vibe_sanitize_switch_control',
) );

$wp_customize->add_control( new News_Vibe_Switch_Control( $wp_customize, 'news_vibe_theme_options[hide_author]', array(
	'label'             => esc_html__( 'Hide Author', 'news-vibe' ),
	'section'           => 'news_vibe_archive_section',
	'on_off_label' 		=> news_vibe_hide_options(),
) ) );