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

  $imci = wp_get_attachment_image_src( $ima, 'wallfree');
  $imcismall = wp_get_attachment_image_src( $ima, 'wallsmall');
  $imcimedium = wp_get_attachment_image_src( $ima, 'wallmedium');
  $imcigreat = wp_get_attachment_image_src( $ima, 'wallgreat');
?>
  <?php
    $termik = array();
    
    $termlist=get_the_terms( $post->ID, 'product-category' );
    foreach ( $termlist as $term ) { 
      
      $termik[] = $term->slug;
    }

    $mastercat=get_term_top_most_parent($term->term_id, 'product-category');
    $mastercat_id=$mastercat->term_id;
    
    $termlist=get_the_terms( $post->ID, 'product-color' );
    foreach ( $termlist as $term ) { $termik[] = $term->slug; }
    
    $termlist=get_the_terms( $post->ID, 'product-design' );
    foreach ( $termlist as $term ) { $termik[] = $term->slug; }
    
    $termlist=get_the_terms( $post->ID, 'product-stock' );
    foreach ( $termlist as $term ) { $termik[] = $term->slug; }
    
    $termes = join(" ", $termik );
  ?>


<?php   if (get_post_meta( $post->ID, '_meta_bgpos', true )!='float' ) : ?>
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

<?php endif; ?>



<?php 
  $uniorigprice=number_format(get_post_meta($post->ID, '_meta_origprice', true), 0, ',', ' ');
  $uniprice=number_format(get_post_meta($post->ID, '_meta_price', true), 0, ',', ' ');
  $brprice=number_format(get_post_meta($post->ID, '_meta_price', true)*(100+$copt['vat'])/100, 0, ',', ' ');
  
  $univaluta='Ft';
  $uniunit=get_post_meta($post->ID, '_meta_unit', true);
  $dateformat='Y. m. d.';

  if (get_post_meta($post->ID, '_meta_arrive', true) !='') {
    $transport=date($dateformat,strtotime(get_post_meta($post->ID, '_meta_arrive', true)));
  } else {
    $transport=date($dateformat,strtotime($copt['ntd']));
  }

  if (ICL_LANGUAGE_CODE!='hu') {
    $uniorigprice=number_format(get_post_meta($post->ID, '_meta_origprice', true) / $copt['change'] , 1, ',', ' ');
    $uniprice=number_format( get_post_meta($post->ID, '_meta_price', true) / $copt['change'], 1, ',', ' ');
    $brprice=number_format(get_post_meta($post->ID, '_meta_price', true)*(100+$copt['vat'])/100/$copt['change'], 1, ',', ' ');
    $univaluta='EUR';
    $uniunit= ( get_post_meta($post->ID, '_meta_unit', true) == 'db')?'pcs':'db';
    $dateformat='d/m/y';



  }
?>



  <article <?php post_class($termes); ?> >
    <?php if ( get_post_meta( $post->ID, '_meta_bgpos', true )=='float' ) : ?>
      <figure class="product-figure product-figure--mustshow">
        <img src="<?php echo $imcimedium['0']; ?>" alt="<?php the_title(); ?>">
      </figure>
    <?php else : ?>
      <figure class="product-figure" style="background-image:url('<?php echo $imcismall['0']; ?>');">
        <img src="<?php echo $imcismall['0']; ?>" alt="<?php the_title(); ?>">
      </figure>
    <?php endif; ?>
    <div class="uszo">
        <header class="product-head">
          <a class="product-back" href="<?php echo get_term_link( get_term_by('id', $mastercat->term_id,'product-category') , 'product-category' ); ?>"><i class="ion-ios-undo"></i><?php echo $mastercat->name; ?></a>
          <h1 class="product-title"><?php the_title(); ?></h1>
          <div class="product-price">
            <?php if (has_term('akcios','product-stock')) : ?>
              <div class="origprice">
                <?php _e('Eredeti ár','root'); ?>: 
                <span class="szam"><?php echo $uniorigprice; ?>
                <span class="unit"><?php echo $univaluta; ?>/<?php echo (get_post_meta($post->ID, '_meta_unit', true)=='m2')?'m<sup>2</sup>':$uniunit; ?> <span class="unit__vat"><?php _e('+ÁFA','root'); ?></span></span>
                </span>
              </div>
            <?php endif; ?>

            <?php echo $uniprice; ?>
            <span class="unit"><?php echo $univaluta; ?>/<?php echo (get_post_meta($post->ID, '_meta_unit', true)=='m2')?'m<sup>2</sup>':$uniunit; ?> <span class="unit__vat"><?php _e('+ÁFA','root'); ?></span></span>
            <span class="brutto"><?php _e('bruttó:','roots'); ?> <?php echo $brprice; ?> <span class="unit--mini"><?php echo $univaluta; ?>/<?php echo (get_post_meta($post->ID, '_meta_unit', true)=='m2')?'m<sup>2</sup>':$uniunit; ?></span></span>
          </div>
        </header>
        <div class="flip-container" ontouchstart="this.classList.toggle('hover');">
        <div class="flipper">
        <div class="front">
            <div class="data-block">
              <?php if ( get_post_meta($post->ID, '_meta_size', true) !='') : ?>
                <div class="data-size">
                    <i class="ion-arrow-resize"></i> <?php _e('Méret','root'); ?>: <span><?php echo get_post_meta($post->ID, '_meta_size', true); ?></span>
                </div>
              <?php endif; ?>
              <?php if (get_post_meta($post->ID, '_meta_weight', true)!='') : ?>
                <div class="data-weight">
                    <i class="ion-speedometer"></i> <?php _e('Súly','root'); ?>: <span><?php echo get_post_meta($post->ID, '_meta_weight', true); ?></span>
                </div>
              <?php endif; ?>
              <?php if (get_post_meta($post->ID, '_meta_kit', true)!='') : ?>
                <div class="data-kiszer">
                    <i class="ion-ios-box-outline"></i> <?php _e('Kiszerelés','root'); ?>: <span><?php echo get_post_meta($post->ID, '_meta_kit', true); ?></span>
                </div>
              <?php endif; ?>
              </div><!-- /.data-block -->
            <div class="product-content">
              <?php the_content(); ?>  
            </div>
        </div>
        <div class="back">
          <div class="product-content">
             <?php echo wpautop($mastercat->description); ?>
          </div>
        </div><!-- /.back -->
        </div>
        </div>
        <footer class="product-footer">
          <div class="stock-block">
            <h3><?php _e('Készlet információ, szállítás','root'); ?></h3>
              <div class="stock-status">
                <?php if (has_term('raktarrol-azonnal','product-stock')|| has_term('in-stock','product-stock')) : ?>
                  <i class="ion-checkmark"></i> <?php _e('Azonnal szállítható','root') ?>
                <?php elseif ( has_term('hamarosan-erkezik','product-stock')|| has_term('coming-soon','product-stock') ): ?>
                   <i class="ion-android-train"></i> <?php _e('Szállítás alatt','root') ?>
                <?php else: ?>
                  <i class="ion-alert-circled"></i> <?php _e('Rendelésre gyártjuk','root') ?>
                <?php endif; ?>
              </div>
              
              <?php if (has_term('raktarrol-azonnal','product-stock')|| has_term('in-stock','product-stock')) : ?>
                <div class="stock-amount">
                  <i class="ion-ios-cart"></i> <?php _e('Raktáron van','root') ?>:
                  <span>
                    <?php echo get_post_meta($post->ID, '_meta_amount', true); ?><span class="prod-unit"><?php echo (get_post_meta($post->ID, '_meta_unit', true)=='m2')?'m<sup>2</sup>':$uniunit; ?></span>
                  </span>
                </div>
              <?php endif; ?>

              <?php if (has_term('hamarosan-erkezik','product-stock')|| has_term('coming-soon','product-stock')) : ?>

                <div class="date-status">
                    <i class="ion-clock"></i> <?php _e('Érkezik','root') ?>: 
                    <?php if ( get_post_meta($post->ID, '_meta_amountmarr', true) !='') : ?> 
                      <?php echo get_post_meta($post->ID, '_meta_amountmarr', true); ?><?php echo (get_post_meta($post->ID, '_meta_unit', true)=='m2')?'m<sup>2</sup>':$uniunit; ?> - 
                        <span><?= $transport; ?></span>

                    <?php else: ?>
                      <span><?= $transport; ?></span>
                    <?php endif; ?>

                  </div>
                
              <?php endif; ?>

              <?php if ( !(has_term('raktarrol-azonnal','product-stock') || has_term('in-stock','product-stock') || has_term('hamarosan-erkezik','product-stock') || has_term('coming-soon','product-stock') ) ): ?>
                <div class="date-status">
                  <i class="ion-clock"></i> <?php _e('Rendelés esetén érkezik','root') ?>: <span><?= $transport; ?></span>
                </div>

              <?php endif; ?>




            <div class="product-more">
                <a class="show-more" data-toggle="collapse" data-parent=".product-more" href="#morepanel">
                  <?php _e('Hogyan foglaljam/rendeljem meg','root'); ?>
                </a>
                <div id="morepanel" class="panel-collapse morepanel collapse">
                  <p><?php _e('<strong>Ha van RAKTÁRON elegendő mennyiség</strong> előrendelés nélkül, Törökbálinton azonnal átvehető és elvihető. Ha nem tudsz eljönni érte, érdemes lefoglalni.','root'); ?></p>
                  <p><?php _e('<strong>Ha kevés van, vagy nincs raktáron, de SZÁLLÍTÁS ALATT van:</strong> A lapokat már gyártjuk és/vagy már szállítás alatt van, és a jelzett időpontban érkeznek meg. A érkező mennyiséggel kapcsolatban hívj fel bennünket.','root'); ?></p>
                  <p><?php _e('<strong>Ha csak RENDELÉSRE gyártjuk:</strong> Nincs gyártásban, kb. 2 hónapos átfutási idővel érdemes számolni, hívj fel minket és egyeztetünk.','root'); ?></p>
                  <p><em><?php _e('Minden rendelés és foglalás 30% előleg befizetésével érvényes!','root'); ?></em></p>
                  <a class="show-less" data-toggle="collapse" data-parent=".product-more" href="#morepanel">
                    <i class="ion-ios-close-empty"></i>
                  </a>
                </div>

            </div>

          </div><!-- /.stock-block -->

          <div class="gombsor">
            <a onClick="return share_click('pi', 700, 300, '<?php echo $imci[0]; ?>')" href="http://www.pinterest.com/pin/create/button/?url=<?php echo urlencode(get_the_permalink()); ?>&media=<?php echo urlencode($imci[0]); ?>&description=<?php echo urlencode(get_the_title()); ?>" data-media="<?php echo urlencode($imci[0]); ?>">
              <i class="ion ion-social-pinterest"></i><br /><span><?php _e('Pinterest','roots'); ?></span>
            </a>
<!--             <a onClick="return share_click('fb', 400, 300)" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_permalink(); ?>" class="share-face"><i class="ion-social-facebook"></i><br /><span><?php _e('Megosztom','root'); ?></span></a> -->
            <a href="tel:+36209734344" class="call-phone"><i class="ion-iphone"></i><br /><span>+36.20.973.4344</span></a>
            <a href="#" class="share-info"><i class="ion-information-circled"></i><br /><span><?php _e('Felhasználás','roots'); ?></span></a>
          </div>
          <?php wp_link_pages(array('before' => '<nav class="page-nav"><p>' . __('Pages:', 'roots'), 'after' => '</p></nav>')); ?>
        </footer>
    </div><!-- /.uszo -->
     <nav class="product-pn">
          <ul>
            <!-- 
              <li><?php previous_post_link( '%link', '<i class="ion-ios-arrow-back"></i>', TRUE, ' ', 'product-category' ); ?> </li>
              <li><?php next_post_link( '%link', '<i class="ion-ios-arrow-forward"></i>', TRUE, ' ', 'product-category' ); ?></li>
            -->
            <li><?php previous_post_link_plus( array('in_same_tax' => true, 'format' => '%link', 'link' => '<i class="ion-ios-arrow-back"></i>', 'order_by' => 'post_title' )); ?></li>
            <li><?php next_post_link_plus( array('in_same_tax' => true,'format' => '%link', 'link' => '<i class="ion-ios-arrow-forward"></i>', 'order_by' => 'post_title' )); ?></li>
          </ul>
      </nav> 
  </article>
<?php endwhile; ?>
