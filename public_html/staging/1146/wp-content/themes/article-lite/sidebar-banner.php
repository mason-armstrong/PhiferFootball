<?php

/**
 * Sidebar for the banner area 
 * @package Article Lite
 *  
 */


if ( ! is_active_sidebar( 'banner' ) ) {
	return;
}
?>

<aside id="banner-wrapper">
    <div id="banner">
    	<div class="widget text_widget">
			<div class="textwidget">
				<?php dynamic_sidebar( 'banner' ); ?>
			</div>
		</div>
	</div>
</aside>