<?php get_header(); ?>

<main id="site-main">

	<div class="site-page-content">
		<div class="site-section-wrapper site-section-wrapper-main clearfix">

			<?php
			// Function to display the START of the content column markup
			ilovewp_helper_display_page_content_wrapper_start();

			if ( ( is_front_page() || is_home() ) && !is_paged() ) {
				if ( 1 == get_theme_mod( 'newstoday-display-featured-posts', 1 ) ) { 
					get_template_part( 'template-parts/home-featured-posts' );
				}

				if ( is_active_sidebar('ads-home-under-featured') ) {
					echo '<div id="site-ads-home-under-featured">';
					dynamic_sidebar( 'ads-home-under-featured' );
					echo '</div><!-- #site-ads-home-under-featured -->';
				}

			}

			if ( have_posts() ) { 
				$i = 0; 
			
				if ( is_home() && ! is_front_page() ) { ?>
				<h1 class="page-title archives-title"><?php single_post_title(); ?></h1>
				<?php } ?>

				<?php if ( is_home() ) { ?><p class="page-title archives-title"><span class="page-title-span"><?php esc_html_e('Recent Posts','newstoday'); ?></span></p><?php } ?>

				<?php get_template_part('loop');

			}

			// Function to display the END of the content column markup
			ilovewp_helper_display_page_content_wrapper_end();

			// Function to display the SIDEBAR (if not hidden)
			ilovewp_helper_display_page_sidebar_column();

			?>

		</div><!-- .site-section-wrapper .site-section-wrapper-main -->
	</div><!-- .site-page-content -->

</main><!-- #site-main -->

<?php get_footer(); ?>