<?php
/**
 * Demo info
 * 
 * 
 */
$demos_array = array(
    'article-lite' => array(
        'name' => 'Article Lite',
        'external_url' => 'https://demo.blazethemes.com/import-files/article-lite/article-lite.zip',
        'image' => 'https://i0.wp.com/themes.svn.wordpress.org/article-lite/1.3.0/screenshot.png?w=572&strip=all',
        'preview_url' => 'https://demo.blazethemes.com/article-lite/',
        'menu_array' => array(
            'primary' => 'Main Menu',
            'top-social' => 'Social menu',
            'footer' => 'Footer Menu'
        ),
        'plugins' => array(
            'woocommerce' => array(
                'name' => 'Woocommerce',
                'source' => 'wordpress',
                'file_path' => 'woocommerce/woocommerce.php',
            ),
            'breadcrumb-navxt' => array(
                'name' => 'Breadcrumb NavXT',
                'source' => 'wordpress',
                'file_path' => 'breadcrumb-navxt/breadcrumb-navxt.php',
            ),
            'contact-form-7' => array(
                'name' => 'Contact Form 7',
                'source' => 'wordpress',
                'file_path' => 'contact-form-7/wp-contact-form-7.php',
            )
        ),
        'tags' => array(
            'free' => 'Free'
        )
    ),
    'article-pro' => array(
        'name' => 'Article Pro',
        'type' => 'pro',
        'buy_url'=> 'https://blazethemes.com/theme/article-pro/',
        'external_url' => 'https://demo.blazethemes.com/import-files/article-lite/article-lite-pro.zip',
        'image' => 'https://i0.wp.com/themes.svn.wordpress.org/article-lite/1.3.0/screenshot.png?w=572&strip=all',
        'preview_url' => 'https://demo.blazethemes.com/article-pro/',
        'menu_array' => array(
            'primary' => 'Main Menu',
            'top-social' => 'Social menu',
            'footer' => 'Footer Menu'
        ),
        'plugins' => array(
            'woocommerce' => array(
                'name' => 'Woocommerce',
                'source' => 'wordpress',
                'file_path' => 'woocommerce/woocommerce.php',
            )
        ),
        'tags' => array(
            'pro' => 'Pro'
        )
    )
);
return apply_filters( 'article_lite__demos_array_filter', $demos_array );