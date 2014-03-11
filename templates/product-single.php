<?php while (have_posts()) : the_post(); ?>
<?php
  // $actual=$post->ID;
  // $group_terms = wp_get_object_terms($actual, 'product-category', array (
  //    'orderby' => 'date',
  //    'order' => 'ASC',
  //    'fields' => 'all' 
  //   )
  // );
  // $group_id=$group_terms[0]->term_id;
  // $group_name=$group_terms[0]->name;
  // $group=$group_terms[0];
?>
<?php
  $copt=get_option('cementlap_option_name');
  $ima = get_post_meta( $post->ID, '_meta_wallimg_id', true );

  $imci = wp_get_attachment_image_src( $ima, 'wallimg');
  $imcismall = wp_get_attachment_image_src( $ima, 'wallsmall');
  $imcimedium = wp_get_attachment_image_src( $ima, 'wallmedium');
  $imcigreat = wp_get_attachment_image_src( $ima, 'wallgreat');
  
?>
  <?php
    $termik = array();
    $termlist=get_the_terms( $post->ID, 'product-category' );
    foreach ( $termlist as $term ) { $termik[] = $term->slug; }
    $termlist=get_the_terms( $post->ID, 'product-color' );
    foreach ( $termlist as $term ) { $termik[] = $term->slug; }
    $termlist=get_the_terms( $post->ID, 'product-design' );
    foreach ( $termlist as $term ) { $termik[] = $term->slug; }
    $termlist=get_the_terms( $post->ID, 'product-stock' );
    foreach ( $termlist as $term ) { $termik[] = $term->slug; }
    $termes = join(" ", $termik );
  ?>
<style type="text/css">
  article.product {
    background-image:none;
  }
  @media only screen and (min-width: 768px) {
    article.product {
      background-image:url('<?php echo $imcimedium['0']; ?>');
    }
  }
  @media only screen and (min-width: 1280px) {
    article.product {
      background-image:url('<?php echo $imcigreat['0']; ?>');
    }
  }
  @media only screen and (min-width: 1600px) {
    article.product {
      background-image:url('<?php echo $imci['0']; ?>');
    }
  }
</style>
  <article <?php post_class($termes); ?> >
    <figure class="product-figure" style="background-image:url('<?php echo $imcismall['0']; ?>');">
      <img src="<?php echo $imcismall['0']; ?>" alt="<?php the_title(); ?>">
    </figure>
    <div class="uszo">
      <header class="product-head">
        <a class="product-back" href="javascript:history.back()"><i class="ion-ios7-undo"></i>Cementlapok</a>
        <h1 class="product-title"><?php the_title(); ?></h1>
        <div class="product-price">
          <?php echo number_format(get_post_meta($post->ID, '_meta_price', true), 0, ',', ' '); ?>
          <span class="unit">Ft/<?php echo get_post_meta($post->ID, '_meta_unit', true); ?></span>
        </div>
        <div class="product-content">
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente, voluptate, quod, ullam facilis id earum veritatis quis nesciunt culpa unde maxime quo quibusdam blanditiis dolores sit iure eveniet commodi tempora.
          </p>
        </div>
      </header>
      <footer class="product-footer">
        <div class="action-block">
          <a href="#" class="btn">
            <?php if (has_term('raktarrol-azonnal','product-stock')) : ?>
              <?php _e('Pontos részletekért<small>Hívj: +36.20.973.4344</small>','root'); ?>
            <?php else: ?>
              <?php _e('Részletekért hívj<small> Telefonon: +36.20.973.4344</small>','root') ?>
            <?php endif; ?>
          </a>
        </div>


        
        <div class="stock-block">
          <h3><?php _e('Készlet információ, szállítás','root'); ?></h3>
          <div class="stock-status">
            <?php if (has_term('raktarrol-azonnal','product-stock')) : ?>
              <i class="ion-checkmark"></i> <?php _e('Azonnal szállítható','root') ?>
            <?php elseif ( has_term('hamarosan-erkezik','product-stock') ): ?>
               <i class="ion-plane"></i> <?php _e('Szállítás alatt','root') ?>
            <?php else: ?>
              <i class="ion-alert-circled"></i> <?php _e('Rendelésre gyártjuk','root') ?>
            <?php endif; ?>
          </div>
          
          <?php if (has_term('raktarrol-azonnal','product-stock')) : ?>
            <div class="stock-amount">
              <i class="ion-ios7-cart"></i> Raktáron van:
              <span>
                <?php echo get_post_meta($post->ID, '_meta_amount', true); ?><span class="prod-unit"><?php echo (get_post_meta($post->ID, '_meta_unit', true)=='m2')?'m<sup>2</sup>':get_post_meta($post->ID, '_meta_unit', true); ?></span>
              </span>
            </div>
          <?php elseif ( get_post_meta($post->ID, '_meta_arrive', true) !=''): ?>
            <div class="date-status"><i class="ion-clock"></i> <?php _e('Érkezik','root') ?>: <span><?php echo get_post_meta($post->ID, '_meta_arrive', true); ?></span></div>
          <?php else: ?>
            <div class="date-status"><i class="ion-clock"></i> Rendelés esetén érkezik: <span><?php echo $copt['ntd']; ?></span>  </div>
          <?php endif; ?>

          <div class="product-more">
              <a class="show-more" data-toggle="collapse" data-parent=".product-more" href="#morepanel">
                További információk a rendeléshez ... <i class="ion-help-circled"></i>
              </a>
              <div id="morepanel" class="panel-collapse morepanel collapse">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                Nobis, saepe, magnam, expedita, dolorem aperiam libero eius possimus.
              </div>
          </div>

        </div>
        <div class="gombsor">
          <a href="#" class="share-face"><i class="ion-social-facebook"></i><br /><span>Megosztom</span></a>
          <a href="#" class="share-pin"><i class="ion-social-pinterest"></i><br /><span>Pinterest</span></a>
          <a href="#" class="share-like"><i class="ion-thumbsup"></i><br /><span>Ez csinos</span></a>
        </div>
        <?php wp_link_pages(array('before' => '<nav class="page-nav"><p>' . __('Pages:', 'roots'), 'after' => '</p></nav>')); ?>
      </footer>
    </div><!-- /.uszo -->
  </article>
<?php endwhile; ?>
