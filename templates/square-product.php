<?php
  $copt=get_option('cementlap_option_name');
  $orig_id=icl_object_id($post->ID, 'product', true, 'hu');
  if ((ICL_LANGUAGE_CODE=='hu') || ($orig_id !== $post->ID)) {

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
  //$transport=date($dateformat,strtotime($copt['ntd']));
   if ( (ICL_LANGUAGE_CODE=='de') || (ICL_LANGUAGE_CODE=='fr') || (ICL_LANGUAGE_CODE=='nl') ) {
    $uniprice='-';
    $brprice='-';
    $uniorigprice='-';
  }
?>

<?php
    $darab = get_post_meta($orig_id , '_meta_amount', true);
    $termik = array();
    $ures = array();
    $transporttocome = array();
    $nagytermlist=array_merge(
      get_the_terms( $post->ID, 'product-category' )?get_the_terms( $post->ID, 'product-category' ):$ures,
      get_the_terms( $post->ID, 'product-color' )?get_the_terms( $post->ID, 'product-color' ):$ures,
      get_the_terms( $post->ID, 'product-design' )?get_the_terms( $post->ID, 'product-design' ):$ures,
      get_the_terms( $post->ID, 'product-style' )?get_the_terms( $post->ID, 'product-style' ):$ures
    );
    foreach ( $nagytermlist as $term ) { $termik[] = $term->slug; }
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

  ?>
  <a id="product-<?php echo $post->ID; ?>" <?php post_class( join(" ", $termik ).' prod-mini' ); ?>
    href="<?php the_permalink(); ?>"
    data-url="<?php the_permalink(); ?>"
    data-name="<?php the_title(); ?>"
  >
    <figure class="prod-thumb">
      <?= get_the_post_thumbnail($orig_id, 'tiny11');  ?>
      <?php
        $ima = get_post_meta( $orig_id, '_meta_singleimg_id', true );
        $imci = wp_get_attachment_image_src( $ima, 'tiny11');
      ?>
      <?php   if (get_post_meta( $orig_id, '_meta_spos', true )!='nincs' ) : ?>
        <img src="<?php echo $imci[0]; ?>" width="<?php echo $imci[1]; ?>" height="<?php echo $imci[2]; ?>" alt="" class="prod-sthumb">
      <?php endif; ?>
    </figure>
    <div class="prod-desc">
      <h3 class="prod-title"><?php the_title(); ?></h3>
      <?php if ( $darab > 0 ) : ?>
        <div class="prod-stock-status">
          <i class="ion-ios7-cart"></i>
          <?php _e('In stock','cementlap') ?>:
          <span class="prod-amount">
            <?php echo $darab; ?><span class="prod-unit"><?php echo (get_post_meta($orig_id , '_meta_unit', true)=='m2')?' m<sup>2</sup>':$uniunit; ?></span>
          </span>
        </div>
      <?php endif; ?>
      <?php if ($jonmajd) : ?>
        <div class="prod-stock-status">
          <?php foreach ( (array) $transporttocome as $date => $quant ) : ?>
            <div class="trtocome">
              <i class="ion-android-train"></i><?php _e('Arrival','cementlap') ?>:
              <span class="prod-ntd">
                <?= date($dateformat,$date); ?> &middot; <strong><?= $quant; ?> <?= (get_post_meta($orig_id , '_meta_unit', true)=='m2')?'m<sup>2</sup>':$uniunit; ?></strong>
              </span>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>

      <?php if (!$jonmajd && ($darab<1) ) : ?>
      <div class="prod-stock-status">
          <i class="ion-alert-circled"></i>
          <?php _e('Production on order only','cementlap') ?>
      </div>
      <?php endif; ?>

      <?php if ($uniorigprice>0) : ?>
          <?php if (ICL_LANGUAGE_CODE=='hu') : ?>
            <div class="origprice">
              <?php _e('Original price','cementlap'); ?>:
              <span class="szam"><?php echo $uniorigprice; ?>
              <span class="unit"><?php echo $univaluta; ?>/<?php echo (get_post_meta($orig_id, '_meta_unit', true)=='m2')?'m<sup>2</sup>':$uniunit; ?> <span class="unit__vat"><?php _e('+VAT','cementlap'); ?></span></span>
              </span>
            </div>
          <?php else : ?>
            <div class="origprice">
              <?php _e('Original price','cementlap'); ?>:
              <span class="szam"><?php echo $uniorigprice*(100+$copt['vat'])/100; ?>
              <span class="unit"><?php echo $univaluta; ?>/<?php echo (get_post_meta($orig_id, '_meta_unit', true)=='m2')?'m<sup>2</sup>':$uniunit; ?></span>
              </span>
            </div>
          <?php endif; ?>
        <?php endif; ?>






      <?php if (ICL_LANGUAGE_CODE=='hu') : ?>
        <span class="prod-price">
          <?php echo $uniprice; ?>
          <span class="prod-unit"><?php echo $univaluta; ?>/<?php echo (get_post_meta($orig_id, '_meta_unit', true)=='m2')?'m<sup>2</sup>':$uniunit; ?> <?php _e('+VAT','cementlap'); ?></span>
        </span>
      <?php else : ?>
        <span class="prod-price">
          <?php echo $brprice; ?>
          <span class="prod-unit"><?php echo $univaluta; ?>/<?php echo (get_post_meta($orig_id, '_meta_unit', true)=='m2')?'m<sup>2</sup>':$uniunit; ?></span>
        </span>
      <?php endif; ?>
      <span class="prod-morebtn"><i class="ion ion-android-search"></i></span>
    </div>
  </a><!-- /#product-## -->

<?php } //  if ((ICL_LANGUAGE_CODE=='hu') || ($orig_id !== $post->ID))  ?>