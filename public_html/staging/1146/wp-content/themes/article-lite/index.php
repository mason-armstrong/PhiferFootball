<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Article Lite
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main" itemprop="mainEntityOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog">

			<div class="container">
            	<div class="row">
                	<div class="col-lg-8 col-md-8 stickey_wrap_main_cont">
                    	<div class="theiaStickySidebar">

							<?php
							if ( have_posts() ) :

								if ( is_home() && ! is_front_page() ) :
									?>
									<header>
										<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
									</header>
									<?php
								endif;

								/* Start the Loop */
								while ( have_posts() ) :
									the_post();

									/*
									 * Include the Post-Type-specific template for the content.
									 * If you want to override this in a child theme, then include a file
									 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
									 */
									get_template_part( 'template-parts/content', get_post_type() );

								endwhile; ?>
                            
	                            <nav class="main-pagination number">
	                                <div class="inner">
	                        	       <?php echo paginate_links(); ?>
	                                </div>
	                            </nav>
                        	<?php else : ?>
                        
                        		<?php get_template_part( 'template-parts/content', 'none' ); ?>
                        
                        	<?php endif; ?>
                        </div>
                    </div>

                    <?php get_sidebar( 'right' ); ?>

            	</div><!-- row -->    
            </div><!-- container -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
