<?php

if ( ! function_exists( 'better_news_vibe_add_main_content_section' ) ) :

function better_news_vibe_add_main_content_section() {

  better_news_vibe_render_main_content_section();
}
endif;

if ( ! function_exists( 'better_news_vibe_render_main_content_section' ) ) :

function better_news_vibe_render_main_content_section() {
  ?>
  <div id="inner-content-wrapper" class="wrapper">
    <div id="primary" class="content-area">
      <main id="main" class="site-main" role="main">
        <?php require get_template_directory() . '/inc/sections/featured-post.php'; ?>
        <?php require get_template_directory() . '/inc/sections/latest-post.php'; ?>


        <div id="main-posts-wrapper" class="relative left-sidebar clear">
          <div id="primary-contents">
            <?php require get_theme_file_path() . '/inc/front-sections/slider.php'; ?>
            <?php require get_template_directory() . '/inc/sections/most-viewed.php'; ?>
            <?php require get_template_directory() . '/inc/sections/popular.php'; ?>
          </div>

          <?php if(is_active_sidebar('home-left-sidebar')): ?>
            <aside id="secondary-sidebar">
              <?php dynamic_sidebar( 'home-left-sidebar' ); ?>

            </aside>

          <?php endif; ?>
        </div>
      </main>
    </div>

    <?php if(is_active_sidebar('home-right-sidebar')): ?>
      <aside id="secondary" class="widget-area" role="complementary">
        <?php dynamic_sidebar( 'home-right-sidebar' ); ?>
      </aside>
    <?php endif; ?>
  </div>

  <?php }
  endif;