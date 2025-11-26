<?php get_header(); ?>
<?php
$movies = new WP_Query([
    'post_type'      => 'movie',
    'posts_per_page' => 10
]);
$cars = new WP_Query([
    'post_type'      => 'car',
    'posts_per_page' => 10
]);
if ( $movies->have_posts() ) :
    echo '<h2>Latest Movies</h2>';

    while ( $movies->have_posts() ) : $movies->the_post(); ?>

        <h3><?php the_title(); ?></h3>
        <p><?php the_content();?></p>
        <?php the_excerpt(); ?>
     
        <?php
        $movie_name = get_post_meta( get_the_ID(), '_movie_name', true );
        $movie_id   = get_post_meta( get_the_ID(), '_movie_id', true );
        ?>

        <p><strong>Name:</strong> <?php echo esc_html($movie_name); ?></p>
        <p><strong>ID:</strong> <?php echo esc_html($movie_id); ?></p>

    <?php endwhile;

    wp_reset_postdata();

else:
    echo "<p>No movies found.</p>";
endif;

if ( $cars->have_posts() ) :
    echo '<h2>Latest Cars</h2>';

    while ( $cars->have_posts() ) : $cars->the_post(); ?>

        <h3><?php the_title(); ?></h3>
        <p><?php the_content();?></p>
        <?php the_excerpt(); ?>
     
        <?php
        $car_name = get_post_meta( get_the_ID(), '_car_name', true );
        $car_color   = get_post_meta( get_the_ID(), '_car_color', true );
        ?>

        <p><strong>Name:</strong> <?php echo esc_html($car_name); ?></p>
        <p><strong>Color:</strong> <?php echo esc_html($car_color); ?></p>

    <?php endwhile;

    wp_reset_postdata();

else:
    echo "<p>No cars found.</p>";
endif;
?>
<?php get_footer(); ?>