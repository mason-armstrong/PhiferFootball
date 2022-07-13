<?php
/**
 * Footer options
 *
 * @package Theme Palace
 * @subpackage News Vibe
 * @since News Vibe 1.0.0
 */

// Footer Section
$wp_customize->add_section( 'news_vibe_section_footer',
	array(
		'title'      			=> esc_html__( 'Footer Options', 'news-vibe' ),
		'priority'   			=> 900,
		'panel'      			=> 'news_vibe_theme_options_panel',
	)
);

// footer image setting and control.
$wp_customize->add_setting( 'news_vibe_theme_options[footer_image]', array(
	'sanitize_callback' => 'news_vibe_sanitize_image'
) );

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'news_vibe_theme_options[footer_image]',
		array(
		'label'       		=> esc_html__( 'Site Info Logo', 'news-vibe' ),
		'description' 		=> sprintf( esc_html__( 'Recommended size: %1$dpx x %2$dpx ', 'news-vibe' ), 188, 23 ),
		'section'     		=> 'news_vibe_section_footer',
) ) );

// footer text
$wp_customize->add_setting( 'news_vibe_theme_options[copyright_text]',
	array(
		'default'       		=> $options['copyright_text'],
		'sanitize_callback'		=> 'news_vibe_santize_allow_tag',
		'transport'				=> 'postMessage',
	)
);
$wp_customize->add_control( 'news_vibe_theme_options[copyright_text]',
    array(
		'label'      			=> esc_html__( 'Copyright Text', 'news-vibe' ),
		'section'    			=> 'news_vibe_section_footer',
		'type'		 			=> 'textarea',
    )
);

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'news_vibe_theme_options[copyright_text]', array(
		'selector'            => '.site-info .copyright span',
		'settings'            => 'news_vibe_theme_options[copyright_text]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'news_vibe_copyright_text_partial',
    ) );
}

// scroll top visible
$wp_customize->add_setting( 'news_vibe_theme_options[scroll_top_visible]',
	array(
		'default'       	=> $options['scroll_top_visible'],
		'sanitize_callback' => 'news_vibe_sanitize_switch_control',
	)
);
$wp_customize->add_control( new News_Vibe_Switch_Control( $wp_customize, 'news_vibe_theme_options[scroll_top_visible]',
    array(
		'label'      		=> esc_html__( 'Display Scroll Top Button', 'news-vibe' ),
		'section'    		=> 'news_vibe_section_footer',
		'on_off_label' 		=> news_vibe_switch_options(),
    )
) );