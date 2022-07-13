<?php
/**
 * Customizer default options
 *
 * @package Theme Palace
 * @subpackage News Vibe
 * @since News Vibe 1.0.0
 * @return array An array of default values
 */

function news_vibe_get_default_theme_options() {
	$theme_data = wp_get_theme();
	$news_vibe_default_options = array(
		// Color Options
		'header_title_color'			=> '#fff',
		'header_tagline_color'			=> '#fff',
		'header_txt_logo_extra'			=> 'show-all',
		'header_overlay_color'			=> '#000',
		'header_overlay'				=> 5,
		
		// layout 
		'site_layout'         			=> 'wide',
		'sidebar_position'         		=> 'right-sidebar',
		'post_sidebar_position' 		=> 'right-sidebar',
		'page_sidebar_position' 		=> 'right-sidebar',
		'nav_search_enable'				=> true,

		// excerpt options
		'long_excerpt_length'           => 25,
		
		// pagination options
		'pagination_enable'         	=> true,
		'pagination_type'         		=> 'default',

		// footer options
		'copyright_text'           		=> sprintf( esc_html_x( 'Copyright &copy; %1$s %2$s. ', '1: Year, 2: Site Title with home URL', 'news-vibe' ), '[the-year]', '[site-link]' ) . esc_html__( 'All Rights Reserved | ', 'news-vibe' ) . esc_html( $theme_data->get( 'Name') ) . '&nbsp;' . esc_html__( 'by', 'news-vibe' ). '&nbsp;<a target="_blank" href="'. esc_url( $theme_data->get( 'AuthorURI' ) ) .'">'. esc_html( ucwords( $theme_data->get( 'Author' ) ) ) .'</a>',
		'scroll_top_visible'        	=> true,

		// reset options
		'reset_options'      			=> false,
		
		// homepage options
		'enable_frontpage_content' 		=> true,

		// homepage sections sortable
		'sortable' 						=> 'breakingnews,main_content,related_post',

		// blog/archive options
		'your_latest_posts_title' 		=> esc_html__( 'Blogs', 'news-vibe' ),
		'hide_category'					=> false,
		'hide_author'					=> false,
		'hide_date'					=> false,

		// single post theme options
		'single_post_hide_date' 		=> false,
		'single_post_hide_author'		=> false,
		'single_post_hide_category'		=> false,
		'single_post_hide_tags'			=> false,

		// Topbar
		'topbar_address'				=> esc_html__('Kathmandu, Nepal', 'news-vibe' ),
		'topbar_email'					=> esc_html__('info@magazinebook.gmail.com', 'news-vibe' ),
		'topbar_section_enable'			=> false,
		'secondary_menu_enable'			=> false,
		'social_menu_enable'			=> false,
		'frontpage_tags_enable'			=> false,	


		// Breaking News
		'breakingnews_section_enable'		=> false,
		'breakingnews_slider_auto_play'		=> false,
		'breakingnews_title'				=> esc_html__( 'Breaking News', 'news-vibe' ),

		// Featured post
		'featured_post_section_enable' => false,

		// Latest post
		'latest_post_title'				=> esc_html__( 'Latest News', 'news-vibe' ),
		'latest_post_section_enable' => false,

		// Popular
		'popular_section_enable'		=> false,
		'popular_title'					=> esc_html__( 'Most Popular', 'news-vibe' ),
		
		// Most viewed
		'most_viewed_section_enable'	=> false,
		'most_viewed_title'				=> esc_html__( 'Most Viewed', 'news-vibe' ),
		'most_viewed_content_type'		=> 'category',


		// related_post
		'related_post_section_enable'	=> false,
		'related_post_content_type'		=> 'category',
		'related_post_title'			=> esc_html__( 'RECENTLY VIEWED', 'news-vibe' ),

	);

	$output = apply_filters( 'news_vibe_default_theme_options', $news_vibe_default_options );

	// Sort array in ascending order, according to the key:
	if ( ! empty( $output ) ) {
		ksort( $output );
	}

	return $output;
}