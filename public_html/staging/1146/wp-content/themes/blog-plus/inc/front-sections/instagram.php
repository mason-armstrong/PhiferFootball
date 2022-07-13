<?php

if ( ! function_exists( 'blog_plus_add_instagram_section' ) ) :

    function blog_plus_add_instagram_section() {
    
      if ( get_theme_mod( 'instagram_section_enable' ) == false ) {
            return false;
        }

        blog_plus_render_instagram_section();
    }
endif;

if ( ! function_exists( 'blog_plus_render_instagram_section' ) ) :

   function blog_plus_render_instagram_section() {
        ?>

        <div id="blog_diary_instagram_section">

          <div id="instagram" class="relative page-section same-background">
                <div class="wrapper">
                    <?php echo do_shortcode( get_theme_mod( 'instagram_shortcode', esc_html__( '[instagram-feed]','blog-plus' ) ) ); ?>
                </div>
            </div>

            </div>     

    <?php }
endif;