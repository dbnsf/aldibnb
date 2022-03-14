<?php
//FUNCTIONS
require_once 'classes/SponsoBox.php';
$sponso = new SponsoBox('wpDIMS_sponso');

require_once 'classes/Price.php';
$price = new Price('wpDIMS_price');

require_once 'classes/City.php';
$price = new City('wpDIMS_city');

global $wpdb;

function wpDIMS_clean_role()
{
    $admin = get_role('administrator');
    $admin->remove_cap('manage_events');
    remove_role('event_manager');
}

function wpDIMS_add_role()
{
    add_role('client', 'Event Manager', [
        'read' => true,
        'manage_events' => true
    ]);
}

function wpDIMS_change_footer_text($text)
{
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

function wpDIMS_stylesheets()
{
    wp_enqueue_style('style', get_stylesheet_directory_uri() . '/style.css');
}

function wpDIMS_nav_menu_css_class($classes)
{
    $classes[] = 'nav-item';
    return $classes;
}

function wpDIMS_nav_menu_link_attributes($atts)
{
    $atts['class'] = 'nav-link';
    return $atts;
}


// ----taxonomy
function wpDIMS_register_booking_taxonomy()
{

    $labels = [
        'name' => 'Type de location',
        'singular_name' => 'type-location',
        'search_items' => 'Rechercher un type',
        'all_items' => 'Tous les types'

    ];

    $args = [
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_in_rest'               => true,



    ];

    register_taxonomy('type-location', ['post'], $args);
}
function wpDIMS_register_type_taxonomy()
{
    $labels = [
        'name' => 'Type de logement',
        'singular_name' => 'type-logement',
        'search_items' => 'Rechercher un type',
        'all_items' => 'Tous les types'
    ];
    $args = [
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_in_rest'               => true,

    ];
    register_taxonomy('type-logement', ['post'], $args);
}



//ACTIONS

add_action('switch_theme', 'wpDIMS_clean_role');
add_action('after_switch_theme', 'wpDIMS_add_role');
add_action('after_setup_theme', 'wpDIMS_theme_support');
add_action('wp_enqueue_scripts', 'wpDIMS_stylesheets');
add_action('init', 'wpDIMS_register_type_taxonomy');
add_action('init', 'wpDIMS_register_booking_taxonomy');
add_action('after_switch_theme', function () {
    wp_insert_term('log', 'type de logement');
    wp_insert_term('loc', 'type de location');
    flush_rewrite_rules();
});
add_action('manage_post_posts_custom_column', function ($col, $post_id) {
    if ($col === 'image') {
        the_post_thumbnail('thumbnail', $post_id);
    } elseif ($col === 'prix') {
        echo get_post_meta($post_id, 'wpDIMS_price', true) . ' €';
    } elseif ($col === 'ville') {
        echo get_post_meta($post_id, 'wpDIMS_city', true);
    } elseif ($col === 'résumé') {
        the_excerpt($post_id);
    }
}, 10, 2);

add_action('pre_get_posts', function($query){
    if(is_admin() || $query->is_main_query()){
        return;
    }
    if(get_query_var('city')) {
        $meta_query = $query->get('meta_query', []);
        $meta_query[] = array(
            'key' => 'wpDIMS_city',
            'compare' => 'EXISTS'
        );
        $query->set('meta_query', $meta_query); 

    }
});
add_action('wp_enqueue_scripts', 'your_theme_slug_public_scripts');
add_action('the_content', 'wpb_author_info_box');
add_action('customize_register', 'themeslug_theme_customizer');



//FILTERS
add_filter('query_vars', function ($params) {
    $params[] = 'city';
    $params[] = 'location';
    $params[] = 'logement';
    $params[] = 'price';
    $params[] = 's';

    return $params;
});
add_filter('admin_footer_text', 'wpDIMS_change_footer_text');
add_filter('manage_post_posts_columns', function ($col) {
    print_r($col);
    return array(
        'cb' => $col['cb'],
        'title' => $col['title'],
        'résumé' => 'Résumé',
        'image' => 'Image',
        'taxonomy-type-logement' => $col['taxonomy-type-logement'],
        'taxonomy-type-location' => $col['taxonomy-type-location'],
        'prix' => 'Prix',
        'ville' => 'Ville',
        'comments' => $col['comments'],
    );
});
add_filter('wp_nav_menu_items', function ($items, $args) {
    if ('header' != $args->theme_location) {
        return $items;
    }
    $items .= '<li class="mmy-custom-login-logout-link menu-button menu-item">';
    if (is_user_logged_in()) {
        $text            = 'Logout';
        $logout_redirect = home_url('/');
        $items .= '<a href="' . wp_logout_url($logout_redirect) . '" title="' . esc_attr($text) . '" class="wpex-logout"><span class="link-inner">' . strip_tags($text) . '</span></a>';
    } else {
        $text      = 'Login';
        $login_url = wp_login_url();
        $items .= '<a href="' . esc_url($login_url) . '" title="registration"><span class="link-inner">' . strip_tags($text) . '</span></a><a href="/registration" title="' . esc_attr($text) . '"><span class="link-inner">Registration</span></a>';
    }
    $items .= '</li>';
    return $items;
}, 20, 2);





//COMMENTS
function your_theme_slug_comments($comment, $args, $depth)
{
    $GLOBALS['comment'] = $comment; ?>
    <li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">

        <div class="comment-wrap">
            <div class="comment-img">
                <?php echo get_avatar($comment, $args['avatar_size'], null, null, array('class' => array('img-responsive', 'img-circle'))); ?>
            </div>
            <div class="comment-body">
                <h4 class="comment-author"><?php echo get_comment_author_link(); ?></h4>
                <span class="comment-date"><?php printf(__('%1$s at %2$s', 'your-text-domain'), get_comment_date(),  get_comment_time()) ?></span>
                <?php if ($comment->comment_approved == '0') { ?><em><i class="fa fa-spinner fa-spin" aria-hidden="true"></i> <?php _e('Comment awaiting approval', 'your-text-domain'); ?></em><br /><?php } ?>
                <?php comment_text(); ?>
                <span class="comment-reply"> <?php comment_reply_link(array_merge($args, array('reply_text' => __('Répondre', 'your-text-domain'), 'depth' => $depth, 'max_depth' => $args['max_depth'])), $comment->comment_ID); ?></span>
            </div>
        </div>
    <?php }

// Enqueue comment-reply

function your_theme_slug_public_scripts()
{
    if (!is_admin()) {
        if (is_singular() && get_option('thread_comments')) {
            wp_enqueue_script('comment-reply');
        }
    }
}

// FETCH AUTHOR INFORMATIONS
function wpb_author_info_box($content)
{
    global $post;
    if (is_single() && isset($post->post_author)) {
        $display_name = get_the_author_meta('display_name', $post->post_author);
        if (empty($display_name))
        $display_name = get_the_author_meta('nickname', $post->post_author);
        $user_description = get_the_author_meta('user_description', $post->post_author);
        $user_website = get_the_author_meta('url', $post->post_author);
        $user_posts = get_author_posts_url(get_the_author_meta('ID', $post->post_author));
        if (!empty($display_name))
            if (!empty($user_description))
                $author_details_out = '<p class="author_links"><a href="' . $user_posts . '">Toutes les annonces de ' . $display_name . '</a>';

        $author_details = '<p class="author_details">' . get_avatar(get_the_author_meta('user_email'), 90) . '<div>' . '<h5 class="author_name">' . $display_name . '</h5>' . $author_details_out  . '<p class="author_description">' . nl2br($user_description) .   '</p></div>';
        if (!empty($user_website)) {
        } else {
            $author_details .= '</p>';
        }
        $content = $content . '<div class="author_bio_section" >' . $author_details . '</div>';
    }
    return $content;
}
remove_filter('pre_user_description', 'wp_filter_kses');


// CUSTOM LOGO MENU
function themeslug_theme_customizer($wp_customize)
{
    $wp_customize->add_setting('mytheme_logo');
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'mytheme_logo', array(
        'label'    => 'Logo',
        'section'  => 'mytheme_logo_section',
        'settings' => 'mytheme_logo',
    )));
}
