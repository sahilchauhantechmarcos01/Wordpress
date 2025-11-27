<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
    <nav class="main-nav">
        <div class="nav_left">
            <a href="<?php echo home_url('/'); ?>"><?php bloginfo('name'); ?></a>
        </div>

        <div class="nav_right">
            <?php
            wp_nav_menu([
                'theme_location' => 'primary',
                'container' => false,
                'menu_class' => 'primary-menu'
            ]);
            ?>
        </div>
    </nav>
</header>

<div id="page" class="site">
    <div id="content" class="site-content">
