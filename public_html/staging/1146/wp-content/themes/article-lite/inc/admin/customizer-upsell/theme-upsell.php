<?php
/**
 * Footer settings
 * 
 * @since 1.0.0
 */

add_action( 'customize_register', 'bz_upsell_section_register', 10 );
/**
 * Add settings for upsell links
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function bz_upsell_section_register( $wp_customize ) {
    require get_template_directory() . '/inc/admin/customizer-upsell/upsell-section/upsell-features.php';
	require get_template_directory() . '/inc/admin/customizer-upsell/upsell-section/upsell-button.php';
    $wp_customize->register_section_type( 'BZ_Upsell_Button' );
	$wp_customize->register_control_type( 'Bz_Upsell_Control' );

    /**
     * Add Upsell Button
     * 
     */
    $wp_customize->add_section(
		new BZ_Upsell_Button( $wp_customize, 
            'upsell_button', [
                'button_text'   => esc_html__( 'Upgrade To Pro', 'article-lite' ),
                'button_url'    => esc_url( '//blazethemes.com/theme/article-pro/' ),
                'priority'      => 5
            ]
        )
	);

	$features = [
        'Multiple Color Options',
        '7 BLog Options',
        '4 Header Options',
        'Optimized for Speed',
        'One Click Demo',
        'Ajax loader',
        'Both sidebar',
        'WooCommerce Compatible',
        'Fully Multilingual and Translation ready',
        '22 Custom widget Area',

    ];

    /**
     * Add premium features listing section
     * 
     */
	$wp_customize->add_section( 'upgrade_section', array(
        'title' => esc_html__( 'Premium Features', 'article-lite' ),
        'priority'  => 5,
    ));

    /**
     * List out "features" settings
     * 
     */
    $wp_customize->add_setting( 'upgrate_settings',
		array(
            'sanitize_callback' => 'wp_kses_post',
      )
	);

    $wp_customize->add_control( 
        new Bz_Upsell_Control( $wp_customize, 'upgrate_settings', array(
            'label'	      => esc_html__( '', 'article-lite' ),
            'section'     => 'upgrade_section',
            'description'   => '<a href="//blazethemes.com/theme/article-pro/" target="_blank">Update To Pro</a>',
            'type'		  => 'bz-upsell',
            'features' 	  => $features,
        ))
    );

    /**
     * Add Upsell Button
     * 
     */
    $wp_customize->add_section(
        new BZ_Upsell_Button( $wp_customize, 
            'demo_import_button', [
                'button_text'   => esc_html__( 'Go to Import', 'article-lite' ),
                'button_url'    => esc_url( admin_url('themes.php?page=article-lite-info.php') ),
                'title'         => esc_html__('Import Demo Data', 'article-lite'),
                'priority'  => 1000,
            ]
        )
    );
}

/**
 * Enqueue theme upsell controls scripts
 * 
 */
function bz_upsell_scripts() {
    wp_enqueue_style( 'bz-upsell', get_template_directory_uri() . '/inc/admin/customizer-upsell/upsell-section/upsell.css', array(), '2.0.0', 'all' );
    wp_enqueue_script( 'bz-upsell', get_template_directory_uri() . '/inc/admin/customizer-upsell/upsell-section/upsell.js', array(), '2.0.0', 'all' );
}
add_action( 'customize_controls_enqueue_scripts', 'bz_upsell_scripts' );