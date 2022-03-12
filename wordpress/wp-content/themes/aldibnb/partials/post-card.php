<li>
  <?php
  $post_price = get_post_meta(get_the_ID(), 'wpDIMS_price', true); ?>
  <a href="<?php the_permalink(); ?>" class="card">
    <img src="<?php the_post_thumbnail_url() ?>" class="card__image" alt="" />
    <div class="card__overlay">
      <div class="card__header">
        <div class="card__header-text">
          <h3 class="card__title"><?php the_title(); ?></h3>
          <div class="card_price-status">
            <span class="card__status post_author"><?php the_author(); ?></span>
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