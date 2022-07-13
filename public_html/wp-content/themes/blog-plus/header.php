<?php
	
	do_action( 'blog_diary_doctype' );

?>
<head>
<?php
	
	do_action( 'blog_diary_before_wp_head' );

	wp_head(); 
?>
</head>

<body <?php body_class(); ?>>

<?php do_action( 'wp_body_open' ); ?>
<?php
	
	do_action( 'blog_diary_page_start_action' ); 

	do_action( 'blog_diary_before_header' );

	do_action( 'blog_diary_header_action' );

	do_action( 'blog_diary_content_start_action' );

	do_action( 'blog_diary_header_image_action' );
