<?php
/**
* Popular Section options
*
* @package Theme Palace
* @subpackage News Vibe
* @since News Vibe 1.0.0
*/

// Add Popular section
$wp_customize->add_section( 'news_vibe_popular_section', array(
	'title'             => esc_html__( 'Popular','news-vibe' ),
	'description'       => esc_html__( 'Popular Section options.', 'news-vibe' ),
	'panel'             => 'news_vibe_front_page_panel',
	'priority'          => 50,
	) );

// Popular content enable control and setting
$wp_customize->add_setting( 'news_vibe_theme_options[popular_section_enable]', array(
	'default'			=> 	$options['popular_section_enable'],
	'sanitize_callback' => 'news_vibe_sanitize_switch_control',
	) );

$wp_customize->add_control( new News_Vibe_Switch_Control( $wp_customize, 'news_vibe_theme_options[popular_section_enable]', array(
	'label'             => esc_html__( 'Popular Section Enable', 'news-vibe' ),
	'section'           => 'news_vibe_popular_section',
	'on_off_label' 		=> news_vibe_switch_options(),
	) ) );

// popular title setting and control
$wp_customize->add_setting( 'news_vibe_theme_options[popular_title]', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'			=> $options['popular_title'],
	'transport'			=> 'postMessage',
	) );

$wp_customize->add_control( 'news_vibe_theme_options[popular_title]', array(
	'label'           	=> esc_html__( 'Title', 'news-vibe' ),
	'section'        	=> 'news_vibe_popular_section',
	'active_callback' 	=> 'news_vibe_is_popular_section_enable',
	'type'				=> 'text',
	) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
	$wp_customize->selective_refresh->add_partial( 'news_vibe_theme_options[popular_title]', array(
		'selector'            => '#inner-content-wrapper #popular-posts h2.section-title',
		'settings'            => 'news_vibe_theme_options[popular_title]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'news_vibe_popular_title_partial',
		) );
}

// Add dropdown category setting and control.
$wp_customize->add_setting(  'news_vibe_theme_options[popular_content_category]', array(
	'sanitize_callback' => 'news_vibe_sanitize_single_category',
	) ) ;

$wp_customize->add_control( new News_Vibe_Dropdown_Taxonomies_Control( $wp_customize,'news_vibe_theme_options[popular_content_category]', array(
	'label'             => esc_html__( 'Select Category', 'news-vibe' ),
	'description'      	=> esc_html__( 'Note: Latest selected no of posts will be shown from selected category', 'news-vibe' ),
	'section'           => 'news_vibe_popular_section',
	'type'              => 'dropdown-taxonomies',
	'active_callback'	=> 'news_vibe_is_popular_section_enable'
	) ) );
