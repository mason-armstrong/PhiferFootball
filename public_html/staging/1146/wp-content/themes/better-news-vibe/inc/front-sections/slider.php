<?php

if( get_theme_mod( 'better_news_vibe_slider_section_enable', false ) !== false ):


$content_details = array();


$cat_ids = ! empty( get_theme_mod( 'better_news_vibe_slider_content_category' ) ) ? get_theme_mod( 'better_news_vibe_slider_content_category' ) : '';
$args = array(
    'post_type'         => 'post',
    'posts_per_page'    => 3,
    'cat'               => absint( $cat_ids ),
    'ignore_sticky_posts'   => true,
    );                    


$query = new WP_Query( $args );
if ( $query->have_posts() ) : 
    while ( $query->have_posts() ) : $query->the_post();
        $page_post['id']        = get_the_id();
        $page_post['auth_id']   = get_the_author_meta('ID');
        $page_post['title']     = get_the_title();
        $page_post['url']       = get_the_permalink();
        $page_post['excerpt']   = get_the_content();
        $page_post['image']     = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_id(), 'full' ) : get_template_directory_uri() . '/assets/uploads/no-featured-image-590x650.jpg';

array_push( $content_details, $page_post );
endwhile;
endif;
wp_reset_postdata();

?>

<div id="posts-slider" class="relative">
    <?php if ( ! empty( get_theme_mod( 'better_news_vibe_slider_title', '' ) ) ) : ?>
        <div class="section-header">
            <h2 class="section-title"><?php echo esc_html( get_theme_mod( 'better_news_vibe_slider_title', '' ) ); ?></h2>
        </div><!-- .section-header -->
    <?php endif; ?>
    <div class="featured-slider" data-slick='{"slidesToShow": 1, "slidesToScroll": 1, "infinite": true, "speed": 1000, "dots": false, "arrows":true, "autoplay": true, "draggable": true, "fade": false }'>
        <?php foreach ( $content_details as $content ) : ?>

            <article style="background-image: url('<?php echo esc_url( $content['image'] ); ?>');">
                <div class="entry-container">
                    <div class="entry-meta">        
                        <span class="cat-links">
                            <?php the_category( '', '', $content['id'] ); ?>
                        </span><!-- .cat-links -->    
                        <?php news_vibe_posted_on( $content['id'] ); ?>
                    </div><!-- .entry-meta -->

                    <header class="entry-header">
                        <h2 class="entry-title"><a href="<?php echo esc_url( $content['url'] ); ?>"><?php echo esc_html( $content['title'] ); ?></a></h2>
                    </header>
                    <div class="footer-meta">   
                        <span class="min-read"><?php echo news_vibe_time_interval( $content['excerpt'] ); echo esc_html__(' min to read', 'better-news-vibe'); ?></span>
                        <?php echo news_vibe_author( $content['auth_id'] ); ?>
                    </div>                    
                </div><!-- .entry-container -->
            </article>

        <?php endforeach; ?>
    </div><!-- .featured-slider -->
</div>
<?php endif; ?>
