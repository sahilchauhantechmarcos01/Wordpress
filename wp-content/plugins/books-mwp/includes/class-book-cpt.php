<?php
namespace CPT;

class BookCPT{
    public function register(){
        add_action('init',[$this,'register_cpt']);
    }
    public function register_cpt(){
        $labels = [
        'name' => __('Books'),
        'singular_name' => __('Book'),
        'add_new' => __('Add New Book'),
        'add_new_item' => __('Add New Book'),
        'edit_item'          => __( 'Edit Book' ),
        'new_item'           => __( 'New Book' ),
        'all_items'          => __( 'All Books' ),
        'view_item'          => __( 'View Book' ),
        'search_items'       => __( 'Search Books' ),
        'featured_image'     => 'Cover',
        'set_featured_image' => 'Add Cover'
        ];
        $args = [
            'labels' => $labels,
            'description' => 'Hols Book Data',
            'public'  => true,
            'menu_position' => 5,
            'supports'          => [ 'title', 'editor', 'thumbnail', 'excerpt', 'comments', 'custom-fields' ],
            'has_archive'       => true,
            'rewrite' => array(
            'slug' => 'books', 
            'with_front' => false),
            'show_in_rest'      => true,
            'show_in_nav_menus' => false,
            'show_in_admin_bar' => true,
        ];
        register_post_type('book',$args);
    }

}