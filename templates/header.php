<header class="banner" role="banner">
<div class="banner__inner">
  <div class="hbg"></div>
  <a class="brand" href="<?php echo home_url(); ?>/"><?php bloginfo('name'); ?></a>
  <?php if (ICL_LANGUAGE_CODE!='de') { ?>
    <?php do_action('icl_language_selector'); ?>
  <?php } ?>



  <?php get_template_part('templates/prsm'); ?>

  <nav class="nav-main" role="navigation">
    <?php
      if (has_nav_menu('primary_navigation')) :
        wp_nav_menu(array('theme_location' => 'primary_navigation', 'menu_class' => 'nav1 nav nav-pills', 'items_wrap' => '<ul id="%1$s" class="%2$s"><li class="menu-products modalmenutrigger"><a data-target="prsmmodal" href="#prsmmodal">'.__('Products','cementlap').'</a></li>%3$s</ul>'));
      endif;
    ?>
    <div class="headcontact">
      <ul>
      <?php
        switch (ICL_LANGUAGE_CODE) {
          case 'de': ?>
            <li class="tel"><a href="tel:00436608222329"><i class="ion ion-iphone"></i> (+43) 660 822 2329</a></li>
            <li class="email"><a href="mailto:info@marrakeshzementfliesen.at"><i class="ion ion-email"></i> info@marrakeshzementfliesen.at</a></li>
          <? break;
          /* case 'fr': ?>
          # code...
          <? break;
          case 'nl': ?>
          # code...
          <? break; */
          default: ?>
            <li class="tel"><a href="tel:0036305822377"><i class="ion ion-iphone"></i> (+36) 30 582 2377</a></li>
            <li class="email"><a href="mailto:info@marrakesh.hu"><i class="ion ion-email"></i> info@marrakesh.hu</a></li>
          <? break;
        }
      ?>
      </ul>
    </div>
  </nav>


</div>
</header>
