<?php get_header(); ?>
<div class="movie-grid">
<?php
while ( have_posts() ) : the_post();

    // Retrieve meta
    $movie_name = get_post_meta( get_the_ID(), '_movie_name', true );
    $movie_id   = get_post_meta( get_the_ID(), '_movie_id', true );
?>
<div class="movie-card">
    <h1><?php the_title(); ?></h1>
    <div><?php the_content(); ?></div>

    <h2>Movie Details</h2>
    <ul>
        <li><strong>Movie Name:</strong> <?php echo esc_html( $movie_name ); ?></li>
        <li><strong>Movie ID:</strong> <?php echo esc_html( $movie_id ); ?></li>
    </ul>
</div>
<?php endwhile; ?>
</div>

<?php get_footer(); ?>
