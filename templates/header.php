<header class="banner" role="banner">
<div class="banner__inner">
  <div class="hbg"></div>
  <a class="brand" href="<?php echo home_url(); ?>/"><?php bloginfo('name'); ?></a>
  <?php if (ICL_LANGUAGE_CODE!='de') { ?>
    <?php do_action('icl_language_selector'); ?>
  <?php } ?>
  <nav class="nav-main" role="navigation">
    <?php
      if (has_nav_menu('primary_navigation')) :
        wp_nav_menu(array('theme_location' => 'primary_navigation', 'menu_class' => 'nav1 nav nav-pills'));
      endif;
    ?>
    <div class="headcontact">
      <ul>
      <?php if (ICL_LANGUAGE_CODE!='de') { ?>
        <li class="tel"><a href="tel:003623950282"><i class="ion ion-iphone"></i> (+36) 23 950 282</a></li>
        <li class="email"><a href="mailto:info@marrakesh.hu"><i class="ion ion-email"></i> info@marrakesh.hu</a></li>
      <?php } else { ?>
        <li class="tel"><a href="tel:003623950282"><i class="ion ion-iphone"></i> (+43) 660 822 2329</a></li>
        <li class="email"><a href="mailto:ambrus.gabor@ymail.com"><i class="ion ion-email"></i> ambrus.gabor@ymail.com</a></li>
      <?php } ?>
      </ul>


    </div>
  </nav>
</div>
</header>
