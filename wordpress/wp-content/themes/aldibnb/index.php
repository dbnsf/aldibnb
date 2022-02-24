<?php get_header(); ?>
<div class="container card-group">

    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : ?>
            <?php the_post(); ?>
            <div class="card">
                <img src="<?php the_post_thumbnail_url()?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><?php the_title(); ?></h5>
                    <p class="card-text"><?php the_excerpt(); ?></p>
                    <a href="<?php the_permalink(); ?>" class="btn btn-primary"> Lire Plus </a>
                </div>
            </div>

<?php endwhile ?>
<?php endif; ?>
</div>
<?php get_footer();  ?>