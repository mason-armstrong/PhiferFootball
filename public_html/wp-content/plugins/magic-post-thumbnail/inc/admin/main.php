<?php

if ( !function_exists( 'add_filter' ) ) {
    header( 'Status: 403 Forbidden' );
    header( 'HTTP/1.1 403 Forbidden' );
    exit;
}

$list_settings = array(
    __( 'Settings', 'mpt' ) => 'settings',
    __( 'Logs', 'mpt' )     => 'logs',
);
?>
<div class="wrap">
	
	<h2 >Magic Post Thumbnail : <?php 
_e( 'Settings', 'mpt' );
?></h2>
	
	
	<form method="post" action="options.php" id="tabs" >

		<?php 
settings_fields( 'MPT-plugin-main-settings' );
$options = wp_parse_args( get_option( 'MPT_plugin_main_settings' ), default_options_main_settings( TRUE ) );
?>
            
             <div class="nav-tab-wrapper main-settings-tabs">
                <ul>
                    <?php 
$tabs_counter = 0;
foreach ( $list_settings as $settings => $settings_code ) {
    
    if ( 0 == $tabs_counter ) {
        //$active_class = 'nav-tab-active';
        $active_class = '';
    } else {
        $active_class = '';
    }
    
    echo  '<li><a href="#' . $settings_code . '" class="nav-tab ' . $active_class . '">' . $settings . '</a></li>' ;
    $tabs_counter++;
}
?>
		</ul>
            </div>
		
            <div id="settings">
                <table id="general-options" class="form-table tabs-content">
                        <tbody>
                                <tr valign="top">
                                        <th scope="row">
                                                <?php 
_e( 'Relevant post type', 'mpt' );
?>
                                        </th>
                                        <td class="post-type">
                                                <label><input type="checkbox" name="select-all-pt" id="select-all-pt"/> <?php 
_e( 'Select all', 'mpt' );
?></label><br/>
                                                <?php 
$post_types_default = get_post_types( '', 'objects' );
unset( $post_types_default['attachment'], $post_types_default['revision'], $post_types_default['nav_menu_item'] );
foreach ( $post_types_default as $post_type ) {
    
    if ( post_type_supports( $post_type->name, 'thumbnail' ) == 'true' ) {
        $checked = ( isset( $options['choosed_post_type'][$post_type->name] ) ? 'checked' : '' );
        echo  '<label>
                                                                                <input ' . $checked . ' name="MPT_plugin_main_settings[choosed_post_type][' . $post_type->name . ']" type="checkbox" value="' . $post_type->name . '"> ' . $post_type->labels->name . '
                                                                        </label><br/>' ;
    }

}
?>
                                        </td>
                                </tr>

                                <tr valign="top">
                                        <th scope="row">
                                                <?php 
_e( 'Relevant categories', 'mpt' );
?>
                                        </th>
                                        <td class="taxonomy">
                                                <label><input type="checkbox" name="select-all-tx" id="select-all-tx"/> <?php 
_e( 'Select all', 'mpt' );
?></label><br/>
                                                <?php 
$categories_default = get_terms( array(
    'taxonomy'   => 'category',
    'hide_empty' => false,
) );
foreach ( $categories_default as $category ) {
    $checked = ( isset( $options['choosed_categories'][$category->slug] ) ? 'checked' : '' );
    echo  '<label>
                                                                        <input ' . $checked . ' name="MPT_plugin_main_settings[choosed_categories][' . $category->slug . ']" type="checkbox" value="' . $category->slug . '"> ' . $category->name . '
                                                                </label><br/>' ;
}
?>
                                        </td>
                                </tr>

                                <tr valign="top">
                                        <th scope="row">
                                                <?php 
_e( 'Featured or Post Image', 'mpt' );
?>
                                        </th>
                                        <td class="image_location">
                                                <label><input value="featured" name="MPT_plugin_main_settings[image_location] " type="radio" <?php 
echo  ( !empty($options['image_location']) && $options['image_location'] == 'featured' ? 'checked' : '' ) ;
?>> <?php 
_e( 'Featured Image', 'mpt' );
?></label><br/>
                                                <label><input value="post_top" name="MPT_plugin_main_settings[image_location] " type="radio" <?php 
echo  ( !empty($options['image_location']) && $options['image_location'] == 'post_top' ? 'checked' : '' ) ;
?>> <?php 
_e( 'Top of post', 'mpt' );
?></label><br/>
                                                <label><input value="post_end" name="MPT_plugin_main_settings[image_location] " type="radio" <?php 
echo  ( !empty($options['image_location']) && $options['image_location'] == 'post_end' ? 'checked' : '' ) ;
?>> <?php 
_e( 'End of post', 'mpt' );
?></label><br/>
                                                <p class="description">
                                                        <?php 
_e( 'Choose where the image will be created ', 'mpt' );
?>
                                                </p>
                                        </td>
                                </tr>

                                <tr valign="top">
                                        <th scope="row">
                                                <label for="hseparator"><?php 
_e( 'Based on', 'mpt' );
?></label>
                                        </th>

                                        <?php 
?>
                                                <td class="based_on">
                                                        <label><input value="title" name="MPT_plugin_main_settings[based_on] " type="radio" <?php 
echo  ( !empty($options['based_on']) && $options['based_on'] == 'title' ? 'checked' : '' ) ;
?> > <?php 
_e( 'Title', 'mpt' );
?></label><br/>
                                                        <label><input value="text_analyser" name="MPT_plugin_main_settings[based_on] " type="radio" <?php 
echo  ( !empty($options['based_on']) && $options['based_on'] == 'text_analyser' ? 'checked' : '' ) ;
?>> <?php 
_e( 'Text Analyser', 'mpt' );
?> <i><?php 
_e( '(beta)', 'mpt' );
?></i></label><br/>
                                                        <label><input value="tags" name="MPT_plugin_main_settings[based_on] " type="radio"> <?php 
_e( 'Tags', 'mpt' );
?></label><br/>
                                                        <label><input value="categories" name="MPT_plugin_main_settings[based_on] " type="radio"> <?php 
_e( 'Categories', 'mpt' );
?></label><br/>
                                                        <label><input value="custom_field" name="MPT_plugin_main_settings[based_on] " type="radio"> <?php 
_e( 'Custom Field', 'mpt' );
?></label>

                                                </td>

                                        <?php 
?>
                                </tr>

                                <tr valign="top" class="section_tags" <?php 
echo  ( $options['based_on'] != 'tags' ? 'style="display:none;"' : '' ) ;
?>>
                                        <th scope="row">
                                                <label for="hseparator"><?php 
_e( 'Tags', 'mpt' );
?></label>
                                        </th>
                                        <td class="tags">
                                                <label><input value="first_tag" name="MPT_plugin_main_settings[tags] " type="radio" <?php 
echo  ( !empty($options['tags']) && $options['tags'] == 'first_tag' ? 'checked' : '' ) ;
?> > <?php 
_e( 'First tag', 'mpt' );
?></label><br/>
                                                <label><input value="last_tag" name="MPT_plugin_main_settings[tags] " type="radio" <?php 
echo  ( !empty($options['tags']) && $options['tags'] == 'last_tag' ? 'checked' : '' ) ;
?>> <?php 
_e( 'Last tag', 'mpt' );
?></label><br/>
                                                <label><input value="random_tag" name="MPT_plugin_main_settings[tags] " type="radio" <?php 
echo  ( !empty($options['tags']) && $options['tags'] == 'random_tag' ? 'checked' : '' ) ;
?>> <?php 
_e( 'Random tag', 'mpt' );
?></label>
                                        </td>
                                </tr>

                                <tr valign="top" class="section_categories" <?php 
echo  ( $options['based_on'] != 'categories' ? 'style="display:none;"' : '' ) ;
?>>
                                        <th scope="row">
                                                <label for="hseparator"><?php 
_e( 'Categories', 'mpt' );
?></label>
                                        </th>
                                        <td class="categories">
                                                <label><input value="first_category" name="MPT_plugin_main_settings[categories] " type="radio" <?php 
echo  ( !empty($options['categories']) && $options['categories'] == 'first_category' ? 'checked' : '' ) ;
?> > <?php 
_e( 'First category', 'mpt' );
?></label><br/>
                                                <label><input value="last_category" name="MPT_plugin_main_settings[categories] " type="radio" <?php 
echo  ( !empty($options['categories']) && $options['categories'] == 'last_category' ? 'checked' : '' ) ;
?>> <?php 
_e( 'Last category', 'mpt' );
?></label><br/>
                                                <label><input value="random_category" name="MPT_plugin_main_settings[categories] " type="radio" <?php 
echo  ( !empty($options['categories']) && $options['categories'] == 'random_category' ? 'checked' : '' ) ;
?>> <?php 
_e( 'Random category', 'mpt' );
?></label>
                                        </td>
                                </tr>

                                <tr valign="top" class="section_custom_field" <?php 
echo  ( $options['based_on'] != 'custom_field' ? 'style="display:none;"' : '' ) ;
?>>
                                        <th scope="row">
                                                <label for="hseparator"><?php 
_e( 'Custom field Name', 'mpt' );
?></label>
                                        </th>
                                        <td class="custom_field">
                                                <label><input type="text" name="MPT_plugin_main_settings[custom_field]" value="<?php 
echo  ( isset( $options['custom_field'] ) && !empty($options['custom_field']) ? $options['custom_field'] : '' ) ;
?>" >
                                        </td>
                                </tr>

                                <tr valign="top" class="section_title" <?php 
echo  ( $options['based_on'] != 'title' ? 'style="display:none;"' : '' ) ;
?>>
                                        <th scope="row">
                                                <label for="hseparator"><?php 
_e( 'Title', 'mpt' );
?></label>
                                        </th>
                                        <td class="chosen_title">
                                                <p class="description">
                                                    <?php 
_e( 'Search picture according title', 'mpt' );
?>
                                                </p>
                                                <label><input value="full_title" name="MPT_plugin_main_settings[title_selection] " type="radio" <?php 
echo  ( !empty($options['title_selection']) && $options['title_selection'] == 'full_title' ? 'checked' : '' ) ;
?> > <?php 
_e( 'Full title', 'mpt' );
?></label><br/>
                                                <label><input value="cut_title" name="MPT_plugin_main_settings[title_selection] " type="radio" <?php 
echo  ( !empty($options['title_selection']) && $options['title_selection'] == 'cut_title' ? 'checked' : '' ) ;
?>> <?php 
_e( 'Part of the title', 'mpt' );
?> : </label>
                                                <input type="number" name="MPT_plugin_main_settings[title_length]" min="1" value="<?php 
echo  ( isset( $options['title_length'] ) && !empty($options['title_length']) ? (int) $options['title_length'] : '3' ) ;
?>" <?php 
echo  ( !empty($options['title_selection']) && $options['title_selection'] == 'cut_title' ? '' : 'disabled' ) ;
?>> <i><?php 
_e( 'first words of the title', 'mpt' );
?></i>
                                        </td>
                                </tr>

                                <tr valign="top" class="section_text_analyser" <?php 
echo  ( $options['based_on'] != 'text_analyser' ? 'style="display:none;"' : '' ) ;
?>>
                                        <th scope="row">
                                                <label for="hseparator"><?php 
_e( 'Text Analyser', 'mpt' );
?></label>
                                        </th>
                                        <td class="text_analyser">
                                            <p class="description"><?php 
_e( 'Perform post content analysis.', 'mpt' );
?></p>
                                        </td>
                                </tr>

                                <tr valign="top" class="selected_image">
                                        <th scope="row">
                                                <label for="hseparator"><?php 
_e( 'Selected Image ', 'mpt' );
?></label>
                                        </th>
                                        <td class="chosen_title">
                                                <label><input value="first_result" name="MPT_plugin_main_settings[selected_image] " type="radio" <?php 
echo  ( !empty($options['selected_image']) && $options['selected_image'] == 'first_result' ? 'checked' : '' ) ;
?> > <?php 
_e( 'First result', 'mpt' );
?></label><br/>
                                                <label><input value="random_result" name="MPT_plugin_main_settings[selected_image] " type="radio" <?php 
echo  ( !empty($options['selected_image']) && $options['selected_image'] == 'random_result' ? 'checked' : '' ) ;
?> > <?php 
_e( 'Random result', 'mpt' );
?></label>
                                        </td>
                                </tr>

                                <tr valign="top" class="selected_image">
                                        <th scope="row">
                                                <label for="hseparator"><?php 
_e( 'Image Filename ', 'mpt' );
?></label>
                                        </th>
                                        <td class="chosen_title">
                                                <label><input value="title"  name="MPT_plugin_main_settings[image_filename] " type="radio" <?php 
echo  ( !empty($options['image_filename']) && $options['image_filename'] == 'title' ? 'checked' : '' ) ;
?> > <?php 
_e( 'Title', 'mpt' );
?></label><br/>
                                                <label><input value="date"   name="MPT_plugin_main_settings[image_filename] " type="radio" <?php 
echo  ( !empty($options['image_filename']) && $options['image_filename'] == 'date' ? 'checked' : '' ) ;
?> > <?php 
_e( 'Date', 'mpt' );
?></label><br/>
                                                <label><input value="random" name="MPT_plugin_main_settings[image_filename] " type="radio" <?php 
echo  ( !empty($options['image_filename']) && $options['image_filename'] == 'random' ? 'checked' : '' ) ;
?> > <?php 
_e( 'Random number', 'mpt' );
?></label>
                                        </td>
                                </tr>

                                <tr valign="top">
                                        <th scope="row">
                                                <?php 
_e( 'Rewrite existing images', 'mpt' );
?>
                                        </th>
                                        <td>
                                                <label><input <?php 
echo  ( !empty($options['rewrite_featured']) && $options['rewrite_featured'] == 'true' ? 'checked' : '' ) ;
?> name="MPT_plugin_main_settings[rewrite_featured]" type="checkbox" value="true"> <?php 
_e( 'Rewrite', 'mpt' );
?></label>
                                                <p class="description">
                                                        <?php 
_e( 'Warning: This option will rewrite existing images', 'mpt' );
?>
                                                </p>
                                        </td>
                                </tr>
                                
                                <?php 
?>
                                
                        </tbody>
                </table>
            </div>

            <div id="logs">

                <?php 
// Get the log file
$current_file = new MPT_backoffice();
$current_file = $current_file->MPT_log_file( true );

if ( false !== $current_file ) {
    $log_file = plugin_dir_url( __DIR__ ) . '../logs/' . $current_file;
    $file_content = file_get_contents( $log_file );
} else {
    $file_content = __( 'No log yet', 'mpt' );
}

?>

                <table id="general-options" class="form-table">
                        <tbody>
                            <tr valign="top">
                                    <th scope="row">
                                            <?php 
_e( 'Enable Logs', 'mpt' );
?>
                                    </th>
                                    <td>
                                            <label><input <?php 
echo  ( !empty($options['logs']) && $options['logs'] == 'true' ? 'checked' : '' ) ;
?> name="MPT_plugin_main_settings[logs]" type="checkbox" value="true"> <?php 
_e( 'Logs', 'mpt' );
?></label>
                                    </td>
                            </tr>

                            <tr valign="top">
                                <th scope="row">
                                        <?php 
_e( 'Logs history', 'mpt' );
?>
                                </th>

                                <td>
                                    <pre id="logs-block"><?php 
echo  $file_content ;
?></pre>
                                    <?php 

if ( false !== $current_file ) {
    $download_file_URL = esc_url( wp_nonce_url( add_query_arg( array(
        'action' => 'downloadlog',
    ), admin_url( 'admin.php?page=magic_post_thumbnail/inc/admin/main.php#logs' ) ), 'download_log' ) );
    ?>
                                        <a href="<?php 
    echo  $download_file_URL ;
    ?>" class="button button-primary"><?php 
    _e( 'Download Log', 'mpt' );
    ?></a>
                                    <?php 
}

?>
                                </td>
                            </tr>

                        </tbody>
                </table>
            </div>

            <?php 
submit_button();
?>

	</form>
</div>
<div class="clear"></div>