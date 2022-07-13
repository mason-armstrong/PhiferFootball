<?php
/*
	Template Name: Newslist Full Width
*/

get_header(); 
do_action( Newslist_Helper::fn_prefix( 'before-content' ) ); ?>

<div id="content">
	<?php
	if ( have_posts() ) {
		// Load posts loop.
		while ( have_posts() ) {
			the_post();
			the_content();
		}
	}
	?>
</div>
<?php 
do_action( Newslist_Helper::fn_prefix( 'after-content' ) );
get_footer();