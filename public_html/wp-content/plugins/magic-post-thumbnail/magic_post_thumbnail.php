<?php
/*
Plugin Name: Magic Post Thumbnail
Plugin URI: http://wordpress.org/plugins/magic-post-thumbnail/
Description: Automatically add a thumbnail for your posts. Retrieve image from the image bank like Google Image or Pixabay. Based on post title : add picture as your featured thumbnail or image post when you publish/update the post.
Version: 3.3.12
Author: Magic Post Thumbnail
Author URI: https://magic-post-thumbnail.com/
Text Domain: 'mpt'
Domain Path: /languages
Copyright 2022 Magic Post Thumbnail (contact@magic-post-thumbnail.com)
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.
This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.
You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/
class MPT_backoffice
{
    public function __construct()
    {
        
        if ( is_admin() ) {
            add_action( 'save_post', array( &$this, 'MPT_create_thumb' ) );
            add_action( 'admin_menu', array( &$this, 'MPT_menu' ) );
            // Menu tabs and "Generate" Button for Taxonomies
            register_activation_hook( __FILE__, array( &$this, 'MPT_default_values' ) );
            add_filter(
                'plugin_action_links',
                array( &$this, 'MPT_add_settings_link' ),
                10,
                2
            );
            load_plugin_textdomain( 'mpt', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
            add_action( 'admin_enqueue_scripts', array( &$this, 'MPT_admin_enqueues' ) );
            // Plugin hook for adding CSS and JS files required for this plugin
            add_action( 'add_meta_boxes', array( &$this, 'MPT_add_custom_box' ) );
            add_action( 'save_post', array( &$this, 'MPT_save_postdata' ) );
            // Ajax calls
            add_action( 'wp_ajax_nopriv_generate_image', array( &$this, 'MPT_ajax_call' ) );
            add_action( 'wp_ajax_generate_image', array( &$this, 'MPT_ajax_call' ) );
            // Download logs
            add_action( 'init', array( &$this, 'MPT_download_logs' ) );
        }
        
        if ( defined( 'DOING_CRON' ) || defined( 'FEEDWORDPRESS_BLEG' ) || defined( 'RSS_PI_VERSION' ) || defined( 'CSYN_CRON_MAGIC' ) || defined( 'WPEMATICO_VERSION' ) ) {
            add_action( 'save_post', array( &$this, 'MPT_create_thumb' ) );
        }
        /* WP All Import */
        require_once 'inc/rapid-addon.php';
        $mpt_addon = new RapidAddon( 'Magic Post Thumbnail', 'mpt' );
        $mpt_addon->add_field(
            'enable-mpt',
            'Enable Magic Post Thumbnail ?',
            'radio',
            array(
            ''  => 'No',
            '1' => 'Yes',
        )
        );
        $mpt_addon->set_import_function( array( &$this, 'MPT_launch_wpallimport' ) );
        $mpt_addon->run();
    }
    
    public function MPT_admin_enqueues()
    {
        
        if ( !empty($_REQUEST['cats']) ) {
            $taxo_term = get_term( $_REQUEST['cats'] );
            if ( empty($taxo_term) ) {
                return false;
            }
            $cpts = get_post_types( array(
                'public' => true,
            ), 'names' );
            $post_ids = get_posts( array(
                'numberposts' => -1,
                'tax_query'   => array( array(
                'taxonomy' => $taxo_term->taxonomy,
                'field'    => 'slug',
                'terms'    => $taxo_term->slug,
            ) ),
                'post_type'   => array(),
                'post_status' => array(
                'publish',
                'draft',
                'pending',
                'future',
                'private'
            ),
                'fields'      => 'ids',
            ) );
            $ids = '';
            foreach ( $post_ids as $post_id ) {
                $ids .= $post_id . ',';
            }
            $_GET['ids'] = substr_replace( $ids, '', -1 );
            $_REQUEST['ids'] = $_GET['ids'];
        }
        
        
        if ( (!empty($_POST['mpt']) || !empty($_REQUEST['ids']) || !empty($postIds)) && (empty($_REQUEST['settings-updated']) || $_REQUEST['settings-updated'] != 'true') ) {
            wp_enqueue_script( 'jquery-ui-progressbar', plugins_url( 'assets/js/jquery-ui/jquery-ui.js', __FILE__ ), array( 'jquery-ui-core' ) );
            wp_enqueue_style( 'style-jquery-ui', plugins_url( 'assets/js/jquery-ui/jquery-ui.css', __FILE__ ) );
            wp_enqueue_script( 'images-generation', plugins_url( 'assets/js/generation.js', __FILE__ ), array( 'jquery-ui-progressbar' ) );
        }
        
        wp_enqueue_script( 'jquery-ui-tabs' );
        wp_enqueue_script(
            'tabs',
            plugins_url( 'assets/js/tabs.js', __FILE__ ),
            array( 'jquery' ),
            '3.2'
        );
        wp_enqueue_style(
            'style-admin-mpt',
            plugins_url( 'assets/css/admin-style.css', __FILE__ ),
            array(),
            '3.2'
        );
        // JavaScript Variables for nonce, admin-jax.php path and translations
        $js_vars = array(
            'wp_ajax_url'  => admin_url( 'admin-ajax.php' ),
            'translations' => array(
            'successful'       => esc_html__( 'Successful generation !!', 'mpt' ),
            'error_generation' => esc_html__( 'Error with translations generation', 'mpt' ),
            'error_translate'  => esc_html__( 'Error with the plugin', 'mpt' ),
        ),
        );
        wp_localize_script( 'images-generation', 'generationJsVars', $js_vars );
    }
    
    public function MPT_bulk_action_handler()
    {
        $ids = implode( ',', array_map( 'intval', $_REQUEST['post'] ) );
        wp_redirect( 'admin.php?page=magic_post_thumbnail%2Finc%2Fadmin%2Fbulk_generation.php&ids=' . $ids );
        exit;
    }
    
    public function MPT_add_bulk_actions( $actions )
    {
        ?>
		<script type="text/javascript">
			jQuery(document).ready(function($){
				$('select[name^="action"] option:last-child').before('<option value="bulk_regenerate_thumbnails"><?php 
        echo  esc_attr( __( 'Generate featured images', 'mpt' ) ) ;
        ?></option>');
			});
		</script>
<?php 
        return $actions;
    }
    
    public function MPT_add_bulk_action_category( $actions, $tag )
    {
        $actions['atp'] = '<a href="admin.php?page=magic_post_thumbnail%2Finc%2Fadmin%2Fbulk_generation.php&amp;cats=' . $tag->term_id . '" class="aria-button-if-js">' . __( 'Generate featured images', 'mpt' ) . '</a>';
        return $actions;
    }
    
    public function MPT_order_array_urls( $str )
    {
        // Get only the url and exclude Google image url (domain gstatic)
        $pattern = '/,\\["(http[^"]((?!gstatic).)*)",\\d+?,\\d+?\\]/';
        $replacement = '$1';
        $real_url = preg_replace( $pattern, $replacement, $str );
        return array(
            'url' => $real_url,
        );
    }
    
    private function MPT_Generate(
        $service,
        $url,
        $url_parameters,
        $selected_image
    )
    {
        
        if ( $service == 'gettyimages' ) {
            $defaults = $url_parameters;
        } else {
            /* Retrieve 3 images as result */
            $url = add_query_arg( $url_parameters, $url );
            // Simulate Default Browser
            $defaults = array(
                'redirection'        => 9,
                'user-agent'         => 'Mozilla/5.0 (Linux; Android 6.0.1; Nexus 5X Build/MMB29P) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.96',
                'reject_unsafe_urls' => false,
                'sslverify'          => false,
            );
        }
        
        $options_proxy = get_option( 'MPT_plugin_proxy_settings' );
        if ( mpt_freemius()->is__premium_only() && is_array( $options_proxy ) ) {
            
            if ( 'enable' == $options_proxy['enable_proxy'] && !empty($options_proxy['proxy_adress']) && !empty($options_proxy['proxy_port']) ) {
                // Proxy settings
                define( 'WP_PROXY_HOST', $options_proxy['proxy_adress'] );
                define( 'WP_PROXY_PORT', $options_proxy['proxy_port'] );
                if ( $options_proxy['proxy_username'] ) {
                    define( 'WP_PROXY_USERNAME', $options_proxy['proxy_username'] );
                }
                if ( $options_proxy['proxy_password'] ) {
                    define( 'WP_PROXY_PASSWORD', $options_proxy['proxy_password'] );
                }
            }
        
        }
        $result = wp_remote_request( $url, $defaults );
        // If error happen
        if ( !empty($result->errors['http_request_failed']) ) {
            return false;
        }
        // Google Scraping : Different method
        
        if ( $service == 'google_scraping' ) {
            // Get all images from Google
            //preg_match_all( '/,\["http[^"]((?!gstatic).)*",\d+?,\d+?\]/', $result['body'], $output_img_urls );
            preg_match_all( '/data-ou="(http[^"]*)"/', $result['body'], $output_img_urls );
            $result_body['results'] = array_map( array( $this, 'MPT_order_array_urls' ), $output_img_urls[1] );
        } else {
            $result_body = json_decode( $result['body'], true );
            if ( $result['response']['code'] != '200' ) {
                return false;
            }
        }
        
        
        if ( $service == 'google_image' ) {
            $loop_results = $result_body['items'];
            // TODO : Check if urls are real images or just redirections
            $url_path = 'pagemap';
        } elseif ( $service == 'google_scraping' ) {
            $loop_results = $result_body['results'];
            $url_path = 'url';
        } elseif ( $service == 'flickr' ) {
            $loop_results = $result_body['photos']['photo'];
            $url_path = 'id';
        } elseif ( $service == 'pixabay' ) {
            $loop_results = $result_body['hits'];
            $url_path = 'webformatURL';
        } elseif ( $service == 'youtube' ) {
            $loop_results = $result_body['items'];
            $url_path = 'id';
        } elseif ( $service == 'shutterstock' ) {
            $loop_results = $result_body['data'];
            $url_path = 'assets';
        } elseif ( $service == 'unsplash' ) {
            $loop_results = $result_body['results'];
            $url_path = 'urls';
        } elseif ( $service == 'gettyimages' ) {
            $loop_results = $result_body['images'];
            $url_path = 'display_sizes';
        } else {
            return false;
        }
        
        // Testing images only for Google
        if ( $service == 'google_scraping' ) {
            foreach ( $loop_results as $loop_result_result => $loop_result ) {
                $remote_img = wp_remote_head( $loop_result[$url_path] );
                $remote_response = wp_remote_retrieve_response_code( $remote_img );
                
                if ( 200 !== $remote_response ) {
                    // Remove the result, image not valid
                    unset( $loop_results[$loop_result_result] );
                } else {
                    // Image ok. Avoid next results.
                    break;
                }
                
                $infos_img = getimagesize( $loop_result['url'] );
                
                if ( false === $infos_img ) {
                    // Remove the result, image not valid
                    unset( $loop_results[$loop_result_result] );
                } else {
                    // Image ok. Avoid next results.
                    break;
                }
            
            }
        }
        
        if ( !empty($loop_results) ) {
            $loop_count = 0;
            $numUrl = count( $loop_results );
            foreach ( $loop_results as $fetch_result ) {
                $url_result = $fetch_result[$url_path];
                // Change default url image
                
                if ( $service == 'google_image' ) {
                    $url_result = $url_result['cse_image'][0]['src'];
                } elseif ( $service == 'shutterstock' ) {
                    
                    if ( $fetch_result['media_type'] == 'video' ) {
                        $url_result = $url_result['preview_jpg']['url'];
                    } else {
                        $url_result = $url_result['preview']['url'];
                    }
                
                } elseif ( $service == 'unsplash' ) {
                    $url_result = $url_result['full'];
                } elseif ( $service == 'gettyimages' ) {
                    $url_result = $url_result[0]['uri'];
                } else {
                    $url_result = $fetch_result[$url_path];
                }
                
                // FLICKR : Additional remote request to get image url
                
                if ( $service == 'flickr' ) {
                    $api_key = '63d9c292b9e2dfacd3a73908779d6d6f';
                    $url = 'https://api.flickr.com/services/rest/?method=flickr.photos.getSizes&api_key=' . $api_key . '&photo_id=' . $url_result . '&format=json&nojsoncallback=1';
                    $result_img_flickr = wp_remote_request( $url );
                    $result_img_body_flickr = json_decode( $result_img_flickr['body'], true );
                    $result = end( $result_img_body_flickr['sizes']['size'] );
                    $url_result = $result['source'];
                }
                
                // YOUTUBE : Additional remote request to get thumbnail
                
                if ( $service == 'youtube' ) {
                    $api_key = $url_parameters['key'];
                    $url = 'https://www.googleapis.com/youtube/v3/videos?key=' . $api_key . '&part=snippet&id=' . $fetch_result['id']['videoId'];
                    $result_img_yt = wp_remote_request( $url );
                    $result_img_body_yt = json_decode( $result_img_yt['body'], true );
                    $hdimg = end( $result_img_body_yt['items'][0]['snippet']['thumbnails'] );
                    $url_result = $hdimg['url'];
                }
                
                if ( empty($url_result) ) {
                    continue;
                }
                $file_media = @wp_remote_request( $url_result );
                
                if ( isset( $file_media->errors ) || $file_media['response']['code'] != 200 || strpos( $file_media['headers']['content-type'], 'text/html' ) !== false ) {
                    
                    if ( ++$loop_count === $numUrl ) {
                        return false;
                    } else {
                        continue;
                    }
                
                } else {
                    break;
                }
            
            }
        } else {
            return false;
        }
        
        return array( $url_result, $file_media );
    }
    
    private function MPT_Get_Parameters( $options, $search )
    {
        /* GOOGLE IMAGE SCRAPING PARAMETERS */
        
        if ( $options['api_chosen'] == 'google_scraping' ) {
            $country = ( !empty($options['google_scraping']['search_country']) ? $options['google_scraping']['search_country'] : 'en' );
            $img_color = ( !empty($options['google_scraping']['img_color']) ? $options['google_scraping']['img_color'] : '' );
            $imgsz = ( !empty($options['google_scraping']['imgsz']) ? $options['google_scraping']['imgsz'] : '' );
            $format = ( !empty($options['google_scraping']['format']) ? $options['google_scraping']['format'] : '' );
            $imgtype = ( !empty($options['google_scraping']['imgtype']) ? $options['google_scraping']['imgtype'] : '' );
            $rights = ( !empty($options['google_scraping']['rights']) ? $options['google_scraping']['rights'] : '' );
            $safe = ( !empty($options['google_scraping']['safe']) ? $options['google_scraping']['safe'] : 'medium' );
            // Old API option. Replace value for safe
            if ( $safe == 'moderate' ) {
                $safe = 'medium';
            }
            // Remove very special characters
            $search = str_replace( '…', '', $search );
            $array_parameters = array(
                'url'  => 'https://www.google.com/search',
                'tbm'  => 'isch',
                'q'    => urlencode( $search ),
                'hl'   => $country,
                'safe' => $safe,
                'rsz'  => '3',
                'tbs'  => '',
            );
            if ( !empty($rights) ) {
                $array_parameters['tbs'] .= 'sur:' . $rights . ',';
            }
            if ( !empty($imgtype) ) {
                $array_parameters['tbs'] .= 'itp:' . $imgtype . ',';
            }
            if ( !empty($imgsz) ) {
                $array_parameters['tbs'] .= 'isz:' . $imgsz . ',';
            }
            if ( !empty($format) ) {
                $array_parameters['tbs'] .= 'iar:' . $format . ',';
            }
            if ( !empty($img_color) ) {
                $array_parameters['tbs'] .= 'ic:specific,isc:' . $img_color;
            }
        } elseif ( $options['api_chosen'] == 'google_image' ) {
            if ( empty($options['googleimage']['cxid']) || empty($options['googleimage']['apikey']) ) {
                return false;
            }
            $country = ( !empty($options['googleimage']['search_country']) ? $options['googleimage']['search_country'] : 'en' );
            $img_color = ( !empty($options['googleimage']['img_color']) ? $options['googleimage']['img_color'] : '' );
            $filetype = ( !empty($options['googleimage']['filetype']) ? $options['googleimage']['filetype'] : '' );
            $imgsz = ( !empty($options['googleimage']['imgsz']) ? $options['googleimage']['imgsz'] : 'large' );
            $imgtype = ( !empty($options['googleimage']['imgtype']) ? $options['googleimage']['imgtype'] : '' );
            $safe = ( !empty($options['googleimage']['safe']) ? $options['googleimage']['safe'] : 'medium' );
            // Old API option. Replace value for safe
            if ( $safe == 'moderate' ) {
                $safe = 'medium';
            }
            
            if ( isset( $options['googleimage']['rights'] ) && !empty($options['googleimage']['rights']) ) {
                $rights = '(';
                $last_right = array_keys( $options['googleimage']['rights'] );
                $last_right = end( $last_right );
                foreach ( $options['googleimage']['rights'] as $rights_into_searching ) {
                    $rights .= $rights_into_searching;
                    if ( $rights_into_searching != $last_right ) {
                        $rights .= '|';
                    }
                }
                $rights .= ')';
            } else {
                $rights = '';
            }
            
            $array_parameters = array(
                'url'      => 'https://www.googleapis.com/customsearch/v1',
                'imgSize'  => $imgsz,
                'rights'   => $rights,
                'imgtype'  => $imgtype,
                'hl'       => $country,
                'filetype' => $filetype,
                'safe'     => $safe,
                'rsz'      => '3',
                'q'        => urlencode( $search ),
                'userip'   => $_SERVER['SERVER_ADDR'],
                'cx'       => trim( $options['googleimage']['cxid'] ),
                'key'      => trim( $options['googleimage']['apikey'] ),
            );
            if ( !empty($img_color) ) {
                $array_parameters['imgDominantColor'] = $img_color;
            }
        } elseif ( $options['api_chosen'] == 'flickr' ) {
            $api_key = '63d9c292b9e2dfacd3a73908779d6d6f';
            $imgtype = ( !empty($options['flickr']['imgtype']) ? $options['flickr']['imgtype'] : '7' );
            
            if ( isset( $options['flickr']['rights'] ) && !empty($options['flickr']['rights']) ) {
                $rights = '';
                $last_right = array_keys( $options['flickr']['rights'] );
                $last_right = end( $last_right );
                foreach ( $options['flickr']['rights'] as $rights_into_searching ) {
                    $rights .= $rights_into_searching;
                    if ( $rights_into_searching != $last_right ) {
                        $rights .= ',';
                    }
                }
            } else {
                $rights = '0,1,2,3,4,5,6,7,8';
            }
            
            $array_parameters = array(
                'url'            => 'https://api.flickr.com/services/rest/',
                'method'         => 'flickr.photos.search',
                'api_key'        => $api_key,
                'text'           => urlencode( $search ),
                'per_page'       => '3',
                'format'         => 'json',
                'nojsoncallback' => '1',
                'privacy_filter' => '1',
                'license'        => $rights,
                'sort'           => 'relevance',
                'content_type'   => $imgtype,
            );
        } elseif ( $options['api_chosen'] == 'pixabay' ) {
            $pixabay_username = ( !empty($options['pixabay']['username']) ? $options['pixabay']['username'] : '' );
            $api_key = ( !empty($options['pixabay']['apikey']) ? $options['pixabay']['apikey'] : '' );
            $imgtype = ( !empty($options['pixabay']['imgtype']) ? $options['pixabay']['imgtype'] : 'all' );
            $country = ( !empty($options['pixabay']['search_country']) ? $options['pixabay']['search_country'] : 'en' );
            $orientation = ( !empty($options['pixabay']['orientation']) ? $options['pixabay']['orientation'] : 'all' );
            $safe = ( !empty($options['pixabay']['safesearch']) ? $options['pixabay']['safesearch'] : 'false' );
            $min_width = ( !empty($options['pixabay']['min_width']) ? (int) $options['pixabay']['min_width'] : '0' );
            $min_height = ( !empty($options['pixabay']['min_height']) ? (int) $options['pixabay']['min_height'] : '0' );
            $array_parameters = array(
                'url'         => 'https://pixabay.com/api/',
                'username'    => $pixabay_username,
                'key'         => $api_key,
                'lang'        => $country,
                'q'           => urlencode( $search ),
                'image_type'  => $imgtype,
                'per_page'    => '3',
                'orientation' => $orientation,
                'safesearch'  => $safe,
                'min_width'   => $min_width,
                'min_height'  => $min_height,
            );
        } elseif ( $options['api_chosen'] == 'youtube' ) {
        } elseif ( $options['api_chosen'] == 'shutterstock' ) {
        } elseif ( $options['api_chosen'] == 'unsplash' ) {
        } elseif ( $options['api_chosen'] == 'gettyimages' ) {
        } else {
            return false;
        }
        
        return $array_parameters;
    }
    
    /* Retrieve Image from Database, save it into Media Library, and attach it to the post as featured image */
    public function MPT_create_thumb(
        $id,
        $check_value_enable = 1,
        $check_post_type = 1,
        $check_category = 1,
        $rewrite_featured = 0
    )
    {
        // Launch logs
        $log = $this->MPT_monolog_call();
        $log->info( 'New generation starting', array(
            'post' => $id,
        ) );
        //$log->error( '$check_value_enable='.$check_value_enable, array( 'post' => $id ) );
        // Settings
        $main_settings = get_option( 'MPT_plugin_main_settings' );
        // Image location
        $image_location = ( !empty($main_settings['image_location']) ? $main_settings['image_location'] : 'featured' );
        // Check if thumbnail already exists
        
        if ( has_post_thumbnail( $id ) && $rewrite_featured == false && "featured" === $image_location ) {
            $log->error( 'Featured image already exists', array(
                'post' => $id,
            ) );
            return false;
        }
        
        
        if ( defined( 'DOING_CRON' ) || defined( 'FEEDWORDPRESS_BLEG' ) || defined( 'RSS_PI_VERSION' ) || defined( 'CSYN_SYNDICATED_FEEDS' ) || defined( 'WPEMATICO_VERSION' ) ) {
            $log->info( 'Generation launched by cron or automatic plugin', array(
                'post' => $id,
            ) );
            $check_value_enable = 0;
        }
        
        require_once dirname( __FILE__ ) . '/inc/default_values.php';
        /* Action 'save_post' triggered when deleting posts. Check if post not trashed */
        
        if ( 'trash' == get_post_status( $id ) ) {
            $log->error( 'Post is in the trash', array(
                'post' => $id,
            ) );
            return false;
        }
        
        header( 'Content-type:text/html; charset=utf-8' );
        
        if ( !current_user_can( 'upload_files' ) && !defined( 'DOING_CRON' ) && !class_exists( 'Main_WPeMatico' ) && !class_exists( 'FeedWordPress' ) && !class_exists( 'rssPostImporter' ) && !class_exists( 'CyberSyn_Syndicator' ) ) {
            $log->error( 'The user does not have sufficient rights', array(
                'post' => $id,
            ) );
            return false;
        }
        
        if ( !function_exists( 'wp_get_current_user' ) ) {
            include_once ABSPATH . 'wp-includes/pluggable.php';
        }
        // Choosed Post types
        $post_type_availables = ( !empty($main_settings['choosed_post_type']) ? $main_settings['choosed_post_type'] : '' );
        // Choosed Categories
        $categories_availables = ( !empty($main_settings['choosed_categories']) ? $main_settings['choosed_categories'] : '' );
        /*
        		if( $check_value_enable == '1' && get_post_meta( $id, '_mpt_value_key', true ) != '1' ) {
        			$log->error( 'Post box not check', array( 'post' => $id ) );
        			return false;
        		}*/
        if ( !empty($post_type_availables) && $check_post_type ) {
            
            if ( !in_array( get_post_type( $id ), $post_type_availables ) ) {
                $log->error( 'The post is not in selected post types', array(
                    'post' => $id,
                ) );
                return false;
            }
        
        }
        // Check if category match and is a post
        if ( !empty($categories_availables) && $check_category && 'post' == get_post_type( $id ) ) {
            
            if ( !in_category( $categories_availables, $id ) ) {
                $log->error( 'The post is not in selected categories', array(
                    'post' => $id,
                ) );
                return false;
            }
        
        }
        $options = wp_parse_args( get_option( 'MPT_plugin_main_settings' ), default_options_main_settings( TRUE ) );
        $options_banks = wp_parse_args( get_option( 'MPT_plugin_banks_settings' ), default_options_banks_settings( TRUE ) );
        $options_cron = wp_parse_args( get_option( 'MPT_plugin_cron_settings' ), default_options_cron_settings( TRUE ) );
        $options = array_merge( $options, $options_banks, $options_cron );
        
        if ( $options['based_on'] == 'text_analyser' ) {
            require_once dirname( __FILE__ ) . '/inc/text_analyser.php';
        } else {
            $search = get_post_field( 'post_title', $id, 'raw' );
        }
        
        
        if ( isset( $options['title_selection'] ) && $options['title_selection'] == 'cut_title' && isset( $options['title_length'] ) ) {
            $length_title = (int) $options['title_length'] - 1;
            $search = preg_replace( '/((\\w+\\W*){' . $length_title . '}(\\w+))(.*)/', '${1}', $search );
        }
        
        /* SET ALL PARAMETERS */
        $array_parameters = $this->MPT_Get_Parameters( $options, $search );
        $api_url = $array_parameters['url'];
        unset( $array_parameters['url'] );
        
        if ( !isset( $api_url ) ) {
            $log->error( 'API URL not provided', array(
                'post' => $id,
            ) );
            return false;
        }
        
        /* GET THE IMAGE URL */
        list( $url_results, $file_media ) = $this->MPT_Generate(
            $options['api_chosen'],
            $api_url,
            $array_parameters,
            $options['selected_image']
        );
        
        if ( !isset( $url_results ) || !isset( $file_media ) ) {
            $log->error( 'No results', array(
                'post' => $id,
            ) );
            return false;
        }
        
        $path_parts = pathinfo( $url_results );
        $filename = $path_parts['basename'];
        $wp_upload_dir = wp_upload_dir();
        /* Get the good file extension */
        $filetype = array(
            'image/png',
            'image/jpeg',
            'image/gif',
            'image/bmp',
            'image/vnd.microsoft.icon',
            'image/tiff',
            'image/svg+xml',
            'image/svg+xml'
        );
        $extensions = array(
            'png',
            'jpg',
            'gif',
            'bmp',
            'ico',
            'tif',
            'svg',
            'svgz'
        );
        
        if ( isset( $file_media['headers']['content-type'] ) ) {
            $imgextension = str_replace(
                $filetype,
                $extensions,
                $file_media['headers']['content-type'],
                $count_extension
            );
            /* Default type if not found : jpg */
            if ( (int) $count_extension == 0 ) {
                $imgextension = 'jpg';
            }
        } else {
            $imgextension = $path_parts['extension'];
        }
        
        /* Image filename : title.extension */
        $search = str_replace( '%', '', sanitize_title( $search ) );
        // Remove % for non-latin characters
        
        if ( $options['image_filename'] == 'date' ) {
            $current_time = current_time( 'Y-m-d' );
            $filename = wp_unique_filename( $wp_upload_dir['path'], $current_time . '.' . $imgextension );
        } elseif ( $options['image_filename'] == 'random' ) {
            $filename_rand = wp_rand( 1, 999999 );
            $filename = wp_unique_filename( $wp_upload_dir['path'], $filename_rand . '.' . $imgextension );
        } else {
            $filename = wp_unique_filename( $wp_upload_dir['path'], $search . '.' . $imgextension );
        }
        
        $folder = $wp_upload_dir['path'] . '/' . $filename;
        
        if ( $file_media['response']['code'] != '200' || empty($file_media['body']) ) {
            $log->error( 'Problem with scrapping', array(
                'post' => $id,
            ) );
            return false;
        }
        
        
        if ( $file_media['body'] ) {
            /* Upload the file to wordpress directory */
            $file_upload = file_put_contents( $folder, $file_media['body'] );
            
            if ( $file_upload ) {
                $wp_filetype = wp_check_filetype( basename( $filename ), null );
                $wp_upload_dir = wp_upload_dir();
                $attachment = array(
                    'guid'           => $wp_upload_dir['url'] . '/' . urlencode( $filename ),
                    'post_mime_type' => $wp_filetype['type'],
                    'post_title'     => $search,
                    'post_content'   => '',
                    'post_status'    => 'inherit',
                );
                $attach_id = wp_insert_attachment( $attachment, $wp_upload_dir['path'] . '/' . urlencode( $filename ) );
                /* Fire filter "wp_handle_upload" for plugins like optimizers etc. */
                $img_values = array(
                    'file' => $wp_upload_dir['path'] . '/' . urlencode( $filename ),
                    'url'  => $wp_upload_dir['url'] . '/' . urlencode( $filename ),
                    'type' => $wp_filetype['type'],
                );
                apply_filters( 'wp_handle_upload', $img_values );
                require_once ABSPATH . 'wp-admin/includes/image.php';
                $attach_data = wp_generate_attachment_metadata( $attach_id, $wp_upload_dir['path'] . '/' . urlencode( $filename ) );
                $var = wp_update_attachment_metadata( $attach_id, $attach_data );
                $log->info( 'Featured image added', array(
                    'post'  => $id,
                    'image' => $attach_id,
                ) );
                set_post_thumbnail( $id, $attach_id );
                // Link the media to the post
                $media_link_uploaded_to = wp_update_post( array(
                    'ID'          => $attach_id,
                    'post_parent' => $id,
                ), true );
                do_action( 'mpt_after_create_thumb', $id, $attach_id );
                return $attach_id;
            }
        
        }
    
    }
    
    function MPT_menu()
    {
        //add_options_page( 'Magic Post Thumbnail Options', 'Magic Post Thumbnail', 'manage_options', 'mpt', array( &$this, 'MPT_options' ) );
        add_menu_page(
            __( 'Magic Post Thumbnail Options', 'mpt' ),
            'Magic Post Thumbnail',
            'manage_options',
            'magic_post_thumbnail/inc/admin/main.php',
            array( &$this, 'MPT_options' ),
            'dashicons-images-alt2',
            81
        );
        add_submenu_page(
            'magic_post_thumbnail/inc/admin/main.php',
            __( 'Settings', 'mpt' ),
            __( 'Settings', 'mpt' ),
            'manage_options',
            'magic_post_thumbnail/inc/admin/main.php',
            array( &$this, 'MPT_options' )
        );
        add_submenu_page(
            'magic_post_thumbnail/inc/admin/main.php',
            __( 'Banks', 'mpt' ),
            __( 'Banks', 'mpt' ),
            'manage_options',
            'magic_post_thumbnail/inc/admin/banks.php',
            array( &$this, 'MPT_banks' )
        );
        add_submenu_page(
            'magic_post_thumbnail/inc/admin/main.php',
            __( 'Cron', 'mpt' ),
            __( 'Cron', 'mpt' ),
            'manage_options',
            'magic_post_thumbnail/inc/admin/cron.php',
            array( &$this, 'MPT_cron' )
        );
        add_submenu_page(
            'magic_post_thumbnail/inc/admin/main.php',
            __( 'Proxy', 'mpt' ),
            __( 'Proxy', 'mpt' ),
            'manage_options',
            'magic_post_thumbnail/inc/admin/proxy.php',
            array( &$this, 'MPT_proxy' )
        );
        add_submenu_page(
            'magic_post_thumbnail/inc/admin/main.php',
            __( 'Affiliation', 'mpt' ),
            __( 'Affiliation', 'mpt' ),
            'manage_options',
            'admin.php?page=magic_post_thumbnail2Finc2Fadmin2Fmain.php-affiliation'
        );
        // Do not show the bulk generation page into menu
        add_submenu_page(
            null,
            __( 'Bulk Generation', 'mpt' ),
            __( 'Bulk Generation', 'mpt' ),
            'manage_options',
            'magic_post_thumbnail/inc/admin/bulk_generation.php',
            array( &$this, 'MPT_bulk' )
        );
        add_action( 'admin_head', array( &$this, 'MPT_admin_register_head' ) );
        require_once dirname( __FILE__ ) . '/inc/default_values.php';
        register_setting( 'MPT-plugin-main-settings', 'MPT_plugin_main_settings' );
        register_setting( 'MPT-plugin-banks-settings', 'MPT_plugin_banks_settings' );
        register_setting( 'MPT-plugin-cron-settings', 'MPT_plugin_cron_settings' );
        register_setting( 'MPT-plugin-proxy-settings', 'MPT_plugin_proxy_settings' );
        /* Bulk Generation link for posts & custom post type */
        $post_type_availables = get_option( 'MPT_plugin_main_settings' );
        
        if ( empty($post_type_availables['choosed_post_type']) ) {
            return false;
        } else {
            foreach ( $post_type_availables['choosed_post_type'] as $screen ) {
                add_filter( 'bulk_actions-edit-' . $screen, array( &$this, 'MPT_add_bulk_actions' ) );
                // Text on dropdown
                add_action( 'handle_bulk_actions-edit-' . $screen, array( &$this, 'MPT_bulk_action_handler' ) );
                // Redirection
            }
        }
        
        // Genererate link for Categories
        add_filter(
            'category_row_actions',
            array( &$this, 'MPT_add_bulk_action_category' ),
            10,
            2
        );
        // Loop with each taxo for Genrate link
        $args_taxo = array(
            'public' => true,
        );
        $taxonomies = get_taxonomies( $args_taxo );
        $taxonomies = array_diff( $taxonomies, [ 'post_tag', 'post_format' ] );
        foreach ( $taxonomies as $taxonomy ) {
            add_filter(
                $taxonomy . '_row_actions',
                array( &$this, 'MPT_add_bulk_action_category' ),
                10,
                2
            );
        }
    }
    
    function MPT_admin_register_head()
    {
        
        if ( !empty($_POST['mpt']) || !empty($_REQUEST['ids']) ) {
            $ids = esc_attr( $_GET['ids'] );
            $ids = array_map( 'intval', explode( ',', trim( $ids, ',' ) ) );
            $count = count( $ids );
            $ids = json_encode( $ids );
            $ajax_nonce = wp_create_nonce( 'ajax_nonce_magic_post_thumbnail' );
            ?>
			<script type="text/javascript">
				sendposts( <?php 
            echo  $ids ;
            ?>, 1, <?php 
            echo  $count ;
            ?>, "<?php 
            echo  $ajax_nonce ;
            ?>" );
			</script>	
<?php 
        }
    
    }
    
    /* Display MPT Options */
    public function MPT_options()
    {
        if ( !current_user_can( 'manage_options' ) ) {
            wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
        }
        require_once dirname( __FILE__ ) . '/inc/admin/main.php';
    }
    
    public function MPT_banks()
    {
        if ( !current_user_can( 'manage_options' ) ) {
            wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
        }
        require_once dirname( __FILE__ ) . '/inc/admin/banks.php';
    }
    
    public function MPT_cron()
    {
        if ( !current_user_can( 'manage_options' ) ) {
            wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
        }
        require_once dirname( __FILE__ ) . '/inc/admin/cron.php';
    }
    
    public function MPT_proxy()
    {
        if ( !current_user_can( 'manage_options' ) ) {
            wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
        }
        require_once dirname( __FILE__ ) . '/inc/admin/proxy.php';
    }
    
    public function MPT_bulk()
    {
        if ( !current_user_can( 'manage_options' ) ) {
            wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
        }
        require_once dirname( __FILE__ ) . '/inc/admin/bulk_generation.php';
    }
    
    /* Set Default value when activated and never configured */
    public function MPT_default_values()
    {
        $main_options = get_option( 'MPT_plugin_main_settings' );
        $banks_options = get_option( 'MPT_plugin_banks_settings' );
        $cron_options = get_option( 'MPT_plugin_cron_settings' );
        $proxy_options = get_option( 'MPT_plugin_proxy_settings' );
        /* Options Never set */
        
        if ( !$main_options && !$banks_options && !$cron_options && !$proxy_options ) {
            require_once dirname( __FILE__ ) . '/inc/default_values.php';
            $options_main_default = default_options_main_settings( TRUE );
            $options_banks_default = default_options_banks_settings( TRUE );
            $options_cron_default = default_options_cron_settings( TRUE );
            update_option( 'MPT_plugin_main_settings', $options_main_default );
            update_option( 'MPT_plugin_banks_settings', $options_banks_default );
            update_option( 'MPT_plugin_cron_settings', $options_cron_default );
            update_option( 'MPT_plugin_proxy_settings', $options_proxy_default );
        }
    
    }
    
    /* Add Settings link to plugins */
    public function MPT_add_settings_link( $links, $file )
    {
        static  $this_plugin ;
        if ( !$this_plugin ) {
            $this_plugin = plugin_basename( __FILE__ );
        }
        
        if ( $file == $this_plugin ) {
            $settings_link = '<a href="admin.php?page=magic_post_thumbnail%2Finc%2Fadmin%2Fmain.php">' . __( "Settings", "mpt" ) . '</a>';
            array_unshift( $links, $settings_link );
            $upgrade_link = '<a href="https://magic-post-thumbnail.com/pricing/" class="upgrade-pro" target="_blank">' . __( "Upgrade to Pro", "mpt" ) . '</a>';
            array_unshift( $links, $upgrade_link );
        }
        
        return $links;
    }
    
    /* Box on posts edit screens */
    public function MPT_add_custom_box()
    {
        $id = get_the_ID();
        $post_type_availables = get_option( 'MPT_plugin_main_settings' );
        $screens = ( !empty($post_type_availables['choosed_post_type']) ? $post_type_availables['choosed_post_type'] : '' );
        if ( empty($screens) ) {
            return false;
        }
        foreach ( $screens as $screen ) {
            add_meta_box(
                'myplugin_sectionid',
                'Magic Post Thumbnail',
                array( &$this, 'MPT_inner_custom_box' ),
                $screen,
                'side'
            );
        }
    }
    
    /* Box MPT choice for posts */
    function MPT_inner_custom_box( $post )
    {
        wp_nonce_field( plugin_basename( __FILE__ ), 'mpt_noncename' );
        $value = get_post_meta( $post->ID, '_mpt_value_key', true );
        $value = ( $value != '0' ? 'checked="checked"' : '' );
        echo  '<label class="selectmpt"><input value="1" type="checkbox" name="mpt_check" ' . esc_attr( $value ) . '></label> ' ;
        _e( 'Plugin enabled for this post', 'mpt' );
    }
    
    /* Save enable/disable choice for a saved post */
    public function MPT_save_postdata( $post_id )
    {
        
        if ( 'page' == get_post_type( $post_id ) ) {
            if ( !current_user_can( 'edit_page', $post_id ) ) {
                return;
            }
        } else {
            if ( !current_user_can( 'edit_post', $post_id ) ) {
                return;
            }
        }
        
        if ( !isset( $_POST['mpt_noncename'] ) || !wp_verify_nonce( $_POST['mpt_noncename'], plugin_basename( __FILE__ ) ) ) {
            return;
        }
        $post_ID = $_POST['post_ID'];
        
        if ( !isset( $_POST['mpt_check'] ) || sanitize_text_field( $_POST['mpt_check'] ) != 1 ) {
            $mpt_enabled = 0;
        } else {
            $mpt_enabled = 1;
        }
        
        update_post_meta( $post_ID, '_mpt_value_key', $mpt_enabled );
    }
    
    /* WP All Import call */
    public function MPT_launch_wpallimport( $post_id, $data, $import_options )
    {
        global  $ar_wpallimport ;
        if ( $data['enable-mpt'] == 1 ) {
            // Launch the plugin on import if the option is selected
            add_action(
                'pmxi_saved_post',
                array( &$this, 'MPT_fired_wpallimport' ),
                10,
                3
            );
        }
    }
    
    /* WP All Import saved post fired */
    public function MPT_fired_wpallimport( $post_id, $xml_node, $is_update )
    {
        global  $ar_wpallimport ;
        // Check if post image not already generated
        
        if ( !in_array( $post_id, $ar_wpallimport ) ) {
            $ar_wpallimport[] = $post_id;
            $launch_MPT = new MPT_backoffice();
            $launch_MPT->MPT_create_thumb(
                $post_id,
                '0',
                '0',
                '0'
            );
            $log = $this->MPT_monolog_call();
            $log->info( 'Import for WP All Import', array(
                'post' => $post_id,
            ) );
        }
    
    }
    
    public function MPT_ajax_call()
    {
        // Security checks & Check if user is admin
        if ( !current_user_can( 'administrator' ) || !defined( 'DOING_AJAX' ) || false === wp_verify_nonce( $_POST['nonce'], 'ajax_nonce_magic_post_thumbnail' ) ) {
            wp_send_json_error();
        }
        if ( !isset( $_POST['ids'] ) ) {
            return false;
        }
        $post_ids = array_map( 'absint', $_POST['ids'] );
        $count = count( $post_ids );
        foreach ( $post_ids as $key => $val ) {
            $ids[$key + 1] = $val;
        }
        $a = (int) $_POST['a'];
        $id = $ids[$a];
        $launch_MPT = new MPT_backoffice();
        $main_settings = get_option( 'MPT_plugin_main_settings' );
        
        if ( isset( $main_settings['rewrite_featured'] ) && $main_settings['rewrite_featured'] == true ) {
            $rewrite_featured = true;
        } else {
            $rewrite_featured = false;
        }
        
        $speed = '500';
        // Image location
        $image_location = ( !empty($main_settings['image_location']) ? $main_settings['image_location'] : 'featured' );
        
        if ( mpt_freemius()->is__premium_only() && "featured" !== $image_location ) {
            // Check if image generation into content is already done
            $content_post = get_post( $id );
            $image_generated = ( strpos( $content_post->post_content, 'mpt-img' ) ? true : false );
            
            if ( $image_generated && false == $rewrite_featured ) {
                $status = 'already-done';
            } elseif ( $image_generated && true == $rewrite_featured ) {
                $status = 'no-rewrite';
            } elseif ( (false == $image_generated || $rewrite_featured == true) && $id != 0 ) {
                $MPT_return = $launch_MPT->MPT_create_thumb(
                    $id,
                    '0',
                    '0',
                    '0',
                    $rewrite_featured
                );
                
                if ( $MPT_return == null ) {
                    $status = 'failed';
                } else {
                    $status = 'successful';
                    $speed = '500';
                }
            
            } else {
                $status = 'error';
            }
        
        } else {
            
            if ( has_post_thumbnail( $id ) && $rewrite_featured == false ) {
                $status = 'already-done';
            } elseif ( (!has_post_thumbnail( $id ) || $rewrite_featured == true) && $id != 0 ) {
                $MPT_return = $launch_MPT->MPT_create_thumb(
                    $id,
                    '0',
                    '0',
                    '0',
                    $rewrite_featured
                );
                
                if ( $MPT_return == null ) {
                    $status = 'failed';
                } else {
                    $status = 'successful';
                    $speed = '500';
                }
            
            } else {
                $status = 'error';
            }
        
        }
        
        $percent = 100 * $a / $count;
        
        if ( ($status == 'already-done' || $status == 'successful') && !empty($MPT_return) ) {
            $new_image = wp_get_attachment_image_src( $MPT_return, array( 70, 70 ) );
            $fimg = '<a class="generated-img" target="_blank" href="' . admin_url() . 'upload.php?item=' . $MPT_return . '"><img src="' . $new_image[0] . '" width="70" height="70" /></a>';
        } elseif ( $status == 'already-done' && "featured" === $image_location ) {
            $fimg = '<a class="generated-img" target="_blank" href="' . admin_url() . 'upload.php?item=' . get_post_thumbnail_id( $id ) . '">' . get_the_post_thumbnail( $id, array( '70', '70' ) ) . '</a>';
        } else {
            $fimg = '<img src="' . plugins_url( 'assets/img/no-image.jpg', __FILE__ ) . '" />';
        }
        
        $datas['percent'] = $percent;
        $datas['id'] = $id;
        $datas['status'] = $status;
        $datas['fimg'] = $fimg;
        $datas['speed'] = $speed;
        // Send data to JavaScript
        
        if ( !empty($datas['id']) && !empty($datas['percent']) ) {
            wp_send_json_success( $datas );
        } else {
            wp_send_json_error();
        }
    
    }
    
    private function MPT_monolog_call()
    {
        $main_settings = get_option( 'MPT_plugin_main_settings' );
        // Check if logs enabled
        
        if ( !empty($main_settings['logs']) && true == $main_settings['logs'] ) {
            require_once dirname( __FILE__ ) . '/inc/monolog/vendor/autoload.php';
            $log = new Monolog\Logger( 'mpt_logger' );
            $logfile = $this->MPT_log_file();
            // Now add some handlers
            $log->pushHandler( new Monolog\Handler\StreamHandler( __DIR__ . '/logs/' . $logfile, Monolog\Logger::DEBUG ) );
            $log->pushHandler( new Monolog\Handler\FirePHPHandler() );
        } else {
            require_once dirname( __FILE__ ) . '/inc/monolog/nologs.php';
            $log = new Nolog();
        }
        
        return $log;
    }
    
    private function MPT_log_file( $check = false )
    {
        $filename = __DIR__ . '/logs/';
        $files = @scandir( $filename );
        $result = '';
        if ( !empty($files) ) {
            foreach ( $files as $key => $value ) {
                if ( !in_array( $value, array( '.', '..' ), true ) ) {
                    if ( !is_dir( $value ) && strstr( $value, '.log' ) ) {
                        $result = $value;
                    }
                }
            }
        }
        if ( true == $check && empty($result) ) {
            return false;
        }
        if ( empty($result) ) {
            $result = 'mpt-' . wp_generate_password( 14, false, false ) . '.log';
        }
        return $result;
    }
    
    public function MPT_download_logs()
    {
        require_once dirname( __FILE__ ) . '/inc/admin/download_log.php';
    }
    
    public function MPT_FIFU_compatibility( $id )
    {
    }

}
/* Launch MPT only for WP backoffice */
if ( is_admin() || defined( 'DOING_CRON' ) || defined( 'FEEDWORDPRESS_BLEG' ) || defined( 'RSS_PI_VERSION' ) || defined( 'CSYN_SYNDICATED_FEEDS' ) || defined( 'WPEMATICO_VERSION' ) ) {
    $launch_MPT = new MPT_backoffice();
}
// Freemius
function mpt_freemius()
{
    global  $mpt_freemius ;
    
    if ( !isset( $mpt_freemius ) ) {
        // Include Freemius SDK.
        require_once dirname( __FILE__ ) . '/freemius/start.php';
        $mpt_freemius = fs_dynamic_init( array(
            'id'              => '2891',
            'slug'            => 'magic-post-thumbnail',
            'type'            => 'plugin',
            'public_key'      => 'pk_0842b408e487a0001e564a31d3a37',
            'is_premium'      => false,
            'premium_suffix'  => 'Pro',
            'has_addons'      => false,
            'has_paid_plans'  => true,
            'has_affiliation' => 'selected',
            'menu'            => array(
            'slug'       => 'magic_post_thumbnail2Finc2Fadmin2Fmain.php',
            'first-path' => 'admin.php?page=magic_post_thumbnail/inc/admin/main.php',
        ),
            'is_live'         => true,
        ) );
    }
    
    return $mpt_freemius;
}

// Init Freemius.
mpt_freemius();
// Signal that SDK was initiated.
do_action( 'mpt_freemius_loaded' );