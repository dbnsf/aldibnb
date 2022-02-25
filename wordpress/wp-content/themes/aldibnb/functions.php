<?php
//FUNCTIONS

function wpDIMS_change_header_url_login ($url){
    return 'https://www.google.com'; 
}

function wpDIMS_change_footer_text ($text) {
    $text = 'AldiB\'n\'b 2022 - All rights reserved';
    return $text; 
}


function wpDIMS_theme_support()
{
    add_theme_support('title-tag');
    add_theme_support('admin-bar');
    add_theme_support('post-thumbnails'); 
}

function wpDIMS_stylesheets(){
    // wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css'); 
    wp_enqueue_style( 'style', get_stylesheet_directory_uri() . '/style.css' );
    // wp_enqueue_script('bootstrap_js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js', [], false, true); 
}

//ACTIONS
add_action('after_setup_theme', 'wpDIMS_theme_support');
add_action('wp_enqueue_scripts', 'wpDIMS_stylesheets'); 

//FILTERS
add_filter('login_headerurl', 'wpDIMS_change_header_url_login');
add_filter('admin_footer_text', 'wpDIMS_change_footer_text'); 


/*function wpheticMetaBocRender(){
    $checked = (get_post_meta(get_the_ID(), 'wpheticSponso', true)) ?>
    <input type="checkbox" value="true" name="sponso" id="sponso" <?= $checked ? 'checked' : '' ?>/>
    <label for="sponso">Contenu sponso ?</label>
    <?php 
}*/

/* add_action('save_post', 'wpheticMetaBoxSave'); 

function wpheticMetaBoxSave($post_ID){
    if($_POST['sponso'] === 'true') {
        update_post_meta($post_ID, 'wpheticSponso', 'true');
    }
    else {
        delete_post_meta($post_ID, 'wpheticSponso'); 
    }
} */
//vardump fun_get_args
