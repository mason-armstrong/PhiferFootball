<?php
	/**
	 * The header for our theme.
	 *
	 * This is the template that displays all of the <head> section and everything up until <div id="content">
	 *
	 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
	 *
	 * @package Theme Palace
	 * @subpackage News Vibe
	 * @since News Vibe 1.0.0
	 */

	/**
	 * news_vibe_doctype hook
	 *
	 * @hooked news_vibe_doctype -  10
	 *
	 */
	do_action( 'news_vibe_doctype' );

?>
<head>
<?php
	/**
	 * news_vibe_before_wp_head hook
	 *
	 * @hooked news_vibe_head -  10
	 *
	 */
	do_action( 'news_vibe_before_wp_head' );

	wp_head(); 
?>
</head>

<body <?php body_class(); ?>>

<?php do_action( 'wp_body_open' ); ?>

<?php
	/**
	 * news_vibe_page_start_action hook
	 *
	 * @hooked news_vibe_page_start -  10
	 *
	 */
	do_action( 'news_vibe_page_start_action' ); 

	/**
	 * news_vibe_loader_action hook
	 *
	 * @hooked news_vibe_loader -  10
	 *
	 */
	do_action( 'news_vibe_before_header' );

	/**
	 * news_vibe_header_action hook
	 *
	 * @hooked news_vibe_header_start -  10
	 * @hooked news_vibe_site_branding -  20
	 * @hooked news_vibe_site_navigation -  30
	 * @hooked news_vibe_header_end -  50
	 *
	 */
	do_action( 'news_vibe_header_action' );

	/**
	 * news_vibe_content_start_action hook
	 *
	 * @hooked news_vibe_content_start -  10
	 * @hooked news_vibe_header_image_action -  20
	 *
	 */
	do_action( 'news_vibe_content_start_action' );

	if(!is_singular()) do_action( 'news_vibe_header_image_action' );
	

    if ( news_vibe_is_frontpage() ) {
    	news_vibe_get_frontpage_section();
	}