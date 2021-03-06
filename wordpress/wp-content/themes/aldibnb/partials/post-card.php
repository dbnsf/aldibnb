<li>
  <?php
  $post_price = get_post_meta(get_the_ID(), 'wpDIMS_price', true);
  $post_city = get_post_meta(get_the_ID(), 'wpDIMS_city', true); 
  $typelocation = get_the_terms($post->ID, 'type-location');
if ($typelocation) {
    foreach ($typelocation as $typeloc) {
        $typeloc->name;
    }
}
  ?>

  <a href="<?php the_permalink(); ?>" class="card">
    <img src="<?php the_post_thumbnail_url() ?>" class="card__image" alt="" />
    <div class="card__overlay">
      <div class="card__header">
        <div class="card__header-text">
          <h3 class="card__title"><?php the_title(); ?></h3>
          <div class="card_price-status">
            <span class="card__status post_author"><?php echo  $typeloc->name;
                                                    if (get_post_meta(get_the_ID(), 'wpDIMS_city', true)) :
                                                    ?>
                • <?php echo $post_city ?>
              <?php endif; ?>
            </span>
            <?php if (get_post_meta(get_the_ID(), 'wpDIMS_price', true)) :
            ?>
              <span class="card__status post_price"><?php echo $post_price ?><sup>€</sup>/nuit</span>
            <?php endif; ?>
          </div>
        </div>
      </div>

      <?php echo '<p class="card__description">' . substr(get_the_excerpt(), 0, 110) . ' [...]' . '</p>' ?>
    </div>
  </a>
</li>