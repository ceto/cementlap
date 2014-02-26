<?php if (is_page() && !is_front_page()): ?>
<nav class="nav-sub" role="navigation">
  <?php if (has_nav_menu('vasinfo_navigation')) : ?>
    <h3><?php _e('Vásárlási információk','root') ?></h3>    
   <?php wp_nav_menu(array('theme_location' => 'vasinfo_navigation', 'menu_class' => 'nav-vasinfo nav nav-pills')); ?>
  
  <?php endif; ?>
    <?php if (has_nav_menu('lerakinfo_navigation')) : ?>
    <h3><?php _e('Lerakás és ápolás','root') ?></h3>    
    <?php wp_nav_menu(array('theme_location' => 'lerakinfo_navigation', 'menu_class' => 'nav-lerakinfo nav nav-pills')); ?>
  <?php endif; ?>

  <?php if (has_nav_menu('kapcsinfo_navigation')) : ?>
    <h3><?php _e('Kapcsolat és elérhetőség','root') ?></h3>    
    <?php wp_nav_menu(array('theme_location' => 'kapcsinfo_navigation', 'menu_class' => 'nav-kapcsinfo nav nav-pills')); ?>
  <?php endif; ?>
</nav>
<?php endif; ?>