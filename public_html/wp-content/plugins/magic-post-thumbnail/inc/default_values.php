<?php

if ( !function_exists( 'add_filter' ) ) {
    header( 'Status: 403 Forbidden' );
    header( 'HTTP/1.1 403 Forbidden' );
    exit;
}

// Settings Options
if ( !function_exists( "default_options_main_settings" ) ) {
    function default_options_main_settings( $never_set = FALSE )
    {
        
        if ( $never_set == TRUE ) {
            $post_types_default = get_post_types( '', 'objects' );
            unset( $post_types_default['attachment'], $post_types_default['revision'], $post_types_default['nav_menu_item'] );
            foreach ( $post_types_default as $post_type ) {
                $default_post_types[$post_type->name] = $post_type->name;
            }
            $categories_default = get_terms( array(
                'taxonomy'   => 'category',
                'hide_empty' => false,
            ) );
            foreach ( $categories_default as $category ) {
                $default_categories[$category->slug] = $category->name;
            }
        } else {
            $default_post_types = array();
            $default_categories = array();
        }
        
        $default_options = array(
            'choosed_post_type'  => $default_post_types,
            'choosed_categories' => $default_categories,
            'image_location'     => 'featured',
            'based_on'           => 'title',
            'title_selection'    => 'full_title',
            'selected_image'     => 'first_result',
            'image_filename'     => 'title',
            'rewrite_featured'   => '',
            'enable_FIFU'        => '',
            'logs'               => '',
        );
        return $default_options;
    }

}
// Banks Options
if ( !function_exists( "default_options_banks_settings" ) ) {
    function default_options_banks_settings( $never_set = FALSE )
    {
        $default_options = array(
            'api_chosen'      => 'google_scraping',
            'google_scraping' => array(
            'search_country'     => 'en',
            'img_color'          => '',
            'rights'             => '',
            'imgsz'              => '',
            'format'             => '',
            'imgtype'            => '',
            'safe'               => 'medium',
            'restricted_domains' => '',
        ),
            'googleimage'     => array(
            'cxid'           => '',
            'apikey'         => '',
            'search_country' => 'en',
            'img_color'      => '',
            'filetype'       => '',
            'imgsz'          => '',
            'imgtype'        => '',
            'safe'           => 'moderate',
        ),
            'flickr'          => array(
            'rights'  => '',
            'imgtype' => 7,
        ),
            'pixabay'         => array(
            'username'       => '',
            'apikey'         => '',
            'imgtype'        => 'all',
            'search_country' => 'en',
            'orientation'    => 'all',
            'min_width'      => 0,
            'min_height'     => 0,
            'safesearch'     => 'false',
        ),
        );
        return $default_options;
    }

}
// Cron Options
if ( !function_exists( "default_options_cron_settings" ) ) {
    function default_options_cron_settings( $never_set = FALSE )
    {
        $default_options = array(
            'enable_cron' => 'disable',
        );
        return $default_options;
    }

}
// Proxy Options
if ( !function_exists( "default_options_proxy_settings" ) ) {
    function default_options_proxy_settings( $never_set = FALSE )
    {
        $default_options = array(
            'enable_proxy' => 'disable',
        );
        return $default_options;
    }

}