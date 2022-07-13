<?php
/**
 * pagination options
 *
 * @package Theme Palace
 * @subpackage News Vibe
 * @since News Vibe 1.0.0
 */

// Add sidebar section
$wp_customize->add_section( 'news_vibe_pagination', array(
	'title'               => esc_html__('Pagination','news-vibe'),
	'description'         => esc_html__( 'Pagination section options.', 'news-vibe' ),
	'panel'               => 'news_vibe_theme_options_panel',
) );

// Sidebar position setting and control.
$wp_customize->add_setting( 'news_vibe_theme_options[pagination_enable]', array(
	'sanitize_callback' => 'news_vibe_sanitize_switch_control',
	'default'             => $options['pagination_enable'],
) );

$wp_customize->add_control( new News_Vibe_Switch_Control( $wp_customize, 'news_vibe_theme_options[pagination_enable]', array(
	'label'               => esc_html__( 'Pagination Enable', 'news-vibe' ),
	'section'             => 'news_vibe_pagination',
	'on_off_label' 		=> news_vibe_switch_options(),
) ) );

// Site layout setting and control.
$wp_customize->add_setting( 'news_vibe_theme_options[pagination_type]', array(
	'sanitize_callback'   => 'news_vibe_sanitize_select',
	'default'             => $options['pagination_type'],
) );

$wp_customize->add_control( 'news_vibe_theme_options[pagination_type]', array(
	'label'               => esc_html__( 'Pagination Type', 'news-vibe' ),
	'section'             => 'news_vibe_pagination',
	'type'                => 'select',
	'choices'			  => news_vibe_pagination_options(),
	'active_callback'	  => 'news_vibe_is_pagination_enable',
) );
