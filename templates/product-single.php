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

<?php 
  $uniorigprice=number_format(get_post_meta($post->ID, '_meta_origprice', true), 0, ',', ' ');
  $uniprice=number_format(get_post_meta($post->ID, '_meta_price', true), 0, ',', ' ');
  $univaluta='Ft';
  $uniunit=get_post_meta($post->ID, '_meta_unit', true);

  if (ICL_LANGUAGE_CODE!='hu') {
    $uniorigprice=number_format(get_post_meta($post->ID, '_meta_origprice', true) / $copt['change'] , 2, ',', ' ');
    $uniprice=number_format( get_post_meta($post->ID, '_meta_price', true) / $copt['change'], 2, ',', ' ');
    $univaluta='EUR';
    $uniunit= ( get_post_meta($post->ID, '_meta_unit', true) == 'db')?'pcs':'db';
  }
?>



  <article <?php post_class($termes); ?> >
    <figure class="product-figure" style="background-image:url('<?php echo $imcismall['0']; ?>');">
      <img src="<?php echo $imcismall['0']; ?>" alt="<?php the_title(); ?>">
    </figure>
    <div class="uszo">
        <header class="product-head">
          <a class="product-back" href="<?php echo get_term_link( get_term_by('id', icl_object_id(5,'product-category',true),'product-category') , 'product-category' ); ?>"><i class="ion-ios7-undo"></i><?php _e('Cementlapok','root'); ?></a>
          <h1 class="product-title"><?php the_title(); ?></h1>
          <div class="product-price">
            <?php if (has_term('akcios','product-stock')) : ?>
              <div class="origprice">
                <?php _e('Eredeti ár','root'); ?>: 
                <span class="szam"><?php echo $uniorigprice; ?>
                <span class="unit"><?php echo $univaluta; ?>/<?php echo (get_post_meta($post->ID, '_meta_unit', true)=='m2')?'m<sup>2</sup>':$uniunit; ?></span>
                </span>
              </div>
            <?php endif; ?>

            <?php echo $uniprice; ?>
            <span class="unit"><?php echo $univaluta; ?>/<?php echo (get_post_meta($post->ID, '_meta_unit', true)=='m2')?'m<sup>2</sup>':$uniunit; ?></span>
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
                    <i class="ion-ios7-box-outline"></i> <?php _e('Kiszerelés','root'); ?>: <span><?php echo get_post_meta($post->ID, '_meta_kit', true); ?></span>
                </div>
              <?php endif; ?>
              </div><!-- /.data-block -->
            <div class="product-content">
              <?php the_content(); ?>  
            </div>
        </div>
        <div class="back">
           <div class="product-content">
            <p>
              <?php _e('Egyszínű vagy bordűr lapokkal kombinálva izgalmas egyedi kombinációk is megvalósíthatóak. Modern lakások vagy klasszikus polgári otthonok hidegburkolataként egyaránt remekül felhasználható.','root'); ?>
            </p>
            <p>
              <?php _e('Padlófűtéssel kombinálható, de konyhapultokhoz vagy fürdőszobák falburkolatként is alkalmazható.','root'); ?>
            </p>
            <p>
              <?php _e('Vásárlás előtt feltétlenül tájékozódj a <a href="http://marrakeshcementlap.hu/cementlapok-lerakasa/">lerakásról</a> és a <a href="http://marrakeshcementlap.hu/vasarlasi-informaciok/technikai-parameterek/">technikai paraméterekről.</a>','root'); ?>
            </p>
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
                 <i class="ion-plane"></i> <?php _e('Szállítás alatt','root') ?>
              <?php else: ?>
                <i class="ion-alert-circled"></i> <?php _e('Rendelésre gyártjuk','root') ?>
              <?php endif; ?>
            </div>
            
            <?php if (has_term('raktarrol-azonnal','product-stock')|| has_term('in-stock','product-stock')) : ?>
              <div class="stock-amount">
                <i class="ion-ios7-cart"></i> <?php _e('Raktáron van','root') ?>:
                <span>
                  <?php echo get_post_meta($post->ID, '_meta_amount', true); ?><span class="prod-unit"><?php echo (get_post_meta($post->ID, '_meta_unit', true)=='m2')?'m<sup>2</sup>':$uniunit; ?></span>
                </span>
              </div>
            <?php elseif ( get_post_meta($post->ID, '_meta_arrive', true) !=''): ?>
              <div class="date-status"><i class="ion-clock"></i> <?php _e('Érkezik','root') ?>: <span><?php echo get_post_meta($post->ID, '_meta_arrive', true); ?></span></div>
            <?php else: ?>
              <div class="date-status"><i class="ion-clock"></i> <?php _e('Rendelés esetén érkezik','root') ?>: <span><?php echo $copt['ntd']; ?></span>  </div>
            <?php endif; ?>

            <div class="product-more">
                <a class="show-more" data-toggle="collapse" data-parent=".product-more" href="#morepanel">
                  <?php _e('Hogyan foglaljam/rendeljem meg','root'); ?>
                </a>
                <div id="morepanel" class="panel-collapse morepanel collapse">
                  <p><?php _e('<strong>Ha van RAKTÁRON elegendő mennyiség</strong> előrendelés nélkül, Törökbálinton azonnal átvehető és elvihető. Ha nem tudsz eljönni érte, érdemes lefoglalni.','root'); ?></p>
                  <p><?php _e('<strong>Ha kevés van, vagy nincs raktáron, de SZÁLLÍTÁS ALATT van:</strong> A lapokat már gyártjuk és/vagy már szállítás alatt van, és a jelzett időpontban érkeznek meg. A érkező mennyiséggel kapcsolatban hívj fel bennünket. ','root'); ?></p>
                  <p><?php _e('<strong>Ha csak RENDELÉSRE gyártjuk:</strong> Nincs gyártásban, kb. 2 hónapos átfutási idővel érdemes számolni, hívj fel minket és egyeztetünk. ','root'); ?></p>
                  <p><em><?php _e('Minden rendelés és foglalás 30% előleg befizetésével érvényes! ','root'); ?></em></p>
                  <a class="show-less" data-toggle="collapse" data-parent=".product-more" href="#morepanel">
                    <i class="ion-ios7-close-empty"></i>
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
              <li><?php previous_post_link( '%link', '<i class="ion-ios7-arrow-back"></i>', TRUE, ' ', 'product-category' ); ?> </li>
              <li><?php next_post_link( '%link', '<i class="ion-ios7-arrow-forward"></i>', TRUE, ' ', 'product-category' ); ?></li>
            -->
            <li><?php previous_post_link_plus( array('in_same_tax' => true, 'format' => '%link', 'link' => '<i class="ion-ios7-arrow-back"></i>', 'order_by' => 'post_title' )); ?></li>
            <li><?php next_post_link_plus( array('in_same_tax' => true,'format' => '%link', 'link' => '<i class="ion-ios7-arrow-forward"></i>', 'order_by' => 'post_title' )); ?></li>
          </ul>
      </nav> 
  </article>
<?php endwhile; ?>
