<header class="banner" role="banner">
  <a class="brand" href="<?php echo home_url(); ?>/"><?php bloginfo('name'); ?></a>
  <button type="button" class="navbar-toggle"><span class="ion-navicon"></span></button>  
  <nav class="nav-main" role="navigation">
    <?php
      if (has_nav_menu('primary_navigation')) :
        wp_nav_menu(array('theme_location' => 'primary_navigation', 'menu_class' => 'nav nav-pills'));
      endif;
    ?>
  </nav>
  <div class="othere">
    <a href="#" class="phone"><span class="ion-iphone"></span></a>
    <a href="#" class="mail copener"><span class="ion-email"></span></a>
  </div>
</header>
