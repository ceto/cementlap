  <?php if (has_nav_menu('prodsitemap_navigation')) : ?>
    <section id="prsmmodal" class="prsmwrap menumodal">
        <nav class="prsmnav">
          <?php wp_nav_menu(array('theme_location' => 'prodsitemap_navigation', 'menu_class' => 'prsmmenu')); ?>
        </nav>
    </section>
  <?php endif; ?>