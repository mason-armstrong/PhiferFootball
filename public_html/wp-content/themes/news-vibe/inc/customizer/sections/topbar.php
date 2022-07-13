<?php
/**
* Topbar Section options
*
* @package Theme Palace
* @subpackage News Vibe Pro
* @since News Vibe Pro 1.0.0
*/

// Add Topbar section
$wp_customize->add_section( 'news_vibe_topbar_section', array(
	'title'             => esc_html__( 'Topbar','news-vibe' ),
	'description'       => esc_html__( 'Topbar Section options.', 'news-vibe' ),
	'panel'             => 'news_vibe_front_page_panel',
	'priority'			=> 10,
	) );

// Topbar content enable control and setting
$wp_customize->add_setting( 'news_vibe_theme_options[topbar_section_enable]', array(
	'default'			=> 	$options['topbar_section_enable'],
	'sanitize_callback' => 'news_vibe_sanitize_switch_control',
	) );

$wp_customize->add_control( new News_Vibe_Switch_Control( $wp_customize, 'news_vibe_theme_options[topbar_section_enable]', array(
	'label'             => esc_html__( 'Topbar Section Enable', 'news-vibe' ),
	'description'       => sprintf( '%1$s <a class="topbar-menu-trigger" href="#"> %2$s </a> %3$s', esc_html__( 'Note: To show secondary and social menu.', 'news-vibe' ), esc_html__( 'Click Here', 'news-vibe' ), esc_html__( 'to create menu', 'news-vibe' ) ),
	'section'           => 'news_vibe_topbar_section',
	'on_off_label' 		=> news_vibe_switch_options(),
	) ) );

$wp_customize->add_setting( 'news_vibe_theme_options[frontpage_tags_enable]', array(
	'default'			=> 	$options['frontpage_tags_enable'],
	'sanitize_callback' => 'news_vibe_sanitize_switch_control',
	) );

$wp_customize->add_control( new News_Vibe_Switch_Control( $wp_customize, 'news_vibe_theme_options[frontpage_tags_enable]', array(
	'label'             => esc_html__( 'Tags Enable', 'news-vibe' ),
	'section'           => 'news_vibe_topbar_section',
	'on_off_label' 		=> news_vibe_switch_options(),
	) ) );

// popular title setting and control
$wp_customize->add_setting( 'news_vibe_theme_options[topbar_address]', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'			=> $options['topbar_address'],
	'transport'			=> 'postMessage',
	) );

$wp_customize->add_control( 'news_vibe_theme_options[topbar_address]', array(
	'label'           	=> esc_html__( 'Address', 'news-vibe' ),
	'section'        	=> 'news_vibe_topbar_section',
	'active_callback' 	=> 'news_vibe_is_topbar_section_enable',
	'type'				=> 'text',
	) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
	$wp_customize->selective_refresh->add_partial( 'news_vibe_theme_options[topbar_address]', array(
		'selector'            => '#top-navigation ul li.contact-info',
		'settings'            => 'news_vibe_theme_options[topbar_address]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'news_vibe_topbar_address_partial',
		) );
}

// popular title setting and control
$wp_customize->add_setting( 'news_vibe_theme_options[topbar_email]', array(
	'sanitize_callback' => 'sanitize_email',
	'default'			=> $options['topbar_email'],
	'transport'			=> 'postMessage',
	) );

$wp_customize->add_control( 'news_vibe_theme_options[topbar_email]', array(
	'label'           	=> esc_html__( 'Email', 'news-vibe' ),
	'section'        	=> 'news_vibe_topbar_section',
	'active_callback' 	=> 'news_vibe_is_topbar_section_enable',
	'type'				=> 'email',
	) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
	$wp_customize->selective_refresh->add_partial( 'news_vibe_theme_options[topbar_email]', array(
		'selector'            => '#top-navigation ul li.contact-info a',
		'settings'            => 'news_vibe_theme_options[topbar_email]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'news_vibe_topbar_email_partial',
		) );
}

// ads image setting and control.
$wp_customize->add_setting( 'news_vibe_theme_options[ads_image]', array(
	'sanitize_callback' => 'news_vibe_sanitize_image'
	) );

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'news_vibe_theme_options[ads_image]',
	array(
		'label'       		=> esc_html__( 'Ads Image', 'news-vibe' ),
		'description' 		=> sprintf( esc_html__( 'Recommended size: %1$dpx x %2$dpx ', 'news-vibe' ), 810, 120 ),
		'section'     		=> 'news_vibe_topbar_section',
		) ) );

// ads link setting and control
$wp_customize->add_setting( 'news_vibe_theme_options[ads_url]', array(
	'sanitize_callback' => 'esc_url_raw',
	) );

$wp_customize->add_control( 'news_vibe_theme_options[ads_url]', array(
	'label'           	=> esc_html__( 'Ads Url', 'news-vibe' ),
	'section'        	=> 'news_vibe_topbar_section',
	'type'				=> 'url',
	) );

// topbar background setting and control.
$wp_customize->add_setting( 'news_vibe_theme_options[bg_image]', array(
	'sanitize_callback' => 'news_vibe_sanitize_image'
	) );

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'news_vibe_theme_options[bg_image]',
	array(
		'label'       		=> esc_html__( 'Background Image', 'news-vibe' ),
		'description' 		=> esc_html__( 'Background Image For Top Bar', 'news-vibe'),
		'section'     		=> 'news_vibe_topbar_section',
		) ) );

$wp_customize->add_setting( 'news_vibe_theme_options[header_overlay_color]', array(
	'default'           => $options['header_overlay_color'],
	'sanitize_callback' => 'sanitize_hex_color', // The hue is stored as a positive integer.
) );


$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'news_vibe_theme_options[header_overlay_color]', array(
	'label'	=> esc_html__( 'Overlay Color', 'news-vibe' ),
	'section'  => 'news_vibe_topbar_section',

) ) );

$wp_customize->add_setting( 'news_vibe_theme_options[header_overlay]', array(
	'default'          	=> $options['header_overlay'],
	'sanitize_callback' => 'news_vibe_sanitize_number_range',
	'validate_callback' => 'news_vibe_validate_header_overlay',
	'transport'			=> 'refresh',
	) );

$wp_customize->add_control( 'news_vibe_theme_options[header_overlay]', array(
	'label'             => esc_html__( 'Over Opacity', 'news-vibe' ),
	'section'           => 'news_vibe_topbar_section',
	'type'				=> 'number',
	'input_attrs'		=> array(
		'min'	=> 1,
		'max'	=> 10,
		'style' => 'width: 100px;'
		),
	) );