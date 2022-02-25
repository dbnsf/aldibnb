<?php 
/**
 * Template Name: Modèle avec bannière
 * Template Post Type : page, post
 * Description: un modèle de page avec une belle bannière
 */

?>

<?php
    if(get_post_meta(get_the_ID(), 'wpDIMS_sponso', true)) : ?>
    <p class="alert alert-info">Contenu Sponsorisé</p>
    <?php endif; ?>
?>