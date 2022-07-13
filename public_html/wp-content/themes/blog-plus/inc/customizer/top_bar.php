<?php

// Add Topbar section
$wp_customize->add_section( 'blog_diary_top_bar_section', array(
	'title'             => esc_html__( 'Topbar','blog-plus' ),
	'description'       => esc_html__( 'Topbar Section options.', 'blog-plus' ),
	'panel'             => 'blog_diary_front_page_panel',
	'priority' 			=> 4,
) );

// Topbar content enable control and setting
$wp_customize->add_setting( 'top_bar_section_enable', array(
	'sanitize_callback' => 'blog_diary_sanitize_switch_control',
	'default' => false,
) );

$wp_customize->add_control( new Blog_Plus_Switch_Control( $wp_customize, 'top_bar_section_enable', array(
	'label'             => esc_html__( 'Topbar Section Enable', 'blog-plus' ),
	'section'           => 'blog_diary_top_bar_section',
	'on_off_label' 		=> blog_diary_switch_options(),
) ) );