<?php
get_header(); ?>
<div class="wrap">
    <div id="primary" class="content-area">
        <main id="main" class="site-main">
            <?php
            if ( have_posts() ) :
                woocommerce_content();
            endif; 
            ?>
        </main>
    </div>
</div>
<?php
get_footer();