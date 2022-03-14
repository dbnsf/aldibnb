<?php
$form_value = (isset($value)) ? $value : esc_attr__(apply_filters('the_search_query', get_search_query()));

?>

<form method="get" id="searchform" action=" <?php get_option('search') ?> /">
    <div>
        <input type="hidden" name="post_type" value=" <?= $post_type ?>" />

        <div class="filter__search-input">
            <!-- <label class="input-group-text" for="inputGroupSelect01">Type de logement</label> -->

            <select class="form-select" id="inputGroupSelect04" name="logement" id="logement" aria-label="Example select with button addon">
                <option selected>Type de logement </option>
                <?php
                $terms = get_terms(['taxonomy' => 'type-logement']);
                foreach ($terms as $term) {
                    // $active = get_query_var('type de logement') === $term->slug ? active : ''; 
                    echo '<option value="' . $value->meta_value . '">' . $term->name . '</option>';
                }
                ?>
            </select>
        </div>

        <div class="filter__search-input">

            <select class="form-select" id="inputGroupSelect04" name="location" id="location" aria-label="Example select with button addon">
                <option selected>Type de location </option>
                <?php
                $terms = get_terms(['taxonomy' => 'type-location']);
                foreach ($terms as $term) {
                    // $active = get_query_var('type de logement') === $term->slug ? active : ''; 
                    echo '<option value="' . $value->meta_value . '">' . $term->name . '</option>';
                }
                ?>
            </select>
        </div>

        <div class="filter__search-input">
            <?php

            global $wpdb;

            $querystr = "
    SELECT DISTINCT meta_value 
    FROM $wpdb->postmeta 
    WHERE meta_key LIKE 'wpDIMS_city' 
    ORDER BY meta_value ASC
    ";

            $cities = $wpdb->get_results($querystr, OBJECT);
            ?>

            <select class="form-select" id="inputGroupSelect04" name="city" id="city" aria-label="">
                <option selected>Ville</option>
                <?php
                if (!$cities) {
                    $wpdb->print_error();
                } else {
                    foreach ($cities as $key => $value) {
                        echo '<option value="' . $value->meta_value . '">' .  $value->meta_value . '</option>';
                    }
                }
                ?>
            </select>
        </div>

        <div class="filter__search-input">
            <?php
            ?>

            <select class="form-select" id="inputGroupSelect04" name="price" id="price" aria-label="">
                <option selected>Prix</option>
                <option value="50">max. 50€</option>
                <option value="100">max. 100€</option>
                <option value="200">max. 200€</option>
                <option value="300">max. 300€</option>


            </select>
        </div>
        <input class="form-control" type="text" value=" <?= $form_value ?> " name="s" id="s" />
        <input class="registration__button" type="submit" id="searchsubmit" value=" <?= esc_attr(__('Search')) ?>" />
    </div>
</form>