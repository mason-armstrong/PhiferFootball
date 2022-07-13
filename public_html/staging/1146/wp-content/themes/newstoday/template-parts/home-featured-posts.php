<?php
/**
 * The template used for displaying the Featured Posts on the homepage.
 *
 * @package NewsToday
 */

$featured_category = get_theme_mod( 'newstoday-featured-category', 1 );
$featured_tag = strtolower( get_theme_mod( 'newstoday-featured-tag', false ) );

$featured_args = array(
	'post_type'      => 'post',
	'posts_per_page' => 4,
	'order'          => 'DESC',
	'orderby'        => 'date'
);

if ( isset( $featured_tag ) && $featured_tag != 'none' ) {
	$featured_args['tag_id'] = esc_attr($featured_tag);
} elseif ( isset( $featured_category ) ) {
	$featured_args['cat'] = absint($featured_category);
}

$custom_loop = new WP_Query( $featured_args );

$i = 0;

if ( $custom_loop->have_posts() ) { ?>

	<div id="home-featured-posts">

		<div class="home-featured-posts-wrapper">

			<ul class="site-featured-posts clearfix">
			
			<?php while ( $custom_loop->have_posts() ) : $custom_loop->the_post(); 

				$i++;

				if ( $i == 1 ) {
					$thumb_size = 'newstoday-thumb-featured';
				} else {
					$thumb_size = 'post-thumbnail';
				}

				$classes = array( 'site-archive-post', 'ilovewp-featured-post', 'site-archive-post-' . $i ); 
				
				if ( !has_post_thumbnail() ) {
					$classes[] = 'post-nothumbnail';
				} else {
					$classes[] = 'has-post-thumbnail';
				} ?><li <?php post_class($classes); ?>>
					<div class="site-archive-post-wrapper clearfix">
					<?php if ( has_post_thumbnail() ) { ?>
					<div class="entry-thumbnail">
						<div class="entry-thumbnail-wrapper"><?php 

							echo '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">';
							the_post_thumbnail( $thumb_size );
							echo '</a>'; ?>
						</div><!-- .entry-thumbnail-wrapper -->
					</div><!-- .entry-thumbnail --><?php } ?><!-- ws fix
					--><div class="entry-preview">
						<div class="entry-preview-wrapper clearfix">
							<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
							<?php if ( $i == 1 ) { echo ilovewp_helper_display_postmeta($post); } ?>
							<?php if ( $i == 1 ) { echo ilovewp_helper_display_excerpt($post); } ?>
						</div><!-- .entry-preview-wrapper .clearfix -->
					</div><!-- .entry-preview -->
				</div><!-- .site-archive-post-wrapper .clearfix -->
				</li><!-- .site-archive-post .ilovewp-featured-post .clearfix --><?php endwhile; ?>

			<?php wp_reset_postdata(); ?>

			</ul><!-- .site-featured-posts .clearfix -->

		</div><!-- .home-featured-posts-wrapper .clearfix -->

	</div><!-- #home-featured-posts .clearfix -->

<?php } // if have_posts()