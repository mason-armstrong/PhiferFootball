<?php
/**
* Most Viewed section
*
* This is the template for the content of most_viewed section
*
* @package Theme Palace
* @subpackage News Vibe
* @since News Vibe 1.0.0
*/

$options = news_vibe_get_theme_options();
if($options['most_viewed_section_enable'] !== false):

// Content type.
$most_viewed_content_type  = $options['most_viewed_content_type'];

$content_details = array();
switch ( $most_viewed_content_type ) {

    case 'category':
    $cats_id = ! empty( $options['most_viewed_content_category'] ) ? $options['most_viewed_content_category'] : '';
    $args = array(
        'post_type'         => 'post',
        'posts_per_page'    => 4,
        'cat'               => absint( $cats_id ),
        'ignore_sticky_posts'   => true,
        );                    
    break;

    case 'recent':
    $cat_ids = ! empty( $options['most_viewed_category_exclude'] ) ? $options['most_viewed_category_exclude'] : array();
    $args = array(
        'post_type'         => 'post',
        'posts_per_page'    => 4,
        'category__not_in'  => ( array ) $cat_ids,
        'ignore_sticky_posts'   => true,
        );                    
    break;

    default:
    break;
}


// Run The Loop.
$query = new WP_Query( $args );
if ( $query->have_posts() ) : 
    while ( $query->have_posts() ) : $query->the_post();
$page_post['id']        = get_the_id();
$page_post['title']     = get_the_title();
$page_post['excerpt']   = get_the_content();
$page_post['auth_id']   = get_the_author_meta('ID');
$page_post['url']       = get_the_permalink();
$page_post['image'] = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_id(), 'post-thumbnail' ) : get_template_directory_uri() . '/assets/uploads/no-featured-image-590x650.jpg';

// Push to the main array.
array_push( $content_details, $page_post );
endwhile;
endif;
wp_reset_postdata();
?>

<div id="most-viewed-posts" class="grid-layout">
    <?php if ( ! empty( $options['most_viewed_title'] ) ) : ?>
        <div class="section-header">
            <h2 class="section-title"><?php echo esc_html( $options['most_viewed_title'] ); ?></h2>
        </div><!-- .section-header -->
    <?php endif; ?>
    <div class="section-content col-2 clear">
        <?php foreach ( $content_details as $content ) : ?>
            <article class="has-post-thumbnail">
                <div class="featured-image" style="background-image: url('<?php echo esc_url( $content['image'] ); ?>');">
                    <a href="<?php echo esc_url( $content['url'] ); ?>" class="post-thumbnail-link"></a>
                    <span class="min-read"><?php echo news_vibe_time_interval( $content['excerpt'] ); echo esc_html__(' min to read', 'news-vibe'); ?></span>
                </div><!-- .featured-image -->
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
                    <?php echo news_vibe_author( $content['auth_id'] ); ?>
                </div><!-- .entry-container -->
            </article>
        <?php endforeach; ?>
    </div><!-- .section-content -->
</div><!-- #most-viewed-posts -->

<?php endif; ?>
