<div class="header__filter">
            <div class="filter__container">
            <ul class="filter__nav">
                <div class="filter__search-input">
                <!-- <label class="input-group-text" for="inputGroupSelect01">Type de logement</label> -->

<select class="form-select" id="inputGroupSelect04" aria-label="Example select with button addon">
    <option selected>Type de logement </option>
    <?php
    $terms = get_terms(['taxonomy' => 'type de logement']);
    foreach ($terms as $term) {
        var_dump($term);
        // $active = get_query_var('type de logement') === $term->slug ? active : ''; 
        echo '<option>' . $term->name . '</option>';
    }
    ?>
</select>
                </div>
               
                <div class="filter__search-input">
               
        <!-- <label class="input-group-text" for="inputGroupSelect01">Type de location</label> -->

<select class="form-select" id="inputGroupSelect04" aria-label="Example select with button addon">
    <option selected>Type de location </option>
    <?php
    $terms = get_terms(['taxonomy' => 'type de location']);
    foreach ($terms as $term) {
        var_dump($term);
        // $active = get_query_var('type de logement') === $term->slug ? active : ''; 
        echo '<option>' . $term->name . '</option>';
    }
    ?>
</select>
                </div> 
                <li id="search">
                <?php get_search_form(); ?>
                </li>
            </ul>
        </div>
        </div>

        <ul>
<?php

global $post;
$album_title = $_GET['album-title'];
$args = array(
    'post_type' => 'post',
    'posts_per_page' => 5,
    'tax_query' => array( // NOTE: array of arrays!
        array(
            'taxonomy' => 'type de logement',
            'field'    => 'name',
            'terms'    => $album_title
        )
    )
);

$myposts = get_posts( $args );
foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
    <li>
        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
    </li>
<?php endforeach; 
wp_reset_postdata();?>

</ul>

