<?php
/*
Plugin Name: Custom Post Types
Description: Add movies 
Author: dbOne
Version: 1.0
*/

// Register the custom post type on init
add_action( 'init', 'movie_cpt' );

function movie_cpt() {
    $labels = array(
        'name'               => __( 'Movies' ),
        'singular_name'      => __( 'Movie' ),
        'add_new'            => __( 'Add New Movie' ),
        'add_new_item'       => __( 'Add New Movie' ),
        'edit_item'          => __( 'Edit Movie' ),
        'new_item'           => __( 'New Movie' ),
        'all_items'          => __( 'All Movie' ),
        'view_item'          => __( 'View Movies' ),
        'search_items'       => __( 'Search Movie' ),
        'featured_image'     => 'Poster',
        'set_featured_image' => 'Add Poster'
    );

    $args = array(
        'labels'            => $labels,
        'description'       => 'Holds Movies data',
        'public'            => true,
        'menu_position'     => 5,
        'supports'          => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments', 'custom-fields' ),
        'has_archive'       => true,
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'query_var'         => true,
        'show_in_rest' => true,
    );

    register_post_type('movie', $args);
}

/*
 * Meta box: Author Details for 'article' CPT
 */

// Add the meta box
add_action( 'add_meta_boxes', 'add_movie_meta_box' );
function add_movie_meta_box() {
    add_meta_box(
        'movie_meta_box',           // Meta box ID
        'Movie Details',            // Title
        'movie_meta_box_callback',  // Callback
        'movie',                   // Post type
        'side',                      // Context
        'high'                       // Priority
    );
}

// Render the meta box HTML
function movie_meta_box_callback( $post ) {
    // Use nonce for verification
    wp_nonce_field( 'movie_meta_nonce', 'movie_meta_nonce_field' );

    // Retrieve existing values from the DB
    $movie_name = get_post_meta( $post->ID, '_movie_name', true );
    $movie_id   = get_post_meta( $post->ID, '_movie_id', true );
    $movie_rating = get_post_meta( $post->ID, '_movie_rating', true );
    // Output fields (use esc_attr for safe output)
    ?>
    <p>
        <label for="movie_name_field"><strong>Movie Name</strong></label><br>
        <input type="text" id="movie_name_field" class="regular-text"
               name="movie_name" value="<?php echo esc_attr( $movie_name ); ?>" />
    </p>

    <p>
        <label for="movie_id_field"><strong>Movie ID</strong></label><br>
        <input type="text" id="movie_id_field" class="regular-text"
               name="movie_id" value="<?php echo esc_attr( $movie_id ); ?>" />
    </p>
    <?php
}

// Save meta box data
add_action( 'save_post', 'movie_save_postdata' );
function movie_save_postdata( $post_id ) {

    // If this is an autosave, our form has not been submitted — bail.
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return $post_id;
    }

    // Check post type: only handle 'article'
    if ( 'movie' !== get_post_type( $post_id ) ) {
        return $post_id;
    }

    // Verify nonce
    if ( ! isset( $_POST['movie_meta_nonce_field'] ) ||
         ! wp_verify_nonce( $_POST['movie_meta_nonce_field'], 'movie_meta_nonce' ) ) {
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
    if ( isset( $_POST['movie_name'] ) ) {
        $movie_name_sanitized = sanitize_text_field( wp_unslash( $_POST['movie_name'] ) );
        update_post_meta( $post_id, '_movie_name', $movie_name_sanitized );
    } else {
        delete_post_meta( $post_id, '_movie_name' );
    }

    // Sanitize and save author_id
    if ( isset( $_POST['movie_id'] ) ) {
        $movie_id_sanitized = sanitize_text_field( wp_unslash( $_POST['movie_id'] ) );
        update_post_meta( $post_id, '_movie_id', $movie_id_sanitized );
    } else {
        delete_post_meta( $post_id, '_movie_id' );
    }
}


add_action('init','movie_genre_taxonomy');
function movie_genre_taxonomy(){
      $labels = array(
        'name'              => __( 'Genres' ),
        'singular_name'     => __( 'Genre' ),
        'search_items'      => __( 'Search Genres' ),
        'all_items'         => __( 'All Genres' ),
        'edit_item'         => __( 'Edit Genre' ),
        'update_item'       => __( 'Update Genre' ),
        'add_new_item'      => __( 'Add New Genre' ),
        'new_item_name'     => __( 'New Genre Name' ),
        'menu_name'         => __( 'Genres' ),
    );

    $args = array(
        'hierarchical'      => true,       // Like categories (true) or tags (false)
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'show_in_rest'      => true,
        'public' => true,       // Enables Gutenberg + API
        'rewrite'           => array( 'slug' => 'genre' ),
    );

    register_taxonomy( 'genre', array( 'movie' ), $args );  
}