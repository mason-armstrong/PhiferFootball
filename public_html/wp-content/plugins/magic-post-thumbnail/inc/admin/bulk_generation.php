<?php
if ( ! function_exists( 'add_filter' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
		exit();
}
?>
<div class="wrap">
	
	<h2 >Magic Post Thumbnail : <?php _e( 'Bulk Generation', 'mpt' ); ?></h2>
	
	<?php
		if ( ( ! empty( $_POST['mpt'] ) || ! empty( $_REQUEST['ids'] ) ) && ( empty( $_REQUEST['settings-updated'] ) || $_REQUEST['settings-updated'] != 'true' ) ) { 
		
			$ids = array_map( 'intval', explode( ',', $_REQUEST['ids'] ) );
	?>
			<div id="hide-before-import" style="display:none">

				<div class="progressionbar clearfix ">
					<div class="progressionbar-title"><span><?php _e( 'Progress', 'mpt' ); ?></span></div>
					<div class="progressionbar-bar"></div>
					<div class="skill-bar-percent"><span>0</span>%</div>
				</div> 
				
			</div>
			
			
			<table class="wp-list-mpt wp-list-table widefat fixed striped posts">
				<thead>
					<tr>
						<th scope="row"></th>
						<th scope="col" id="title" class="manage-column column-primary"><?php _e( 'Title', 'mpt' ); ?></th>
						<th scope="col" id="status" class="manage-column"><?php _e( 'Status', 'mpt' ); ?></th>
						<th scope="col" id="categories" class="manage-column"><?php _e( 'Links', 'mpt' ); ?></th>
						<th scope="col" id="tags" class="manage-column"><?php _e( 'Image', 'mpt' ); ?></th>
					</tr>
				</thead>

				<tbody id="mpt-list">
					<?php 
						foreach( $ids as $id ) {
							if( !get_post_status( $id ) )
								continue;
					?>
						<tr id="post-<?php echo $id; ?>" class="post-<?php echo $id; ?>">
							<th scope="row"></th>
							<td class="column-title">
								<strong>
									<span class="row-title"><?php echo get_the_title( $id ); ?></span>
								</strong>
							</td>
							<td class="column-status column-primary">
								<span class="empty-content"><img src="<?php echo esc_url( get_admin_url() . 'images/spinner.gif' ); ?>" title="<?php _e( 'Waiting for generation', 'mpt' ); ?>" /></span>
								<div class="row-status">
									<span class="status successful"><?php _e( 'Successful', 'mpt' ); ?></span> 
									<span class="status failed"><?php _e( 'Failed', 'mpt' ); ?></span> 
									<span class="status error"><?php _e( 'Error', 'mpt' ); ?></span> 
									<span class="status already-done"><?php _e( 'Image Already Exists', 'mpt' ); ?></span>
									<span class="status no-rewrite"><?php _e( 'No image rewriting into post content', 'mpt' ); ?></span>
								</div>
							</td>
							<td class="column-edit-links">
								<span class="empty-content">-</span>
								<div class="row-actions">
									<span class="edit"><a href="<?php echo get_edit_post_link( $id ); ?>" target="_blank"> <span class="dashicons dashicons-edit"></span> <?php _e( 'Edit', 'mpt' ); ?></a> | </span>
									<span class="view"><a href="<?php echo get_permalink( $id ); ?>" target="_blank"> <span class="dashicons dashicons-admin-links"></span> <?php _e( 'View', 'mpt' ); ?></a></span>
								</div>
							</td>
							<td class="column-image">
								<span class="empty-content">-</span>
								<div class="row-image">
								</div>
							</td>
						</tr>
					<?php } ?>
					
						<tr class="successful-generation">
							<th scope="row"></th>
							<td class="title has-row-actions column-primary" colspan="4">
								<strong><?php _e( 'Successful Generation', 'mpt' ); ?></strong>
							</td>
						</tr>
				</tbody>
			</table>
			
	<?php } ?>
	
</div>
<div class="clear"></div>