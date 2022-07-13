<?php
/**
* Latest Post section
*
* This is the template for the content of main_content section
*
* @package Theme Palace
* @subpackage News Vibe
* @since News Vibe 1.0.0
*/
if ( ! function_exists( 'news_vibe_add_main_content_section' ) ) :
/**
* Add main_content section
*
*@since News Vibe 1.0.0
*/
function news_vibe_add_main_content_section() {

  news_vibe_render_main_content_section();
}
endif;

if ( ! function_exists( 'news_vibe_render_main_content_section' ) ) :
/**
* Start main_content section
*
* @return string main_content content
* @since News Vibe 1.0.0
*
*/
function news_vibe_render_main_content_section() {
  ?>
  <div id="inner-content-wrapper" class="wrapper">
    <div id="primary" class="content-area">
      <main id="main" class="site-main" role="main">
        <?php require get_template_directory() . '/inc/sections/featured-post.php'; ?>
        <?php require get_template_directory() . '/inc/sections/latest-post.php'; ?>


        <div id="main-posts-wrapper" class="relative left-sidebar clear">
          <div id="primary-contents">
            <?php require get_template_directory() . '/inc/sections/popular.php'; ?>
            <?php require get_template_directory() . '/inc/sections/most-viewed.php'; ?>
          </div><!-- #primary-content -->

          <?php if(is_active_sidebar('home-left-sidebar')): ?>
            <aside id="secondary-sidebar">
              <?php dynamic_sidebar( 'home-left-sidebar' ); ?>

            </aside><!-- #secondary sidebar -->

          <?php endif; ?>
        </div><!-- #main-posts-wrapper -->
      </main>
    </div><!-- #primary -->

    <?php if(is_active_sidebar('home-right-sidebar')): ?>
      <aside id="secondary" class="widget-area" role="complementary">
        <?php dynamic_sidebar( 'home-right-sidebar' ); ?>
      </aside><!-- #secondary -->
    <?php endif; ?>
  </div><!-- #inner-content-wrapper -->

  <?php }
  endif;