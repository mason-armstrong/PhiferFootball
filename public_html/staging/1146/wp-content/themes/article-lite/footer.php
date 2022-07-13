<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Article Lite
 */

?>

<div id="content-bottom-wrapper">
	<?php get_sidebar( 'content-bottom' ); ?>
</div>

</div><!-- #content -->

<div id="feature-bottom-wrapper">   
<?php get_sidebar( 'feature-bottom' ); ?>
</div>

<a class="back-to-top"><span class="fa fa-angle-up"></span></a>

	<footer id="colophon" class="site-footer">
		<div id="sidebar-footer">       
                <?php get_sidebar( 'footer' ); ?>   
        </div>

        <?php if ( has_nav_menu( 'bottom-social' ) ) :
					echo '<nav class="bottom-social-menu">';
						wp_nav_menu( array(
							'theme_location' => 'bottom-social', 'depth' => 1, 'container' => false, 'menu_class' => 'social-icons', 'link_before' => '<span class="screen-reader-text">', 'link_after' => '</span>',
						) );
					echo '</nav>';
            endif; ?>
 
        <nav id="footer-nav">
            <?php wp_nav_menu( array( 
                    'theme_location' => 'footer', 
                    'fallback_cb' => false, 
                    'depth' => 1,
                    'container' => false, 
                    'menu_id' => 'footer-menu', 
                ) ); 
            ?>
        </nav>


		<div class="site-info">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'article-lite' ) ); ?>">
				<?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html__( 'Proudly powered by %s', 'article-lite' ), 'WordPress' );
				?>
			</a>
			<span class="sep"> | </span>
				<?php 
				esc_html_e( 'Article WordPress Theme by', 'article-lite' ); ?>
							<a href="<?php echo esc_url('https://blazethemes.com/'); ?>" target="_blank"><?php esc_html_e( 'Blaze Themes', 'article-lite' ); ?></a>
				<?php

				?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
