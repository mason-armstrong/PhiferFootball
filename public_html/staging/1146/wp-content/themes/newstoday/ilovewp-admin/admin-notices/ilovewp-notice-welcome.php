<?php
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

class newstoday_notice_welcome extends newstoday_notice {

	public function __construct() {
		
		add_action( 'wp_loaded', array( $this, 'welcome_notice' ), 20 );
		add_action( 'wp_loaded', array( $this, 'hide_notices' ), 15 );

	}

	public function welcome_notice() {
		
		$this_notice_was_dismissed = $this->get_notice_status('welcome');
		
		if ( !$this_notice_was_dismissed ) {
			if ( isset($_GET['page']) && 'newstoday-doc' == $_GET['page'] ) {
				return;
			}

			add_action( 'admin_notices', array( $this, 'welcome_notice_markup' ) ); // Display this notice.
		}

	}

	/**
	 * Show welcome notice.
	 */
	public function welcome_notice_markup() {
		
		$dismiss_url = wp_nonce_url(
			remove_query_arg( array( 'activated' ), add_query_arg( 'newstoday-hide-notice', 'welcome' ) ),
			'newstoday_hide_notices_nonce',
			'_newstoday_notice_nonce'
		);

		$theme_data	 = wp_get_theme();

		?>
		<div id="message" class="notice notice-success ilovewp-notice ilovewp-welcome-notice">
			<a class="ilovewp-message-close notice-dismiss" href="<?php echo esc_url( $dismiss_url ); ?>"></a>

			<div class="ilovewp-message-content">
				<div class="ilovewp-message-image">
					<a href="<?php echo esc_url( admin_url( 'themes.php?page=newstoday-doc' ) ); ?>"><img class="ilovewp-screenshot" src="<?php echo esc_url( get_template_directory_uri() ); ?>/screenshot.png" alt="<?php esc_attr_e( 'Newstoday', 'newstoday' ); ?>" /></a>
				</div><!-- ws fix
				--><div class="ilovewp-message-text">
					<h2 class="ilovewp-message-heading"><?php esc_html_e( 'Thank you for choosing Newstoday Theme!', 'newstoday' ); ?></h2>
					<?php
					echo '<p>';
						/* translators: %1$s: theme name, %2$s link */
						printf( __( 'To take advantage of everything that this theme can offer, please take a look at the <a href="%2$s">Get Started with %1$s</a> page.', 'newstoday' ), esc_html( $theme_data->Name ), esc_url( admin_url( 'themes.php?page=newstoday-doc' ) ) );
					echo '</p>';

					echo '<p class="notice-buttons"><a href="'. esc_url( admin_url( 'themes.php?page=newstoday-doc' ) ) .'" class="button button-primary">';
						/* translators: %s theme name */
						printf( esc_html__( 'Get started with %s', 'newstoday' ), esc_html( $theme_data->Name ) );
					echo '</a>';
					echo ' <a href="'. esc_url( 'https://youtu.be/ElxvIvSoSkQ' ) .'" target="_blank" rel="noopener" class="button button-primary ilovewp-button ilovewp-button-youtube"><span class="dashicons dashicons-youtube"></span> ';
						/* translators: %s theme name */
						printf( esc_html__( '%s Video Guide', 'newstoday' ), esc_html( $theme_data->Name ) );
					echo '</a></p>';
					?>
				</div><!-- .ilovewp-message-text -->
			</div><!-- .ilovewp-message-content -->
		</div><!-- #message -->
		<?php
	}

}

new newstoday_notice_welcome();