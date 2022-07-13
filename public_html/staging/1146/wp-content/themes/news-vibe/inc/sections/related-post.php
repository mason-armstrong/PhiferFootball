<?php
/**
* Related post section
*
* This is the template for the content of related_post section
*
* @package Theme Palace
* @subpackage News Vibe
* @since News Vibe 1.0.0
*/
if ( ! function_exists( 'news_vibe_add_related_post_section' ) ) :
/**
* Add related_post section
*
*@since News Vibe 1.0.0
*/
function news_vibe_add_related_post_section() {
    $options = news_vibe_get_theme_options();
    // Check if related_post is enabled on frontpage
    $related_post_enable = apply_filters( 'news_vibe_section_status', true, 'related_post_section_enable' );

    if ( true !== $related_post_enable ) {
        return false;
    }
    // Get related_post section details
    $section_details = array();
    $section_details = apply_filters( 'news_vibe_filter_related_post_section_details', $section_details );

    if ( empty( $section_details ) ) {
        return;
    }

// Render related_post section now.
    news_vibe_render_related_post_section( $section_details );
}
endif;

if ( ! function_exists( 'news_vibe_get_related_post_section_details' ) ) :
/**
* related_post section details.
*
* @since News Vibe 1.0.0
* @param array $input related_post section details.
*/
function news_vibe_get_related_post_section_details( $input ) {
    $options = news_vibe_get_theme_options();

// Content type.
    $related_post_content_type  = $options['related_post_content_type'];
    $related_post_count = ! empty( $options['related_post_count'] ) ? $options['related_post_count'] : 4;

    $content = array();
    switch ( $related_post_content_type ) {

        case 'page':
        $page_ids = array();

        for ( $i = 1; $i <= $related_post_count; $i++ ) {
            if ( ! empty( $options['related_post_content_page_' . $i] ) )
                $page_ids[] = $options['related_post_content_page_' . $i];
        }

        $args = array(
            'post_type'         => 'page',
            'post__in'          => ( array ) $page_ids,
            'posts_per_page'    => absint( $related_post_count ),
            'orderby'           => 'post__in',
            );                    
        break;

        case 'post':
        $post_ids = array();

        for ( $i = 1; $i <= $related_post_count; $i++ ) {
            if ( ! empty( $options['related_post_content_post_' . $i] ) )
                $post_ids[] = $options['related_post_content_post_' . $i];
        }

        $args = array(
            'post_type'         => 'post',
            'post__in'          => ( array ) $post_ids,
            'posts_per_page'    => absint( $related_post_count ),
            'orderby'           => 'post__in',
            'ignore_sticky_posts'   => true,
            );                    
        break;

        case 'category':
        $cat_id = ! empty( $options['related_post_content_category'] ) ? $options['related_post_content_category'] : '';
        $args = array(
            'post_type'         => 'post',
            'posts_per_page'    => absint( $related_post_count ),
            'cat'               => absint( $cat_id ),
            'ignore_sticky_posts'   => true,
            );                    
        break;

        case 'recent':
        $cat_ids = ! empty( $options['related_post_category_exclude'] ) ? $options['related_post_category_exclude'] : array();
        $args = array(
            'post_type'         => 'post',
            'posts_per_page'    => absint( $related_post_count ),
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
    $page_post['auth_id']   = get_the_author_meta('ID');
    $page_post['url']       = get_the_permalink();
    $page_post['excerpt']   = get_the_content();
    $page_post['image']     = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_id(), 'post-thumbnail' ) : get_template_directory_uri() . '/assets/uploads/no-featured-image-590x650.jpg';

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
// related_post section content details.
add_filter( 'news_vibe_filter_related_post_section_details', 'news_vibe_get_related_post_section_details' );


if ( ! function_exists( 'news_vibe_render_related_post_section' ) ) :
/**
* Start related_post section
*
* @return string related_post content
* @since News Vibe 1.0.0
*
*/
function news_vibe_render_related_post_section( $content_details = array() ) {
    $options = news_vibe_get_theme_options();
    $related_post_content_type  = $options['related_post_content_type'];
    $column = ! empty( $options['related_post_column'] ) ? $options['related_post_column'] : 'col-4';

    if ( empty( $content_details ) ) {
        return;
    } ?>

    <div id="related-posts" class="grid-layout">
        <div class="wrapper">
            <?php if ( ! empty( $options['related_post_title'] ) ) : ?>
                <div class="section-header">
                    <h2 class="section-title"><?php echo esc_html( $options['related_post_title'] ); ?></h2>
                </div><!-- .section-header -->
            <?php endif; ?>

            <div class="section-content <?php echo esc_attr( $column ); ?> clear">
                <?php foreach ( $content_details as $content ) : ?>
                    <article class="has-post-thumbnail">
                        <div class="featured-image" style="background-image: url('<?php echo esc_url( $content['image'] ); ?>');">
                            <a href="<?php echo esc_url( $content['url'] ); ?>" class="post-thumbnail-link"></a>
                        </div><!-- .featured-image -->

                        <div class="entry-container">
                            <div class="entry-meta">
                            <?php if ( $related_post_content_type !== 'page' ) : ?>
                                <span class="cat-links">
                                    <?php the_category( '', '', $content['id'] ); ?>
                                </span><!-- .cat-links -->
                            <?php endif; ?>

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
        </div><!-- .wrapper -->
    </div><!-- #most-viewed-posts -->




    <?php }
    endif;