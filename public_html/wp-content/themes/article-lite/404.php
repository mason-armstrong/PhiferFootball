<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Article Lite
 */

get_header();?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<div class="wrapper">
				<div class="error-box">
				  <p class="error404 text-center"><?php esc_html_e( '404', 'article-lite' ); ?></p>
				  <p class="error-title text-center"><?php esc_html_e('Page Not Found', 'article-lite' ); ?></p>
				  <p class="error-message text-center"><?php esc_html_e('It appears the page you were wanting to see is either missing, no longer available, or another problem has caused this error.', 'article-lite'); ?></p>
				  <p class="text-center"><a class="error-button btn" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php esc_html_e('Back to Home', 'article-lite'); ?></a></p>
				</div>
			</div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
