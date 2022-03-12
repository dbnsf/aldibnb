<?php
/* Template Name: Search Page */
?>
<?php get_header(); ?>
<?php
$s=get_search_query();
$args = array(
                's' =>$s
            );

 // The Query
$the_query = new WP_Query( $args );
if ( $the_query->have_posts() ) {
        _e("<div class='card-body search-title'><h2 class='card-title'>Résultats pour: ".get_query_var('s')."</h2></div>");
        while ( $the_query->have_posts() ) {
           $the_query->the_post();
                 ?>
                
                 <?php
        }
    }else{
?>
        <div class='card-body search-title'>
        <h2 class='card-title'>Aucun résultat de correspond à votre recherche.</h2>
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