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
$ids    = get_the_id();
?>
<article>
<?php if ( has_post_thumbnail() ) : ?>
	<div class="featured-image">
		<img src="<?php the_post_thumbnail_url(); ?>">
		<span class="min-read"><?php echo news_vibe_time_interval(get_the_content()); echo esc_html__(' min to read', 'news-vibe'); ?></span>
	</div>
	<?php endif; ?>

	<div class="entry-container">
		<div class="entry-meta">
			<span class="cat-links">
				<?php news_vibe_single_categories(); ?>
			</span><!-- .cat-links -->

			<?php if ( ! $options['single_post_hide_date'] ) :
			news_vibe_posted_on();
			endif; ?>
		</div><!-- .entry-meta -->

		<header class="entry-header">
			<h2 class="entry-title"><?php the_title(); ?></h2>
		</header>

		<div class="entry-content">
			<?php the_content(); ?>
		</div><!-- .entry-content -->

		<?php 
		if ( ! $options['single_post_hide_author'] ) :
			echo news_vibe_author( get_the_author_meta('ID') );
		endif;
		?>
	</div>
</article>
