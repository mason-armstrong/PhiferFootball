<?php

if ( !function_exists( 'add_filter' ) ) {
    header( 'Status: 403 Forbidden' );
    header( 'HTTP/1.1 403 Forbidden' );
    exit;
}

?>
<div class="wrap">
	
	<h2 >Magic Post Thumbnail : <?php 
_e( 'Image banks', 'mpt' );
?></h2>
	
	<form method="post" action="options.php" >

		<?php 
settings_fields( 'MPT-plugin-banks-settings' );
$options = wp_parse_args( get_option( 'MPT_plugin_banks_settings' ), default_options_banks_settings( FALSE ) );
?>
		
		<table id="general-options" class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">
						<label for="hseparator"><?php 
_e( 'Image bank', 'mpt' );
?></label>
					</th>
					<td class="chosen_api">
						<p class="description">
							<?php 
_e( 'Choose which database you want to search for pictures', 'mpt' );
?>
						</p>
						<?php 
$list_api = array(
    __( 'Google Image (Scraping)', 'mpt' ) => 'google_scraping',
    __( 'Google Image (API)', 'mpt' )      => 'google_image',
    __( 'Flickr', 'mpt' )                  => 'flickr',
    __( 'Pixabay', 'mpt' )                 => 'pixabay',
    __( 'Youtube', 'mpt' )                 => 'youtube',
    __( 'Shutterstock', 'mpt' )            => 'shutterstock',
    __( 'Getty Images', 'mpt' )            => 'gettyimages',
    __( 'Unsplash', 'mpt' )                => 'unsplash',
);
foreach ( $list_api as $api => $api_code ) {
    $checked = ( isset( $options['api_chosen'] ) && !empty($options['api_chosen']) && $api_code == $options['api_chosen'] ? 'checked' : '' );
    echo  '<label><input type="radio" ' . $checked . ' value="' . $api_code . '" name="MPT_plugin_banks_settings[api_chosen] "> ' . $api . '</option></label><br/>' ;
}
?>
					</td>
				</tr>
			</tbody>
		</table>
		
		<h2 class="nav-tab-wrapper">
			<?php 
foreach ( $list_api as $api => $api_code ) {
    
    if ( isset( $options['api_chosen'] ) && !empty($options['api_chosen']) && $api_code == $options['api_chosen'] ) {
        echo  '<span href="#' . $api_code . '" class="nav-tab nav-tab-active">' . $api . '</span>' ;
    } else {
        echo  '<span href="#' . $api_code . '" class="nav-tab" style="opacity: 0.4;" disabled="disabled">' . $api . '</span>' ;
    }

}
?>
		</h2>
		
		<?php 
foreach ( $list_api as $api => $api_code ) {
    $checked = ( isset( $options['api_chosen'] ) && !empty($options['api_chosen']) && $api_code == $options['api_chosen'] ? '' : 'style="display: none;"' );
    echo  '<table id="' . $api_code . '" class="form-table" ' . $checked . '>' ;
    echo  '<tbody>' ;
    if ( !in_array( $api_code, array(
        'youtube',
        'shutterstock',
        'gettyimages',
        'unsplash'
    ) ) ) {
        include_once $api_code . '.php';
    }
    echo  '</tbody>' ;
    echo  '</table>' ;
}
?>
		
		<?php 
submit_button();
?>

	</form>
</div>
<div class="clear"></div>