<?php 
namespace CPT;

class BookMeta {
    private $nonce_field = 'book_meta_nonce_field';
    private $nonce_action = 'book_meta_nonce';

    public function register(){
        add_action('add_meta_boxes',[$this, 'add_meta_box']);
        add_action('save_post', [$this, 'save_meta']);
    }
    public function add_meta_box(){
        add_meta_box(
            'book_meta_box',
            'Book Details',
            [$this, 'render_meta_box'],
            'book',
            'side',
            'high'
        );
    }

    public function render_meta_box($post){
        wp_nonce_field($this->nonce_action , $this->nonce_field);

        $book_name = get_post_meta($post->ID,'_book_name',true);
        $book_author = get_post_meta($post->ID,'_book_author',true);
        ?>
        <p>
            <label for="book_name"><strong>Book Name</strong></label>
            <input type="text" id="book_name" class="widefat" name="book_name" value="<?php echo esc_attr( $book_name ); ?>">
        </p>

        <p>
            <label for="book_author"><strong>Author</strong></label>
            <input type="text" id="book_author" class="widefat" name="book_author" value="<?php echo esc_attr( $book_author ); ?>">
        </p>

        <?php
    }

    public function save_meta($post_id){
        if ( $this->is_autosave() ) return;
        if ( ! $this->is_valid_nonce() ) return;
        if ( ! $this->has_permission( $post_id ) ) return;
        $this->save_field($post_id, 'book_name', '_book_name');
        $this->save_field($post_id,'book_author','_book_author');
    }
    private function is_autosave() {
        return ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE );
    }

    private function is_valid_nonce() {
        return isset( $_POST[ $this->nonce_field ] ) &&
               wp_verify_nonce( $_POST[ $this->nonce_field ], $this->nonce_action );
    }

    private function has_permission( $post_id ) {
        return current_user_can( 'edit_post', $post_id );
    }
    private function save_field( $post_id, $field_name, $meta_key ) {
        if ( isset( $_POST[$field_name] ) ) {
            update_post_meta(
                $post_id,
                $meta_key,
                sanitize_text_field( $_POST[$field_name] )
            );
        } else {
            delete_post_meta( $post_id, $meta_key );
        }
    }
}