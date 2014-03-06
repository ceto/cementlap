<?php if (is_page_template('tmpl-home.php')): ?>
<section class="hero" role="banner">
  <div class="hero-content">
    <span class="hero-text">
        <?php bloginfo('description' ); ?>
    </span>
    <a href="?product-category=cementlap" class="btn btn-light-line">Lapok megtekintése</a>
  </div>
</section> 
<?php endif ?>

<?php if (is_archive()) : ?>
  <aside class="sidebar sidebar-topad" role="complementary">
    <?php dynamic_sidebar('sidebar-topad'); ?>
  </aside><!-- /.sidebar -->
<?php endif; ?>