<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Article Lite
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope="itemscope" itemtype="http://schema.org/CreativeWork">

	<?php // Check for featured image
    
    if ( has_post_thumbnail() ) {        
        echo '<div class="featured-image-wrapper">';
        the_post_thumbnail( 'post-thumbnail' );
        echo '</div>';
    }
    ?>


	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title page-title" itemprop="headline">', '</h1>' ); ?>
	</header><!-- .entry-header -->


	<div class="entry-content" itemprop="text">
		<?php
		the_content();

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'article-lite' ),
			'after'  => '</div>',
		) );
		?>
	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer" itemscope="itemscope" itemtype="http://schema.org/WPFooter">
			<?php
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
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
