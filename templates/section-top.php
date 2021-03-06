
<?php if (is_page_template('tmpl-home.php')): ?>
<!-- <section class="hero" role="banner">
  <div class="hero-content">
    <span class="hero-text">
        <?php bloginfo('description' ); ?>
    </span>
    <a href="?product-category=cementlap" class="btn btn-light-line"><?php _e('Lapok megtekintése','root'); ?></a>
  </div>
</section> -->

  <?php
    $sl_args = array(
      'post_type'   => array('slide'),
      'ignore_sticky_posts' => true,
      'posts_per_page'         => -1,
      //'orderby' => 'menu_order',
      //'order' => 'ASC'
    );
    $the_slides = new WP_Query( $sl_args );
  ?>
  <section id="home--bilderblock" class="home--bilderblock is_light">
    <div class="wrapper wrapper-fullwidth">
        <div class="master-slider ms-skin-default" id="masterslider">
          <?php while ( $the_slides->have_posts() ) : $the_slides->the_post(); ?>

            <?php
              $orig_id=icl_object_id($post->ID, 'slide', true, 'hu');
              if (has_post_thumbnail($orig_id) ) {
                $image_id = get_post_thumbnail_id($orig_id);
                $thumb_url_array = wp_get_attachment_image_src($image_id, 'slidethumb21', true);
                $image_url_array = wp_get_attachment_image_src($image_id, 'slide21', true);
                $thumb_url = $thumb_url_array[0];
                $image_url = $image_url_array[0];
            ?>
            <div class="ms-slide">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/vendor/masterslider/blank.gif" data-src="<?php echo $image_url; ?>" alt="<?php the_title(); ?>"/>
                <img src="<?php echo $thumb_url; ?>" width="160" height="80" alt="<?php the_title(); ?>" class="ms-thumb"/>
                <div class="ms-info">
                  <span class="bazi"><?php the_title(); ?></span>
                  <a href="<?php echo get_post_meta($post->ID,'_meta_btnurl',true); ?>" class="btn btn-light-line"><?php echo get_post_meta($post->ID,'_meta_btntxt',true); ?></a>
                </div>
            </div>
          <?php  } endwhile; ?>
        </div>
    </div>
  </section>


<?php elseif ( ( is_singular('post') && (get_post_format( $post->ID ) != 'gallery') )    ) :?>
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
<?php elseif ( is_page()   ) :?>
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
          <?php if ( is_page_template('tmpl-instock.php')  ) : ?>
            <span class="hero-text__taxdesc"><?= strftime('%F') ?></span>
          <?php endif; ?>
          <?php the_title(); ?>
      </h1>
    </div>
  </section>
<?php elseif ( is_singular('group')   ) :?>
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
  <section class="hero hero--blurred" role="banner">
    <div class="hero-content">
      <h1 class="hero-text">
          <a class="headback" href="<?= get_the_permalink(wp_get_post_parent_id(get_the_ID())); ?>"><i class="ion-ios-undo"></i>&nbsp; <?= get_the_title(wp_get_post_parent_id(get_the_ID())); ?></a>
            <?php the_title(); ?>
        </h1>
    </div>
  </section>
<?php endif; ?>

<?php if (is_archive() || is_singular(kontener)) : ?>

  <?php if (is_tax('product-style')) : ?>
    <?php
      $aktermterm_id = term_exists( get_query_var( 'term' ) );
      $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));

      $saba = get_tax_meta( $aktermterm_id, 'ps_sablon_id');
      $sabci = wp_get_attachment_image_src( $saba['id'], 'wallsmall');

      $catpagelink_hu=get_the_permalink( icl_object_id(8023,'page','true' ) );

    ?>

    <section class="hero hero--blurred" role="banner">
      <div class="hero-content">
        <h1 class="hero-text">
          <a class="headback" href="<?= $catpagelink_hu; ?>"><i class="ion-ios-undo"></i>&nbsp; <?php _e('Cementlap minták','cementlap'); ?></a>

            <?= $term->name;  ?>
        </h1>
        <?php if (get_tax_meta( $aktermterm_id, 'ps_sablon_id')) : ?>
                 <style type="text/css">
          .hero__action {
            background-image:url('<?php echo $sabci['0']; ?>') !important;
          }
        </style>
        <? endif; ?>
        <div class="hero__action">
          <span class="instr"><?php _e('Szinezd és terítsd le egyediben','cementlap'); ?></span>
          <a href="<?php _e('http://designer.marrakeshcementlap.hu','cementlap'); ?>" target="_blank" class="button"><?php _e('Tervezőprogram indítása','cementlap'); ?></a>
        </div>
      </div>
    </section>
    <?php elseif (is_tax('style-group')) : ?>
    <?php
      $aktermterm_id = term_exists( get_query_var( 'term' ) );
      $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));

      $parenttermid = $term->parent;
      $brelems = array();
      while ($parenttermid!==0) {
        $theparent=get_term_by( 'id', $parenttermid, 'style-group' );
        array_push($brelems,$theparent);
        $parenttermid=$theparent->parent;
      }
      $brelems=array_reverse($brelems);
    ?>
    <section class="hero hero--blurred" role="banner">
      <div class="hero-content">
        <?php if ($brelems): ?>
          <ul class="breadcrumb breadcrumb--grupi">
            <?php foreach ($brelems as $key => $value) : ?>
               <li><a href="<?= get_term_link( $value , 'style-group') ?>"><?= $value->name ?></a></li>
            <?php endforeach; ?>
        </ul>
        <?php endif ?>

        <h1 class="hero-text">
            <?= $term->name;  ?><?php if ($term->description): ?><small> (<?= $term->description ?>)</small><?php endif; ?>
        </h1>
      </div>
    </section>
    <?php elseif (is_tax('product-category') || is_tax('product-color') || is_tax('product-design')) : ?>
       <?php
      $aktermterm_id = term_exists( get_query_var( 'term' ) );
      $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
      $parenttermid = $term->parent;
    ?>
    <section class="hero hero--blurred" role="banner">
      <div class="hero-content">
        <h1 class="hero-text">
          <?php if (is_tax('product-category')): ?>
            <span class="hero-text__taxdesc"><?= __('Termékkategória','cementlap') ?></span>
          <?php elseif (is_tax('product-design')) : ?>
            <span class="hero-text__taxdesc"><?= __('Stílus','cementlap') ?></span>
          <?php elseif (is_tax('product-color')) : ?>
            <span class="hero-text__taxdesc"><?= __('Szín','cementlap') ?></span>
          <?php endif; ?>
          <?= $term->name;  ?>
        </h1>
      </div>
    </section>



  <?php else : ?>
    <aside class="sidebar sidebar-topad" role="complementary">
      <?php dynamic_sidebar('sidebar-topad'); ?>
    </aside><!-- /.sidebar -->
  <?php endif; ?>
<?php endif; ?>


