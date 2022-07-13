<?php
if ( ! function_exists( 'add_filter' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
		exit();
}

require_once( dirname( ( __FILE__ ) ) . '/text-miner/TextMiner.php' );

$content = get_the_content( '', false, $id );

$tm = new TextMiner();
$tm->addText( $content );

$tm->convertToLower = TRUE; // optional
//$tm->includeLowerNGrams = TRUE;

$tm->process();//should be called before accessing keywords

$search = $tm->getTopNGrams(1, false);
?>