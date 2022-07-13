<?php
/**
 * Define Constants
 */
define('ILOVEWP_SHORTNAME', 'newstoday'); 
define('ILOVEWP_PAGE_BASENAME', 'newstoday-doc'); 

/**
 * Specify Hooks/Filters
 */
add_action( 'admin_menu', 'ilovewp_add_menu' );

/**
* The admin menu pages
*/
function ilovewp_add_menu(){
	
	add_theme_page( __('NewsToday Theme','newstoday'), __('NewsToday Theme','newstoday'), 'manage_options', ILOVEWP_PAGE_BASENAME, 'ilovewp_settings_page_doc' ); 

}

// ************************************************************************************************************

/*
 * Theme Documentation Page HTML
 * 
 * @return echoes output
 */
function ilovewp_settings_page_doc() {
	// get the settings sections array
	$theme_data = wp_get_theme();
	?>
	
	<div class="ilovewp-wrapper">
		<div class="ilovewp-header">
			<div id="ilovewp-theme-info">
				<p><?php 

					echo sprintf( 
					/* translators: Theme name and version */
					__( '<span class="theme-name">%1$s Theme</span> <span class="theme-version">(version %2$s)</span>', 'newstoday' ), 
					esc_html($theme_data->name),
					esc_html($theme_data->version)
					); ?></p>
					<p class="theme-buttons"><a class="button button-primary" href="https://www.ilovewp.com/themes/newstoday/" rel="noopener" target="_blank"><?php esc_html_e('Theme Details','newstoday'); ?></a>
				<a class="button button-primary" href="https://demo.ilovewp.com/?theme=newstoday" rel="noopener" target="_blank"><?php esc_html_e('NewsToday Live Demo','newstoday'); ?></a>
				<a class="button button-primary ilovewp-button ilovewp-button-youtube" href="https://youtu.be/ElxvIvSoSkQ" rel="noopener" target="_blank"><span class="dashicons dashicons-youtube"></span> <?php esc_html_e('NewsToday Video Guide','newstoday'); ?></a></p>
			</div><!-- #ilovewp-theme-info --><!-- ws fix
			--><div id="ilovewp-logo">
				<a href="https://www.ilovewp.com/" target="_blank" rel="noopener"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/ilovewp-admin/images/ilovewp-options-logo.png" width="153" height="33" alt="<?php esc_attr_e('ILoveWP.com Logo','newstoday'); ?>" /></a>
			</div><!-- #ilovewp-logo -->
		</div><!-- .ilovewp-header -->
		
		<div class="ilovewp-documentation">
			<div class="ilovewp-theme-intro">

				<?php
				$message = sprintf( __( 'Thank you for installing NewsToday', 'newstoday' ) );
				printf( '<h2>%s</h2>', $message );
				?>

			</div>

			<ul class="ilovewp-doc-columns clearfix">
				<li class="ilovewp-doc-column ilovewp-doc-column-1">
					<div class="ilovewp-doc-column-wrapper">
						<div class="doc-section">
							<h3 class="column-title"><span class="ilovewp-icon dashicons dashicons-editor-help"></span><span class="ilovewp-title-text"><?php esc_html_e('NewsToday Documentation and Support','newstoday'); ?></span></h3>
							<div class="ilovewp-doc-column-text-wrapper">
								<p><?php 
								echo sprintf( 
								/* translators: Theme name and link to WordPress.org Support forum for the theme */
								__( 'Support for %1$s Theme is provided in the official WordPress.org community support forums. ', 'newstoday' ), 
								esc_html($theme_data->name)	); ?></p>

								<p class="doc-buttons"><a class="button button-primary" href="https://www.ilovewp.com/documentation/newstoday/" rel="noopener" target="_blank"><?php esc_html_e('View NewsToday Documentation','newstoday'); ?></a> <a class="button button-secondary" href="https://wordpress.org/support/theme/newstoday/" rel="noopener" target="_blank"><?php esc_html_e('Go to NewsToday Support Forum','newstoday'); ?></a></p>

							</div><!-- .ilovewp-doc-column-text-wrapper-->
						</div><!-- .doc-section -->
						<div class="doc-section">

							<h3 class="column-title"><span class="ilovewp-icon dashicons dashicons-youtube"></span><span class="ilovewp-title-text"><?php esc_html_e('NewsToday Theme Video Tutorial','newstoday'); ?></span></h3>
							<div class="ilovewp-doc-column-text-wrapper">
							
								<p><strong><?php esc_html_e('Click the image below to open the video guide in a new browser tab.','newstoday'); ?></strong></p>
								<p><a href="https://youtu.be/ElxvIvSoSkQ" rel="noopener" target="_blank"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/ilovewp-admin/images/newstoday-video-preview.jpg" class="video-preview" alt="<?php esc_attr_e('NewsToday Theme Video Tutorial','newstoday'); ?>" /></a></p>

							</div><!-- .ilovewp-doc-column-text-wrapper-->

						</div><!-- .doc-section -->
						<div class="doc-section">
							<h3 class="column-title"><span class="ilovewp-icon dashicons dashicons-email-alt"></span><span class="ilovewp-title-text"><?php esc_html_e('Contact the Developer','newstoday'); ?></span></h3>
							<div class="ilovewp-doc-column-text-wrapper">
								<p><?php esc_html_e('You can send a direct message to the developer of the theme.','newstoday'); ?></p>
								<p class="doc-buttons"><a class="button button-primary" href="https://www.ilovewp.com/contact/" rel="noopener" target="_blank"><?php esc_html_e('Contact the developer','newstoday'); ?></a></p>

							</div><!-- .ilovewp-doc-column-text-wrapper-->
						</div><!-- .doc-section -->
					</div><!-- .ilovewp-doc-column-wrapper -->
				</li><!-- .ilovewp-doc-column --><li class="ilovewp-doc-column ilovewp-doc-column-2">
					<div class="ilovewp-doc-column-wrapper">
						<div class="doc-section">
							<h3 class="column-title"><span class="ilovewp-icon dashicons dashicons-star-filled"></span><span class="ilovewp-title-text"><?php esc_html_e('Help me with a review or a donation','newstoday'); ?></span></h3>
							<div class="ilovewp-doc-column-text-wrapper">
								<p><?php esc_html_e('Please leave a review for NewsToday on the WordPress.org website or make a donation. It helps me continue providing updates and support for this theme.','newstoday'); ?></p>

								<p class="doc-buttons"><a class="button button-primary" href="https://wordpress.org/support/theme/newstoday/reviews/#new-post" rel="noopener" target="_blank"><?php esc_html_e('Write a Review for NewsToday','newstoday'); ?></a><a class="button button-primary button-donate" href="https://www.ilovewp.com/donate/" rel="noopener" target="_blank"><?php esc_html_e('Make a Donation','newstoday'); ?></a></p>

							</div><!-- .ilovewp-doc-column-text-wrapper-->
						</div><!-- .doc-section -->

						<div class="doc-section">

							<h3 class="column-title"><span class="ilovewp-icon dashicons dashicons-admin-appearance"></span><span class="ilovewp-title-text"><?php esc_html_e('WordPress Themes and Resources','newstoday'); ?></span></h3>
							<div class="ilovewp-doc-column-text-wrapper">
							
								<p><?php esc_html_e('NewsToday is just one of the many free WordPress themes that I have developed. ','newstoday'); ?></p>
								<p><a class="button button-primary" href="https://www.ilovewp.com/theme-shops/ilovewp/" rel="noopener" target="_blank"><?php esc_html_e('See more free WordPress Themes','newstoday'); ?></a></p>

								<p><?php esc_html_e('I have a great collection of guides and articles on how to create WordPress websites for: Photographers, Hotels, Schools, Universities, Churches, Museums, Doctors, Hospitals, Lawyers and other types of organizations and businesses.','newstoday'); ?></p>
								<p><a class="button button-primary" href="https://www.ilovewp.com/resources/" rel="noopener" target="_blank"><?php esc_html_e('Browse the WordPress Resources','newstoday'); ?></a></p>

							</div><!-- .ilovewp-doc-column-text-wrapper-->

						</div><!-- .doc-section -->

						<div class="doc-section">

							<h3 class="column-title"><span class="ilovewp-icon dashicons dashicons-cloud"></span><span class="ilovewp-title-text"><?php esc_html_e('Looking for a new web hosting provider?','newstoday'); ?></span></h3>
							<div class="ilovewp-doc-column-text-wrapper">

								<p><?php esc_html_e('I have a small list of handpicked hosting providers that have a great reputation in the WordPress community.','newstoday'); ?></p>
								<p><a class="button button-primary" href="https://www.ilovewp.com/resources/wordpress-hosting/" rel="noopener" target="_blank"><?php esc_html_e('Popular WordPress Hosting Providers','newstoday'); ?></a></p>

						</div><!-- .doc-section -->

					</div><!-- .ilovewp-doc-column-wrapper -->
				</li><!-- .ilovewp-doc-column -->
			</ul><!-- .ilovewp-doc-columns -->

			<div style="clear: both;">

		</div><!-- .ilovewp-documentation -->

	</div><!-- .ilovewp-wrapper -->

<?php }