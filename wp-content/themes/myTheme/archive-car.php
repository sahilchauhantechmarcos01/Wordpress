<?php get_header(); ?>

<h1 class="movie-heading">All Cars</h1>

<div class="movies-grid">

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    
    <div class="movie-card">
        <?php if ( has_post_thumbnail() ) the_post_thumbnail('medium'); ?>
        
        <h2><?php the_title(); ?></h2>
        <p><?php the_content();?></p>
        <?php the_excerpt(); ?>
        <a href="<?php the_permalink(); ?>">View Movie</a>
    </div>

<?php endwhile; endif; ?>

</div>

<?php the_posts_pagination(); ?>

<?php get_footer(); ?>
