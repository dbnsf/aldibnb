<nav class="stroke">
<img src="<?php bloginfo('template_url'); ?>/assets/logo1.png">


    <div class="topnav">
        <?php
        wp_nav_menu([
            'theme_location' => 'header',
            'menu_class' => 'menu',
            'container' => false
        ]);
        ?>
    </div>
    <!-- <div>
        <div class="topnav">
            <a href="#login" class="login">Login</a>
            <a href="#signup" class="signup">Sign up</a>
        </div>
    </div> -->
  </nav>