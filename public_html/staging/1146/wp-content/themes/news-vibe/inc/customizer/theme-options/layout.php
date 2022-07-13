<?php
/**
 * Layout options
 *
 * @package Theme Palace
 * @subpackage News Vibe
 * @since News Vibe 1.0.0
 */

// Add sidebar section
$wp_customize->add_section( 'news_vibe_layout', array(
	'title'               => esc_html__('Layout','news-vibe'),
	'description'         => esc_html__( 'Layout section options.', 'news-vibe' ),
	'panel'               => 'news_vibe_theme_options_panel',
) );

// Site layout setting and control.
$wp_customize->add_setting( 'news_vibe_theme_options[site_layout]', array(
	'sanitize_callback'   => 'news_vibe_sanitize_select',
	'default'             => $options['site_layout'],
) );

$wp_customize->add_control(  new News_Vibe_Custom_Radio_Image_Control ( $wp_customize, 'news_vibe_theme_options[site_layout]', array(
	'label'               => esc_html__( 'Site Layout', 'news-vibe' ),
	'section'             => 'news_vibe_layout',
	'choices'			  => news_vibe_site_layout(),
) ) );

// Sidebar position setting and control.
$wp_customize->add_setting( 'news_vibe_theme_options[sidebar_position]', array(
	'sanitize_callback'   => 'news_vibe_sanitize_select',
	'default'             => $options['sidebar_position'],
) );

$wp_customize->add_control(  new News_Vibe_Custom_Radio_Image_Control ( $wp_customize, 'news_vibe_theme_options[sidebar_position]', array(
	'label'               => esc_html__( 'Global Sidebar Position', 'news-vibe' ),
	'section'             => 'news_vibe_layout',
	'choices'			  => news_vibe_global_sidebar_position(),
) ) );

// Post sidebar position setting and control.
$wp_customize->add_setting( 'news_vibe_theme_options[post_sidebar_position]', array(
	'sanitize_callback'   => 'news_vibe_sanitize_select',
	'default'             => $options['post_sidebar_position'],
) );

$wp_customize->add_control(  new News_Vibe_Custom_Radio_Image_Control ( $wp_customize, 'news_vibe_theme_options[post_sidebar_position]', array(
	'label'               => esc_html__( 'Posts Sidebar Position', 'news-vibe' ),
	'section'             => 'news_vibe_layout',
	'choices'			  => news_vibe_sidebar_position(),
) ) );

// Post sidebar position setting and control.
$wp_customize->add_setting( 'news_vibe_theme_options[page_sidebar_position]', array(
	'sanitize_callback'   => 'news_vibe_sanitize_select',
	'default'             => $options['page_sidebar_position'],
) );

$wp_customize->add_control( new News_Vibe_Custom_Radio_Image_Control( $wp_customize, 'news_vibe_theme_options[page_sidebar_position]', array(
	'label'               => esc_html__( 'Pages Sidebar Position', 'news-vibe' ),
	'section'             => 'news_vibe_layout',
	'choices'			  => news_vibe_sidebar_position(),
) ) );