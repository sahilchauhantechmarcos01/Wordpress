<?php 

namespace CPT;

class BookGenre{
    public function register() {
        add_action( 'init', [ $this, 'register_taxonomy' ] );
    }

    public function register_taxonomy() {

        $labels = [
            'name'          => __( 'Genres' ),
            'singular_name' => __( 'Genre' ),
            'search_items'  => __( 'Search Genres' ),
            'all_items'     => __( 'All Genres' ),
            'edit_item'     => __( 'Edit Genre' ),
            'update_item'   => __( 'Update Genre' ),
            'add_new_item'  => __( 'Add New Genre' ),
            'menu_name'     => __( 'Genres' ),
        ];

        $args = [
            'hierarchical'      => true,
            'labels'            => $labels,
            'public'            => true,
            'show_ui'           => true,
            'show_in_rest'      => true,
            'show_admin_column' => true,
            'rewrite'           => [ 'slug' => 'genre' ],
        ];

        register_taxonomy( 'genre', [ 'book' ], $args );
    }
}