<?php
/**
 * Theme Palace widgets inclusion
 *
 * This is the template that includes all custom widgets of News Vibe
 *
 * @package Theme Palace
 * @subpackage News Vibe
 * @since News Vibe 1.0.0
 */

/*
 * Add social link widget
 */
require get_template_directory() . '/inc/widgets/social-link-widget.php';

/*
 * Add Latest Posts widget
 */
require get_template_directory() . '/inc/widgets/latest-posts-widget.php';
/*
 * Add Recent Posts widget
 */
require get_template_directory() . '/inc/widgets/recent-posts-widget.php';


/**
 * Register widgets
 */
function news_vibe_register_widgets() {

	register_widget( 'news_vibe_Latest_Post' );

	register_widget( 'news_vibe_Recent_Post' );

	register_widget( 'news_vibe_Social_Link' );
	
	

}
add_action( 'widgets_init', 'news_vibe_register_widgets' );