<?php get_header();

$post_city = get_post_meta(get_the_ID(), 'wpDIMS_city', true);
$post_price = get_post_meta(get_the_ID(), 'wpDIMS_price', true);
$typelogement = get_the_terms($post->ID, 'type-logement');
if ($typelogement) {
    foreach ($typelogement as $typelog) {
         $typelog->name;
    }
}
$typelocation = get_the_terms($post->ID, 'type-location');
if ($typelocation) {
    foreach ($typelocation as $typeloc) {
        $typeloc->name;
    }
}

?>

<?php if (have_posts()) : ?>

    <?php while (have_posts()) : the_post();


    ?>
        <div class="single__container">
            <div class="card-body">
                <h2 class="card-title"><?php the_title(); ?></h2>
                <p class="card-text"><small class="text-muted">Publié le <?php the_date(); ?>.</small></p>

                <img src="<?php the_post_thumbnail_url(); ?>" alt="img" class="card-img-top" />

                <div class="single__main">
                    <div class="main_content">
                        <section class="card-content">
                            <div class="recap"><?php echo  $post_city . " • " . $typelog->name . " • " . $typeloc->name; ?></div>
                            <?php
                            the_excerpt();
                            the_content() ?>
                        </section>
                    </div>
                    <div class="sidebar">
                        <div class="contact__content">
                            <div>
                                <img src="https://images.unsplash.com/photo-1645627446035-d9ade996ae42?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2069&q=80" alt='profile' />
                                <h4><span class="_font-TuesdayNight">C</span>ontact</h4>
                                <p><?php the_author(); ?></p>
                                <p><?php echo get_the_author_meta('user_email'); ?></p>
                                <a href="mailto:<?php echo get_the_author_meta('user_email'); ?>">
                                    Contacter
                                </a>
                            </div>
                        </div>
                        <?php if (get_post_meta(get_the_ID(), 'wpDIMS_price', true)) :
                        ?>
                            <div class="price">
                                <span class="post_price _font-TuesdayNight"><?php echo $post_price ?><sup>€</sup><span class="sub">/nuit</span
                            </div>  
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php // If comments are open or we have at least one comment
        if (comments_open() || get_comments_number()) :
            comments_template();
        endif;  ?>

    <?php endwhile; ?>
<?php else : ?>
    <h2>Pas de posts :( </h2>
<?php endif;  ?>

<?php get_footer();  ?>