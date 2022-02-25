<div class="card">
    <img src="<?php the_post_thumbnail_url() ?>" class="card-img-top" alt="...">
    <div class="card-body">
        <p><small><?php the_terms(get_the_ID(), 'type de logement'); ?></small></p>
        <h5 class="card-title"><?php the_title(); ?></h5>
        <p class="card-text"><?php the_excerpt(); ?></p>
        <a href="<?php the_permalink(); ?>" class="btn btn-primary"> Lire Plus </a>
    </div>
</div>