<?php
//FUNCTIONS
require_once 'classes/SponsoBox.php';
$sponso= new SponsoBox('wpDIMS_sponso'); 

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


//----taxonomy
function wpDIMS_register_booking_taxonomy(){
    $labels = [
        'name' => 'Type de location',
        'singular_name' => 'Type de location', 
        'search_items'=> 'Rechercher un type', 
        'all_items' => 'Tous les types'
    ]; 

    $args = [
        'labels' => $labels,
        'public' => true,
        'hierarchical' => true,
        'show_in_rest' => true, 
        'show_admin_column' => true
    ];

    register_taxonomy('type de location', ['post'], $args); 
}
function wpDIMS_register_type_taxonomy(){
    $labels = [
        'name' => 'Type de logement',
        'singular_name' => 'Type de logement', 
        'search_items'=> 'Rechercher un type', 
        'all_items' => 'Tous les types'
    ]; 

    $args = [
        'labels' => $labels,
        'public' => true,
        'hierarchical' => true,
        'show_in_rest' => true, 
        'show_admin_column' => true
    ];

    register_taxonomy('type de logement', ['post'], $args); 
}


//ACTIONS

add_action('switch_theme', 'wpDIMS_clean_role'); 
add_action('after_switch_theme', 'wpDIMS_add_role'); 
add_action('after_setup_theme', 'wpDIMS_theme_support');
add_action('wp_enqueue_scripts', 'wpDIMS_stylesheets'); 
add_action('init', 'wpDIMS_register_type_taxonomy');
add_action('init', 'wpDIMS_register_booking_taxonomy');
add_action('after_switch_theme', function(){
    wp_insert_term('log', 'type de logement');
    wp_insert_term('loc', 'type de location'); 
    flush_rewrite_rules(); 
 
});


//FILTERS

add_filter('login_headerurl', 'wpDIMS_change_header_url_login');
add_filter('admin_footer_text', 'wpDIMS_change_footer_text'); 

