<?php
/**
 * Headline section
 *
 * This is the template for the content of breakingnews section
 *
 * @package Theme Palace
 * @subpackage News Vibe
 * @since News Vibe 1.0.0
 */
if ( ! function_exists( 'news_vibe_add_breakingnews_section' ) ) :
    /**
    * Add breakingnews section
    *
    *@since News Vibe 1.0.0
    */
    function news_vibe_add_breakingnews_section() {
    	$options = news_vibe_get_theme_options();
        // Check if breakingnews is enabled on frontpage
        $breakingnews_enable = apply_filters( 'news_vibe_section_status', true, 'breakingnews_section_enable' );

        if ( true !== $breakingnews_enable ) {
            return false;
        }
        // Get breakingnews section details
        $section_details = array();
        $section_details = apply_filters( 'news_vibe_filter_breakingnews_section_details', $section_details );

        if ( empty( $section_details ) ) {
            return;
        }

        // Render breakingnews section now.
        news_vibe_render_breakingnews_section( $section_details );
    }
endif;

if ( ! function_exists( 'news_vibe_get_breakingnews_section_details' ) ) :
    /**
    * breakingnews section details.
    *
    * @since News Vibe 1.0.0
    * @param array $input breakingnews section details.
    */
    function news_vibe_get_breakingnews_section_details( $input ) {
        $options = news_vibe_get_theme_options();

        // Content type.
        
        $content = array();

        $cat_id = ! empty( $options['breakingnews_content_category'] ) ? $options['breakingnews_content_category'] : '';
        $args = array(
            'post_type'         => 'post',
            'posts_per_page'    => 5,
            'cat'               => absint( $cat_id ),
            'ignore_sticky_posts'   => true,
            );    

            // Run The Loop.
            $query = new WP_Query( $args );
            if ( $query->have_posts() ) : 
                while ( $query->have_posts() ) : $query->the_post();
                    $page_post['title']     = get_the_title();
                   $page_post['image']      = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_id(), 'post-thumbnail' ) : get_template_directory_uri() . '/assets/uploads/no-featured-image-590x650.jpg';
                    $page_post['url']       = get_the_permalink();

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
// breakingnews section content details.
add_filter( 'news_vibe_filter_breakingnews_section_details', 'news_vibe_get_breakingnews_section_details' );


if ( ! function_exists( 'news_vibe_render_breakingnews_section' ) ) :
  /**
   * Start breakingnews section
   *
   * @return string breakingnews content
   * @since News Vibe 1.0.0
   *
   */
function news_vibe_render_breakingnews_section( $content_details = array() ) {
    $options = news_vibe_get_theme_options();
    $title = ! empty( $options['breakingnews_title'] ) ? $options['breakingnews_title'] : esc_html__( 'Breaking News', 'news-vibe' );

    if ( empty( $content_details ) ) {
        return;
    } ?>

    <div id="breaking-news" class="relative wrapper">
        <div class="breaking-news-wrapper">
            <h2 class="news-title"><?php echo esc_html( $title ); ?></h2>

            <div class="breaking-news-slider" data-slick='{"slidesToShow": 3, "slidesToScroll": 1, "infinite": true, "speed": 1000, "dots": false, "arrows":true, "autoplay": <?php echo $options['breakingnews_slider_auto_play'] ? 'true' : 'false'; ?>, "draggable": true, "fade": false }'>
                <?php foreach ( $content_details as $content ) : ?>
                    <article>
                        <div class="breaking-news-item-wrapper">
                            <div class="featured-image">
                                <img src="<?php echo esc_url( $content['image'] ); ?>" alt="<?php echo esc_attr( $content['title'] ); ?>">
                            </div><!-- .featured-image -->

                            <header class="entry-header">
                                <h2 class="entry-title"><a href="<?php echo esc_url( $content['url'] ); ?>"><?php echo esc_html( $content['title'] ); ?></a></h2>
                            </header>
                        </div><!-- .breaking-news-item-wrapper -->
                    </article>
                <?php endforeach; ?>

            </div><!-- .breaking-news-slider -->
        </div><!-- .breaking-news-wrapper -->
    </div><!-- #breaking-news -->

    
    <?php }
    endif;

