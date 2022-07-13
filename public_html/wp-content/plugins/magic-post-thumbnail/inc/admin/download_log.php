<?php
if ( ! function_exists( 'add_filter' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
		exit();
}

// Verify nonce
if( ! empty( $_GET['action'] ) && ( 'downloadlog' == $_GET['action'] ) ) {
    if ( empty( $_REQUEST['_wpnonce'] ) || ! wp_verify_nonce( wp_unslash( $_REQUEST['_wpnonce'] ), 'download_log' ) ) { 
        return false;
    } else {
    }
} else {
    return false;
}

// Disable max execution time
set_time_limit(0);
 
// Start the session
session_start();



// Check the file
$dir    = __DIR__ . '/../../logs/';
$files  = @scandir( $dir );
$result = '';

if ( ! empty( $files ) ) {
    foreach ( $files as $key => $value ) {
        if ( ! in_array( $value, array( '.', '..' ), true ) ) {
            if ( ! is_dir( $value ) && strstr( $value, '.log' ) ) {
                $result = $value;
                $filename = $dir . $result;
            }
        }
    }
}


// Exit if no log file
if( empty( $result ) ) {
    return false;
}



if ( !is_file($filename) || !is_readable( $filename ) ) {
    header("HTTP/1.1 404 Not Found");
    exit;
}
$size = filesize($filename);


 
// No GZip compression
if (ini_get("zlib.output_compression")) {
    ini_set("zlib.output_compression", "Off");
}
 
// Close the session
session_write_close();
 
// Disable cache
header("Cache-Control: no-cache, must-revalidate");
header("Cache-Control: post-check=0,pre-check=0");
header("Cache-Control: max-age=0");
header("Pragma: no-cache");
header("Expires: 0");
 
// Force download with filename
header("Content-Type: application/force-download");
header('Content-Disposition: attachment; filename="'.$result.'"');
 
// File size
header("Content-Length: ".$size);
 
// Send the file
readfile($filename);

?>