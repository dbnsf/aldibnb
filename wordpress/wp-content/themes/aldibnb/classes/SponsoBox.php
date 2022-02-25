<?php
class SponsoBox
{

    private $metakey;
    private $price;

    public function __construct($metakey)
    {
        $this->metakey = $metakey;
        $this->price = $metakey . '_price';

        $this->register();
    }

    public function register()
    {
        add_action('add_meta_boxes', [$this, 'wpDIMS_add_metabox']);
        add_action('save_post', [$this, 'wpDIMS_save_metabox']);
    }

    public function wpDIMS_add_metabox()
    {
        add_meta_box(
            'sponso',
            'Contenu sponsorisé',
            [$this, 'wpDIMS_metabox_render'],
            'post',
            'side'
        );
    }

    public function wpDIMS_save_metabox($post_id)
    {
        if ($_POST[$this->metakey] === 'true') {
            update_post_meta($post_id, $this->metakey, 'true');
        } else {
            delete_post_meta($post_id, $this->metakey);
        }

        if ($_POST[$this->price] === 'true') {
            update_post_meta($post_id, $this->price, $_POST[$this->price]);
        } else {
            delete_post_meta($post_id, $this->price);
        }
    }



    public function wpDIMS_metabox_render($post)
    {
        $checked = get_post_meta($post->ID, $this->metakey, true) ? 'checked' : null;
        $price = get_post_meta($post->ID, $this->price, true) ? : null; ?>

        <input type="checkbox" value="true" name="<?= $this->metakey ?>" id="sponso" <?= $checked; ?> />
        <label for="sponso">Contenu sponso ?</label>

        <input type="text" name="<?= $this->price; ?>" id="price" value="<?= $price; ?>">
<?php
    }
}
