<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Article Lite
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost">

    <div class="entry-summary">
        <header class="entry-header">
	        
	        <?php article_lite_entry_titles(); ?>
	        
	        <div class="entry-meta post-date">

	        	<?php article_lite_entry_meta(); ?></div><!-- .entry-meta -->
        
        </header><!-- .entry-header -->
    
	    <div class="entry-content" itemprop="text">
			<p>
	        	<?php the_excerpt(); ?>
			</p>
			<p>
				<p class="more-link-wrapper">
					<a class="more-link" href="<?php the_permalink(); ?>"><?php esc_html_e('Read More', 'article-lite');?></a>
				</p>
			</p>


	        <?php 		
	        	// load our nav is our post is split into multiple pages
	        	article_lite_multipage_nav(); 						
	        ?>

	    </div><!-- .entry-content -->
    
    <footer class="entry-footer"></footer>
    
    </div>
</article><!-- #post-<?php the_ID(); ?> -->



