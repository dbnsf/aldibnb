<?php get_header();
      get_template_part('components/nav/nav_filters');  
?>
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

  </header>
  <div class="main__title">
            <h1>Explore All Experiences</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                incididunt ut labore et.</p>
        </div>
  <ul class="cards">
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : ?>
            <?php the_post();
            get_template_part('partials/post-card')
            ?>
<?php endwhile ?>
<?php endif; ?>
        </ul>
        <ul class="pagination">
                  <li class="pagination-item">
                    <div href="#"><?php previous_posts_link( 'Précédent' ); ?></div>
                  </li>

         
                  <li class="pagination-item">
                    <div href="#"><?php next_posts_link( 'Suivant' ); ?></div>
                  </li>
                </ul> 
<?php get_footer();  ?>