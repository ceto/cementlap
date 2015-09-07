<?php if (is_page() && !is_front_page() && ($post->post_parent!=0) ): ?>
<nav class="nav-sub" role="navigation">
  <h2 class="subnav-title"><?php  _e('Information','cementlap') ?></h2>

  <div class="snavitem">
  <?php if (has_nav_menu('vasinfo_navigation')) : ?>
    <h3><?php _e('Buyers\' information','cementlap') ?></h3>    
   <?php wp_nav_menu(array('theme_location' => 'vasinfo_navigation', 'menu_class' => 'nav-vasinfo nav nav-pills')); ?>
  <?php endif; ?>
  </div>
  
  <div class="snavitem">
  <?php if (has_nav_menu('lerakinfo_navigation')) : ?>
    <h3><?php _e('Product information','cementlap') ?></h3>    
    <?php wp_nav_menu(array('theme_location' => 'lerakinfo_navigation', 'menu_class' => 'nav-lerakinfo nav nav-pills')); ?>
  <?php endif; ?>
  </div>
  
  <div class="snavitem">
  <?php if (has_nav_menu('kapcsinfo_navigation')) : ?>
    <h3><?php _e('Contact details','cementlap') ?></h3>    
    <?php wp_nav_menu(array('theme_location' => 'kapcsinfo_navigation', 'menu_class' => 'nav-kapcsinfo nav nav-pills')); ?>
  <?php endif; ?>
  </div>

</nav>
<?php endif; ?>