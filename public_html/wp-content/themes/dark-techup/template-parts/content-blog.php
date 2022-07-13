<?php
$techup_enable_blog_section = get_theme_mod( 'techup_enable_blog_section', true );
$techup_blog_cat 		= get_theme_mod( 'techup_blog_cat', 'uncategorized' );
if($techup_enable_blog_section == true) 
{
	$techup_blog_title 	= get_theme_mod( 'techup_blog_title', esc_html__( 'Blog','dark-techup'));
	$techup_blog_subtitle 	= get_theme_mod( 'techup_blog_subtitle' );
	$techup_rm_button_label 	= get_theme_mod( 'techup_rm_button_label', esc_html__( 'Read More','dark-techup'));
	$techup_blog_count 	 = apply_filters( 'techup_blog_count', 3 );
?>
<!-- blog start-->
    <section class="blog-sec">
        <div class="container">
          <div class="section-heading text-center">
			<?php if($techup_blog_title) : ?>
				<span class="sm-title"><?php echo esc_html( $techup_blog_title ); ?></span>
			<?php endif; ?>	
			<?php if($techup_blog_subtitle) : ?>	
            <h3 class="bg-title"><?php echo esc_html( $techup_blog_subtitle ); ?></h3>
            <?php endif; ?> 
          </div>
            <div class="row">
				<?php 
				if( !empty( $techup_blog_cat ) ) 
					{
					$blog_args = array(
						'post_type' 	 => 'post',
						'category_name'	 => esc_attr( $techup_blog_cat ),
						'posts_per_page' => absint( $techup_blog_count ),
					);

					$blog_query = new WP_Query( $blog_args );
					if( $blog_query->have_posts() ) 
					{
						while( $blog_query->have_posts() ) 
						{
							$blog_query->the_post();
							?>
                  <div class="col-lg-4 col-md-6 col-sm-12">
                    <article class="blog-item blog-1">
                        <div class="post-img">
                            <?php the_post_thumbnail(); ?>
                        </div>
                        <div class="post-content pt-4 text-left">
                            <h5>
                                <a class="heading" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h5>
                            <div class="post-meta-list">
                              <span class="meta-date">
                                <i class="fa fa-calendar"></i>
                                <span class="meta-date-text"><?php echo esc_html(get_the_date()); ?></span>
                              </span>
                              <span>                    
                                <i class="fa fa-user"></i>
                                <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" rel="category tag"><?php the_author(); ?></a>
                              </span>
                            </div>
                        </div>
                    </article>
                  </div>
                <?php
				}
			}
			wp_reset_postdata();
		}
		 ?>      
                     
            </div>
        </div>
    </section>
    <!-- blog end-->


<?php } ?>