<?php
  $copt=get_option('cementlap_option_name'); 
  
  $uniorigprice=number_format(get_post_meta($post->ID, '_meta_origprice', true), 0, ',', ' ');
  $uniprice=number_format(get_post_meta($post->ID, '_meta_price', true), 0, ',', ' ');
  $univaluta='Ft';
  $uniunit=get_post_meta($post->ID, '_meta_unit', true);

  if (ICL_LANGUAGE_CODE!='hu') {
    $uniorigprice=number_format(get_post_meta($post->ID, '_meta_origprice', true) / $copt['change'] , 0, ',', ' ');
    $uniprice=number_format( get_post_meta($post->ID, '_meta_price', true) / $copt['change'], 0, ',', ' ');
    $univaluta='EUR';
    $uniunit= ( get_post_meta($post->ID, '_meta_unit', true) == 'db')?'pcs':'db';
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
  ?>
  <a id="product-<?php echo $post->ID; ?>" <?php post_class( join(" ", $termik ).' prod-mini' ); ?>
    href="<?php the_permalink(); ?>"
    data-url="<?php the_permalink(); ?>"
    data-name="<?php the_title(); ?>"
  >
    <figure class="prod-thumb">
      <?php the_post_thumbnail('tiny11');  ?>
      <?php
        $ima = get_post_meta( $post->ID, '_meta_singleimg_id', true );
        $imci = wp_get_attachment_image_src( $ima, 'petit11');
      ?>
    <img src="<?php echo $imci[0]; ?>" width="<?php echo $imci[1]; ?>" height="<?php echo $imci[2]; ?>" alt="" class="prod-sthumb">
    </figure>
    <div class="prod-desc">
      <h3 class="prod-title"><?php the_title(); ?></h3>
      <div class="prod-stock-status">
        <?php if ( has_term('raktarrol-azonnal','product-stock') || has_term('in-stock','product-stock') ) : ?>
          <i class="ion-ios7-cart"></i>
          <?php _e('Raktáron van','root') ?>:
          <span class="prod-amount">
            <?php echo get_post_meta($post->ID, '_meta_amount', true); ?><span class="prod-unit"><?php echo (get_post_meta($post->ID, '_meta_unit', true)=='m2')?' m<sup>2</sup>':$uniunit; ?></span>
          </span>
        <?php elseif ( has_term('hamarosan-erkezik','product-stock') || has_term('coming-soon','product-stock') )  : ?>
          <i class="ion-plane"></i>
          <?php _e('Érkezik:','root') ?>
          <span class="prod-ntd"><?php echo get_post_meta($post->ID, '_meta_arrive', true); ?></span>
          <?php else : ?>
          <i class="ion-alert-circled"></i>
          <?php _e('Rendelésre gyártjuk','root') ?>
        <?php endif; ?>
      </div>

      <span class="prod-price">
        <?php echo $uniprice; ?>
        <span class="prod-unit"><?php echo $univaluta; ?>/<?php echo (get_post_meta($post->ID, '_meta_unit', true)=='m2')?'m<sup>2</sup>':$uniunit; ?></span>
      </span>
    </div>
  </a><!-- /#product-## -->
