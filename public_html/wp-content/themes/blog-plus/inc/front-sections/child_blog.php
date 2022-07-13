<?php

if ( ! function_exists( 'blog_plus_add_child_blog_section' ) ) :

    function blog_plus_add_child_blog_section() {
        // Check if blog is enabled on frontpage
         if ( get_theme_mod( 'child_blog_section_enable' ) == false ) {
            return false;
        }
        // Get blog section details
        $section_details = array();
        $section_details = apply_filters( 'blog_plus_filter_child_blog_section_details', $section_details );

        if ( empty( $section_details ) ) {
            return;
        }

        // Render blog section now.
        blog_plus_render_child_blog_section( $section_details );
    }
endif;

if ( ! function_exists( 'blog_plus_get_child_blog_section_details' ) ) :

    function blog_plus_get_child_blog_section_details( $input ) {

        // Content type.
        $content = array();

        $cat_id = ! empty( get_theme_mod( 'child_blog_content_category' ) ) ? get_theme_mod( 'child_blog_content_category' ) : '';
                $args = array(
                    'post_type'             => 'post',
                    'posts_per_page'        => 3,
                    'cat'                   => absint( $cat_id ),
                    'ignore_sticky_posts'   => true,
                    ); 

        // Run The Loop.
        $query = new WP_Query( $args );
        if ( $query->have_posts() ) : 
            while ( $query->have_posts() ) : $query->the_post();
                $page_post['id']        = get_the_id();
                $page_post['title']     = get_the_title();
                $page_post['url']       = get_the_permalink();
                $page_post['author']    = blog_diary_author();
                $page_post['excerpt']   = blog_diary_trim_content( 20 );
                $page_post['image']     = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_id(), 'post-thumbnail' ) : '';

                // Push to the main array.
                array_push( $content, $page_post );
            endwhile;
        endif;
        wp_reset_postdata();

        if ( ! empty( $content ) ) {
            $input = $content;
        }
        return $input;
    }
endif;
// blog section content details.
add_filter( 'blog_plus_filter_child_blog_section_details', 'blog_plus_get_child_blog_section_details' );


if ( ! function_exists( 'blog_plus_render_child_blog_section' ) ) :

   function blog_plus_render_child_blog_section( $content_details = array() ) {
        $readmore = ! empty( get_theme_mod( 'child_blog_btn_title' ) ) ? get_theme_mod( 'child_blog_btn_title' ) : esc_html__( 'Read More', 'blog-plus' );

        if ( empty( $content_details ) ) {
            return;
        } ?>

        <div id="blog_diary_blog_section">

        <div id="blog" class="page-section">
            <div class="archive-blog-wrapper">
                <?php if ( ! empty( get_theme_mod( 'child_blog_title' ) ) ) : ?>
                    <div class="section-header">
                        <h2 class="section-title"><?php echo esc_html( get_theme_mod( 'child_blog_title' ) ); ?></h2>
                    </div><!-- .section-header -->
                <?php endif; ?>

                <div class="section-content">
                    <?php foreach ( $content_details as $content ) : ?>
                        <article class="<?php echo ! empty( $content['image'] ) ? 'has' : 'no'; ?>-post-thumbnail">
                            <div class="post-wrapper">
                                <?php if ( ! empty( $content['image'] ) ) : ?>
                                    <div class="featured-image" style="background-image:url('<?php echo esc_url( $content['image'] ); ?>');">
                                        <a href="<?php echo esc_url( $content['url'] ); ?>" class="post-thumbnail-link"></a>
                                    </div><!-- .featured-image-->
                                <?php endif; ?>

                               <div class="entry-container">
                                    <header class="entry-header">
                                        <h2 class="entry-title"><a href="<?php echo esc_url( $content['url'] ); ?>"><?php echo esc_html( $content['title'] ); ?></a></h2>
                                    </header>

                                    <div class="entry-meta">
                                       <?php 
                                            echo wp_kses_post( $content['author'] );
                                            blog_diary_posted_on( $content['id'] ); 
                                        ?>
                                        <span class="cat-links">
                                            <?php the_category( '', '', $content['id'] ); ?>
                                        </span><!-- .cat-links --> 
                                    </div><!-- .entry-meta -->

                                    <div class="entry-content">
                                        <p><?php echo esc_html( $content['excerpt'] ); ?></p>
                                    </div>
                                        <a href="<?php echo esc_url( $content['url'] ); ?>" class="btn">
                                            <span class="screen-reader-text"><?php echo esc_html( $content['title'] ); ?></span>
                                            <?php echo esc_html( $readmore ); ?>
                                        </a>
                                </div><!-- .entry-container -->
                            </div>
                        </article>
                    <?php  endforeach;  ?>
                </div><!-- .section-content -->
            </div><!-- .archive-wrapper -->

            <div class="load-more">
                <button id="LBloadmore" class="btn"><?php echo esc_html( get_theme_mod( 'child_blog_load_more_btn', __('Load More', 'blog-plus') ) ); ?></button>
            </div>
                            
        </div><!-- #blog -->

        </div>

    <?php }
endif;