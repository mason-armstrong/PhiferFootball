<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Theme Palace
 * @subpackage News Vibe
 * @since News Vibe 1.0.0
 */

$options = news_vibe_get_theme_options();
$class = has_post_thumbnail() ? '' : 'no-post-thumbnail';
$ids    = get_the_id();
?>
<article <?php post_class( $class ); ?>>
    <?php if ( has_post_thumbnail() ) : ?>
        <div class="featured-image" style="background-image:url('<?php the_post_thumbnail_url( 'post-thumbnail' ); ?>');">
            <a href="<?php the_permalink(); ?>" class="post-thumbnail-link"></a>
            <span class="min-read"><?php echo news_vibe_time_interval(get_the_content()); echo esc_html__(' min to read', 'news-vibe'); ?></span>
        </div><!-- .featured-image-->
    <?php endif; ?>

    <div class="entry-container">
        <div class="entry-meta">
            <?php 
            if (get_post_type() === 'post') { ?>

                <span class="cat-links">
                    <?php echo news_vibe_article_footer_meta(); ?>
                </span><!-- .cat-links -->
                
            <?php } ?>

            <?php  
            if ( ! $options['hide_date'] ) {
                news_vibe_posted_on();
            }
            ?>
        </div><!-- .entry-meta -->

        <header class="entry-header">
            <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        </header>

        <div class="entry-content">
            <p><?php the_excerpt(); ?></p>
        </div><!-- .entry-content -->

        <?php
        if ( ! $options['hide_author'] ) { 
            echo news_vibe_author( get_the_author_meta('ID') );
        }
        ?>
    </div><!-- .entry-container -->
</article>