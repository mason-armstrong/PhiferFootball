<?php
/**
* Featured Post Section options
*
* @package Theme Palace
* @subpackage News Vibe
* @since News Vibe 1.0.0
*/

// Add Featured Post section
$wp_customize->add_section( 'news_vibe_featured_post_section', array(
	'title'             => esc_html__( 'Featured Post','news-vibe' ),
	'description'       => esc_html__( 'Featured Post Section options.', 'news-vibe' ),
	'panel'             => 'news_vibe_front_page_panel',
	'priority'          => 30,
	) );

// Featured Post content enable control and setting
$wp_customize->add_setting( 'news_vibe_theme_options[featured_post_section_enable]', array(
	'default'			=> 	$options['featured_post_section_enable'],
	'sanitize_callback' => 'news_vibe_sanitize_switch_control',
	) );

$wp_customize->add_control( new News_Vibe_Switch_Control( $wp_customize, 'news_vibe_theme_options[featured_post_section_enable]', array(
	'label'             => esc_html__( 'Featured Post Section Enable', 'news-vibe' ),
	'section'           => 'news_vibe_featured_post_section',
	'on_off_label' 		=> news_vibe_switch_options(),
	) ) );



for ( $i = 1; $i <= 2; $i++ ) :
// featured_post pages drop down chooser control and setting
	$wp_customize->add_setting( 'news_vibe_theme_options[featured_post_content_post_' . $i . ']', array(
		'sanitize_callback' => 'news_vibe_sanitize_page',
		) );

$wp_customize->add_control( new News_Vibe_Dropdown_Chooser( $wp_customize, 'news_vibe_theme_options[featured_post_content_post_' . $i . ']', array(
	'label'             => sprintf( esc_html__( 'Select Post %d', 'news-vibe' ), $i ),
	'section'           => 'news_vibe_featured_post_section',
	'choices'			=> news_vibe_post_choices(),
	'active_callback'	=> 'news_vibe_is_featured_post_section_enable',
	) ) );
endfor;

