<?php
/**
 * Plugin Name:       Interesting offers
 * Description:       This plugin shows in a specific banner some interesting offers.
 * Author:            Boulkrinat Ilyès
 */

if(!defined('ABSPATH')){
    wp_die('Accès interdit');
}

 function display_special_offers(){
    $offer_posts = wp_dashboard_recent_posts(
        array(
			'max'    => 3,
			'status' => 'publish',
			'order'  => 'DESC',
			'title'  => __( 'Specials Offers' ),
			'id'     => 'published-posts',
            'sponso' => 'true'
		)
	);
	
 };

?>

<div>
<?php
    if($offer_posts->have_posts() ) {
        while ($offer_posts->have_posts() ){
            $offer_posts->the_post();
            ?>
                <div>
                    <!-- DISPLAY MY VALUES -->
                </div>
            <?php
        }
    }
?>
</div>

<?php

function display_special_offers_init(){
    add_shortcode('mes offres spéciales', 'display_special_offers');
}

add_action('init', 'display_special_offers_init');

 register_deactivation_hook(__FILE__, function(){

 });


//  add_action("get_header", 
//     function()
//     {
//         echo "tagazog";
//     });

?>