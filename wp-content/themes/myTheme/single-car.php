<?php get_header(); ?>
<div class="movie-grid">
<?php
while ( have_posts() ) : the_post();

    // Retrieve meta
    $car_name = get_post_meta( get_the_ID(), '_car_name', true );
    $car_color   = get_post_meta( get_the_ID(), '_car_color', true );
?>
<div class="movie-card">
    <h1><?php the_title(); ?></h1>
    <div><?php the_content(); ?></div>

    <h2>Car Details</h2>
    <ul>
        <li><strong>Car Name:</strong> <?php echo esc_html( $car_name ); ?></li>
        <li><strong>Car Color:</strong> <?php echo esc_html( $car_color ); ?></li>
    </ul>
</div>
<?php endwhile; ?>
</div>

<?php get_footer(); ?>
