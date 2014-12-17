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


    <?php if ( is_front_page() ) : ?>
    <!-- Master Slider -->
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/vendor/masterslider/masterslider.min.js"></script>
    <script>

      var slider = new MasterSlider();
      slider.setup('masterslider' , {
        width:1600,    // slider standard width
        height:800,   // slider standard height
        space:0,
        preload:3,
        autoplay:true,
        fullwidth:true,
        autoHeight:true,
        view:"fade"
        
        // more slider options goes here...
      });
      // adds Arrows navigation control to the slider.
      slider.control('bullets');
      slider.control('thumblist', { 
        autohide:false,
        inset:false,
        width:160,
        height:80,
        space:20

      });

    </script>
  <?php endif; ?>
  <!-- Please call pinit.js only once per page -->
<!-- <script type="text/javascript" async defer src="//assets.pinterest.com/js/pinit.js"></script> -->
</body>
</html>
