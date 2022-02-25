<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

        <?php wp_head(); ?>
    </head>
<body>


<nav class="navbar navbar-light bg-light">
    <div class="container-fluid">
    <a class="navbar-brand">Navbar</a>

<?php 
    wp_nav_menu([
        'theme_location' => 'header',
        'menu_class' => 'menu', 
        'container' => false
    ]); 
    ?>
    <?php get_search_form(); ?>
  </div>
</nav>