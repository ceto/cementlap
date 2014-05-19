<header class="banner" role="banner">
  <div class="hbg"></div>
  <a class="brand" href="<?php echo home_url(); ?>/"><?php bloginfo('name'); ?></a>
  <?php do_action('icl_language_selector'); ?>
  <nav class="nav-main" role="navigation">
    <?php
      if (has_nav_menu('primary_navigation')) :
        wp_nav_menu(array('theme_location' => 'primary_navigation', 'menu_class' => 'nav1 nav nav-pills'));
      endif;
    ?>
    <?php
      if (has_nav_menu('secondary_navigation')) :
        wp_nav_menu(array('theme_location' => 'secondary_navigation', 'menu_class' => 'nav2 nav nav-pills'));
      endif;
    ?>
    <?php
      if (has_nav_menu('tertiary_navigation')) :
        wp_nav_menu(array('theme_location' => 'tertiary_navigation', 'menu_class' => 'nav3 nav nav-pills'));
      endif;
    ?>
  </nav>
</header>
