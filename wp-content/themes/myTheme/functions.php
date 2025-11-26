<?php
// functions.php (or plugin main file)

function mytheme_enqueue_assets() {
    // theme stylesheet
    wp_enqueue_style('mytheme-style', get_stylesheet_uri());

    wp_enqueue_script('jquery');
}
add_action('wp_enqueue_scripts', 'mytheme_enqueue_assets');

add_theme_support('post-thumbnails');


function ajax_res() {

    
    $search = isset($_POST['search']) ? sanitize_text_field($_POST['search']) : '';

    $args = [
        'post_type'      => 'movie',
        'posts_per_page' => -1,
    ];

    if (!empty($search)) {
        $args['meta_query'] = [
            'relation' => 'OR',
            [
                'key'     => '_movie_name',
                'value'   => $search,
                'compare' => 'LIKE'
            ],
            [
                'key'     => '_movie_id',
                'value'   => $search,
                'compare' => 'LIKE'
            ],
        ];


    }

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        echo '<div class="movies-grid">';
        while ($query->have_posts()) {
            $query->the_post();
            ?>
            <div class="movie-card">
                <?php if (has_post_thumbnail()) the_post_thumbnail('medium'); ?>
        <p><?php the_content();?></p>
      

                <h2><?php the_title(); ?></h2>
                <p><?php echo wp_trim_words( get_the_content(), 20 ); ?></p>
                <a href="<?php the_permalink(); ?>">View Movie</a>
            </div>
            <?php
        }
        echo '</div>';
    } else {
        echo '<p style="text-align:center;">No movies found.</p>';
    }

    wp_reset_postdata();
    wp_die(); 
}


add_action('wp_ajax_ajax_movie_search', 'ajax_res');
add_action('wp_ajax_nopriv_ajax_movie_search', 'ajax_res');


function theme_register_menus() {
    register_nav_menus([
        'primary' => __('Primary Menu', 'myTheme'),
    ]);
}
add_action('after_setup_theme', 'theme_register_menus');
