<?php
/**
 * Theme Palace options
 *
 * @package Theme Palace
 * @subpackage News Vibe
 * @since News Vibe 1.0.0
 */

/**
 * List of pages for page choices.
 * @return Array Array of page ids and name.
 */
function news_vibe_page_choices() {
    $pages = get_pages();
    $choices = array();
    $choices[0] = esc_html__( '--Select--', 'news-vibe' );
    foreach ( $pages as $page ) {
        $choices[ $page->ID ] = $page->post_title;
    }
    return  $choices;
}

/**
 * List of posts for post choices.
 * @return Array Array of post ids and name.
 */
function news_vibe_post_choices() {
    $posts = get_posts( array( 'numberposts' => -1 ) );
    $choices = array();
    $choices[0] = esc_html__( '--Select--', 'news-vibe' );
    foreach ( $posts as $post ) {
        $choices[ $post->ID ] = $post->post_title;
    }
    wp_reset_postdata();
    return  $choices;
}

/**
 * List of category for category choices.
 * @return Array Array of post ids and name.
 */
function news_vibe_category_choices() {
    $tax_args = array(
        'hierarchical' => 0,
        'taxonomy'     => 'category',
    );
    $taxonomies = get_categories( $tax_args );
    $choices = array();
    $choices[0] = esc_html__( '--Select--', 'news-vibe' );
    foreach ( $taxonomies as $tax ) {
        $choices[ $tax->term_id ] = $tax->name;
    }
    return  $choices;
}


if ( ! function_exists( 'news_vibe_site_layout' ) ) :
    /**
     * Site Layout
     * @return array site layout options
     */
    function news_vibe_site_layout() {
        $news_vibe_site_layout = array(
            'wide'  => esc_url( get_template_directory_uri() ) . '/assets/images/full.png',
            'boxed-layout' => esc_url( get_template_directory_uri() ) . '/assets/images/boxed.png',
            'frame-layout' => esc_url( get_template_directory_uri() ) . '/assets/images/framed.png',
        );

        $output = apply_filters( 'news_vibe_site_layout', $news_vibe_site_layout );
        return $output;
    }
endif;

if ( ! function_exists( 'news_vibe_selected_sidebar' ) ) :
    /**
     * Sidebars options
     * @return array Sidbar positions
     */
    function news_vibe_selected_sidebar() {
        $news_vibe_selected_sidebar = array(
            'sidebar-1'             => esc_html__( 'Default Sidebar', 'news-vibe' ),
            'optional-sidebar'      => esc_html__( 'Optional Sidebar 1', 'news-vibe' ),
            'optional-sidebar-2'    => esc_html__( 'Optional Sidebar 2', 'news-vibe' ),
            'optional-sidebar-3'    => esc_html__( 'Optional Sidebar 3', 'news-vibe' ),
            'optional-sidebar-4'    => esc_html__( 'Optional Sidebar 4', 'news-vibe' ),
        );

        $output = apply_filters( 'news_vibe_selected_sidebar', $news_vibe_selected_sidebar );

        return $output;
    }
endif;


if ( ! function_exists( 'news_vibe_global_sidebar_position' ) ) :
    /**
     * Global Sidebar position
     * @return array Global Sidebar positions
     */
    function news_vibe_global_sidebar_position() {
        $news_vibe_global_sidebar_position = array(
            'right-sidebar' => esc_url( get_template_directory_uri() ) . '/assets/images/right.png',
            'no-sidebar'    => esc_url( get_template_directory_uri() ) . '/assets/images/full.png',
        );

        $output = apply_filters( 'news_vibe_global_sidebar_position', $news_vibe_global_sidebar_position );

        return $output;
    }
endif;


if ( ! function_exists( 'news_vibe_sidebar_position' ) ) :
    /**
     * Sidebar position
     * @return array Sidbar positions
     */
    function news_vibe_sidebar_position() {
        $news_vibe_sidebar_position = array(
            'right-sidebar' => esc_url( get_template_directory_uri() ) . '/assets/images/right.png',
            'no-sidebar'    => esc_url( get_template_directory_uri() ) . '/assets/images/full.png',
        );

        $output = apply_filters( 'news_vibe_sidebar_position', $news_vibe_sidebar_position );

        return $output;
    }
endif;


if ( ! function_exists( 'news_vibe_pagination_options' ) ) :
    /**
     * Pagination
     * @return array site pagination options
     */
    function news_vibe_pagination_options() {
        $news_vibe_pagination_options = array(
            'numeric'   => esc_html__( 'Numeric', 'news-vibe' ),
            'default'   => esc_html__( 'Default(Older/Newer)', 'news-vibe' ),
        );

        $output = apply_filters( 'news_vibe_pagination_options', $news_vibe_pagination_options );

        return $output;
    }
endif;

if ( ! function_exists( 'news_vibe_switch_options' ) ) :
    /**
     * List of custom Switch Control options
     * @return array List of switch control options.
     */
    function news_vibe_switch_options() {
        $arr = array(
            'on'        => esc_html__( 'Enable', 'news-vibe' ),
            'off'       => esc_html__( 'Disable', 'news-vibe' )
        );
        return apply_filters( 'news_vibe_switch_options', $arr );
    }
endif;

if ( ! function_exists( 'news_vibe_hide_options' ) ) :
    /**
     * List of custom Switch Control options
     * @return array List of switch control options.
     */
    function news_vibe_hide_options() {
        $arr = array(
            'on'        => esc_html__( 'Yes', 'news-vibe' ),
            'off'       => esc_html__( 'No', 'news-vibe' )
        );
        return apply_filters( 'news_vibe_hide_options', $arr );
    }
endif;