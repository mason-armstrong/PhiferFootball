<?php

if ( !function_exists( 'add_filter' ) ) {
    header( 'Status: 403 Forbidden' );
    header( 'HTTP/1.1 403 Forbidden' );
    exit;
}

?>
<div class="wrap">
	
	<h2>Magic Post Thumbnail : <?php 
_e( 'Cron', 'mpt' );
?></h2>
	
		<form method="post" action="options.php" >

		<?php 
settings_fields( 'MPT-plugin-cron-settings' );
$options = wp_parse_args( get_option( 'MPT_plugin_cron_settings' ), default_options_cron_settings( FALSE ) );
?>
		
		<table id="general-options" class="form-table">
			<tbody>
				
				<tr valign="top" class="enable_cron">
					<th scope="row">
						<label for="hseparator"><?php 
_e( 'Enable cron', 'mpt' );
?></label>
					</th>
					<td class="enable_cron">
						<label><input value="disable" name="MPT_plugin_cron_settings[enable_cron] " type="radio" <?php 
echo  ( !empty($options['enable_cron']) && $options['enable_cron'] == 'disable' ? 'checked' : '' ) ;
?>> <?php 
_e( 'Disable', 'mpt' );
?></label><br/>
						<label><input value="enable" name="MPT_plugin_cron_settings[enable_cron] " type="radio" <?php 
echo  ( !empty($options['enable_cron']) && $options['enable_cron'] == 'enable' ? 'checked' : '' ) ;
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