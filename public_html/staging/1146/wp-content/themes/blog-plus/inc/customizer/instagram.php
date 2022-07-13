<?php

// Add Instagram section
$wp_customize->add_section( 'blog_plus_instagram_section', array(
	'title'             => esc_html__( 'Instagram','blog-plus' ),
	'description'       => sprintf( blog_plus_santize_allow_tag('Instagram Section options. <a href="%1$s">click here </a> to link instagram account', 'blog-plus'), admin_url( $paths = '?page=sb-instagram-feed', $scheme = 'admin' ) ),
	'panel'             => 'blog_diary_front_page_panel',
) );

// Instagram content enable control and setting
$wp_customize->add_setting( 'instagram_section_enable', array(
	'sanitize_callback' => 'blog_diary_sanitize_switch_control',
	'default' => false,
) );

$wp_customize->add_control( new Blog_Plus_Switch_Control( $wp_customize, 'instagram_section_enable', array(
	'label'             => esc_html__( 'Instagram Section Enable', 'blog-plus' ),
	'section'           => 'blog_plus_instagram_section',
	'on_off_label' 		=> blog_diary_switch_options(),
) ) );

// blog title setting and control
$wp_customize->add_setting( 'blog_diary_theme_options[instagram_shortcode]', array(
    'sanitize_callback' => 'sanitize_text_field',
    'default' => esc_html__('[instagram-feed]','blog-plus'),
) );

$wp_customize->add_control( 'blog_diary_theme_options[instagram_shortcode]', array(
    'label'             => esc_html__( 'Enter Shortcode', 'blog-plus' ),
    'section'           => 'blog_plus_instagram_section',
    'active_callback'   => 'blog_plus_is_instagram_section_enable',
    'type'              => 'text',
) );