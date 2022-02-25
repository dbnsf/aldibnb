//TEMPLATE DE LA HOMEPAGE ICI//
<?php get_header(); ?>
<div class="container card-group">

    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : ?>
            <?php the_post();
            get_template_part('partials/post-card')
            ?>
            

<?php endwhile ?>
<?php endif; ?>
<?php the_posts_pagination(); ?>
</div>
<?php get_footer();  ?>