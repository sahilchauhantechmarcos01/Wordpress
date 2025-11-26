<?php get_header();?>
<h2 class="movie-heading">Latest Movies</h2>

<div class="movies-grid">
<?php
$movies = new WP_Query([
    'post_type'      => 'movie',
    'posts_per_page' => 10
]);

if ( $movies->have_posts() ) :

    while ( $movies->have_posts() ) : $movies->the_post(); ?>
        <div class="movie-card">
        <h3><?php the_title(); ?></h3>
        <p><?php the_content();?></p>
      
     
        <?php
        $movie_name = get_post_meta( get_the_ID(), '_movie_name', true );
        $movie_id   = get_post_meta( get_the_ID(), '_movie_id', true );
        ?>

        <p><strong>Name:</strong> <?php echo esc_html($movie_name); ?></p>
        <p><strong>ID:</strong> <?php echo esc_html($movie_id); ?></p>
<a href="<?php the_permalink(); ?>">View Movie</a>
</div>
    <?php endwhile;

    wp_reset_postdata();

else:
    echo "<p>No movies found.</p>";
endif;
?>
</div>
<?php get_footer();?>