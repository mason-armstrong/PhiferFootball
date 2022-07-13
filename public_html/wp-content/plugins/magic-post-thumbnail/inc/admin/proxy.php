<?php

if ( !function_exists( 'add_filter' ) ) {
    header( 'Status: 403 Forbidden' );
    header( 'HTTP/1.1 403 Forbidden' );
    exit;
}

?>
<div class="wrap">
	
	<h2>Magic Post Thumbnail : <?php 
_e( 'Proxy', 'mpt' );
?></h2>
	
		<form method="post" action="options.php" >

		<?php 
settings_fields( 'MPT-plugin-proxy-settings' );
$options = wp_parse_args( get_option( 'MPT_plugin_proxy_settings' ), default_options_proxy_settings( FALSE ) );
?>
		
		<table id="general-options" class="form-table">
			<tbody>
			
				<p><?php 
_e( 'If you have a free or paid proxy, you can setup it here. You must use a proxy with <strong>HTTPS protocol</strong>. Use it carefully.', 'mpt' );
?></p>
				
				<tr valign="top" class="enable_proxy">
					<th scope="row">
						<label for="hseparator"><?php 
_e( 'Enable Proxy', 'mpt' );
?></label>
					</th>
					<td class="enable_proxy">
						<label><input value="disable" name="MPT_plugin_proxy_settings[enable_proxy] " type="radio" <?php 
echo  ( !empty($options['enable_proxy']) && $options['enable_proxy'] == 'disable' ? 'checked' : '' ) ;
?>> <?php 
_e( 'Disable', 'mpt' );
?></label><br/>
						<label><input value="enable" name="MPT_plugin_proxy_settings[enable_proxy] " type="radio" <?php 
echo  ( !empty($options['enable_proxy']) && $options['enable_proxy'] == 'enable' ? 'checked' : '' ) ;
?> > <?php 
_e( 'Enable', 'mpt' );
?></label>
					</td>
				</tr>
				
				<hr/>
				
				<?php 
?>
				
			</tbody>
		</table>
		
		<?php 
submit_button();
?>

	</form>
</div>
<div class="clear"></div>