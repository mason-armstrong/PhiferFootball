<?php
/**
 * Excerpt options
 *
 * @package Theme Palace
 * @subpackage News Vibe
 * @since News Vibe 1.0.0
 */

// Add excerpt section
$wp_customize->add_section( 'news_vibe_excerpt_section', array(
	'title'             => esc_html__( 'Excerpt','news-vibe' ),
	'description'       => esc_html__( 'Excerpt section options.', 'news-vibe' ),
	'panel'             => 'news_vibe_theme_options_panel',
) );


// long Excerpt length setting and control.
$wp_customize->add_setting( 'news_vibe_theme_options[long_excerpt_length]', array(
	'sanitize_callback' => 'news_vibe_sanitize_number_range',
	'validate_callback' => 'news_vibe_validate_long_excerpt',
	'default'			=> $options['long_excerpt_length'],
) );

$wp_customize->add_control( 'news_vibe_theme_options[long_excerpt_length]', array(
	'label'       		=> esc_html__( 'Blog Page Excerpt Length', 'news-vibe' ),
	'description' 		=> esc_html__( 'Note: Min 5 & Max 100. Total words to be displayed in archive page/search page.', 'news-vibe' ),
	'section'     		=> 'news_vibe_excerpt_section',
	'type'        		=> 'number',
	'input_attrs' 		=> array(
		'style'       => 'width: 80px;',
		'max'         => 100,
		'min'         => 5,
	),
) );