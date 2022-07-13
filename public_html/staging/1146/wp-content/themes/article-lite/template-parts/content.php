<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Article Lite
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost">
	<?php // Check for featured image
    
    if ( has_post_thumbnail() ) {        
        echo '<div class="featured-image-wrapper"><a class="featured-image-link" href="' . esc_url( get_permalink() ) . '" aria-hidden="true">';
        the_post_thumbnail( 'post-thumbnail', array( 'alt' => get_the_title(), 'itemprop' => "image"));
        echo '</a></div>';
    }
    ?>

    <div class="entry-summary">
        <header class="entry-header">
        
	        <?php 
	        if( is_sticky() && is_home() ) :
	            printf( '<div class="sticky-wrapper"><span class="featured">%s</span></div>', esc_html(get_theme_mod( 'sticky_post_label' )) ? esc_html( get_theme_mod( 'sticky_post_label' ) ) : __( 'Featured', 'article-lite' ) );
	        endif; 
	        ?>
	        
	        <?php article_lite_entry_titles(); ?>
	        
	        <div class="entry-meta post-date">

	        	<?php article_lite_entry_meta(); ?></div><!-- .entry-meta -->
        
        </header><!-- .entry-header -->
    
	    <div class="entry-content" itemprop="text">
	    	<?php if (! is_single() ) { ?>
			<p>
	        	<?php the_excerpt(); ?>
			</p>
			<p>
				<p class="more-link-wrapper">
					<a class="more-link" href="<?php the_permalink(); ?>"><?php esc_html_e('Read More', 'article-lite');?></a>
				</p>
			</p>
			<?php } else{ ?>
				<?php the_content(); ?>

			<?php } ?>

	        <div class="post-footer clearfix">
	            <div class="col col-md-6 col-sm-6 author">
	               <?php article_lite_posted_by(); ?>
	                
	            </div>
	            <div class="col col-md-6 col-sm-6 social-icon-list">
	                <ul class="social-share">
	                    <li>        
	                        <a href="<?php echo esc_url( get_the_permalink() )?>/#comments"><span class="number">
	                            <i class="fa fa-comments"></i>
	                            <span><?php echo absint( get_comments_number() ); ?></span>
	                        </a>
	                    </li>
	                </ul>
	            </div>
	        </div>

	        <?php 		
	        	// load our nav is our post is split into multiple pages
	        	article_lite_multipage_nav(); 						
	        ?>

	    </div><!-- .entry-content -->
    
    <footer class="entry-footer"></footer>
    
    </div>
</article><!-- #post-<?php the_ID(); ?> -->
