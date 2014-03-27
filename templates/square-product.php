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
        <?php if (has_term('raktarrol-azonnal','product-stock')) : ?>
          <i class="ion-ios7-cart"></i>
          <?php _e('Raktáron van:','root') ?>
          <span class="prod-amount">
            <?php echo get_post_meta($post->ID, '_meta_amount', true); ?><span class="prod-unit"><?php echo (get_post_meta($post->ID, '_meta_unit', true)=='m2')?'m<sup>2</sup>':get_post_meta($post->ID, '_meta_unit', true); ?></span>
          </span>
        <?php elseif ( has_term('hamarosan-erkezik','product-stock'))  : ?>
          <i class="ion-plane"></i>
          <?php _e('Érkezik:','root') ?>
          <span class="prod-ntd"><?php echo get_post_meta($post->ID, '_meta_arrive', true); ?></span>
          <?php else : ?>
          <i class="ion-alert-circled"></i>
          <?php _e('Rendelésre gyártjuk','root') ?>
        <?php endif; ?>
      </div>

      <span class="prod-price">
        <?php echo number_format(get_post_meta($post->ID, '_meta_price', true), 0, ',', ' '); ?>
        <span class="prod-unit">Ft/<?php echo (get_post_meta($post->ID, '_meta_unit', true)=='m2')?'m<sup>2</sup>':get_post_meta($post->ID, '_meta_unit', true); ?></span>
      </span>
    </div>
  </a><!-- /#product-## -->
