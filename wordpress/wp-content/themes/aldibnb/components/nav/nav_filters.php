<nav class="navbar navbar-light bg-light">
    <inp class="container-fluid">
        <a class="navbar-brand">Filtres</a>

        <label class="input-group-text" for="inputGroupSelect01">Type de logement</label>

        <select class="form-select" id="inputGroupSelect04" aria-label="Example select with button addon">
            <option selected>Choose ... </option>
            <?php
            $terms = get_terms(['taxonomy' => 'type de logement']);
            foreach ($terms as $term) {
                var_dump($term);
                // $active = get_query_var('type de logement') === $term->slug ? active : ''; 
                echo '<option>' . $term->name . '</option>';
            }
            ?>
        </select>

        <label class="input-group-text" for="inputGroupSelect01">Type de location</label>

<select class="form-select" id="inputGroupSelect04" aria-label="Example select with button addon">
    <option selected>Choose ... </option>
    <?php
    $terms = get_terms(['taxonomy' => 'type de location']);
    foreach ($terms as $term) {
        var_dump($term);
        // $active = get_query_var('type de logement') === $term->slug ? active : ''; 
        echo '<option>' . $term->name . '</option>';
    }
    ?>
</select>

        <?php get_search_form(); ?>
        </div>
</nav>