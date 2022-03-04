<?php get_header(); ?>

<?php if (have_posts()) : ?>

    <?php while (have_posts()) : the_post(); ?>
    <div class="single__container">
        <div class="img__container">
        <img src="<?php the_post_thumbnail_url(); ?>" alt="img" class="card-img-top" />
        </div>
        <div class="card-body">
            <h2 class="card-title"><?php the_title(); ?></h2>
            <?php  echo '<p class="card-content">' . the_content() . '</p>' ?>
            <p class="card-text"><small class="text-muted">Ecrit le : <?php the_date(); ?></small></p>
        </div>
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