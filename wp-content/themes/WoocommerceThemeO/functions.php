<?php
// function mytheme_enqueue_styles() {
//     wp_enqueue_style( 'theme-style', get_stylesheet_uri(), [], time() );
// }
// add_action( 'wp_enqueue_scripts', 'mytheme_enqueue_styles' );

function wooSetup(){
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('woocommerce');
    add_theme_support( 'wc-blocks' );
    register_nav_menus([
        'primary'=>  __('Primary Menu','WoocommerceThemeO')
    ]);
}
add_action('after_setup_theme', 'wooSetup');
function webkul_add_woocommerce_support() {
    //Add WoocCommerce theme support to our theme
    add_theme_support( 'woocommerce' );
    // To enable gallery features add WooCommerce Product zoom effect, lightbox and slider support to our theme
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
}

add_action( 'after_setup_theme', 'webkul_add_woocommerce_support' );

// add_filter( 'woocommerce_enqueue_styles', '__return_false' );
add_action( 'wp_enqueue_scripts', 'mytheme_enqueue_styles', 999 );
function mytheme_enqueue_styles() {
    wp_enqueue_style( 'theme-style', get_stylesheet_uri(), [], time() );
}

add_filter( 'body_class', function( $classes ) {
    if ( is_shop() ) {
        $classes[] = 'shop';
    }
    return $classes;
});


add_filter( 'woocommerce_sale_flash', function( $html ) {
    return '<span class="onsale my-sale-badge">Sale!</span>';
});


add_filter('woocommerce_breadcrumb_defaults',function($d){
    $d['home'] = 'Shop';
    $d['wrap_before'] = '<nav class="breadcrumb_single">';
    $d['wrap_after'] = '</nav>';
    return $d;
});

function my_acf_field_display() {
    if ( is_product() ) {
        $value = get_field('fabric_type'); 
        $value2 = get_field('brand_url');
        // $value2 = implode(',',$value2);
        $value = implode(',',$value);
        if ( $value && $value2 ) {
            echo '<p class="fabric"><strong>Fabric Type:</strong> ' .$value . '</p>';
            echo '<button class="brand_url">'.'<a href='.$value2.'>View Brand</a> ' .'</button>';
        }
    }
}

function add_acf_to_product() {
    add_action('woocommerce_single_product_summary', 'my_acf_field_display', 25);
}

add_action('init', 'add_acf_to_product');



function wrap_product_start() {
    echo '<div class="single_wraper">';
}
add_action('woocommerce_before_single_product_summary', 'wrap_product_start', 1);


function wrap_product_end() {
    echo '</div>'; // close wrapper
}
add_action('woocommerce_after_single_product_summary', 'wrap_product_end', 1);


add_filter( 'body_class', function( $classes ) {
    if ( is_product() ) {
        $classes[] = 'single_prod';
    }
    return $classes;
});