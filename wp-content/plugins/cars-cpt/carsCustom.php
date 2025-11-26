<?php 

/*
Plugin Name: Cars Post Type
Description: Add cars 
Author: dbOne
Version: 1.0
 */

add_action('init','car_cpt');

function car_cpt(){
    $labels = [
        'name' => __('Cars'),
        'singular_name' => __('Car'),
        'add_new'  => __('Add New Car'),
        'add_new_item' => __('Add New Car'),
        'edit_item' => __('Edit car'),
        'new_item' => __('New Car'),
        'all_items' => __('All Cars'),
        'view_item' => __('View Car'),
        'search_items' => __('Search Cars'),
        'featured_image' => 'Poster',
        'set_featured_image' => 'Add Poster'
    ];

    $args = [
        'labels'            => $labels,
        'description'       => 'Holds Cars data',
        'public'            => true,
        'menu_position'     => 5,
        'supports'          => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments', 'custom-fields' ),
        'has_archive'       => true,
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'query_var'         => true,
        'show_in_rest' => true,
    ];

    register_post_type('car',$args);
}

add_action( 'add_meta_boxes', 'add_car_meta_box' );
function add_car_meta_box() {
    add_meta_box(
        'car_meta_box',           // Meta box ID
        'car details',            // Title
        'car_meta_box_callback',  // Callback
        'car',                   // Post type
        'side',                      // Context
        'high'                       // Priority
    );
}

function car_meta_box_callback( $post ) {
    // Use nonce for verification
    wp_nonce_field( 'car_meta_nonce', 'car_meta_nonce_field' );

    // Retrieve existing values from the DB
    $car_name = get_post_meta( $post->ID, '_car_name', true );
    $car_color  = get_post_meta( $post->ID, '_car_color', true );
    $car_brand = get_post_meta( $post->ID, '_car_brand', true );
    // Output fields (use esc_attr for safe output)
    ?>
    <p>
        <label for="car_name_field"><strong>Car Name</strong></label><br>
        <input type="text" id="car_name_field" class="regular-text"
               name="car_name" value="<?php echo esc_attr( $car_name ); ?>" />
    </p>

    <p>
        <label for="car_color_field"><strong>Car Color</strong></label><br>
        <input type="text" id="car_color_field" class="regular-text"
               name="car_color" value="<?php echo esc_attr( $car_color ); ?>" />
    </p>

    <p>
        <label for="car_brand_field"><strong>Car Brand</strong></label><br>
        <input type="text" id="car_brand_field" name = "car_brand" value="<?php echo esc_attr($car_brand); ?>" />

    </p>
    <?php
}

add_action('save_post','car_save_postdata');
function car_save_postdata($post_id){
    if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE){
        return $post_id;
    }
    if('car' !== get_post_type($post_id)){
        return $post_id;
    }
    // Verify nonce
    if ( ! isset( $_POST['car_meta_nonce_field'] ) ||
         ! wp_verify_nonce( $_POST['car_meta_nonce_field'], 'car_meta_nonce' ) ) {
        return $post_id;
    }

    // Check permissions
    if ( isset( $_POST['post_type'] ) && 'page' === $_POST['post_type'] ) {
        if ( ! current_user_can( 'edit_page', $post_id ) ) {
            return $post_id;
        }
    } else {
        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return $post_id;
        }
    }
        // Sanitize and save author_name
    if ( isset( $_POST['car_name'] ) ) {
        $car_name_sanitized = sanitize_text_field( wp_unslash( $_POST['car_name'] ) );
        update_post_meta( $post_id, '_car_name', $car_name_sanitized );
    } else {
        delete_post_meta( $post_id, '_car_name' );
    }

    // Sanitize and save author_id
    if ( isset( $_POST['car_color'] ) ) {
        $car_color_sanitized = sanitize_text_field( wp_unslash( $_POST['car_color'] ) );
        update_post_meta( $post_id, '_car_color', $car_color_sanitized );
    } else {
        delete_post_meta( $post_id, '_car_color' );
    }
    if ( isset( $_POST['car_brand'] ) ) {
        $car_brand_sanitized = sanitize_text_field( wp_unslash( $_POST['car_brand'] ) );
        update_post_meta( $post_id, '_car_brand', $car_brand_sanitized );
    } else {
        delete_post_meta( $post_id, '_car_brand' );
    }

 }

 add_action('init','car_engine_taxonomy');
function car_engine_taxonomy(){
      $labels = array(
        'name'              => __( 'Engine' ),
        'singular_name'     => __( 'Engine' ),
        'search_items'      => __( 'Search Engines' ),
        'all_items'         => __( 'All Engines' ),
        'edit_item'         => __( 'Edit Engine' ),
        'update_item'       => __( 'Update Engine' ),
        'add_new_item'      => __( 'Add New Engine' ),
        'new_item_name'     => __( 'New Engine Name' ),
        'menu_name'         => __( 'Engines' ),
    );

    $args = array(
        'hierarchical'      => true,       // Like categories (true) or tags (false)
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'show_in_rest'      => true,
        'public' => true,       // Enables Gutenberg + API
        'rewrite'           => array( 'slug' => 'engine' ),
    );

    register_taxonomy( 'engine', array( 'car' ), $args );  
}