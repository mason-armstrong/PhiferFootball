<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Theme Palace
 * @subpackage News Vibe
 * @since News Vibe 1.0.0
 */

/**
 * news_vibe_footer_primary_content hook
 *
 * @hooked news_vibe_add_contact_section -  10
 *
 */
do_action( 'news_vibe_footer_primary_content' );

/**
 * news_vibe_content_end_action hook
 *
 * @hooked news_vibe_content_end -  10
 *
 */
do_action( 'news_vibe_content_end_action' );

/**
 * news_vibe_content_end_action hook
 *
 * @hooked news_vibe_footer_start -  10
 * @hooked news_vibe_Footer_Widgets->add_footer_widgets -  20
 * @hooked news_vibe_footer_site_info -  40
 * @hooked news_vibe_footer_end -  100
 *
 */
do_action( 'news_vibe_footer' );

/**
 * news_vibe_page_end_action hook
 *
 * @hooked news_vibe_page_end -  10
 *
 */
do_action( 'news_vibe_page_end_action' ); 

?>

<?php wp_footer(); ?>

</body>
</html>
