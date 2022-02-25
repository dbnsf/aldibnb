<?php
//FUNCTIONS

function wpDIMS_clean_role(){
    $admin = get_role('administrator'); 
    $admin->remove_cap('manage_events'); 
    remove_role('event_manager'); 
}

function wpDIMS_add_role(){
    add_role('client', 'Event Manager', [
        'read' => true, 
        'manage_events' => true
    ]); 
}
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
    add_theme_support('menus'); 
    register_nav_menu('header', 'Navigation dans le header'); 
}

function wpDIMS_stylesheets(){
    wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css'); 
    wp_enqueue_script('bootstrap_js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js', [], false, true); 

}

function wpDIMS_nav_menu_css_class($classes){
    $classes[]= 'nav-item'; 
    return $classes; 
}

function wpDIMS_nav_menu_link_attributes($atts){
    $atts['class'] = 'nav-link'; 
    return $atts; 
}

function wpDIMS_add_metabox(){
    add_meta_box(
        'sponso', 
        'Contenu sponsorisé',
        'wpDIMS_metabox_render', 
        'post', 
        'side'
    ); 
}

function wpDIMS_save_metabox($post_id){
    if($_POST['sponso'] === 'true'){
        update_post_meta($post_id, 'wpDIMS_sponso', 'true'); 
    }
    else {
        delete_post_meta($post_id, 'wpDIMS_sponso'); 
    }
}

//ACTIONS

add_action('switch_theme', 'wpDIMS_clean_role'); 
add_action('after_switch_theme', 'wpDIMS_add_role'); 
add_action('after_setup_theme', 'wpDIMS_theme_support');
add_action('wp_enqueue_scripts', 'wpDIMS_stylesheets'); 
add_action('add_meta_boxes', 'wpDIMS_add_metabox'); 
add_action('save_post', 'wpDIMS_save_metabox'); 

//FILTERS

add_filter('login_headerurl', 'wpDIMS_change_header_url_login');
add_filter('admin_footer_text', 'wpDIMS_change_footer_text'); 


function wpDIMS_metabox_render(){
    $checked = (get_post_meta(get_the_ID(), 'wpDIMS_sponso', true));  ?>
    <input type="checkbox" value="true" name="sponso" id="sponso" <?= $checked ? 'checked' : null ?>/>
    <label for="sponso">Contenu sponso ?</label>
    <?php 
}

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
