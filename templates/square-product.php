<?php
  $copt=get_option('cementlap_option_name');
  $orig_id=icl_object_id($post->ID, 'product', true, 'hu');
  $uniorigprice=number_format(get_post_meta($orig_id, '_meta_origprice', true), 0, ',', ' ');
  $uniprice=number_format(get_post_meta($orig_id, '_meta_price', true), 0, ',', ' ');
  $univaluta='Ft';
  $uniunit=get_post_meta($orig_id, '_meta_unit', true);
  $dateformat='Y. m. d.';
  if (ICL_LANGUAGE_CODE!='hu') {
    $uniorigprice=number_format(get_post_meta($orig_id, '_meta_origprice', true) / $copt['change'] , 1, ',', ' ');
    $uniprice=number_format( get_post_meta($orig_id, '_meta_price', true) / $copt['change'], 1, ',', ' ');
    $univaluta='EUR';
    $uniunit= ( get_post_meta($orig_id, '_meta_unit', true) == 'db')?'pcs':'db';
    $dateformat='d/m/y';
  }

  if (get_post_meta($orig_id, '_meta_arrive', true) !='') {
    $transport=date($dateformat,strtotime(get_post_meta($orig_id, '_meta_arrive', true)));
  } else {
    $transport=date($dateformat,strtotime($copt['ntd']));
  }
?>

<?php
    $termik = array();
    $ures = array();
    $nagytermlist=array_merge(
      get_the_terms( $post->ID, 'product-category' )?get_the_terms( $post->ID, 'product-category' ):$ures,
      get_the_terms( $post->ID, 'product-color' )?get_the_terms( $post->ID, 'product-color' ):$ures,
      get_the_terms( $post->ID, 'product-design' )?get_the_terms( $post->ID, 'product-design' ):$ures,
      get_the_terms( $post->ID, 'product-stock' )?get_the_terms( $post->ID, 'product-stock' ):$ures,
      get_the_terms( $post->ID, 'product-style' )?get_the_terms( $post->ID, 'product-style' ):$ures
    );
    foreach ( $nagytermlist as $term ) { $termik[] = $term->slug; }
    $csdates = get_post_meta( get_the_ID(), 'prod_coming_group', true );
    foreach ( (array) $csdates as $key => $entry ) {
      if ( isset( $entry['prc_date'] ) ) {$termik[] = 'cs_'.$entry['prc_date'];}
    }
    foreach ( (array) $csdates as $key => $entry ) {
      if ( isset( $entry['prc_kontno'] ) ) {$termik[] = 'kont_'.$entry['prc_kontno'];}
    }

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
      <div class="prod-stock-status">
        <?php if ( has_term('raktarrol-azonnal','product-stock') || has_term('in-stock','product-stock') ) : ?>
          <i class="ion-ios7-cart"></i>
          <?php _e('In stock','cementlap') ?>:
          <span class="prod-amount">
            <?php echo get_post_meta($orig_id , '_meta_amount', true); ?><span class="prod-unit"><?php echo (get_post_meta($orig_id , '_meta_unit', true)=='m2')?' m<sup>2</sup>':$uniunit; ?></span>
          </span>
        <?php elseif ( has_term('hamarosan-erkezik','product-stock') || has_term('coming-soon','product-stock') )  : ?>
          <i class="ion-android-train"></i>
          <?php _e('Arrival','cementlap') ?>:
            <?php if ( get_post_meta($orig_id , '_meta_amountmarr', true) !='') : ?>
              <span class="prod-ntd">
                <?php echo get_post_meta($orig_id , '_meta_amountmarr', true); ?><?php echo (get_post_meta($orig_id , '_meta_unit', true)=='m2')?'m<sup>2</sup>':$uniunit; ?> &middot; <?= $transport; ?>
              </span>
            <?php else: ?>
              <span class="prod-ntd"><?= $transport ?></span>
            <?php endif; ?>
          <?php else : ?>
          <i class="ion-alert-circled"></i>
          <?php _e('Production on order only','cementlap') ?>
        <?php endif; ?>
      </div>

      <span class="prod-price">
        <?php echo $uniprice; ?>
        <span class="prod-unit"><?php echo $univaluta; ?>/<?php echo (get_post_meta($orig_id, '_meta_unit', true)=='m2')?'m<sup>2</sup>':$uniunit; ?> <?php _e('+VAT','cementlap'); ?></span>
      </span>
      <span class="prod-morebtn"><i class="ion ion-android-search"></i></span>
    </div>
  </a><!-- /#product-## -->
