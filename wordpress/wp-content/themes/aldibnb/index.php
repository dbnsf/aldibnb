<?php get_header(); ?>

<?php if (have_posts()) : ?>

    <?php while (have_posts()) : the_post(); ?>
    <div class="single__container">
        </div>
        <img src="<?php the_post_thumbnail_url(); ?>" alt="img" class="card-img-template" />

        <div class="card-body">
            <h2 class="card-title"><?php the_title(); ?></h2>
            <p class="card-text"><small class="text-muted">Ecrit le : <?php the_date(); ?></small></p>


            <?php  echo '<p class="card-content">' . the_content() . '</p>' ?>
    </div>


    <?php endwhile; ?>

<?php endif;  ?>

<?php get_footer();  ?>

