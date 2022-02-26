<?php get_header(); ?>
<header>
       <div class="header__main">
        <div class="header__titles">        
            <h1>Explore a Brand </br>
            New World</h1>
        <p>Lorem ipsum dolor sit amet, consectetur
            adipiscing elit, sed do eiusmod tempor
            incididunt ut labore et</p>
        </div>
        <div class="header__image">
            <img class="header__image" src="https://images.unsplash.com/photo-1645627446035-d9ade996ae42?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2069&q=80" alt="">
        </div>
    </div>
        <div class="header__filter">
            <div class="filter__container">
            <ul class="filter__nav">
                <div class="filter__search-input">
                <li class="filter__nav-list">
                    Lieu              
                </li>
                    <input type="text" placeholder="Ex: France">
                </div>
                <div class="filter__search-input">
                <li class="filter__nav-list">
                    Prix              
                </li>
                    <input type="text" placeholder="Ex: 200€" >
                </div>
                <div class="filter__search-input">
                <li class="filter__nav-list">
                    Chambres              
                </li>
                    <input type="text" placeholder="Ex: 3" >
                </div> 
                <li id="search">
                   Search
                </li>
            </ul>
        </div>
    </div>
</header>

<main>
<div class="main__title">
            <h1>Explore All Experiences</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                incididunt ut labore et.</p>
        </div>


    <?php if ( have_posts() ) : ?>
 
 <!-- Add the pagination functions here. -->

 <!-- Start of the main loop. -->
 <?php while ( have_posts() ) : the_post(); ?>

 <!-- the rest of your theme's main loop -->

 <?php endwhile; ?>
 <!-- End of the main loop -->

 <!-- Add the pagination functions here. -->
<!-- 

<?php else : ?>

<?php _e('Sorry, no posts matched your criteria.'); ?>

<?php endif; ?>

  
</main>
<?php get_footer();  ?>