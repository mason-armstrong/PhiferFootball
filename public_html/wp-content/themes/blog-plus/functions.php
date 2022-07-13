<?php

if ( ! function_exists( 'blog_plus_enqueue_styles' ) ) :

	function blog_plus_enqueue_styles() {
		wp_enqueue_style( 'blog-plus-style-parent', get_template_directory_uri() . '/style.css' );

		wp_enqueue_style( 'blog-plus-style', get_stylesheet_directory_uri() . '/style.css', array( 'blog-plus-style-parent' ), '1.0.0' );


		wp_register_script( "blog-plus-blog-ajax", get_theme_file_uri() . '/blog-ajax.js', array( 'jquery' ), '', true );

        wp_localize_script( 'blog-plus-blog-ajax', 'blog_plus_blog', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );    

        wp_enqueue_script( 'blog-plus-blog-ajax' );

	}

endif;

add_action( 'wp_enqueue_scripts', 'blog_plus_enqueue_styles', 99 );

function blog_plus_customize_control_style() {

	wp_enqueue_style( 'blog-plus-customize-controls', get_theme_file_uri() . '/customizer-control.css' );

}
add_action( 'customize_controls_enqueue_scripts', 'blog_plus_customize_control_style' );

add_action( 'enqueue_block_editor_assets', 'blog_plus_block_editor_styles' );

register_nav_menus( array(
	'primary' 	=> esc_html__( 'Primary', 'blog-plus' ),
	'secondary' => esc_html__( 'Secondary', 'blog-plus' ),
	'social' 	=> esc_html__( 'Social', 'blog-plus' ),
) );

if ( ! function_exists( 'blog_diary_site_branding' ) ) :
	
	function blog_diary_site_branding() {
		$options  = blog_diary_get_theme_options();
		$header_txt_logo_extra = $options['header_txt_logo_extra'];
		$header_image = get_header_image();		
		?>
		 <div class="menu-overlay"></div>

		 <?php if ( get_theme_mod( 'top_bar_section_enable' ) == true ): ?>

		 	<div id="top-navigation" class="relative">
            <div class="wrapper">
                <button class="menu-toggle" aria-controls="secondary-menu" aria-expanded="false">
                    <?php
						echo blog_diary_get_svg( array( 'icon' => 'menu' ) );
						echo blog_diary_get_svg( array( 'icon' => 'close' ) );
					?>
                    <span class="menu-label"><?php esc_html_e( 'Top Menu', 'blog-plus' ); ?></span>
                </button><!-- .menu-toggle -->

                <nav id="secondary-navigation" class="main-navigation" role="navigation" aria-label="Primary Menu">
                	<?php  
                		$social = '';
                		if ( has_nav_menu( 'social' ) ) :
                			$social = wp_nav_menu(
                				array(
                					'theme_location' => 'social',
									'container' => 'div',
									'container_class' => 'social-icons',
                					'menu_class' => '',
                					'echo' => false,
                					'fallback_cb' => 'blog_diary_menu_fallback_cb',
                					'depth' => 1,
                					'link_before' => '<span class="screen-reader-text">',
                					'link_after' => '</span>',
                					)
                				);
                			$social  =  '<li class="social-menu-item">'.$social. '</li>';

                		endif;

						$search = '<li class="main-navigation-search">';
						$search .= get_search_form( $echo = false );
		                $search .= '</li>';

	                wp_nav_menu(
	                	array(
	                		'theme_location' => 'secondary',
	                		'container' => 'div',
	                		'menu_class' => 'menu nav-menu',
	                		'menu_id' => 'secondary-menu',
	                		'echo' => true,
	                		'fallback_cb' => 'blog_diary_menu_fallback_cb',
	                		'items_wrap' => '<ul id="%1$s" class="%2$s"> '. $social .'%3$s'.$search.'</ul>',
	                		)
	                	);
                		
                	?>
                </nav><!-- .main-navigation-->
            </div>
        </div><!-- #top-navigation -->
		 	
		 <?php endif ?>

        <div id="header-banner-image" style="background-image: url('<?php echo esc_url( $header_image ); ?>');">
            <div class="overlay"></div>
            <div class="wrapper">
                <div class="site-branding">
					<?php if ( in_array( $header_txt_logo_extra, array( 'show-all', 'logo-title', 'logo-tagline' ) )  ) { ?>
						<div class="site-logo">
							<?php the_custom_logo(); ?>
						</div>
					<?php } 
					if ( in_array( $header_txt_logo_extra, array( 'show-all', 'title-only', 'logo-title', 'show-all', 'tagline-only', 'logo-tagline' ) ) ) : ?>
						<div id="site-identity">
							<?php
							if( in_array( $header_txt_logo_extra, array( 'show-all', 'title-only', 'logo-title' ) )  ) {
								if ( blog_diary_is_latest_posts() ) : ?>
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
            </div><!-- .wrapper -->
        </div><!-- .header-banner-image-->
		
		<?php
	}
endif;
add_action( 'blog_diary_header_action', 'blog_diary_site_branding', 10 );

if ( ! function_exists( 'blog_plus_santize_allow_tag' ) ) :
	
	function blog_plus_santize_allow_tag( $input ) {
		$input = wp_kses( $input, array(
			'br' => array(),
			'a' => array(
				'target' => array(),
				'href' => array(),
				)
			) );

		return $input;
	}
endif;

if ( ! function_exists( 'blog_plus_blog_posts_ajax_handler' ) ) :
 

    function blog_plus_blog_posts_ajax_handler(){
        $page = isset( $_POST['LBpageNumber'] ) ? absint( wp_unslash( $_POST['LBpageNumber'] ) ) : 1;
        header("Content-Type: text/html");
  
         // Content type.
        $content = array();
       
        $cat_id = ! empty( get_theme_mod( 'child_blog_content_category', 'category' ) ) ? get_theme_mod( 'child_blog_content_category', 'category' ) : '';
                $args = array(
                    'post_type'             => 'post',
                    'posts_per_page'        => 3,
                    'cat'                   => absint( $cat_id ),
                    'ignore_sticky_posts'   => true,
                    'post_status'           => array( 'publish' ),
                    'paged'                 => $page,
                    );                   
    
        $blog = new WP_Query( $args );


        if ( $blog -> have_posts() ) : while ( $blog -> have_posts() ) : $blog -> the_post(); 
                $content['id']        = get_the_id();
                $content['title']     = get_the_title();
                $content['url']       = get_the_permalink();
                $content['excerpt']   = get_the_excerpt();
                $content['image']     = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_id(), 'post-thumbnail' ) : '';
                $content['author']    = blog_diary_author();
            ?>
            <article class="<?php echo ! empty( $content['image'] ) ? 'has' : 'no'; ?>-post-thumbnail">
                <div class="post-wrapper">
                    <?php if ( ! empty( $content['image'] ) ) : ?>
                        <div class="featured-image" style="background-image:url('<?php echo esc_url( $content['image'] ); ?>');">
                            <a href="<?php echo esc_url( $content['url'] ); ?>" class="post-thumbnail-link"></a>
                        </div><!-- .featured-image-->
                    <?php endif; ?>

                    <div class="entry-container">
                        <header class="entry-header">
                            <h2 class="entry-title"><a href="<?php echo esc_url( $content['url'] ); ?>"><?php echo esc_html( $content['title'] ); ?></a></h2>
                        </header>

                        <div class="entry-meta">
                            <?php 
                            echo wp_kses_post( $content['author'] );
                            blog_diary_posted_on( $content['id'] ); 
                            ?>
                            <span class="cat-links">
                                <?php the_category( '', '', $content['id'] ); ?>
                            </span><!-- .cat-links --> 
                        </div><!-- .entry-meta -->

                        <div class="entry-content">
                            <p><?php echo esc_html( $content['excerpt'] ); ?></p>
                        </div>
                        <a href="<?php echo esc_url( $content['url'] ); ?>" class="btn">
                            <span class="screen-reader-text"><?php echo esc_html( $content['title'] ); ?></span>
                            <?php if( !empty( get_theme_mod('child_blog_btn_title') ) ): ?>
                                <?php echo esc_html( get_theme_mod('child_blog_btn_title', esc_html__( 'Show All', 'blog-plus' ) ) ); ?>
                            <?php endif; ?>
                        </a>
                    </div><!-- .entry-container -->
                </div>
            </article>

        <?php endwhile; endif;
        wp_reset_postdata();
        ?>
        <?php die();
    }
endif;
add_action("wp_ajax_blog_plus_blog_posts_ajax_handler", "blog_plus_blog_posts_ajax_handler");
add_action("wp_ajax_nopriv_blog_plus_blog_posts_ajax_handler", "blog_plus_blog_posts_ajax_handler");

require get_theme_file_path() . '/inc/customizer.php';

require get_theme_file_path() . '/inc/front-sections/child_blog.php';

require get_theme_file_path() . '/inc/front-sections/instagram.php';