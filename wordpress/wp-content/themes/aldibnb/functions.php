<?php
//FUNCTIONS
require_once 'classes/SponsoBox.php';
$sponso= new SponsoBox('wpDIMS_sponso'); 
global $wpdb;

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
    wp_enqueue_style( 'style', get_stylesheet_directory_uri() . '/style.css' );

}

function wpDIMS_nav_menu_css_class($classes){
    $classes[]= 'nav-item'; 
    return $classes; 
}

function wpDIMS_nav_menu_link_attributes($atts){
    $atts['class'] = 'nav-link'; 
    return $atts; 
}


// ----taxonomy
function wpDIMS_register_booking_taxonomy(){

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
function wpDIMS_register_type_taxonomy(){
    $labels = [
        'name' => 'Type de logement',
        'singular_name' => 'type-logement', 
        'search_items'=> 'Rechercher un type', 
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
add_action('after_switch_theme', function(){
    wp_insert_term('log', 'type de logement');
    wp_insert_term('loc', 'type de location'); 
    flush_rewrite_rules(); 
 
});


//FILTERS

add_filter('login_headerurl', 'wpDIMS_change_header_url_login');
add_filter('admin_footer_text', 'wpDIMS_change_footer_text'); 

//COMMENTS
function your_theme_slug_comments($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
	    
		<div class="comment-wrap">
			<div class="comment-img">
				<?php echo get_avatar($comment,$args['avatar_size'],null,null,array('class' => array('img-responsive', 'img-circle') )); ?>
			</div>
			<div class="comment-body">
				<h4 class="comment-author"><?php echo get_comment_author_link(); ?></h4>
				<span class="comment-date"><?php printf(__('%1$s at %2$s', 'your-text-domain'), get_comment_date(),  get_comment_time()) ?></span>
				<?php if ($comment->comment_approved == '0') { ?><em><i class="fa fa-spinner fa-spin" aria-hidden="true"></i> <?php _e('Comment awaiting approval', 'your-text-domain'); ?></em><br /><?php } ?>
				<?php comment_text(); ?>
				<span class="comment-reply"> <?php comment_reply_link(array_merge( $args, array('reply_text' => __('Répondre', 'your-text-domain'), 'depth' => $depth, 'max_depth' => $args['max_depth'])), $comment->comment_ID); ?></span>
			</div>
		</div>
<?php }

// Enqueue comment-reply

add_action('wp_enqueue_scripts', 'your_theme_slug_public_scripts');

function your_theme_slug_public_scripts() {
    if (!is_admin()) {
        if (is_singular() && get_option('thread_comments')) { wp_enqueue_script('comment-reply'); }
    }
}

// FETCH AUTHOR INFORMATIONS
function wpb_author_info_box( $content ) {
 
    global $post;
     
    // Detect if it is a single post with a post author
    if ( is_single() && isset( $post->post_author ) ) {
     
    // Get author's display name
    $display_name = get_the_author_meta( 'display_name', $post->post_author );
     
    // If display name is not available then use nickname as display name
    if ( empty( $display_name ) )
    $display_name = get_the_author_meta( 'nickname', $post->post_author );
     
    // Get author's biographical information or description
    $user_description = get_the_author_meta( 'user_description', $post->post_author );
     
    // Get author's website URL
    $user_website = get_the_author_meta('url', $post->post_author);
     
    // Get link to the author archive page
    $user_posts = get_author_posts_url( get_the_author_meta( 'ID' , $post->post_author));
     
    if ( ! empty( $display_name ) )
     
    // $author_details = '<p class="author_name">About ' . $display_name . '</p>';
     
    if ( ! empty( $user_description ) )
    // Author avatar, name, bio

    // $author_details_out .= ' | <a href="' . $user_website .'" target="_blank" rel="nofollow">Website</a></p>';
    $author_details_out .= '<p class="author_links"><a href="'. $user_posts .'">Toutes les annonces de ' . $display_name . '</a>';  

    $author_details .= '<p class="author_details">'. get_avatar( get_the_author_meta('user_email') , 90 ) . '<div>'. '<h5 class="author_name">' . $display_name . '</h5>' . $author_details_out  . '<p class="author_description">' . nl2br( $user_description ).   '</p></div>';
     
    // Check if author has a website in their profile
    if ( ! empty( $user_website ) ) {
     
    // Display author website link
     
    } else {
    // if there is no author website then just close the paragraph
    $author_details .= '</p>';
    }
     
    // Pass all this info to post content
    $content = $content . '<div class="author_bio_section" >' . $author_details . '</div>' ;
    }
    return $content;
    }
     
    // Add our function to the post content filter
    add_action( 'the_content', 'wpb_author_info_box' );
     
    // Allow HTML in author bio section
    remove_filter('pre_user_description', 'wp_filter_kses');


    // CUSTOM LOGO MENU
    function themeslug_theme_customizer( $wp_customize ) {

        $wp_customize->add_setting( 'mytheme_logo' );
        
        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'mytheme_logo', array(
            'label'    => 'Logo',
            'section'  => 'mytheme_logo_section',
            'settings' => 'mytheme_logo',
        ) ) );
        }
        add_action('customize_register', 'themeslug_theme_customizer');



// SEARCH POST FORM
     function custom_search_form( $form, $value = "Search", $post_type = 'post' ) {
            $form_value = (isset($value)) ? $value : attribute_escape(apply_filters('the_search_query', get_search_query()));
            $form = '<form method="get" id="searchform" action="' . get_option('search') . '/" >
            <div>
                <input  type="hidden" name="post_type"  value="'.$post_type.'" />
                <input class="form-control" type="text" value="' . $form_value . '" name="s" id="s" />
                <input class="registration__button" type="submit" id="searchsubmit"  value="'.attribute_escape(__('Search')).'" />
            </div>
            </form>';
            return $form;
        }


 