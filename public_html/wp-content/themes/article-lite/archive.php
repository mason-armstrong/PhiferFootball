<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Article Lite
 */

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" itemprop="mainEntityOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog">
  
        <div class="container">
            <div class="row">

            	<div class="col-lg-8 col-md-8">

	            	<header>
						<?php
						the_archive_title( '<h1 class="page-title">', '</h1>' );
						the_archive_description( '<div class="archive-description">', '</div>' );
						?>
					</header><!-- .page-header -->

					<?php
					/* Start the Loop */
					if( have_posts() ):
						while ( have_posts() ) :
							the_post();

								/*
								 * Include the Post-Type-specific template for the content.
								 * If you want to override this in a child theme, then include a file
								 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
								 */
								get_template_part( 'template-parts/content', get_post_type() );

						endwhile;

						the_posts_navigation();

					else :

						get_template_part( 'template-parts/content', 'none' );

					endif;
					?>
				</div>

				<?php get_sidebar( 'right' ); ?>

			</div>
		</div>

	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
