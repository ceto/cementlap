<?php while (have_posts()) : the_post(); ?>

<?php
  $orig_id=icl_object_id($post->ID, 'product', true, 'hu');
  $copt=get_option('cementlap_option_name');
  $ima = get_post_meta( $orig_id, '_meta_wallimg_id', true );

  $imci = wp_get_attachment_image_src( $ima, 'wallfree');
  $imcismall = wp_get_attachment_image_src( $ima, 'wallsmall');
  $imcimedium = wp_get_attachment_image_src( $ima, 'wallmedium');
  $imcigreat = wp_get_attachment_image_src( $ima, 'wallgreat');
?>
<?php
  $termik = array();

  $termlist=get_the_terms( $post->ID, 'product-category' );
  foreach ( $termlist as $term ) {$termik[] = $term->slug;}

  $mastercat=get_term_top_most_parent($term->term_id, 'product-category');
  $mastercat_id=$mastercat->term_id;

  $termlist=get_the_terms( $post->ID, 'product-color' );
  foreach ( $termlist as $term ) { $termik[] = $term->slug; }

  $termlist=get_the_terms( $post->ID, 'product-design' );
  foreach ( $termlist as $term ) { $termik[] = $term->slug; }

?>

<?php
  $uniorigprice=number_format(get_post_meta($orig_id, '_meta_origprice', true), 0, ',', ' ');
  $uniprice=number_format(get_post_meta($orig_id, '_meta_price', true), 0, ',', ' ');
  $brprice=number_format(get_post_meta($orig_id, '_meta_price', true)*(100+$copt['vat'])/100, 0, ',', ' ');

  $univaluta='Ft';
  $uniunit=get_post_meta($orig_id, '_meta_unit', true);
  $dateformat='Y. m. d.';

  if (ICL_LANGUAGE_CODE!='hu') {
    $uniorigprice=number_format(get_post_meta($orig_id, '_meta_origprice', true) / $copt['change'] , 1, ',', ' ');
    $uniprice=number_format( get_post_meta($orig_id, '_meta_price', true) / $copt['change'], 1, ',', ' ');
    $brprice=number_format(get_post_meta($orig_id, '_meta_price', true)*(100+$copt['vat'])/100/$copt['change'], 1, ',', ' ');
    $univaluta='EUR';
    $uniunit= ( get_post_meta($orig_id, '_meta_unit', true) == 'db')?'pcs':'db';
    $dateformat='d/m/y';
  }

  if ( (ICL_LANGUAGE_CODE=='de') || (ICL_LANGUAGE_CODE=='fr') || (ICL_LANGUAGE_CODE=='nl') )  {
    $uniprice='-';
    $uniorigprice='-';
  }

  $transport=date($dateformat,strtotime($copt['ntd']));

  $darab = get_post_meta($orig_id , '_meta_amount', true);
  $transporttocome = array();
  $csdates = get_post_meta( $orig_id, 'prod_coming_group', true );
  $jonmajd=FALSE;
  foreach ( (array) $csdates as $key => $entry ) {
    if ( isset( $entry['prc_quant']) && isset( $entry['prc_kontno'] ) ) {
      $termik[] = 'kont_'.$entry['prc_kontno'].'_db_'.$entry['prc_quant'];
      $termik[] = 'kont_'.$entry['prc_kontno'];
      $transporttocome[ get_post_meta($entry['prc_kontno'],'_meta_cardate','true') ]=$entry['prc_quant'];
      $jonmajd=TRUE;
    }
  }

  $termik[]= ($darab>0)?'in-stock':'not-in-stock';
  $termik[]= ($jonmajd)?'coming-soon':'not-coming-soon';

  $termes = join(" ", $termik );
?>


<?php   if (get_post_meta( $orig_id, '_meta_bgpos', true )!='float' ) : ?>
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







  <article <?php post_class($termes); ?> >
    <?php if ( get_post_meta( $orig_id, '_meta_bgpos', true )=='float' ) : ?>
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
                <?php _e('Original price','cementlap'); ?>:
                <span class="szam"><?php echo $uniorigprice; ?>
                <span class="unit"><?php echo $univaluta; ?>/<?php echo (get_post_meta($orig_id, '_meta_unit', true)=='m2')?'m<sup>2</sup>':$uniunit; ?> <span class="unit__vat"><?php _e('+VAT','cementlap'); ?></span></span>
                </span>
              </div>
            <?php endif; ?>

            <?php echo $uniprice; ?>
            <span class="unit"><?php echo $univaluta; ?>/<?php echo (get_post_meta($orig_id, '_meta_unit', true)=='m2')?'m<sup>2</sup>':$uniunit; ?> <span class="unit__vat"><?php _e('+VAT','cementlap'); ?></span></span>
            <span class="brutto"><?php _e('incl. vat:','cementlap'); ?> <?php echo $brprice; ?> <span class="unit--mini"><?php echo $univaluta; ?>/<?php echo (get_post_meta($orig_id, '_meta_unit', true)=='m2')?'m<sup>2</sup>':$uniunit; ?></span></span>
          </div>
        </header>
        <div class="flip-container" ontouchstart="this.classList.toggle('hover');">
        <div class="flipper">
        <div class="front">
            <div class="data-block">
              <?php if ( get_post_meta($orig_id, '_meta_size', true) !='') : ?>
                <div class="data-size">
                    <i class="ion-arrow-resize"></i> <?php _e('Size','cementlap'); ?>: <span><?php echo get_post_meta($orig_id, '_meta_size', true); ?></span>
                </div>
              <?php endif; ?>
              <?php if (get_post_meta($post->ID, '_meta_weight', true)!='') : ?>
                <div class="data-weight">
                    <i class="ion-speedometer"></i> <?php _e('Weight','cementlap'); ?>: <span><?php echo get_post_meta($post->ID, '_meta_weight', true); ?></span>
                </div>
              <?php endif; ?>
              <?php if (get_post_meta($post->ID, '_meta_kit', true)!='') : ?>
                <div class="data-kiszer">
                    <i class="ion-ios-box-outline"></i> <?php _e('Packing','cementlap'); ?>: <span><?php echo get_post_meta($post->ID, '_meta_kit', true); ?></span>
                </div>
              <?php endif; ?>
              </div><!-- /.data-block -->
            <div class="product-content">

              <?php if ( (ICL_LANGUAGE_CODE!='de') && (ICL_LANGUAGE_CODE!='fr') && (ICL_LANGUAGE_CODE!='nl') ) { ?>
                <?php the_content(); ?>
                <a class="show-more" data-toggle="collapse" data-parent=".product-more" href="#morepanel">
                  <?php _e('How to Order/Buy','cementlap'); ?>
                </a>
              <?php } ?>

            </div>

        </div>
        <div class="back">
          <div class="product-content">
             <?php echo wpautop($mastercat->description); ?>
          </div>
        </div><!-- /.back -->
        </div>
        </div>


        <?php if ( get_post_meta($orig_id, '_meta_refgal', true) ):?>
          <?php
            $contentwithgallery= get_post_meta( get_post_meta($orig_id, '_meta_refgal', true), '_meta_addcont', true );
            $imagelist=array();
            $imagelist=get_gallery_attachments($contentwithgallery);
            if (strpos($contentwithgallery,'gallery')>0) :
          ?>
            <div class="product__gallery">
              <div id="owl-refgal" class="owl-carousel popup-gallery">
                <?php
                  foreach ( $imagelist as $image_id ) {
                    $class = "post-attachment mime-" . sanitize_title( $attachment->post_mime_type );
                    $thumbimg = wp_get_attachment_image_src( $image_id, 'tiny11', false );
                    $fullimage = wp_get_attachment_image_src( $image_id, 'wallfree', false );
                    $imagedata = wp_get_attachment_image( $image_id, 'wallfree', false )
                  ?>
                    <a class="item" href="<?= $fullimage[0]; ?>" title="<?= get_the_title(get_post_meta($orig_id, '_meta_refgal', true)); ?>">
                      <img src="<?=$thumbimg[0]; ?>" alt="<?= get_the_title(get_post_meta($orig_id, '_meta_refgal', true)); ?>">
                    </a>
                  <?php } ?>
                </div>
            </div>
          <?php endif; ?>
        <?php endif; ?>

        <footer class="product-footer">

          <div class="stock-block">
            <h3><?php _e('Stock information, transport','cementlap'); ?></h3>
              <div class="stock-status">
                <?php if ($darab>0) : ?>
                  <i class="ion-checkmark"></i> <?php _e('In stock','cementlap') ?>
                <?php elseif ( $jonmajd ): ?>
                   <i class="ion-android-train"></i> <?php _e('Coming soon','cementlap') ?>
                <?php else: ?>
                  <i class="ion-alert-circled"></i> <?php _e('Produced on order only','cementlap') ?>
                <?php endif; ?>
              </div>

              <?php if ($darab>0) : ?>
                <div class="stock-amount">
                  <i class="ion-ios-cart"></i> <?php _e('Available','cementlap') ?>:
                  <span>
                    <?= $darab ?><span class="prod-unit"><?php echo (get_post_meta($orig_id, '_meta_unit', true)=='m2')?'m<sup>2</sup>':$uniunit; ?></span>
                  </span>
                </div>
              <?php endif; ?>

              <?php if ( $jonmajd ) : ?>

                <div class="date-status date-status--lister">
                  <i class="ion-clock"></i> <?php _e('Arrival','cementlap') ?>:
                  <?php foreach ( (array) $transporttocome as $date => $quant ) : ?>
                    <span class="date-status--lister__item">
                      <?= date($dateformat,$date); ?> - <strong><?= $quant; ?> <?= (get_post_meta($orig_id , '_meta_unit', true)=='m2')?'m<sup>2</sup>':$uniunit; ?></strong>
                    </span>
                  <?php endforeach; ?>




                  </div>

              <?php endif; ?>

              <?php if ( ($darab<1) && !$jonmajd ): ?>
                <div class="date-status">
                  <i class="ion-clock"></i> <?php _e('Arrival date when ordered','cementlap') ?>: <span><?= $transport; ?></span>
                </div>

              <?php endif; ?>


            <?php if ( (ICL_LANGUAGE_CODE!='de') && (ICL_LANGUAGE_CODE!='fr') && (ICL_LANGUAGE_CODE!='nl') ) { ?>

            <div class="product-more">

                <div id="morepanel" class="panel-collapse morepanel collapse">
                  <p><?php _e('<strong>If you find the selected tile <span>In Stock:</span></strong> no need to order, it is available and ready for pick up in warehouse Törökbálint. If you can not come immediaetly, we reccomend you make a reservation.','cementlap'); ?></p>
                  <p><?php _e('<strong>If the quantity in stock is not enough or out of stock, but it is indicated that it will <span>Coming Soon:</span></strong> The tiles are already in production or its way to Budapest, you may check the estimated date of arrival in our <a href="http://marrakeshcementlap.hu/en/vasarlasi-informaciok-en/shippment-schedule/">shipment schedule.</a> Regarding the available quantity please contact us by email.','cementlap'); ?></p>
                  <p><?php _e('<strong>If the tiles are <span>Produced on Order Only:</span></strong> It is not in production at the moment, you may check the estimated date of arrival in our <a href="http://marrakeshcementlap.hu/en/vasarlasi-informaciok-en/shippment-schedule/">shipment schedule.</a>','cementlap'); ?></p>
                  <p><?php _e('Important! Orders and reservations are valid  with 30% downpayment only.','cementlap'); ?> <?php _e('You may find all necessary information at the <a href="http://marrakeshcementlap.hu/en/vasarlasi-informaciok-en/keszletinformaciok-hataridok/">how to buy</a> menu.','cementlap'); ?></p>
                  <a class="show-less" data-toggle="collapse" data-parent=".product-more" href="#morepanel">
                    <i class="ion-ios-close-empty"></i>
                  </a>
                </div>

            </div>

            <?php } ?>

          </div><!-- /.stock-block -->

          <div class="gombsor">
            <a onClick="return share_click('pi', 700, 300, '<?php echo $imci[0]; ?>')" href="http://www.pinterest.com/pin/create/button/?url=<?php echo urlencode(get_the_permalink()); ?>&media=<?php echo urlencode($imci[0]); ?>&description=<?php echo urlencode(get_the_title()); ?>" data-media="<?php echo urlencode($imci[0]); ?>">
              <i class="ion ion-social-pinterest"></i><br /><span><?php _e('Pinterest','cementlap'); ?></span>
            </a>
<!--             <a onClick="return share_click('fb', 400, 300)" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_permalink(); ?>" class="share-face"><i class="ion-social-facebook"></i><br /><span><?php _e('Share','cementlap'); ?></span></a> -->
            <a href="tel:+36209734344" class="call-phone"><i class="ion-iphone"></i><br /><span>+36.20.973.4344</span></a>
            <a href="#" class="share-info"><i class="ion-information-circled"></i><br /><span><?php _e('Area of use','cementlap'); ?></span></a>
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
