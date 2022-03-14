<?php
class SponsoBox
{

    private $metakey;

    public function __construct($metakey)
    {
        $this->metakey = $metakey;
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
            'Contenu sponsorisé ?',
            [$this, 'wpDIMS_metabox_render'],
            'post',
            'side'
        );
    }

    public function wpDIMS_metabox_render($post)
    {

        $checked = get_post_meta($post->ID, $this->metakey, true) ? 'checked' : null;
?>

        <input type="checkbox" value="true" name="<?= $this->metakey ?>" id="sponso" <?= $checked; ?>/>
        <label for="sponso">Contenu sponsorisé ?</label><br/>

<?php
    }

    public function wpDIMS_save_metabox($post_id)
    {
        if ($_POST[$this->metakey] === 'true') {
            update_post_meta($post_id, $this->metakey, 'true');
        } else {
            delete_post_meta($post_id, $this->metakey);
        }
    }
}
