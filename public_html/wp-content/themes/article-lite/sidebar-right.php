<?php
/**
 * Right sidebar column. 
 *
 * @package article lite
 */


if (   ! is_active_sidebar( 'blogright'  )
	&& ! is_active_sidebar( 'pageright' ) 
	)
	return;

if ( is_page() ) {   
	
	echo '<div id="right-wrapper"><div class="theiaStickySidebar"><aside id="sidebar-right" class="widget-area" itemscope="" itemtype="http://schema.org/WPSideBar">';
	dynamic_sidebar( 'pageright' );	
	echo '</aside></div></div>';	

} else {

	echo '<div class="col-lg-4 col-md-4 col-sm-12 sidebar_stickey_wrap"><div id="right-wrapper" class="theiaStickySidebar"><aside id="sidebar-right" class="widget-area" itemscope="" itemtype="http://schema.org/WPSideBar">';  
	dynamic_sidebar( 'blogright' );
	echo '</aside></div></div>';
		
}
?>