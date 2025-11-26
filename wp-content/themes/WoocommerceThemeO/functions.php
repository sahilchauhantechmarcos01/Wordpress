<?php
function mytheme_enqueue_styles() {
    wp_enqueue_style( 'theme-style', get_stylesheet_uri(), [], time() );
}
add_action( 'wp_enqueue_scripts', 'mytheme_enqueue_styles' );

function wooSetup(){
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('woocommerce');
    register_nav_menus([
        'primary'=>  __('Primary Menu','WoocommerceThemeO')
    ]);
}
add_action('after_setup_theme', 'wooSetup');


add_filter( 'woocommerce_enqueue_styles', '__return_false' );


add_filter( 'body_class', function( $classes ) {
    if ( is_shop() ) {
        $classes[] = 'shop';
    }
    return $classes;
});


add_filter( 'woocommerce_sale_flash', function( $html ) {
    return '<span class="onsale my-sale-badge">Sale!</span>';
});