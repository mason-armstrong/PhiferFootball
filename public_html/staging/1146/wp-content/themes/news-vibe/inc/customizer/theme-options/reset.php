<?php
/**
 * Reset options
 *
 * @package Theme Palace
 * @subpackage News Vibe
 * @since News Vibe 1.0.0
 */

/**
* Reset section
*/
// Add reset enable section
$wp_customize->add_section( 'news_vibe_reset_section', array(
	'title'             => esc_html__('Reset all settings','news-vibe'),
	'description'       => esc_html__( 'Caution: All settings will be reset to default. Refresh the page after clicking Save & Publish.', 'news-vibe' ),
) );

// Add reset enable setting and control.
$wp_customize->add_setting( 'news_vibe_theme_options[reset_options]', array(
	'default'           => $options['reset_options'],
	'sanitize_callback' => 'news_vibe_sanitize_checkbox',
	'transport'			  => 'postMessage',
) );

$wp_customize->add_control( 'news_vibe_theme_options[reset_options]', array(
	'label'             => esc_html__( 'Check to reset all settings', 'news-vibe' ),
	'section'           => 'news_vibe_reset_section',
	'type'              => 'checkbox',
) );
