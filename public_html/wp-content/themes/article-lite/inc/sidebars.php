<?php 

/**
 * Register theme sidebars
 * @package article 
 */

 
function article_lite_widgets_init() {

	register_sidebar( array(
		'name' => esc_html__( 'Blog Right Sidebar', 'article-lite' ),
		'id' => 'blogright',
		'description' => esc_html__( 'Right sidebar for the blog', 'article-lite' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );	
	register_sidebar( array(
		'name' => esc_html__( 'Page Right Sidebar', 'article-lite' ),
		'id' => 'pageright',
		'description' => esc_html__( 'Right sidebar for pages', 'article-lite' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );	

	register_sidebar( array(
		'name' => esc_html__( 'Banner', 'article-lite' ),
		'id' => 'banner',
		'description' => esc_html__( 'For Images and Sliders.', 'article-lite' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
		
	register_sidebar( array(
		'name' => esc_html__( 'Feature Top 1', 'article-lite' ),
		'id' => 'ftop1',
		'description' => esc_html__( 'Feature Top 1 position - full width group', 'article-lite' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );	
	register_sidebar( array(
		'name' => esc_html__( 'Feature Top 2', 'article-lite' ),
		'id' => 'ftop2',
		'description' => esc_html__( 'Feature Top 2 position - full width group', 'article-lite' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => esc_html__( 'Feature Top 3', 'article-lite' ),
		'id' => 'ftop3',
		'description' => esc_html__( 'Feature Top 3 position - full width group', 'article-lite' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

		
			

	register_sidebar( array(
		'name' => esc_html__( 'Feature Bottom 1', 'article-lite' ),
		'id' => 'fbottom1',
		'description' => esc_html__( 'Feature Bottom 1 position - full width group', 'article-lite' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => esc_html__( 'Feature Bottom 2', 'article-lite' ),
		'id' => 'fbottom2',
		'description' => esc_html__( 'Feature Bottom 2 position - full width group', 'article-lite' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => esc_html__( 'Feature Bottom 3', 'article-lite' ),
		'id' => 'fbottom3',
		'description' => esc_html__( 'Feature Bottom 3 position - full width group', 'article-lite' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => esc_html__( 'Feature Bottom 4', 'article-lite' ),
		'id' => 'fbottom4',
		'description' => esc_html__( 'Feature Bottom 4 position - full width group', 'article-lite' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );	

	register_sidebar( array(
		'name' => esc_html__( 'Bottom 1', 'article-lite' ),
		'id' => 'bottom1',
		'description' => esc_html__( 'Bottom 1 position', 'article-lite' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );
	register_sidebar( array(
		'name' => esc_html__( 'Bottom 2', 'article-lite' ),
		'id' => 'bottom2',
		'description' => esc_html__( 'Bottom 2 position', 'article-lite' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );
	register_sidebar( array(
		'name' => esc_html__( 'Bottom 3', 'article-lite' ),
		'id' => 'bottom3',
		'description' => esc_html__( 'Bottom 3 position', 'article-lite' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );
	register_sidebar( array(
		'name' => esc_html__( 'Bottom 4', 'article-lite' ),
		'id' => 'bottom4',
		'description' => esc_html__( 'Bottom 4 position', 'article-lite' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );		

	register_sidebar( array(
		'name' => esc_html__( 'Breadcrumbs', 'article-lite' ),
		'id' => 'breadcrumbs',
		'description' => esc_html__( 'This is breadcrumbs position but can be used for other things', 'article-lite' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	) );

	register_sidebar( array(
		'name' => esc_html__( 'Footer', 'article-lite' ),
		'id' => 'footer',
		'description' => esc_html__( 'This is a sidebar position that sits above the footer menu and copyright', 'article-lite' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h5 class="widget-title">',
		'after_title' => '</h5>',
	) );

}
add_action( 'widgets_init', 'article_lite_widgets_init' );

/**
 * Count the number of widgets to enable resizable widgets
 * in the featured top group.
 */

function article_lite_ftop() {
	$count = 0;
	if ( is_active_sidebar( 'ftop1' ) )
		$count++;
	if ( is_active_sidebar( 'ftop2' ) )
		$count++;
	if ( is_active_sidebar( 'ftop3' ) )
		$count++;		
	$class = '';
	switch ( $count ) {
		case '1':
			$class = 'col-sm-4 col-md-4 widget-cta widget_feat_top boxes';
			break;
		case '2':
			$class = 'col-sm-4 col-md-4 widget-cta widget_feat_top boxes';
			break;
		case '3':
			$class = 'col-sm-4 col-md-4 widget-cta widget_feat_top boxes';
			break;
	}
	if ( $class )
		echo 'class="' . esc_attr( $class ) . '"';
}


/**
 * Count the number of widgets to enable resizable widgets
 * in the featured bottom group.
 */

function article_lite_fbottom() {
	$count = 0;
	if ( is_active_sidebar( 'fbottom1' ) )
		$count++;
	if ( is_active_sidebar( 'fbottom2' ) )
		$count++;
	if ( is_active_sidebar( 'fbottom3' ) )
		$count++;		
	if ( is_active_sidebar( 'fbottom4' ) )
		$count++;
	$class = '';
	switch ( $count ) {
		case '1':
			$class = 'col-lg-12';
			break;
		case '2':
			$class = 'col-sm-6 col-md-6';
			break;
		case '3':
			$class = 'col-sm-6 col-md-4';
			break;
		case '4':
			$class = 'col-sm-6 col-md-3';
			break;
	}
	if ( $class )
		echo 'class="' . esc_attr( $class ) . '"';
}
/**
 * Count the number of widgets to enable resizable widgets
 * in the bottom group.
 */

function article_lite_bottom() {
	$count = 0;
	if ( is_active_sidebar( 'bottom1' ) )
		$count++;
	if ( is_active_sidebar( 'bottom2' ) )
		$count++;
	if ( is_active_sidebar( 'bottom3' ) )
		$count++;		
	if ( is_active_sidebar( 'bottom4' ) )
		$count++;
	$class = '';
	switch ( $count ) {
		case '1':
			$class = 'col-lg-12';
			break;
		case '2':
			$class = 'col-sm-6 col-lg-6';
			break;
		case '3':
			$class = 'col-sm-6 col-lg-4';
			break;
		case '4':
			$class = 'col-sm-6 col-lg-3';
			break;
	}
	if ( $class )
		echo 'class="' . esc_attr( $class ) . '"';
}
