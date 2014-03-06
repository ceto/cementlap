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
  <a id="product-<?php echo $post->ID; ?>" <?php post_class($termes.' prod-mini'); ?>
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
            <?php echo get_post_meta($post->ID, '_meta_amount', true); ?><?php echo get_post_meta($post->ID, '_meta_unit', true); ?>
          </span>
        <?php elseif ( has_term('hamarosan-erkezik','product-stock'))  : ?>
          <i class="ion-clock"></i>
          <?php _e('Érkezik:','root') ?>
          <span class="prod-ntd"><?php echo get_post_meta($post->ID, '_meta_arrive', true); ?></span>
          <?php else : ?>
          <i class="ion-android-hand"></i>
          <?php _e('Csak rendelésre','root') ?>
        <?php endif; ?>
      </div>

      <span class="prod-price">
        <?php echo number_format(get_post_meta($post->ID, '_meta_price', true), 0, ',', ' '); ?>
        <span class="prod-unit">Ft/<?php echo get_post_meta($post->ID, '_meta_unit', true); ?></span>
      </span>
    </div>
  </a><!-- /#product-## -->