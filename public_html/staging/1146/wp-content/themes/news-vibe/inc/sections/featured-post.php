<?php
/**
* Featured Post section
*
* This is the template for the content of featured_post section
*
* @package Theme Palace
* @subpackage News Vibe
* @since News Vibe 1.0.0
*/


$options = news_vibe_get_theme_options();

if( $options['featured_post_section_enable'] !== false ):

    $content_details = array();
$page_ids = array();

for ( $i = 1; $i <= 2; $i++ ) {
    if ( ! empty( $options['featured_post_content_post_' . $i] ) )
        $page_ids[] = $options['featured_post_content_post_' . $i];
}

$args = array(
    'post_type'         => 'post',
    'post__in'          => ( array ) $page_ids,
    'posts_per_page'    => 2,
    'orderby'           => 'post__in',
    );


// Run The Loop.
$query = new WP_Query( $args );
if ( $query->have_posts() ) : 
    while ( $query->have_posts() ) : $query->the_post();
$page_post['id']        = get_the_id();
$page_post['auth_id']   = get_the_author_meta('ID');
$page_post['title']     = get_the_title();
$page_post['url']       = get_the_permalink();
$page_post['excerpt']   = get_the_content();
$page_post['image']     = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_id(), 'post-thumbnail' ) : get_template_directory_uri() . '/assets/uploads/no-featured-image-590x650.jpg';

// Push to the main array.
array_push( $content_details, $page_post );
endwhile;
endif;
wp_reset_postdata();
?>

<div id="featured-posts" class="relative">
    <?php foreach ( $content_details as $content ) : ?>
        <article>
            <div class="featured-post-wrapper" style="background-image: url('<?php echo esc_url( $content['image'] ); ?>');">
                <div class="entry-container">
                    <div class="entry-meta">

                        <?php news_vibe_posted_on( $content['id'] ); ?>
                    </div><!-- .entry-meta -->

                    <header class="entry-header">
                        <h2 class="entry-title"><a href="<?php echo esc_url( $content['url'] ); ?>"><?php echo esc_html( $content['title'] ); ?></a></h2>
                    </header>

                    <div class="footer-meta">   
                        <span class="min-read"><?php echo news_vibe_time_interval( $content['excerpt'] ); echo esc_html__(' min to read', 'news-vibe'); ?></span>
                        <?php echo news_vibe_author( $content['auth_id'] ); ?>
                    </div>
                    
                </div><!-- .entry-container -->
            </div><!-- .featured-post-wrapper -->
        </article>
    <?php endforeach; ?>
</div><!-- #featured-posts -->

<?php endif; ?>



