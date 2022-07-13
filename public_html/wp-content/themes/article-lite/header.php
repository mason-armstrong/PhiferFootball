<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Article Lite
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> itemscope="itemscope" itemtype="http://schema.org/WebPage">
	<?php wp_body_open(); ?>
<div id="page" class="hfeed site fullwidth ">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'article-lite' ); ?></a>

	<header id="masthead" class="site-header" itemscope="itemscope" itemtype="http://schema.org/WPHeader">
		<div class="site-header">
			<div class="site-branding">
				<div class="site-logo">
					<?php the_custom_logo(); ?>
				</div>
				<div class="site-title" itemprop="headline">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
				</div>

				<?php 
				$article_lite_description = get_bloginfo( 'description', 'display' );
				if ( $article_lite_description || is_customize_preview() ) :
					?>
					<div class="site-description" itemprop="description"><?php echo esc_html($article_lite_description); /* WPCS: xss ok. */ ?></div>
				<?php endif; ?>
			</div><!-- .site-branding -->

			<!-- social navigation -->
	

			<nav id="site-navigation" class="main-navigation">
				<div class="toggle-container visible-xs visible-sm hidden-md hidden-lg">
                    <button class="menu-toggle"><?php esc_html_e( 'Menu', 'article-lite' ); ?></button>
                </div>
                <div class="menu-main menu-container">
		            <?php if ( has_nav_menu( 'primary' ) ) {
		                wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) );
		                } else {
		                    wp_nav_menu( array(	'container' => '', 'menu_class' => '', 'title_li' => '' ));
		                }
		            ?>
		        </div>
			</nav><!-- #site-navigation -->
			<div class="header_search_form">
	            <?php get_search_form(); ?>
	            <a href="javascript:void(0);" class="header_search_close"><i class="fa fa-times-circle"></i></a>
	         </div>
	    </div>
	</header><!-- #masthead -->

	<?php
	if ( is_home() || is_front_page() ) :
	    get_sidebar( 'banner' );
	    ?>

	    <div id="feature-top-wrapper">
	    		<?php get_sidebar( 'feature-top' ); ?>
	    </div>
	<?php endif; ?>

	<div id="content" class="site-content">

		<?php
		if ( !is_home() || !is_front_page() ) :
		?>
		    <div id="breadcrumb-wrapper">
		        <?php get_sidebar( 'breadcrumbs' ); ?>
		    </div>
		<?php endif;
