<?php
/**
* Customizer validation functions
*
* @package Theme Palace
* @subpackage News Vibe
* @since News Vibe 1.0.0
*/

if ( ! function_exists( 'news_vibe_validate_long_excerpt' ) ) :
  function news_vibe_validate_long_excerpt( $validity, $value ){
         $value = intval( $value );
     if ( empty( $value ) || ! is_numeric( $value ) ) {
         $validity->add( 'required', esc_html__( 'You must supply a valid number.', 'news-vibe' ) );
     } elseif ( $value < 5 ) {
         $validity->add( 'min_no_of_words', esc_html__( 'Minimum no of words is 5', 'news-vibe' ) );
     } elseif ( $value > 100 ) {
         $validity->add( 'max_no_of_words', esc_html__( 'Maximum no of words is 100', 'news-vibe' ) );
     }
     return $validity;
  }
endif;


if ( ! function_exists( 'news_vibe_validate_media_post_count' ) ) :
  function news_vibe_validate_media_post_count( $validity, $value ){
         $value = intval( $value );
     if ( empty( $value ) || ! is_numeric( $value ) ) {
         $validity->add( 'required', esc_html__( 'You must supply a valid number.', 'news-vibe' ) );
     } elseif ( $value < 3 ) {
         $validity->add( 'min_no_of_posts', esc_html__( 'Minimum no of posts is 3', 'news-vibe' ) );
     } elseif ( $value > 10 ) {
         $validity->add( 'max_no_of_posts', esc_html__( 'Maximum no of posts is 10', 'news-vibe' ) );
     }
     return $validity;
  }
endif;
