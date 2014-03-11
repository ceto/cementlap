<?php if (is_page_template('tmpl-home.php')): ?>
<section class="hero" role="banner">
  <div class="hero-content">
    <span class="hero-text">
        <?php bloginfo('description' ); ?>
    </span>
    <a href="?product-category=cementlap" class="btn btn-light-line">Lapok megtekintése</a>
  </div>
</section>
<?php elseif ( ( is_singular('post') &&  (get_post_format( $post->ID ) != 'gallery') )   ) :?>
  <?php
    $copt=get_option('cementlap_option_name');
    // $imci = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'wallimg' ); 
    // $imcismall = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'wallsmall' ); 
    // $imcimedium = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'wallmedium' ); 
    // $imcigreat = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'wallgreat' ); 

    $ima = get_post_meta( $post->ID, '_meta_wallimg_id', true );

    $imci = wp_get_attachment_image_src( $ima, 'wallimg');
    $imcismall = wp_get_attachment_image_src( $ima, 'wallsmall');
    $imcimedium = wp_get_attachment_image_src( $ima, 'wallmedium');
    $imcigreat = wp_get_attachment_image_src( $ima, 'wallgreat');
    
  ?>
  <style type="text/css">
    .hero {
      background-image:none;
    }
    @media only screen and (min-width: 768px) {
      .hero {
        background-image:url('<?php echo $imcimedium['0']; ?>');
      }
    }
    @media only screen and (min-width: 1280px) {
      .hero {
        background-image:url('<?php echo $imcigreat['0']; ?>');
      }
    }
    @media only screen and (min-width: 1600px) {
      .hero {
        background-image:url('<?php echo $imci['0']; ?>');
      }
    }
  </style>  
  <section class="hero" role="banner">
    <!--div class="hero-content">
      <h1 class="hero-text">
          <?php the_title();  ?>
      </h1>
    </div-->
  </section> 
<?php elseif ( ( is_page()  )   ) :?>
  <?php
    $copt=get_option('cementlap_option_name');
    $imci = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'wallimg' ); 
    $imcismall = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'wallsmall' ); 
    $imcimedium = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'wallmedium' ); 
    $imcigreat = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'wallgreat' ); 
  ?>
  <style type="text/css">
    .hero {
      background-image:none;
    }
    @media only screen and (min-width: 768px) {
      .hero {
        background-image:url('<?php echo $imcimedium['0']; ?>');
      }
    }
    @media only screen and (min-width: 1280px) {
      .hero {
        background-image:url('<?php echo $imcigreat['0']; ?>');
      }
    }
    @media only screen and (min-width: 1600px) {
      .hero {
        background-image:url('<?php echo $imci['0']; ?>');
      }
    }
  </style>  
  <section class="hero feles" role="banner">
    <div class="hero-content">
      <h1 class="hero-text">
          <?php the_title();  ?>
      </h1>
    </div>
  </section> 
<?php endif; ?>

<?php if (is_archive()) : ?>
  <aside class="sidebar sidebar-topad" role="complementary">
    <?php dynamic_sidebar('sidebar-topad'); ?>
  </aside><!-- /.sidebar -->
<?php endif; ?>


