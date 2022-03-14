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
    $query_args = 
        array(
			'posts_per_page'    => 3,
			'post_status' => 'publish',
            'post_type' => 'post',
            'relation' => 'AND',
            array(
            'meta_query' => array(
                    'key' => 'meta_key',
                    'value' => 'wpDIMS_sponso',
                    'compare' => '=',
            ),
            'meta_query' => array(
                'key' => 'meta_value',
                'value' => true,
                'compare' => '=',
        ),
        ),
		
	);
	$offer_posts = new WP_Query( $query_args );

    ob_start();
?>
<div>
<?php
    if($offer_posts->have_posts() ) {
        while ($offer_posts->have_posts() ){
            $offer_posts->the_post();
            ?>
                <div>
                        <h3>
                            <?php 
                                the_title();
                                the_post_thumbnail_url();
                                the_content();  
                            ?>
                        </h3>
                </div>
            <?php
        }
    }
    wp_reset_postdata();
?>
</div>
<?php
return ob_get_clean();
}

    add_shortcode('shortcut_offers', 'display_special_offers');
