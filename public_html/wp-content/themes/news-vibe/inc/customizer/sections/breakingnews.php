<?php
/**
* Breaking News Section options
*
* @package Theme Palace
* @subpackage News Vibe
* @since News Vibe 1.0.0
*/

// Add Breaking News section
$wp_customize->add_section( 'news_vibe_breakingnews_section', array(
	'title'             => esc_html__( 'Breaking News','news-vibe' ),
	'description'       => esc_html__( 'Breaking News Section options.', 'news-vibe' ),
	'panel'             => 'news_vibe_front_page_panel',
	'priority'			=> 20,
	) );

// Breaking News content enable control and setting
$wp_customize->add_setting( 'news_vibe_theme_options[breakingnews_section_enable]', array(
	'default'			=> 	$options['breakingnews_section_enable'],
	'sanitize_callback' => 'news_vibe_sanitize_switch_control',
	) );

$wp_customize->add_control( new News_Vibe_Switch_Control( $wp_customize, 'news_vibe_theme_options[breakingnews_section_enable]', array(
	'label'             => esc_html__( 'Breaking News Section Enable', 'news-vibe' ),
	'section'           => 'news_vibe_breakingnews_section',
	'on_off_label' 		=> news_vibe_switch_options(),
	) ) );

// breakingnews title setting and control
$wp_customize->add_setting( 'news_vibe_theme_options[breakingnews_title]', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'			=> $options['breakingnews_title'],
	'transport'			=> 'postMessage',
	) );

$wp_customize->add_control( 'news_vibe_theme_options[breakingnews_title]', array(
	'label'           	=> esc_html__( 'Title', 'news-vibe' ),
	'section'        	=> 'news_vibe_breakingnews_section',
	'active_callback' 	=> 'news_vibe_is_breakingnews_section_enable',
	'type'				=> 'text',
	) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
	$wp_customize->selective_refresh->add_partial( 'news_vibe_theme_options[breakingnews_title]', array(
		'selector'            => '#breaking-news .breaking-news-wrapper h2.news-title',
		'settings'            => 'news_vibe_theme_options[breakingnews_title]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'news_vibe_breakingnews_title_partial',
		) );
}

// Breaking News Slider auto play enable control and setting
$wp_customize->add_setting( 'news_vibe_theme_options[breakingnews_slider_auto_play]', array(
	'default'			=> 	$options['breakingnews_slider_auto_play'],
	'sanitize_callback' => 'news_vibe_sanitize_switch_control',
	) );

$wp_customize->add_control( new News_Vibe_Switch_Control( $wp_customize, 'news_vibe_theme_options[breakingnews_slider_auto_play]', array(
	'label'             => esc_html__( 'Auto Play Enable', 'news-vibe' ),
	'section'           => 'news_vibe_breakingnews_section',
	'on_off_label' 		=> news_vibe_switch_options(),
	'active_callback'   => 'news_vibe_is_breakingnews_section_enable',
	) ) );

// Add dropdown category setting and control.
$wp_customize->add_setting(  'news_vibe_theme_options[breakingnews_content_category]', array(
	'sanitize_callback' => 'news_vibe_sanitize_single_category',
	) ) ;

$wp_customize->add_control( new News_Vibe_Dropdown_Taxonomies_Control( $wp_customize,'news_vibe_theme_options[breakingnews_content_category]', array(
	'label'             => esc_html__( 'Select Category', 'news-vibe' ),
	'description'      	=> esc_html__( 'Note: Latest selected no of posts will be shown from selected category', 'news-vibe' ),
	'section'           => 'news_vibe_breakingnews_section',
	'type'              => 'dropdown-taxonomies',
	'active_callback'	=> 'news_vibe_is_breakingnews_section_enable'
	) ) );

