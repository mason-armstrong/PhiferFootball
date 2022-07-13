<?php

namespace Dev7studios\WPSocialPreview;

class UserProfile extends Base {
	public function init() {
		add_action( 'show_user_profile', [ $this, 'user_profile_fields' ] );
		add_action( 'edit_user_profile', [ $this, 'user_profile_fields' ] );
		add_action( 'personal_options_update', [ $this, 'save_user_profile_fields' ] );
		add_action( 'edit_user_profile_update', [ $this, 'save_user_profile_fields' ] );
	}

	public function user_profile_fields( $user ) {
		?>
        <h3><?php _e( 'WP Social Preview', $this->textDomain ); ?></h3>

        <table class="form-table">
            <tr>
                <th><label for="address"><?php _e( 'Twitter Username', $this->textDomain ); ?></label></th>
                <td>
                    <input type="text"
                           name="<?php echo $this->metaPrefix . 'twitter_username'; ?>"
                           id="<?php echo $this->metaPrefix . 'twitter_username'; ?>"
                           value="<?php echo esc_attr( get_the_author_meta( $this->metaPrefix . 'twitter_username', $user->ID ) ); ?>"
                           class="regular-text"/><br/>
                    <span class="description"><?php _e( 'Including the @ (e.g. @example)', $this->textDomain ); ?></span>
                </td>
            </tr>
        </table>
		<?php
	}

	public function save_user_profile_fields( $user_id ) {
		if ( ! current_user_can( 'edit_user', $user_id ) ) {
			return false;
		}

		$value = filter_var( $_POST[ $this->metaPrefix . 'twitter_username' ], FILTER_SANITIZE_STRING );
		if ( $value && strpos( $value, '@' ) !== 0 ) {
			$value = '@' . $value;
		}

		update_user_meta( $user_id, $this->metaPrefix . 'twitter_username', $value );
	}
}
