<?php get_header(); ?>

<?php if (have_posts()) : ?>

    <?php while (have_posts()) : the_post(); ?>
    <div class="single__container">
        </div>
        <div class="card-body">
            <h2 class="card-title"><?php the_title(); ?></h2>
            <p class="card-text"><small class="text-muted">Ecrit le : <?php the_date(); ?></small></p>

            <img src="<?php the_post_thumbnail_url(); ?>" alt="img" class="card-img-top" />

            <?php  echo '<p class="card-content">' . the_content() . '</p>' ?>
    </div>
    <?php // If comments are open or we have at least one comment
        if ( comments_open() || get_comments_number() ) :
            comments_template();
        endif;  ?>

    <?php endwhile; ?>
    <?php else : ?>
        <h2>Pas de posts :( </h2>
<?php endif;  ?>

<?php get_footer();  ?>