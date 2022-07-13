<?php
/**
* Most Viewed Section options
*
* @package Theme Palace
* @subpackage News Vibe
* @since News Vibe 1.0.0
*/

// Add Most Viewed section
$wp_customize->add_section( 'news_vibe_most_viewed_section', array(
	'title'             => esc_html__( 'Most Viewed','news-vibe' ),
	'description'       => esc_html__( 'Most Viewed Section options.', 'news-vibe' ),
	'panel'             => 'news_vibe_front_page_panel',
	'priority'			=> 60,
	) );

// Most Viewed content enable control and setting
$wp_customize->add_setting( 'news_vibe_theme_options[most_viewed_section_enable]', array(
	'default'			=> 	$options['most_viewed_section_enable'],
	'sanitize_callback' => 'news_vibe_sanitize_switch_control',
	) );

$wp_customize->add_control( new News_Vibe_Switch_Control( $wp_customize, 'news_vibe_theme_options[most_viewed_section_enable]', array(
	'label'             => esc_html__( 'Most Viewed Section Enable', 'news-vibe' ),
	'section'           => 'news_vibe_most_viewed_section',
	'on_off_label' 		=> news_vibe_switch_options(),
	) ) );

// most_viewed title setting and control
$wp_customize->add_setting( 'news_vibe_theme_options[most_viewed_title]', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'			=> $options['most_viewed_title'],
	'transport'			=> 'postMessage',
	) );

$wp_customize->add_control( 'news_vibe_theme_options[most_viewed_title]', array(
	'label'           	=> esc_html__( 'Title', 'news-vibe' ),
	'section'        	=> 'news_vibe_most_viewed_section',
	'active_callback' 	=> 'news_vibe_is_most_viewed_section_enable',
	'type'				=> 'text',
	) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
	$wp_customize->selective_refresh->add_partial( 'news_vibe_theme_options[most_viewed_title]', array(
		'selector'            => '#inner-content-wrapper #most-viewed-posts h2.section-title',
		'settings'            => 'news_vibe_theme_options[most_viewed_title]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'news_vibe_most_viewed_title_partial',
		) );
}


//content type control and setting
$wp_customize->add_setting( 'news_vibe_theme_options[most_viewed_content_type]', array(
	'default'          	=> $options['most_viewed_content_type'],
	'sanitize_callback' => 'news_vibe_sanitize_select',
	) );

$wp_customize->add_control( 'news_vibe_theme_options[most_viewed_content_type]', array(
	'label'             => esc_html__( 'Content Type', 'news-vibe' ),
	'section'           => 'news_vibe_most_viewed_section',
	'type'				=> 'select',
	'active_callback' 	=> 'news_vibe_is_most_viewed_section_enable',
	'choices'			=> array( 
		'category' 	=> esc_html__( 'Category', 'news-vibe' ),
		'recent' 	=> esc_html__( 'Recent', 'news-vibe' ),
		),
	) );

// Add dropdown category setting and control.
$wp_customize->add_setting(  'news_vibe_theme_options[most_viewed_content_category]', array(
	'sanitize_callback' => 'news_vibe_sanitize_single_category',
	) ) ;

$wp_customize->add_control( new News_Vibe_Dropdown_Taxonomies_Control( $wp_customize,'news_vibe_theme_options[most_viewed_content_category]', array(
	'label'             => esc_html__( 'Select Category', 'news-vibe' ),
	'description'      	=> esc_html__( 'Note: Latest selected no of posts will be shown from selected category', 'news-vibe' ),
	'section'           => 'news_vibe_most_viewed_section',
	'type'              => 'dropdown-taxonomies',
	'active_callback'	=> 'news_vibe_is_most_viewed_section_content_category_enable'
	) ) );

// Add dropdown categories setting and control.
$wp_customize->add_setting( 'news_vibe_theme_options[most_viewed_category_exclude]', array(
	'sanitize_callback' => 'news_vibe_sanitize_category_list',
	) ) ;

$wp_customize->add_control( new News_Vibe_Dropdown_Category_Control( $wp_customize,'news_vibe_theme_options[most_viewed_category_exclude]', array(
	'label'             => esc_html__( 'Select Excluding Categories', 'news-vibe' ),
	'description'      	=> esc_html__( 'Note: Select categories to exclude. Press CTRL key select multilple categories.', 'news-vibe' ),
	'section'           => 'news_vibe_most_viewed_section',
	'type'              => 'dropdown-categories',
	'active_callback'	=> 'news_vibe_is_most_viewed_section_content_recent_enable'
	) ) );
