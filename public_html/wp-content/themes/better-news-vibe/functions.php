<?php

if ( ! function_exists( 'better_news_vibe_enqueue_styles' ) ) :

	function better_news_vibe_enqueue_styles() {
		wp_enqueue_style( 'better-news-vibe-style-parent', get_template_directory_uri() . '/style.css' );

		wp_enqueue_style( 'better-news-vibe-child-style', get_stylesheet_directory_uri() . '/style.css', array( 'better-news-vibe-style-parent' ), '1.0.0' );
	}
endif;
add_action( 'wp_enqueue_scripts', 'better_news_vibe_enqueue_styles', 99 );

require get_theme_file_path() . '/inc/customizer.php';

require get_theme_file_path() . '/inc/front-sections/main-content.php';
