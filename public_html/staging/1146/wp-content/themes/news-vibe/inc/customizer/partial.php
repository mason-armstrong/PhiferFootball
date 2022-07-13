<?php
/**
* Partial functions
*
* @package Theme Palace
* @subpackage News Vibe
* @since News Vibe 1.0.0
*/

if ( ! function_exists( 'news_vibe_breakingnews_title_partial' ) ) :
    // breakingnews title
    function news_vibe_breakingnews_title_partial() {
        $options = news_vibe_get_theme_options();
        return esc_html( $options['breakingnews_title'] );
    }
endif;

if ( ! function_exists( 'news_vibe_latest_post_title_partial' ) ) :
    // latest post title
    function news_vibe_latest_post_title_partial() {
        $options = news_vibe_get_theme_options();
        return esc_html( $options['latest_post_title'] );
    }
endif;


if ( ! function_exists( 'news_vibe_most_viewed_title_partial' ) ) :
    // latest post title
    function news_vibe_most_viewed_title_partial() {
        $options = news_vibe_get_theme_options();
        return esc_html( $options['most_viewed_title'] );
    }
endif;


if ( ! function_exists( 'news_vibe_popular_title_partial' ) ) :
    // popular title
    function news_vibe_popular_title_partial() {
        $options = news_vibe_get_theme_options();
        return esc_html( $options['popular_title'] );
    }
endif;


if ( ! function_exists( 'news_vibe_related_post_title_partial' ) ) :
    // related post title
    function news_vibe_related_post_title_partial() {
        $options = news_vibe_get_theme_options();
        return esc_html( $options['related_post_title'] );
    }
endif;

if ( ! function_exists( 'news_vibe_copyright_text_partial' ) ) :
    // copyright text
    function news_vibe_copyright_text_partial() {
        $options = news_vibe_get_theme_options();
        return esc_html( $options['copyright_text'] );
    }
endif;
