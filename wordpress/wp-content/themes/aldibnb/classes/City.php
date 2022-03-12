<?php

class City
{
    private $city;

    public function __construct($city)
    {
        $this->city = $city;
        $this->register();
    }

    public function register()
    {
        add_action('add_meta_boxes', [$this, 'wpDIMS_add_city']);
        add_action('save_post', [$this, 'wpDIMS_save_city']);
    }

    public function wpDIMS_add_city()
    {
        add_meta_box(
            'city',
            '[SEO] Ville dans laquelle se situe votre logement',
            [$this, 'wpDIMS_city_render'],
            'post',
            'normal'
        );
    }

    public function wpDIMS_city_render($post)
    {
        $city = get_post_meta($post->ID, $this->city, true) ?: null; ?>
        
        <input type="text" name="<?= $this->city; ?>" id="city" value="<?= $city; ?>"> <i>exemple : Paris</i>
<?php
    }

    public function wpDIMS_save_city($post_id){
        if (isset($_POST[$this->city])){
            update_post_meta($post_id, $this->city, $_POST[$this->city]);
        }
        else {
            delete_post_meta($post_id, $this->city);
        }
    }

}
