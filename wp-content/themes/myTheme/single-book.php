<?php get_header(); ?>
<div class="movie-grid">
<?php
while ( have_posts() ) : the_post();

    // Retrieve meta
    $book_name = get_post_meta( get_the_ID(), '_book_name', true );
    $book_author   = get_post_meta( get_the_ID(), '_book_author', true );
?>
<div class="movie-card">
    <h1><?php the_title(); ?></h1>
    <div><?php the_content(); ?></div>

    <h2>Book's Details</h2>
    <ul>
        <li><strong>Book Name:</strong> <?php echo esc_html( $book_name ); ?></li>
        <li><strong>Author:</strong> <?php echo esc_html( $book_author ); ?></li>
    </ul>
</div>
<?php endwhile; ?>
</div>

<?php get_footer(); ?>
