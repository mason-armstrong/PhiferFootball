<?php

// Add Blog section
$wp_customize->add_section( 'child_blog_plus_blog_section', array(
    'title'             => esc_html__( 'Blogs','blog-plus' ),
    'description'       => esc_html__( 'Blog Section options.', 'blog-plus' ),
    'panel'             => 'blog_diary_front_page_panel',
) );

// Blog content enable control and setting
$wp_customize->add_setting( 'child_blog_section_enable', array(
    'default'           =>  false,
    'sanitize_callback' => 'blog_diary_sanitize_switch_control',
) );

$wp_customize->add_control( new Blog_Plus_Switch_Control( $wp_customize, 'child_blog_section_enable', array(
    'label'             => esc_html__( 'Blog Section Enable', 'blog-plus' ),
    'section'           => 'child_blog_plus_blog_section',
    'on_off_label'      => blog_diary_switch_options(),
) ) );

// blog title setting and control
$wp_customize->add_setting( 'child_blog_title', array(
    'sanitize_callback' => 'sanitize_text_field',
    'default'           => esc_html__('SINGLE COLUMN POSTS', 'blog-plus'),
    'transport'         => 'postMessage',
) );

$wp_customize->add_control( 'child_blog_title', array(
    'label'             => esc_html__( 'Title', 'blog-plus' ),
    'section'           => 'child_blog_plus_blog_section',
    'active_callback'   => 'blog_plus_is_blog_section_enable',
    'type'              => 'text',
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'child_blog_title', array(
        'selector'            => '#blog .archive-blog-wrapper .section-header h2.section-title',
        'settings'            => 'child_blog_title',
        'container_inclusive' => false,
        'fallback_refresh'    => true,
        'render_callback'     => 'blog_plus_child_blog_title_partial',
    ) );
}

// Add dropdown category setting and control.
$wp_customize->add_setting(  'child_blog_content_category', array(
    'sanitize_callback' => 'blog_diary_sanitize_single_category',
) ) ;

$wp_customize->add_control( new Blog_Plus_Dropdown_Taxonomies_Control( $wp_customize,'child_blog_content_category', array(
    'label'             => esc_html__( 'Select Category', 'blog-plus' ),
    'description'       => esc_html__( 'Note: Latest selected no of posts will be shown from selected category', 'blog-plus' ),
    'section'           => 'child_blog_plus_blog_section',
    'type'              => 'dropdown-taxonomies',
  	'active_callback'   => 'blog_plus_is_blog_section_enable'
) ) );

// blog btn title setting and control
$wp_customize->add_setting( 'child_blog_btn_title', array(
    'sanitize_callback' => 'sanitize_text_field',
    'default'           => esc_html__( 'Show All', 'blog-plus' ),
) );

$wp_customize->add_control( 'child_blog_btn_title', array(
    'label'             => esc_html__( 'Button Label', 'blog-plus' ),
    'section'           => 'child_blog_plus_blog_section',
    'active_callback'   => 'blog_plus_is_blog_section_enable',
    'type'              => 'text',
) );


// blog btn title setting and control
$wp_customize->add_setting( 'child_blog_load_more_btn', array(
    'default'           => esc_html__( 'Load More', 'blog-plus' ),
    'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'child_blog_load_more_btn', array(
    'label'             => esc_html__( 'Load More Button Label', 'blog-plus' ),
    'section'           => 'child_blog_plus_blog_section',
    'active_callback'   => 'blog_plus_is_blog_section_enable',
    'type'              => 'text',
) );