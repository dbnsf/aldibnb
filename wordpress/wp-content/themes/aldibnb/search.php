<?php
/* Template Name: Search Page */
?>
<?php get_header(); ?>
<?php
$post_city = get_post_meta(get_the_ID(), 'wpDIMS_city', true);
$post_price = get_post_meta(get_the_ID(), 'wpDIMS_price', true);

$s = get_search_query();

$args = array(
    's' => $s,
    // 'meta_query' => array(
    //     'meta_key' => 'wpDIMS_city', 
    //     'meta_value' => get_query_var('city')
    // ),
    // 'tax_query' => array(
    //     array(
    //         'taxonomy' => 'type-logement',
    //         'field'    => 'slug',
    //         'terms'    => get_query_var('type-logement')
    //     ),
    //     array(
    //         'taxonomy' => 'type-location',
    //         'field'    => 'slug',
    //         'terms'    => get_query_var('type-location')
    //     )
    //     )
);

// The Query
$the_query = new WP_Query($args);

if ($the_query->have_posts()) {
    _e("<div class='card-body search-title'><h2 class='card-title'>Résultats pour: " . $s . "</h2></div>");
    while ($the_query->have_posts()) {
        $the_query->the_post();
?>

    <?php
    }
} else {
    ?>
    <div class='card-body search-title'>
        <h2 class='card-title'>Aucun résultat ne correspond à votre recherche.</h2>
    </div>

<?php } ?>


<?php
get_template_part('components/nav/nav_filters');
?>

<ul class="cards search-cards">
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : ?>
            <?php the_post();
            get_template_part('partials/post-card')
            ?>
        <?php endwhile ?>
    <?php endif; ?>
</ul>




<?php get_footer();  ?>