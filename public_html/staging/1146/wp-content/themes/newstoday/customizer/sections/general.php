<?php

function ilovewp_customizer_define_general_sections( $sections ) {
    $panel           = 'ilovewp' . '_general';
    $general_sections = array();

    $theme_sidebar_positions = array(
        'left'      => esc_html__('Left', 'newstoday'),
        'right'     => esc_html__('Right', 'newstoday')
    );

    $theme_color_palettes = array(
        'atlanta'         => esc_html__('Atlanta', 'newstoday'),
        'atletico'        => esc_html__('Atletico', 'newstoday'),
        'bayern'          => esc_html__('Bayern', 'newstoday'),
        'dortmund'        => esc_html__('Dortmund', 'newstoday'),
        'lakers'          => esc_html__('Lakers', 'newstoday'),
        'oakland'         => esc_html__('Oakland', 'newstoday'),
        'portland'        => esc_html__('Portland', 'newstoday'),
        'real'            => esc_html__('Real', 'newstoday')
    );

    $general_sections['general'] = array(
        'title'     => esc_html__( 'Theme Settings', 'newstoday' ),
        'priority'  => 4900,
        'options'   => array(

            'theme-color-palette'    => array(
                'setting'               => array(
                    'default'           => 'atletico',
                    'sanitize_callback' => 'ilovewp_sanitize_text'
                ),
                'control'           => array(
                    'label'         => esc_html__( 'Theme Color Palette', 'newstoday' ),
                    'type'          => 'select',
                    'choices'       => $theme_color_palettes
                ),
            ),

            'theme-sidebar-position'    => array(
                'setting'               => array(
                    'default'           => 'right',
                    'sanitize_callback' => 'ilovewp_sanitize_text'
                ),
                'control'           => array(
                    'label'         => esc_html__( 'Default Sidebar Position', 'newstoday' ),
                    'type'          => 'select',
                    'choices'       => $theme_sidebar_positions
                ),
            ),

            'newstoday-display-featured-posts' => array(
                'setting'               => array(
                    'sanitize_callback' => 'absint',
                    'default'           => 0
                ),
                'control'               => array(
                    'label'             => __( 'Display Featured Posts on Homepage', 'newstoday' ),
                    'type'              => 'checkbox'
                )
            ),

            'newstoday-featured-category'  => array(
                'setting'               => array(
                    'default'           => '1',
                    'sanitize_callback' => 'newstoday_sanitize_categories'
                ),
                'control'               => array(
                    'label'             => esc_html__( 'Category for Featured Posts', 'newstoday' ),
                    'description'       => /* translators: link to categories */ sprintf( wp_kses( __( 'This list is populated with <a href="%1$s">Categories</a>.', 'newstoday' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'edit-tags.php?taxonomy=category' ) ) ),
                    'type'              => 'select',
                    'choices'           => newstoday_get_categories()
                ),
            ),

            'newstoday-featured-tag'  => array(
                'setting'               => array(
                    'default'           => '',
                    'sanitize_callback' => 'newstoday_sanitize_tags'
                ),
                'control'               => array(
                    'label'             => esc_html__( 'Tag for Featured Posts', 'newstoday' ),
                    'description'       => /* translators: link to tags */ sprintf( wp_kses( __( 'This list is populated with <a href="%1$s">Tags</a>. If you choose a Featured Tag, the category option above will be ignored.', 'newstoday' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'edit-tags.php?taxonomy=post_tag' ) ) ),
                    'type'              => 'select',
                    'choices'           => newstoday_get_tags()
                ),
            ),

            'theme-display-post-meta-author' => array(
                'setting'               => array(
                    'sanitize_callback' => 'absint',
                    'default'           => 0
                ),
                'control'               => array(
                    'label'             => __( 'Display post author on archive pages.', 'newstoday' ),
                    'type'              => 'checkbox'
                )
            ),

            'theme-display-post-meta-date' => array(
                'setting'               => array(
                    'sanitize_callback' => 'absint',
                    'default'           => 0
                ),
                'control'               => array(
                    'label'             => __( 'Display post date on archive pages.', 'newstoday' ),
                    'type'              => 'checkbox'
                )
            ),

            'theme-display-post-meta-category' => array(
                'setting'               => array(
                    'sanitize_callback' => 'absint',
                    'default'           => 0
                ),
                'control'               => array(
                    'label'             => __( 'Display post category on archive pages.', 'newstoday' ),
                    'type'              => 'checkbox'
                )
            ),

            'theme-display-post-meta-authorbio' => array(
                'setting'               => array(
                    'sanitize_callback' => 'absint',
                    'default'           => 0
                ),
                'control'               => array(
                    'label'             => __( 'Display post author bio on post pages.', 'newstoday' ),
                    'type'              => 'checkbox'
                )
            ),

            'theme-display-post-featured-image' => array(
                'setting'               => array(
                    'sanitize_callback' => 'absint',
                    'default'           => 0
                ),
                'control'               => array(
                    'label'             => __( 'Display Featured Images on Post pages', 'newstoday' ),
                    'type'              => 'checkbox'
                )
            ),

            'theme-display-category-rss' => array(
                'setting'               => array(
                    'sanitize_callback' => 'absint',
                    'default'           => 0
                ),
                'control'               => array(
                    'label'             => __( 'Display link to Category RSS Feed on Category Pages', 'newstoday' ),
                    'type'              => 'checkbox'
                )
            ),

        ),
    );

    return array_merge( $sections, $general_sections );
}

add_filter( 'ilovewp_customizer_sections', 'ilovewp_customizer_define_general_sections' );
