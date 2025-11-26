<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <nav>
        <div class="nav_left">
            <a href="<?php echo home_url('/')?>">
                <?php bloginfo('name');?>
            </a>
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