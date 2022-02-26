            <li>
                  <a href="<?php the_permalink(); ?>" class="card">
                    <img src="<?php the_post_thumbnail_url()?>" class="card__image" alt="" />
                    <div class="card__overlay">        
                      <div class="card__header">
                        <div class="card__header-text">
                          <h3 class="card__title"><?php the_title(); ?></h3>
                          <div class="card_price-status">
                          <span class="card__status"><?php the_author(); ?></span>
                          <span class="card__status">200euros</span>
                          </div>
                        </div>
                      </div>
                      <?php  echo '<p class="card__description">' . get_the_excerpt() . '</p>' ?>;
                    </div>
                  </a>
                </li>
