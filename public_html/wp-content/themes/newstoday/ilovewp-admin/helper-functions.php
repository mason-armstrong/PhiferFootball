<?php

// Page/Post Title
if( ! function_exists( 'ilovewp_helper_display_breadcrumbs' ) ) {
	function ilovewp_helper_display_breadcrumbs() {

		// CONDITIONAL FOR "Breadcrumb NavXT" plugin OR Yoast SEO Breadcrumbs
		// https://wordpress.org/plugins/breadcrumb-navxt/

		if ( function_exists('bcn_display') ) { ?>
		<div class="site-breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
			<p class="site-breadcrumbs-p"><?php bcn_display(); ?></p>
		</div><!-- .site-breadcrumbs--><?php }

		// CONDITIONAL FOR "Yoast SEO" plugin, Breadcrumbs feature
		// https://wordpress.org/plugins/wordpress-seo/
		if ( function_exists('yoast_breadcrumb') ) {
			yoast_breadcrumb('<div class="site-breadcrumbs"><p class="site-breadcrumbs-p">','</p></div>');
		}

	}
}

// Page/Post Title
if( ! function_exists( 'ilovewp_helper_display_title' ) ) {
	function ilovewp_helper_display_title($post) {

		if( ! is_object( $post ) ) return;
		the_title( '<h1 class="page-title">', '</h1>' );
	}
}

// Page/Post Excerpt
if( ! function_exists( 'ilovewp_helper_display_excerpt' ) ) {
	function ilovewp_helper_display_excerpt($post) {

		if( ! is_object( $post ) ) return;

		return '<p class="entry-excerpt">' . get_the_excerpt() . '</p>';

	}
}

// Page/Post Title
if( ! function_exists( 'ilovewp_helper_display_featured_image' ) ) {
	function ilovewp_helper_display_featured_image($post) {

		if( ! is_object( $post ) ) return;

		$themeoptions_display_post_featured_image = esc_attr(get_theme_mod( 'theme-display-post-featured-image', 0 ));

		if ( $themeoptions_display_post_featured_image == 0 ) {
			return;
		}

		if ( has_post_thumbnail() ) {
			echo '<div class="entry-inner-thumbnail">';
			the_post_thumbnail('newstoday-thumb-featured');
			echo '</div><!-- .entry-inner-thumbnail -->';
		}
		
	}
}

// Page/Post Comments
if( ! function_exists( 'ilovewp_helper_display_comments' ) ) {
	function ilovewp_helper_display_comments($post) {

		if( ! is_object( $post ) ) return;

		if ( comments_open() || get_comments_number() ) :

			echo '<div id="ilovewp-comments"">';
			comments_template();
			echo '</div><!-- #ilovewp-comments -->';

		endif;

	}
}

// Page/Post Content
if( ! function_exists( 'ilovewp_helper_display_content' ) ) {
	function ilovewp_helper_display_content($post) {

		if( ! is_object( $post ) ) return;

		echo '<div class="entry-content">';
			
			the_content();
			
			wp_link_pages(array('before' => '<p class="post-meta page-navigation"><span class="post-meta-headline">' . __('Pages', 'newstoday') . ':</span> ', 'after' => '</p>', 'next_or_number' => 'number'));

		echo '</div><!-- .entry-content -->';

	}
}

// Post Tags
if( ! function_exists( 'ilovewp_helper_display_tags' ) ) {
	function ilovewp_helper_display_tags($post) {

		if( ! is_object( $post ) ) return;

		if ( get_post_type($post->ID) == 'post' ) { 
			the_tags( '<p class="post-meta post-tags"><span class="post-meta-headline">' . __('Tags', 'newstoday') . ':</span> ', '', '</p>');
		}

	}
}

// Post Meta
if( ! function_exists( 'ilovewp_helper_display_postmeta' ) ) {
	function ilovewp_helper_display_postmeta($post) {

		if( ! is_object( $post ) ) return;

		$output = '';

		if ( get_post_type($post->ID) == 'post' ) { 

			$themeoptions_display_post_author = esc_attr(get_theme_mod( 'theme-display-post-meta-author', 0 ));
			$themeoptions_display_post_date = esc_attr(get_theme_mod( 'theme-display-post-meta-date', 0 ));
			$themeoptions_display_post_category = esc_attr(get_theme_mod( 'theme-display-post-meta-category', 0 ));

			$output .= '<p class="entry-meta"><span class="post-meta-wrapper">';
			if ( $themeoptions_display_post_author == 1 ) {
				$output .= '<span class="post-meta-span post-meta-span-author">By <a href="' . get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ) . '">' . get_the_author() . '</a></span>';
			}
			if ( $themeoptions_display_post_date == 1 ) {
				$output .= '<span class="post-meta-span post-meta-span-time">on <time datetime="' . esc_attr(get_the_time("Y-m-d")) . '" pubdate>' . esc_html(get_the_time(get_option('date_format'))) . '</time></span>';
			}
			if ( $themeoptions_display_post_category == 1 ) {
				$output .= '<span class="post-meta-span post-meta-span-category">in ' . get_the_category_list(', ') . '</span>';
			}
			$output .= '</span><!-- .post-meta-wrapper --></p><!-- .entry-meta -->';

		}

		return $output;

	}
}

// Post Author Box
if( ! function_exists( 'ilovewp_helper_display_authorbio' ) ) {
	function ilovewp_helper_display_authorbio($post) {

		if( ! is_object( $post ) ) return;

		if ( get_post_type($post->ID) == 'post' ) { 

			$themeoptions_display_post_authorbio = esc_attr(get_theme_mod( 'theme-display-post-meta-authorbio', 0 ));

			if ( $themeoptions_display_post_authorbio == 0 ) {
				return;
			}

			// Fetch custom field for this post/page
			$meta_hide_authorbio = get_post_meta( $post->ID, 'ilovewp_meta_hide_author', true );

			if ( isset($meta_hide_authorbio) && $meta_hide_authorbio == 1 ) { 
				// is hidden by custom field in current post/page
				return;
			}

			?><div class="entry-authorbio-wrapper clearfix">
				
				<?php echo get_avatar( get_the_author_meta( 'ID' ) , 80 ); ?>

				<div class="author-description clearfix">

					<h3 class="author-title"><?php the_author_posts_link(); ?></h3>

					<?php if ( get_the_author_meta( 'user_url' ) || get_the_author_meta( 'facebook_url' ) || get_the_author_meta( 'twitter' ) || get_the_author_meta( 'instagram_url' ) ) {
					?><div class="author-links"><?php 
					if ( get_the_author_meta( 'user_url' ) ) { ?><a rel="external,nofollow,noopener" class="author_website" href="<?php the_author_meta( 'user_url' ); ?>" title="Author Homepage" target="_blank"><span class="fa fa-link"></span></a><?php } 
					if ( get_the_author_meta( 'facebook_url' ) ) { ?><a rel="external,nofollow,noopener" class="author_facebook" href="<?php the_author_meta( 'facebook_url' ); ?>" title="Facebook Profile" target="_blank"><span class="fa fa-facebook-square"></span></a><?php } 
					if ( get_the_author_meta( 'twitter' ) ) { ?><a rel="external,nofollow,noopener" class="author_twitter" href="https://twitter.com/<?php the_author_meta( 'twitter' ); ?>" title="Follow <?php the_author_meta( 'display_name' ); ?> on Twitter" target="_blank"><span class="fa fa-twitter"></span></a><?php } 
					if ( get_the_author_meta( 'instagram_url' ) ) { ?><a rel="external,nofollow,noopener" class="author_instagram" href="https://instagram.com/<?php the_author_meta( 'instagram_url' ); ?>" title="Instagram" target="_blank"><span class="fa fa-instagram"></span></a><?php } ?></div><!-- .author-links --><?php } ?>

					<div class="author-bio"><?php the_author_meta( 'description' ); ?></div>

				</div><!-- .author-description -->

			</div><!-- .entry-authorbio-wrapper .clearfix --><?php

		}

	}
}

// Post Next/Previous navigation
if( ! function_exists( 'ilovewp_helper_display_post_navigation' ) ) {
	function ilovewp_helper_display_post_navigation($post) {

		if( ! is_object( $post ) ) return;

		if ( get_post_type($post->ID) == 'post' ) { 

			$themeoptions_hide_post_authorbio = esc_attr(get_theme_mod( 'theme-hide-post-authorbio', 0 ));

			if ( $themeoptions_hide_post_authorbio == 1 ) {
				return;
			}

			$output = '';

			// $args['prev_text'] = '<span class="nav-link-label">' . __('Previous Article', 'newstoday') . '</span>' . '%title';
			// $args['next_text'] = '<span class="nav-link-label">' . __('Next Article', 'newstoday') . '</span>' . '%title';
			// return get_the_post_navigation($args);

			
			$output .= '<div class="post-navigation">';
			$output .= '<div class="site-post-nav-item site-post-nav-prev">' . get_previous_post_link( '<span class="post-navigation-label">' . __('Previous Article', 'newstoday') . '</span>' . '%link', '%title', true ) . '</div><!-- .site-post-nav-item -->';
			$output .= '<div class="site-post-nav-item site-post-nav-next">' . get_next_post_link( '<span class="post-navigation-label">' . __('Next Article', 'newstoday') . '</span>' . '%link', '%title', true ) . '</div><!-- .site-post-nav-item -->';
			$output .= '</div><!-- .post-navigation -->';

			return $output;

		}

	}
}

// Category RSS Feed Link
if( ! function_exists( 'ilovewp_helper_display_category_rss_feed' ) ) {
	function ilovewp_helper_display_category_rss_feed() {

		if ( is_category() ) {

			$themeoptions_display_category_rss = esc_attr(get_theme_mod( 'theme-display-category-rss', 0 ));

			if ( $themeoptions_display_category_rss == 0 ) {
				return;
			}

			$category = get_category( get_query_var('cat') );
			
			if ( ! empty( $category ) ) {
				return '<div class="site-category-feed"><span class="fa fa-rss"></span> <a href="' . get_category_feed_link( $category->cat_ID ) . '" title="' . sprintf( __( 'Subscribe to this category', 'newstoday' ), $category->name ) . '" rel="nofollow">' . esc_html($category->name) . ' ' . __( 'RSS Feed', 'newstoday' ) . '</a></div><!-- .site-category-feed -->';
			}

		}

	}
}

// Sidebar
if( ! function_exists( 'ilovewp_helper_display_page_sidebar_column' ) ) {
	function ilovewp_helper_display_page_sidebar_column() {

		?><div class="site-column site-column-aside">

			<div class="site-column-wrapper clearfix">

				<?php get_sidebar(); ?>

			</div><!-- .site-column-wrapper .clearfix -->

		</div><!-- .site-column .site-column-aside --><?php

	}
}

// Content Column Wrapper Start
if( ! function_exists( 'ilovewp_helper_display_page_content_wrapper_start' ) ) {
	function ilovewp_helper_display_page_content_wrapper_start() {

		?><div class="site-column site-column-content"><div class="site-column-wrapper clearfix"><!-- .site-column .site-column-1 .site-column-aside --><?php

	}
}

// Content Column Wrapper End
if( ! function_exists( 'ilovewp_helper_display_page_content_wrapper_end' ) ) {
	function ilovewp_helper_display_page_content_wrapper_end() {

		?></div><!-- .site-column-wrapper .clearfix --></div><!-- .site-column .site-column-content --><?php

	}
}

// Get Sidebar Position for Current Page or Post
if( ! function_exists( 'ilovewp_helper_get_sidebar_position' ) ) {
	function ilovewp_helper_get_sidebar_position() {

		global $post;

		$themeoptions_sidebar_position = esc_attr(get_theme_mod( 'theme-sidebar-position', 'right' ));

		if ( $themeoptions_sidebar_position == 'left' ) {
			$default_position = 'page-sidebar-left';
		} elseif ( $themeoptions_sidebar_position == 'right' ) {
			$default_position = 'page-sidebar-right';
		}

		return $default_position;
	}
}

// Get Color Palette from Theme Options
if( ! function_exists( 'ilovewp_helper_get_color_palette' ) ) {
	function ilovewp_helper_get_color_palette() {

		global $post;

		$valid_palettes = array('atlanta','atletico','bayern','dortmund','lakers','oakland','portland','real');
		$themeoptions_color_palette = esc_attr(get_theme_mod( 'theme-color-palette', 'atletico' ));
		$class_string = 'theme-color-';

		if ( in_array($themeoptions_color_palette, $valid_palettes) ) {
			$class_string = $class_string . $themeoptions_color_palette;
		} else {
			$class_string = $class_string . 'atletico';
		}

		return $class_string;
	}
}