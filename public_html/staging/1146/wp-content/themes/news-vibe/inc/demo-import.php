<?php
/**
 * Demo Import.
 *
 * This is the template that includes all the other files for core featured of Theme Palace
 *
 * @package Theme Palace
 * @subpackage News Vibe 
 * @since News Vibe  1.0.0
 */

function news_vibe_ctdi_plugin_page_setup( $default_settings ) {
    $default_settings['menu_title']  = esc_html__( 'Theme Palace Demo Import' , 'news-vibe' );

    return $default_settings;
}
add_filter( 'cp-ctdi/plugin_page_setup', 'news_vibe_ctdi_plugin_page_setup' );


function news_vibe_ctdi_plugin_intro_text( $default_text ) {
    $default_text .= sprintf( '<p class="about-description">%1$s <a href="%2$s">%3$s</a></p>', esc_html__( 'Demo content files for News Vibe Theme.', 'news-vibe' ),
    esc_url( 'https://themepalace.com/downloads/news-vibe' ), esc_html__( 'Click here for Demo File download', 'news-vibe' ) );
    return $default_text;
}
add_filter( 'cp-ctdi/plugin_intro_text', 'news_vibe_ctdi_plugin_intro_text' );