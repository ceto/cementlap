<?php get_template_part('templates/head'); ?>
<body <?php body_class(); ?>>
  <!--[if lt IE 8]><div class="alert alert-warning">
      <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'roots'); ?>
  </div><![endif]-->

  <?php
    do_action('get_header');
    get_template_part('templates/header');
  ?>
  <div class="mindenmas">
    <nav class="off-canvas-navigation">
      <a class="menu-button" href="#menu"><i class="ion-navicon-round"></i></a>
      <a class="brandi" href="<?php echo home_url(); ?>/"><?php bloginfo('name'); ?></a>
    </nav>
    <?php get_template_part('templates/section','top'); ?>
    <div class="document" role="document">
      <?php get_template_part('templates/subnavigation'); ?>
      <main class="main <?php echo roots_main_class(); ?>" role="main">
        <?php include roots_template_path(); ?>
      </main><!-- /.main -->
     
      <?php /* if (roots_display_sidebar()) : ?>
        <aside class="sidebar <?php echo roots_sidebar_class(); ?>" role="complementary">
          <?php include roots_sidebar_path(); ?>
        </aside><!-- /.sidebar -->
      <?php endif; */?>
    </div><!-- /.wrap -->
    <?php get_template_part('templates/section','bottom'); ?>
    <?php get_template_part('templates/footer'); ?>
  </div><!-- /.mindenmas -->
</body>
</html>
