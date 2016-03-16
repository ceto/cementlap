<header class="banner" role="banner">
<div class="banner__inner">
  <div class="hbg"></div>
  <a class="brand" href="<?php echo home_url(); ?>/"><?php bloginfo('name'); ?></a>
  <?php    if (ICL_LANGUAGE_CODE!='de') { ?>
    <?php do_action('icl_language_selector'); ?>
  <?php } ?>
  <nav class="nav-main" role="navigation">
    <?php
      if (has_nav_menu('primary_navigation')) :
        wp_nav_menu(array('theme_location' => 'primary_navigation', 'menu_class' => 'nav1 nav nav-pills'));
      endif;
    ?>
    <?php /*
      if (has_nav_menu('secondary_navigation')) :
        wp_nav_menu(array('theme_location' => 'secondary_navigation', 'menu_class' => 'nav2 nav nav-pills'));
      endif;
    ?>
    <?php
      if (has_nav_menu('tertiary_navigation')) :
        wp_nav_menu(array('theme_location' => 'tertiary_navigation', 'menu_class' => 'nav3 nav nav-pills'));
      endif;
    */ ?>
    <div class="headcontact">
      <ul>
        <li class="tel"><a href="tel:003623950282"><i class="ion ion-iphone"></i> (+36) 23 950 282</a></li>
        <li class="email"><a href="mailto:info@marrakesh.hu"><i class="ion ion-email"></i> info@marrakesh.hu</a></li>
      </ul>
    </div>
  </nav>
</div>
</header>
