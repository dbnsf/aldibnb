<div class="header__filter">
    <div class="filter__container">
        <ul class="filter__nav">
            <div class="filter__search-input">
                <!-- <label class="input-group-text" for="inputGroupSelect01">Type de logement</label> -->

                <select class="form-select" id="inputGroupSelect04" aria-label="Example select with button addon">
                    <option selected>Type de logement </option>
                    <?php
                    $terms = get_terms(['taxonomy' => 'type-logement']);
                    foreach ($terms as $term) {
                        // $active = get_query_var('type de logement') === $term->slug ? active : ''; 
                        echo '<option>' . $term->name . '</option>';
                    }
                    ?>
                </select>
            </div>

            <div class="filter__search-input">

                <select class="form-select" id="inputGroupSelect04" aria-label="Example select with button addon">
                    <option selected>Type de location </option>
                    <?php
                    $terms = get_terms(['taxonomy' => 'type-location']);
                    foreach ($terms as $term) {
                        // $active = get_query_var('type de logement') === $term->slug ? active : ''; 
                        echo '<option>' . $term->name . '</option>';
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

                <select class="form-select" id="inputGroupSelect04" aria-label="">
                    <option selected>Ville</option>
                    <?php
                    if (!$cities) {
                        $wpdb->print_error();
                    } else {
                        foreach ($cities as $key => $value) {
                            echo '<option>' .  $value->meta_value . '</option>';
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="filter__search-input">
                <?php
                ?>

                <select class="form-select" id="inputGroupSelect04" aria-label="">
                    <option selected>Prix</option>
                    <option>max. 50€</option>
                    <option>max. 100€</option>
                    <option>max. 200€</option>
                    <option>max. 300€</option>


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
