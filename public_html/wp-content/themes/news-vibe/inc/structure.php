<?php
/**
 * Theme Palace basic theme structure hooks
 *
 * This file contains structural hooks.
 *
 * @package Theme Palace
 * @subpackage News Vibe
 * @since News Vibe 1.0.0
 */

$options = news_vibe_get_theme_options();


if ( ! function_exists( 'news_vibe_doctype' ) ) :
	/**
	 * Doctype Declaration.
	 *
	 * @since News Vibe 1.0.0
	 */
	function news_vibe_doctype() {
	?>
		<!DOCTYPE html>
			<html <?php language_attributes(); ?>>
	<?php
	}
endif;

add_action( 'news_vibe_doctype', 'news_vibe_doctype', 10 );


if ( ! function_exists( 'news_vibe_head' ) ) :
	/**
	 * Header Codes
	 *
	 * @since News Vibe 1.0.0
	 *
	 */
	function news_vibe_head() {
		?>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="file" href="http://gmpg.org/xfn/11">
		<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
			<link rel="pingback" href="<?php echo esc_url(get_bloginfo( 'pingback_url' ) ); ?>">
		<?php endif;
	}
endif;
add_action( 'news_vibe_before_wp_head', 'news_vibe_head', 10 );

if ( ! function_exists( 'news_vibe_page_start' ) ) :
	/**
	 * Page starts html codes
	 *
	 * @since News Vibe 1.0.0
	 *
	 */
	function news_vibe_page_start() {
		?>
		<div id="page" class="site">
			<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'news-vibe' ); ?></a>
			<div class="menu-overlay"></div>

		<?php
	}
endif;
add_action( 'news_vibe_page_start_action', 'news_vibe_page_start', 10 );

if ( ! function_exists( 'news_vibe_page_end' ) ) :
	/**
	 * Page end html codes
	 *
	 * @since News Vibe 1.0.0
	 *
	 */
	function news_vibe_page_end() {
		?>
		</div><!-- #page -->
		<?php
	}
endif;
add_action( 'news_vibe_page_end_action', 'news_vibe_page_end', 10 );

if ( ! function_exists( 'news_vibe_header_start' ) ) :
	/**
	 * Header start html codes
	 *
	 * @since News Vibe 1.0.0
	 *
	 */
	function news_vibe_header_start() { 
		$options  = news_vibe_get_theme_options();
	?>	
		<?php if ( ! $options['topbar_section_enable'] ): ?>
			<div id="top-navigation" class="relative">
	            <div class="wrapper">
	                <button class="menu-toggle" aria-controls="secondary-menu" aria-expanded="false">
	                    <?php
							echo news_vibe_get_svg( array( 'icon' => 'menu' ) );
							echo news_vibe_get_svg( array( 'icon' => 'close' ) );
						?>
	                    <span class="menu-label"><?php esc_html_e( 'Top Menu', 'news-vibe' ); ?></span>
	                </button><!-- .menu-toggle -->

	                <nav id="secondary-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'news-vibe' ); ?>">

	                	<?php  
		                	$address = '';
		                	if ( $options['topbar_section_enable'] ) :
		                		$address = '<li class="contact-info">';
		                	$address .= esc_html($topbar_address );
		                	$address .= '</li>';
		                	endif;

		                	
		                	$email = '';
		                	if ( $options['topbar_section_enable'] ) :
		                	$email = '<li class="contact-info"><a href="mailto:' . esc_url($topbar_email) .' ">';
		                	$email .= esc_html( $topbar_email );
		                	$email .= '</a></li>';
		                	endif;

	                		$social = '';
	                		if ( has_nav_menu( 'social' ) ) :
		                		$social_defaults = array(
			            			'theme_location' => 'social',
			            			'container' => 'div',
			            			'menu_class' => '',
			            			'echo' => false,
			            			'fallback_cb' => 'news_vibe_menu_fallback_cb',
			            			'depth' => 1,
			            			'link_before' => '<span class="screen-reader-text">',
									'link_after' => '</span>',
			            		);
		                		$social .= '<li class="social-menu-item"><div class="social-icons">';
			            		$social .= wp_nav_menu( $social_defaults );
		                		$social .= '</div></li>';
	                		endif;

	                		$defaults = array(
			        			'theme_location' => 'secondary',
			        			'container' => false,
			        			'menu_class' => 'menu nav-menu',
			        			'menu_id' => 'secondary-menu',
			        			'echo' => true,
			        			'fallback_cb' => 'news_vibe_menu_fallback_cb',
			        			'items_wrap' => '<ul id="%1$s" class="%2$s">' . $address . $email. '%3$s' . $social . '</ul>',
			        		);

			        		wp_nav_menu( $defaults );
	                	?>

	                </nav><!-- .main-navigation-->
	            </div>
	        </div><!-- #top-navigation -->
		<?php endif ?>
		
		<header id="masthead" class="site-header" role="banner">
		<?php
	}
endif;
add_action( 'news_vibe_header_action', 'news_vibe_header_start', 10 );

if ( ! function_exists( 'news_vibe_site_branding' ) ) :
	/**
	 * Site branding codes
	 *
	 * @since News Vibe 1.0.0
	 *
	 */
	function news_vibe_site_branding() {
		$options  = news_vibe_get_theme_options();
		$header_txt_logo_extra = $options['header_txt_logo_extra'];	
		$bg_image = (isset($options['bg_image'])) ? $options['bg_image'] : '';
		?>
		<div class="site-branding-container" style="background-image: url('<?php echo esc_url( $bg_image ); ?>');">
		 <div class="overlay"></div>
		<div class="wrapper">
            <div class="site-branding-wrapper">
				<div class="site-branding">
					<?php if ( in_array( $header_txt_logo_extra, array( 'show-all', 'logo-title', 'logo-tagline' ) )  ) { ?>
						<div class="site-logo">
							<?php the_custom_logo(); ?>
						</div>
					<?php } 
					if ( in_array( $header_txt_logo_extra, array( 'show-all', 'title-only', 'logo-title', 'show-all', 'tagline-only', 'logo-tagline' ) ) ) : ?>
						<div id="site-details">
							<?php
							if( in_array( $header_txt_logo_extra, array( 'show-all', 'title-only', 'logo-title' ) )  ) {
								if ( news_vibe_is_latest_posts() ) : ?>
									<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
								<?php else : ?>
									<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
								<?php
								endif;
							} 
							if ( in_array( $header_txt_logo_extra, array( 'show-all', 'tagline-only', 'logo-tagline' ) ) ) {
								$description = get_bloginfo( 'description', 'display' );
								if ( $description || is_customize_preview() ) : ?>
									<p class="site-description"><?php echo esc_html( $description ); /* WPCS: xss ok. */ ?></p>
								<?php
								endif; 
							}?>
						</div>
			    	<?php endif; ?>
				</div><!-- .site-branding -->

				<?php if ( ! empty( $options['ads_image'] ) && ! empty( $options['ads_url'] ) ) : ?>
					<div class="site-advertisement">
	                    <a href="<?php echo esc_url( $options['ads_url'] ); ?>"><img src="<?php echo esc_url( $options['ads_image'] ); ?>" alt="<?php esc_attr_e('site-advertisement', 'news-vibe'); ?>"></a>
	                </div><!-- .site-advertisement -->
	            <?php endif; ?>
			</div><!-- .site-branding-wrapper -->
		</div><!-- .wrapper -->
		</div>
		<?php
	}
endif;
add_action( 'news_vibe_header_action', 'news_vibe_site_branding', 20 );

if ( ! function_exists( 'news_vibe_site_navigation' ) ) :
	/**
	 * Site navigation codes
	 *
	 * @since News Vibe 1.0.0
	 *
	 */
	function news_vibe_site_navigation() {
		$options = news_vibe_get_theme_options();
		?>
		<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
			<?php
			echo news_vibe_get_svg( array( 'icon' => 'menu' ) );
			echo news_vibe_get_svg( array( 'icon' => 'close' ) );
			?>		
			<span class="menu-label"><?php esc_html_e( 'Primary Menu', 'news-vibe' ); ?></span>			
		</button>
		<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e('Primary Menu', 'news-vibe'); ?>">
			<div class="wrapper">
				<?php 
					$search = '';
					if ( $options['nav_search_enable'] ) :
						$search = '<li class="main-navigation-search">'.get_search_form( $echo = false );
						$search .= '</li>';
	                endif;

	                $home_icon = news_vibe_get_svg( array( 'icon' => 'home' ) );
	                
	                wp_nav_menu( 
	                	array(
	                		'theme_location' => 'primary',
	                		'container' => false,
	                		'menu_class' => 'menu nav-menu',
	                		'menu_id' => 'primary-menu',
	                		'echo' => true,
	                		'fallback_cb' => 'news_vibe_menu_fallback_cb',
	                		'items_wrap' => '<ul id="%1$s" class="%2$s"><li class="home-icon"><a href='.esc_url( home_url( '/' ) ). '>'.$home_icon.'</li>%3$s' . $search . '</ul>',
	                		)
	                	);
	        	?>
        	</div><!-- .wrapper -->
		</nav><!-- #site-navigation -->
		<?php
	}
endif;
add_action( 'news_vibe_header_action', 'news_vibe_site_navigation', 30 );


if ( ! function_exists( 'news_vibe_header_end' ) ) :
	/**
	 * Header end html codes
	 *
	 * @since News Vibe 1.0.0
	 *
	 */
	function news_vibe_header_end() {
		?>
		</header><!-- #masthead -->
		<?php
	}
endif;

add_action( 'news_vibe_header_action', 'news_vibe_header_end', 50 );

if ( ! function_exists( 'news_vibe_content_start' ) ) :
	/**
	 * Site content codes
	 *
	 * @since News Vibe 1.0.0
	 *
	 */
	function news_vibe_content_start() {
		$options = news_vibe_get_theme_options();
		$tags = get_tags( array(
		  'taxonomy' => 'post_tag',
		  'orderby' => 'name',
		  'hide_empty' => false // for development
		) );
		?>
		<div id="content" class="site-content">
		<?php if ( news_vibe_is_frontpage() && $options['frontpage_tags_enable']) { ?>		
			<div id="tags">
			    <div class="wrapper">
			        <div class="tags-wrapper">
			            <span><?php echo esc_html__( 'Tags:', 'news-vibe' ) ?></span>
			            <ul>
			                <?php foreach ( $tags as $tag ) { 
			                    $tag_link = get_tag_link( $tag->term_id );
			                ?>
			                    <li><a href="<?php  echo esc_url( $tag_link ) ?>"><?php echo esc_html( $tag->name ) ?></a></li>
			                <?php } ?>
			            </ul>
			        </div><!-- .tags-wrapper -->
			    </div><!-- #wrapper -->
			</div>
		<?php } ?>
		<?php
	}
endif;
add_action( 'news_vibe_content_start_action', 'news_vibe_content_start', 10 );

if ( ! function_exists( 'news_vibe_content_end' ) ) :
	/**
	 * Site content codes
	 *
	 * @since News Vibe 1.0.0
	 *
	 */
	function news_vibe_content_end() {
		?>
			
		</div><!-- #content -->
		<?php
	}
endif;
add_action( 'news_vibe_content_end_action', 'news_vibe_content_end', 10 );

if ( ! function_exists( 'news_vibe_header_image' ) ) :
	/**
	 * Header Image codes
	 *
	 * @since News Vibe 1.0.0
	 *
	 */
	function news_vibe_header_image() {
		if ( news_vibe_is_frontpage() )
			return;
		$header_image = get_header_image();
		if ( is_singular() ) :
			$header_image = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_id(), 'full' ) : $header_image;
		endif;
		?>

		<div id="page-site-header" class="relative" style="background-image: url('<?php echo esc_url( $header_image ); ?>');">
            <div class="overlay"></div>
            <div class="wrapper">
                <header class="page-header">
                    <h2 class="page-title"><?php news_vibe_custom_header_banner_title(); ?></h2>
                </header>

                <?php news_vibe_add_breadcrumb(); ?>
            </div><!-- .wrapper -->
        </div><!-- #page-site-header -->
		<?php
	}
endif;

add_action( 'news_vibe_header_image_action', 'news_vibe_header_image', 20 );

if ( ! function_exists( 'news_vibe_add_breadcrumb' ) ) :
	/**
	 * Add breadcrumb.
	 *
	 * @since News Vibe 1.0.0
	 */
	function news_vibe_add_breadcrumb() {
		
		// Bail if Home Page.
		if ( news_vibe_is_frontpage() ) {
			return;
		}

		echo '<div id="breadcrumb-list">';
				/**
				 * news_vibe_simple_breadcrumb hook
				 *
				 * @hooked news_vibe_simple_breadcrumb -  10
				 *
				 */
				do_action( 'news_vibe_simple_breadcrumb' );
		echo '</div>';
		return;
	}
endif;

if ( ! function_exists( 'news_vibe_footer_start' ) ) :
	/**
	 * Footer starts
	 *
	 * @since News Vibe 1.0.0
	 *
	 */
	function news_vibe_footer_start() {
		?>
		<footer id="colophon" class="site-footer" role="contentinfo">
		<?php
	}
endif;
add_action( 'news_vibe_footer', 'news_vibe_footer_start', 10 );

if ( ! function_exists( 'news_vibe_footer_site_info' ) ) :
	/**
	 * Footer starts
	 *
	 * @since News Vibe 1.0.0
	 *
	 */
	function news_vibe_footer_site_info() {
		$options = news_vibe_get_theme_options();
		$search = array( '[the-year]', '[site-link]' );

        $replace = array( date_i18n( _x( 'Y', 'copyright date format', 'news-vibe' ) ), '<a href="'. esc_url( home_url( '/' ) ) .'">'. esc_attr( get_bloginfo( 'name', 'display' ) ) . '</a>' );

        $options['copyright_text'] = str_replace( $search, $replace, $options['copyright_text'] );

		$copyright_text = $options['copyright_text']; 
		?>
		<div class="site-info col-2">
            <div class="wrapper">
            	<?php if ( ! empty( $options['footer_image'] ) ) : ?>
	            	<span><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $options['footer_image'] ); ?>" alt="<?php echo esc_attr(get_bloginfo( 'name' )); ?>"></a></span>
	            <?php endif; ?>

                <span>
                	<?php 
                	echo news_vibe_santize_allow_tag( $copyright_text ); 
                	if ( function_exists( 'the_privacy_policy_link' ) ) {
						the_privacy_policy_link( ' | ' );
					}
                	?>
            	</span>
            </div><!-- .wrapper -->    
        </div><!-- .site-info -->

		<?php
	}
endif;
add_action( 'news_vibe_footer', 'news_vibe_footer_site_info', 40 );



if ( ! function_exists( 'news_vibe_footer_end' ) ) :
	/**
	 * Footer starts
	 *
	 * @since News Vibe 1.0.0
	 *
	 */
	function news_vibe_footer_end() {
		?>
		</footer>
		<?php
		$options  = news_vibe_get_theme_options();
		if ( true === $options['scroll_top_visible'] ) : ?>
			<div class="backtotop"><?php echo news_vibe_get_svg( array( 'icon' => 'up' ) ); ?></div>
		<?php
		endif;
	}
endif;
add_action( 'news_vibe_footer', 'news_vibe_footer_end', 100 );

