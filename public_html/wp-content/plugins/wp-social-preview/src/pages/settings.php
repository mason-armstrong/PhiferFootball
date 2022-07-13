<div class="wpsor-header">
    <h1><?php _e( 'WP Social Preview', $this->textDomain ) ?></h1>
</div>
<div class="wpsor-content wrap">
    <div style="max-width: 1200px;">
        <h2 class="nav-tab-wrapper">
            <a href="#general" class="nav-tab nav-tab-active">
                <span class="dashicons dashicons-admin-generic"></span>
                General Settings
            </a>
            <a href="#facebook" class="nav-tab">
                <span class="dashicons dashicons-facebook"></span>
                Facebook Settings
            </a>
            <a href="#twitter" class="nav-tab">
                <span class="dashicons dashicons-twitter"></span>
                Twitter Settings
            </a>
            <a href="#pinterest" class="nav-tab">
                <span class="dashicons dashicons-location"></span>
                Pinterest Settings
            </a>
        </h2>

        <form method="post" action="options.php">
			<?php
			settings_fields( 'wp_social_preview' );

			/**
			 * Override do_settings_sections to tweak markup
			 */
			$page = 'wp_social_preview';
			global $wp_settings_sections, $wp_settings_fields;

			if ( isset( $wp_settings_sections[ $page ] ) ) {
				foreach ( (array) $wp_settings_sections[ $page ] as $section ) {
					echo "<div id=\"{$section['id']}\" class='wpsopr-setting-section'>";

					if ( $section['callback'] ) {
						call_user_func( $section['callback'], $section );
					}

					if ( ! isset( $wp_settings_fields ) || ! isset( $wp_settings_fields[ $page ] ) || ! isset( $wp_settings_fields[ $page ][ $section['id'] ] ) ) {
						continue;
					}
					echo '<table class="form-table" role="presentation">';
					do_settings_fields( $page, $section['id'] );
					echo '</table>';

					echo '</div>';
				}
			}

			submit_button();
			?>
        </form>

        <script>
            jQuery(document).ready(function ($) {
                // Tab nav
                $('.nav-tab-wrapper a').click(function (e) {
                    e.preventDefault();
                    showTab($(this).attr('href'));
                });

                function showTab(id) {
                    $('.nav-tab-wrapper a').removeClass('nav-tab-active');
                    $('.nav-tab-wrapper a[href="' + id + '"]').addClass('nav-tab-active').blur();

                    $('.wpsopr-setting-section').hide();
                    $(id + '_settings').show();
                }

                // File selector
                $('.wpsopr-browse').on('click', function (e) {
                    e.preventDefault();

                    var $self = $(this);
                    var target = '#' + $self.attr('data-target');

                    var file_frame = wp.media.frames.file_frame = wp.media({
                        title: $self.data('uploader_title'),
                        button: {
                            text: $self.data('uploader_button_text'),
                        },
                        multiple: false
                    });

                    file_frame.on('select', function () {
                        var attachment = file_frame.state().get('selection').first().toJSON();
                        $(target).val(attachment.id).change();

                        $(target + '_preview').empty();
                        $(target + '_preview').append('<img src="' + attachment.sizes.full.url + '" />');
                        $self.next('.wpsopr-remove').show();
                    });

                    file_frame.open();
                });

                // Remove
                $('.wpsopr-remove').on('click', function (e) {
                    e.preventDefault();

                    var $self = $(this);
                    var target = '#' + $self.attr('data-target');

                    $(target).val('').change();
                    $(target + '_preview').empty();
                    $self.hide();
                });
            });
        </script>
    </div>
</div>
