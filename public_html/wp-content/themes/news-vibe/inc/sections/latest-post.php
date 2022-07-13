<?php
/**
* Latest Post section
*
* This is the template for the content of latest_post section
*
* @package Theme Palace
* @subpackage News Vibe
* @since News Vibe 1.0.0
*/

$options = news_vibe_get_theme_options();

if( $options['latest_post_section_enable'] !== false ):

$content_details = array();

    $cat_ids = ! empty( $options['latest_post_content_category'] ) ? $options['latest_post_content_category'] : '';
    $args = array(
        'post_type'         => 'post',
        'posts_per_page'    => 3,
        'cat'               => absint( $cat_ids ),
        'ignore_sticky_posts'   => true,
        );

// Run The Loop.
$query = new WP_Query( $args );
if ( $query->have_posts() ) :
    while ( $query->have_posts() ) : $query->the_post();
$page_post['id']        = get_the_id();
$page_post['auth_id']   = get_the_author_meta('ID');
$page_post['title']     = get_the_title();
$page_post['content']   = get_the_content();
$page_post['url']       = get_the_permalink();
$page_post['excerpt']   = news_vibe_trim_content( 25 );
$page_post['image']     = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_id(), 'post-thumbnail' ) : get_template_directory_uri() . '/assets/uploads/no-featured-image-590x650.jpg';
// Push to the main array.
array_push( $content_details, $page_post );
endwhile;
endif;
wp_reset_postdata();
?>

<div id="latest-posts" class="relative">
    <?php if ( ! empty( $options['latest_post_title'] ) ) : ?>
        <div class="section-header">
            <h2 class="section-title"><?php echo esc_html( $options['latest_post_title'] ); ?></h2>
        </div><!-- .section-header -->
    <?php endif; ?>
    <div class="section-content clear">
        <?php
        $i = 1;
        while( $i <= count($content_details) ) {
            ?>
            <div class="<?php echo ( $i%3 == 0 ) ? 'full-width grid-layout' : 'half-width grid-layout' ?>">
                <?php
                $check = ( $i%3 == 0 ) ? 'full' : 'half' ;
                for( $j = $i ; $j <= count($content_details) ; $j++ ){
                    if ( $check == 'half' ) {
                        if( $j%3 == 0 ) break;
                        ?>
                        <article class="has-post-thumbnail">
                            <div class="featured-image" style="background-image: url('<?php echo esc_url( $content_details[$j-1]['image'] ); ?>');">
                                <a href="<?php echo esc_url( $content_details[$j-1]['url'] ); ?>" class="post-thumbnail-link"></a>
                                <span class="min-read" ?>
                                <?php echo news_vibe_time_interval( $content_details[$j-1]['excerpt'] ); echo esc_html__(' min to read', 'news-vibe'); ?>
                                </span>
                                
                            </div><!-- .featured-image -->
                            <div class="entry-container">
                                <div class="entry-meta">
                                
                                    <span class="cat-links">
                                        <?php the_category( '', '', $content_details[$j-1]['id'] ); ?>
                                    </span><!-- .cat-links -->
                               
                                    <?php news_vibe_posted_on( $content_details[$j-1]['id'] ); ?>
                                </div><!-- .entry-meta -->
                                <header class="entry-header">

                                    <h2 class="entry-title"><a href="<?php echo esc_url($content_details[$j-1]['url'] ); ?>"><?php echo esc_html( $content_details[$j-1]['title'] ); ?></a></h2>
                                </header>
                                <?php echo news_vibe_author( $content_details[$j-1]['auth_id'] ); ?>
                            </article>
                            <?php
                            $i++;
                        }
                        if ( $check == 'full' ) {
                            $i++;
                            ?>
                            <article class="has-post-thumbnail">
                                <div class="featured-image" style="background-image: url('<?php echo esc_url( $content_details[$j-1]['image'] ); ?>');">
                                    <a href="<?php echo esc_url( $content_details[$j-1]['url'] ); ?>" class="post-thumbnail-link"></a>
                                    <span class="min-read"><?php echo news_vibe_time_interval( $content_details[$j-1]['content'] ); echo esc_html__(' min to read', 'news-vibe'); ?></span>
                                </div><!-- .featured-image -->
                                <div class="entry-container">
                                    <div class="entry-meta">
                                        <span class="cat-links">
                                            <?php the_category( '', '', $content_details[$j-1]['id'] ); ?>
                                        </span><!-- .cat-links -->
                                        <?php news_vibe_posted_on( $content_details[$j-1]['id'] ); ?>
                                    </div><!-- .entry-meta -->
                                    <header class="entry-header">

                                        <h2 class="entry-title"><a href="<?php echo esc_url($content_details[$j-1]['url'] ); ?>"><?php echo esc_html( $content_details[$j-1]['title'] ); ?></a></h2>
                                    </header>
                                    <div class="entry-content">
                                        <p><?php echo esc_html( $content_details[$j-1]['excerpt'] ); ?></p>
                                        <?php
                                        echo news_vibe_author( $content_details[$j-1]['auth_id'] );?>
                                    </div><!-- .entry-container -->
                                </div>    
                            </article>
                            <?php
                            break;
                            }
                        }
                        echo '</div>';
                        if ( $check == 'full' ){
                            echo "<div class='clear'> </div>";
                        }

                    }
                    ?>
                </div>
            </div><!-- latest-posts -->

        <?php endif; ?>

