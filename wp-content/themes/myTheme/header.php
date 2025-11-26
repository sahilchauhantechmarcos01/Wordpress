<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header>
    <h1><?php bloginfo('name'); ?></h1>
    <nav class="navbar">
        <?php wp_nav_menu(['theme_location' => 'primary']); ?>
    </nav>
</header>
