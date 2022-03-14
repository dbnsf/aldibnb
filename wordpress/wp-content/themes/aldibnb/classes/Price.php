<?php

class Price
{
    private $price;

    public function __construct($price)
    {
        $this->price = $price;
        $this->register();
    }

    public function register()
    {
        add_action('add_meta_boxes', [$this, 'wpDIMS_add_price']);
        add_action('save_post', [$this, 'wpDIMS_save_price']);
    }

    public function wpDIMS_add_price()
    {
        add_meta_box(
            'price',
            'Prix de la nuitée',
            [$this, 'wpDIMS_price_render'],
            'post',
            'normal'
        );
    }

    public function wpDIMS_price_render($post)
    {
        $price = get_post_meta($post->ID, $this->price, true) ?: null; ?>
        
        <input type="text" name="<?= $this->price; ?>" id="price" value="<?= $price; ?>"> €/nuit
<?php
    }

    public function wpDIMS_save_price($post_id){
        if (isset($_POST[$this->price])){
            update_post_meta($post_id, $this->price, $_POST[$this->price]);
        }
        else {
            delete_post_meta($post_id, $this->price);
        }
    }

}
