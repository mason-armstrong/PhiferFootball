<?php

	do_action( 'news_vibe_doctype' );

?>
<head>
<?php

	do_action( 'news_vibe_before_wp_head' );

	wp_head(); 
?>
</head>

<body <?php body_class(); ?>>

<?php do_action( 'wp_body_open' ); ?>

<?php

	do_action( 'news_vibe_page_start_action' ); 

	do_action( 'news_vibe_before_header' );

	do_action( 'news_vibe_header_action' );


	do_action( 'news_vibe_content_start_action' );


	do_action( 'news_vibe_header_image_action' );
	
	if ( news_vibe_is_frontpage() ) {

		$sorted = array( 'breakingnews','main_content','related_post' );
	
		foreach ( $sorted as $section ) {	
			if ( $section == 'main_content' ) {
				add_action( 'better_news_vibe_primary_content', 'better_news_vibe_add_'. $section .'_section' );
			}else{
				add_action( 'better_news_vibe_primary_content', 'news_vibe_add_'. $section .'_section' );
			}		
			
		}

		do_action( 'better_news_vibe_primary_content' );
	}

