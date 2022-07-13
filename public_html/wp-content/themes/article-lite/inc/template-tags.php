<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Article Lite
 */

if ( ! function_exists( 'article_lite_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function article_lite_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( 'Posted on %s', 'post date', 'article-lite' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="posted-on">' . esc_html( $posted_on ) . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'article_lite_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function article_lite_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'article-lite' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'article_lite_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function article_lite_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'article-lite' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'article-lite' ) . '</span>', $categories_list ); // WPCS: XSS OK.
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'article-lite' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'article-lite' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'article-lite' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'article-lite' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'article_lite_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function article_lite_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>

		<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
			<?php
			the_post_thumbnail( 'post-thumbnail', array(
				'alt' => the_title_attribute( array(
					'echo' => false,
				) ),
			) );
			?>
		</a>

		<?php
		endif; // End is_singular().
	}
endif;


	
/**
 * Entry titles
 *
 * Creates the appropriate title based on the page.
 * Adds Untitled if no title is provided by the author.
*/

if ( ! function_exists( 'article_lite_entry_titles' ) ) :

function article_lite_entry_titles() { 
    
if ( is_single() ) :
	
        echo '<h1 class="entry-title" itemprop="headline">';		
		if(the_title( '', '', false ) !=''){
			the_title();
		}else {
			esc_html_e('Untitled', 'article-lite');
		} 
	echo '</h1>';
	  
 else :
		
	echo '<h2 class="entry-title" itemprop="headline"><a href="' .esc_url( get_permalink() ) .'" rel="bookmark">';			
	if(the_title( '', '', false ) !=''){
		the_title();
	} else {
		esc_html_e('Untitled', 'article-lite'); 
	}
	echo '</a></h2>';
	  
    endif;
}

endif;
		
					
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
if ( ! function_exists( 'article_lite_posted_on' ) ) :
function article_lite_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s" itemprop="datePublished">%2$s</time>';
	

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);

	$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( 'Posted on %s', 'post date', 'article-lite' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

	echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

}
endif;



if ( ! function_exists( 'article_lite_entry_meta' ) ) :
/**
 * Prints HTML with meta information for the categories, tags.
 *
 * Create your own article_lite_entry_meta() to override in a child theme.
 *
 * @since Twenty Sixteen 1.0
 */
function article_lite_entry_meta() {


	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		printf(
			'<span class="posted-on">%1$s<a href="%2$s" rel="bookmark">%3$s</a></span>',
			'',
			esc_url( get_permalink() ),
			$time_string
		);
 }	

endif;

/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
if ( ! function_exists( 'article_lite_single_posted_on' ) ) :
function article_lite_single_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s" itemprop="datePublished">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s" itemprop="datePublished">%2$s</time><time class="updated" datetime="%3$s" itemprop="dateUpdated">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		_x( 'Posted on %s', 'post date', 'article-lite' ),'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);
	
	$byline = sprintf(
		_x( 'by %s', 'post author', 'article-lite' ),
		'<span class="author vcard" itemprop="author" itemscope="itemscope" itemtype="http://schema.org/Person"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" itemprop="url"><span itemprop="name">' . esc_html( get_the_author() ) . '</span></a></span>'
	);

	echo '<span class="posted-on">' .$posted_on . '</span>';

	echo '<span class="byline">' . $byline . '</span>';
	

	
	
}
endif;



/**
 * Prints HTML with meta information for the full post footer area.
 */
if ( ! function_exists( 'article_lite_entry_footer' ) ) :
function article_lite_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */

		$categories_list = get_the_category_list( esc_html__( ', ', 'article-lite' ) );
		if ( $categories_list && article_lite_categorized_blog() ) {
			printf( '<span class="cat-links" itemprop="articleSection">' . esc_html__( 'Posted in %1$s', 'article-lite' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */

		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'article-lite' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links" itemprop="keywords">' . esc_html__( 'Tagged %1$s', 'article-lite' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}

	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( esc_html__( 'Leave a comment', 'article-lite' ), esc_html__( '1 Comment', 'article-lite' ), esc_html__( '% Comments', 'article-lite' ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit this post %s', 'article-lite' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;



/**
 * Multi-page navigation.
 */
if ( ! function_exists( 'article_lite_multipage_nav' ) ) :
function article_lite_multipage_nav() {
	wp_link_pages( array(
		'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'article-lite' ) . '</span>',
		'after'       => '</div>',
		'link_before' => '<span>',
		'link_after'  => '</span>',
		'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'article-lite' ) . ' </span>%',
		'separator'   => ', ',
	) );
}
endif;

/**
 * Blog pagination when more than one page of post summaries.
 * Add classes to next_posts_link and previous_posts_link
 */
add_filter('next_posts_link_attributes', 'article_lite_posts_link_attributes_1');
add_filter('previous_posts_link_attributes', 'article_lite_posts_link_attributes_2');

function article_lite_posts_link_attributes_1() {
    return 'class="post-nav-older"';
}
function article_lite_posts_link_attributes_2() {
    return 'class="post-nav-newer"';
}

// Output the pagination navigation
if ( ! function_exists( 'article_lite_blog_pagination' ) ) :
function article_lite_blog_pagination() {
		next_post_link();
		previous_post_link();	
}
endif;

/**
 * Single Post previous or next navigation.
 */

if ( ! function_exists( 'article_lite_post_pagination' ) ) :
function article_lite_post_pagination() {
	the_post_navigation( array(	
		'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next Article', 'article-lite' ) . '</span> ' .
			'<span class="screen-reader-text">' . __( 'Next Article:', 'article-lite' ) . '</span> ' .
			'<span class="post-title">%title</span>',
			
		'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous Article', 'article-lite' ) . '</span> ' .
			'<span class="screen-reader-text">' . __( 'Previous Article:', 'article-lite' ) . '</span> ' .
			'<span class="post-title">%title</span>',
	) );
}
endif;


/**
 * Shim for `the_archive_title()`.
 *
 * Display the archive title based on the queried object.
 * Custom filter for changing the default archive title labels.
 *
 * @param string $before Optional. Content to prepend to the title. Default empty.
 * @param string $after  Optional. Content to append to the title. Default empty.
 */
 
if ( ! function_exists( 'article_lite_the_archive_title' ) ) :

function article_lite_the_archive_title( $before = '', $after = '' ) {
	if ( is_category() ) {
		$title = sprintf( ( '%s' ), single_cat_title( '', false ) );
	} elseif ( is_tag() ) {
		$title = sprintf( esc_html__( 'Posts Tagged with %s', 'article-lite' ), single_tag_title( '', false ) );
	} elseif ( is_author() ) {
		$title = sprintf( esc_html__( 'Articles by %s', 'article-lite' ), '<span class="vcard">' . get_the_author() . '</span>' );
	} elseif ( is_year() ) {
		$title = sprintf( esc_html__( 'Articles from: %s', 'article-lite' ), get_the_date( _x( 'Y', 'yearly archives date format', 'article-lite' ) ) );
	} elseif ( is_month() ) {
		$title = sprintf( esc_html__( 'Articles from %s', 'article-lite' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'article-lite' ) ) );
	} elseif ( is_day() ) {
		$title = sprintf( esc_html__( 'Articles from %s', 'article-lite' ), get_the_date( _x( 'F j, Y', 'daily archives date format', 'article-lite' ) ) );
	} elseif ( is_tax( 'post_format' ) ) {
		if ( is_tax( 'post_format', 'post-format-aside' ) ) {
			$title = _x( 'Asides', 'post format archive title', 'article-lite' );
		} elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
			$title = _x( 'Galleries', 'post format archive title', 'article-lite' );
		} elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
			$title = _x( 'Images', 'post format archive title', 'article-lite' );
		} elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
			$title = _x( 'Videos', 'post format archive title', 'article-lite' );
		} elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
			$title = _x( 'Quotes', 'post format archive title', 'article-lite' );
		} elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
			$title = _x( 'Links', 'post format archive title', 'article-lite' );
		} elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
			$title = _x( 'Statuses', 'post format archive title', 'article-lite' );
		} elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
			$title = _x( 'Audio', 'post format archive title', 'article-lite' );
		} elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
			$title = _x( 'Chats', 'post format archive title', 'article-lite' );
		}
	} elseif ( is_post_type_archive() ) {
		$title = sprintf( esc_html__( 'Archives: %s', 'article-lite' ), post_type_archive_title( '', false ) );
	} elseif ( is_tax() ) {
		$tax = get_taxonomy( get_queried_object()->taxonomy );
		/* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
		$title = sprintf( esc_html__( '%1$s: %2$s', 'article-lite' ), $tax->labels->singular_name, single_term_title( '', false ) );
	} else {
		$title = esc_html__( 'Archives', 'article-lite' );
	}

	/**
	 * Filter the archive title.
	 *
	 * @param string $title Archive title to be displayed.
	 */
	$title = apply_filters( 'get_the_archive_title', $title );

	if ( ! empty( $title ) ) {
		echo $before . $title . $after;  // WPCS: XSS OK.
	}
}
endif;

if ( ! function_exists( 'article_lite_archive_description' ) ) :
/**
 * Shim for `the_archive_description()`.
 *
 * Display category, tag, or term description.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 *
 * @param string $before Optional. Content to prepend to the description. Default empty.
 * @param string $after  Optional. Content to append to the description. Default empty.
 */
function article_lite_archive_description( $before = '', $after = '' ) {
	$description = apply_filters( 'get_the_archive_description', term_description() );

	if ( ! empty( $description ) ) {
		/**
		 * Filter the archive description.
		 *
		 * @see term_description()
		 *
		 * @param string $description Archive description to be displayed.
		 */
		echo $before . $description . $after;  // WPCS: XSS OK.
	}
}
endif;


/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function article_lite_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'article_lite_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'article_lite_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so article_lite_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so article_lite_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in article_lite_categorized_blog.
 */
function article_lite_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'article_lite_categories' );
}
add_action( 'edit_category', 'article_lite_category_transient_flusher' );
add_action( 'save_post',     'article_lite_category_transient_flusher' );


// posted by
if ( ! function_exists( 'article_lite_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function article_lite_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'By %s', 'post author', 'article-lite' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

	}
endif;
