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
  $ima = get_post_meta( $post->ID, '_meta_wallimg', false );
  $imci = wp_get_attachment_image_src( $ima[id], 'banner169');
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
  <article <?php post_class($termes); ?> style="background-image:url('<?php echo get_post_meta($post->ID, '_meta_wallimg', true); ?>');">
    <figure class="product-figure">
      <?php the_post_thumbnail('medium169'); ?>
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
              <?php _e('Készlet és szállítás<small>Érdeklődjön: +36 70 770 5653</small>','root'); ?>
            <?php else: ?>
              <?php _e('Foglald le most<small>Hívj telefonon: +36 70 770 5653</small>','root') ?>
            <?php endif; ?>
          </a>
        </div>
        <div class="stock-block">
          <h3><?php _e('Készlet információ, szállítás','root'); ?></h3>
          <div class="stock-status">
            <?php if (has_term('raktarrol-azonnal','product-stock')) : ?>
              <i class="ion-checkmark"></i> <?php _e('Azonnal szállítható','root') ?>
            <?php else: ?>
              <i class="ion-android-hand"></i> <?php _e('Csak rendelésre','root') ?>
            <?php endif; ?>
          </div>
          <?php if (has_term('raktarrol-azonnal','product-stock')) : ?>
            <div class="stock-amount">
              <i class="ion-ios7-cart"></i> Raktáron van:
              <span><?php echo get_post_meta($post->ID, '_meta_amount', true); ?><?php echo get_post_meta($post->ID, '_meta_unit', true); ?></span>
            </div>
          <?php else: ?>
            <div class="date-status"><i class="ion-clock"></i> Legkorábban érkezik: <span><?php echo $copt['ntd']; ?></span>  </div>
          <?php endif; ?>
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
