<?php

get_header(); ?>

<div id="inner-content-wrapper" class="wrapper relative clear">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		<?php

			if ( blog_diary_is_latest_posts() ) {

				get_template_part( 'template-parts/content', 'home' );

			} elseif ( blog_diary_is_frontpage() ) {
			
				$options = blog_diary_get_theme_options();
		    	$sorted = array( 'slider','latest_posts','must_read_posts','child_blog','instagram' );
	
		foreach ( $sorted as $section ) {
			if ( $section == 'child_blog' || $section == 'instagram' ) {
				add_action( 'blog_plus_primary_content', 'blog_plus_add_'. $section .'_section' );
			}else{
				add_action( 'blog_plus_primary_content', 'blog_diary_add_'. $section .'_section' );
			}	
		}
				do_action( 'blog_plus_primary_content' );
			}
		?>
			
		</main><!-- #main -->
	</div><!-- #primary -->
	<?php
	if ( blog_diary_is_sidebar_enable() ) {
		get_sidebar();
	} ?>
</div><!-- .page-section -->
<?php
get_footer();
