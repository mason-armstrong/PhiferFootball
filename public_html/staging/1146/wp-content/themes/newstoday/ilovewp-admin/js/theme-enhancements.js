jQuery(document).ready(function($) {

	/**
	 *	Process request to dismiss our admin notice
	 */
	$('#newstoday-admin-notice-postsnum .notice-dismiss').click(function() {

		//* Data to make available via the $_POST variable
		data = {
			action: 'newstoday_admin_notice_postsnum',
			newstoday_admin_notice_nonce: newstoday_admin_notice_postsnum.newstoday_admin_notice_nonce
		};

		//* Process the AJAX POST request
		$.post( ajaxurl, data );

		return false;
	});
});